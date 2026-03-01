<?php
	// Dados de um testemunho
	if (!empty($_GET['tst'])){
		$noticias = $class->Select("*", "testemunhos", "", "WHERE id = '".$_GET['tst']."'");
		$rowT = $noticias->fetch(PDO::FETCH_OBJ);

		// verifica se retornou alguma informacao
		(empty($rowT->titulo)) ? header("location: https://$server/") : "";
	}
?>