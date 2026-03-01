<?php

class ProgramacaoMotoristaList extends TStandardList
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
        
        
        
        //$criteria = new TCriteria;
        //$criteria->add( new TFilter( 'motorista_id', '=', TSession::getValue('userid')  ) ); // Listar apenas programacões do motorista logado 
        
       
       
        $criteria1 = new TCriteria;
        $criteria1->add( new TFilter( 'motorista_id', '=', TSession::getValue('userid') ) ); // Listar apenas programacoes do cliente 
        $criteria2 = new TCriteria;
        $criteria2->add(new TFilter('avaliacao_pendente', '=', 1), TExpression::OR_OPERATOR); 
        $criteria2->add(new TFilter('status_pgmto_id', '=', 1), TExpression::OR_OPERATOR); 
        $criteria2->add(new TFilter('status_transporte_id', '!=', 4), TExpression::OR_OPERATOR); 
         
        $criteria = new TCriteria;     
        $criteria->add($criteria1); 
        $criteria->add($criteria2); 
       
        parent::setCriteria($criteria);
       
        
        
        $this->setDatabase('uppertruck');        // defines the database
        $this->setActiveRecord('Programacao');       // defines the active record
        
        $this->addFilterField('id', 'like', 'id'); 
        $this->addFilterField('status_transporte_id', 'like', 'status_transporte_id'); // filter field, operator, form field
        //$this->addFilterField('status_pgmto_id', 'like', 'status_pgmto_id'); // filter field, operator, form field
      
        $this->setDefaultOrder('id', 'asc');  // define the default order
        
        // creates the form
        $this->form = new BootstrapFormBuilder('form_programacao');
        $this->form->setFormTitle( 'Programação de embarques' );
        
        
        
        //$filter = new TCriteria;
        //$filter->add(new TFilter('grupo', '=', '3'));  //clientes
        //$cliente_id = new TDBCombo('cliente_id', 'uppertruck', 'SystemUser', 'id', 'name', 'name', $filter); 
        $id = new TEntry('id');
        $status_transporte_id = new TDBCombo('status_transporte_id', 'uppertruck', 'StatusTransporte', 'id', 'descricao', 'id');
        //$status_pgmto_id = new TDBCombo('status_pgmto_id', 'uppertruck', 'StatusPgmto', 'id', 'descricao', 'id');
        
        //$cliente_id = new TEntry('cliente_id');
        //$this->form->addFields( [new TLabel('Cliente')], [$cliente_id] );
        $this->form->addFields( [new TLabel('ID')], [$id] );
        $this->form->addFields( [new TLabel('Situação transporte')], [$status_transporte_id] );
        //$this->form->addFields( [new TLabel('Situação Pgmto')], [$status_pgmto_id] );
        
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
        $this->datagrid->disableDefaultClick();
        
        // creates the datagrid columns
        $col_id           = new TDataGridColumn('id', 'Id', 'right');
        $col_data_coleta       = new TDataGridColumn('data_coleta', 'Coleta', 'left');    
        $col_data_entrega      = new TDataGridColumn('data_entrega', 'Entrega', 'left');
        $col_km                = new TDataGridColumn('km', 'KM', 'left');
        $col_status_transporte  = new TDataGridColumn('status_transporte_id', 'Transporte', 'left'); 
        //$col_status_pgmto       = new TDataGridColumn('status_pgmto_id', 'Pagamento', 'left'); 
        //$col_tipo_pgmto         = new TDataGridColumn('tipo_pgmto_id', 'Tipo Pagamento', 'left'); 
        //$col_data_vencimento    = new TDataGridColumn('data_vencimento', 'Vencimento', 'left');
        //$col_data_pgmto         = new TDataGridColumn('data_pgmto', 'Data pgmto', 'left');
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
        //$col_valor_faturado     = new TDataGridColumn('valor_faturado', 'Valor FAT', 'left');
        $col_valor_motorista    = new TDataGridColumn('valor_motorista','Valor TAC', 'left');
        //$col_valor_icms         = new TDataGridColumn('valor_icms','ICMS', 'left');
        //$col_valor_seguro       = new TDataGridColumn('valor_seguro','Seguro', 'left');
        //$col_valor_comissao     = new TDataGridColumn('valor_comissao','Comissao', 'left');
        //$col_valor_gris         = new TDataGridColumn('valor_gris','GRIS', 'left');
        //$col_valor_simples      = new TDataGridColumn('valor_simples','SN', 'left');
        //$col_outros_descontos   = new TDataGridColumn('outros_descontos','Outros', 'left');
        //$col_fat_liquido        = new TDataGridColumn('fat_liquido','Fat. Líquido', 'left');
        $col_obs                = new TDataGridColumn('obs','Obs.', 'left');
        
        //$col_status_pgmto->setDataProperty('style','font-weight: bold');
        $col_status_transporte->setDataProperty('style','font-weight: bold');
        
        
        
        
        
        $col_data_coleta->setTransformer( function($value) {
            return TDate::convertToMask($value, 'yyyy-mm-dd', 'dd/mm/yyyy');
        });
        $col_data_entrega->setTransformer( function($value) {
            return TDate::convertToMask($value, 'yyyy-mm-dd', 'dd/mm/yyyy');
        });
//         $col_data_vencimento->setTransformer( function($value) {
//             return TDate::convertToMask($value, 'yyyy-mm-dd', 'dd/mm/yyyy');
//         });
//         $col_data_pgmto->setTransformer( function($value) {
//             return TDate::convertToMask($value, 'yyyy-mm-dd', 'dd/mm/yyyy');
//         });
        
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
//         $col_valor_faturado->setTransformer( function($value) {
//             if (is_numeric($value)) {
//                 return 'R$&nbsp;'.number_format($value, 2, ',', '.');
//             }
//             return $value;
//         });
        $col_valor_motorista->setTransformer( function($value) {
            if (is_numeric($value)) {
                return 'R$&nbsp;'.number_format($value, 2, ',', '.');
            }
            return $value;
        });
//         $col_valor_icms->setTransformer( function($value) {
//             if (is_numeric($value)) {
//                 return 'R$&nbsp;'.number_format($value, 2, ',', '.');
//             }
//             return $value;
//         });
//         $col_valor_seguro->setTransformer( function($value) {
//             if (is_numeric($value)) {
//                 return 'R$&nbsp;'.number_format($value, 2, ',', '.');
//             }
//             return $value;
//         });
//         $col_valor_comissao->setTransformer( function($value) {
//             if (is_numeric($value)) {
//                 return 'R$&nbsp;'.number_format($value, 2, ',', '.');
//             }
//             return $value;
//         });
//         $col_valor_gris->setTransformer( function($value) {
//             if (is_numeric($value)) {
//                 return 'R$&nbsp;'.number_format($value, 2, ',', '.');
//             }
//             return $value;
//         });
//         $col_valor_simples->setTransformer( function($value) {
//             if (is_numeric($value)) {
//                 return 'R$&nbsp;'.number_format($value, 2, ',', '.');
//             }
//             return $value;
//         });
//         $col_outros_descontos->setTransformer( function($value) {
//             if (is_numeric($value)) {
//                 return 'R$&nbsp;'.number_format($value, 2, ',', '.');
//             }
//             return $value;
//         });
//         $col_fat_liquido->setTransformer( function($value) {
//             if (is_numeric($value)) {
//                 return 'R$&nbsp;'.number_format($value, 2, ',', '.');
//             }
//             return $value;
//         });
        
        
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
        
//         $col_status_pgmto->setTransformer( function($value, $obj, $row) {
//             TTransaction::open('uppertruck');
//             $status = new StatusPgmto($value);
//             TTransaction::close();
//            
//             
//             $label = $status->descricao;
//             switch ($value) 
//             {
//                 case '1': // Pgmto pendente
//                   $class = 'danger';
//                   break;
//                 case '2': // Pgmto confirmado
//                   $class = 'success';
//                   break;
//                 default:
//                   return "<span>$label</span>";
//                   break;
//             }
//             $label = $status->descricao;
//             $div = new TElement('span');
//             $div->class="label label-{$class}";
//             $div->style="text-shadow:none; font-size:12px;";
//             $div->add($label); 
//             return $div;
//            
//         });  
      
      
      
      
        // cria as ações da datagrid
        //$act_conf_coleta  = new TDataGridAction([$this, 'onConfColeta'],  [ 'id' => '{id}']);
        //$act_conf_entrega = new TDataGridAction([$this, 'onConfEntrega'], [ 'id' => '{id}']);
        
        // define labels é ícones usando a biblioteca Font Awesome
        //$act_conf_coleta->setLabel('Confirmar coleta');
        //$act_conf_coleta->setImage('fa:thumbs-up green');
        //$act_conf_entrega->setLabel('Confirmar entrega');
        //$act_conf_entrega->setImage('fa:thumbs-up green');
        
        //define as condições de exibição das ações
        //$act_conf_coleta->setDisplayCondition( array($this, 'displayConfColeta') );
        //$act_conf_entrega->setDisplayCondition( array($this, 'displayConfEntrega') );
        
        // cria o agrupamento de ações
        //$action_group = new TDataGridActionGroup('Opções', 'fa:th');
        // adiciona as ações ao agrupamento
        //$action_group->addHeader('Opções');
        //$action_group->addAction($act_conf_coleta);
        //$action_group->addAction($act_conf_entrega);
        //$this->datagrid->addActionGroup($action_group); // adiciona o agrupamento
        
      
      
      
        $act_conf_coleta  = new TDataGridAction([$this, 'onConfColeta'],  [ 'id' => '{id}']);
        $act_conf_coleta->setDisplayCondition( array($this, 'displayConfColeta') );
        $this->datagrid->addAction($act_conf_coleta, 'Confirmar coleta', 'fa:truck-loading blue');
        
        //$act_conf_entrega  = new TDataGridAction([$this, 'onConfEntrega'],  [ 'id' => '{id}']);
        $act_conf_entrega  = new TDataGridAction(['ImgConfEntregaMotoristaForm', 'onEdit'],  [ 'id' => '{id}']);
        $act_conf_entrega->setDisplayCondition( array($this, 'displayConfEntrega') );
        $this->datagrid->addAction($act_conf_entrega, 'Confirmar ENTREGA', 'fa:thumbs-up green');
      
      
      
        
        $this->datagrid->addColumn($col_id);
        $this->datagrid->addColumn($col_data_coleta);
        $this->datagrid->addColumn($col_data_entrega);
        $this->datagrid->addColumn($col_km);
        $this->datagrid->addColumn($col_status_transporte);
        //$this->datagrid->addColumn($col_status_pgmto);
        //$this->datagrid->addColumn($col_tipo_pgmto);
        //$this->datagrid->addColumn($col_data_vencimento);
        //$this->datagrid->addColumn($col_data_pgmto);
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
        //$this->datagrid->addColumn($col_valor_faturado);
        $this->datagrid->addColumn($col_valor_motorista);
        //$this->datagrid->addColumn($col_valor_icms);
        //$this->datagrid->addColumn($col_valor_seguro);
        //$this->datagrid->addColumn($col_valor_comissao);
        //$this->datagrid->addColumn($col_valor_gris);
        //$this->datagrid->addColumn($col_valor_simples);
        //$this->datagrid->addColumn($col_outros_descontos);
        //$this->datagrid->addColumn($col_fat_liquido);
        $this->datagrid->addColumn($col_obs);
        
        
        
        
        $col_id->setAction( new TAction([$this, 'onReload']),   ['order' => 'id']);
        $col_data_coleta->setAction( new TAction([$this, 'onReload']), ['order' => 'data_coleta']);
        $col_origem->setAction( new TAction([$this, 'onReload']), ['order' => 'origem_cidade_id']);
        $col_destino->setAction( new TAction([$this, 'onReload']), ['order' => 'destino_cidade_id']);
        $col_tipo_produto->setAction( new TAction([$this, 'onReload']), ['order' => 'tipo_produto']);
        $col_valor_nf->setAction( new TAction([$this, 'onReload']), ['order' => 'valor_nf']);
        //$col_valor_faturado->setAction( new TAction([$this, 'onReload']), ['order' => 'valor_faturado']);
        
        // define row actions
        //$action1 = new TDataGridAction(['ProgramacaoMotoristaForm', 'onEdit'],   ['key' => '{id}'] );
        //$action2 = new TDataGridAction([$this, 'onDelete'], ['key' => '{id}'] );
         
        //$this->datagrid->addAction($action1, 'Editar',   'far:edit blue');
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
    
    
    
    public function displayConfColeta( $obj )
    {   
        if ( $obj->status_transporte_id == 2 AND $obj->data_coleta == date('Y-m-d'))  // coleta agendada e data coleta data de hoje
        {
            //new TMessage ('info', json_encode($obj->data_coleta));
            return true;
        }
        return false;    
    }
    public function displayConfEntrega( $obj )
    {   
        if ( $obj->status_transporte_id == 3 )  // em transporte
        {
            return true;
        }
        return false;    
    }
    
    
    public static function onConfColeta($param)
    {
        $action = new TAction(array(__CLASS__, 'ConfColeta'));
        $action->setParameters($param); // pass the key parameter ahead
        new TQuestion('Confirma a COLETA/EMBARQUE?', $action);
    }
    
//     public static function onConfEntrega($param)
//     {
//         
//         
//         //$action = new TAction(array(__CLASS__, 'ConfEntrega'));
//         
//         $action = new TAction(array('ImgConfEntregaMotoristaForm', 'onEdit'));
//         $action->setParameters($param); // pass the key parameter ahead
//         new TQuestion('Confirma a ENTREGA?', $action);
//         
//     }
    
    public static function ConfColeta($param)
    {
        try
        {
        
            $key=$param['id']; // get the parameter $key
           
            
            TTransaction::open('uppertruck'); // open a transaction with database               
            $programacao = new Programacao($key);
            $programacao->status_transporte_id = 3; // em transporte
            $programacao->store();
            
            QueueSendTransporte::put($programacao, 'registrar_coleta');
            
            TTransaction::close(); // close the transaction
           
            $act = new TAction([__CLASS__, 'onReload']);
            new TMessage('info', 'Coleta confirmada com sucesso - produto agora em transporte', $act); // success message
        }
        catch (Exception $e) // in case of exception
        {
            new TMessage('error', $e->getMessage()); // shows the exception error message
            TTransaction::rollback(); // undo all pending operations
        } 
    }
    
    
    
    
//     public static function ConfEntrega($param)
//     {
//     try
//         {
//         
//             $key=$param['id']; // get the parameter $key
//            
//             
//             TTransaction::open('uppertruck'); // open a transaction with database               
//             $programacao = new Programacao($key);
//             $programacao->status_transporte_id = 4; // Entrege
//             $programacao->data_entrega = date('Y-m-d');
//             
//             if (!$programacao->avaliacao_pendente OR $programacao->avaliacao_pendente == 0 )
//             {
//                 $programacao->avaliacao_pendente = 1;
//             }
//             $programacao->store();
//             
//             
//             
//             $repos = new TRepository('OrcamentoMotorista');
//             $criteria = new TCriteria;
//             $criteria->add(new TFilter('cotacao_id', '=', $programacao->cotacao->id)); 
//             $values = array('finalizado' => 1);
//             $repos->update($values, $criteria);
//             
//             
//             
//             
//             
//             
//             TTransaction::close(); // close the transaction
//             $act = new TAction([__CLASS__, 'OnReload']);
//             new TMessage('info', 'ENTREGA confirmada com sucesso.', $act); // success message
//         }
//         catch (Exception $e) // in case of exception
//         {
//             new TMessage('error', $e->getMessage()); // shows the exception error message
//             TTransaction::rollback(); // undo all pending operations
//         } 
//         
//     }
    
    
    
    
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
    
    
    
    
    
    
    
    
    
    
    
    
}
