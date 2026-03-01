<?php
include('../includes/auth.php');
include('../includes/db.php');

$id = $_GET['id'] ?? 0;
if (!$id || !is_numeric($id)) {
  header("Location: documentos.php");
  exit;
}

$stmt = $conn->prepare("DELETE FROM documentos WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->close();

header("Location: documentos.php");
exit;