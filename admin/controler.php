<?php
	include('_class/caminho_controler.php');

	// Inicia a sessão
	if (!isset($_SESSION)){	session_start(); }

	// Verifica em qual servidor está a aplicação
	$server = $_SERVER['SERVER_NAME'];
	if ($server == 'localhost'){
		$server = $_SERVER['SERVER_NAME'].'/'.$nome_da_pasta;
	}else{
		$server = $_SERVER['SERVER_NAME'];
	}

	// Verifica se está logado
	(empty($_SESSION['authADM'])) ? header("location: https://$server/admin") : "" ;

	

	// instancia a classe de ações
	include('_class/model.class.php');
	$class = new Action;

?>