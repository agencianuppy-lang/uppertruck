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
		$titulo = $_POST['titulo'];
		$nome = $_POST['pastor'];
		$descricao = $_POST['att-descricao'];
		$idPal = $_POST['idPal'];

		// Tratar a imagem antes de criar um registro no banco
			// 
		// ===================================================

		/*
			Verifica se foi recebida uma nova imagem
			caso nao tenha sido enviado, matem a atual
			caso seja enviado atualiza para a nova imagem
		*/
		if ($_FILES['imagem']['name'] == ''){
			// Atualiza somente as outras informações

			$sql = $pdo->prepare("UPDATE palavras SET titulo = '$titulo', pastor = '$nome', descricao = '$descricao' WHERE id = '$idPal'");
			$sql->execute();
			echo "ok";
		}else{
			// Atualiza as informações junto com a foto
			$imagem = $_FILES['imagem'];

			// Seleciona a foto antiga para deletar
			$sqlS = $pdo->prepare("SELECT imagem FROM palavras WHERE id = '$idPal'");
			$sqlS->execute();
			$arrayS = $sqlS->fetch(PDO::FETCH_OBJ);

			// Imagem atual
			$imagemAtual = '../'.$arrayS->imagem;

			// Deleta a imagem
			unlink($imagemAtual);


			//Insere a nova imagem da noticia
			$tmpIM = $imagem['tmp_name'];
			$cam = dirname(dirname(__FILE__)).'/imagens/'.$idPal.'/';
			$localIM = str_replace('\\', '/', $cam);
			$fotoIM = $imagem['name'];

			// Separa o nome do ponto para pegar a extensao da imagem
			$ext = pathinfo($fotoIM, PATHINFO_EXTENSION);

			// Troca o nome da imagem par ao time stamp atual
			$nomeFoto = time().uniqid(md5($fotoIM)).'.'.$ext;

			// Move a imagem para a pasta
			move_uploaded_file($tmpIM, "$localIM"."$nomeFoto");

			// Caminho do BD
			$caminhoBD = 'imagens/'.$idPal.'/'.$nomeFoto;

			// Atualiza a Noticia
			$sql = $pdo->prepare("UPDATE palavras SET titulo = '$titulo', pastor = '$nome', imagem = '$caminhoBD', descricao = '$descricao' WHERE id = '$idPal'");
			$sql->execute();
			echo "ok";
		}
	}else{
		echo "erro";
		header("location: https://$server/");
	}

?>