
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

</style>
            <div class="col-md-2 col-sm-1 hidden-xs display-table-cell v-align box" id="navigation">
                <div class="logo">
                    <a hef="https://<?= $server ?>/painel.php"><img src="https://<?= $server ?>/admin/img/logo.png"  class="hidden-xs hidden-sm">
                        <img src="img/logo.png" alt="merkery_logo" class="visible-xs visible-sm circle-logo">
                    </a>
                </div>
                <div class="navi">
                    <ul>
                        <li class="active">
                          <a href="https://<?= $server ?>/painel">
                            <i class="fa fa-home fa-3x fa-fw" aria-hidden="true"></i>
                            <span class="hidden-xs hidden-sm">Homsse</span>
                          </a>
                        </li>

                        <li class="dropdown">
                         <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                           <i class="fa fa-file-text" aria-hidden="true"></i>
                           <span class="hidden-xs hidden-sm">Cadastro <span class="caret pull-right"></span></span>
                         </a>
                         <ul class="dropdown-menu forAnimate" role="menu">
                           <li><a href="https://<?= $server ?>/clientes-e-fornecedores"><i class="fa fa-users"></i>Clientes e Fornecedores</a></li>
                           <li><a href="https://<?= $server ?>/caixas-e-bancos"><i class="fa fa-bank"></i>Caixa e Bancos</a></li>
                           <li><a href="https://<?= $server ?>/plano-de-contas"><i class="fa fa-barcode"></i>Plano de contas</a></li>
                         </ul>
                       </li>  

                        <li class="dropdown">
                         <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                           <i class="fa fa-car"></i>
                           <span class="hidden-xs hidden-sm">Veículos <span class="caret pull-right"></span></span>
                         </a>
                         <ul class="dropdown-menu forAnimate" role="menu">
                           <li><a href="https://<?= $server ?>/ficha-tecnica"><i class="fa fa-list-alt"></i>Ficha Técnica</a></li>
                           <li><a href="https://<?= $server ?>/ficha-financeira"><i class="fa fa-line-chart" aria-hidden="true"></i>Ficha Financeira</a></li>
                         </ul>
                       </li>  

                        <li class="dropdown">
                         <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                           <i class="fa fa-usd" aria-hidden="true"></i>
                           <span class="hidden-xs hidden-sm">Financeiro <span class="caret pull-right"></span></span>
                         </a>
                         <ul class="dropdown-menu forAnimate" role="menu">
                           <li><a href="https://<?= $server ?>/contas-a-pagar"><i class="fa fa-usd"></i>Contas a pagar</a></li>
                           <li><a href="https://<?= $server ?>/contas-a-receber"><i class="fa fa-usd"></i>Contas a receber</a></li>
                           <li><a href="https://<?= $server ?>/movimento"><i class="fa fa-exchange"></i>Movimento</a></li>
                           <li><a href="https://<?= $server ?>/transferencia"><i class="fa fa-random"></i>Transferência</a></li>
                         </ul>
                       </li>  

                        <li class="dropdown">
                         <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                           <i class="fa fa-briefcase" aria-hidden="true"></i>
                           <span class="hidden-xs hidden-sm">Comercial <span class="caret pull-right"></span></span>
                         </a>
                         <ul class="dropdown-menu forAnimate" role="menu">
                           <li><a href="https://<?= $server ?>/propostas"><i class="fa fa-suitcase"></i>Proposta</a></li>
                           <li><a href="https://<?= $server ?>/vendas"><i class="fa fa-bar-chart"></i>Vendas</a></li>
                           <li><a href="https://<?= $server ?>/comissoes"><i class="fa fa-pie-chart"></i>Comissões</a></li>
                         </ul>
                       </li>  



                       <li class="dropdown">
                         <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                           <i class="fa fa-area-chart" aria-hidden="true"></i>
                           <span class="hidden-xs hidden-sm">Relatório <span class="caret pull-right"></span></span>
                         </a>
                         <ul class="dropdown-menu forAnimate" role="menu">
                           <li class="dropdown-submenu">
                               <a tabindex="-1" href="#"><i class="fa fa-file-text"></i>Cadastro</a>
                                <ul style="margin-top: -71px;" class="dropdown-menu">
                                   <li><a tabindex="-1" href="https://<?= $server ?>/cadastro-geral">Geral</a></li>
                               </ul>
                           </li>
                           <li class="dropdown-submenu">
                               <a tabindex="-1" href="#"><i class="fa fa-car"></i>Veículos</a>
                                <ul style="margin-top: -71px;" class="dropdown-menu">
                                   <li><a tabindex="-1" href="https://<?= $server ?>/relatorio-ficha">Ficha</a></li>
                                   <li><a tabindex="-1" href="https://<?= $server ?>/termo">Termo</a></li>
                                   <li><a tabindex="-1" href="https://<?= $server ?>/estoque">Estoque</a></li>
                               </ul>
                           </li>

                           <li class="dropdown-submenu">
                               <a tabindex="-1" href="#"><i class="fa fa-bar-chart"></i>Financeiro</a>
                                <ul style="margin-top: -71px;" class="dropdown-menu">
                                   <li><a tabindex="-1" href="https://<?= $server ?>/relatorio-movimento">Movimento</a></li>
                                   <li><a tabindex="-1" href="https://<?= $server ?>/fluxo-caixa">Fluxo Caixa</a></li>
                                   <li><a tabindex="-1" href="https://<?= $server ?>/balancete">Balancete</a></li>
                               </ul>
                           </li>


                           <li class="dropdown-submenu">
                              <a tabindex="-1" href="#"><i class="fa fa-area-chart"></i>Comercial </a>
                                <ul style="margin-top: -71px;" class="dropdown-menu">
                                   <li><a tabindex="-1" href="https://<?= $server ?>/relatorio-propostas">Propostas</a></li>
                                   <li><a tabindex="-1" href="https://<?= $server ?>/relatorio-vendas">Vendas</a></li>
                                   <li>
                                   <a tabindex="-1" href="https://<?= $server ?>/gerencial">Gerencial</a></li>
                               </ul>
                           </li>



                         </ul>
                       </li>  




                       <li class="dropdown">
                         <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                           <i class="fa fa-cog" aria-hidden="true"></i>
                           <span class="hidden-xs hidden-sm">Administração <span class="caret pull-right"></span></span>
                         </a>
                         <ul class="dropdown-menu forAnimate" role="menu">
                           <li><a tabindex="-1" href="https://<?= $server ?>/usuarios">Usuários</a></li>
                           <li><a tabindex="-1" href="https://<?= $server ?>/pre-venda">Pré-venda</a></li>
                           <li><a tabindex="-1" href="https://<?= $server ?>/compromissos">Compromissos</a></li>
                           <li><a tabindex="-1" href="https://<?= $server ?>/mensagens">Mensagens</a></li>
                        </ul>
                       </li>  


                        <li>
                          <a href="https://<?= $server ?>/agenda">
                            <i class="fa fa-calendar" aria-hidden="true"></i>
                            <span class="hidden-xs hidden-sm">Agenda</span>
                          </a>
                        </li>


                        <li>
                          <a href="#">
                            <i class="fa fa-question-circle-o" aria-hidden="true"></i>
                            <span class="hidden-xs hidden-sm">Ajuda</span>
                          </a>
                        </li>


                        <li>
                          <a href="https://<?= $server ?>/logout">
                            <i class="fa fa-power-off" aria-hidden="true"></i>
                            <span class="hidden-xs hidden-sm">Logout</span>
                          </a>
                        </li>


                    </ul>
                </div>
            </div>