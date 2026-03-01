<?php 
   // Controladora geral
   include'../controler.php'; 
   
   // Controladora da agenda
   require_once 'controler.agenda.php';
   ?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="robots" content="noindex, nofollow">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="icon" type="image/png" href="img/fav.png" />
      <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
      <link rel="stylesheet" href="https://<?= $server ?>/admin/css/painel.css">
      <link rel="stylesheet" href="https://<?= $server ?>/admin/css/desktop.css">
      <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-T8Gy5hrqNKT+hzMclPo118YTQO6cYprQmhrYwIiQ/3axmI1hQomh7Ud2hPOy8SP1" crossorigin="anonymous">
      <script  src="//code.jquery.com/jquery-1.10.2.min.js" ></script>
      <script src="https://<?= $server ?>/admin/ckeditor/ckeditor.js"></script>
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
         width: 100%;
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
         .tamanho-fo-bag {
         height: 380px;
         overflow-y: scroll;
         padding-right: 4%;
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
         .col-md-3 {
         width: 25%;
         margin-bottom: 42px;
         }
      </style>
   <body class="home">
      <div class="container-fluid display-table">
         <div class="row display-table-row">
            <?php include'../includes/menu.php' ?>
            <div class="col-md-10 col-sm-11 display-table-cell v-align">
               <div class="user-dashboard">
                  <div class="row">
                     <div class="col-md-12 col-sm-12 col-xs-12 gutter">
                        <div class="sales">
                           <h3 class="titulo-geral">EDITAR AGENDAMENTO
                              <a class="pull-right" style="color: #2849a7;font-size: 47px;" href="javascript:window.history.go(-1)">
                              <span class="fa fa-chevron-circle-left"></span>
                              </a>
                           </h3>
                           <br>
                           <div style="padding-left: 0px;" class="col-md-4">
                              <a href="">
                                 <div style="padding-left: 0px;" class="col-md-12">
                                    <div class="tamanho-fo-bag">
                                       <label style=" font-size: 21px;margin-top: 8px;" for=""><?= $rowN->titulo ?> <br></label>
                                       <h5 style="    line-height: 17.1px;color: #8c8c8c;">   <?= $rowN->descricao ?>
                                       </h5>
                                    </div>
                                 </div>
                              </a>
                           </div>
                           <div class="abrange2 corpo">
                            <form id="attAgendamento" method="post">
                              <input type="hidden" name="idAg" value="<?= $rowN->id ?>">
                              <div class="col-md-3">
                                 <label style="color:#001246" for="">Titulo </label>
                                 <input id="titulo" maxlength="50" name="att-titulo" value="<?= $rowN->titulo ?>" class="form-control" type="text">
                              </div>


                              <div class="col-md-3">
                                 <label style="color:#001246" for="">Data</label>
                                 <input id="data" name="att-data" value="<?= $rowN->data ?>" class="form-control" type="date">
                              </div>


                              <div class="col-md-2">
                                 <label style="color:#001246" for="">Hora</label>
                                 <input name="att-hora" value="<?= $rowN->horario ?>" class="form-control" type="time">
                              </div>


                              <br>  
                              <br>
                              <br>  
                              <br>

                              <div class="col-md-8">
                                <label style="color: #00134b;" for="">Descrição</label>
                                <textarea name="att-descricao" id="editor1"><?= $rowN->descricao ?></textarea>
                              </div>

                              <div class="col-md-12">
                                 <div style="padding: 0px; margin-top: 1%" class="pull-right col-xs-3">
                                    <button id="att_agendamento" type="button" style="width: 100%;background-color: #449d44;" class=" btn btn-success">
                                    Atualizar
                                    </button>
                                 </div>
                                 <div style="padding: 0px; margin-top: 1%;    margin-right: 9px" class="pull-right col-xs-3">
                                    <button onClick="deletaAgendamento(<?= $rowN->id ?>)" type="button" style="width: 100%;background: #F44336;" class="btn btn-primary">Excluir Agendamento</button>
                                 </div>
                              </div>
                            </form>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-12 col-sm-12 col-xs-12 gutter">
                        <div class="sales">
                           <div style="width: 100%" class="abrange2 corpo">
                              <h3 class="titulo-geral">ÚLTIMOS AGENDAMENTOS </h3>
                              <br>   

                              <?php
                                $agendamentos = $class->Select("*", "agenda", "ORDER BY id DESC", "LIMIT 8");
                                while($row = $agendamentos->fetch(PDO::FETCH_OBJ)){

                                  // Limita os caracteres
                                  $tam = strlen($row->descricao);
                                  ($tam > 59) ? $rets = "..." : $rets = "";

                                  // Formata a Data
                                  $data = new DateTime($row->data);
                                  $dataF = $data->format("d/m/Y");
                              ?> 
                                <div style="cursor:pointer;padding-left: 0px;" class="col-md-3">
                                   <a style="cursor:pointer" href="https://<?= $server ?>/agendamento/<?= $row->id ?>">
                                   <label style="cursor:pointer"><?= substr($row->titulo, 0, 59).$rets ?> <br>
                                   </label></a>
                                   <small><?= $dataF ?></small>
                                   <br><br>
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
   <script type="text/javascript" src="https://<?= $server ?>/admin/_agenda/js/main.js"></script>
   </head>
   <script>
      CKEDITOR.replace( 'editor1' );
   </script>
   </body>
</html>