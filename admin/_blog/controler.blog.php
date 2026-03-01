<?php
	// Dados do album
	if (!empty($_GET['blog'])){
		$noticias = $class->Select("*", "blog", "", "WHERE id = '".$_GET['blog']."'");
		$rowN = $noticias->fetch(PDO::FETCH_OBJ);

		// verifica se retornou alguma informacao
		(empty($rowN->titulo)) ? header("location: https://$server/") : "";
	}
?>