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

	$mb = "";

	$banner_pc1 = (!empty($_FILES['banner_mb1']['name'])) ? $mb = $_FILES['banner_mb1'] : "";
	$banner_pc2 = (!empty($_FILES['banner_mb2']['name'])) ? $mb = $_FILES['banner_mb2'] : "";
	$banner_pc3 = (!empty($_FILES['banner_mb3']['name'])) ? $mb = $_FILES['banner_mb3'] : "";

	$pos = $_POST['pos'];

	// Arquivo
	if (!empty($mb['name'])){

		// Arquivos temporarios e destino da imagem
		$tmpIM = $mb['tmp_name'];
		$cam = dirname(dirname(__FILE__)).'/banner_mobile/';
		$localIM = str_replace('\\', '/', $cam);
		$fotoIM = $mb['name'];

		// Separa o nome do ponto para pegar a extensao da imagem
		$ext = pathinfo($fotoIM, PATHINFO_EXTENSION);

		// Troca o nome da imagem par ao time stamp atual
		$nomeFoto = time().uniqid(md5($fotoIM)).'.'.$ext;

		// Move a imagem para a pasta
		move_uploaded_file($tmpIM, "$localIM"."$nomeFoto");

		// Caminho do BD
		$caminhoBD = 'banner_mobile/'.$nomeFoto;


		$sql = $pdo->prepare("	INSERT INTO banner (banner, tipo, pos)
								VALUES('$caminhoBD', '2', '$pos')");

		$sql->execute();
		echo "ok";
		}else{
			echo "erro";
			header("location: https://$server/");
		}
?>