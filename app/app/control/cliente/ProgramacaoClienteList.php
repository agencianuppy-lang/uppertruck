<?php
class ProgramacaoClienteList extends TStandardList
{
    protected $form;     // registration form
    
    protected $form_grid;
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
        $this->setActiveRecord('Programacao');       // defines the active record
        
        $this->addFilterField('id', 'like', 'id'); // filter field, operator, form field
        $this->addFilterField('status_transporte_id', 'like', 'status_transporte_id'); // filter field, operator, form field
        $this->addFilterField('status_pgmto_id', 'like', 'status_pgmto_id'); // filter field, operator, form field
        $this->addFilterField('avaliacao_pendente', 'like', 'avaliacao_pendente');
        $this->addFilterField('avaliacao', 'like', 'avaliacao');
      
        $this->setDefaultOrder('id', 'asc');  // define the default order
        
        
        $criteria1 = new TCriteria;
        $criteria1->add( new TFilter( 'cliente_id', '=', TSession::getValue('userid') ) ); // Listar apenas programacoes do cliente 
        $criteria2 = new TCriteria;
        $criteria2->add(new TFilter('avaliacao_pendente', '=', 1), TExpression::OR_OPERATOR); 
        $criteria2->add(new TFilter('status_pgmto_id', '=', 1), TExpression::OR_OPERATOR); 
        $criteria2->add(new TFilter('status_transporte_id', '!=', 4), TExpression::OR_OPERATOR); 
        
        $criteria = new TCriteria;     
        $criteria->add($criteria1); 
        $criteria->add($criteria2); 
       // echo $criteria->dump();
        parent::setCriteria($criteria);
        
        
        
        
        // creates the form
        $this->form = new BootstrapFormBuilder('form_programacao');
        $this->form->setFormTitle( 'Programação de embarques' );
        
        
        
        $filter = new TCriteria;
        $filter->add(new TFilter('cliente_id', '=', TSession::getValue('userid') ));  //clientes
        $cliente_id = new TDBCombo('id', 'uppertruck', 'Programacao', 'id', 'Id: {id}', 'id', $filter); 
        
        $status_transporte_id = new TDBCombo('status_transporte_id', 'uppertruck', 'StatusTransporte', 'id', 'descricao', 'id');
        $status_pgmto_id = new TDBCombo('status_pgmto_id', 'uppertruck', 'StatusPgmto', 'id', 'descricao', 'id');
        
        $avaliacao_pendente = new TCombo('avaliacao_pendente'); 
        $yesno = array();
        $yesno['1'] = 'Sim';
        $avaliacao_pendente->addItems($yesno);
        
        //$cliente_id = new TEntry('cliente_id');
        $this->form->addFields( [new TLabel('Id')], [$cliente_id] );
        $this->form->addFields( [new TLabel('Transporte')], [$status_transporte_id] );
        $this->form->addFields( [new TLabel('Pgmto')], [$status_pgmto_id] );
        $this->form->addFields( [new TLabel('Avaliação pendente')], [$avaliacao_pendente] );
        
        // add form actions
        $this->form->addAction('Buscar', new TAction([$this, 'onSearch']), 'fa:search blue');
        //$this->form->addActionLink('Nova',  new TAction(['StandardFormView', 'onClear']), 'fa:plus-circle green');
        $this->form->addActionLink('Limpar',  new TAction([$this, 'clear']), 'fa:eraser red');
        
        // keep the form filled with the search data
        $this->form->setData( TSession::getValue('StandardDataGridView_filter_data') );
        
        // creates the DataGrid
        $this->datagrid = new BootstrapDatagridWrapper(new TDataGrid);
        $this->datagrid->width = "100%";
        $this->datagrid->datatable = 'true'; // turn on Datatables
        //$this->datagrid->disableDefaultClick();
        
        // creates the datagrid columns
        $col_id           = new TDataGridColumn('id', 'Id', 'right');
        $col_data_coleta       = new TDataGridColumn('data_coleta', 'Coleta', 'left');    
        $col_data_entrega      = new TDataGridColumn('data_entrega', 'Entrega', 'left');
       // $col_km                = new TDataGridColumn('km', 'KM', 'left');
        $col_status_transporte  = new TDataGridColumn('status_transporte_id', 'Transporte', 'left'); 
        $col_status_pgmto       = new TDataGridColumn('status_pgmto_id', 'Pagamento', 'left'); 
        //$col_tipo_pgmto         = new TDataGridColumn('tipo_pgmto_id', 'Tipo Pagamento', 'left'); 
        $col_data_vencimento    = new TDataGridColumn('data_vencimento', 'Vencimento', 'left');
        $col_data_pgmto         = new TDataGridColumn('data_pgmto', 'Data pgmto', 'left');
       // $col_cte                = new TDataGridColumn('cte', 'Cte', 'left');
       // $col_cliente_id         = new TDataGridColumn('cliente_id', 'Cliente', 'left');
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
      //  $col_avaliacao_pendente = new TDataGridColumn('avaliacao_pen', 'Valor FAT', 'left');
      
        
        $col_status_pgmto->setDataProperty('style','font-weight: bold');
        $col_status_transporte->setDataProperty('style','font-weight: bold');
        
       // $col_avaliacao     = new TDataGridColumn('avaliacao', 'Valor FAT', 'left');
        
        
        
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
        
        
        
        ////até aqui
        
        
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
      
        
        $this->datagrid->addColumn($col_id);
        $this->datagrid->addColumn($col_data_coleta);
        $this->datagrid->addColumn($col_data_entrega);
       // $this->datagrid->addColumn($col_km);
        $this->datagrid->addColumn($col_status_transporte);
        $this->datagrid->addColumn($col_status_pgmto);
        //$this->datagrid->addColumn($col_tipo_pgmto);
        $this->datagrid->addColumn($col_data_vencimento);
        $this->datagrid->addColumn($col_data_pgmto);
       // $this->datagrid->addColumn($col_cte);
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
       
        
        
        
        $col_id->setAction( new TAction([$this, 'onReload']),   ['order' => 'id']);
        $col_data_coleta->setAction( new TAction([$this, 'onReload']), ['order' => 'data_coleta']);
        $col_origem->setAction( new TAction([$this, 'onReload']), ['order' => 'origem_cidade_id']);
        $col_destino->setAction( new TAction([$this, 'onReload']), ['order' => 'destino_cidade_id']);
        $col_tipo_produto->setAction( new TAction([$this, 'onReload']), ['order' => 'tipo_produto']);
        $col_valor_nf->setAction( new TAction([$this, 'onReload']), ['order' => 'valor_nf']);
        $col_valor_faturado->setAction( new TAction([$this, 'onReload']), ['order' => 'valor_faturado']);
        
        // define row actions
        $action1 = new TDataGridAction(['AvaliacaoClienteForm', 'onEdit'],   ['key' => '{id}'] );
        $action1->setDisplayCondition( array($this, 'displayOnEvaluate') );
        //$action2 = new TDataGridAction([$this, 'onDelete'], ['key' => '{id}'] );
         
        $this->datagrid->addAction($action1, 'Avaliar',   'fas:star blue');
        //$this->datagrid->addAction($action2, 'Deletar', 'far:trash-alt red');
        
        // create the datagrid model
        $this->datagrid->createModel();
        
        
        
         // creates the page navigation
        $this->pageNavigation = new TPageNavigation;
        $this->pageNavigation->setAction(new TAction(array($this, 'onReload')));
        
        //$panel = new TPanelGroup('Programação de embarques');
        //$panel->add($this->datagrid);
        //$panel->add($this->pageNavigation);
        //$panel->getBody()->style = "overflow-x:auto;";
        
        
        
       
        
        // creates the page structure using a table
        $vbox = new TVBox;
        $vbox->style = 'width: 100%';
        $vbox->add(new TXMLBreadCrumb('menu.xml', __CLASS__));
        $vbox->add($this->form);
        $vbox->add(TPanelGroup::pack('', $this->datagrid, $this->pageNavigation));
        //$vbox->add(TPanelGroup::pack('', $panel));
        
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
            //TForm::sendData('form_programacao', $obj); // envia os dados ao formulário
            $this->form->setData($obj);
        }
         
        
       
        //new TMessage('info', json_encode($data));
        
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
    
    
    
    public static function onEvaluate( $param )
    {
    
    }
    
    public function displayOnEvaluate( $object )
    {
        if ($object->avaliacao_pendente == 1)
        {
            return TRUE;
        }
        return FALSE;
    }
    
    
}

