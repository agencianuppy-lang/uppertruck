<?php
// salvar_assinatura.php
declare(strict_types=1);
session_start();

require __DIR__ . '/conexao/key.php'; // $conn
if (!isset($conn) || !($conn instanceof mysqli)) {
  die('Falha de conexão.');
}
$conn->set_charset('utf8mb4');

$uploadsDir = __DIR__ . '/assets/signatures';
$publicBase = 'assets/signatures'; // caminho público relativo

if (!is_dir($uploadsDir)) @mkdir($uploadsDir, 0775, true);
if (!is_writable($uploadsDir)) {
  http_response_code(500);
  echo 'Sem permissão de escrita em assets/signatures.';
  exit;
}

$id    = isset($_POST['id']) ? (int)$_POST['id'] : 0;
$token = isset($_POST['token']) ? trim((string)$_POST['token']) : '';
$nome  = isset($_POST['assinatura_nome']) ? trim((string)$_POST['assinatura_nome']) : '';
$img64 = isset($_POST['assinatura_data']) ? (string)$_POST['assinatura_data'] : '';

if ($id <= 0 || $token === '' || $nome === '' || $img64 === '') {
  http_response_code(400);
  echo 'Dados incompletos.';
  exit;
}

// valida token
$stmt = $conn->prepare("SELECT id, assinatura_token, assinatura_expira_em FROM contratos WHERE id = ? LIMIT 1");
$stmt->bind_param('i', $id);
$stmt->execute();
$c = $stmt->get_result()->fetch_assoc();
$stmt->close();

if (!$c || empty($c['assinatura_token']) || !hash_equals($c['assinatura_token'], $token)) {
  http_response_code(401);
  echo 'Token inválido/expirado.';
  exit;
}
if (!empty($c['assinatura_expira_em']) && strtotime($c['assinatura_expira_em']) < time()) {
  http_response_code(401);
  echo 'Link expirado.';
  exit;
}

// valida base64
$prefix = 'data:image/png;base64,';
if (strpos($img64, $prefix) !== 0) {
  http_response_code(400);
  echo 'Formato de assinatura inválido.';
  exit;
}

$bin = base64_decode(substr($img64, strlen($prefix)));
if ($bin === false) {
  http_response_code(400);
  echo 'Assinatura corrompida.';
  exit;
}

// salva arquivo
$fname = 'sig_'.$id.'_'.date('Ymd_His').'_'.bin2hex(random_bytes(3)).'.png';
$abs   = $uploadsDir.'/'.$fname;

if (file_put_contents($abs, $bin) === false) {
  http_response_code(500);
  echo 'Falha ao salvar a assinatura.';
  exit;
}
$rel = $publicBase.'/'.$fname; // caminho público relativo

// atualiza contrato e invalida token
$agora = date('Y-m-d H:i:s');
$upd = $conn->prepare("UPDATE contratos
                          SET assinatura_nome = ?,
                              assinatura_path = ?,
                              assinatura_at   = ?,
                              assinatura_token = NULL,
                              assinatura_expira_em = NULL
                        WHERE id = ?
                        LIMIT 1");
$upd->bind_param('sssi', $nome, $rel, $agora, $id);
$ok = $upd->execute();
$upd->close();

if (!$ok) {
  @unlink($abs);
  http_response_code(500);
  echo 'Erro ao registrar no banco.';
  exit;
}

// sucesso: leva o usuário a uma página de confirmação simples
header('Location: assinatura_ok.php');
exit;