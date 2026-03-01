<?php
$host = "localhost";
$dbname = "uppertru_sistem";
$username = "uppertru_sistem";
$password = "nuppy@2025";

// Conexão com MySQLi
$conn = new mysqli($host, $username, $password, $dbname);

// Verifica se houve erro na conexão
if ($conn->connect_error) {
    die("Erro na conexão com o banco de dados: " . $conn->connect_error);
}

// Define charset como utf8
$conn->set_charset("utf8");