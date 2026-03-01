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

	if($_POST){
		// Titulo
		$titulo = $_POST['titulo'];

		// Arquivo
		if (!empty($_FILES['arquivo']['name'])){

			$fotos = $_FILES['arquivo'];

			// Arquivos temporarios e destino da imagem
			$tmpIM = $fotos['tmp_name'];
			$cam = dirname(dirname(__FILE__)).'/arquivos/';
			$localIM = str_replace('\\', '/', $cam);
			$fotoIM = $fotos['name'];

			// Separa o nome do ponto para pegar a extensao da imagem
			$ext = pathinfo($fotoIM, PATHINFO_EXTENSION);

			// Troca o nome da imagem par ao time stamp atual
			$nomeFoto = time().uniqid(md5($fotoIM)).'.'.$ext;

			// Move a imagem para a pasta
			move_uploaded_file($tmpIM, "$localIM"."$nomeFoto");

			// Caminho do BD
			$caminhoBD = 'arquivos/'.$nomeFoto;


			$sql = $pdo->prepare("	INSERT INTO downloads (	titulo, arquivo)
									VALUES('$titulo', '$caminhoBD')");

			$sql->execute();
			echo "ok";
		}
	}else{
		echo "erro";
		header("location: https://$server/");
	}
?>