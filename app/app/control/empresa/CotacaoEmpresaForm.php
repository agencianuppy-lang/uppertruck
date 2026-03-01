<?php
class CotacaoEmpresaForm extends TPage
{
    protected $form;      // form
    protected $form_orcamento;
    
    protected $datagrid;
    protected $pageNavigation;
    
    //trait with onReload, onSearch, onDelete... para a listagem de orcamentos
    use Adianti\Base\AdiantiStandardListTrait;
    
    
    //protected $datagrid;  // datagrid
    //protected $loaded;
    //protected $pageNavigation;  // pagination component
    
    // trait with onSave, onEdit, onDelete, onReload, onSearch...
    //use Adianti\Base\AdiantiStandardFormTrait;
    
    /**
     * Class constructor
     * Creates the page, the form and the listing
     */
    public function __construct()
    {
        parent::__construct();
        
        //parent::setSize(0.8, null); 
        
        $this->setDatabase('uppertruck'); // define the database
        $this->setActiveRecord('Cotacao'); // define the Active Record
        
        // create the form
        $this->form = new BootstrapFormBuilder('form_cotacao');
        $this->form->setFormTitle('Dados da solicitação');
        
        // create the form fields
        $id                = new TEntry('id');
        //$cliente_id        = new TEntry('cliente_id');
        $data_pedido       = new TDate('data_pedido');
        
        
        $filter = new TCriteria;
        $filter->add(new TFilter('id', '<', '0'));
        
        $origem_estado_id     = new TDBCombo('origem_estado_id', 'uppertruck', 'Estado', 'id', '{nome} ({uf})');
        //$origem_estado_id->setChangeAction( new TAction( [$this, 'onChangeEstadoOrigem'] ) );
        $origem_cidade_id  = new TDBCombo('origem_cidade_id',  'uppertruck', 'Cidade', 'id', 'nome', 'nome', $filter);
        
        $destino_estado_id     = new TDBCombo('destino_estado_id', 'uppertruck', 'Estado', 'id', '{nome} ({uf})');
        //$destino_estado_id->setChangeAction( new TAction( [$this, 'onChangeEstadoDestino'] ) );
        $destino_cidade_id = new TDBCombo('destino_cidade_id', 'uppertruck', 'Cidade', 'id', 'nome', 'nome', $filter);
        
        $tipo_produto      = new TDBCombo('tipo_produto', 'uppertruck', 'TipoProduto', 'id', 'descricao', 'descricao');
        $kg                = new TSpinner('kg');
        $m3                = new TSpinner('m3');
        $volumes           = new TSpinner('volumes');
        
        $embalagem_id     = new TDBCombo('embalagem_id', 'uppertruck', 'Embalagem', 'id', 'nome');
        
        $kg->setRange(1, 9999999999, 1);
        $m3->setRange(0, 9999999, 1);
        $volumes->setRange(1, 9999999, 1);
        
        
        $valor_nf          = new TEntry('valor_nf');
        $status_id         = new TEntry('status_id');
        
        $data_cotacao      = new TDate('data_cotacao');
        $valor_cotacao     = new TEntry('valor_cotacao');
        
        $obs               = new TText('obs');

        $obs_empresa       = new TText('obs_empresa');
        
        
        
        
        $valor_cotacao->setNumericMask(2, ',', '.', true);
        $valor_nf->setNumericMask(2, ',', '.', true);
        
        
        $obs->setSize('100%', 60);
        $obs_empresa->setSize('100%', 60);
        $id->setSize('100%');
        $data_pedido->setSize('100%');       
        $origem_estado_id->setSize('100%');     
        $origem_cidade_id->setSize('100%'); 
        $destino_estado_id->setSize('100%');
        $destino_cidade_id->setSize('100%'); 
        $tipo_produto->setSize('100%');     
        $kg->setSize('100%');               
        $m3->setSize('100%');             
        $volumes->setSize('100%');          
        $embalagem_id->setSize('100%');   
        $kg->setSize('100%');
        $m3->setSize('100%');
        $volumes->setSize('100%');
        $valor_nf->setSize('100%');        
        $status_id->setSize('100%');        
        $data_cotacao->setSize('100%');      
        $valor_cotacao->setSize('100%');     
        
        // add the form fields
        $this->form->addFields( [new TLabel('ID')],             [$id], [new TLabel('Solicitação / Alteração')],    [$data_pedido] );
        //$this->form->addFields( [new TLabel('Cliente')],        [$cliente_id] );
        
        //$this->form->addFields( [new TLabel('Data pedido de cotação')],    [$data_pedido] );
        
        $this->form->addContent( [new TFormSeparator('')]);
        $this->form->addFields( [ new TLabel('UF Origem') ],  [$origem_estado_id], [ new TLabel('Cidade Origem') ], [ $origem_cidade_id ] );
        $this->form->addFields( [ new TLabel('UF Destino') ], [$destino_estado_id], [ new TLabel('Cidade Destino') ], [ $destino_cidade_id ] );
        $this->form->addContent( [new TFormSeparator('')]);
        
        $this->form->addFields( [new TLabel('Tipo de produto')], [$tipo_produto], [ new TLabel('Peso/Kg') ], [$kg] );
        
        $this->form->addFields( [ new TLabel('Cubagem/m3') ], [ $m3 ], [ new TLabel('Embalagens') ], [$embalagem_id] );
        
        $this->form->addFields( [new TLabel('Qtd. de Volumes')], [$volumes], [new TLabel('Valor Nota Fiscal/R$')], [$valor_nf] );
        
        $this->form->addContent( [new TFormSeparator('')]);
        $this->form->addFields( [new TLabel('obs')], [$obs] );
        $this->form->addFields( [new TLabel('obs_empresa')], [$obs_empresa] );
        
        
        
        // define the form actions
        //$this->form->addAction('Responder solicitação', new TAction(['CotacaoEmpresaResp', 'onEdit']),  'fa:hand-point-right #7C93CF');
        $this->form->addActionLink('Listagem',  new TAction(['CotacaoEmpresaList', 'onReload']), 'fa:table blue');
       
        //$action1 = new TDataGridAction(['StandardFormView', 'onEdit'],   ['key' => '{id}'] );
        //$this->form->addActionLink('Editar',  new TAction(['CotacaoEmpresaCadastramentoForm', 'onEdit'],  ['key' => '{id}'] ), 'fa:plus-circle green');

        //$this->form->addAction( 'Gravar orçamento para a esta solicitação', new TAction([$this, 'onSave']), 'fa:save green');
        //$this->form->addActionLink( 'Limpar',new TAction([$this, 'onClear']), 'fa:eraser red');
        
        // make id not editable
        $id->setEditable(FALSE);
        $data_pedido->setEditable(FALSE);
        $obs->setEditable(FALSE);
        $obs_empresa->setEditable(FALSE);
        $origem_estado_id->setEditable(FALSE);
        $origem_cidade_id->setEditable(FALSE);
        $destino_estado_id->setEditable(FALSE);
        $destino_cidade_id->setEditable(FALSE);
        $tipo_produto->setEditable(FALSE);
        $kg->setEditable(FALSE);           
        $m3->setEditable(FALSE);         
        $volumes->setEditable(FALSE);     
        $embalagem_id->setEditable(FALSE);
        $kg->setEditable(FALSE);
        $m3->setEditable(FALSE);
        $volumes->setEditable(FALSE);
        $valor_nf->setEditable(FALSE);   
        $status_id->setEditable(FALSE);    
        $data_cotacao->setEditable(FALSE);  
        $valor_cotacao->setEditable(FALSE);
        
        $data_pedido->setMask('dd/mm/yyyy');
        $data_pedido->setDatabaseMask('yyyy-mm-dd');
        
        
        
        
        
        
       
        
        //Datagrid / Listagem dos orcamentos de motoristas vinculados a essa solicitação
        //$this->setDatabase('uppertruck');        // defines the database
        //$this->setActiveRecord('OrcamentoMotorista');       // defines the active record
        //$this->addFilterField('motorista_id', 'like', 'motorista_id'); // filter field, operator, form field
        //$this->setDefaultOrder('id', 'asc');  // define the default order
        
        $this->datagrid = new BootstrapDatagridWrapper(new TDataGrid);
        $this->datagrid->width = "100%";
        
        //$this->datagrid->enablePopover('Motorista', 'teste');
        
        $col_id             = new TDataGridColumn('id', 'Id', 'right');
        $col_data_orcamento = new TDataGridColumn('data_orcamento', 'Data', 'left');
        $col_motorista      = new TDataGridColumn('motorista_id', 'Motorista', 'left');
        $col_valor          = new TDataGridColumn('valor', 'Valor', 'left');
        $col_prazo          = new TDataGridColumn('prazo', 'Prazo', 'left');
        $col_obs            = new TDataGridColumn('obs', 'Obs', 'left');
        $col_status         = new TDataGridColumn('status', 'Situação', 'left');
        
        $this->datagrid->addColumn($col_id);
        $this->datagrid->addColumn($col_data_orcamento);
        $this->datagrid->addColumn($col_motorista);
        $this->datagrid->addColumn($col_valor);
        $this->datagrid->addColumn($col_prazo);
        $this->datagrid->addColumn($col_obs);
        $this->datagrid->addColumn($col_status);
        
        $this->datagrid->disableDefaultClick();
        
        $col_data_orcamento->setTransformer( function($value, $obj, $row) {
        
            if ( $obj->status == 4 OR $obj->status == 5 OR $obj->status == 6 )
            {
                $row->style= 'color: silver';
            }
            return TDate::convertToMask($value, 'yyyy-mm-dd', 'dd/mm/yyyy');
        });
        
        $col_motorista->setTransformer( function($value) {
            TTransaction::open('uppertruck');
            $motorista = new SystemUser($value);
            TTransaction::close();
            return $motorista->name;
        });
        
        $col_valor->setTransformer( function($value) {
            if (is_numeric($value)) {
                return 'R$&nbsp;'.number_format($value, 2, ',', '.');
            }
            return $value;
        });
        
        $col_status->setTransformer( function($value) {
            TTransaction::open('uppertruck');
            $status = new StatusOrcamentoMotorista($value);
            TTransaction::close();
            switch ($value) 
            {
                case '1': // Solicitado ao motorista
                  $class = 'warning';
                  break;
                case '2': // Analisar
                  $class = 'danger';
                  break;
                case '3': //Aceito
                  $class = 'success';
                  break;
                case '4': //Rejeitado motorista
                  $class = 'default';
                  break;
                case '5': // Rejeitado
                  $class = 'default';
                  break;
                case '6': // Cancelada
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
       
        
        
        // cria as ações da datagrid
        $act_accept = new TDataGridAction([$this, 'onChangeOrc'], [ 'id' => '{id}', 'change_type' => 'accept', 'change_type_id' => 3, 'change_type_msg' => 'aceitar',  'change_type_msgok' => 'aceita']);
        $act_reject = new TDataGridAction([$this, 'onChangeOrc'], [ 'id' => '{id}', 'change_type' => 'reject', 'change_type_id' => 5, 'change_type_msg' => 'rejeitar', 'change_type_msgok' => 'rejeitada' ]);
        $act_motorista = new TDataGridAction(['SystemUserForm', 'onEdit'], [ 'orcamento_id' => '{id}']);
        $act_cancel = new TDataGridAction([$this, 'onChangeOrc'], [ 'id' => '{id}', 'change_type' => 'cancel', 'change_type_id' => 6, 'change_type_msg' => 'cancelar', 'change_type_msgok' => 'cancelada' ]);
        // define labels é ícones usando a biblioteca Font Awesome
        $act_accept->setLabel('Aceitar orçamento');
        $act_accept->setImage('fa:thumbs-up green');
        $act_reject->setLabel('Rejeitar orçamento');
        $act_reject->setImage('fa:thumbs-down #ffc107');
        $act_motorista->setLabel('Cadastro morotista');
        $act_motorista->setImage('fa:address-card #7C93CF');
        $act_cancel->setLabel('Cancelar orçamento');
        $act_cancel->setImage('fa:times red');
        
        
        //define as condições de exibição das ações
        $act_reject->setDisplayCondition( array($this, 'displayReject') );
        $act_accept->setDisplayCondition( array($this, 'displayAccept') );
        $act_cancel->setDisplayCondition( array($this, 'displayCancel') );

        // cria o agrupamento de ações
        $action_group = new TDataGridActionGroup('Opções', 'fa:th');
        // adiciona as ações ao agrupamento
        $action_group->addHeader('Opções');
        $action_group->addAction($act_accept);
        $action_group->addAction($act_reject);
        $action_group->addAction($act_cancel);
        
        $action_group->addSeparator();
        $action_group->addHeader('');
        $action_group->addAction($act_motorista);
        
        $this->datagrid->addActionGroup($action_group); // adiciona o agrupamento
        
        
        
        
        
        
        
        
        
        
        
        
        
        
       
        //$criteria = new TCriteria;
        //$criteria->add( new TFilter( 'cotacao_id', '=', $cotacaoid ) );
        //parent::setCriteria($criteria);
        
        
        
        
        
        
        
        
        
        
        
        
        $this->datagrid->createModel();
        
        $this->pageNavigation = new TPageNavigation;
        $this->pageNavigation->setAction(new TAction(array($this, 'onReload')));
        
        
        $panel = new TPanelGroup( 'Orçamentos dos motoristas' );
        $panel->add($this->datagrid);
        $panel->add($this->pageNavigation);
        
        //****
        
        
        
        
        
        
        
        // wrap objects inside a table
        $vbox = new TVBox;
        $vbox->style = 'width: 100%';
        //$vbox->add(new TXMLBreadCrumb('menu.xml', __CLASS__));
        $vbox->add(new TXMLBreadCrumb('menu.xml', 'CotacaoEmpresaList'));
        $vbox->add($this->form);
        //$vbox->add(TPanelGroup::pack('', $this->datagrid, $this->pageNavigation));
        $vbox->add($panel);
        
        parent::add($vbox);
    }
    
   //VERIFICAR ANTES DE APAGAR on save não está sendo usado aqui 
//     function onSave()
//     {
//         try
//         {
//             // open a transaction with database 'samples'
//             TTransaction::open('uppertruck');
//             
//             $this->form_orcamento->validate(); // run form validation
//             
//             $data = $this->form_orcamento->getData(); // get form data as array
//             $dados_cotacao = $this->form->getData();  
//             
//             new TMessage('info', json_encode($dados_cotacao));
//             
//             $object = new OrcamentoMotorista;  // create an empty object
//             $object->fromArray( (array) $data); // load the object with data
//             $cotacao = new Cotacao;
//             $cotacao->fromArray( (array) $dados_cotacao );
//             
//             $object->data_orcamento         = date('Y-m-d');
//             //$object->cotacao_id             = $cotacao->id;
//             //$object->motorista_id           = TSession::getValue('userid');
//             $object->status                   = 2;  // Pendente de análise por parte da uppertruck
//             
//             
//             $object->store(); // save the object
//             
//             // fill the form with the active record data
//             $this->form_orcamento->setData($object);
//             
//             
//             TTransaction::close();  // close the transaction
//             
//             // shows the success message
//             $act = new TAction(['OrcamentoMotoristaPendenteList','onReload']);
//             new TMessage('info', 'Orçamento enviado com sucesso.', $act);
//             
//         }
//         catch (Exception $e) // in case of exception
//         {
//             new TMessage('error', $e->getMessage()); // shows the exception error message
//             $this->form->setData( $this->form->getData() ); // keep form data
//             TTransaction::rollback(); // undo all pending operations
//         }
//     }
    
    
    function onEdit($param)
    {
        try
        {
            if (isset($param['id']))
            {
                $key = $param['id'];  // get the parameter
                
                
                if (isset($param['cotacao_id']) )
                {
                    $key = $param['cotacao_id'];
                }
                
                
                TTransaction::open('uppertruck');   // open a transaction with database 'samples'
                $object  = new Cotacao($key);        // instantiates object City
                $cidade  = new Cidade($object->origem_cidade_id);
                $cidade2 = new Cidade($object->destino_cidade_id);
                $object->origem_estado_id  = $cidade->estado_id;
                $object->destino_estado_id = $cidade2->estado_id;
                
                $criteria =  TCriteria::create( ['estado_id' => $object->origem_estado_id] );
                $criteria2 = TCriteria::create( ['estado_id' => $object->destino_estado_id] );
                TDBCombo::reloadFromModel('form_cotacao', 'origem_cidade_id',  'uppertruck', 'Cidade', 'id', '{nome} ({id})', 'nome', $criteria, TRUE);
                TDBCombo::reloadFromModel('form_cotacao', 'destino_cidade_id', 'uppertruck', 'Cidade', 'id', '{nome} ({id})', 'nome', $criteria2, TRUE);
                //new TMessage('info', json_decode($object->origem_cidade_id));
                
                $this->form->setData($object);   // fill the form with the active record data
           
                
                $obj = new StdClass;
                $obj->origem_cidade_id  = $object->origem_cidade_id;
                $obj->destino_cidade_id = $object->destino_cidade_id;
                TForm::sendData('form_cotacao', $obj);
                
                if ( $object->status_id == 1  ) // se status da cotação foi analisar na visão da empresa - pendente de envio de cotação
                {
                    $this->form->addAction('Responder solicitação', new TAction(['CotacaoEmpresaResp', 'onEdit']),  'fa:hand-point-right #7C93CF');      
                }
                if ( $object->status_id == 3  ) // se status da cotação for aceita exibir botão de atalho para a programação ref. a essa cotação
                {
                   
                    $act = new TAction(['ProgramacaoEmpresaForm', 'onEdit']);
                    $act->setParameters(['programacao_id' => $object->programacao_id]);   
                    
                    //$act->setParameters(['id' => 9, 'key' => 9]);   
             
                    $this->form->addAction('Ficha de programação de embarque', $act,  'fa:hand-point-right #7C93CF');           
                }
                 
               
                                
                //popular datagrid com orcamentos vinculados à cotação
                
                $this->datagrid->clear();
                $criteria = new TCriteria;
                $criteria->add( new TFilter( 'cotacao_id', '=', $key ) );
                $repos = new TRepository('OrcamentoMotorista');
                $orcamentos = $repos->load($criteria);
                foreach ( $orcamentos as $orcamento)
                {
                    $row = $this->datagrid->addItem($orcamento);
                    
                    
                    TTransaction::open('uppertruck');
                    $motorista = new SystemUser($orcamento->motorista_id);
                    $cidade   = new Cidade($motorista->cidade_id);
                    $estado   = new Estado($cidade->estado_id);                  
                    TTransaction::close();
                   
                    
                    
                    // habilita um popover ao elemento
                    $row->popover = 'true'; // habilita popover
                    //$row->popside = 'top'; // posição do popover (top, bottom, left, right)
                    $row->popcontent = "<b>{$motorista->name}</b><br/>Tel {$motorista->phone}<br/>email {$motorista->email}<br/>{$cidade->nome}-{$estado->uf}";
                    //$row->poptitle = 'Motorista';
                }
               
               
                
                
                
                
                
                
                
                
                
                
                
                $this->onReload;
                
                
                //$criteria = new TCriteria;
                //$criteria->add( new TFilter('cotacao_id','=',$key) );
                //$criteria->add( new TFilter('motorista_id','=', TSession::getValue('userid')) );
                //$repository = new TRepository('OrcamentoMotorista'); 
                //$orcamento  = $repository->load($criteria); 
                //$this->form_orcamento->setData($orcamento[0]);  
                
                
                
                TTransaction::close();           // close the transaction
                
                
                    
                
            }
            else
            {
                $this->form->clear( true );
            }
        }
        catch (Exception $e) // in case of exception
        {
            new TMessage('error', $e->getMessage()); // shows the exception error message
            TTransaction::rollback(); // undo all pending operations
        }
    }
    
    
    
    
    public static function onChangeOrc($param)
    {
        // define the delete action
        $action = new TAction(array(__CLASS__, 'ChangeOrc'));
        $action->setParameters($param); // pass the key parameter ahead
        // shows a dialog to the user
        
        
        
        new TQuestion('Você realmente quer ' . $param['change_type_msg'] . ' essa solicitação de orçamento?', $action);
    }
    public static function ChangeOrc($param)
    {
        try
        {
        
            TTransaction::open('permission');
            $preferences = SystemPreference::getAllPreferences();
            TTransaction::close();
        
            $key=$param['id']; // get the parameter $key
            $type_id = $param['change_type_id'];
            
            TTransaction::open('uppertruck'); // open a transaction with database               
            $orc = new OrcamentoMotorista($key);
            $orc->status = $type_id;
            $orc->store();
            //$cotacao = $orc->cotacao;
            $cotacao = new Cotacao($orc->cotacao_id);  
            
            $msg_motorista = $preferences['msg_cotacao_outros_motorista'];
            $subject = 'Alteração com relação à solicitação de orçamento';
            
            if ( $type_id == 3  ) // se mudou para "orçamento aceito" rejeitar e/ou cancelar os demais orçamentos vinculados à cotação
            {
                $repos1 = new TRepository('OrcamentoMotorista');
                $criteria1 = new TCriteria;
                $criteria1->add( new TFilter('cotacao_id', '=', $orc->cotacao_id) );
                $criteria1->add( new TFilter('status', '=', 1) );  // solicitado ao motorista
                $values1 = array( 'status' => 6);  // cancelado
                $orcamentos1 = $repos1->load($criteria1); 
                //$repos1->update($values1, $criteria1);
                
                $repos2 = new TRepository('OrcamentoMotorista');
                $criteria2 = new TCriteria;
                $criteria2->add( new TFilter('cotacao_id', '=', $orc->cotacao_id) );
                $criteria2->add( new TFilter('status', '=', 2) );  // analisar
                $values2 = array( 'status' => 5);  // Rejeitado
                $orcamentos2 = $repos2->load($criteria2);
                //$repos2->update($values2, $criteria2);   
                
                
                foreach( $orcamentos1 as $orcamento )
                {
                    $orcamento->status = 6; // cancelado
                    $orcamento->store();
                    $msg_motorista = $preferences['msg_cotacao_outros_motorista'];
                    $motorista = new SystemUser($orcamento->motorista_id);
                    $email = trim($motorista->email);
                    $subject = 'Solicitação de orçamento cancelada';
                    $arr = ['{msg_status}' => 'Pedido de orçamento cancelado.', 
                            '{nome_motorista}' => $motorista->name];     
                    if ($preferences['send_msg_motorista'])
                    {
                        QueueSendUtil::put($email, $subject, $msg_motorista, $cotacao, $arr);
                    }          
                }
                foreach( $orcamentos2 as $orcamento )
                {
                    $orcamento->status = 5; // rejeitado
                    $orcamento->store();
                    $msg_motorista = $preferences['msg_cotacao_outros_motorista'];
                    $motorista = new SystemUser($orcamento->motorista_id);
                    $email = trim($motorista->email);
                    $subject = 'Solicitação de orçamento cancelada';
                    $arr = ['{msg_status}' => 'Ficamos gratos pelo envio do seu orçamento, mas, desta vez, contratamos com outro motorista parceiro. Assim que tivermos mais cotações, lhe enviaremos nova solicitação de orçamento.', 
                            '{nome_motorista}' => $motorista->name];     
                    if ($preferences['send_msg_motorista'])
                    {
                        QueueSendUtil::put($email, $subject, $msg_motorista, $cotacao, $arr);
                    }          
                }
                
                
                //$cotacao = $orc->cotacao;
                $programacao = $cotacao->programacao;
                if ( $programacao ) // se exitir programcao vinculada a cotação, atualizar com o orçamento do motorista aceito
                {
                        $programacao->motorista_id    = $orc->motorista_id;
                        $programacao->valor_motorista = $orc->valor;
                        $programacao->store();       
                }
                $msg_motorista = $preferences['msg_aceite_orcamento_motorista'];
                $subject = 'Seu orçamento foi aceito';
            }
            
            
            $motorista = new SystemUser($orc->motorista_id);
            $email = trim($motorista->email);
            $status = new StatusOrcamentoMotorista($type_id);
                     
            $arr = ['{msg_status}' => 'Novo status: ' . $status->visao_motorista, 
                    '{nome_motorista}' => $motorista->name];     
            if ($preferences['send_msg_motorista'])
            {
                QueueSendUtil::put($email, $subject, $msg_motorista, $orc, $arr);
            }          
            
            
            
            TTransaction::close(); // close the transaction
            $act = new TAction([__CLASS__, 'onEdit'], ['id'=>$cotacao->id , 'key' =>$cotacao->id]);
            new TMessage('info', 'Solicitação de orçamento ' . $param['change_type_msgok'] . ' com sucesso', $act); // success message
        }
        catch (Exception $e) // in case of exception
        {
            new TMessage('error', $e->getMessage()); // shows the exception error message
            TTransaction::rollback(); // undo all pending operations
        }
    }
    
    
    public function displayReject( $obj )
    {   
        if ( $obj->status == 2 )
        {
            return true;
        }
        return false;    
    }
    
    public function displayAccept( $obj )
    {   
        if ( $obj->status == 2 )
        {
            return true;
        }
        return false;    
    }
    
    public function displayCancel( $obj )
    {   
        if ( $obj->status == 6 )
        {
            return false;
        }
        return true;    
    }
    
    
    
    
    
    
}