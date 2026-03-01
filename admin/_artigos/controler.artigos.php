<?php
	// Dados do album
	if (!empty($_GET['artigo'])){
		$noticias = $class->Select("*", "artigos", "", "WHERE id = '".$_GET['artigo']."'");
		$rowN = $noticias->fetch(PDO::FETCH_OBJ);

		// verifica se retornou alguma informacao
		(empty($rowN->titulo)) ? header("location: https://$server/") : "";
	}
?>