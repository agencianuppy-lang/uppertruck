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
		$titulo = $_POST['not-titulo'];
		$imagem = $_FILES['not-imagem'];
		$descricao = $_POST['not-descricao'];
		$hora_postagem = date("Y-m-d H:i:s");

		// Tratar a imagem antes de criar um registro no banco
			// 
		// ===================================================

		// 2º Insere a noticia no banco
		$sql = $pdo->prepare("INSERT INTO artigos (titulo, artigo, hora_postagem) VALUES ('$titulo', '$descricao', '$hora_postagem')");
		$sql->execute();
		$id = $pdo->lastInsertId();

		// 3º Cria a pasta da noticia
		mkdir("../imagens/".$id, 0777);

		// 4º Insere a imagem da noticia na pasta criada acima
		$tmpIM = $imagem['tmp_name'];
		$cam = dirname(dirname(__FILE__)).'/imagens/'.$id.'/';
		$localIM = str_replace('\\', '/', $cam);
		$fotoIM = $imagem['name'];

		// Separa o nome do ponto para pegar a extensao da imagem
		$ext = pathinfo($fotoIM, PATHINFO_EXTENSION);

		// Troca o nome da imagem par ao time stamp atual
		$nomeFoto = time().uniqid(md5($fotoIM)).'.'.$ext;

		// Move a imagem para a pasta
		move_uploaded_file($tmpIM, "$localIM"."$nomeFoto");

		// Caminho do BD
		$caminhoBD = 'imagens/'.$id.'/'.$nomeFoto;


		// Atualiza o caminho no banco do arquivo
		$sqlU = $pdo->prepare("UPDATE artigos SET img = '$caminhoBD' WHERE id = '$id'");
		$sqlU->execute();

		echo "ok";
	}else{
		echo "erro";
		header("location: https://$server/");
	}
?>