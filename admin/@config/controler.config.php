<?php
	// Dados do cliente
	$cliente = $class->Select("*", "conf_cliente", "", "");
	$rowC = $cliente->fetch(PDO::FETCH_OBJ);
?>