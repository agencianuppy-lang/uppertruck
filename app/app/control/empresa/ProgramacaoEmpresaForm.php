<?php

class ProgramacaoEmpresaForm extends TPage
{
    private $form; // form
    private $cliente_id;
    private $motorista_id;
    private $origem_cidade_id;
    private $destino_cidade_id;
    private $origem_estado_id;
    private $destino_estado_id;
    
    
    /**
     * Class constructor
     * Creates the page and the registration form
     */
    function __construct()
    {
        parent::__construct();
        
        // creates the form
        $this->form = new BootstrapFormBuilder('form_programacao');
        $this->form->setClientValidation(true);
        $this->form->setFormTitle('Ficha de programação de embarque');
        
        $this->form->setFieldSizes('100%');  // formulário vertical - labels em cima dos inputs
       
        
        // create the form fields
        $cliente_filter = new TCriteria;
        $cliente_filter->add(new TFilter('grupo', '=', 3)); // grupo cliente
        $motorista_filter = new TCriteria;
        $motorista_filter->add(new TFilter('grupo', '=', 4)); // grupo motorista
        
        
        $id                 = new TEntry('id');
       
       
        $data_coleta = new TDate('data_coleta');
        $data_coleta->setExitAction(new TAction(array($this, 'onExitDataColeta')));
       
       
       
       
        $data_entrega       = new TDate('data_entrega');
        $data_entrega->setExitAction(new TAction(array($this, 'onExitDataEntrega')));
        $data_entrega->setOption('endDate', '+1d');
        $data_entrega->setOption('datesDisabled', '+1d');
        //endDate: '+1d',
        //datesDisabled: '+1d',
        
        $status_transporte  = new TDBCombo('status_transporte_id', 'uppertruck', 'StatusTransporte', 'id', '{descricao}');
        $status_pgmto       = new TDBCombo('status_pgmto_id', 'uppertruck', 'StatusPgmto', 'id', '{descricao}');
        $tipo_pgmto         = new TDBCombo('tipo_pgmto_id', 'uppertruck', 'TipoPgmto', 'id', '{descricao}'); 
        $data_vencimento    = new TDate('data_vencimento');
        $data_pagamento         = new TDate('data_pagamento');
        $data_pagamento->setExitAction(new TAction(array($this, 'onExitDataPagamento')));
        
        
        
        
        $data_pagamento->setOption('endDate', '+1d');
        $data_pagamento->setOption('datesDisabled', '+1d');
        
        
        
        $cte                = new TEntry('cte');
        //$this->cliente_id         = new TDBCombo('cliente_id',  'uppertruck', 'SystemUser', 'id', 'name', 'name', $cliente_filter);
        $this->cliente_id         = new TUniqueSearch('cliente_id',  'uppertruck', 'SystemUser', 'id', 'name', 'name', $cliente_filter);
        $button = new TActionLink('', new TAction([$this, 'onClienteAdd']), 'green', null, null, 'fa:plus-circle');
        $button->class = 'btn btn-default inline-button';
        $button->title = _t('New');
        $this->cliente_id->after($button);
       
        $num_nf             = new TEntry('num_nf');
        
        $filter = new TCriteria;
        $filter->add(new TFilter('id', '<', '0'));
        //$this->motorista_id       = new TDBCombo('motorista_id',  'uppertruck', 'SystemUser', 'id', 'name', 'name', $motorista_filter);
        $this->motorista_id       = new TUniqueSearch('motorista_id',  'uppertruck', 'SystemUser', 'id', 'name', 'name', $motorista_filter);
        $this->motorista_id->setChangeAction( new TAction( [$this, 'onChangeMotorista'] ) );
        //$this->motorista_id->enableSearch();
        $button = new TActionLink('', new TAction([$this, 'onMotoristaAdd']), 'green', null, null, 'fa:plus-circle');
        $button->class = 'btn btn-default inline-button';
        $button->title = _t('New');
        $this->motorista_id->after($button);
        
        $veiculo_id         = new TDBCombo('veiculo_id',  'uppertruck', 'Veiculo', 'id', 'placa', 'placa', $filter);
        $veiculo_id->enableSearch();
         
        $this->origem_estado_id   = new TDBCombo('origem_estado_id', 'uppertruck', 'Estado', 'id', '{nome} ({uf})');
        $this->origem_estado_id->setChangeAction( new TAction( [$this, 'onChangeEstadoOrigem'] ) );
        $this->origem_cidade_id   = new TDBCombo('origem_cidade_id',  'uppertruck', 'Cidade', 'id', 'nome', 'nome', $filter);
        $this->origem_cidade_id->enableSearch();
        $this->origem_estado_id->enableSearch();
        
        
        $this->destino_estado_id  = new TDBCombo('destino_estado_id', 'uppertruck', 'Estado', 'id', '{nome} ({uf})');
        $this->destino_estado_id->setChangeAction( new TAction( [$this, 'onChangeEstadoDestino'] ) );
        $this->destino_cidade_id  = new TDBCombo('destino_cidade_id', 'uppertruck', 'Cidade', 'id', 'nome', 'nome', $filter);
        $this->destino_cidade_id->enableSearch();
        $this->destino_estado_id->enableSearch();
        
        $kg                 = new TEntry('kg');
        $km                 = new TEntry('km');
        $volumes            = new TEntry('volumes');
        $m3                 = new TEntry('m3');
        $tipo_produto       = new TEntry('tipo_produto');
       
       
        
        
        $valor_nf           = new TEntry('valor_nf');
        $valor_faturado     = new TEntry('valor_faturado');
        $valor_motorista    = new TEntry('valor_motorista');
        $valor_icms         = new TEntry('valor_icms');
        $valor_seguro       = new TEntry('valor_seguro');
        $valor_comissao     = new TEntry('valor_comissao');
        $valor_gris         = new TEntry('valor_gris');
        $valor_simples      = new TEntry('valor_simples');
        $outros_descontos   = new TEntry('outros_descontos');
        $fat_liquido        = new TEntry('fat_liquido');
        $obs                = new TEntry('obs');
        
        $exit_action = new TAction(array($this, 'onExitValor'));
        $valor_nf->setExitAction($exit_action);
        $valor_faturado->setExitAction($exit_action);
        $valor_motorista->setExitAction($exit_action);
        $valor_icms->setExitAction($exit_action);
        $valor_seguro->setExitAction($exit_action);
        $valor_comissao->setExitAction($exit_action);
        $valor_gris->setExitAction($exit_action);
        $valor_simples->setExitAction($exit_action);
        $outros_descontos->setExitAction($exit_action);
        
  
        $id->setEditable(FALSE);
        $fat_liquido->setEditable(FALSE);
        $status_pgmto->setEditable(FALSE);
        $status_transporte->setEditable(FALSE);
       
        $grupos = TSession::getValue('usergroupids');
        $grupo = $grupos[0];
        if ($grupo != 5) // se não for administrador
        {
            $data_coleta->setEditable(FALSE);
            $data_entrega->setEditable(FALSE);
            $data_pagamento->setEditable(FALSE);
            $valor_faturado->setEditable(FALSE);
        }
       
       
       
        $valor_nf->setNumericMask(2, ',', '.', true);
        $valor_faturado->setNumericMask(2, ',', '.', true);
        $valor_motorista->setNumericMask(2, ',', '.', true);
        $valor_icms->setNumericMask(2, ',', '.', true);
        $valor_seguro->setNumericMask(2, ',', '.', true);
        $valor_comissao->setNumericMask(2, ',', '.', true);
        $valor_gris->setNumericMask(2, ',', '.', true);
        $valor_simples->setNumericMask(2, ',', '.', true);
        $outros_descontos->setNumericMask(2, ',', '.', true);
        $fat_liquido->setNumericMask(2, ',', '.', true);
 
        $data_coleta->setMask('dd/mm/yyyy');
        $data_coleta->setDatabaseMask('yyyy-mm-dd');
        $data_entrega->setMask('dd/mm/yyyy');
        $data_entrega->setDatabaseMask('yyyy-mm-dd');
        $data_pagamento->setMask('dd/mm/yyyy');
        $data_pagamento->setDatabaseMask('yyyy-mm-dd');
        $data_vencimento->setMask('dd/mm/yyyy');
        $data_vencimento->setDatabaseMask('yyyy-mm-dd');
        
       
        
         // add the form fields
        
//         $this->form->addFields( [new TLabel('ID')],         [$id],                 [new TLabel('Cte')],        [$cte] );
//         
//         $this->form->addFields( [new TLabel('Coleta')],     [$data_coleta],        [new TLabel('Entrega')],    [$data_entrega] );
//         $this->form->addFields( [new TLabel('Transporte')], [$status_transporte],  [new TLabel('Pgmto')],      [$status_pgmto] );
//         $this->form->addFields( [new TLabel('Tipo Pgmto')], [$tipo_pgmto],         [new TLabel('Km')],         [$km] );
//         $this->form->addFields( [new TLabel('Vencimento')], [$data_vencimento],    [new TLabel('Data pgmto')], [$data_pagamento] );
//         
//         $this->form->addFields( [new TLabel('Cliente')],    [$cliente_id],         [new TLabel('NF')],         [$num_nf] );
//         $this->form->addFields( [new TLabel('Motorista')],  [$motorista_id],       [new TLabel('Veículo')],    [$veiculo_id] );
//      
//         $this->form->addFields( [new TLabel('UF Origem')],   [$origem_estado_id],  [new TLabel('Cidade Origem')],    [$origem_cidade_id] );
//         $this->form->addFields( [new TLabel('UF Destino')],  [$destino_estado_id], [new TLabel('Cidade Destino')],   [$destino_cidade_id] );
//       
//         $this->form->addFields( [new TLabel('Peso/Kg')],     [$kg],                [new TLabel('Volumes')],   [$volumes] );
//         $this->form->addFields( [new TLabel('Cubagem/m3')],  [$m3],                [new TLabel('Produto')],   [$tipo_produto] );
//         
//         
//         $this->form->addFields( [new TLabel('Valor NF')],        [$valor_nf]);
//         $this->form->addFields( [new TLabel('Valor Faturado')],  [$valor_faturado]);
//         $this->form->addFields( [new TLabel('Valor TAC')],       [$valor_motorista]);
//         $this->form->addFields( [new TLabel('ICMS')],            [$valor_icms]);
//         $this->form->addFields( [new TLabel('Seguro')],          [$valor_seguro]);
//         $this->form->addFields( [new TLabel('Comissão')],        [$valor_comissao]);
//         $this->form->addFields( [new TLabel('GRIS')],            [$valor_gris]);
//         $this->form->addFields( [new TLabel('Simples Nac.')],    [$valor_simples]);
//         $this->form->addFields( [new TLabel('Outros desc.')],    [$outros_descontos]);
//       
//         $this->form->addFields( [new TLabel('Obs.')],            [$obs]);
       
       
       
       
       
       
     //   $this->form->addFields( [new TLabel('ID')],         [$id],                 [new TLabel('Cte')],        [$cte] );
        
        $row = $this->form->addFields( [ new TLabel('ID'),         $id ],
                                       [ new TLabel('Cte'),        $cte ],
                                       [ new TLabel('Coleta'),     $data_coleta ],
                                       [ new TLabel('Entrega'),    $data_entrega ]);
        $row->layout = ['col-sm-3', 'col-sm-3', 'col-sm-3', 'col-sm-3'];
        
        $row = $this->form->addFields( 
                                       [ new TLabel('Transporte'), $status_transporte ],
                                       [ new TLabel('Pgmto'),      $status_pgmto ],
                                       [ new TLabel('Vencimento'), $data_vencimento ],
                                       [ new TLabel('Data Pgmto'),    $data_pagamento ]);
        $row->layout = ['col-sm-3', 'col-sm-3', 'col-sm-3', 'col-sm-3' ];
        
        $row = $this->form->addFields( [ new TLabel('Cliente'),    $this->cliente_id ],
                                       [ new TLabel('Motorista'),  $this->motorista_id ],
                                       [ new TLabel('Veiculo'),    $veiculo_id ],
                                       [ new TLabel('NF'),         $num_nf ] );
        $row->layout = ['col-sm-4', 'col-sm-4', 'col-sm-2', 'col-sm-2' ];
        
        $row = $this->form->addFields( [ new TLabel('UF Origem'),      $this->origem_estado_id ],
                                       [ new TLabel('Cidade Origem'),  $this->origem_cidade_id ],
                                       [ new TLabel('UF Destino'),     $this->destino_estado_id ],
                                       [ new TLabel('Cidade Destino'), $this->destino_cidade_id ] );
        $row->layout = ['col-sm-3', 'col-sm-3', 'col-sm-3', 'col-sm-3' ];
        
        $row = $this->form->addFields( [ new TLabel('Peso/Kg'),        $kg ],
                                       [ new TLabel('Volumes'),        $volumes ],
                                       [ new TLabel('m3'),             $m3 ],
                                       [ new TLabel('Produto'),        $tipo_produto ] );
        $row->layout = ['col-sm-3', 'col-sm-3', 'col-sm-3', 'col-sm-3' ];
        
        $row = $this->form->addFields( [ new TLabel('NF'),             $valor_nf ],
                                       [ new TLabel('Faturado'),       $valor_faturado ],
                                       [ new TLabel('TAC'),            $valor_motorista ],
                                       [ new TLabel('ICMS'),           $valor_icms ] );
        $row->layout = ['col-sm-3', 'col-sm-3', 'col-sm-3', 'col-sm-3' ];
        
        $row = $this->form->addFields( [ new TLabel('Seguro'),         $valor_seguro ],
                                       [ new TLabel('Comissão'),       $valor_comissao ],
                                       [ new TLabel('GRISS'),          $valor_gris ],
                                       [ new TLabel('Simples Nac.'),   $valor_simples ] );
        $row->layout = ['col-sm-3', 'col-sm-3', 'col-sm-3', 'col-sm-3' ];
        
        $row = $this->form->addFields( [ new TLabel('Outros desc.'),   $outros_descontos ],
                                       [ new TLabel('Fat. Líquido'),   $fat_liquido ]);
        $row->layout = ['col-sm-6', 'col-sm-6'];
        
        $row = $this->form->addFields( [ new TLabel('Obs.'),   $obs ]);
        $row->layout = ['col-sm-12'];
        
        $obs->setSize('100%', 60);
      


//         $this->form->addFields( [new TLabel('Outros desc.')],    [$outros_descontos]);
//       
//         $this->form->addFields( [new TLabel('Obs.')],            [$obs]);
       
       
       
       
       
       
       
       
       
       
       
       
       
       
       
       
       
       
        
        
        // define the form action
        $this->form->addAction('Salvar', new TAction([$this, 'onSave']), 'fa:save green');
        //$this->form->addActionLink('Limpar',  new TAction([$this, 'onClear']), 'fa:eraser red');
        $this->form->addActionLink('Listagem',  new TAction(['ProgramacaoEmpresaList', 'onReload']), 'fa:table blue');
        
        // wrap the page content using vertical box
        $vbox = new TVBox;
        $vbox->style = 'width: 100%';
        $vbox->add(new TXMLBreadCrumb('menu.xml', 'ProgramacaoEmpresaList'));
        $vbox->add($this->form);
        parent::add($vbox);
    }
    /**
     * method onSave()
     * Executed whenever the user clicks at the save button
     */
    function onSave()
    {
        try
        {
            // open a transaction with database 'samples'
            TTransaction::open('uppertruck');
            
            $this->form->validate(); // run form validation
            
            $data = $this->form->getData(); // get form data as array
            
            $object = new Programacao;  // create an empty object
            $object->fromArray( (array) $data); // load the object with data
          
          
            //calcula fat_liquido para gravar no banco
//             $text_form = [ 
//                 $data->valor_faturado, 
//                 $data->valor_motorista,  
//                 $data->valor_icms, 
//                 $data->valor_seguro,
//                 $data->valor_comissao,
//                 $data->valor_gris,
//                 $data->valor_simples,
//                 $data->outros_descontos
//             ];
//             $search  = array(".", ",");
//             $replace = array("", ".");    
//             $nums = str_replace($search, $replace, $text_form);
//             $liq = is_numeric($nums[0]) ? $nums[0] : 0;
//             for ($i = 1; $i <= 7; $i++)
//             {
//                 $n = is_numeric($nums[$i]) ? $nums[$i] : 0;
//                 $liq = $liq - $n;
//                 new TMessage('info', json_encode($liq));
//             }
            //$liq = round($liq, 2);
            //$liq = number_format($liq, 2, ',', '.'); 
           // new TMessage('info', json_encode($liq));
            
            //$object->fat_liquido = $liq;
            
            
             
           
          
          
            $object->store(); // save the object
            
            // sinalizar avaliação pendente se objeto for entregue e não tiver sido avaliado ainda
            if ( (!$object->avaliacao OR $object->avaliacao==0) AND $object->status_transporte_id == 4  )
            {
                $object->avaliacao_pendente = 1;
                $object->store();
            }
           
            
            
            // fill the form with the active record data
            $this->form->setData($object);
            
            TTransaction::close();  // close the transaction
            
            // shows the success message
            new TMessage('info', 'Registro salvo');
        }
        catch (Exception $e) // in case of exception
        {
            new TMessage('error', $e->getMessage()); // shows the exception error message
            $this->form->setData( $this->form->getData() ); // keep form data
            TTransaction::rollback(); // undo all pending operations
        }
    }
    
    /**
     * Clear form
     */
    public function onClear()
    {
        $this->form->clear( TRUE );
        $obj = new StdClass;
        $obj->status_pgmto_id = 1;
        $obj->status_transporte_id = 1;
        TForm::sendData('form_programacao', $obj);
    }
    
    /**
     * method onEdit()
     * Executed whenever the user clicks at the edit button da datagrid
     */
    public function onEdit($param)
    {
        try
        {
            if (isset($param['id']))
            {
            
            
            
                $key = $param['id'];  // get the parameter
            
                if (isset($param['programacao_id']) )
                {
                    $key = $param['programacao_id'];
                }
            
            
                TTransaction::open('uppertruck');   // open a transaction with database 'samples'
                $object = new Programacao($key);        // instantiates object City
                
                //carrega cidades e estado para colocar no form
                $cidade  = new Cidade($object->origem_cidade_id);
                $cidade2 = new Cidade($object->destino_cidade_id);
                $object->origem_estado_id  = $cidade->estado_id;
                $object->destino_estado_id = $cidade2->estado_id;
                $criteria =  TCriteria::create( ['estado_id' => $object->origem_estado_id] );
                $criteria2 = TCriteria::create( ['estado_id' => $object->destino_estado_id] );
                TDBCombo::reloadFromModel('form_programacao', 'origem_cidade_id',  'uppertruck', 'Cidade', 'id', '{nome} ({id})', 'nome', $criteria, TRUE);
                TDBCombo::reloadFromModel('form_programacao', 'destino_cidade_id', 'uppertruck', 'Cidade', 'id', '{nome} ({id})', 'nome', $criteria2, TRUE);
                
                
                
                //carrega veículos para colocar no form
                $criteria  =  TCriteria::create( ['motorista_id' => $object->motorista_id] );  
              
                
                
              
                TDBCombo::reloadFromModel('form_programacao', 'veiculo_id',  'uppertruck', 'Veiculo', 'id', 'placa', 'placa', $criteria, TRUE);
                //$veiculo = new Veiculo($object->veiculo_id);
                //$object->veiculo_id  = $veiculo->estado_id;
                
                
                //new TMessage('info', json_encode(var_dump($object->id)));
                //$obj = (object) (array) $object;
                
                //TForm::sendData('form_programacao', $object);
                
                $this->form->setData( (object)$object);   // fill the form with the active record data
                //setar as cidades e o veiculo no form
                $obj = new StdClass;
                $obj->origem_cidade_id  = $object->origem_cidade_id;
                $obj->destino_cidade_id = $object->destino_cidade_id;
                $obj->veiculo_id = $object->veiculo_id;
                TForm::sendData('form_programacao', $obj);
                
                
                if ( $object->cotacao_id ) // se exitir cotação vinculada à programação, exibir atalho para o formulário da cotação
                {
                   
                    $act = new TAction(['CotacaoEmpresaForm', 'onEdit']);
                    $act->setParameters(['cotacao_id' => $object->cotacao_id]);   
                    
                    //$act->setParameters(['id' => 9, 'key' => 9]);   
             
                    $this->form->addAction('Cotação relacionada a esta programação', $act,  'fa:hand-point-right #7C93CF');           
                }
                
                
                
                
                $grupos = TSession::getValue('usergroupids');
                $grupo = $grupos[0];
                if ($grupo != 5) // se não for administrador
                {
                    //$data_coleta->setEditable(FALSE);
                    //$data_entrega->setEditable(FALSE);
                    //$data_pagamento->setEditable(FALSE);
                    //$valor_faturado->setEditable(FALSE);
                    
                    if ( isset($object->cliente_id) )
                    {
                        $this->cliente_id->setEditable(FALSE);
                    }
                    if ( isset($object->motorista_id) )
                    {
                         $this->motorista_id->setEditable(FALSE);
                    }
                    if ( isset($object->origem_cidade_id) )
                    {
                         $this->origem_cidade_id->setEditable(FALSE);
                         $this->origem_estado_id->setEditable(FALSE);
                    }
                    if ( isset($object->destino_cidade_id) )
                    {
                         $this->destino_cidade_id->setEditable(FALSE);
                         $this->destino_estado_id->setEditable(FALSE);
                    }
              
              
              
                }
                
                
                
                
                
                
                
                
                
                TTransaction::close();           // close the transaction
            }
            else
            {
                //$this->form->clear( true );
            }
        }
        catch (Exception $e) // in case of exception
        {
            new TMessage('error', $e->getMessage()); // shows the exception error message
            TTransaction::rollback(); // undo all pending operations
        }
    }
    
    
    
    
    public static function onChangeMotorista($param)
    {
        try
        {
            TTransaction::open('uppertruck');
            if (!empty($param['motorista_id']))
            {
                $criteria = TCriteria::create( ['motorista_id' => $param['motorista_id'] ] );
                
                // formname, field, database, model, key, value, ordercolumn = NULL, criteria = NULL, startEmpty = FALSE
                TDBCombo::reloadFromModel('form_programacao', 'veiculo_id', 'uppertruck', 'Veiculo', 'id', 'placa', 'placa', $criteria, TRUE);
            }
            else
            {
                TCombo::clearField('form_programacao', 'veiculo_id');
            }
            
            TTransaction::close();
        }
        catch (Exception $e)
        {
            new TMessage('error', $e->getMessage());
        }
    }
    
    
    public static function onChangeEstadoOrigem($param)
    {
        try
        {
            TTransaction::open('uppertruck');
            if (!empty($param['origem_estado_id']))
            {
                $criteria = TCriteria::create( ['estado_id' => $param['origem_estado_id'] ] );
                
                // formname, field, database, model, key, value, ordercolumn = NULL, criteria = NULL, startEmpty = FALSE
                TDBCombo::reloadFromModel('form_programacao', 'origem_cidade_id', 'uppertruck', 'Cidade', 'id', '{nome} ({id})', 'nome', $criteria, TRUE);
            }
            else
            {
                TCombo::clearField('form_programacao', 'origem_cidade_id');
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
                
                // formname, field, database, model, key, value, ordercolumn = NULL, criteria = NULL, startEmpty = FALSE
                TDBCombo::reloadFromModel('form_programacao', 'destino_cidade_id', 'uppertruck', 'Cidade', 'id', '{nome} ({id})', 'nome', $criteria, TRUE);
            }
            else
            {
                TCombo::clearField('form_programacao', 'destino_cidade_id');
            }
            
            TTransaction::close();
        }
        catch (Exception $e)
        {
            new TMessage('error', $e->getMessage());
        }
    }
    
    
    
    public static function onExitValor($param)
    {
        
        //new TMessage('info', json_encode($param['valor_faturado']));
        
        $text_form = [ 
            $param['valor_faturado'], 
            $param['valor_motorista'],  
            $param['valor_icms'], 
            $param['valor_seguro'],
            $param['valor_comissao'],
            $param['valor_gris'],
            $param['valor_simples'],
            $param['outros_descontos']
        ];
        $search  = array(".", ",");
        $replace = array("", ".");    
        $nums = str_replace($search, $replace, $text_form);
        
        $liq = is_numeric($nums[0]) ? $nums[0] : 0;
        for ($i = 1; $i <= 7; $i++)
        {
            $n = is_numeric($nums[$i]) ? $nums[$i] : 0;
            $liq = $liq - $n;
        }
        //$fat_liq = $nums[0] - $nums[1] - $nums[2] - $nums[3] - $nums[4] - $nums[5] - $nums[6] - $nums[7];   
        $liq = round($liq, 2);   
        $liq = number_format($liq, 2, ',', '.');
        $obj = new StdClass;
        $obj->fat_liquido = $liq;   
        TForm::sendData('form_programacao', $obj);
        
        
        //new TMessage('info', json_encode($param));
        
    }
    
    
    
    
    
    public static function onExitDataPagamento($param)
    {  
        $data_pagamento = preg_replace('/[^0-9]/', '', $param['data_pagamento']); 
        $data_pagamento = strlen($data_pagamento)==8 ? substr($data_pagamento, 4, 4)."-". substr($data_pagamento, 2, 2) ."-". substr($data_pagamento, 0, 2) : NULL;  //yyyy-mm-dd OU Null
        
        //new TMessage('info', json_encode($data_pagamento));
        
        $obj = new StdClass; 
        $obj->status_pgmto_id = $data_pagamento ? 2 : 1; // confirmado ou pendente   
        TForm::sendData('form_programacao', $obj);
        
    }
    
    
    
    
    
    public static function onExitDataColeta($param)
    {  
        $coleta = preg_replace('/[^0-9]/', '', $param['data_coleta']); 
        $coleta = strlen($coleta)==8 ? substr($coleta, 4, 4)."-". substr($coleta, 2, 2) ."-". substr($coleta, 0, 2) : NULL;  //yyyy-mm-dd OU Null
        $entrega = preg_replace('/[^0-9]/', '', $param['data_entrega']);
        $entrega = strlen($entrega)==8 ? substr($entrega, 4, 4)."-". substr($entrega, 2, 2) ."-". substr($entrega, 0, 2) : NULL;   //yyyy-mm-dd OU Null
        $today = date('Y-m-d');
        $obj = new StdClass; 
        
       // new TMessage('info', json_encode($entrega));
        
        if (!$coleta)
        {  
            $obj->data_entrega = '';  
            $obj->status_transporte_id = 1; // à agendar 
        }
        else
        {
            if ($coleta == $today OR $coleta > $today) // agendada ou em transporte
            {
                $obj->data_entrega = '';  
                $obj->status_transporte_id = 2; // agendada
            }
            if ($coleta < $today AND !$entrega)
            {
                $obj->status_transporte_id = 3; //em transporte      
            }
            if ($coleta < $today AND $entrega)
            {
                $obj->status_transporte_id = 4; //entregue      
            }       
        }
        
        TForm::sendData('form_programacao', $obj);
        if ($coleta == $today) // agendada ou em transporte
        {
            $act = new TAction(array(__CLASS__, 'onSetEmTransporte'));
            new TQuestion('Manter status "Coleta agendada" ou "Em transporte"?', NULL ,$act,'', 'Coleta agendada', 'Em transporte' );  
        }   
    }
    
    public static function onExitDataEntrega($param)
    {  
        $coleta = preg_replace('/[^0-9]/', '', $param['data_coleta']); 
        $coleta = strlen($coleta)==8 ? substr($coleta, 4, 4)."-". substr($coleta, 2, 2) ."-". substr($coleta, 0, 2) : NULL;  //yyyy-mm-dd OU Null
        $entrega = preg_replace('/[^0-9]/', '', $param['data_entrega']);
        $entrega = strlen($entrega)==8 ? substr($entrega, 4, 4)."-". substr($entrega, 2, 2) ."-". substr($entrega, 0, 2) : NULL;   //yyyy-mm-dd OU Null
        $today = date('Y-m-d');
        $obj = new StdClass; 
        if (!$entrega AND !$coleta)
        {   
            $obj->status_transporte_id = 1; // à agendar 
        }
        if (!$entrega AND $coleta AND ($coleta > $today OR $coleta == $today) ) // agendada ou em transporte
        {  
            $obj->status_transporte_id = 2; // agendada
        }
        if (!$entrega AND $coleta AND $coleta < $today) 
        {
            $obj->status_transporte_id = 3; // em transporte      
        }
        if ($entrega)
        {
            $obj->status_transporte_id = 4; // Entregue 
        }
        
        TForm::sendData('form_programacao', $obj);
        
        if (!$entrega AND  $coleta == $today AND !($param['status_transporte_id'] == 2 OR $param['status_transporte_id'] == 3)) // agendada ou em transporte
        {
            $act = new TAction(array(__CLASS__, 'onSetEmTransporte'));
            new TQuestion('Manter status "Coleta agendada" ou "Em transporte"?', NULL ,$act,'', 'Coleta agendada', 'Em transporte' );  
        }   
    }
    public static function onSetEmTransporte($param)
    {
        $obj = new StdClass;
        //$obj->data_entrega = '';  
        $obj->status_transporte_id = 3; //em transporte
        TForm::sendData('form_programacao', $obj);
    }
    
    public static function onClienteAdd($param) {
        TSession::setValue('not_editable_grupo', true);
        AdiantiCoreApplication::loadPage('SystemUserForm', 'onNewCustumer');
    }
    public static function onMotoristaAdd($param) {
        TSession::setValue('not_editable_grupo', true);
        AdiantiCoreApplication::loadPage('SystemUserForm', 'onNewMotorista');
    }
    
    
    
    
}

