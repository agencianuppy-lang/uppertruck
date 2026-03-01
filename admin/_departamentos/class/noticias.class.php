<?php
	class Noticias{
		function NovoAlbum($nome, $data){
			// Chave de conexão ao banco
			include('../../_class/key.php');

			$sql = $pdo->prepare("INSERT INTO albuns (titulo, data) VALUES('?', '?')");
			$sql->bindParam(1, $nome);
			$sql->bindParam(2, $data);
			$sql->execute();

			// retorna uma mensagem de sucesso
			echo "ok";
		}

		function FormataData($data){
			$sep = explode("-", $data);
			$dataF = $sep[2].'/'.$sep[1].'/'.$sep[0];
			return $dataF;
		}

	}
	
?>