<?php
session_start();

require_once '../config/config.php';
require_once '../config/db.php';

$email = $_POST['email'] ?? '';
$senha = $_POST['senha'] ?? '';

if (empty($email) || empty($senha)) {
    header('Location: login.php?erro=1');
    exit;
}

$sql = "SELECT id, name, email, password, role FROM users WHERE email = :email LIMIT 1";
$stmt = $pdo->prepare($sql);
$stmt->execute(['email' => $email]);
$usuario = $stmt->fetch();

if ($usuario && password_verify($senha, $usuario['password'])) {
    $_SESSION['usuario'] = [
        'id'    => $usuario['id'],
        'nome'  => $usuario['name'],
        'email' => $usuario['email'],
        'role'  => $usuario['role']
    ];
    header('Location: /admin_blog/dashboard.php');
    exit;
} else {
    header('Location: login.php?erro=1');
    exit;
}