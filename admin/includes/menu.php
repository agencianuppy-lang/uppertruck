<title>Painel Administrativo</title>
<style>
   .dropdown-submenu{position:relative;}
   .dropdown-submenu>.dropdown-menu {
   top: 0;
   left: 100%;
   margin-top: -90px;
   margin-left: -1px;
   -webkit-border-radius: 0 6px 6px 6px;
   -moz-border-radius: 0 6px 6px 6px;
   border-radius: 0 6px 6px 6px;
   }
   .dropdown-submenu:hover>.dropdown-menu{display:block;}
   .dropdown-submenu>a:after{display:block;content:" ";float:right;width:0;height:0;border-color:transparent;border-style:solid;border-width:5px 0 5px 5px;border-left-color:#cccccc;margin-top:5px;margin-right:-10px;}
   .dropdown-submenu:hover>a:after{border-left-color:#ffffff;}
   .dropdown-submenu.pull-left{float:none;}.dropdown-submenu.pull-left>.dropdown-menu{left:-100%;margin-left:10px;-webkit-border-radius:6px 0 6px 6px;-moz-border-radius:6px 0 6px 6px;border-radius:6px 0 6px 6px;}
   #navigation {
   background:#273e7f;
   border: 1px solid #d4d9e3;
   }
   .navi a {
   border-bottom: 2px solid rgb(44, 68, 138);
   border-top: none;
   color: #b4c7ff;
   display: block;
   font-weight: bold;
   font-size: 17px;
   /* font-weight: 500; */
   padding: 17px 18px;
   text-decoration: none;
   }
   .navi a:hover {
   background: #2849a7 none repeat scroll 0 0;
   border-left: 5px solid #5584ff;
   display: block;
   padding-left: 15px;
   }
</style>
<?php
   // informações do cliente
   $cliente = $class->Select("*", "conf_cliente", "", "");
   $dados = $cliente->fetch(PDO::FETCH_OBJ);
?>
<div class="col-md-2 col-sm-1 hidden-xs display-table-cell v-align box" id="navigation">
   <div style="padding: 6% 0%; background: #273e7f;border-bottom: 3px solid #2c448a;" class="logo">
      <a href="https://<?= $server ?>/admin">
         <?php
            if (empty($dados->logo)){
         ?>
         <img style="width: 83px;border-radius: 83px;padding: 3%;background: white;margin-bottom: 5px;" src="https://<?= $server ?>/admin/img/logo.png"  class="hidden-xs hidden-sm">
         <img style="width: 83px; border-radius: 83px; padding: 3%; background: white; margin-bottom: 5px;" src="https://<?= $server ?>/admin/img/logo.png" alt="merkery_logo" class="visible-xs visible-sm circle-logo">
         <?php
            }else{
         ?>
         <img style="width: 83px;border-radius: 83px;padding: 3%;background: white;margin-bottom: 5px;" src="https://<?= $server ?>/admin/@config/<?= $dados->logo ?>"  class="hidden-xs hidden-sm">
<img style="width: 83px; border-radius: 83px; padding: 3%; background: white; margin-bottom: 5px;" src="https://<?= $server ?>/admin/@config/<?= $dados->logo ?>" alt="merkery_logo" class="visible-xs visible-sm circle-logo">
         <?php
            }
         ?>
         <h4 style="color: #ffffff;font-weight: bold;font-size: 21px;">
            <?= (empty($dados->cliente)) ? "Nome da empresa" : $dados->cliente ?>
         </h4>
      </a>
   </div>
   <div class="navi">
      <ul>
         <?php 
            $ferramentas = $class->Select("*", "conf_ferramentas", "WHERE status = '1'", "ORDER BY id ASC");
            while($rowFe = $ferramentas->fetch(PDO::FETCH_OBJ)){
         ?>
            <li >
               <a href="https://<?= $server.'/'.$rowFe->caminho ?>">
               <img style="width: 10%;" src="https://<?= $server.'/'.$rowFe->icone ?>" alt="">
               <span class="hidden-xs hidden-sm">&nbsp <?= $rowFe->ferramenta ?></span>
               </a>
            </li>
         <?php
            }
         ?>
         <li>
            <a href="https://<?= $server ?>/sair">
            <img style="width: 10%;" src="https://<?= $server ?>/admin/img/exit.svg" alt="">
            <span class="hidden-xs hidden-sm">&nbsp Sair</span>
            </a>
         </li>
      </ul>
   </div>
</div>