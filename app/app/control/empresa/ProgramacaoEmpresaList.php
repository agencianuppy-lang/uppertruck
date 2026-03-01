<?php

class ProgramacaoEmpresaList extends TStandardList
{
    protected $form;    
    protected $form_grid;
    protected $datagrid; 
    protected $pageNavigation;
    
    // trait with onReload, onSearch, onDelete...
    use Adianti\Base\AdiantiStandardListTrait;
    
    public function __construct()
    {
        parent::__construct();
        
        
        $grupos = TSession::getValue('usergroupids');
        $grupo = $grupos[0];
        $userid = TSession::getValue('userid');
        
        $this->setDatabase('uppertruck');        // defines the database
        $this->setActiveRecord('Programacao');       // defines the active record
        
        $this->addFilterField('cliente_id', 'like', 'cliente_id'); // filter field, operator, form field
        $this->addFilterField('status_transporte_id', 'like', 'status_transporte_id'); // filter field, operator, form field
        $this->addFilterField('status_pgmto_id', 'like', 'status_pgmto_id'); // filter field, operator, form field
      
      
        $this->setDefaultOrder('id', 'asc');  // define the default order
        
        // creates the form
        $this->form = new BootstrapFormBuilder('form_programacao');
        $this->form->setFormTitle( 'Programação de embarques' );
        $filter = new TCriteria;
        $filter->add(new TFilter('grupo', '=', '3'));  //clientes
        
        if ($grupo == 2) // colaborador - não administrador 
        {
            TTransaction::open('uppertruck'); 
            //restrigir aos clientes relacionados ao respectivo colaborador
            $filter->add(new TFilter('user_responsible_id', '=', $userid));
            //filtrar a datagrid somente com as programações relacionadas aos clientes do userid
            $repository = new TRepository('SystemUser'); 
            $clientes_userid = $repository->load($filter); 
            $ids = [];
            foreach ($clientes_userid as $cliente)
            {
                $ids[] = $cliente->id;
            }
            $criteria = new TCriteria;
            if ( count($ids) > 0 )
            {
                $criteria->add( new TFilter( 'cliente_id', 'IN', $ids ) );
                //echo $criteria->dump();
               
            }
            else
            {
                $criteria->add( new TFilter( 'cliente_id', '=', -1 ) );
                echo $criteria->dump();
            }
            parent::setCriteria($criteria);  
            TTransaction::close();   
        }
       
        
        
        
        $cliente_id = new TDBCombo('cliente_id', 'uppertruck', 'SystemUser', 'id', 'name', 'name', $filter); 
        $status_transporte_id = new TDBCombo('status_transporte_id', 'uppertruck', 'StatusTransporte', 'id', 'descricao', 'id');
        $status_pgmto_id = new TDBCombo('status_pgmto_id', 'uppertruck', 'StatusPgmto', 'id', 'descricao', 'id');
        
        //$cliente_id = new TEntry('cliente_id');
        $this->form->addFields( [new TLabel('Cliente')], [$cliente_id] );
        $this->form->addFields( [new TLabel('Situação transporte')], [$status_transporte_id] );
        $this->form->addFields( [new TLabel('Situação Pgmto')], [$status_pgmto_id] );
        
        // add form actions
        $this->form->addAction('Buscar', new TAction([$this, 'onSearch']), 'fa:search blue');
        $this->form->addActionLink('Nova',  new TAction(['ProgramacaoEmpresaForm', 'onClear']), 'fa:plus-circle green');
        $this->form->addActionLink('Limpar',  new TAction([$this, 'clear']), 'fa:eraser red');
        
        // keep the form filled with the search data
        $this->form->setData( TSession::getValue('StandardDataGridView_filter_data') );
        

        $this->form->addExpandButton( "", "fa:grip-lines", false);

        // creates the DataGrid
        $this->datagrid = new BootstrapDatagridWrapper(new TDataGrid);
        $this->datagrid->width = "100%";
        $this->datagrid->datatable = 'true'; // turn on Datatables
        $this->datagrid->disableDefaultClick();
        //$this->datagrid->disableDefaultClick();
        
        // creates the datagrid columns
        $col_id                = new TDataGridColumn('id', 'Id', 'right');
        $col_data_coleta       = new TDataGridColumn('data_coleta', 'Coleta', 'left');    
        $col_data_entrega      = new TDataGridColumn('data_entrega', 'Entrega', 'left');
        $col_km                = new TDataGridColumn('km', 'KM', 'left');
        $col_status_transporte  = new TDataGridColumn('status_transporte_id', 'Transporte', 'left'); 
        $col_status_pgmto       = new TDataGridColumn('status_pgmto_id', 'Pagamento', 'left'); 
        $col_tipo_pgmto         = new TDataGridColumn('tipo_pgmto_id', 'Tipo Pagamento', 'left'); 
        $col_data_vencimento    = new TDataGridColumn('data_vencimento', 'Vencimento', 'left');
        $col_data_pgmto         = new TDataGridColumn('data_pagamento', 'Data pgmto', 'left');
        $col_cte                = new TDataGridColumn('cte', 'Cte', 'left');
        $col_cliente_id         = new TDataGridColumn('cliente_id', 'Cliente', 'left');
        $col_num_nf             = new TDataGridColumn('num_nf', 'NF', 'left');
        $col_motorista_id       = new TDataGridColumn('motorista_id', 'Motorista', 'left');
        $col_veiculo_id         = new TDataGridColumn('veiculo_id', 'Placa', 'left');
        $col_origem             = new TDataGridColumn('origem_cidade_id', 'Origem', 'left');
        $col_destino            = new TDataGridColumn('destino_cidade_id', 'Destino', 'left');
        $col_kg                 = new TDataGridColumn('kg', 'Peso/KG', 'left');
        $col_volumes            = new TDataGridColumn('volumes', 'Volumes', 'left');
        $col_m3                 = new TDataGridColumn('m3', 'Cub./M3', 'left');
        $col_tipo_produto       = new TDataGridColumn('tipo_produto', 'Produto', 'left');
        $col_valor_nf           = new TDataGridColumn('valor_nf', 'Valor NF', 'left');
        $col_valor_faturado     = new TDataGridColumn('valor_faturado', 'Valor FAT', 'left');
        $col_valor_motorista    = new TDataGridColumn('valor_motorista','Valor TAC', 'left');
        $col_valor_icms         = new TDataGridColumn('valor_icms','ICMS', 'left');
        $col_valor_seguro       = new TDataGridColumn('valor_seguro','Seguro', 'left');
        $col_valor_comissao     = new TDataGridColumn('valor_comissao','Comissao', 'left');
        $col_valor_gris         = new TDataGridColumn('valor_gris','GRIS', 'left');
        $col_valor_simples      = new TDataGridColumn('valor_simples','SN', 'left');
        $col_outros_descontos   = new TDataGridColumn('outros_descontos','Outros', 'left');
        $col_fat_liquido        = new TDataGridColumn('fat_liquido','Fat. Líquido', 'left');
        $col_obs                = new TDataGridColumn('obs','Obs.', 'left');
        $col_colaborador        = new TDataGridColumn('cliente_id','Colaborador', 'left');
        
        $col_status_pgmto->setDataProperty('style','font-weight: bold');
        $col_status_transporte->setDataProperty('style','font-weight: bold');
        
        $col_data_coleta->setTransformer( function($value) {
            return TDate::convertToMask($value, 'yyyy-mm-dd', 'dd/mm/yyyy');
        });
        $col_data_entrega->setTransformer( function($value) {
            return TDate::convertToMask($value, 'yyyy-mm-dd', 'dd/mm/yyyy');
        });
        $col_data_vencimento->setTransformer( function($value) {
            return TDate::convertToMask($value, 'yyyy-mm-dd', 'dd/mm/yyyy');
        });
        $col_data_pgmto->setTransformer( function($value) {
            return TDate::convertToMask($value, 'yyyy-mm-dd', 'dd/mm/yyyy');
        });
        $col_tipo_produto->setTransformer( function($value) {
            TTransaction::open('uppertruck');
            $produto = new TipoProduto($value);
            TTransaction::close();
            return "{$produto->descricao}";
        });
        $col_origem->setTransformer( function($value) { 
            TTransaction::open('uppertruck');
            $cidade = new Cidade($value);
            TTransaction::close();
            $estado = $cidade->get_estado();
            return "{$cidade->nome} - {$estado->uf}";
        });
        $col_destino->setTransformer( function($value) { 
            TTransaction::open('uppertruck');
            $cidade = new Cidade($value);
            TTransaction::close();
            $estado = $cidade->get_estado();
            return "{$cidade->nome} - {$estado->uf}";
        });
        $col_cliente_id->setTransformer( function($value) { 
            TTransaction::open('uppertruck');
            $cliente = new SystemUser($value);
            TTransaction::close();
            return "{$cliente->name}";
        });
        $col_motorista_id->setTransformer( function($value) { 
            TTransaction::open('uppertruck');
            $motorista = new SystemUser($value);
            TTransaction::close();
            return "{$motorista->name}";
        });
        $col_veiculo_id->setTransformer( function($value) { 
            TTransaction::open('uppertruck');
            $veiculo = new Veiculo($value);
            TTransaction::close();
            return "{$veiculo->placa}";
        });
        
        $col_valor_nf->setTransformer( function($value) {
            if (is_numeric($value)) {
                return 'R$&nbsp;'.number_format($value, 2, ',', '.');
            }
            return $value;
        });
        $col_valor_faturado->setTransformer( function($value) {
            if (is_numeric($value)) {
                return 'R$&nbsp;'.number_format($value, 2, ',', '.');
            }
            return $value;
        });
        $col_valor_motorista->setTransformer( function($value) {
            if (is_numeric($value)) {
                return 'R$&nbsp;'.number_format($value, 2, ',', '.');
            }
            return $value;
        });
        $col_valor_icms->setTransformer( function($value) {
            if (is_numeric($value)) {
                return 'R$&nbsp;'.number_format($value, 2, ',', '.');
            }
            return $value;
        });
        $col_valor_seguro->setTransformer( function($value) {
            if (is_numeric($value)) {
                return 'R$&nbsp;'.number_format($value, 2, ',', '.');
            }
            return $value;
        });
        $col_valor_comissao->setTransformer( function($value) {
            if (is_numeric($value)) {
                return 'R$&nbsp;'.number_format($value, 2, ',', '.');
            }
            return $value;
        });
        $col_valor_gris->setTransformer( function($value) {
            if (is_numeric($value)) {
                return 'R$&nbsp;'.number_format($value, 2, ',', '.');
            }
            return $value;
        });
        $col_valor_simples->setTransformer( function($value) {
            if (is_numeric($value)) {
                return 'R$&nbsp;'.number_format($value, 2, ',', '.');
            }
            return $value;
        });
        $col_outros_descontos->setTransformer( function($value) {
            if (is_numeric($value)) {
                return 'R$&nbsp;'.number_format($value, 2, ',', '.');
            }
            return $value;
        });
        $col_fat_liquido->setTransformer( function($value) {
            if (is_numeric($value)) {
                return 'R$&nbsp;'.number_format($value, 2, ',', '.');
            }
            return $value;
        });
    
        $col_status_transporte->setTransformer( function($value) {
            TTransaction::open('uppertruck');
            $status = new StatusTransporte($value);
            TTransaction::close();
            switch ($value) 
            {
                case '1': // Pendente de agendamento
                  $class = 'danger';
                  break;
                case '2': // Coleta agendada
                  $class = 'primary';
                  break;
                case '3': // Em transporte
                  $class = 'info';
                  break;
                case '4': // Entregue
                  $class = 'success';
                  break;
                default:
                  $class = 'default';
                  break;
            }
            $label = $status->descricao;
            $div = new TElement('span');
            $div->class="label label-{$class}";
            $div->style="text-shadow:none; font-size:12px;";
            $div->add($label); 
            return $div;
        });  
        
        $col_status_pgmto->setTransformer( function($value, $obj, $row) {
            TTransaction::open('uppertruck');
            $status = new StatusPgmto($value);
            TTransaction::close();
            $label = $status->descricao;
            switch ($value) 
            {
                case '1': // Pgmto pendente
                  $class = 'danger';
                  break;
                case '2': // Pgmto confirmado
                  $class = 'success';
                  break;
                default:
                  return "<span>$label</span>";
                  break;
            }
            $label = $status->descricao;
            $div = new TElement('span');
            $div->class="label label-{$class}";
            $div->style="text-shadow:none; font-size:12px;";
            $div->add($label); 
            return $div;
        });  
        
        $col_colaborador->setTransformer( function($value) {
            TTransaction::open('uppertruck'); 
            $cliente = new SystemUser($value);
            $colaborador = new SystemUser($cliente->user_responsible_id);
            TTransaction::close();
            if ($colaborador) {
                return $colaborador->name;
            }
            return '';
        });
      
        $this->datagrid->addColumn($col_id);
        $this->datagrid->addColumn($col_data_coleta);
        $this->datagrid->addColumn($col_data_entrega);
        $this->datagrid->addColumn($col_km);
        $this->datagrid->addColumn($col_status_transporte);
        $this->datagrid->addColumn($col_status_pgmto);
        $this->datagrid->addColumn($col_tipo_pgmto);
        $this->datagrid->addColumn($col_data_vencimento);
        $this->datagrid->addColumn($col_data_pgmto);
        $this->datagrid->addColumn($col_cte);
        $this->datagrid->addColumn($col_cliente_id);
        $this->datagrid->addColumn($col_num_nf);
        $this->datagrid->addColumn($col_motorista_id);
        $this->datagrid->addColumn($col_veiculo_id);
        $this->datagrid->addColumn($col_origem);
        $this->datagrid->addColumn($col_destino);
        $this->datagrid->addColumn($col_kg);
        $this->datagrid->addColumn($col_volumes);
        $this->datagrid->addColumn($col_m3);
        $this->datagrid->addColumn($col_tipo_produto);
        $this->datagrid->addColumn($col_valor_nf);
        $this->datagrid->addColumn($col_valor_faturado);
        $this->datagrid->addColumn($col_valor_motorista);
        $this->datagrid->addColumn($col_valor_icms);
        $this->datagrid->addColumn($col_valor_seguro);
        $this->datagrid->addColumn($col_valor_comissao);
        $this->datagrid->addColumn($col_valor_gris);
        $this->datagrid->addColumn($col_valor_simples);
        $this->datagrid->addColumn($col_outros_descontos);
        $this->datagrid->addColumn($col_fat_liquido);
        $this->datagrid->addColumn($col_obs);
        $this->datagrid->addColumn($col_colaborador);
        
        $col_id->setAction( new TAction([$this, 'onReload']),   ['order' => 'id']);
        $col_data_coleta->setAction( new TAction([$this, 'onReload']), ['order' => 'data_coleta']);
        $col_origem->setAction( new TAction([$this, 'onReload']), ['order' => 'origem_cidade_id']);
        $col_destino->setAction( new TAction([$this, 'onReload']), ['order' => 'destino_cidade_id']);
        $col_tipo_produto->setAction( new TAction([$this, 'onReload']), ['order' => 'tipo_produto']);
        $col_valor_nf->setAction( new TAction([$this, 'onReload']), ['order' => 'valor_nf']);
        $col_valor_faturado->setAction( new TAction([$this, 'onReload']), ['order' => 'valor_faturado']);
        
        
        // define row actions
        $act_edit = new TDataGridAction(['ProgramacaoEmpresaForm', 'onEdit'],   ['key' => '{id}'] );
        $act_agendar_coleta    = new TDataGridAction([$this, 'onAgendarColeta'],     ['key' => '{id}', 'data_coleta' => '{data_coleta}', 'motorista_id' => '{motorista_id}' ] );
        $act_canc_agend_coleta = new TDataGridAction([$this, 'onCancAgendColeta'],   ['key' => '{id}'] );
        $act_registrar_coleta  = new TDataGridAction([$this, 'onRegistrarColeta'],   ['key' => '{id}', 'data_coleta' => '{data_coleta}'] );
        $act_registrar_entrega = new TDataGridAction([$this, 'onRegistrarEntrega'],  ['key' => '{id}'] );
        $act_registrar_pgmto   = new TDataGridAction([$this, 'onRegistrarPgmto'],  ['key' => '{id}', 'valor_faturado' => '{valor_faturado}'] );
        $act_view_canhoto      = new TDataGridAction([$this, 'onViewCanhoto'],       ['key' => '{id}'] );   
        
        $act_edit->setLabel('Ficha da programação');
        $act_edit->setImage('far:edit blue');
        $act_agendar_coleta->setLabel('Agendar coleta');
        $act_agendar_coleta->setImage('fa:calendar-check #7C93CF');
        $act_canc_agend_coleta->setLabel('Cancelar agendamento da coleta');
        $act_canc_agend_coleta->setImage('fa:calendar-times red');
        $act_registrar_coleta->setLabel('Confirmar coleta');
        $act_registrar_coleta->setImage('fa:truck-loading green');
        $act_registrar_entrega->setLabel('Confirmar entrega');
        $act_registrar_entrega->setImage('fa:thumbs-up green');
        $act_registrar_pgmto->setLabel('Confirmar pgmto');
        $act_registrar_pgmto->setImage('fa:dollar-sign green');
        $act_view_canhoto->setLabel('Canhoto da entrega');
        $act_view_canhoto->setImage('fa:search #7C93CF');
        
        $act_agendar_coleta->setDisplayCondition( array($this, 'displayAgendarColeta') );
        $act_canc_agend_coleta->setDisplayCondition( array($this, 'displayCancAgendColeta') );
        $act_registrar_coleta->setDisplayCondition( array($this, 'displayRegistrarColeta') );
        $act_registrar_entrega->setDisplayCondition( array($this, 'displayRegistrarEntrega') );
        $act_registrar_pgmto->setDisplayCondition( array($this, 'displayRegistrarPgmto') );
        $act_view_canhoto->setDisplayCondition( array($this, 'displayViewCanhoto') );
        
        $action_group = new TDataGridActionGroup('Ações', 'fa:th');
        $action_group->addHeader('Opções');
        $action_group->addAction($act_agendar_coleta);
        $action_group->addAction($act_registrar_coleta);
        $action_group->addAction($act_canc_agend_coleta);  
        $action_group->addAction($act_registrar_entrega);
        $action_group->addAction($act_registrar_pgmto);   
        $action_group->addAction($act_edit);
        $action_group->addAction($act_view_canhoto);
        $this->datagrid->addActionGroup($action_group);
        
        // create the datagrid model
        $this->datagrid->createModel();
        
         // creates the page navigation
        $this->pageNavigation = new TPageNavigation;
        $this->pageNavigation->setAction(new TAction(array($this, 'onReload')));
        
        // creates the page structure using a table
        $vbox = new TVBox;
        $vbox->style = 'width: 100%';
        $vbox->add(new TXMLBreadCrumb('menu.xml', __CLASS__));
        $vbox->add($this->form);
        $vbox->add(TPanelGroup::pack('', $this->datagrid, $this->pageNavigation));
        parent::add($vbox);
    }
    
    public static function onAgendarColeta( $param )
    {
        $id          = new TEntry('id');
        $data_coleta = new TDate('data_coleta');
        $id->setEditable(FALSE);
        $id->setSize('100%');
        $data_coleta->setSize('100%');
        $data_coleta->setMask('dd/mm/yyyy');
        $data_coleta->setDatabaseMask('yyyy-mm-dd');
        $data_coleta->setOption('startDate', '1d');
        $id->setValue($param['id']); 
        $form = new BootstrapFormBuilder('agendamento_coleta_form');
        $form->addFields( [new TLabel('id')],     [$id] );
        $form->addFields( [new TLabel('Data agendamento')], [$data_coleta] );
        $form->addAction('Confirmar agendamento', new TAction(array(__CLASS__, 'agendarColeta'), $param), 'fa:save green');
        new TInputDialog('Agendamento de coleta', $form);
    }
    
    public static function agendarColeta( $param )
    {        
        try
        {
        
//             TTransaction::open('permission');
//             $preferences = SystemPreference::getAllPreferences();
//             TTransaction::close();
        
            if ( !isset($param['data_coleta']))
            {
                throw new Exception('Data de agendamento não informada.');
            }
            if ( !isset($param['id']))
            {
                throw new Exception('Erro no envio dos parâmetros');
            }
            $id = $param['id'];  
            $data_coleta = preg_replace("/[^0-9]/", "", $param['data_coleta']);   
            $data_coleta = substr($data_coleta, 4, 4) . '-' . substr($data_coleta, 2, 2) . '-' . substr($data_coleta, 0, 2); 
            TTransaction::open('uppertruck');
            $obj = new Programacao($id); 
            $obj->data_coleta = $data_coleta;
            $obj->status_transporte_id = 2;
            $obj->store(); 
 
//             $data_coleta = preg_replace("/[^0-9]/", "", $param['data_coleta']);
//             $data_coleta = substr($data_coleta, 0, 2) . '/' . substr($data_coleta, 2, 2) . '/' . substr($data_coleta, 4, 4);  
//             if ($preferences['send_msg_motorista'])
//             {
//                 $msg = $preferences['msg_programacao_status_motorista'];
//                 $user = new SystemUser($obj->motorista_id);
//                 $email = trim($user->email);
//                 $subject = 'Coleta agendada';
//                 $arr = ['{status_programacao}' => 'Coleta agendada para <strong>' . $data_coleta . '</strong>.', 
//                         '{nome_motorista}' => $user->name,
//                         '{id_programacao}' => $obj->id,
//                         '{id_cotacao}' => $obj->cotacao_id];   
//                 QueueSendUtil::put($email, $subject, $msg, $obj, $arr);
//             }
//             if ($preferences['send_msg_cliente'])
//             {
//                 $msg = $preferences['msg_programacao_status_cliente'];
//                 $user = new SystemUser($obj->cliente_id);
//                 $email = trim($user->email);
//                 $subject = 'Coleta agendada';
//                 $arr = ['{status_programacao}' => 'Coleta agendada para <strong>' . $data_coleta . '</strong>.', 
//                         '{nome_cliente}' => $user->name,
//                         '{id_programacao}' => $obj->id,
//                         '{id_cotacao}' => $obj->cotacao_id];   
//                 QueueSendUtil::put($email, $subject, $msg, $obj, $arr);
//             }
//             if ($preferences['send_msg_empresa_transporte'])
//             {
//                 $msg = $preferences['msg_programacao_status_empresa'];
//                 $user = new SystemUser($obj->cliente_id);
//                 $email = trim($preferences['mail_destiny1']);
//                 $subject = 'Coleta agendada';
//                 $arr = ['{status_programacao}' => 'Coleta agendada para <strong>' . $data_coleta . '</strong>.', 
//                         '{nome_cliente}' => $user->name,
//                         '{id_programacao}' => $obj->id,
//                         '{id_cotacao}' => $obj->cotacao_id];    
//                 QueueSendUtil::put($email, $subject, $msg, $obj, $arr);
//             } 


            QueueSendTransporte::put($obj, 'agendar_coleta');       

                            
     
            TTransaction::close(); 
            $act = new TAction(['ProgramacaoEmpresaList', 'onReload']);
            new TMessage('info', 'Coleta agendada', $act);
        }
        catch (Exception $e) // in case of exception
        {
            new TMessage('error', $e->getMessage()); 
            TTransaction::rollback();
        }      
    }

    public static function onCancAgendColeta( $param )
    {
        $action = new TAction(array(__CLASS__, 'cancColeta'));
        $action->setParameters($param); 
        new TQuestion('Deseja realmente cancelar o agendamento da coleta?', $action);
    }
    public static function cancColeta( $param )
    { 
        try
        {
//             TTransaction::open('permission');
//             $preferences = SystemPreference::getAllPreferences();
//             TTransaction::close();
        
            if ( !isset($param['id']))
            {
                throw new Exception('Erro no envio dos parâmetros');
            } 
            $id = $param['id'];  
            
            TTransaction::open('uppertruck');
            $obj = new Programacao($id); 
            $obj->status_transporte_id = 1;
            
            $data_coleta = $obj->data_coleta;
            //$data_coleta = preg_replace("/[^0-9]/", "", $data_coleta);   
            //$data_coleta = substr($data_coleta, 6, 2) . '-' . substr($data_coleta, 4, 2) . '-' . substr($data_coleta, 0, 4); 
            
            $obj->data_coleta = null;
            $obj->store(); 
            
            QueueSendTransporte::put($obj, 'canc_coleta', $data_coleta);
            
//             if ($preferences['send_msg_motorista'])
//             {
//                 $msg = $preferences['msg_programacao_status_motorista'];
//                 $user = new SystemUser($obj->motorista_id);
//                 $email = trim($user->email);
//                 $subject = 'Agendamento de coleta cancelado';
//                 $arr = ['{status_programacao}' => 'O agendamento da coleta marcado para ' . $data_coleta . ' foi cancelado.', 
//                         '{nome_motorista}' => $user->name,
//                         '{id_programacao}' => $obj->id,
//                         '{id_cotacao}' => $obj->cotacao_id];   
//                 QueueSendUtil::put($email, $subject, $msg, $obj, $arr);
//             }
//             if ($preferences['send_msg_cliente'])
//             {
//                 $msg = $preferences['msg_programacao_status_cliente'];
//                 $user = new SystemUser($obj->cliente_id);
//                 $email = trim($user->email);
//                 $subject = 'Agendamento de coleta cancelado';
//                 $arr = ['{status_programacao}' => 'O agendamento da coleta marcado para ' . $data_coleta . ' foi cancelado.', 
//                         '{nome_cliente}' => $user->name,
//                         '{id_programacao}' => $obj->id,
//                         '{id_cotacao}' => $obj->cotacao_id];   
//                 QueueSendUtil::put($email, $subject, $msg, $obj, $arr);
//             }
//             if ($preferences['send_msg_empresa_transporte'])
//             {
//                 $msg = $preferences['msg_programacao_status_empresa'];
//                 $user = new SystemUser($obj->cliente_id);
//                 $email = trim($preferences['mail_destiny1']);
//                 $subject = 'Agendamento de coleta cancelado';
//                 $arr = ['{status_programacao}' => 'O agendamento da coleta marcado para ' . $data_coleta . ' foi cancelado.', 
//                         '{nome_cliente}' => $user->name,
//                         '{id_programacao}' => $obj->id,
//                         '{id_cotacao}' => $obj->cotacao_id];    
//                 QueueSendUtil::put($email, $subject, $msg, $obj, $arr);
//             }                            
            
            TTransaction::close(); 
            $act = new TAction(['ProgramacaoEmpresaList', 'onReload']);
            new TMessage('info', 'Agendamento cancelado com sucesso.', $act);
        }
        catch (Exception $e) 
        {
            new TMessage('error', $e->getMessage()); 
            TTransaction::rollback();
        }            
    }
    
    public static function onRegistrarColeta( $param )
    {
        $id          = new TEntry('id');
        $data_coleta = new TDate('data_coleta');
        $id->setEditable(FALSE);
        $id->setSize('100%');
        $data_coleta->setSize('100%');
        $data_coleta->setMask('dd/mm/yyyy');
        $data_coleta->setDatabaseMask('yyyy-mm-dd');
        $data_coleta->setOption('endDate', '1d+');
        $data_coleta->setOption('startDate', '-7d');
        $data_coleta->setOption('datesDisabled', '+1d');
        $id->setValue($param['id']); 
        $data_coleta->setValue($param['data_coleta']);
        $form = new BootstrapFormBuilder('agendamento_coleta_form');
        $form->addFields( [new TLabel('Id')],     [$id] );
        $form->addFields( [new TLabel('Data coleta')], [$data_coleta] );
        $form->addAction('Confirmar registro da coleta?', new TAction(array(__CLASS__, 'registrarColeta'), $param), 'fa:save green');
        new TInputDialog('Confirmação de coleta', $form);
    }
    
    public static function registrarColeta( $param )
    { 
        try
        {
            TTransaction::open('permission');
            $preferences = SystemPreference::getAllPreferences();
            TTransaction::close();
        
            if ( !isset($param['data_coleta']))
            {
                throw new Exception('Data de agendamento não informada.');
            }
            if ( !isset($param['id']))
            {
                throw new Exception('Erro no envio dos parâmetros');
            }
            $id = $param['id'];  
            $data_coleta = preg_replace("/[^0-9]/", "", $param['data_coleta']);   
            $data_coleta = substr($data_coleta, 4, 4) . '-' . substr($data_coleta, 2, 2) . '-' . substr($data_coleta, 0, 2); 
            TTransaction::open('uppertruck');
            $obj = new Programacao($id); 
            $obj->status_transporte_id = 3;
            $obj->data_coleta = $data_coleta;
            $obj->store(); 
            
            QueueSendTransporte::put($obj, 'registrar_coleta');
               
            
            
            
            TTransaction::close(); 
            $act = new TAction(['ProgramacaoEmpresaList', 'onReload']);
            new TMessage('info', 'Coleta registrada - status alterado para "em transporte".', $act);
        }
        catch (Exception $e) 
        {
            new TMessage('error', $e->getMessage()); 
            TTransaction::rollback();
        }            
    }
    
    public static function onRegistrarEntrega( $param )
    {
        $id          = new TEntry('id');
        $data_entrega = new TDate('data_entrega');
        $id->setEditable(FALSE);
        $id->setSize('100%');
        $data_entrega->setSize('100%');
        $data_entrega->setMask('dd/mm/yyyy');
        $data_entrega->setDatabaseMask('yyyy-mm-dd');
        $data_entrega->setOption('endDate', '1d+');
        $data_entrega->setOption('startDate', '-7d');
        $data_entrega->setOption('datesDisabled', '+1d');
        $id->setValue($param['id']); 
        $form = new BootstrapFormBuilder('conf_entrega_form');
        $form->addFields( [new TLabel('Id')],     [$id] );
        $form->addFields( [new TLabel('Data coleta')], [$data_entrega] );
        $form->addAction('Confirmar a entrega?', new TAction(array(__CLASS__, 'registrarEntrega'), $param), 'fa:save green');
        new TInputDialog('Confirmação de entrega', $form);
    }
    public static function registrarEntrega( $param )
    {
        try
        {
            if ( !isset($param['data_entrega']))
            {
                throw new Exception('Data da entrega não informada.');
            }
            if ( !isset($param['id']))
            {
                throw new Exception('Erro no envio dos parâmetros');
            }
            $id = $param['id'];  
            $data_entrega = preg_replace("/[^0-9]/", "", $param['data_entrega']);   
            $data_entrega = substr($data_entrega, 4, 4) . '-' . substr($data_entrega, 2, 2) . '-' . substr($data_entrega, 0, 2); 
            TTransaction::open('uppertruck');
            $obj = new Programacao($id); 
            $obj->status_transporte_id = 4; // entregue
            if ( $data_entrega < $obj->data_coleta )
            {
                throw new Exception('A data de entrega não pode ser anterior à data de coleta.');
            }
            $obj->data_entrega = $data_entrega;  
            $obj->store(); 
            
            QueueSendTransporte::put($obj, 'registrar_entrega');
            
            TTransaction::close(); 
            $act = new TAction(['ProgramacaoEmpresaList', 'onReload']);
            new TMessage('info', 'Entrega registrada - status alterado para "Entregue".', $act);
        }
        catch (Exception $e) 
        {
            new TMessage('error', $e->getMessage()); 
            TTransaction::rollback();
        }            
    }
    
    public static function onRegistrarPgmto( $param )
    {
        $id    = new TEntry('id');
        $date  = new TDate('data_pagamento');
        $valor = new TEntry('valor_faturado');
        $valor->setNumericMask(2, ',', '.', true);
        $id->setEditable(FALSE);
        $id->setSize('100%');
        $date->setSize('100%');
        $date->setMask('dd/mm/yyyy');
        $date->setDatabaseMask('yyyy-mm-dd');
        $date->setOption('endDate', '1d+');
        $date->setOption('startDate', '-7d');
        $date->setOption('datesDisabled', '+1d');
        $valor->setValue($param['valor_faturado']);
        $id->setValue($param['id']);     
        $form = new BootstrapFormBuilder('conf_entrega_form');
        $form->addFields( [new TLabel('Id')],     [$id] );
        $form->addFields( [new TLabel('Data pgmto')], [$date] );
        $form->addFields( [new TLabel('Valor faturado')],  [$valor] );
        $form->addAction('Confirmar o pagamento?', new TAction(array(__CLASS__, 'registrarPgmto'), $param), 'fa:save green');
        new TInputDialog('Confirmação de pagamento', $form);     
    }
    
    public static function registrarPgmto( $param )
    {
        try
        {
            if ( !isset($param['data_pagamento']))
            {
                throw new Exception('Data do pagamento não informada.');
            }
            if ( !isset($param['id']))
            {
                throw new Exception('Erro no envio dos parâmetros');
            }
            $id = $param['id'];  
            $date = preg_replace("/[^0-9]/", "", $param['data_pagamento']);   
            $date = substr($date, 4, 4) . '-' . substr($date, 2, 2) . '-' . substr($date, 0, 2); 
            TTransaction::open('uppertruck');
            $obj = new Programacao($id); 
            $obj->status_pgmto_id = 2; //confirmado
            $obj->data_pagamento = $date;  
            $obj->store(); 
            TTransaction::close(); 
            $act = new TAction(['ProgramacaoEmpresaList', 'onReload']);
            new TMessage('info', 'Pagamento confirmado com sucesso.', $act);
        }
        catch (Exception $e) 
        {
            new TMessage('error', $e->getMessage()); 
            TTransaction::rollback();
        }                 
    
    }
    
    public static function onViewCanhoto( $param )
    {
        try
        {
            TTransaction::open('uppertruck');
            $window = TWindow::create('Canhoto de entrega', 0.8, null);
            $obj = new Programacao($param['id']);
            $img = new TImage($obj->canhoto_entrega);
            //$panel = new TPanelGroup('Canhoto de entrega');
            //$panel->add($img);
            
            //$vbox = new TVBox;
            //$vbox->style = 'width: 100%';
            //$vbox->add($panel);
            $window->add($img);
            $window->show();
            TTransaction::close();
        }
        catch (Exception $e)
        {
            new TMessage('error', $e->getMessage());
        }     
    
    }
    
    public function displayAgendarColeta( $obj )
    {
        if ($obj->status_transporte_id == 1 AND $obj->motorista_id)  //a agendar
        {
            return TRUE;
        }
        return FALSE;
    }
    public function displayCancAgendColeta( $obj )
    {
        if ( $obj->status_transporte_id == 2 )  //coleta agendada
        {
            return TRUE;
        }
        return FALSE;   
    }
    public function displayRegistrarColeta( $obj )
    {
        if ( $obj->status_transporte_id == 2 AND $obj->data_coleta == date('Y-m-d') )  //a agendar
        {
            return TRUE;
        }
        return FALSE;
    }
    public function displayRegistrarEntrega( $obj )
    {
        if ( $obj->status_transporte_id == 3 )  //em transporte
        {
            return TRUE;
        }
        return FALSE;
    }
    public function displayRegistrarPgmto( $obj )
    {
        if ( $obj->status_pgmto_id == 1 )  //pendente
        {
            return TRUE;
        }
        return FALSE;
        
    }
    public static function displayViewCanhoto( $obj )
    {
        if ( $obj->status_transporte_id == 4)  //entregue 
        {
            return TRUE;
        }
        return FALSE;     
    }
    
    /**
     * Clear filters
     */
    function clear()
    {
        $this->clearFilters();
        $this->onReload();
    }
    
    public function teste()
    {
    
         $obj = new StdClass;
         $obj->status_transporte_id = 1; 
         TForm::sendData('form_programacao', $obj); // envia os dados ao formulário
         AdiantiCoreApplication::loadPage(__CLASS__, 'onSearch', ['static'=>'1']);
    
    } 
    
    public function onSearch( $param = null )
    {
        // get the search form data
        
         $data = $this->form->getData();
        
        
        if ( isset($param['filter_search']) )
        {
            $obj = new StdClass;
            $filters = $param['filter_search'];  
            foreach ( $filters as $filter => $value)
            {
                $obj->$filter = $value; 
                $data->$filter = $value;
            }
            $this->form->setData($obj);
        }
        
        if ($this->formFilters)
        {
            foreach ($this->formFilters as $filterKey => $formFilter)
            {
                $operator       = isset($this->operators[$filterKey]) ? $this->operators[$filterKey] : 'like';
                $filterField    = isset($this->filterFields[$filterKey]) ? $this->filterFields[$filterKey] : $formFilter;
                $filterFunction = isset($this->filterTransformers[$filterKey]) ? $this->filterTransformers[$filterKey] : null;
                // check if the user has filled the form
                if (!empty($data->{$formFilter}) OR (isset($data->{$formFilter}) AND $data->{$formFilter} == '0'))
                {
                    // $this->filterTransformers
                    if ($filterFunction)
                    {
                        $fieldData = $filterFunction($data->{$formFilter});
                    }
                    else
                    {
                        $fieldData = $data->{$formFilter};
                    }
                    
                    // creates a filter using what the user has typed
                    if (stristr($operator, 'like'))
                    {
                        $filter = new TFilter($filterField, $operator, "%{$fieldData}%");
                    }
                    else
                    {
                        $filter = new TFilter($filterField, $operator, $fieldData);
                    }
                    
                    // stores the filter in the session
                    TSession::setValue($this->activeRecord.'_filter', $filter); // BC compatibility
                    TSession::setValue($this->activeRecord.'_filter_'.$formFilter, $filter);
                    TSession::setValue($this->activeRecord.'_'.$formFilter, $data->{$formFilter});
                }
                else
                {
                    TSession::setValue($this->activeRecord.'_filter', NULL); // BC compatibility
                    TSession::setValue($this->activeRecord.'_filter_'.$formFilter, NULL);
                    TSession::setValue($this->activeRecord.'_'.$formFilter, '');
                }
            }
        }
        
        TSession::setValue($this->activeRecord.'_filter_data', $data);
        TSession::setValue(get_class($this).'_filter_data', $data);
        
        // fill the form with data again
        $this->form->setData($data);
        if (isset($param['static']) && ($param['static'] == '1') )
        {
            $class = get_class($this);
            AdiantiCoreApplication::loadPage($class, 'onReload', ['offset'=>0, 'first_page'=>1] );
        }
        else
        {
            $this->onReload( ['offset'=>0, 'first_page'=>1] );
        }
    }
       
}
