<?php
class CotacaoClienteForm extends TPage
{
    protected $form;      // form
    
    protected $wrapper_form_resp;
    protected $form_resp;
    protected $input;
    protected $label;
    protected $label_accept;
    protected $label_reject;
    
    
    // trait with onSave, onEdit, onDelete, onReload, onSearch...
    //use Adianti\Base\AdiantiStandardFormListTrait;
    use Adianti\Base\AdiantiStandardFormTrait;
    
    /**
     * Class constructor
     * Creates the page, the form and the listing
     */
    public function __construct()
    {
        parent::__construct();
        
        $this->setDatabase('uppertruck'); // define the database
        $this->setActiveRecord('Cotacao'); // define the Active Record
       
        
        // create the form
        $this->form = new BootstrapFormBuilder('form_cotacao');
        $this->form->setFormTitle('Pedido de cotação');
        
        // create the form fields
        $this->input['id']             = new TEntry('id');
        $this->input['data_pedido']  = new TDate('data_pedido');
        
        
        $filter = new TCriteria;
        $filter->add(new TFilter('id', '<', '0'));
        
        $this->input['origem_estado_id']     = new TDBCombo('origem_estado_id', 'uppertruck', 'Estado', 'id', '{nome} ({uf})');
        $this->input['origem_estado_id']->setChangeAction( new TAction( [$this, 'onChangeEstadoOrigem'] ) );
        $this->input['origem_cidade_id']  = new TDBCombo('origem_cidade_id',  'uppertruck', 'Cidade', 'id', 'nome', 'nome', $filter);
        $this->input['origem_cidade_id']->enableSearch();
        $this->input['origem_estado_id']->enableSearch();
        
        $this->input['destino_estado_id']     = new TDBCombo('destino_estado_id', 'uppertruck', 'Estado', 'id', '{nome} ({uf})');
        $this->input['destino_estado_id']->setChangeAction( new TAction( [$this, 'onChangeEstadoDestino'] ) );
        $this->input['destino_cidade_id'] = new TDBCombo('destino_cidade_id', 'uppertruck', 'Cidade', 'id', 'nome', 'nome', $filter);
        $this->input['destino_cidade_id']->enableSearch();
        $this->input['destino_estado_id']->enableSearch();
       
        
        //$this->input['tipo_produto']      = new TEntry('tipo_produto');
        $this->input['tipo_produto']      = new TDBCombo('tipo_produto', 'uppertruck', 'TipoProduto', 'id', 'descricao', 'descricao');
        
        
        $this->input['kg']                = new TSpinner('kg');
        $this->input['m3']                = new TSpinner('m3');
        $this->input['volumes']           = new TSpinner('volumes');
        
        $this->input['embalagem_id']     = new TDBCombo('embalagem_id', 'uppertruck', 'Embalagem', 'id', 'nome');
        
        $this->input['kg']->setRange(1, 1000, 1);
        $this->input['m3']->setRange(0, 1000, 1);
        $this->input['volumes']->setRange(1, 1000, 1);
        
        
        $this->input['valor_nf']          = new TEntry('valor_nf');
        $this->input['status_id']         = new TEntry('status_id');
        
        $this->input['data_cotacao']      = new TDate('data_cotacao');
        $this->input['valor_cotacao']     = new TEntry('valor_cotacao');
        
        $this->input['obs']               = new TText('obs');
        
        
        
        
        $this->input['valor_cotacao']->setNumericMask(2, ',', '.', true);
        $this->input['valor_nf']->setNumericMask(2, ',', '.', true);
        
        
        $this->input['obs']->setSize('100%', 60);
        $this->input['id']->setSize('100%');
        $this->input['data_pedido']->setSize('100%');       
        $this->input['origem_estado_id']->setSize('100%');     
        $this->input['origem_cidade_id']->setSize('100%'); 
        $this->input['destino_estado_id']->setSize('100%');
        $this->input['destino_cidade_id']->setSize('100%'); 
        $this->input['tipo_produto']->setSize('100%');     
        $this->input['kg']->setSize('100%');               
        $this->input['m3']->setSize('100%');             
        $this->input['volumes']->setSize('100%');          
        $this->input['embalagem_id']->setSize('100%');   
        $this->input['kg']->setSize('100%');
        $this->input['m3']->setSize('100%');
        $this->input['volumes']->setSize('100%');
        $this->input['valor_nf']->setSize('100%');        
        $this->input['status_id']->setSize('100%');        
        $this->input['data_cotacao']->setSize('100%');      
        $this->input['valor_cotacao']->setSize('100%');     
        
        $this->input['tipo_produto']->enableSearch();
        $this->input['embalagem_id']->enableSearch();
        
        
        // add the form fields
        $this->form->addFields( [new TLabel('ID')],             [$this->input['id']], [new TLabel('Solicitação / Alteração')],    [$this->input['data_pedido']] );
        //$this->form->addFields( [new TLabel('Cliente')],        [$cliente_id] );
        
        //$this->form->addFields( [new TLabel('Data pedido de cotação')],    [$data_pedido] );
        
        $this->form->addContent( [new TFormSeparator('')]);
        $this->form->addFields( [ new TLabel('UF Origem') ],  [$this->input['origem_estado_id']],  [ new TLabel('Cidade Origem') ], [ $this->input['origem_cidade_id' ]] );
        $this->form->addFields( [ new TLabel('UF Destino') ], [$this->input['destino_estado_id']], [ new TLabel('Cidade Destino')], [ $this->input['destino_cidade_id']] );
        $this->form->addContent( [new TFormSeparator('')]);
        
        $this->form->addFields( [new TLabel('Tipo de produto')], [$this->input['tipo_produto']],   [ new TLabel('Peso/Kg') ], [$this->input['kg']] );
        
        $this->form->addFields( [ new TLabel('Cubagem/m3') ], [ $this->input['m3']],               [ new TLabel('Embalagens') ], [$this->input['embalagem_id']] );
        
        $this->form->addFields( [new TLabel('Qtd. de Volumes')], [$this->input['volumes']], [new TLabel('Valor Nota Fiscal/R$')], [$this->input['valor_nf']] );
        
        
        
        $this->form->addContent( [new TFormSeparator('')]);
        $this->form->addFields( [new TLabel('obs')], [$this->input['obs']] );
        
        
        
        // define the form actions
        $this->form->addAction( 'Enviar / Alterar', new TAction([$this, 'onSave']), 'fa:save green');
        $this->form->addActionLink( 'Limpar',new TAction([$this, 'onClear']), 'fa:eraser red');
        $this->form->addHeaderAction( 'Voltar',new TAction(['CotacaoClienteList', 'onReload']), 'far:arrow-alt-circle-left blue');
        
        
        // make id not editable
        $this->input['id']->setEditable(FALSE);
        $this->input['data_pedido']->setEditable(FALSE);
        $this->input['data_pedido']->setMask('dd/mm/yyyy');
        $this->input['data_pedido']->setDatabaseMask('yyyy-mm-dd');
        
       
        
        
        
        //Formulário de resposta da cotação
        $this->form_resp = new BootstrapFormBuilder('form_resp');
        //$this->form->setClientValidation(true);
        $this->form_resp->setFormTitle('Cotação para a sua solicitação');
        
        // create the form fields
        $id            = new THidden('id');
        $valor_cotacao = new TEntry('valor_cotacao');
        $prazo         = new TSpinner('prazo');
        $obs_empresa   = new TText('obs_empresa');
        $this->input['msg_cliente']   = new TText('msg_cliente');
        
        $id->setEditable(FALSE);
        $valor_cotacao->setEditable(FALSE);
        $prazo->setEditable(FALSE);
        $obs_empresa->setEditable(FALSE);
        
        $id->setSize('100%');
        $valor_cotacao->setSize('100%');
        $prazo->setSize('100%');
        $obs_empresa->setSize('100%', 60);
        $this->input['msg_cliente']->setSize('100%', 60);
        $this->input['msg_cliente']->placeholder = 'Mensagem opcional...';
        
        $prazo->setRange(1, 90, 1);  
        $valor_cotacao->addValidation('Valor cotado', new TRequiredValidator);
        $valor_cotacao->setNumericMask(2, ',', '.', true);
        
        
        
        
        $this->label = new TLabel('Aceite ou rejeite a cotação nas opções abaixo. Se quiser, você pode escrever uma mensagem', '#7D78B6', 14, 'bi');
        $this->label->style='text-align:left;border-bottom:1px solid #c0c0c0;width:100%';
        $this->label_accept = new TLabel('Cotação aceita.', 'green', 14, 'bi');
        $this->label_accept->style='text-align:left;border-bottom:1px solid #c0c0c0;width:100%';
        $this->label_reject = new TLabel('Cotação rejeitada.', '#E65100', 14, 'bi');
        $this->label_reject->style='text-align:left;border-bottom:1px solid #c0c0c0;width:100%';
        $this->form_resp->addContent( [$this->label] );
        $this->form_resp->addContent( [$this->label_reject] );
        $this->form_resp->addContent( [$this->label_accept] );
        
        $this->form_resp->addFields( [$id] );
        $this->form_resp->addFields( [new TLabel('Valo do serviço / R$')],    [$valor_cotacao] );
        $this->form_resp->addFields( [new TLabel('Prazo estimado de transporte (em dias)')],    [$prazo] );   
        $this->form_resp->addFields( [new TLabel('Obs')],    [$obs_empresa] );  
        $this->form_resp->addFields( [new TLabel('Sua mensagem para UpperTruck')], [$this->input['msg_cliente']] );
        
        
         // define the form actions
        $this->form_resp->addAction( 'Aceitar a cotação',     new TAction([$this, 'onAccept']), 'fa:thumbs-up green');
        $this->form_resp->addAction( 'Rejeitar',new TAction([$this, 'onReject']), 'fa:thumbs-down #ffc107');
        
        $this->wrapper_form_resp = new TVBox;
        $this->wrapper_form_resp->style = 'width: 100%';
        $this->wrapper_form_resp->add($this->form_resp);
        
        // wrap objects inside a table
        $vbox = new TVBox;
        $vbox->style = 'width: 100%';
        $vbox->add(new TXMLBreadCrumb('menu.xml', 'CotacaoClienteList'));
        $vbox->add($this->form);
        $vbox->add($this->wrapper_form_resp);
        
        
        
        parent::add($vbox);
    }
    
    public function onClear()
    {
        $this->form->clear( TRUE );
        $this->wrapper_form_resp->style = 'display:none'; 
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
    
    
    function onSave()
    {
    
        $this->wrapper_form_resp->style = 'display:none'; 
        try
        {
        
            TTransaction::open('permission');
            $preferences = SystemPreference::getAllPreferences();
            TTransaction::close();
            
          
            TTransaction::open('uppertruck');
            
            $this->form->validate(); // run form validation
            
            $data = $this->form->getData(); // get form data as array
            
            $object = new Cotacao;  // create an empty object
            $object->fromArray( (array) $data); // load the object with data
            
            $object->data_pedido = date('Y-m-d');
            $object->cliente_id = TSession::getValue('userid');
            $object->status_id  = 1;  // Enviado
            
            $object->store(); // save the object
           
            $msg_motorista = $preferences['msg_conf_solicitacao_cotacao_motorista'];
            $msg_empresa = $preferences['msg_conf_solicitacao_cotacao_empresa'];
            $msg_cliente = $preferences['msg_conf_solicitacao_cotacao_cliente'];
            
            //enviar pedido de orçamento desta cotação para todos os motoristas
            $criteria = new TCriteria; 
            $criteria->add(new TFilter('grupo', '=', 4));   //motorista
            $repository = new TRepository('SystemUser'); 
            $motoristas = $repository->load($criteria); 
            foreach ($motoristas as $motorista) 
            { 
               
               
               $orcamento = new OrcamentoMotorista;
               $orcamento->cotacao_id = $object->id;
               $orcamento->motorista_id = $motorista->id;
               $orcamento->status = 1;
               $orcamento->store(); 
               
               //colocar email para motorista na fila de envio
               $email = trim($motorista->email);
               $subject = 'Nova solicitação de orçamento - UpperTruck';
               //$msg = strtr($msg_motorista,$arr);
               $arr = [ '{nome_motorista}' => $motorista->name ]; 
               if ($preferences['send_msg_motorista'])
               {
                   QueueSendUtil::put($email, $subject, $msg_motorista, $object, $arr);
               }  
               
            }
            
            //colocar email para empresa na fila de envio
            $email = trim($preferences['mail_destiny1']);
            $subject = 'Nova solicitação de Cotação de cliente';
            //$msg = strtr($msg_empresa, $arr);
            if ($preferences['send_msg_empresa_cotacao'])
            {
                QueueSendUtil::put($email, $subject, $msg_empresa, $object);
            }
            
            
            //colocar email para cliente na fila de envio
            $email = trim(TSession::getValue('usermail'));
            $subject = 'Solicitação de cotação recebida pela Uppertruck';
            //$msg = strtr($msg_cliente, $arr);
            if ($preferences['send_msg_cliente'])
            {
                QueueSendUtil::put($email, $subject, $msg_cliente, $object);
            }
            
            
            
            TTransaction::close();  // close the transaction
            
            
            
            // shows the success message
            $pos_action = new TAction(['CotacaoClienteList', 'onReload']);
            new TMessage('info', 'Pedido de cotação enviado.', $pos_action);
            //new TMessage('info', 'Pedido de cotação enviado.');
            
        }
        catch (Exception $e) // in case of exception
        {
            new TMessage('error', $e->getMessage()); // shows the exception error message
            $this->form->setData( $this->form->getData() ); // keep form data
            TTransaction::rollback(); // undo all pending operations
        }
    }
    
    
    function onEdit($param)
    {
        try
        {
            if (isset($param['id']))
            {
            
                //$this->obs->setEditable(FALSE);
                $key = $param['id'];  // get the parameter
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
                //new TMessage('info', json_decode($object['origem_cidade_id']));
                
                $this->form->setData($object);   // fill the form with the active record data
                $this->form_resp->setData($object);
               
                
                // Atualizado .. .OR true... impedir edição em todos os casos, pois pode haver inconsistências com orçamentos enviados antes da edicaçã0 - melhor permitir apenas exclusão do pedido
                if ( $object->status_id != 1 OR true )  // se status diferente de "ainda em análise pela uppertruck" não permitir mais edição
                {
                    $input = (array)$this->form->getData();
                    foreach ($input as $key => $value)
                    {
                        //echo $key;
                        $this->input[$key]->setEditable(FALSE);
                    }
                }
                 $this->form->delActions(); // colocado agora para tirar opção ce enviar e limpar no caso de existir cotacao preenchida - rafatorar depois
                
                if ( $object->status_id == 1 OR $object->status_id == 5 OR $object->status_id == 6 )  // se status em análise pela empresa ou cancelado
                {
                    $this->wrapper_form_resp->style = 'display:none';                
                }
                else
                {
                    $this->form->delActions();
                    $this->label->style = 'display:inline-block'; 
                    $this->label_reject->style = 'display:none'; 
                    $this->label_accept->style = 'display:none'; 
                    if ( $object->status_id == 3 ) //aceita
                    {
                        $this->input['msg_cliente']->setEditable(FALSE); 
                        $this->form_resp->delActions();
                        $this->label_accept->style = 'display:inline-block'; 
                        $this->label->style = 'display:none';
                    } 
                    if ( $object->status_id == 4) //rejeitada
                    {
                        $this->input['msg_cliente']->setEditable(FALSE); 
                        $this->form_resp->delActions();
                        $this->label_reject->style = 'display:inline-block'; 
                        $this->label->style = 'display:none';
                    } 
                    //$this->label->style = 'display:none';  
                    //$this->label = new TLabel('Teste', '#7D78B6', 12, 'bi');
                }
                
                
                
                
                
                $obj = new StdClass;
                $obj->origem_cidade_id  = $object->origem_cidade_id;
                $obj->destino_cidade_id = $object->destino_cidade_id;
                TForm::sendData('form_cotacao', $obj);
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
    
   
   //VERIFICAR ANTES DE APAGAR.... CREIO QUE NÃO ESTEJE FUNCIONANDO 
//     public function Delete($param)
//     {
//         try
//         {
//             $key=$param['id']; // get the parameter $key
//             TTransaction::open('uppertruck'); // open a transaction with database
//             
//             $repos = new TRepository('OrcamentoMotorista');
//             $criteria = new TCriteria;
//             $criteria->add(new TFilter('cotacao_id', '=', $key));
//             $repos->delete($criteria);
//             
//             $object = new Cotacao($key); // instantiates the Active Record
//             $object->delete(); // deletes the object from the database
//             TTransaction::close(); // close the transaction
//             
//             $pos_action = new TAction([__CLASS__, 'onReload']);
//             new TMessage('info', AdiantiCoreTranslator::translate('Record deleted'), $pos_action); // success message
//         }
//         catch (Exception $e) // in case of exception
//         {
//             new TMessage('error', $e->getMessage()); // shows the exception error message
//             TTransaction::rollback(); // undo all pending operations
//         }
//     }
    
    
    public static function onAccept($param)
    {
        $action = new TAction(array(__CLASS__, 'accept'));
        $action->setParameters($param); // pass the key parameter ahead
        new TQuestion('Confirma o aceite da cotação?', $action);
        
        //new TMessage('info', json_encode($param));
    }
    
    
    public static function accept($param)
    {
        try 
        { 
        
            TTransaction::open('permission');
            $preferences = SystemPreference::getAllPreferences();
            TTransaction::close();
        
        
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
                $cotacao->msg_cliente = $param['msg_cliente'];
                $programacao = new Programacao;
                $programacao->cotacao_id            = $cotacao->id;
                $programacao->cliente_id            = $cotacao->cliente_id;
                $programacao->pagador_id            = $cotacao->pagador_id;
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
                
                $msg_empresa = $preferences['msg_aceite_cotacao_empresa'];
                $msg_cliente = $preferences['msg_aceite_cotacao_cliente'];
                 //colocar email para empresa na fila de envio
                $email = trim($preferences['mail_destiny1']);
                $subject = 'Cotação aceita pelo cliente';
                if ($preferences['send_msg_empresa_cotacao'])
                {
                    QueueSendUtil::put($email, $subject, $msg_empresa, $cotacao);
                }
                
                //colocar email para cliente na fila de envio
                $email = trim(TSession::getValue('usermail'));
                $subject = 'Confirmação de aceite de cotação - Uppertruck';
                if ($preferences['send_msg_cliente'])
                {
                    QueueSendUtil::put($email, $subject, $msg_cliente, $cotacao);
                }
                
                
            } 

            //new TMessage('info', 'Cotação aceita!'); 
            TTransaction::close(); // close transaction 
            // shows the success message
            $pos_action = new TAction(['CotacaoClienteList', 'onReload']);
            new TMessage('info', 'Cotação aceita - combine o pagamento e agendamento da coleta.', $pos_action);
            
            
            
        } 
        catch (Exception $e) 
        { 
            new TMessage('error', $e->getMessage()); 
            TTransaction::rollback();
        } 
    
    }
   
    
    
    public static function onReject($param)
    {
    
    
         $action = new TAction(array(__CLASS__, 'reject'));
         $action->setParameters($param); // pass the key parameter ahead
         new TQuestion('Você realmente deseja rejeitar a cotação?', $action);
    
    }
    
    public static function reject($param)
    {
    
    
        try 
        { 
        
            TTransaction::open('permission');
            $preferences = SystemPreference::getAllPreferences();
            TTransaction::close();
        
        
            // open transaction 
            TTransaction::open('uppertruck');
            //$data = $this->form->getData();

            // find customer
            $key = $param['id'];
            $cotacao = new Cotacao($key);

            // check if found
            if ($cotacao) 
            { 
                
                $cotacao->status_id = 4;  // rejeitada
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
                    $subject = 'Cotação rejeitada pelo cliente';
                    $arr = ['{msg_status}' => 'Pedido de orçamento cancelado, pois a cotação foi rejeitada pelo cliente.', 
                            '{nome_motorista}' => $motorista->name];     
                    if ($preferences['send_msg_motorista'])
                    {
                        QueueSendUtil::put($email, $subject, $msg_motorista, $cotacao, $arr);
                    }          
                }
                                             
                $msg_empresa = $preferences['msg_rejeicao_cotacao_empresa'];
                $msg_cliente = $preferences['msg_rejeicao_cotacao_cliente'];
                 //colocar email para empresa na fila de envio
                $email = trim($preferences['mail_destiny1']);
                $subject = 'Cotação rejeitada pelo cliente';
                if ($preferences['send_msg_empresa_cotacao'])
                {
                    QueueSendUtil::put($email, $subject, $msg_empresa, $cotacao);
                }
                
                //colocar email para cliente na fila de envio
                $email = trim(TSession::getValue('usermail'));
                $subject = 'Confirmação de rejeição de cotação - Uppertruck';
                if ($preferences['send_msg_cliente'])
                {
                    QueueSendUtil::put($email, $subject, $msg_cliente, $cotacao);
                }
                
                
            } 

            TTransaction::close(); // close transaction 
            $pos_action = new TAction(['CotacaoClienteList', 'onReload']);
            new TMessage('info', 'Cotação rejeitada. Conte conosco sempre que preciso', $pos_action);   

            
        }
        catch (Exception $e)
        { 
             new TMessage('error', $e->getMessage()); 
             TTransaction::rollback();
        } 
    
        
         
    
    }
    
    
}