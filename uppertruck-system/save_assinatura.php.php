<?php
// /uppertruck-system/save_assinatura.php
declare(strict_types=1);
header('Content-Type: application/json; charset=utf-8');

try {
  $raw = file_get_contents('php://input');
  $json = json_decode($raw, true, 512, JSON_THROW_ON_ERROR);

  $id    = isset($json['id']) ? (int)$json['id'] : 0;
  $token = isset($json['token']) ? trim((string)$json['token']) : '';
  $nome  = isset($json['nome']) ? trim((string)$json['nome']) : '';
  $img64 = isset($json['imageBase64']) ? (string)$json['imageBase64'] : '';

  if ($id<=0 || $token==='') { http_response_code(400); echo json_encode(['ok'=>false,'msg'=>'Parâmetros inválidos']); exit; }
  if (strpos($img64, 'data:image/png;base64,') !== 0) { http_response_code(400); echo json_encode(['ok'=>false,'msg'=>'Formato inválido']); exit; }

  require __DIR__ . '/includes/db.php';

  // valida token do documento (igual upload_foto)
  $stmt = $conn->prepare("SELECT id, upload_token, token_expires FROM documentos WHERE id=?");
  $stmt->bind_param('i', $id);
  $stmt->execute();
  $doc = $stmt->get_result()->fetch_assoc();
  $stmt->close();

  if (!$doc || !$doc['upload_token'] || !hash_equals($doc['upload_token'], $token)) {
    http_response_code(401);
    echo json_encode(['ok'=>false,'msg'=>'Token inválido/expirado']);
    exit;
  }
  if (!empty($doc['token_expires']) && strtotime($doc['token_expires']) < time()) {
    http_response_code(401);
    echo json_encode(['ok'=>false,'msg'=>'Link expirado']);
    exit;
  }

  // salva arquivo
  $dir  = __DIR__ . '/assets/signatures';
  if (!is_dir($dir)) @mkdir($dir, 0775, true);
  if (!is_writable($dir)) { http_response_code(500); echo json_encode(['ok'=>false,'msg'=>'Sem permissão de escrita']); exit; }

  $binary = base64_decode(substr($img64, strlen('data:image/png;base64,')));
  if ($binary===false) { http_response_code(400); echo json_encode(['ok'=>false,'msg'=>'Base64 inválido']); exit; }

  $nomeArq = 'sig_'.$id.'_'.date('Ymd_His').'_'.bin2hex(random_bytes(3)).'.png';
  $pathAbs = $dir . '/' . $nomeArq;
  if (file_put_contents($pathAbs, $binary) === false) { http_response_code(500); echo json_encode(['ok'=>false,'msg'=>'Falha ao salvar assinatura']); exit; }

  $pathRel = '/uppertruck-system/assets/signatures/' . $nomeArq;

  // grava no BD (não invalida token aqui, para permitir foto e assinatura com o mesmo link; se quiser, invalide)
  $agora = date('Y-m-d H:i:s');
  $stmt = $conn->prepare("UPDATE documentos SET assinatura_path=?, assinatura_at=?, assinatura_nome=? WHERE id=?");
  $stmt->bind_param('sssi', $pathRel, $agora, $nome, $id);
  $ok = $stmt->execute();
  $stmt->close();

  if (!$ok) { @unlink($pathAbs); http_response_code(500); echo json_encode(['ok'=>false,'msg'=>'Erro ao registrar no banco']); exit; }

  echo json_encode(['ok'=>true, 'path'=>$pathRel]);
} catch(Throwable $e){
  http_response_code(500);
  echo json_encode(['ok'=>false,'msg'=>'Erro inesperado']);
}
