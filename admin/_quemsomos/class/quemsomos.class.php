<?php
	// Chave do banco
	include('../../_class/key.php');

	// Config da server
	include('../../_class/caminho_controler.php');

	$server = $_SERVER['SERVER_NAME'];
	if ($server == 'localhost'){
		$server = $_SERVER['SERVER_NAME'].'/'.$nome_da_pasta;
	}else{
		$server = $_SERVER['SERVER_NAME'];
	}

	if ($_POST){
		$texto = $_POST['descricao'];

		// Seleciona o caminho da foto
		$qs = $pdo->prepare("SELECT texto FROM quemsomos");
		$qs->execute();
		$array = $qs->fetch(PDO::FETCH_OBJ);

		if (empty($array->texto)){
			// Insere
			$sqlI = $pdo->prepare("INSERT INTO quemsomos (texto) VALUES ('$texto')");
			$sqlI->execute();
		}else{
			// Atualiza
			$sqlU = $pdo->prepare("UPDATE quemsomos SET texto = '$texto'");
			$sqlU->execute();
		}

		

		echo "ok";
	}else{
		echo "erro";
		header("location: https://$server/");
	}
?>