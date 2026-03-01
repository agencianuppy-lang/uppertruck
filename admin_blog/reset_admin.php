<?php
require_once __DIR__ . '/config/db.php';

try {
    $email = 'admin@nuppy.com.br';
    $senha = 'admin12345';
    $hash = password_hash($senha, PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("UPDATE users SET email = ?, `password` = ? WHERE id = 1");
    $stmt->execute([$email, $hash]);

    echo "<h2 style='font-family:sans-serif;'>✅ Admin resetado com sucesso!</h2>";
    echo "<p>Email: <strong>$email</strong></p>";
    echo "<p>Senha: <strong>$senha</strong></p>";
    echo "<p><a href='/admin_blog/auth/login.php'>Ir para login</a></p>";
} catch (Exception $e) {
    echo "Erro: " . $e->getMessage();
}