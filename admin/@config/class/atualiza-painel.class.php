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
		$statusMobile = $_POST['statusMob'];

		$sql = $pdo->prepare("UPDATE conf_cliente SET mobile = '$statusMobile'");
		$sql->execute();

		
		echo "ok";

	}else{
		echo "erro";
		header("location: https://$server/");
	}

?>