<?php
include('../includes/auth.php');
include('../includes/db.php');

$id = $_GET['id'] ?? 0;
if (!$id || !is_numeric($id)) {
  header("Location: clientes.php");
  exit;
}

// Verifica se existem documentos vinculados (opcional)
$check = $conn->prepare("SELECT id FROM documentos WHERE cliente_id = ?");
$check->bind_param("i", $id);
$check->execute();
$check->store_result();

if ($check->num_rows > 0) {
  $check->close();
  header("Location: clientes.php?erro=vinculado");
  exit;
}
$check->close();

// Agora sim, exclui da tabela correta
$stmt = $conn->prepare("DELETE FROM clientes WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->close();

header("Location: clientes.php");
exit;