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
        $this->addFilterField('pagador_id', 'like', 'pagador_id'); // filter field, operator, form field
        $this->addFilterField('status_id', 'like', 'status_id'); // filter field, operator, form field

        $this->addFilterField('origem_estado_id', 'like', 'origem_estado_id'); // filter field, operator, form field
        $this->addFilterField('destino_estado_id', 'like', 'destino_estado_id'); // filter field, operator, form field
      
        

        $this->addFilterField('origem_cidade_id',  'like', 'origem_cidade_id'); // filter field, operator, form field
        $this->addFilterField('destino_cidade_id', 'like', 'destino_cidade_id'); // filter field, operator, form field





        $this->setDefaultOrder('id', 'asc');  // define the default order
        
        // creates the form
        $this->form = new BootstrapFormBuilder('form_cotacao');
        $this->form->setFormTitle( 'Solicitações de cotações de clientes' );
        
        
        
        $filter = new TCriteria;
        $filter->add(new TFilter('grupo', '=', '3'));  //clientes
        //$cliente_id = new TDBCombo('cliente_id', 'uppertruck', 'SystemUser', 'id', 'name', 'name', $filter); 
        $cliente_id = new TDBUniqueSearch('cliente_id', 'uppertruck', 'SystemUser', 'id', 'name', 'name', $filter);
        $pagador_id = new TDBUniqueSearch('pagador_id', 'uppertruck', 'SystemUser', 'id', 'name', 'name', $filter);
        
        $status_id = new TDBCombo('status_id', 'uppertruck', 'StatusCotacao', 'id', 'visao_empresa', 'id');


        $origem_estado_id = new TDBCombo('origem_estado_id', 'uppertruck', 'Estado', 'id', '{nome} ({uf})');
        $destino_estado_id= new TDBCombo('destino_estado_id', 'uppertruck', 'Estado', 'id', '{nome} ({uf})');

        $origem_estado_id->setChangeAction( new TAction( [$this, 'onChangeEstadoOrigem'] ) );
        $destino_estado_id->setChangeAction( new TAction( [$this, 'onChangeEstadoDestino'] ) );

        $origem_estado_id->enableSearch();
        $destino_estado_id->enableSearch();


        //$filter = new TCriteria;
        //$filter->add(new TFilter('id', '<', '0'));

        $estadoOrigemIdFilter =  TSession::getValue('CotacaoEmpresaList_origem_cidade_filter')  ? TSession::getValue('CotacaoEmpresaList_origem_cidade_filter') : -1;
        $estadoDestinoIdFilter = TSession::getValue('CotacaoEmpresaList_destino_cidade_filter') ? TSession::getValue('CotacaoEmpresaList_destino_cidade_filter') : -1;
        $filterOrigem = new TCriteria;
        $filterOrigem->add(new TFilter('estado_id', '=', $estadoOrigemIdFilter));
        $filterDestino = new TCriteria;
        $filterDestino->add(new TFilter('estado_id', '=', $estadoDestinoIdFilter));
        // TSession::getValue('CotacaoEmpresaList_origem_cidade_filter');
       // TSession::getValue('CotacaoEmpresaList_destino_cidade_filter');

        $origem_cidade_id  = new TDBCombo('origem_cidade_id',  'uppertruck', 'Cidade', 'id', 'nome', 'nome', $filterOrigem);
        $destino_cidade_id = new TDBCombo('destino_cidade_id',  'uppertruck', 'Cidade', 'id', 'nome', 'nome', $filterDestino);

        $origem_cidade_id->enableSearch();
        $destino_cidade_id->enableSearch();




        $cliente_id->setSize('100%');
        $pagador_id->setSize('100%');
        $status_id->setSize('100%');
        $origem_estado_id->setSize('100%');
        $destino_estado_id->setSize('100%');
        $origem_cidade_id->setSize('100%');
        $destino_cidade_id->setSize('100%');
        










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
        $this->form->addFields( [new TLabel('Pagador')], [$pagador_id] );
        $this->form->addFields( [new TLabel('Situação')], [$status_id] );

        $this->form->addFields( [new TLabel('Origem UF')], [$origem_estado_id] );
        $this->form->addFields( [new TLabel('Cidade Origem')], [$origem_cidade_id] );
        $this->form->addFields( [new TLabel('Destino UF')], [$destino_estado_id] );
        $this->form->addFields( [new TLabel('Cidade Destino')], [$destino_cidade_id] );
        
        // add form actions
        $this->form->addAction('Buscar', new TAction([$this, 'onSearch']), 'fa:search blue');
        //$this->form->addActionLink('Nova',  new TAction(['StandardFormView', 'onClear']), 'fa:plus-circle green');

        //TODO: Nova cotação
        $this->form->addActionLink('Nova cotação',  new TAction(['CotacaoEmpresaCadastramentoForm', 'onClear']), 'fa:plus-circle green');
        $this->form->addActionLink('Limpar',  new TAction([$this, 'clear']), 'fa:eraser red');
        
        $filter_search = ['status_transporte_id' => 1, 'status_pgmto_id' => 2];
        //$this->form->addAction('teste', new TAction(['ProgramacaoEmpresaList', 'OnSearch'], ['filter_search' => $filter_search ] ), 'fa:search blue');
     
        //new TAction([$this, 'onSearch'], ['static'=>'1'])
     
        
        // keep the form filled with the search data
        $this->form->setData( TSession::getValue('StandardDataGridView_filter_data') );




        $this->form->addExpandButton( "", "fa:grip-lines", false);



        
        // creates the DataGrid
        $this->datagrid = new BootstrapDatagridWrapper(new TDataGrid);
        $this->datagrid->width = "100%";
        $this->datagrid->datatable = 'true'; // turn on Datatables
        
        // creates the datagrid columns
        $col_id           = new TDataGridColumn('id', 'Id', 'right');
        
        
        
        $col_data_pedido    = new TDataGridColumn('data_pedido', 'Data', 'left');   //data_pedido 
        $col_cliente        = new TDataGridColumn('cliente_id', 'Cliente', 'left');   //cliente_id
        $col_pagador        = new TDataGridColumn('pagador_id', 'Pagador', 'left'); 
        $col_origem         = new TDataGridColumn('origem_cidade_id', 'Origem', 'left');
        $col_destino        = new TDataGridColumn('destino_cidade_id', 'Destino', 'left'); //destino_cidade
        $col_produto        = new TDataGridColumn('tipo_produto', 'Produto', 'left'); //tipo_produto
        $col_produto_desc   = new TDataGridColumn('produto_desc', 'Desc.', 'left'); //produto_desc
        $col_kg       = new TDataGridColumn('kg', 'Peso KG', 'left'); //kg
        $col_volumes  = new TDataGridColumn('volumes', 'Vol', 'left'); //volumes
        $col_valor_nf       = new TDataGridColumn('valor_nf', 'Valor NF', 'left'); 
        $col_valor_cotacao  = new TDataGridColumn('valor_cotacao', 'Valor Cotado', 'left'); //valor cotacao
        $col_status         = new TDataGridColumn('status_id', 'Situação', 'left'); 

        $col_cliente->setTransformer( function($value) {
          TTransaction::open('uppertruck');
          $cliente = new SystemUser($value);
          TTransaction::close();
          return $cliente->name; 
        });

        $col_pagador->setTransformer( function($value) {
            TTransaction::open('uppertruck');
            $pagador = new SystemUser($value);
            TTransaction::close();
            return $pagador->name; 
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
            //$nomeCidade = $cidade->nome ? $cidade->nome : '';
            $uf = $estado ? $estado->uf : '';
            //return "{$cidade->nome} - {$estado->uf}";
            return "{$cidade->nome} - {$uf}";
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
                //return 'R$&nbsp;'.number_format($value, 2, ',', '.');
                return number_format($value, 2, ',', '.');

            }
            return $value;
        });
        
        $col_valor_cotacao->setTransformer( function($value) {
            if (is_numeric($value)) {
                //return 'R$&nbsp;'.number_format($value, 2, ',', '.');
                return number_format($value, 2, ',', '.');
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
        $this->datagrid->addColumn($col_pagador);
        $this->datagrid->addColumn($col_origem);
        $this->datagrid->addColumn($col_destino);
        $this->datagrid->addColumn($col_produto);
        $this->datagrid->addColumn($col_produto_desc);
        $this->datagrid->addColumn($col_kg);
        $this->datagrid->addColumn($col_volumes);
        $this->datagrid->addColumn($col_valor_nf);
        $this->datagrid->addColumn($col_valor_cotacao);
        $this->datagrid->addColumn($col_status);
        
        //$col_id->setAction( new TAction([$this, 'onReload']),   ['order' => 'id']);
        $col_data_pedido->setAction( new TAction([$this, 'onReload']), ['order' => 'data_pedido']);
        $col_cliente->setAction( new TAction([$this, 'onReload']), ['order' => 'cliente_id']);
        $col_pagador->setAction( new TAction([$this, 'onReload']), ['order' => 'pagador_id']);
        $col_origem->setAction( new TAction([$this, 'onReload']), ['order' => 'origem_cidade_id']);
        $col_destino->setAction( new TAction([$this, 'onReload']), ['order' => 'destino_cidade_id']);
        $col_produto->setAction( new TAction([$this, 'onReload']), ['order' => 'tipo_produto']);
        $col_valor_nf->setAction( new TAction([$this, 'onReload']), ['order' => 'valor_nf']);
        $col_valor_cotacao->setAction( new TAction([$this, 'onReload']), ['order' => 'valor_cotacao']);
        $col_produto_desc->setAction( new TAction([$this, 'onReload']), ['order' => 'produto_desc']);
        $col_kg->setAction( new TAction([$this, 'onReload']), ['order' => 'kg']);
        $col_volumes->setAction( new TAction([$this, 'onReload']), ['order' => 'volumes']);
        //$col_cliente->setAction( new TAction([$this, 'onReload']), ['order' => 'cliente_id']);

        
        // define row actions
        $action1 = new TDataGridAction(['CotacaoEmpresaForm', 'onEdit'],   ['key' => '{id}'] );
        $action2 = new TDataGridAction(['SystemUserForm', 'onEdit'],   ['key' => '{cliente_id}'] );
        $action3 = new TDataGridAction(['CotacaoEmpresaCadastramentoForm', 'onEdit'],   ['key' => '{id}'] );
        //$action2 = new TDataGridAction([$this, 'onDelete'], ['key' => '{id}'] );
         
        $this->datagrid->addAction($action1, 'Visualizar',   'fa:search blue');
        $this->datagrid->addAction($action2, 'Cliente',   'far:user blue');
        $this->datagrid->addAction($action3, 'Editar',    'far:edit blue');

        

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

        $panel = new TPanelGroup('');
        $panel->add($this->datagrid);
        $panel->addFooter($this->pageNavigation);
        //$panel->addHeaderActionLink( 'PDF', new TAction([$this, 'exportAsPDF'], ['register_state' => 'false']), 'far:file-pdf red' );
        $panel->addHeaderActionLink( 'CSV', new TAction([$this, 'onExportCsv'], ['register_state' => 'false']), 'fa:table blue' );


        //$vbox->add(TPanelGroup::pack('', $this->datagrid, $this->pageNavigation));
        $vbox->add($panel);
        // add the table inside the page
        parent::add($vbox);
    }
    




    public static function onChangeEstadoOrigem($param)
    {
        try
        {
            TTransaction::open('uppertruck');
            if (!empty($param['origem_estado_id']))
            {
                $criteria = TCriteria::create( ['estado_id' => $param['origem_estado_id'] ] );



                //$filter = new TCriteria;
                //$filter->add(new TFilter('id', '<', '0'));
        
               TSession::setValue('CotacaoEmpresaList_origem_cidade_filter', $param['origem_estado_id']);
               



                
                // formname, field, database, model, key, value, ordercolumn = NULL, criteria = NULL, startEmpty = FALSE
                TDBCombo::reloadFromModel('form_cotacao', 'origem_cidade_id', 'uppertruck', 'Cidade', 'id', '{nome} ({id})', 'nome', $criteria, TRUE);
            }
            else
            {
                TCombo::clearField('form_cotacao', 'origem_cidade_id');
            }
            
            TTransaction::close();
        }
        catch (Exception $e)
        {
            new TMessage('error', $e->getMessage());
        }


       




    }
    
    
    public static function onChangeEstadoDestino($param)
    {
        try
        {
            TTransaction::open('uppertruck');
            if (!empty($param['destino_estado_id']))
            {
                $criteria = TCriteria::create( ['estado_id' => $param['destino_estado_id'] ] );


                TSession::setValue('CotacaoEmpresaList_destino_cidade_filter', $param['destino_estado_id']);
                
                // formname, field, database, model, key, value, ordercolumn = NULL, criteria = NULL, startEmpty = FALSE
                TDBCombo::reloadFromModel('form_cotacao', 'destino_cidade_id', 'uppertruck', 'Cidade', 'id', '{nome} ({id})', 'nome', $criteria, TRUE);
            }
            else
            {
                TCombo::clearField('form_cotacao', 'destino_cidade_id');
            }
            
            TTransaction::close();
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
        TSession::setValue('CotacaoEmpresaList_origem_cidade_filter', -1);
        TSession::setValue('CotacaoEmpresaList_destino_cidade_filter', -1);
        $filter = new TCriteria;
        $filter->add(new TFilter('estado_id', '=', -1));
        TDBCombo::reloadFromModel('form_cotacao', 'destino_cidade_id', 'uppertruck', 'Cidade', 'id', '{nome} ({id})', 'nome', $filter, TRUE);
        TDBCombo::reloadFromModel('form_cotacao', 'origem_cidade_id', 'uppertruck', 'Cidade', 'id', '{nome} ({id})', 'nome', $filter, TRUE);
        $this->clearFilters();
        $this->onReload();
    }



    public function exportAsPDF($param)
    {
        try
        {
            // string with HTML contents
            $html = clone $this->datagrid;
            $contents = file_get_contents('app/resources/styles-print.html') . $html->getContents();
            
            // converts the HTML template into PDF
            $dompdf = new \Dompdf\Dompdf();
            $dompdf->loadHtml($contents);
            $dompdf->setPaper('A4', 'portrait');
            $dompdf->render();
            
            $file = 'app/output/datagrid-export.pdf';
            
            // write and open file
            file_put_contents($file, $dompdf->output());
            
            $window = TWindow::create('Export', 0.8, 0.8);
            $object = new TElement('object');
            $object->data  = $file;
            $object->type  = 'application/pdf';
            $object->style = "width: 100%; height:calc(100% - 10px)";
            $window->add($object);
            $window->show();
        }
        catch (Exception $e)
        {
            new TMessage('error', $e->getMessage());
        }
    }
    
    /**
     * Export datagrid as CSV
     */
    // public function exportAsCSV($param)
    // {
    //     try
    //     {
    //         // get datagrid raw data
    //         $data = $this->datagrid->getOutputData();
            
    //         if ($data)
    //         {
    //             $file    = 'app/output/listagem.csv';
    //             $handler = fopen($file, 'w');
    //             foreach ($data as $row)
    //             {
    //                 fputcsv($handler, $row);
    //             }
                
    //             fclose($handler);
    //             parent::openFile($file);
    //         }
    //     }
    //     catch (Exception $e)
    //     {
    //         new TMessage('error', $e->getMessage());
    //     }
    // }

    public function onExportCsv($param = null) 
    {
        try
        {
            $this->onSearch();

            TTransaction::open('uppertruck'); // open a transaction
            $repository = new TRepository('Cotacao'); // creates a repository for Customer
            $criteria = new TCriteria; // creates a criteria

            if($filters = TSession::getValue(__CLASS__.'_filters'))
            {
                foreach ($filters as $filter) 
                {
                    $criteria->add($filter);       
                }
            }

            $records = $repository->load($criteria); // load the objects according to criteria
            if ($records)
            {
                $file = 'tmp/'.uniqid().'.csv';
                $handle = fopen($file, 'w');
                $columns = $this->datagrid->getColumns();

                $csvColumns = [];
                foreach($columns as $column)
                {
                    $csvColumns[] = $column->getLabel();
                }
                fputcsv($handle, $csvColumns, ';');

                foreach ($records as $record)
                {
                    $csvColumns = [];
                    foreach($columns as $column)
                    {
                        $name = $column->getName();
                       

                        switch ($name) {
                            case 'cliente_id':
                            case 'pagador_id':
                                $user = new SystemUser($record->{$name});
                                $csvColumns[] = $user->name;
                                break;
                            case 'origem_cidade_id':
                            case 'destino_cidade_id':
                                $cidade = new Cidade($record->{$name});
                                $csvColumns[] = $cidade->nome ? $cidade->nome . '-' . $cidade->estado->uf : '';
                                break;
                            case 'tipo_produto':
                                $tipo_produto = new TipoProduto($record->{$name});
                                $csvColumns[] = $tipo_produto->descricao;
                                break;
                            case 'status_id':
                                $situacao = new StatusCotacao($record->{$name});
                                $csvColumns[] = $situacao->visao_empresa;
                                break;
                            default:
                                $csvColumns[] = $record->{$name};
                                break;
                        }

                       

                       
                        


                        
                    }
                    fputcsv($handle, $csvColumns, ';');
                }
                fclose($handle);

                TPage::openFile($file);
            }
            else
            {
                new TMessage('info', _t('No records found'));       
            }

            TTransaction::close(); // close the transaction
        }
        catch (Exception $e) // in case of exception
        {
            new TMessage('error', $e->getMessage()); // shows the exception error message
            TTransaction::rollback(); // undo all pending operations
        }
    }












}