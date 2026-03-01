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

	function delTree($dir) { 
		$files = array_diff(scandir($dir), array('.','..')); 
		foreach ($files as $file) { 
		  (is_dir("$dir/$file")) ? delTree("$dir/$file") : unlink("$dir/$file"); 
		} 
		return rmdir($dir); 
	}

	if ($_POST){
		// Posts recebidos
		$idPal = $_POST['idPal'];

		// Seleciona o caminho da foto
		$ft = $pdo->prepare("SELECT imagem FROM palavras WHERE id='$idPal'");
		$ft->execute();
		$array = $ft->fetch(PDO::FETCH_OBJ);

		$cam = dirname(dirname(__FILE__));
		$localIM = str_replace('\\', '/', $cam);

		$cam = $localIM.'/imagens/'.$idPal;

		// Executa o método de deletar o diretorio
		delTree($cam);

		$sql = $pdo->prepare("DELETE FROM palavras WHERE id = '$idPal'");
		$sql->execute();
		$id = $pdo->lastInsertId();
		

		echo "ok";
	}else{
		echo "erro";
		header("location: https://$server/");
	}
?>