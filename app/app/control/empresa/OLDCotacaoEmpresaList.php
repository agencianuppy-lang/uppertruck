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
      
        $this->setDefaultOrder('id', 'asc');  // define the default order
        
        // creates the form
        $this->form = new BootstrapFormBuilder('form_cotacao');
        $this->form->setFormTitle( 'Solicitações de cotações de clientes' );
        
        
        
        $filter = new TCriteria;
        $filter->add(new TFilter('grupo', '=', '3'));  //clientes
        $cliente_id = new TDBCombo('cliente_id', 'uppertruck', 'SystemUser', 'id', 'name', 'name', $filter); 
        
        $status_id = new TDBCombo('status_id', 'uppertruck', 'StatusCotacao', 'id', 'visao_empresa', 'id');
        
        //$cliente_id = new TEntry('cliente_id');
        $this->form->addFields( [new TLabel('Cliente')], [$cliente_id] );
        $this->form->addFields( [new TLabel('Situação')], [$status_id] );
        
        // add form actions
        $this->form->addAction('Buscar', new TAction([$this, 'onSearch']), 'fa:search blue');
        //$this->form->addActionLink('Nova',  new TAction(['StandardFormView', 'onClear']), 'fa:plus-circle green');
        $this->form->addActionLink('Limpar',  new TAction([$this, 'clear']), 'fa:eraser red');
        
        $filter_search = ['status_transporte_id' => 1, 'status_pgmto_id' => 2];
        $this->form->addAction('teste', new TAction(['ProgramacaoEmpresaList', 'OnSearch'], ['filter_search' => $filter_search ] ), 'fa:search blue');
     
        //new TAction([$this, 'onSearch'], ['static'=>'1'])
     
        
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
            
            if(!empty($value))
            {
              $estado = $cidade->get_estado();
              return "{$cidade->nome} - {$estado->uf}";
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
        $action1 = new TDataGridAction(['CotacaoEmpresaForm', 'onEdit'],   ['key' => '{id}'] );
        //$action2 = new TDataGridAction([$this, 'onDelete'], ['key' => '{id}'] );
         
        $this->datagrid->addAction($action1, 'Visualizar',   'far:edit blue');
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
}