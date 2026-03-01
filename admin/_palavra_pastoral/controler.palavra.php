<?php
	// Dados de um testemunho
	if (!empty($_GET['pal'])){
		$noticias = $class->Select("*", "palavras", "", "WHERE id = '".$_GET['pal']."'");
		$rowT = $noticias->fetch(PDO::FETCH_OBJ);

		// verifica se retornou alguma informacao
		(empty($rowT->titulo)) ? header("location: https://$server/") : "";
	}
?>