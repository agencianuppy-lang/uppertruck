<?php
// Conexão com o banco de dados (substitua as informações conforme necessário)
$host = "localhost";
$username = "uppertru_gerador_de_contrato";
$password = "?=#}o0K=s~%j";
$database = "uppertru_gerador_de_contrato";
$conn = new mysqli($host, $username, $password, $database);

// Verificar a conexão
if ($conn->connect_error) {
    die("Erro na conexão com o banco de dados: " . $conn->connect_error);
}
?>