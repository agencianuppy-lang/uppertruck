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
		// 1º Posts recebidos
		$titulo = $_POST['att-titulo'];
		$descricao = $_POST['att-descricao'];
		$data = $_POST['att-data'];
		$hora = $_POST['att-hora'];
		$idAg = $_POST['idAg'];


		// Atualiza somente as outras informações

		$sql = $pdo->prepare("UPDATE agenda SET titulo = '$titulo', data = '$data', horario = '$hora', descricao = '$descricao' WHERE id = '$idAg'");
		$sql->execute();
		echo "ok";

	}else{
		echo "erro";
		header("location: https://$server/");
	}

?>