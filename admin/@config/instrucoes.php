<?php 
   // controladora
   include'../controler.php'; 

   // Verifica se a sessão está ativa
  if (empty($_SESSION['authTR'])){
    header("location: https://$server/config");
  }
?>
<!DOCTYPE html>
<html lang="pt-br">
   <head>
      <meta charset="utf-8">
      <meta name="robots" content="noindex, nofollow">
      <title>Painel Administrativo</title>
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
      <link rel="stylesheet" href="https://<?= $server ?>/admin/css/painel.css">
      <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-T8Gy5hrqNKT+hzMclPo118YTQO6cYprQmhrYwIiQ/3axmI1hQomh7Ud2hPOy8SP1" crossorigin="anonymous">
      <script src="//code.jquery.com/jquery-1.10.2.min.js"></script>
      <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
   </head>
   <div style="display:block" class="loade"></div>
   <style>
      .loade {
      position: fixed;
      left: 0px;
      top: 0px;
      width: 100%;
      height: 100%;
      z-index: 9999;
      background: url(admin/img/pageLoader.gif) 50% 50% no-repeat #ffffff;
      background-size: 10%;
      }
      @font-face {
      font-family: 'roboto-bold';
      src: url(roboto/Roboto-Black.ttf);
      }
      @font-face {
      font-family: 'roboto-regular';
      src: url(roboto/Roboto-regular.ttf);
      }
      .check
      {
          opacity:0.5;
         color:#996;
         
      }
      /***
      Bootstrap Line Tabs by @keenthemes
      A component of Metronic Theme - #1 Selling Bootstrap 3 Admin Theme in Themeforest: https://j.mp/metronictheme
      Licensed under MIT
      ***/

      /* Tabs panel */
      .tabbable-panel {
        border:1px solid #eee;
        padding: 10px;
      }

      /* Default mode */
      .tabbable-line > .nav-tabs {
        border: none;
        margin: 0px;
      }
      .tabbable-line > .nav-tabs > li {
        margin-right: 2px;
      }
      .tabbable-line > .nav-tabs > li > a {
        border: 0;
        margin-right: 0;
        color: #737373;
      }
      .tabbable-line > .nav-tabs > li > a > i {
        color: #a6a6a6;
      }
      .tabbable-line > .nav-tabs > li.open, .tabbable-line > .nav-tabs > li:hover {
        border-bottom: 4px solid #fbcdcf;
      }
      .tabbable-line > .nav-tabs > li.open > a, .tabbable-line > .nav-tabs > li:hover > a {
        border: 0;
        background: none !important;
        color: #333333;
      }
      .tabbable-line > .nav-tabs > li.open > a > i, .tabbable-line > .nav-tabs > li:hover > a > i {
        color: #a6a6a6;
      }
      .tabbable-line > .nav-tabs > li.open .dropdown-menu, .tabbable-line > .nav-tabs > li:hover .dropdown-menu {
        margin-top: 0px;
      }
      .tabbable-line > .nav-tabs > li.active {
        border-bottom: 4px solid #f3565d;
        position: relative;
      }
      .tabbable-line > .nav-tabs > li.active > a {
        border: 0;
        color: #333333;
      }
      .tabbable-line > .nav-tabs > li.active > a > i {
        color: #404040;
      }
      .tabbable-line > .tab-content {
        margin-top: -3px;
        background-color: #fff;
        border: 0;
        border-top: 1px solid #eee;
        padding: 15px 0;
      }
      .portlet .tabbable-line > .tab-content {
        padding-bottom: 0;
      }

      /* Below tabs mode */

      .tabbable-line.tabs-below > .nav-tabs > li {
        border-top: 4px solid transparent;
      }
      .tabbable-line.tabs-below > .nav-tabs > li > a {
        margin-top: 0;
      }
      .tabbable-line.tabs-below > .nav-tabs > li:hover {
        border-bottom: 0;
        border-top: 4px solid #fbcdcf;
      }
      .tabbable-line.tabs-below > .nav-tabs > li.active {
        margin-bottom: -2px;
        border-bottom: 0;
        border-top: 4px solid #f3565d;
      }
      .tabbable-line.tabs-below > .tab-content {
        margin-top: -10px;
        border-top: 0;
        border-bottom: 1px solid #eee;
        padding-bottom: 15px;
      }
   </style>
   <body class="home">
      <div class="container-fluid display-table">
         <div class="row display-table-row">
            <?php include'../includes/menu_config.php'; ?>
            <div style="padding: 0px;" class="col-md-10 col-sm-11 display-table-cell v-align">
               <div class="user-dashboard">
                  <div class="row">
                     <div class="col-md-12 col-sm-12 col-xs-12 gutter">
                        <div class="sales">
                           <div class="abrange2">
                              <h3 class="titulo-geral">INSTRUÇÕES DE USO</h3>
                              <?php include('includes/instrucoes_de_uso.php'); ?>
                              <form id="formFerramentas">
                                 <?php 
                                    $ferramentas = $class->Select("*", "conf_ferramentas", "", "ORDER BY id ASC");
                                    while($rowFe = $ferramentas->fetch(PDO::FETCH_OBJ)){
                                 ?>
                                    <a download href="https://<?= $server ?>/admin/@config/examples/<?= $rowFe->exemplo.'.rar'; ?>">
                                       <div style='margin-top:3%' class="col-md-2">                                       
                                          <label style="cursor:pointer; padding:10px; border:1px solid #ccc; border-radius:5px" class="moldura-album" type="">
                                             <img width="100%" class="foto-galeriax img-check" src="<?= $rowFe->icone ?>" alt="">
                                          </label>

                                          <h4 class="titulo-album" for="">
                                             <?= $rowFe->ferramenta ?>
                                          </h4>
                                       </div>
                                    </a>
                                 <?php
                                    }
                                 ?>


                                 <a download href="https://<?= $server ?>/admin/@config/examples/contato.rar">
                                     <div style='margin-top:3%' class="col-md-2">                                       
                                        <label style="cursor:pointer; padding:10px; border:1px solid #ccc; border-radius:5px" class="moldura-album" type="">
                                           <img width="100%" class="foto-galeriax img-check" src="admin/img/contacts.svg" alt="">
                                        </label>

                                        <h4 class="titulo-album" for="">
                                           Contato
                                        </h4>
                                     </div>
                                  </a>

                                  <a download href="https://<?= $server ?>/admin/@config/examples/exemplos.rar">
                                     <div style='margin-top:3%' class="col-md-2">                                       
                                        <label style="cursor:pointer; padding:10px; border:1px solid #ccc; border-radius:5px" class="moldura-album" type="">
                                           <img width="100%" class="foto-galeriax img-check" src="admin/img/rar.svg" alt="">
                                        </label>

                                        <h4 class="titulo-album" for="">
                                           Todos os Exemplos
                                        </h4>
                                     </div>
                                  </a>
                              </form>
                           </div>
                        </div>
                     </div>                    
                  </div>
               </div>
            </div>
         </div>
      </div>
   </body>
   <script  src="//code.jquery.com/jquery-1.10.2.min.js" ></script>
   <script  src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js" ></script>
   <script type="text/javascript" src="https://<?= $server ?>/admin/_class/caminho_controler.js"></script>
   <script type="text/javascript" src="https://<?= $server ?>/admin/@config/js/main.js"></script>
   <script type="text/javascript">
      $(window).load(function() {
          $(".loade").fadeOut("medium");
      });
   </script>
   </body>
</html>