<?php
// Incluir o arquivo de configuração do banco de dados
include("conexao/key.php");


// Novo hash de senha
$new_password = password_hash('amigao', PASSWORD_DEFAULT);

// Atualizar o hash da senha para o usuário 'upper'
$username = 'upper';

$sql = "UPDATE usuarios SET password_hash = '$new_password' WHERE username = '$username'";

if ($conn->query($sql) === TRUE) {
    echo "Senha do usuário '$username' atualizada com sucesso!";
} else {
    echo "Erro ao atualizar senha do usuário '$username': " . $conn->error;
}

$conn->close();
?>