<?php 
  // Controladora geral
  include'../controler.php'; 

  // Controladora do blog
  include 'controler.blog.php';
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
   <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet"
      integrity="sha384-T8Gy5hrqNKT+hzMclPo118YTQO6cYprQmhrYwIiQ/3axmI1hQomh7Ud2hPOy8SP1" crossorigin="anonymous">
   <script src="//code.jquery.com/jquery-1.10.2.min.js"></script>
   <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
   <script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
   <style>
      .table {
         border: none;
      }

      .thumbnail .caption {
         padding: 9px;
         color: #333;
         height: 68px;
      }

      .thumbnail>img,
      .thumbnail a>img {
         margin-right: auto;
         margin-left: auto;
         height: 175px;
         width: 100%;
         object-fit: cover;
      }

      .table-definition thead th:first-child {
         pointer-events: none;
         background: white;
         border: none;
      }

      .table td {
         vertical-align: middle;
      }

      .page-item>* {
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

      .custom-checkbox .custom-control-input:checked~.custom-control-indicator {
         background-color: #84c7c1;
         background-image: none;
         box-shadow: none !important;
      }

      .custom-checkbox .custom-control-input:checked~.custom-control-indicator:after {
         background-color: #84c7c1;
         left: 15px;
      }

      .custom-checkbox .custom-control-input:focus~.custom-control-indicator {
         box-shadow: none !important;
      }

      .abrange2 {
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

      .btDin b {
         cursor: pointer;
      }

      .delCat b {
         cursor: pointer;
      }

      @media (max-width:748px) {
         .sales {
            background: #ffffff none repeat scroll 0 0;
            border: 1px solid #d4d9e3;
            display: inline-block;
            padding: 4px;
            padding-top: 10px;
            width: 100%;
            min-height: 0vh;
            height: auto;
            margin-top: 2%;
         }

         .col-xs-12 {
            width: 100%;
            padding: 0px;
         }

         .display-table-cell {
            display: table-cell;
            float: none;
            height: 100%;
            padding: 0;
         }

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
                        <h3 class="titulo-geral">PUBLICAÇÕES
                           <a class="pull-right" style="color: #2849a7;font-size: 47px;"
                              href="javascript:window.history.go(-1)">
                              <span class="fa fa-chevron-circle-left"></span>
                           </a>
                        </h3>
                        <br>

                        <div class="abrange2 corpo">
                           <form enctype="multipart/form-data" id="formNot" style="width: 100%">
                              <div class="col-md-4">
                                 <label style="color:#001246" for="">Titulo</label>
                                 <input maxlength="100" name="not-titulo" class="form-control tituloNot" type="text">
                              </div>
                              <div class="col-md-4">
                                 <label style="color:#001246" for="">Title</label>
                                 <input maxlength="400" name="title" class="form-control tituloNot" type="text">
                              </div>
                              <div class="col-md-4">
                                 <label style="color:#001246" for="">Slug</label>
                                 <input maxlength="400" name="slug" class="form-control tituloNot" type="text">
                              </div>
                              <div class="col-md-4">
                                 <label style="color:#001246" for="">Keywords</label>
                                 <input maxlength="400" name="keywords" class="form-control tituloNot" type="text">
                              </div>
                              <div class="col-md-4">
                                 <label style="color:#001246" for="">Description</label>
                                 <input maxlength="400" name="description" class="form-control tituloNot" type="text">
                              </div>
                              <div class="col-md-4 contIMG">
                                 <label style="color:#001246" for="">Imagem da publicação</label>
                                 <input name="not-imagem" class="form-control imagemNot" type="file">
                              </div>

                              <div class="col-md-12">
                                 &nbsp;
                              </div>

                              <div style="padding:0" class="col-md-4">
                                 <div class="col-md-9">
                                    <label style="color:#001246" for="">Categoria da publicação</label>
                                    <div class="dCat">
                                       <select onChange="VerificaValor(this.value)" id="categoria" name="categoria"
                                          class="form-control">
                                          <option value="">Selecione...</option>
                                          <?php
                                             $cat = $class->Select("*", "categorias", "", "");
                                             while($row = $cat->fetch(PDO::FETCH_OBJ)){
                                          ?>
                                          <option value="<?= $row->id ?>">
                                             <?= $row->categoria ?>
                                          </option>
                                          <?php
                                             }
                                          ?>
                                       </select>
                                    </div>
                                 </div>

                                 <div title="Adicionar Categoria" style="margin-top:33px;" class="col-md-1 btDin">
                                    <b onClick="Add()" id="addCat" class="fa fa-plus"></b>
                                 </div>

                                 <div title="Deletar Categoria" style="margin-top:33px; display:none"
                                    class="col-md-1 delCat">
                                    <b onClick="Remove()" id="removCat" class="fa fa-trash"></b>
                                 </div>



                              </div>

                              <div class="col-md-12">
                                 &nbsp;
                              </div>

                              <br>
                              <br><br>
                              <br>
                              <div class="col-md-8">
                                 <label style="color: #00134b;" for="">Descrição</label>
                                 <textarea class="descricaoNot" id="editor1" name="not-descricao"></textarea>
                              </div>
                              <div class="col-md-12">
                                 <div style="padding: 0px; margin-top: 1%" class="col-xs-3">
                                    <button id="btnNoticia" type="button"
                                       style="width: 100%; background-color: #449d44;" class=" btn btn-success">
                                       Publicar
                                    </button>
                                 </div>
                              </div>
                        </div>
                        </form>
                     </div>
                  </div>


                  <div class="col-md-12 col-sm-12 col-xs-12 gutter">
                     <div class="sales">
                        <h3 class="titulo-geral">ÚLTIMAS PUBLICAÇÕES</h3>
                        <div class="row">
                           <?php 
                                 $not = $class->Select("*", "blog", "ORDER BY hora_postagem DESC", " LIMIT 446");
                                 while ($row = $not->fetch(PDO::FETCH_OBJ)) {
                              ?>
                           <div class="col-md-3 col-sm-4 col-xs-6">
                              <a href="https://<?= $server ?>/detalhe-blog-adm/<?= $row->id ?>" class="thumbnail">
                                 <img src="https://<?= $server ?>/admin/_blog/<?= $row->img ?>"
                                    alt="<?= $row->titulo ?>">
                                 <div class="caption text-center">
                                    <h5>
                                       <?= $row->titulo ?>
                                    </h5>
                                 </div>
                              </a>
                           </div>
                           <?php } ?>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</body>

<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script type="text/javascript" src="https://<?= $server ?>/admin/_class/caminho_controler.js"></script>
<script type="text/javascript" src="https://<?= $server ?>/admin/_blog/js/main.js"></script>
</head>
<script>
   CKEDITOR.replace('editor1');
</script>
</body>

</html>