<?php 
   // Controladora geral
   include'../controler.php'; 
   
   // Controladora da agenda
   require_once 'controler.banner.php';
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
      <script  src="//code.jquery.com/jquery-1.10.2.min.js" ></script>
      <script src="https://<?= $server ?>/admin/ckeditor/ckeditor.js"></script>
      <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

      <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-T8Gy5hrqNKT+hzMclPo118YTQO6cYprQmhrYwIiQ/3axmI1hQomh7Ud2hPOy8SP1" crossorigin="anonymous">
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
         label {
         display: inline-block;
         max-width: 100%;
         width: 100%;
         margin-bottom: 5px;
         font-weight: 700;
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
         width: 90%;
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
         .modal {
         top: 1%;
         }
      </style>
   
   <?php 
      // Modal do pc
      include('includes/modal-pc.php');

      // Modal do mobile
      include('includes/modal-mb.php');
   ?>   

   <body class="home">
      <div class="container-fluid display-table">
         <div class="row display-table-row">
            <?php include'../includes/menu.php' ?>
            <div class="col-md-10 col-sm-11 display-table-cell v-align">
               <div class="user-dashboard">
                  <div class="row">
                     <div class="col-md-12 col-sm-12 col-xs-12 gutter">
                        <div class="sales">
                           <h3 class="titulo-geral">Banners</h3>
                           <br>  
                           <div class="abrange2">
                              <h5 class="obs"><b>Obs:</b> Cada banner precisa ter 2 versões diferentes de imagem: uma para versão de computador e uma para versão de celular</h5>
                              <br>
                              <div style="border: 1px solid #dadada;padding: 1%;border-radius: 7px;" class="col-md-6">
                                 <div style="padding-right: 2%" class="col-xs-6">
                                    <img style="width: 35%;    margin-left: 34%;" src="img/desktop.svg " alt=""><br>
                                    <label style="text-align:center; color: #00134b; width: 100%;" for="">Banner Computador</label>
                                    <?php 
                                    ############################### 1º BANNER ###############################

                                       $bannerPC = $class->Select("pos", "banner", "WHERE tipo = '1' AND pos = '1'", "");
                                       $pc1 = $bannerPC->fetch(PDO::FETCH_OBJ);

                                       if ($pc1 == ''){
                                    ?>
                                       <form id="pc1" method="post">
                                          <input onchange="UploadPC(1)" name="banner_pc1" class="form-control" type="file"><br>
                                       </form>  
                                    <?php 
                                       }else{
                                          echo "Banner 1 - <b class='fa fa-check'></b><hr>";
                                       }
                                    
                                    #########################################################################



                                    ############################### 2º BANNER ###############################

                                       $bannerPC2 = $class->Select("banner", "banner", "WHERE tipo = '1' AND pos = '2'", "");
                                       $pc2 = $bannerPC2->fetch(PDO::FETCH_OBJ);

                                       if ($pc2 == ''){
                                    ?>

                                       <form id="pc2" method="post">
                                          <input onchange="UploadPC(2)" name="banner_pc2" class="form-control" type="file"><br> 
                                       </form>

                                    <?php 
                                       }else{
                                          echo "Banner 2 - <b class='fa fa-check'></b><hr>";
                                       }


                                    #########################################################################


                                    ############################### 3º BANNER ###############################
                                    ?>

                                    <?php 
                                       $bannerPC3 = $class->Select("banner", "banner", "WHERE tipo = '1' AND pos = '3'", "");
                                       $pc3 = $bannerPC3->fetch(PDO::FETCH_OBJ);

                                       if ($pc3 == ''){
                                    ?>

                                       <form id="pc3" method="post">
                                          <input onchange="UploadPC(3)" name="banner_pc3" class="form-control" type="file"><br> 
                                       </form>

                                    <?php 
                                       }else{
                                          echo "Banner 3 - <b class='fa fa-check'></b><br>";
                                       }

                                    #########################################################################
                                    ?>
                                 </div>









                                 <!-- ##################### BANNER DO CELULAR ABAIXO  #####################-->

                                 <div style="padding-right: 2%" class="col-xs-6">
                                    <img style="width: 35%;    margin-left: 34%;" src="img/smartphone.svg" alt=""><br>
                                    <label style="text-align:center; color: #00134b; width: 100%;" for="">Banner celular</label>
                                    
                                    <?php 
                                    ############################### 1º BANNER ###############################

                                       $bannerMB = $class->Select("pos", "banner", "WHERE tipo = '2' AND pos = '1'", "");
                                       $mb1 = $bannerMB->fetch(PDO::FETCH_OBJ);

                                       if ($mb1 == ''){
                                    ?>
                                       <form id="mb1" method="post">
                                          <input onchange="UploadMB(1)" name="banner_mb1" class="form-control" type="file"><br>
                                       </form>  
                                    <?php 
                                       }else{
                                          echo "Banner 1 - <b class='fa fa-check'></b><hr>";
                                       }
                                    
                                    #########################################################################



                                    ############################### 2º BANNER ###############################

                                       $bannerMB2 = $class->Select("banner", "banner", "WHERE tipo = '2' AND pos = '2'", "");
                                       $pc2 = $bannerMB2->fetch(PDO::FETCH_OBJ);

                                       if ($pc2 == ''){
                                    ?>

                                       <form id="mb2" method="post">
                                          <input onchange="UploadMB(2)" name="banner_mb2" class="form-control" type="file"><br>
                                       </form> 

                                    <?php 
                                       }else{
                                          echo "Banner 2 - <b class='fa fa-check'></b><hr>";
                                       }


                                    #########################################################################


                                    ############################### 3º BANNER ###############################
                                    ?>

                                    <?php 
                                       $bannerMB3 = $class->Select("banner", "banner", "WHERE tipo = '2' AND pos = '3'", "");
                                       $mb3 = $bannerMB3->fetch(PDO::FETCH_OBJ);

                                       if ($mb3 == ''){
                                    ?>

                                       <form id="mb3" method="post">
                                          <input onchange="UploadMB(3)" name="banner_mb3" class="form-control" type="file"><br> 
                                       </form>

                                    <?php 
                                       }else{
                                          echo "Banner 3 - <b class='fa fa-check'></b><br>";
                                       }

                                    #########################################################################
                                    ?>
                                 </div>

                                 <!-- <div style="padding:0px;" class="pull-right col-xs-5">
                                    <button style="margin-top: 12%;width: 100%;background:#2849a7;" class="btn btn-primary">Salvar</button>
                                 </div> -->
                              </div>


                              <div class="col-md-6">
                                 <div style="padding:0px;" class="col-xs-12">
                                    <h5 style="margin-bottom: 0px">Computador <small>(Desktop)</small></h5>
                                    <?php
                                       $pcBanners = $class->Select("id, banner", "banner", "WHERE tipo = '1'", "ORDER BY pos ASC LIMIT 3");
                                       while($pcB = $pcBanners->fetch(PDO::FETCH_OBJ)){
                                    ?>                                    
                                       <div style="padding: 1%" class="col-xs-4">
                                          <a href="#myModalPc<?= $pcB->id ?>" data-toggle="modal"> 
                                             <img style="width: 100%" class="thumbnail" src="https://<?= $server ?>/admin/_banners/<?= $pcB->banner ?>" alt=""> 
                                          </a>
                                       </div>
                                    <?php
                                       }
                                    ?>
                                 </div>
                                 <div style="padding:0px;" class="col-xs-12">
                                    <h5 style="margin-bottom: 0px">Celular <small>(Mobile)</small></h5>
                                    <?php
                                       $mbBanners = $class->Select("id, banner", "banner", "WHERE tipo = '2'", "ORDER BY pos ASC LIMIT 3");
                                       while($pcM = $mbBanners->fetch(PDO::FETCH_OBJ)){
                                    ?>                                    
                                       <div style="padding: 1%" class="col-xs-4">
                                          <a href="#myModalMob<?= $pcM->id ?>" data-toggle="modal"> 
                                             <img style="width: 100%" class="thumbnail" src="https://<?= $server ?>/admin/_banners/<?= $pcM->banner ?>" alt=""> 
                                          </a>
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
         </div>
      </div>
   </body>
   <script  src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js" ></script>
<script type="text/javascript" src="https://<?= $server ?>/admin/_class/caminho_controler.js"></script>
   <script type="text/javascript" src="https://<?= $server ?>/admin/_banners/js/main.js"></script>
   </head>
   </body>
</html>