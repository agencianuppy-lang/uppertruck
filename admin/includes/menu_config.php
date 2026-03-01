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
<div class="col-md-2 col-sm-1 hidden-xs display-table-cell v-align box" id="navigation">
   <div style="padding: 6% 0%; background: #273e7f;border-bottom: 3px solid #2c448a;" class="logo">
      <img style="width: 83px;border-radius: 83px;padding: 3%;background: none;margin-bottom: 5px;" src="https://<?= $server ?>/admin/img/logotrrr.svg"  class="hidden-xs hidden-sm">
      <img style="width: 83px; border-radius: 83px; padding: 3%; background: none; margin-bottom: 5px;" src="https://<?= $server ?>/admin/img/logotrrr.svg" alt="merkery_logo" class="visible-xs visible-sm circle-logo">
      <h4 style="color: #ffffff;font-weight: bold;font-size: 21px;">Painel de Configurações</h4>
   </div>
   <div class="navi">
      <ul>
         <li >
            <a href="https://<?= $server ?>/ferramentas">
            <img style="width: 10%;" src="admin/img/config.svg" alt="">
            <span class="hidden-xs hidden-sm">&nbsp Ferramentas</span>
            </a>
         </li>

         <li >
            <a href="https://<?= $server ?>/configuracoes">
            <img style="width: 10%;" src="admin/img/config.svg" alt="">
            <span class="hidden-xs hidden-sm">&nbsp Configurações</span>
            </a>
         </li>

         <li >
            <a href="https://<?= $server ?>/instrucoes">
            <img style="width: 10%;" src="admin/img/dev.svg" alt="">
            <span class="hidden-xs hidden-sm">&nbsp Instruções</span>
            </a>
         </li>

         <li>
            <a href="https://<?= $server ?>/logout">
            <img style="width: 10%;" src="admin/img/exit.svg" alt="">
            <span class="hidden-xs hidden-sm">&nbsp Sair</span>
            </a>
         </li>
      </ul>
   </div>
</div>