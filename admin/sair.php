<?php 
  // Inicia a sessão
  if (!isset($_SESSION)){ session_start(); }

  // Destroi a sessão
  session_destroy();

  // inclui a config
  include('_class/caminho_controler.php');

  // Verifica em qual servidor está a aplicação
  $server = $_SERVER['SERVER_NAME'];
  if ($server == 'localhost'){
    $server = $_SERVER['SERVER_NAME'].'/'.$nome_da_pasta;
  }else{
    $server = $_SERVER['SERVER_NAME'];
  }

  // redireciona
  header("location: https://$server/config");
?>