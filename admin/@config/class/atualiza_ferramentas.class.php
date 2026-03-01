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
		$ferramentas = $_POST['ferramentas'];

		foreach($ferramentas AS $key => $value){		

			// ID da ferramenta
			$idF = $key;

			// Status de selecao
			$statusF = ($value == 'on') ? '1' : '0';

			$sql = $pdo->prepare("UPDATE conf_ferramentas SET status = '$statusF' WHERE id = '$idF'");
			$sql->execute();

		}
		
		echo "ok";

	}else{
		echo "erro";
		header("location: https://$server/");
	}

?>