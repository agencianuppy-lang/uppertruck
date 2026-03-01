<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: ../../auth/login.php');
    exit;
}

require_once '../../config/config.php';
require_once '../../config/db.php';

$id = $_GET['id'] ?? null;

if (!$id || !is_numeric($id)) {
    header('Location: list.php');
    exit;
}

$stmt = $pdo->prepare("DELETE FROM categories WHERE id = :id");
$stmt->execute(['id' => $id]);

header('Location: list.php?sucesso=1');
exit;