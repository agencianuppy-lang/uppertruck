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

	// Arquivo
	if (!empty($_FILES['fotos']['name'])){

		$fotos = $_FILES['fotos'];
		$album = $_POST['id_album'];

		foreach($fotos['name'] AS $keyF => $valueF){
			// verifica se veio algum valor vazio
			if ($valueF == ''){
				continue;
			}

			// Arquivos temporarios e destino da imagem
			$tmpIM = $fotos['tmp_name'][$keyF];
			$cam = dirname(dirname(__FILE__)).'/albuns/'.$album.'/';
			$localIM = str_replace('\\', '/', $cam);
			$fotoIM = $valueF;

			// Separa o nome do ponto para pegar a extensao da imagem
			$ext = pathinfo($fotoIM, PATHINFO_EXTENSION);

			// Troca o nome da imagem par ao time stamp atual
			$nomeFoto = time().uniqid(md5($fotoIM)).'.'.$ext;

			// Move a imagem para a pasta
			move_uploaded_file($tmpIM, "$localIM"."$nomeFoto");

			// Caminho do BD
			$caminhoBD = 'albuns/'.$album.'/'.$nomeFoto;


			$sql = $pdo->prepare("	INSERT INTO fotos (	arquivo, id_album)
									VALUES('$caminhoBD', '$album')");

			$sql->execute();
		}
	}else{
		header("location: https://$server/");
	}
?>