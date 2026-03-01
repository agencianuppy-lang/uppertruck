<?php 
	// FAZ A CONEXAO COM O BANCO
	include('../../_class/key.php');

	if ($_POST){

		$id = $_POST['idAgenda'];

		$del = $pdo->prepare("DELETE FROM agenda WHERE id='$id'");
		$del->execute();

		echo "ok";
	}else{
		echo "erro";
		header("location: https://$server/");
	}
?>