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
		$titulo = $_POST['att-titulo'];
		$descricao = $_POST['att-descricao'];
		$keywords = $_POST['keywords'];
		$slug = $_POST['slug'];
		$description = $_POST['description'];
		$idNot = $_POST['idNot'];

		// Tratar a imagem antes de criar um registro no banco
			// 
		// ===================================================

		/*
			Verifica se foi recebida uma nova imagem
			caso nao tenha sido enviado, matem a atual
			caso seja enviado atualiza para a nova imagem
		*/
		if ($_FILES['att-foto']['name'] == ''){
			if (!empty($_POST['Ncategoria'])){
				$Ncategoria = $_POST['Ncategoria'];

				// Insere uma nova categoria
				$sqlCat = $pdo->prepare("INSERT INTO categorias (categoria) VALUES ('$Ncategoria')");
				$sqlCat->execute();
				$idCat = $pdo->lastInsertId();

				$categoria = $idCat;
			}else{
				$categoria = $_POST['categoria'];
			}

			// Atualiza somente as outras informações

			$sql = $pdo->prepare("UPDATE blog SET titulo = '$titulo', artigo = '$descricao', categoria='$categoria', slug ='$slug', description='$description', keywords='$keywords' WHERE id = '$idNot'");
			$sql->execute();
			echo "ok";
		}else{
			if (!empty($_POST['Ncategoria'])){
				$Ncategoria = $_POST['Ncategoria'];

				// Insere uma nova categoria
				$sqlCat = $pdo->prepare("INSERT INTO categorias (categoria) VALUES ('$Ncategoria')");
				$sqlCat->execute();
				$idCat = $pdo->lastInsertId();

				$categoria = $idCat;
			}else{
				$categoria = $_POST['categoria'];
			}



			// Atualiza as informações junto com a foto
			$imagem = $_FILES['att-foto'];

			// Seleciona a foto antiga para deletar
			$sqlS = $pdo->prepare("SELECT img FROM blog WHERE id = '$idNot'");
			$sqlS->execute();
			$arrayS = $sqlS->fetch(PDO::FETCH_OBJ);

			// Imagem atual
			$imagemAtual = '../'.$arrayS->img;

			// Deleta a imagem
			unlink($imagemAtual);


			//Insere a nova imagem da noticia
			$tmpIM = $imagem['tmp_name'];
			$cam = dirname(dirname(__FILE__)).'/imagens/'.$idNot.'/';
			$localIM = str_replace('\\', '/', $cam);
			$fotoIM = $imagem['name'];

			// Separa o nome do ponto para pegar a extensao da imagem
			$ext = pathinfo($fotoIM, PATHINFO_EXTENSION);

			// Troca o nome da imagem par ao time stamp atual
			$nomeFoto = time().uniqid(md5($fotoIM)).'.'.$ext;

			// Move a imagem para a pasta
			move_uploaded_file($tmpIM, "$localIM"."$nomeFoto");

			// Caminho do BD
			$caminhoBD = 'imagens/'.$idNot.'/'.$nomeFoto;

			// Atualiza a Noticia
			$sql = $pdo->prepare("UPDATE blog SET titulo = '$titulo', img = '$caminhoBD', artigo = '$descricao', categoria='$categoria' WHERE id = '$idNot'");
			$sql->execute();
			echo "ok";
		}
	}else{
		echo "erro";
		header("location: https://$server/");
	}

?>