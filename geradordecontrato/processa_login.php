<?php
// ==========================
// Configuração da sessão
// ==========================
$secure = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on');
$domain = $_SERVER['HTTP_HOST'];
// Para garantir compatibilidade com www e sem www, força ponto no início
if ($domain && $domain[0] !== '.') {
    $domain = '.' . $domain;
}

session_set_cookie_params([
    'lifetime' => 0,
    'path'     => '/',        // cookie visível em todo o site
    'domain'   => $domain,    // ex.: .uppertruck.com
    'secure'   => $secure,    // só HTTPS se disponível
    'httponly' => true,
    'samesite' => 'Lax'
]);

session_start();

// ==========================
// Conexão com o banco
// ==========================
include("conexao/key.php");

// ==========================
// Verificar o login
// ==========================
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST["username"] ?? '');
    $password = $_POST["password"] ?? '';

    // Validação inicial
    if ($username === '' || $password === '') {
        header("Location: index.php?error=1");
        exit();
    }

    // Consulta SQL segura
    $sql = "SELECT id, password_hash FROM usuarios WHERE username = ? LIMIT 1";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die("Erro no prepare: " . $conn->error);
    }
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows === 1) {
        $row = $result->fetch_assoc();
        $hashed_password = $row["password_hash"];

        // Verificação da senha
        if (password_verify($password, $hashed_password)) {
            // Login OK → define a sessão
            $_SESSION['user_id'] = (int)$row["id"];

            // Redireciona para página inicial protegida
            header("Location: proxima_pagina.php");
            exit();
        } else {
            // Senha incorreta
            header("Location: index.php?error=1");
            exit();
        }
    } else {
        // Usuário não encontrado
        header("Location: index.php?error=1");
        exit();
    }

    $stmt->close();
}

// ==========================
// Encerrar conexão
// ==========================
$conn->close();
?>