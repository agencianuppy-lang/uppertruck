<?php

class CotacaoEmpresaList extends TStandardList
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
        
        $this->addFilterField('cliente_id', 'like', 'cliente_id'); // filter field, operator, form field
        $this->addFilterField('status_id', 'like', 'status_id'); // filter field, operator, form field

        $this->addFilterField('origem_estado_id', 'like', 'origem_estado_id'); // filter field, operator, form field
        $this->addFilterField('destino_estado_id', 'like', 'destino_estado_id'); // filter field, operator, form field
      
        $this->setDefaultOrder('id', 'asc');  // define the default order
        
        // creates the form
        $this->form = new BootstrapFormBuilder('form_cotacao');
        $this->form->setFormTitle( 'Solicitações de cotações de clientes' );
        
        
        
        $filter = new TCriteria;
        $filter->add(new TFilter('grupo', '=', '3'));  //clientes
        $cliente_id = new TDBCombo('cliente_id', 'uppertruck', 'SystemUser', 'id', 'name', 'name', $filter); 
        
        $status_id = new TDBCombo('status_id', 'uppertruck', 'StatusCotacao', 'id', 'visao_empresa', 'id');


        $origem_estado_id = new TDBCombo('origem_estado_id', 'uppertruck', 'Estado', 'id', '{nome} ({uf})');
        $destino_estado_id= new TDBCombo('destino_estado_id', 'uppertruck', 'Estado', 'id', '{nome} ({uf})');




        // $this->input['origem_estado_id']     = new TDBCombo('origem_estado_id', 'uppertruck', 'Estado', 'id', '{nome} ({uf})');
        // $this->input['origem_estado_id']->setChangeAction( new TAction( [$this, 'onChangeEstadoOrigem'] ) );
        // $this->input['origem_cidade_id']  = new TDBCombo('origem_cidade_id',  'uppertruck', 'Cidade', 'id', 'nome', 'nome', $filter);
        // $this->input['origem_cidade_id']->enableSearch();
        // $this->input['origem_estado_id']->enableSearch();
        // $this->input['destino_estado_id']     = new TDBCombo('destino_estado_id', 'uppertruck', 'Estado', 'id', '{nome} ({uf})');
        // $this->input['destino_estado_id']->setChangeAction( new TAction( [$this, 'onChangeEstadoDestino'] ) );
        // $this->input['destino_cidade_id'] = new TDBCombo('destino_cidade_id', 'uppertruck', 'Cidade', 'id', 'nome', 'nome', $filter);
        // $this->input['destino_cidade_id']->enableSearch();
        // $this->input['destino_estado_id']->enableSearch();


        
        //$cliente_id = new TEntry('cliente_id');
        $this->form->addFields( [new TLabel('Cliente')], [$cliente_id] );
        $this->form->addFields( [new TLabel('Situação')], [$status_id] );

        $this->form->addFields( [new TLabel('Origem UF')], [$origem_estado_id] );
        $this->form->addFields( [new TLabel('Destino UF')], [$destino_estado_id] );
        
        // add form actions
        $this->form->addAction('Buscar', new TAction([$this, 'onSearch']), 'fa:search blue');
        //$this->form->addActionLink('Nova',  new TAction(['StandardFormView', 'onClear']), 'fa:plus-circle green');

        //TODO: Nova cotação
        //$this->form->addAction('Nova cotação',  new TAction(['CotacaoEmpresaCadastramentoForm', 'onClear']), 'fa:plus-circle green');
        $this->form->addActionLink('Nova',  new TAction(['CotacaoEmpresaCadastramentoForm', 'onClear']), 'fa:plus-circle green');
        
        $this->form->addActionLink('Limpar',  new TAction([$this, 'clear']), 'fa:eraser red');
        
        $filter_search = ['status_transporte_id' => 1, 'status_pgmto_id' => 2];
        //$this->form->addAction('teste', new TAction(['ProgramacaoEmpresaList', 'OnSearch'], ['filter_search' => $filter_search ] ), 'fa:search blue');
     
        //new TAction([$this, 'onSearch'], ['static'=>'1'])
     
        
        // keep the form filled with the search data
        $this->form->setData( TSession::getValue('StandardDataGridView_filter_data') );
        
        // creates the DataGrid
        $this->datagrid = new BootstrapDatagridWrapper(new TDataGrid);
        $this->datagrid->width = "100%";
        
        // creates the datagrid columns
        $col_id           = new TDataGridColumn('id', 'Id', 'right');
        
        
        
        $col_data_pedido    = new TDataGridColumn('data_pedido', 'Solicitação / Alteração', 'left');    
       
        $col_cliente        = new TDataGridColumn('cliente_id', 'Cliente', 'left'); 
       
        $col_origem         = new TDataGridColumn('origem_cidade_id', 'Origem', 'left');
       
        $col_destino        = new TDataGridColumn('destino_cidade_id', 'Destino', 'left');

        $col_produto        = new TDataGridColumn('tipo_produto', 'Produto', 'left');
        $col_produto_desc   = new TDataGridColumn('produto_desc', 'Desc.', 'left');
        $col_valor_nf       = new TDataGridColumn('valor_nf', 'Valor NF', 'left'); 
        $col_valor_cotacao  = new TDataGridColumn('valor_cotacao', 'Valor Cotado', 'left');
        $col_status         = new TDataGridColumn('status_id', 'Situação', 'left'); 
      


        $col_cliente->setTransformer( function($value) {
          TTransaction::open('uppertruck');
          $cliente = new SystemUser($value);
          TTransaction::close();
          return $cliente->name; 
        });
        
        $col_produto->setTransformer( function($value) {
            TTransaction::open('uppertruck');
            $produto = new TipoProduto($value);
            TTransaction::close();
            return $produto->descricao; 
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
        
        $col_destino->setTransformer( function($value, $obj) { 
            TTransaction::open('uppertruck');
            $cidade = new Cidade($value);
            TTransaction::close();
            
            if(!empty($value))
            {
              $estado = $cidade->get_estado();
              return "{$cidade->nome} - {$estado->uf}";
            }
            else
            {
              TTransaction::open('uppertruck');
              $estado = new Estado($obj->destino_estado_id);
              TTransaction::close();
              return $estado->uf;
            } 
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
                case '1': // Analisar
                  $class = 'danger';
                  break;
                case '2': // Com cliente
                  $class = 'warning';
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
            $label = $status->visao_empresa;
            $div = new TElement('span');
            $div->class="label label-{$class}";
            $div->style="text-shadow:none; font-size:12px; font-weight:lighter";
            $div->add($label); 
            return $div;
        });  
      
        
        //$this->datagrid->addColumn($col_id);
        $this->datagrid->addColumn($col_data_pedido);
        $this->datagrid->addColumn($col_cliente);
        $this->datagrid->addColumn($col_origem);
        $this->datagrid->addColumn($col_destino);
        $this->datagrid->addColumn($col_produto);
        $this->datagrid->addColumn($col_produto_desc);
        $this->datagrid->addColumn($col_valor_nf);
        $this->datagrid->addColumn($col_valor_cotacao);
        $this->datagrid->addColumn($col_status);
        
        
        //$col_id->setAction( new TAction([$this, 'onReload']),   ['order' => 'id']);
        $col_data_pedido->setAction( new TAction([$this, 'onReload']), ['order' => 'data_pedido']);
        $col_origem->setAction( new TAction([$this, 'onReload']), ['order' => 'origem_cidade_id']);
        $col_destino->setAction( new TAction([$this, 'onReload']), ['order' => 'destino_cidade_id']);
        $col_produto->setAction( new TAction([$this, 'onReload']), ['order' => 'tipo_produto']);
        $col_valor_nf->setAction( new TAction([$this, 'onReload']), ['order' => 'valor_nf']);
        $col_valor_cotacao->setAction( new TAction([$this, 'onReload']), ['order' => 'valor_cotacao']);

        $col_produto_desc->setAction( new TAction([$this, 'onReload']), ['order' => 'produto_desc']);
        //$col_cliente->setAction( new TAction([$this, 'onReload']), ['order' => 'cliente_id']);

        
        // define row actions
        $action1 = new TDataGridAction(['CotacaoEmpresaForm', 'onEdit'],   ['key' => '{id}'] );
        $action2 = new TDataGridAction(['SystemUserForm', 'onEdit'],   ['key' => '{cliente_id}'] );
        $action3 = new TDataGridAction(['CotacaoEmpresaCadastramentoForm', 'onEdit'],   ['key' => '{id}'] );


        $action4 = new TDataGridAction([$this, 'onProgramacao'], ['key' => '{id}'] );
        $action4->setDisplayCondition( array($this, 'displayOnProgramacao') );



        //$action2 = new TDataGridAction([$this, 'onDelete'], ['key' => '{id}'] );
         
        $this->datagrid->addAction($action4, 'Nova programação',   'fa:truck-loading blue');

        $this->datagrid->addAction($action1, 'Visualizar',   'fa:search blue');
        $this->datagrid->addAction($action3, 'Editar',   'far:edit blue');
        $this->datagrid->addAction($action2, 'Cliente',   'far:user blue');
        //$this->datagrid->addAction($action2, 'Deletar', 'far:trash-alt red');
        
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
    
    /**
     * Clear filters
     */
    function clear()
    {
        $this->clearFilters();
        $this->onReload();
    }


    public function displayOnProgramacao( $object )
    {
        if ($object->status_id == 3)  // cotação aceita pelo cliente
        {
            return TRUE;
        }
        return FALSE;
    }


    public function onProgramacao($param)
    {
        // define the delete action
        $action = new TAction(array(__CLASS__, 'Programacao'));
        $action->setParameters($param); // pass the key parameter ahead
        
        // shows a dialog to the user
        new TQuestion('Confirma cadastro de nova programação?', $action);
    }
    
    public function Programacao($param)
    {
      try 
      { 
      
          
      
      
          // open transaction 
          TTransaction::open('uppertruck');
          //$data = $this->form->getData();

          // find customer
          $key = $param['id'];
          $cotacao = new Cotacao($key);

          // check if found
          if ($cotacao) 
          { 
              
              $cotacao->status_id = 3;
              $programacao = new Programacao;
              $programacao->cotacao_id            = $cotacao->id;
              $programacao->cliente_id            = $cotacao->cliente_id;
              $programacao->embalagem_id          = $cotacao->embalagem_id;
              $programacao->valor_faturado        = $cotacao->valor_cotacao;
              $programacao->origem_cidade_id      = $cotacao->origem_cidade_id;
              $programacao->destino_cidade_id     = $cotacao->destino_cidade_id;
              $programacao->kg                    = $cotacao->kg;
              $programacao->volumes               = $cotacao->volumes;
              $programacao->m3                    = $cotacao->m3;
              $programacao->tipo_produto          = $cotacao->tipo_produto;
              $programacao->valor_nf              = $cotacao->valor_nf;
              $programacao->status_transporte_id  = 1;  // pendente de agendamento
              $programacao->status_pgmto_id       = 1;  // pagamento pendente
              
              //carregar orcamentos aceitos vinculados a cotação - deve haver no máximo 1
              $orcs = OrcamentoMotorista::where('cotacao_id', '=', $cotacao->id)
                                          ->where('status', '=', 3 )->load();
              if(count($orcs)>=1) // se achou orcamento aceito atualizar a programacao com os dados
              {
                  $programacao->motorista_id    = $orcs[0]->motorista_id;
                  $programacao->valor_motorista = $orcs[0]->valor;              
              }          
              $programacao->store();
              $cotacao->programacao_id = $programacao->id;
              $cotacao->store();
              
              // $msg_empresa = $preferences['msg_aceite_cotacao_empresa'];
              // $msg_cliente = $preferences['msg_aceite_cotacao_cliente'];
              //  //colocar email para empresa na fila de envio
              // $email = trim($preferences['mail_destiny1']);
              // $subject = 'Cotação aceita pelo cliente';
              // if ($preferences['send_msg_empresa_cotacao'])
              // {
              //     QueueSendUtil::put($email, $subject, $msg_empresa, $cotacao);
              // }
              
              // //colocar email para cliente na fila de envio
              // $email = trim(TSession::getValue('usermail'));
              // $subject = 'Confirmação de aceite de cotação - Uppertruck';
              // if ($preferences['send_msg_cliente'])
              // {
              //     QueueSendUtil::put($email, $subject, $msg_cliente, $cotacao);
              // }
              
              
          } 

          //new TMessage('info', 'Cotação aceita!'); 
          TTransaction::close(); // close transaction 
          // shows the success message
          $pos_action = new TAction(['ProgramacaoEmpresaForm', 'onEdit']);
          $pos_action->setParameters(['id' => $cotacao->programacao_id]);  
          //$pos_action->setParameter('key', `$cotacao->programacao_id`);
          new TMessage('info', 'Programação cadastrada', $pos_action);
          
          
          
      } 
      catch (Exception $e) 
      { 
          new TMessage('error', $e->getMessage()); 
          TTransaction::rollback();
      } 
  
    }



}