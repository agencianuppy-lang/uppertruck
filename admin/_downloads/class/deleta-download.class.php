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
		// Posts recebidos
		$idDownload = $_POST['idDownload'];

		// Seleciona o caminho da foto
		$ft = $pdo->prepare("SELECT arquivo FROM downloads WHERE id='$idDownload'");
		$ft->execute();
		$array = $ft->fetch(PDO::FETCH_OBJ);

		$cam = '../'.$array->arquivo;
		unlink($cam);

		$sql = $pdo->prepare("DELETE FROM downloads WHERE id = '$idDownload'");
		$sql->execute();
		$id = $pdo->lastInsertId();
		

		echo "ok";
	}else{
		echo "erro";
		header("location: https://$server/");
	}
?>