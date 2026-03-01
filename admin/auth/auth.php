<?php
	// Instancia da classe de acoes
	include('class/model.class.php');
	$class = new Action;

	if (!empty($_POST['username']) &&
		!empty($_POST['password'])){

		$user = $_POST['username'];
		$pass = $_POST['password'];
		$class->Login($user, $pass);
	}
?>

