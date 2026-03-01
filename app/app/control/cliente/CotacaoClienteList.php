<?php

class CotacaoClienteList extends TStandardList
{
    protected $form;     // registration form
    protected $datagrid; // listing
    protected $pageNavigation;
    
    // trait with onReload, onSearch, onDelete...
    use Adianti\Base\AdiantiStandardListTrait;
    
    /**
     * Class constructor
     * Creates the page, the form and the listing
     */
    public function __construct()
    {
        parent::__construct();
        
        $this->setDatabase('uppertruck');        // defines the database
        $this->setActiveRecord('Cotacao');       // defines the active record
        
        //$this->addFilterField('cliente_id', 'like', 'cliente_id'); // filter field, operator, form field
        $this->addFilterField('status_id', 'like', 'status_id'); // filter field, operator, form field
      
        $this->setDefaultOrder('id', 'asc');  // define the default order
        
        
        try 
        { 
            TTransaction::open('uppertruck'); // open transaction 
            
            // carregar ids das cotações que já tiveram pgmto confirmado
            $crit = new TCriteria; 
            $crit->add(new TFilter('status_pgmto_id', '=', 2));  // pgmto confirmado 
            $repository = new TRepository('Programacao'); 
            $progs = $repository->load($crit); 
            $ids_cotacao_pgmto_ok = [];
            foreach ($progs as $prog) 
            { 
                $ids_cotacao_pgmto_ok[] = $prog->cotacao_id;
            }
            
            //apegas cotaçoes do cliente e que não tem status "rejeitada", "cancelada pelo cliente", "cancelada pela empresa"
            $criteria = new TCriteria;
            $criteria->add( new TFilter( 'cliente_id', '=', TSession::getValue('userid') ) ); // Listar apenas cotaçãoe do cliente 
            $criteria->add( new TFilter( 'status_id', '!=', 4 ) );
            $criteria->add( new TFilter( 'status_id', '!=', 5 ) );
            $criteria->add( new TFilter( 'status_id', '!=', 6 ) );
          
            //adicionar no filtro - para não carregar na lista - as cotações que tiveram pgmto confirmado nas programacoes vinculadas
            if ( count($ids_cotacao_pgmto_ok) >= 1 )
            {
                $criteria->add(new TFilter('id','NOT IN', $ids_cotacao_pgmto_ok)); 
            } 
            parent::setCriteria($criteria);
            
            
            
            TTransaction::close();
            
            
            
            
            
             // creates the form
            $this->form = new BootstrapFormBuilder('form_cotacao');
            $this->form->setFormTitle( 'Cotações solicitadas' );
            
            
            
            //$filter = new TCriteria;
            //$filter->add(new TFilter('grupo', '=', '3'));  //clientes
            //$cliente_id = new TDBCombo('cliente_id', 'uppertruck', 'SystemUser', 'id', 'name', 'name', $filter); 
            
            $filter = new TCriteria;
            $filter->add( new TFilter( 'id', '!=', 4 ) );
            $filter->add( new TFilter( 'id', '!=', 5 ) );
            $filter->add( new TFilter( 'id', '!=', 6 ) );
            $status_id = new TDBCombo('status_id', 'uppertruck', 'StatusCotacao', 'id', 'visao_cliente', 'id', $filter);
            
            //$cliente_id = new TEntry('cliente_id');
            //$this->form->addFields( [new TLabel('Cliente')], [$cliente_id] );
            $this->form->addFields( [new TLabel('Situação')], [$status_id] );
            
            // add form actions
            $this->form->addAction('Buscar', new TAction([$this, 'onSearch']), 'fa:search blue');
            $this->form->addActionLink('Nova cotação',  new TAction(['CotacaoClienteForm', 'onClear']), 'fa:plus-circle green');
            $this->form->addActionLink('Limpar',  new TAction([$this, 'clear']), 'fa:eraser red');
            
            // keep the form filled with the search data
            $this->form->setData( TSession::getValue('StandardDataGridView_filter_data') );
            
            // creates the DataGrid
            $this->datagrid = new BootstrapDatagridWrapper(new TDataGrid);
            $this->datagrid->width = "100%";
            
            // creates the datagrid columns
            $col_id           = new TDataGridColumn('id', 'Id', 'right');
        
        
            
            $col_data_pedido    = new TDataGridColumn('data_pedido', 'Solicitação / Alteração', 'left');    
            $col_origem         = new TDataGridColumn('origem_cidade_id', 'Origem', 'left');
            $col_destino        = new TDataGridColumn('destino_cidade_id', 'Destino', 'left');
            $col_produto        = new TDataGridColumn('tipo_produto', 'Produto', 'left');
            $col_valor_nf       = new TDataGridColumn('valor_nf', 'Valor NF', 'left'); 
            $col_valor_cotacao  = new TDataGridColumn('valor_cotacao', 'Valor Cotado', 'left');
            $col_status         = new TDataGridColumn('status_id', 'Situação', 'left'); 
            
            
            $col_produto->setTransformer( function($value) {
                TTransaction::open('uppertruck');
                $produto = new TipoProduto($value);
                TTransaction::close();
                return $produto->descricao; 
            });
            
            
            $col_id->setTransformer( function($value, $obj, $row) {
            
                if ( $obj->status_id == 4 OR $obj->status_id == 5 OR $obj->status_id == 6 )
                {
                    $row->style= 'color: silver';
                }
                if ( $obj->status_id == 3 ) // aceita
                {
                    $row->style= 'color: #004D40';
                }
                if ( $obj->status_id == 2 ) // analisar
                {
                    $row->style= 'color: #BF360C; font-weight:bold';
                }
                
                
                return $value;
            });
        
        
        
            $col_data_pedido->setTransformer( function($value) {
                return TDate::convertToMask($value, 'yyyy-mm-dd', 'dd/mm/yyyy');
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
            
            $col_valor_nf->setTransformer( function($value) {
                if (is_numeric($value)) {
                    return 'R$&nbsp;'.number_format($value, 2, ',', '.');
                }
                return $value;
            });
            
            $col_valor_cotacao->setTransformer( function($value) {
                if (is_numeric($value)) {
                    return 'R$&nbsp;'.number_format($value, 2, ',', '.');
                }
                return $value;
            });
            
            $col_status->setTransformer( function($value) {
                TTransaction::open('uppertruck');
                $status = new StatusCotacao($value);
                TTransaction::close();
                switch ($value) 
                {
                    case '1': // Em análise
                      $class = 'warning';
                      break;
                    case '2': // Analisar
                      $class = 'danger';
                      break;
                    case '3': //Aceita
                      $class = 'success';
                      break;
                    case '4': //Rejeitada
                      $class = 'default';
                      break;
                    case '5': // Cancelada pelo cliente
                      $class = 'default';
                      break;
                    case '6': // Cancelada pela empresa
                      $class = 'default';
                      break;
                    default:
                      $class = 'default';
                      break;
                }
                $label = $value!=3 ?  $status->visao_cliente : 'A pagar';
                
                $div = new TElement('span');
                $div->class="label label-{$class}";
                $div->style="text-shadow:none; font-size:12px; font-weight:bold";
                $div->add($label); 
                return $div;
            });  
          
            
            $this->datagrid->addColumn($col_id);
            $this->datagrid->addColumn($col_data_pedido);
            $this->datagrid->addColumn($col_origem);
            $this->datagrid->addColumn($col_destino);
            $this->datagrid->addColumn($col_produto);
            $this->datagrid->addColumn($col_valor_nf);
            $this->datagrid->addColumn($col_valor_cotacao);
            $this->datagrid->addColumn($col_status);
            
            
            $col_id->setAction( new TAction([$this, 'onReload']),   ['order' => 'id']);
            $col_data_pedido->setAction( new TAction([$this, 'onReload']), ['order' => 'data_pedido']);
            $col_origem->setAction( new TAction([$this, 'onReload']), ['order' => 'origem_cidade_id']);
            $col_destino->setAction( new TAction([$this, 'onReload']), ['order' => 'destino_cidade_id']);
            $col_produto->setAction( new TAction([$this, 'onReload']), ['order' => 'tipo_produto']);
            $col_valor_nf->setAction( new TAction([$this, 'onReload']), ['order' => 'valor_nf']);
            $col_valor_cotacao->setAction( new TAction([$this, 'onReload']), ['order' => 'valor_cotacao']);
            
            // define row actions
            $action1 = new TDataGridAction(['CotacaoClienteForm', 'onEdit'],   ['key' => '{id}'] );
            $action2 = new TDataGridAction([$this, 'onDelete'], ['key' => '{id}'] );
            $action2->setDisplayCondition( array($this, 'displayOnDelete') );
             
            $this->datagrid->addAction($action1, 'Visualizar',   'fas:search blue');
            $this->datagrid->addAction($action2, 'Cancelar', 'fas:times red');
            
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
            
            // add the table inside the page
            parent::add($vbox);
           
           
        } 
        catch (Exception $e) 
        { 
            new TMessage('error', $e->getMessage()); 
        } 
        
        
        
        
       
    }
    
    /**
     * Clear filters
     */
    function clear()
    {
        $this->clearFilters();
        $this->onReload();
    }
    
    
    public function onDelete($param)
    {
        // define the delete action
        $action = new TAction(array(__CLASS__, 'Delete'));
        $action->setParameters($param); // pass the key parameter ahead
        
        // shows a dialog to the user
        new TQuestion('Você realmente deseja cancelar a solicitação de cotação?', $action);
    }
    
    public function Delete($param)
    {
        try
        {
        
            TTransaction::open('permission');
            $preferences = SystemPreference::getAllPreferences();
            TTransaction::close();
            
            $key=$param['id']; // get the parameter $key
            TTransaction::open('uppertruck'); // open a transaction with database
            
            $cotacao = new Cotacao($key); // instantiates the Active Record
            $cotacao->status_id = 5;
            $cotacao->store();
            
            //atualizar para cancelado os orcamentos vinculados a cotacao
            $orcs=OrcamentoMotorista::where('cotacao_id', '=', $cotacao->id)
                                      ->where('status', 'IN', [1, 2, 3])->load();      
            foreach($orcs as $orc)
            {
                $orc->status = 6;
                $orc->store;
                $msg_motorista = $preferences['msg_cotacao_outros_motorista'];
                $motorista = new SystemUser($orc->motorista_id);
                $email = trim($motorista->email);
                $subject = 'Cotação cancelada pelo cliente';
                $arr = ['{msg_status}' => 'Pedido de orçamento cancelado, pois a cotação foi cancelada pelo cliente.', 
                        '{nome_motorista}' => $motorista->name];     
                if ($preferences['send_msg_motorista'])
                {
                    QueueSendUtil::put($email, $subject, $msg_motorista, $cotacao, $arr);
                }          
            }
            
            $msg_empresa = $preferences['msg_cotacao_outros_empresa'];
            $email = trim($preferences['mail_destiny1']);
            $subject = 'Solicitação de cotação cancelada pelo cliente';
            $arr = ['{msg_status}' => 'Solicitação de cotação cancelada pelo cliente.']; 
            if ($preferences['send_msg_empresa_cotacao'])
            {
                QueueSendUtil::put($email, $subject, $msg_empresa, $cotacao, $arr);
            }
            
            $msg_cliente = $preferences['msg_cotacao_outros_cliente'];
            $email = trim(TSession::getValue('usermail'));
            $subject = 'Solicitação de cotação cancelada';
            $arr = ['{msg_status}' => 'Confirmada o cancelamento da sua solicitação de cotação.']; 
            if ($preferences['send_msg_cliente'])
            {
                QueueSendUtil::put($email, $subject, $msg_cliente, $cotacao, $arr);
            }            
            //$repos = new TRepository('OrcamentoMotorista');
            //$criteria = new TCriteria;
            //$criteria->add(new TFilter('cotacao_id', '=', $key));
            //$repos->delete($criteria);
            
            
            //$cotacao->delete(); // deletes the object from the database
            TTransaction::close(); // close the transaction
            
            $pos_action = new TAction([__CLASS__, 'onReload']);
            new TMessage('info', 'Solicitação cancelada', $pos_action); // success message
        }
        catch (Exception $e) // in case of exception
        {
            new TMessage('error', $e->getMessage()); // shows the exception error message
            TTransaction::rollback(); // undo all pending operations
        }
    }
    
    
    public function displayOnDelete( $object )
    {
        if ($object->status_id == 1)  // cotação enviada e ainda em análise por parte da empresa
        {
            return TRUE;
        }
        return FALSE;
    }
    
    
    
    
    
    
    
    
}