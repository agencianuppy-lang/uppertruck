<?php
	// instancia a classe de ações
	include('class/agenda.class.php');
	$not = new Agenda;

	// Dados do album
	if (!empty($_GET['agenda'])){
		$noticias = $class->Select("*", "agenda", "", "WHERE id = '".$_GET['agenda']."'");
		$rowN = $noticias->fetch(PDO::FETCH_OBJ);

		// verifica se retornou alguma informacao
		(empty($rowN->titulo)) ? header("location: https://$server/") : "";
	}
?>