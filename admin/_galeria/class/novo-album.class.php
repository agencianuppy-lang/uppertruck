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

	// Posts recebidos
	if($_POST){
		$titulo = $_POST['nome-album'];
		$data = $_POST['data-album'];

		$sql = $pdo->prepare("INSERT INTO albuns (titulo, data) VALUES ('$titulo', '$data')");
		$sql->execute();
		$id = $pdo->lastInsertId();

		mkdir("../albuns/".$id, 0777);

		echo "ok";
	}else{
		echo "erro";
		header("location: https://$server/galeria_adm");
	}
?>