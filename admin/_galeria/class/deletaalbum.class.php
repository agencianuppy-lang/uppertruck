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

		function delTree($dir) { 
			$files = array_diff(scandir($dir), array('.','..')); 
			foreach ($files as $file) { 
			  (is_dir("$dir/$file")) ? delTree("$dir/$file") : unlink("$dir/$file"); 
			} 
			return rmdir($dir); 
		}
		
		// POST recebido
		$id = $_POST['idAlbum'];

		// Seleciona o id do album
		$sql = $pdo->prepare("SELECT id FROM albuns WHERE id='$id'");
		$sql->execute();
		$vt = $sql->fetch(PDO::FETCH_OBJ);
		$album = $vt->id;

		// Pega o caminho do diretorio
		$cam = dirname(dirname(__FILE__)).'/albuns/'.$album.'/';
		$uploaddir = str_replace('\\', '/', $cam);

		// Executa o método de deletar o diretorio
		delTree($uploaddir);

		// Apaga o registro do album do banco
		$del = $pdo->prepare("DELETE FROM albuns WHERE id='$id'");
		$del->execute();

		// Apaga as fotos do banco
		$delF = $pdo->prepare("DELETE FROM fotos WHERE id_album='$id'");
		$delF->execute();

		echo "ok";
	}else{
		echo "erro";
		header("location: https://$server/");
	}
?>