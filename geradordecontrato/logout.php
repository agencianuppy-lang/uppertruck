<?php
session_start();

// Destrua a sessão
session_destroy();

// Redirecione para a página de login (index.php) após fazer logout
header("Location: index.php");
exit();
?>