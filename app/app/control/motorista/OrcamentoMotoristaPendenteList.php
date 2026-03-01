<?php
class OrcamentoMotoristaPendenteList extends TStandardList
{

    protected $datagrid;  // datagrid
    protected $loaded;
    protected $pageNavigation;  // pagination component
    
    // trait with onSave, onEdit, onDelete, onReload, onSearch...
     use Adianti\Base\AdiantiStandardListTrait;
    
    /**
     * Class constructor
     * Creates the page, the form and the listing
     */
    public function __construct()
    {
        parent::__construct();
        
        $this->setDatabase('uppertruck'); // define the database
        $this->setActiveRecord('Cotacao'); // define the Active Record
        $this->setDefaultOrder('id', 'asc'); // define the default order
        $this->setLimit(-1); // turn off limit for datagrid
        
        
        TTransaction::open('uppertruck');
        $motorista_id = TSession::getValue('userid');
        $criteria = new TCriteria;
        $criteria->add( new TFilter( 'motorista_id', '=', $motorista_id  ) ); // Listar apenas orçamentos do motorista logado
        $criteria->add( new TFilter( 'status', '=', '1'  ) ); // pendente de reposta do motorista
        $repos = new TRepository('OrcamentoMotorista');
        $orcamentos = $repos->load($criteria);
        $cotacoes_id = [];
        foreach ($orcamentos as $orcamento)
        {
            $cotacoes_id[] = $orcamento->cotacao_id;
        }
        TTransaction::close();
        
        
        $criteria2 = new TCriteria;
        $criteria2->add( new TFilter( 'id', 'IN', $cotacoes_id  ) ); // Listar apenas cotacoes do motorista logado
        //echo $criteria->dump();
        
        $show = true;
        if ( count($cotacoes_id) >= 1 )
        {
            parent::setCriteria($criteria2);
        }
        else
        {
            $show = false;
        }
        
        
        // create the datagrid
        $this->datagrid = new BootstrapDatagridWrapper(new TDataGrid);
        $this->datagrid->width = '100%';
        
        // add the columns
        $col_id           = new TDataGridColumn('id', 'Id', 'right');
        $col_data_pedido  = new TDataGridColumn('data_pedido', 'Solicitação / Alteração', 'left');    
        $col_origem       = new TDataGridColumn('origem_cidade_id', 'Origem', 'left');
        $col_destino      = new TDataGridColumn('destino_cidade_id', 'Destino', 'left');
        $col_produto      = new TDataGridColumn('tipo_produto', 'Produto', 'left');
        $col_valor_nf     = new TDataGridColumn('valor_nf', 'Valor NF', 'left');      
        
        
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
         $col_produto->setTransformer( function($value) {
            TTransaction::open('uppertruck');
            $produto = new TipoProduto($value);
            TTransaction::close();
            return $produto->descricao; 
        });
        
        
        
        $this->datagrid->addColumn($col_id);
        $this->datagrid->addColumn($col_data_pedido);
        $this->datagrid->addColumn($col_origem);
        $this->datagrid->addColumn($col_destino);
        $this->datagrid->addColumn($col_produto);
        $this->datagrid->addColumn($col_valor_nf);
        
        $col_id->setAction( new TAction([$this, 'onReload']),   ['order' => 'id']);
        $col_data_pedido->setAction( new TAction([$this, 'onReload']), ['order' => 'name']);
        
        // define row actions
        $action1 = new TDataGridAction(['OrcamentoMotoristaPendenteForm', 'onEdit'],   ['key' => '{id}'] );
        //$action2 = new TDataGridAction([$this, 'onDelete'], ['key' => '{id}'] );
         
        $this->datagrid->addAction($action1, 'Visualizar',   'fa:search blue');
        //$this->datagrid->addAction($action2, 'Recusar solicitação de orçamento', 'far:trash-alt red');
        
        // create the datagrid model
        $this->datagrid->createModel();
        
        
        // wrap objects inside a table
        $vbox = new TVBox;
        $vbox->style = 'width: 100%';
        $vbox->add(new TXMLBreadCrumb('menu.xml', __CLASS__));
        
        
        if ($show)
        {
            $vbox->add(TPanelGroup::pack('', $this->datagrid));
        }
        else
        {
            $msg = new TTextDisplay('Sem solicitação de orçamento pendente', 'black', 12, 'bi');
            $vbox->add($msg);
        }
        
        
        
//         $obj = new StdClass;
//         $obj->data_pedido  = date('Y-m-d');
//         TForm::sendData('form_cotacao', $obj);
        
        
        // pack the table inside the page
        parent::add($vbox);
        
    }
    
    
    
    
    
    public function Delete($param)
    {
        try
        {
            $key=$param['id']; // get the parameter $key
            TTransaction::open('uppertruck'); // open a transaction with database
            
            $repos = new TRepository('OrcamentoMotorista');
            $criteria = new TCriteria;
            $criteria->add(new TFilter('cotacao_id', '=', $key));
            $repos->delete($criteria);
            
            $object = new Cotacao($key); // instantiates the Active Record
            $object->delete(); // deletes the object from the database
            TTransaction::close(); // close the transaction
            
            $pos_action = new TAction([__CLASS__, 'onReload']);
            new TMessage('info', AdiantiCoreTranslator::translate('Record deleted'), $pos_action); // success message
        }
        catch (Exception $e) // in case of exception
        {
            new TMessage('error', $e->getMessage()); // shows the exception error message
            TTransaction::rollback(); // undo all pending operations
        }
    }
    
    
    
    
    
    
    
}
