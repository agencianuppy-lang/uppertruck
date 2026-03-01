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

	$pc = "";

	$banner_pc1 = (!empty($_FILES['banner_pc1']['name'])) ? $pc = $_FILES['banner_pc1'] : "";
	$banner_pc2 = (!empty($_FILES['banner_pc2']['name'])) ? $pc = $_FILES['banner_pc2'] : "";
	$banner_pc3 = (!empty($_FILES['banner_pc3']['name'])) ? $pc = $_FILES['banner_pc3'] : "";

	$pos = $_POST['pos'];

	// Arquivo
	if (!empty($pc['name'])){

		// Arquivos temporarios e destino da imagem
		$tmpIM = $pc['tmp_name'];
		$cam = dirname(dirname(__FILE__)).'/banner_pc/';
		$localIM = str_replace('\\', '/', $cam);
		$fotoIM = $pc['name'];

		// Separa o nome do ponto para pegar a extensao da imagem
		$ext = pathinfo($fotoIM, PATHINFO_EXTENSION);

		// Troca o nome da imagem par ao time stamp atual
		$nomeFoto = time().uniqid(md5($fotoIM)).'.'.$ext;

		// Move a imagem para a pasta
		move_uploaded_file($tmpIM, "$localIM"."$nomeFoto");

		// Caminho do BD
		$caminhoBD = 'banner_pc/'.$nomeFoto;


		$sql = $pdo->prepare("	INSERT INTO banner (banner, tipo, pos)
								VALUES('$caminhoBD', '1', '$pos')");

		$sql->execute();
		echo "ok";
		}else{
			echo "erro";
			header("location: https://$server/");
		}
?>