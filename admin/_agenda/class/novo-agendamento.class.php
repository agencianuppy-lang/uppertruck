<?php
	// conexao com o banco
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

		// 1º Posts recebidos
		$titulo = $_POST['titulo'];
		$data = $_POST['data'];
		$horario = $_POST['horario'];
		$descricao = $_POST['descricao'];


		// 2º Insere o agendamento no banco
		$sql = $pdo->prepare("INSERT INTO agenda (titulo, data, horario, descricao) VALUES ('$titulo', '$data', '$horario', '$descricao')");
		$sql->execute();
		$id = $pdo->lastInsertId();

		echo "ok";
	}else{
		echo "erro";
		header("location: https://$server/");
	}
?>