<?php 
  // Controler geral
  include '../controler.php';

  // Controler da galeria
  include 'controler.galeria.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
   <head>
      <meta charset="utf-8">
      <meta name="robots" content="noindex, nofollow">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="icon" type="image/png" href="img/fav.png" />
      <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
      <link rel="stylesheet" href="https://<?= $server ?>/admin/css/painel.css">
      <link rel="stylesheet" href="https://<?= $server ?>/admin/css/desktop.css">
      <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-T8Gy5hrqNKT+hzMclPo118YTQO6cYprQmhrYwIiQ/3axmI1hQomh7Ud2hPOy8SP1" crossorigin="anonymous">
      <script src="//code.jquery.com/jquery-1.10.2.min.js"></script>
      <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

      <style>
         .table {
         border: none;
         }
         .table-definition thead th:first-child {
         pointer-events: none;
         background: white;
         border: none;
         }
         .table td {
         vertical-align: middle;
         }
         .page-item > * {
         border: none;
         }
         .custom-checkbox {
         min-height: 1rem;
         padding-left: 0;
         margin-right: 0;
         cursor: pointer; 
         }
         .custom-checkbox .custom-control-indicator {
         content: "";
         display: inline-block;
         position: relative;
         width: 30px;
         height: 10px;
         background-color: #818181;
         border-radius: 15px;
         margin-right: 10px;
         -webkit-transition: background .3s ease;
         transition: background .3s ease;
         vertical-align: middle;
         margin: 0 16px;
         box-shadow: none; 
         }
         .custom-checkbox .custom-control-indicator:after {
         content: "";
         position: absolute;
         display: inline-block;
         width: 18px;
         height: 18px;
         background-color: #f1f1f1;
         border-radius: 21px;
         box-shadow: 0 1px 3px 1px rgba(0, 0, 0, 0.4);
         left: -2px;
         top: -4px;
         -webkit-transition: left .3s ease, background .3s ease, box-shadow .1s ease;
         transition: left .3s ease, background .3s ease, box-shadow .1s ease; 
         }
         .custom-checkbox .custom-control-input:checked ~ .custom-control-indicator {
         background-color: #84c7c1;
         background-image: none;
         box-shadow: none !important; 
         }
         .custom-checkbox .custom-control-input:checked ~ .custom-control-indicator:after {
         background-color: #84c7c1;
         left: 15px; 
         }
         .custom-checkbox .custom-control-input:focus ~ .custom-control-indicator {
         box-shadow: none !important; 
         }
         .abrange2{
         width: 30%;
         }
         .sales {
         background: #ffffff none repeat scroll 0 0;
         border: 1px solid #d4d9e3;
         display: inline-block;
         padding: 32px;
         padding-top: 10px;
         width: 100%;
         min-height: 0vh;
         height: auto;
         margin-top: 2%;
         }
         .col-md-2 {
         width: 16.66666667%;
         padding-left: 0px;
         }
         .moldura-album {
         position: relative;
         margin-top: 11%;
         padding-top: 3%;
         width: 10vmax;
         height: 9vmax;
         max-height: 9vmax;
         padding: 2%;
         }
         .foto-galeriax {
         width: 100%;
         margin-top: 0%;
         margin-left: 0%;
         border-radius: 3px;
         max-height: 100%;
         height: 100%;
         object-fit: cover;
         }
      </style>
   <body class="home">
      <div class="container-fluid display-table">
         <div class="row display-table-row">
            <?php include '../includes/menu.php'; ?>
            <div class="col-md-10 col-sm-11 display-table-cell v-align">
               <div class="user-dashboard">
                  <div class="row">
                     <div class="col-md-12 col-sm-12 col-xs-12 gutter">
                        <div class="sales">
                           <h3 class="titulo-geral">CRIAR ALBUM  
                              <a class="pull-right" style="color: #2849a7;font-size: 47px;" href="javascript:window.history.go(-1)">
                              <span class="fa fa-chevron-circle-left"></span>
                              </a>
                           </h3>
                           <br>
                           <div class="abrange2 corpo">
                            <form id="FormA">
                                <label style="color:#001246" for="">Nome do album</label>
                                <input id="nomeAlb" required maxlength="100" name="nome-album" class="form-control inpAlbum" type="text">

                                <br>

                                <label style="color:#001246" for="">Data do album</label>
                                <input id="dataAlb" required name="data-album" class="form-control inpAlbum" type="date">

                                <div style="padding: 0px; margin-top: 5%" class="col-xs-6">
                                  <a href="https://<?= $server ?>/galeria_adm">
                                    <button type="button" style="width: 95%" class="btn btn-primary">
                                       Cancelar
                                    </button>
                                  </a>
                                </div>

                                <div style="padding: 0px; margin-top: 5%" class="col-xs-6">
                                  <button id="cadAlb" type="button" style="width: 100%; background-color: #449d44;" class="btn btn-success">
                                   Salvar
                                  </button>
                                </div>

                              </form>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-12 col-sm-12 col-xs-12 gutter">
                        <div class="sales">
                           <div style="width: 100%" class="abrange2 corpo">
                              <h3 class="titulo-geral">ÚLTIMOS ALBUNS </h3>
                              <?php 
                                // Ultimos albuns
                                $albuns = $class->Select("*", "albuns", "", "ORDER BY id DESC LIMIT 12");
                                while ($row = $albuns->fetch(PDO::FETCH_OBJ)){

                                   // Quantidade de fotos no album
                                   $qtdIMG = $class->SelectQtd("arquivo", "fotos", "WHERE id_album = '".$row->id."'");

                                   /* Se tiver foto no album, pega a ultima e define como capa,
                                      caso nao tenha, exibe uma foto padrao
                                   */
                                   if ($qtdIMG != 0){
                                      $SeImg = $class->Select("arquivo", "fotos", "WHERE id_album = '".$row->id."'", "ORDER BY id_img DESC LIMIT 1");
                                      $arrayIMG = $SeImg->fetch(PDO::FETCH_OBJ);
                                      $img = 'admin/_galeria/'.$arrayIMG->arquivo;
                                   }else{
                                      $img = "admin/img/nophoto.png";
                                   }
                              ?>

                              <div  class="col-md-2">
                                 <a href="https://<?= $server ?>/album/<?= $row->id ?>">
                                    <buttom class="btn btn-default moldura-album" type="">
                                       <img width="100%" class="foto-galeriax" src="https://<?= $server ?>/<?= $img ?>" alt="">
                                    </buttom>
                                 </a>
                                 <h4 class="titulo-album" for="">
                                    <?= $row->titulo ?> <br> 
                                    <small style="position: absolute;left: 42%;;bottom: -2%;">
                                       <?= $qtdIMG ?> foto(s)
                                    </small>
                                 </h4>
                              </div>

                              <?php
                                 }
                              ?>

                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </body>
   
    <script  src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js" ></script>
    <script type="text/javascript" src="https://<?= $server ?>/admin/_class/caminho_controler.js"></script>
    <script type="text/javascript" src="https://<?= $server ?>/admin/_galeria/js/main.js"></script>
   </head>
   <script type="text/javascript">
      $(document).ready(function(){
         $('[data-toggle="offcanvas"]').click(function(){
            $("#navigation").toggleClass("hidden-xs");
         });
      });
   </script>
   </body>
</html>