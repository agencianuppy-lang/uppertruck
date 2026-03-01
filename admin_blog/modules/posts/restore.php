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
    header('Location: trash.php');
    exit;
}

// Atualizar is_deleted para FALSE
$stmt = $pdo->prepare("UPDATE posts SET is_deleted = FALSE WHERE id = :id");
$stmt->execute(['id' => $id]);

header('Location: trash.php?restaurado=1');
exit;