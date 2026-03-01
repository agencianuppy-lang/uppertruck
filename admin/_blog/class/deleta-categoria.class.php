<?php
	// Chave do banco
	include('../../_class/key.php');

	// Config da server
	include('../../_class/caminho_controler.php');

	if ($_POST){

		// ID da categoria
		$idCat = $_POST['categoria'];

		// Deleta a categoria
		$sqlCat = $pdo->prepare("DELETE FROM categorias WHERE id = '$idCat'");
		$sqlCat->execute();

		// Atualiza as noticias tirando a categoria deles
		$sql = $pdo->prepare("UPDATE blog SET categoria = 'SC' WHERE categoria = '$idCat'");
		$sql->execute();
		
		echo "ok";
	}else{
		echo "erro";
		header("location: https://$server/");
	}
?>