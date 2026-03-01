<?php
	// Dados do album
	if (!empty($_GET['noticia'])){
		$noticias = $class->Select("*", "noticias", "", "WHERE id = '".$_GET['noticia']."'");
		$rowN = $noticias->fetch(PDO::FETCH_OBJ);

		// verifica se retornou alguma informacao
		(empty($rowN->titulo)) ? header("location: https://$server/") : "";
	}
?>