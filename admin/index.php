<?php 
  include('_class/caminho_controler.php');

  // Inicia a sessão
  if (!isset($_SESSION)){ session_start(); }

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

  // Verifica se a sessão está ativa
  if (!empty($_SESSION['authADM'])){
    header("location: https://$server/painel");
  }

  // informações do cliente
  $cliente = $class->Select("*", "conf_cliente", "", "");
  $dados = $cliente->fetch(PDO::FETCH_OBJ);
?>
<!DOCTYPE html>
<html lang="pt-br">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="initial-scale=1">
      <title>PAINEL ADMINISTRATIVO</title>
      <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
      <link rel="stylesheet" href="https://<?= $server ?>/admin/fontawesome/css/font-awesome.min.css">
      <link rel="stylesheet" href="https://<?= $server ?>/admin/css/index.css">
      <script src="//code.jquery.com/jquery-1.10.2.min.js"></script>
      <script type="text/javascript" src="https://<?= $server ?>/admin/_class/caminho_controler.js"></script>

   </head>
   <div class="loade"></div>
   <style> 

      .loade {
      position: fixed;
      left: 0px;
      top: 0px;
      width: 100%;
      height: 100%;
      z-index: 9999;
      background: url(img/pageLoader.gif) 50% 50% no-repeat rgb(255, 255, 255);
      background-size: 10%;
      }
      .home{
      background-image: url(../img/fundo.jpg);
      background-size: cover;
      }
.input-login {
    background: #ffffff;
    border-radius: 0px;
    border: none;
    border-bottom: 1px solid #a0a0a0;
}
      .icon-login {
      width: 20%;
      float: left;
      font-size: 26px;
      color: white;
      padding: 12px;
      border-bottom: 1px solid #9a9a9a;
      }

      ::-webkit-input-placeholder { /* Chrome/Opera/Safari */
      color: #adc2ff!important;
      }
      ::-moz-placeholder { /* Firefox 19+ */
      color: #adc2ff!important;
      }
      :-ms-input-placeholder { /* IE 10+ */
      color: #adc2ff!important;
      }
      :-moz-placeholder { /* Firefox 18- */
      color: #adc2ff!important;
      }
      .form-control {
      height: 51px;
      }
      .bt-entrar {
      width: 100%;
      height: 55px;
      background: #345ac6;
      border: 1px solid #003c98;
      margin-top: 6%;
      }
      .form-control:focus {
      border-color: #8f8f8f;
      outline: 0;
      -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075), 0 0 8px rgba(102,175,233,.6);
      box-shadow: inset 0 1px 1px rgba(0,0,0,.075), 0 0 8px rgb(13, 43, 130);
      }   @font-face {
      font-family:'roboto-bold';
      src: url(roboto/Roboto-Black.ttf);
      }
      @font-face {
      font-family:'roboto-regular';
      src: url(roboto/Roboto-light.ttf);
      }
      a {
      color: #FF9800;
      text-decoration: none;
      }
      a:hover {
      color: #ff6f6c;
      text-decoration: none;
      }
      .form-signin .form-control:focus {
      border-color: rgb(143, 143, 143);
      outline: 0;
      -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075), 0 0 8px rgb(104, 145, 162);
      box-shadow: inset 0 1px 1px rgba(0,0,0,.075), 0 0 8px rgba(255, 255, 255, 0);
      }
      .icon-web{
      width: 0%;
      position: absolute;
      top: 2%;
      font-size: 35px;
      right: 3%;
      z-index: 1;
      padding: 12px;
      color: white;
      }

     .errorL{
        display: none;
     }


     .successL{
        display: none;
     }
.icon-login {
    width: 20%;
    float: left;
    font-size: 26px;
    background: #ffffff;
    color: #00adee;
    padding: 12px;
    border-bottom: 1px solid #9a9a9a;
    padding-left: 35px;
}
.bt-entrar {
    width: 100%;
    height: 55px;
    background: #eb008b;
    border: 1px solid #eb008b;
    margin-top: 6%;
}


   </style>
   <body class="">
      <div style="padding:0px;" class="container-fluid">
      <i class="fa fa-globe icon-web" style=" position: absolute;" aria-hidden="true"></i>
      <div style="padding:0px;height: 100vh" class="home col-md-6">
         <div style="margin-top: 20vh;" class="col-md-6 col-md-offset-3">
            <img style="width: 475px;" src="https://<?= $server ?>/img/logo.svg" alt="">
            <h1 style="text-shadow: 2px 3px 2px #202262;font-family: 'roboto-bold';color: white;letter-spacing: 1.2px;font-size: 84px;">    
               Olá
            </h1>
            <h4 style="text-shadow: 2px 3px 2px #202262;font-family: inherit;;color:white;    line-height: 1.5;">
               Um forma única de compartilhar suas postagens, aqui você pode postar, editar e excluir. <br><br>

               Divirta-se!
            </h4>
         </div>
      </div>
      <div style="padding: 0px;
    background: #00adee;
    border-left: 5px solid #27112f;
    height: 100vh;" class="col-md-6">
         <div style="margin-top: 15vh;" class="col-md-6 col-md-offset-3">
            <form id="formL" class="form-signin mg-btm">
               <h3 style=" text-align: center; margin-top: 15%;color: white;" class="heading-desc">
                  <?php
                      if (empty($dados->logo)){
                   ?>
                   <img style="width: 123px;border-radius: 132px;padding: 3%;background: white;" src="img/logo.png" alt=""> <br>                   
                   <?php
                      }else{
                   ?>         
                    <img style="width: 123px;border-radius: 132px;padding: 3%;background: white;" src="https://<?= $server ?>/admin/@config/<?= $dados->logo ?>" alt=""> <br>
                   <?php
                      }
                   ?>

                  <b style="font-size:55px;">PAINEL</b> <br>ADMINISTRATIVO
               </h3>
               <div class="main">
                    <i class="fa fa-lock icon-login" style="width: 20%;" aria-hidden="true"></i>
                    <input id="userL" name="username" style="width: 80%;color: #4c3737;" type="text" class="form-control input-login" placeholder="Login" autofocus="">
                    <i class="fa fa-lock icon-login" style="width: 20%;" aria-hidden="true"></i>
                    <input id="passL" name="password" style="width: 80%;color: #4c3737;" type="password" class="form-control input-login" placeholder="Senha">
                    <div id="btLogin" style="line-height: 3.1;" class="bt-entrar btn btn-success">ENTRAR</div>
                
                    <div style="margin-top:20px" class="errorL alert alert-danger">
                      <strong>Oooops!</strong> Usuário ou senha Inválidos.
                    </div>

                    <div class="successL alert alert-success">
                      <strong>Logado!</strong> estamos redirecionando, aguarde...
                    </div>

               </div>
            </form>
         </div>
      </div>
   </body>
   
   <script type="text/javascript" src="https://<?= $server ?>/admin/js/login.js"></script>
   
    <script type="text/javascript">
      $(window).load(function() {
          $(".loade").fadeOut("medium");
      });
    </script>
</html>