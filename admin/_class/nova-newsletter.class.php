<?php
	// Chave do banco
	include('key.php');

	// Config da server
	include('caminho_controler.php');

	$server = $_SERVER['SERVER_NAME'];
	if ($server == 'localhost'){
		$server = $_SERVER['SERVER_NAME'].'/'.$nome_da_pasta;
	}else{
		$server = $_SERVER['SERVER_NAME'];
	}

	if ($_POST){
		// 1º Posts recebidos
		$emailnews = $_POST['email'];

		// Verifica se o email ja existe
		$sqlS = $pdo->prepare("SELECT email FROM newsletter WHERE email = '$emailnews'");
		$sqlS->execute();
		$total = $sqlS->rowCount();

		if($total > 0){
			echo "exist";
		}else{
			// 1º Posts recebidos
			$emailnews = $_POST['email'];
			// $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = $pdo->prepare("INSERT INTO newsletter (email) VALUES ('$emailnews')");
			$sql->execute();

			
			echo "ok";
		}

	}else{
		echo "erro";
		header("location: https://$server/");
	}

?>