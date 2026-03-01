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


	// instancia a classe de ações
	include('_class/model.class.php');
	$class = new Action;

?>