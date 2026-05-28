<?php
$host = "localhost";
$dbname = "ivanfe67_sistem";
$username = "ivanfe67_sistem";
$password = "@aBLLxeTCAZ%";

// Conexão com MySQLi
$conn = new mysqli($host, $username, $password, $dbname);

// Verifica se houve erro na conexão
if ($conn->connect_error) {
    die("Erro na conexão com o banco de dados: " . $conn->connect_error);
}

// Define charset como utf8
$conn->set_charset("utf8");
