<?php
// excluir_contrato.php
declare(strict_types=1);
header('Content-Type: application/json; charset=utf-8');

session_start();
if (!isset($_SESSION['user_id'])) {
  http_response_code(401);
  echo json_encode(['ok'=>false,'msg'=>'Não autorizado']);
  exit;
}

$id = isset($_POST['id']) ? (int)$_POST['id'] : 0;
if ($id <= 0) { http_response_code(400); echo json_encode(['ok'=>false,'msg'=>'ID inválido']); exit; }

require __DIR__ . '/conexao/key.php';

$stmt = $conn->prepare("DELETE FROM contratos WHERE id = ?");
$stmt->bind_param('i', $id);
$ok = $stmt->execute();
$stmt->close();

echo json_encode(['ok'=>$ok, 'msg'=>$ok ? 'Excluído' : 'Falha ao excluir']);