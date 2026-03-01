<?php
	include('../../_class/key.php');

	// Posts recebidos
	if($_POST){
		$id = $_POST['idAlb'];
		$titulo = $_POST['att-nome'];
		$data = $_POST['att-data'];

		$sql = $pdo->prepare("UPDATE albuns SET titulo = '$titulo', data = '$data' WHERE id = '$id'");
		$sql->execute();

		echo "ok";
	}else{
		echo "erro";
		header("location: https://$server/");
	}
?>