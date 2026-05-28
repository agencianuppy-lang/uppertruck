<?php
// Conexão com o banco de dados (substitua as informações conforme necessário)
$host = "localhost";
$username = "ivanfe67_gerador_de_contrato";
$password = "@aBLLxeTCAZ%";
$database = "ivanfe67_gerador_de_contrato";
$conn = new mysqli($host, $username, $password, $database);

// Verificar a conexão
if ($conn->connect_error) {
    die("Erro na conexão com o banco de dados: " . $conn->connect_error);
}
?>
