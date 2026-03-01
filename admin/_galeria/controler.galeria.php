<?php
	// instancia a classe de ações
	include('class/galeria.class.php');
	$gal = new Galeria;

	// Dados do album
	if (!empty($_GET['album'])){
		$albuns = $class->Select("*", "albuns", "", "WHERE id = '".$_GET['album']."'");
		$rowA = $albuns->fetch(PDO::FETCH_OBJ);

		// verifica se retornou alguma informacao
		(empty($rowA->titulo)) ? header("location: https://$server/") : "";
	}
?>