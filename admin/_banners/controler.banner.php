<?php
	// instancia a classe de ações
	include('class/banner.class.php');
	$ban = new Banner;

	// Dados do album
	if (!empty($_GET['banner'])){
		$noticias = $class->Select("*", "banner", "", "WHERE id = '".$_GET['banner']."'");
		$rowN = $noticias->fetch(PDO::FETCH_OBJ);

		// verifica se retornou alguma informacao
		(empty($rowN->titulo)) ? header("location: https://$server/") : "";
	}
?>