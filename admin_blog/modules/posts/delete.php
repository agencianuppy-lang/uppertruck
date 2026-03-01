<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: ../../auth/login.php');
    exit;
}

require_once '../../config/config.php';
require_once '../../config/db.php';

$id = $_GET['id'] ?? null;
if (!$id) {
    header('Location: list.php');
    exit;
}

// Verifica se o post existe
$stmt = $pdo->prepare("SELECT id FROM posts WHERE id = :id");
$stmt->execute(['id' => $id]);
$post = $stmt->fetch();

if (!$post) {
    header('Location: list.php');
    exit;
}

// Remove relações de tags
$stmt = $pdo->prepare("DELETE FROM post_tags WHERE post_id = :id");
$stmt->execute(['id' => $id]);

// Remove o post
$stmt = $pdo->prepare("DELETE FROM posts WHERE id = :id");
$stmt->execute(['id' => $id]);

header('Location: list.php?sucesso=1');
exit;