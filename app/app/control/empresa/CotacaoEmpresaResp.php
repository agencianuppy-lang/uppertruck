<?php

class CotacaoEmpresaResp extends TPage
{
    private $form;
    
    public function __construct()
    {
        parent::__construct();
        //parent::setSize(0.6, null);
        
        parent::setTargetContainer('adianti_right_panel');
        
        // creates the form
        $this->form = new BootstrapFormBuilder('form_cotacao_resp');
        //$this->form->setClientValidation(true);
        $this->form->setFormTitle('Resposta de solicitação de cotação');
        
        // create the form fields
        $id            = new TEntry('id');
        $valor_cotacao = new TEntry('valor_cotacao');
        $prazo         = new TSpinner('prazo');
        $obs_empresa   = new TText('obs_empresa');
        
        $id->setEditable(FALSE);
        $id->setSize('100%');
        $valor_cotacao->setSize('100%');
        $prazo->setSize('100%');
        $obs_empresa->setSize('100%', 60);
        
        $prazo->setRange(1, 90, 1);  
        $valor_cotacao->addValidation('Valor cotado', new TRequiredValidator);
        $valor_cotacao->setNumericMask(2, ',', '.', true);
        
        $this->form->addFields( [new TLabel('ID')],    [$id] );
        $this->form->addFields( [new TLabel('Valor cotado')],    [$valor_cotacao] );
        $this->form->addFields( [new TLabel('Prazo estimado de transporte (em dias)')],    [$prazo] );   
        $this->form->addFields( [new TLabel('Obs')],    [$obs_empresa] );    
        
        
        
        // define the form action
        $this->form->addHeaderAction( 'Fechar',  new TAction([$this, 'onClose']), 'fa:times red');
        $this->form->addAction('Enviar cotação', new TAction([$this, 'onSend']),  'fa:paper-plane #7C93CF');
        
        
        // wrap the page content using vertical box
        $vbox = new TVBox;
        $vbox->style = 'width: 100%';
        //$vbox->add(new TXMLBreadCrumb('menu.xml', __CLASS__));
        $vbox->add($this->form);
        parent::add($vbox);
        
        
        parent::add($this->html);            
    }
    
    
    
    function onEdit($param)
    {
        try
        {
            if (isset($param['id']))
            {
                $key = $param['id'];  // get the parameter
                TTransaction::open('uppertruck');   // open a transaction with database 'samples'
                $object = new Cotacao($key);        // instantiates object City
                $this->form->setData($object);   // fill the form with the active record data
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
    
    
    
    public function onSend($param)
    {
        if ( $param['valor_cotacao'] <= 0 OR !isset($param['valor_cotacao']))
        {
             new TMessage('error', 'O campo valor da cotação deve ser preenchido.');
             $this->form->setData( $this->form->getData() ); // keep form data
             return false;
        }
        //$this->form->validate(); // run form validation
        $action = new TAction(array(__CLASS__, 'Send'));
        $data = $this->form->getData(); 
        $action->setParameters(array_merge($param, (array) $data)); // passar o id/key e também os dados do formulário adiante
        // shows a dialog to the user   
        new TQuestion('Confirma o envio da cotação ao cliente?', $action);
    }
    
    public function Send($param)
    {
        
        try
        {
        
            TTransaction::open('permission');
            $preferences = SystemPreference::getAllPreferences();
            TTransaction::close();
            
            
        
            //new TMessage('info', json_encode($param['id']));
        
            TTransaction::open('uppertruck');
            $key = $param['id'];
            $cotacao = new Cotacao($key);
            //new TMessage('info', json_encode($param));
            
            $cotacao->valor_cotacao = $param['valor_cotacao'];
            $cotacao->prazo         = $param['prazo'];
            $cotacao->obs_empresa   = $param['obs_empresa'];
            $cotacao->data_cotacao  = date('Y-m-d');
            $cotacao->status_id        = 2;  // com cliente
            $cotacao->store();
            $this->form->setData($cotacao);
            
            if ($preferences['send_msg_cliente'])
            {
                $msg_cliente = $preferences['msg_envio_cotacao_cliente'];
                $subject = 'Resposta solicitação de cotação - UPPERTRUCK';
                $cliente = new SystemUser($cotacao->cliente_id);
                $email = trim($cliente->email);
                $arr = ['{nome_cliente}' => $cliente->name];     
                QueueSendUtil::put($email, $subject, $msg_cliente, $cotacao, $arr);
            }       
            
            TTransaction::close();
            $act = new TAction(['CotacaoEmpresaList', 'onReload']);
            new TMessage('info', 'Cotação enviada ao cliente para apreciação.', $act);
        }
        catch (Exception $e)
        {
            new TMessage('error', $e->getMessage());
            $this->form->setData( $this->form->getData() ); // keep form data
            TTransaction::rollback();
        }
        
    
    
    }
    
    
    /**
     * on close
     */
    public static function onClose($param)
    {
        TScript::create("Template.closeRightPanel()");
    }
}

