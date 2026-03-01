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
		$nome = $_POST['nome_cliente'];


		if ($_FILES['logo_empresa']['name'] == ''){

			// Verifica se o cliente ja existe na base
			$sqlV = $pdo->prepare("SELECT cliente FROM conf_cliente");
			$sqlV->execute();
			$total = $sqlV->rowCount();

			if ($total == 0){
				// Insere um novo cliente
				$sqlIn = $pdo->prepare("INSERT INTO conf_cliente (cliente) VALUES ('$nome')");
				$sqlIn->execute();
			}else{
				// Atualiza somente as outras informações
				$sql = $pdo->prepare("UPDATE conf_cliente SET cliente = '$nome'");
				$sql->execute();
			}
		}else{
			// Atualiza as informações junto com a foto
			$imagem = $_FILES['logo_empresa'];

			// Verifica se o cliente ja existe na base
			$sqlV = $pdo->prepare("SELECT cliente FROM conf_cliente");
			$sqlV->execute();
			$total = $sqlV->rowCount();

			if ($total == 0){
				//Insere a nova imagem da noticia
				$tmpIM = $imagem['tmp_name'];
				$cam = dirname(dirname(__FILE__)).'/logo/';
				$localIM = str_replace('\\', '/', $cam);
				$fotoIM = $imagem['name'];

				// Separa o nome do ponto para pegar a extensao da imagem
				$ext = pathinfo($fotoIM, PATHINFO_EXTENSION);

				// Troca o nome da imagem par ao time stamp atual
				$nomeFoto = time().uniqid(md5($fotoIM)).'.'.$ext;

				// Move a imagem para a pasta
				move_uploaded_file($tmpIM, "$localIM"."$nomeFoto");

				// Caminho do BD
				$caminhoBD = 'logo/'.$nomeFoto;

				// Insere um novo cliente
				$sqlI = $pdo->prepare("INSERT INTO conf_cliente (cliente, logo) VALUES ('$nome', '$caminhoBD')");
				$sqlI->execute();
			}else{

				// Seleciona a foto antiga para deletar
				$sqlS = $pdo->prepare("SELECT logo FROM conf_cliente");
				$sqlS->execute();
				$arrayS = $sqlS->fetch(PDO::FETCH_OBJ);

				if ($arrayS->logo != ''){
					// Imagem atual
					$imagemAtual = '../'.$arrayS->logo;

					// Deleta a imagem
					unlink($imagemAtual);
				}

				//Insere a nova imagem da noticia
				$tmpIM = $imagem['tmp_name'];
				$cam = dirname(dirname(__FILE__)).'/logo/';
				$localIM = str_replace('\\', '/', $cam);
				$fotoIM = $imagem['name'];

				// Separa o nome do ponto para pegar a extensao da imagem
				$ext = pathinfo($fotoIM, PATHINFO_EXTENSION);

				// Troca o nome da imagem par ao time stamp atual
				$nomeFoto = time().uniqid(md5($fotoIM)).'.'.$ext;

				// Move a imagem para a pasta
				move_uploaded_file($tmpIM, "$localIM"."$nomeFoto");

				// Caminho do BD
				$caminhoBD = 'logo/'.$nomeFoto;



				// Atualiza somente as outras informações
				$sql = $pdo->prepare("UPDATE conf_cliente SET cliente = '$nome', logo = '$caminhoBD'");
				$sql->execute();
			}
		}
		
		echo "ok";

	}else{
		echo "erro";
		header("location: https://$server/");
	}

?>