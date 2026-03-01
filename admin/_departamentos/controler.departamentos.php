<?php
	// Dados do album
	if (!empty($_GET['depto'])){
		$noticias = $class->Select("*", "departamentos", "", "WHERE id = '".$_GET['depto']."'");
		$rowD = $noticias->fetch(PDO::FETCH_OBJ);

		// verifica se retornou alguma informacao
		(empty($rowD->titulo)) ? header("location: https://$server/") : "";
	}
?>