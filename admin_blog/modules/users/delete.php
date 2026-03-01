<?php
session_start();
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['role'] !== 'admin') {
    header('Location: ../../auth/login.php');
    exit;
}

require_once '../../config/config.php';
require_once '../../config/db.php';

$id = $_GET['id'] ?? null;

// Impede exclusão do próprio usuário logado
if (!$id || !is_numeric($id) || $id == $_SESSION['usuario']['id']) {
    header('Location: list.php');
    exit;
}

// Exclui o usuário
$stmt = $pdo->prepare("DELETE FROM users WHERE id = :id");
$stmt->execute(['id' => $id]);

header('Location: list.php?sucesso=1');
exit;