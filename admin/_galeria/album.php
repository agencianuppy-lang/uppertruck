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
         .col-md-6 {
         width: 50%;
         padding-left: 0px;
         margin-top: -31px;
         }
         .modal {
         top: 0%;
         }
      </style>


      <!-- Modal -->
      <?php 
         // Ultimos albuns
         $idAlbM = $_GET['album'];
         $albunsM = $class->Select("*", "fotos", "WHERE id_album = '".$idAlbM."'", "ORDER BY id_img DESC");
         while ($rowM = $albunsM->fetch(PDO::FETCH_OBJ)){
      ?>
      <div style="z-index: 999999;" class="modal fade" id="myModal<?= $rowM->id_img ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
         <div class="modal-dialog">
            <div class="modal-content">
               <div class="modal-header">
                  <buttom type="buttom" class="close" data-dismiss="modal" aria-hidden="true">×</buttom>
                  <h3 style="text-align: center;">
                     <img class="foto-galeriax"  src="https://<?= $server ?>/admin/_galeria/<?= $rowM->arquivo ?>" alt="">
                  </h3>
               </div>
               <div style="text-align: center;" class="modal-body">
                  <img style="width: 16%;" src="https://<?= $server ?>/admin/img/excluir-foto.svg" alt=""> <br>
                  <h4>DESEJA EXCLUIR ESSA FOTO? <br><br></h4>
                  <buttom data-dismiss="modal" aria-hidden="true" style="width: 40%;" class="btn btn-default">Cancelar</buttom>
                  <buttom onClick="deletaFoto(<?= $rowM->id_img ?>)" type="button" style="width: 50%;" class="btn btn-primary">SIM</buttom>
               </div>
            </div>
         </div>
      </div>
      <?php
         }
      ?>
      <!--END MODAL-->


   <body class="home">
      <div class="container-fluid display-table">
         <div class="row display-table-row">
            <?php include'../includes/menu.php'; ?>
            <div class="col-md-10 col-sm-11 display-table-cell v-align">
               <div class="user-dashboard">
                  <div class="row">
                     <div class="col-md-12 col-sm-12 col-xs-12 gutter">
                        <div class="sales">
                           <h3 class="titulo-geral">GERENCIAMENTO
                              <span onClick="deletaAlbum(<?= $_GET['album'] ?>)" style="color: #9e0f0f;font-size: 47px; cursor:pointer" class="fa fa-trash pull-right"></span>

                              <a class="pull-right" style="color: #2849a7;font-size: 47px;" href="javascript:window.history.go(-1)">
                                 <span class="fa fa-chevron-circle-left"></span>
                              </a>  
                           </h3>
                           <br>
                           <div class="abrange2 corpo">
                              <form enctype="multipart/form-data" method="post" id="uploadFT">
                                 <input type="hidden" name="id_album" value="<?= $_GET['album'] ?>">
                                 <div class="col-md-6">
                                   <label for="addFT">
                                     <buttom class="btn btn-default moldura-album" type="">
                                        <img width="100%" class="foto-galeriax" src="https://<?= $server ?>/admin/img/mais2.svg" alt="">
                                     </buttom>
                                   </label>
                                    <input multiple onchange="Upload()" style="display:none" id="addFT" type="file" name="fotos[]">
                                 </div>
   
                                 <div class="col-md-6">
                                    <a href="https://<?= $server ?>/editar-album/<?= $_GET['album'] ?>">
                                       <buttom class="btn btn-default moldura-album" type="">
                                          <img width="100%" class="foto-galeriax" src="https://<?= $server ?>/admin/img/editar-album.svg" alt="">
                                       </buttom>
                                    </a>
                                 </div>

                                 <div class="col-md-12">
                                    &nbsp;
                                 </div>
                                 
                                 <div style='padding:0;display:none' class="col-md-12 carregamento">
                                    Carregando <b id='progressB'>0%</b> <br>
                                    <progress style="width:100%" id="progressbar" value="0" max="100"></progress>
                                 </div>

                                 <div style='padding:0' class="col-md-12">
                                    <b>Obs: para deletar uma foto, basta clicar sobre a foto e confirmar a exclusão.</b>
                                 </div>
                                 

                              </form>
                           </div>

                        </div>
                     </div>
                     <div class="col-md-12 col-sm-12 col-xs-12 gutter">
                        <div class="sales">
                           <h3 class="titulo-geral">
                              <b><?= $rowA->titulo.' - <small>'.$class->SelectQtd("id_img", "fotos", "WHERE id_album = '".$_GET['album']."'"); ?> foto(s)</small> <br>
                                 <small style="color: #7b7b7b; font-weight: bold;letter-spacing: 1.1px;">
                                    <?= $gal->FormataData($rowA->data) ?>
                                 </small>
                              </b>
                           </h3>
                           <div style="width: 100%"  class="abrange2">
                              <?php 
                                 // Ultimos albuns
                                 $idAlb = $_GET['album'];
                                 $albuns = $class->Select("*", "fotos", "WHERE id_album = '".$idAlb."'", "ORDER BY id_img DESC");
                                 while ($row = $albuns->fetch(PDO::FETCH_OBJ)){
                              ?>

                              <a href="#myModal<?= $row->id_img ?>" data-toggle="modal">
                                 <div class="col-md-2">
                                    <div class="btn btn-default moldura-album" type="">
                                       <img width="100%" class="foto-galeriax" src="https://<?= $server ?>/admin/_galeria/<?= $row->arquivo ?>" alt="">
                                    </div>
                                 </div>
                              </a>

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