<?php
class OrcamentoMotoristaPendenteForm extends TPage
{
    protected $form;      // form
    protected $form_orcamento;
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
        
        //$this->setDatabase('uppertruck'); // define the database
        //$this->setActiveRecord('Cotacao'); // define the Active Record
        
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
        
        //$tipo_produto      = new TEntry('tipo_produto');
        $tipo_produto      = new TDBCombo('tipo_produto', 'uppertruck', 'TipoProduto', 'id', 'descricao', 'descricao');
        $kg                = new TSpinner('kg');
        $m3                = new TSpinner('m3');
        $volumes           = new TSpinner('volumes');
        
        $embalagem_id     = new TDBCombo('embalagem_id', 'uppertruck', 'Embalagem', 'id', 'nome');
        
        $kg->setRange(1, 1000, 1);
        $m3->setRange(0, 1000, 1);
        $volumes->setRange(1, 1000, 1);
        
        
        $valor_nf          = new TEntry('valor_nf');
        $status_id         = new TEntry('status_id');
        
        $data_cotacao      = new TDate('data_cotacao');
        $valor_cotacao     = new TEntry('valor_cotacao');
        
        $obs               = new TText('obs');
        
        
        
        
        $valor_cotacao->setNumericMask(2, ',', '.', true);
        $valor_nf->setNumericMask(2, ',', '.', true);
        
        
        $obs->setSize('100%', 60);
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
        
        
        
        // define the form actions
        //$this->form->addAction( 'Gravar orçamento para a esta solicitação', new TAction([$this, 'onSave']), 'fa:save green');
        //$this->form->addActionLink( 'Limpar',new TAction([$this, 'onClear']), 'fa:eraser red');
        
        // make id not editable
        $id->setEditable(FALSE);
        $data_pedido->setEditable(FALSE);
        $obs->setEditable(FALSE);
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
        
        
        
        
        
        
        // formulario para novo orçamento do motorista
        $this->form_orcamento = new BootstrapFormBuilder('form_orcamento');
        $this->form_orcamento->setFormTitle('Registre seu orçamento para essa solicitação');
        $this->form_orcamento->setClientValidation(true);
        
        
        // create the form fields
        //$id_orcammento             = new TEntry('id');
        //$cotacao_id_orcamento      = new TEntry('cliente_id');
        //$motorista_id_orcamento    = new TDate('data_pedido');
        
        $id_orcamento             = new THidden('id');
        
        $valor_orcamento           = new TEntry('valor');
        $prazo_orcamento           = new TSpinner('prazo');
        $obs_orcamento             = new TText('obs');
        
        //$id_orcamento->setEditable(FALSE);
        $valor_orcamento->setSize('100%');
        $prazo_orcamento->setSize('100%');
        $obs_orcamento->setSize('100%', 60);
        $valor_orcamento->setNumericMask(2, ',', '.', true);
        $prazo_orcamento->setRange(0, 90, 1);
        
         // add the form fields
        //$this->form_orcamento->addFields( [new TLabel('Id')],    [$id_orcamento] );
        $this->form_orcamento->addFields( [$id_orcamento] );
        $this->form_orcamento->addFields( [new TLabel('Valor cobrado R$')],    [$valor_orcamento] );
        $this->form_orcamento->addFields( [new TLabel('Prazo estimado em dias para o transporte')],    [$prazo_orcamento] );
        $this->form_orcamento->addFields( [new TLabel('Obs')],    [$obs_orcamento] );
        
        $valor_orcamento->addValidation( 'Valor cobrado R$', new TRequiredValidator);
        $prazo_orcamento->addValidation( 'Prazo estimado...', new TRequiredValidator);
        $prazo_orcamento->addValidation( 'Prazo estimado...', new TMinValueValidator, array(1));
        
        // ações dos formulários
        $this->form_orcamento->addAction( 'Enviar orçamento',     new TAction([$this, 'onSave']),   'fa:paper-plane green');
        $this->form->addHeaderAction( 'Rejeitar solicitação', new TAction([$this, 'onReject']), 'far:trash-alt red');
        
        
        
        
        // wrap objects inside a table
        $vbox = new TVBox;
        $vbox->style = 'width: 100%';
        //$vbox->add(new TXMLBreadCrumb('menu.xml', __CLASS__));
        $vbox->add(new TXMLBreadCrumb('menu.xml', 'OrcamentoMotoristaPendenteList'));
        $vbox->add($this->form);
        $vbox->add($this->form_orcamento);
        
        parent::add($vbox);
    }
    
    
    function onSave()
    {
        try
        {
            // open a transaction with database 'samples'
            TTransaction::open('uppertruck');
            
            $this->form_orcamento->validate(); // run form validation
            
            $data = $this->form_orcamento->getData(); // get form data as array
            $dados_cotacao = $this->form->getData();  
            
            //new TMessage('info', json_encode($dados_cotacao));
            
            $object = new OrcamentoMotorista;  // create an empty object
            $object->fromArray( (array) $data); // load the object with data
            $cotacao = new Cotacao;
            $cotacao->fromArray( (array) $dados_cotacao );
            
            $object->data_orcamento         = date('Y-m-d');
            //$object->cotacao_id             = $cotacao->id;
            //$object->motorista_id           = TSession::getValue('userid');
            $object->status                   = 2;  // Pendente de análise por parte da uppertruck
            
            
            $object->store(); // save the object
            
            // fill the form with the active record data
            $this->form_orcamento->setData($object);
            
            
            TTransaction::close();  // close the transaction
            
            // shows the success message
            $act = new TAction(['OrcamentoMotoristaPendenteList','onReload']);
            new TMessage('info', 'Orçamento enviado com sucesso.', $act);
            
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
                //new TMessage('info', json_decode($object->origem_cidade_id));
                
                $this->form->setData($object);   // fill the form with the active record data
                
                $obj = new StdClass;
                $obj->origem_cidade_id  = $object->origem_cidade_id;
                $obj->destino_cidade_id = $object->destino_cidade_id;
                TForm::sendData('form_cotacao', $obj);
                
                
                
                $criteria = new TCriteria;
                $criteria->add( new TFilter('cotacao_id','=',$key) );
                $criteria->add( new TFilter('motorista_id','=', TSession::getValue('userid')) );
                $repository = new TRepository('OrcamentoMotorista'); 
                $orcamento  = $repository->load($criteria); 
                $this->form_orcamento->setData($orcamento[0]);  
                
                
                
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
    
    
    
    
    
    /**
     * Ask before deletion
     */
    public static function onReject($param)
    {
        // define the delete action
        $action = new TAction(array(__CLASS__, 'Reject'));
        $action->setParameters($param); // pass the key parameter ahead
        // shows a dialog to the user
        new TQuestion('Você realmente quer rejeitar/apagar essa solicitação de orçamento?', $action);
    }
    
    /**
     * Delete a record
     */
    public static function Reject($param)
    {
        try
        {
            $key=$param['id']; // get the parameter $key
            TTransaction::open('uppertruck'); // open a transaction with database
            $criteria = new TCriteria;
            $criteria->add(new TFilter('cotacao_id', '=', $key)); 
            $criteria->add(new TFilter('motorista_id', '=', TSession::getValue('userid') )); 
            
            
            $values = array( 'status' => 4, 'data_orcamento' => date('Y-m-d')  );
            $repositoty = new TRepository('OrcamentoMotorista');
            
            $repositoty->update($values, $criteria);
            TTransaction::close(); // close the transaction
            $pos_action = new TAction(['OrcamentoMotoristaPendenteList', 'onReload']);
            new TMessage('info', 'Solicitação de orçamento rejeitada com sucesso', $pos_action); // success message
        }
        catch (Exception $e) // in case of exception
        {
            new TMessage('error', $e->getMessage()); // shows the exception error message
            TTransaction::rollback(); // undo all pending operations
        }
    }
    
    
    
}