<?php 
   // controladora
   include'../controler.php'; 

   // Controladora do cliente
   include'controler.config.php'; 

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
      .material-switch > input[type="checkbox"] {
          display: none;   
      }

      .material-switch > label {
          cursor: pointer;
          height: 0px;
          position: relative; 
          width: 40px;  
      }

      .material-switch > label::before {
          background: rgb(0, 0, 0);
          box-shadow: inset 0px 0px 10px rgba(0, 0, 0, 0.5);
          border-radius: 8px;
          content: '';
          height: 16px;
          margin-top: -8px;
          position:absolute;
          opacity: 0.3;
          transition: all 0.4s ease-in-out;
          width: 40px;
      }
      .material-switch > label::after {
          background: rgb(255, 255, 255);
          border-radius: 16px;
          box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.3);
          content: '';
          height: 24px;
          left: -4px;
          margin-top: -8px;
          position: absolute;
          top: -4px;
          transition: all 0.3s ease-in-out;
          width: 24px;
      }
      .material-switch > input[type="checkbox"]:checked + label::before {
          background: inherit;
          opacity: 0.5;
      }
      .material-switch > input[type="checkbox"]:checked + label::after {
          background: inherit;
          left: 20px;
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
                              <h3 class="titulo-geral">CONFIGURAÇÕES DO CLIENTE</h3>

                              <form enctype="multipart/form-data" id="formFerramentas">
                                 <div style='margin-top:3%' class="col-md-6">                                 
                                    <label>Nome do cliente:</label>
                                    <input value="<?= (empty($rowC->cliente)) ? "" : $rowC->cliente ?>" id="nome_cl" class="form-control" type="text" name="nome_cliente">
                                 </div>

                                 <div style='margin-top:3%' class="col-md-6 contIMG">
                                    <label>Logo:</label>
                                    <?php
                                       if (empty($rowC->logo)){
                                    ?>
                                       <input id="logo_cliente" type="file" name="logo_empresa">
                                    <?php
                                       }else{
                                    ?>
                                       <input id="logo_cliente" type="file" name="logo_empresa">

                                       <div style='margin-top:3%' class="col-md-4">
                                          <img width="100%" style="object-fit:cover" src="https://<?= $server ?>/admin/@config/<?= $rowC->logo ?>" alt="">
                                       </div>                                       
                                    <?php
                                       }
                                    ?>
                                 </div>
                              </form>

                              <div style='margin-top:3%' class="col-md-12">
                                 <label>Painel Mobile:</label>
                                 <div class="material-switch">
                                     <input <?= ($rowC->mobile == '1') ? "checked" : "" ?> onChange="mudaMobile()" id="someSwitchOptionSuccess" name="painel_mobile" type="checkbox"/>
                                     <label for="someSwitchOptionSuccess" class="label-success"></label>
                                 </div>
                              </div>
                           </div>

                           <div class="col-md-12">
                              <buttom id="btnSalvarCl" type="button" class="btn btn-success pull-right">
                                 Salvar
                              </buttom> 
                           </div>
                        </div>
                     </div>                    
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- Modal -->
      <div id="add_project" class="modal fade" role="dialog">
         <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
               <div class="modal-header login-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Add Project</h4>
               </div>
               <div class="modal-body">
                  <input type="text" placeholder="Project Title" name="name">
                  <input type="text" placeholder="Post of Post" name="mail">
                  <input type="text" placeholder="Author" name="passsword">
                  <textarea placeholder="Desicrption"></textarea>
               </div>
               <div class="modal-footer">
                  <button type="button" class="cancel" data-dismiss="modal">Close</button>
                  <button type="button" class="add-project" data-dismiss="modal">Save</button>
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

   <script type="text/javascript">
      $(document).ready(function(e){
         $(".img-check").click(function(){
            $(this).toggleClass("check");
         });
      });
   </script>
   </body>
</html>