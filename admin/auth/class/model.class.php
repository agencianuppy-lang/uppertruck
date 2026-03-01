<?php
	class Action{

		function Login($user, $pass){

			// Conexao
			include ('key.php');

			$sql = $pdo->prepare("SELECT id FROM usuarios WHERE user = ? AND password = ?");
			$sql->bindValue(1, $user);
			$sql->bindValue(2, $pass);
			$sql->execute();


			// Quantidade de registros encontrados
			$qtd = $sql->rowCount();


			if ($qtd > 0){
				$array = $sql->fetch(PDO::FETCH_OBJ);
				// Seta sessao e da um ok
				if (!isset($_SESSION)){	session_start(); }
				$id = $array->id;
				// Sessao do login
				$_SESSION['authADM'] = $id;
				echo "logado";
			}else{
				// Destroi a sessao e da um erro
				echo "error";
			}
		}

		function LoginTR($user, $pass){

			// Conexao
			include ('key.php');

			$sql = $pdo->prepare("SELECT id FROM conf_usuarios WHERE user = ? AND password = ?");
			$sql->bindValue(1, $user);
			$sql->bindValue(2, $pass);
			$sql->execute();


			// Quantidade de registros encontrados
			$qtd = $sql->rowCount();


			if ($qtd > 0){
				$array = $sql->fetch(PDO::FETCH_OBJ);
				// Seta sessao e da um ok
				if (!isset($_SESSION)){	session_start(); }
				$id = $array->id;
				// Sessao do login
				$_SESSION['authTR'] = $id;
				echo "logado";
			}else{
				// Destroi a sessao e da um erro
				echo "error";
			}
		}

	}
?>