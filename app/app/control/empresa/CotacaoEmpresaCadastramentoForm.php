<?php
/**
 * StandardFormView Registration
 *
 * @version    1.0
 * @package    samples
 * @subpackage tutor
 * @author     Pablo Dall'Oglio
 * @copyright  Copyright (c) 2006 Adianti Solutions Ltd. (http://www.adianti.com.br)
 * @license    http://www.adianti.com.br/framework-license
 */
class CotacaoEmpresaCadastramentoForm extends TPage
{
    protected $form; // form
    
    // trait with onSave, onClear, onEdit
    use Adianti\Base\AdiantiStandardFormTrait;
    
    /**
     * Class constructor
     * Creates the page and the registration form
     */
    function __construct()
    {
        parent::__construct();
        
        $this->setDatabase('uppertruck');    // defines the database
        $this->setActiveRecord('Cotacao');   // defines the active record
        
        // creates the form
        $this->form = new BootstrapFormBuilder('form_cotacao');
        $this->form->setFormTitle('Cadastro Cotação');
        $this->form->setClientValidation(true);






        // create the form fields
        $id                = new TEntry('id');
        //$cliente_id        = new TEntry('cliente_id');
        $data_pedido       = new TDate('data_pedido');
        
        
        $filter = new TCriteria;
        $filter->add(new TFilter('id', '<', '0'));

        
        
        $filterCliente = new TCriteria;
        $filterCliente->add(new TFilter('grupo', '=', '3'));  //clientes
        //$cliente_id = new TDBCombo('cliente_id', 'uppertruck', 'SystemUser', 'id', 'name', 'name', $filterCliente); 

        $cliente_id = new TDBUniqueSearch('cliente_id', 'uppertruck', 'SystemUser', 'id', 'name', 'name', $filterCliente); 
        $pagador_id = new TDBUniqueSearch('pagador_id', 'uppertruck', 'SystemUser', 'id', 'name', 'name', $filterCliente); 

        


        $filter = new TCriteria;
        $filter->add(new TFilter('id', '<', '0'));
        $origem_estado_id     = new TDBCombo('origem_estado_id', 'uppertruck', 'Estado', 'id', '{nome} ({uf})');
        $origem_estado_id->setChangeAction( new TAction( [$this, 'onChangeEstadoOrigem'] ) );
        $origem_cidade_id  = new TDBCombo('origem_cidade_id',  'uppertruck', 'Cidade', 'id', 'nome', 'nome', $filter);
        $origem_cidade_id->enableSearch();
        $origem_estado_id->enableSearch();
        
        $destino_estado_id     = new TDBCombo('destino_estado_id', 'uppertruck', 'Estado', 'id', '{nome} ({uf})');
        $destino_estado_id->setChangeAction( new TAction( [$this, 'onChangeEstadoDestino'] ) );
        $destino_cidade_id = new TDBCombo('destino_cidade_id', 'uppertruck', 'Cidade', 'id', 'nome', 'nome', $filter);
        $destino_cidade_id->enableSearch();
        $destino_estado_id->enableSearch();
       
        // $origem_estado_id     = new TDBCombo('origem_estado_id', 'uppertruck', 'Estado', 'id', '{nome} ({uf})');
       
        // $origem_cidade_id  = new TDBCombo('origem_cidade_id',  'uppertruck', 'Cidade', 'id', 'nome', 'nome', $filter);
        
        // $destino_estado_id     = new TDBCombo('destino_estado_id', 'uppertruck', 'Estado', 'id', '{nome} ({uf})');
        
        // $destino_cidade_id = new TDBCombo('destino_cidade_id', 'uppertruck', 'Cidade', 'id', 'nome', 'nome', $filter);
        
        //$tipo_produto      = new TDBCombo('tipo_produto', 'uppertruck', 'TipoProduto', 'id', 'descricao', 'descricao');
        
        $tipo_produto      = new TDBUniqueSearch('tipo_produto', 'uppertruck', 'TipoProduto', 'id', 'descricao', 'descricao');
        
        $button = new TActionLink('', new TAction(['TipoProdutoForm', 'onClear']), 'green', null, null, 'fa:plus-circle');
        $button->class = 'btn btn-default inline-button';
        $button->title = _t('New');
        $tipo_produto->after($button);
      
      
      
      
        $kg                = new TSpinner('kg');
        $m3                = new TSpinner('m3');
        $volumes           = new TSpinner('volumes');
        
        $embalagem_id     = new TDBCombo('embalagem_id', 'uppertruck', 'Embalagem', 'id', 'nome');
        


        $id->setEditable(FALSE);
        $kg->setRange(1, 9999999999, 1);
        $m3->setRange(0, 9999999, 1);
        $volumes->setRange(1, 9999999, 1);
        
        
        $valor_nf          = new TEntry('valor_nf');
        $status_id         = new TDBCombo('status_id', 'uppertruck', 'StatusCotacao', 'id', 'visao_empresa', 'visao_empresa');
        
        $data_cotacao      = new TDate('data_cotacao');
        $valor_cotacao     = new TEntry('valor_cotacao');
        $prazo             = new TSpinner('prazo');
        $prazo->setRange(0, 1000, 1);
        
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




        $exit_action = new TAction(array($this, 'onExitValor'));
        $valor_cotacao->setExitAction($exit_action);
        
        // add the form fields

        //$add_cliente = TButton::create('add_cliente', [$this, 'onClienteAdd'], 'Cliente', 'fa:plus-circle green');
        
        $action = new TAction( [$this, 'onClienteAdd'] );
        $btnAddCliente = new TActionLink('Incluir', $action, 'white', 10, '', 'fa:plus-circle');
        $btnAddCliente->class='btn btn-success';

       
        //$button = new TActionLink('', new TAction(['SystemUserForm', 'onNewCustumer']), 'green', null, null, 'fa:plus-circle');
        $button = new TActionLink('', new TAction([$this, 'onClienteAdd']), 'green', null, null, 'fa:plus-circle');
        $button->class = 'btn btn-default inline-button';
        $button->title = _t('New');
        
        
        
        
        
        $cliente_id->after($button);
        $pagador_id->after($button);
        
        
        
        
        
        $cliente_id->setSize('100%');
        $pagador_id->setSize('100%');

        $this->form->addFields( [new TLabel('Cliente')], [$cliente_id], [new TLabel('Pagador')], [$pagador_id]);
        //$this->form->addFields([], [$btnAddCliente]);
        //$this->form->addContent( [new TFormSeparator('')]);
        //$this->form->addFields( [$b2], [$cliente_id]);
        //$this->form->addFields( [], [$add_cliente]);

        // $button = new TButton('action1');
        // $button->setAction(new TAction(array($this, 'onClienteAdd')), 'Novo Cliente');
        // $button->setImage('fa:check-circle-o green');
        // $this->form->addFields([$button]);
        //$this->form->addAction('+ Cliente', new TAction(array($this, 'onClienteAdd')));
        //$this->form->addActionLink('+ Cliente', new TAction(array($this, 'onClienteAdd')), 'fa:table blue');
        //$this->form->addAction('Save', new TAction(array($this, 'onSave')), 'fa:save');

      
        //$this->form->addFields( [new TLabel('Cliente')], [$add_cliente, $cliente_id] );
       
       
        //$add_product->getAction()->setParameter('static','1');
        //$this->form->addFields( [], [$add_cliente] );


        $this->form->addFields( [new TLabel('ID')],             [$id], [new TLabel('Solicitação / Alteração')],    [$data_pedido] );
        //$this->form->addFields( [new TLabel('Cliente')],        [$cliente_id] );
        //$this->form->addFields( [new TLabel('Data pedido de cotação')],    [$data_pedido] );
        $this->form->addContent( [new TFormSeparator('')]);
        $this->form->addFields( [ new TLabel('UF Origem') ],  [$origem_estado_id], [ new TLabel('Cidade Origem') ], [ $origem_cidade_id ] );
        $this->form->addFields( [ new TLabel('UF Destino') ], [$destino_estado_id], [ new TLabel('Cidade Destino') ], [ $destino_cidade_id ] );
        $this->form->addContent( [new TFormSeparator('')]); 

        $this->form->addFields( [new TLabel('Tipo de produto')], [$tipo_produto], [ new TLabel('Peso/Kg') ], [$kg] );
        //$add_produto = TButton::create('add_produto', [$this, 'onProdutoAdd'], 'Cadastrar Tipo Produto', 'fa:plus-circle green');
        //$this->form->addFields( [], [$add_produto]);


        $this->form->addFields( [ new TLabel('Cubagem/m3') ], [ $m3 ], [ new TLabel('Embalagens') ], [$embalagem_id] );
        $this->form->addFields( [new TLabel('Qtd. de Volumes')], [$volumes], [new TLabel('Valor Nota Fiscal/R$')], [$valor_nf] );
        $this->form->addFields( [new TLabel('Valor cotado')], [$valor_cotacao], [new TLabel('Prazo (dias)')], [$prazo] );
        $this->form->addFields( [new TLabel('Data cotação')], [$data_cotacao], [new TLabel('Status')], [$status_id] );
        $this->form->addContent( [new TFormSeparator('')]);
        $this->form->addFields( [new TLabel('obs')], [$obs] );
        $this->form->addFields( [new TLabel('obs_empresa')], [$obs_empresa] );


        $cliente_id->addValidation( 'Cliente', new TRequiredValidator);
        $origem_cidade_id->addValidation( 'Cidade Origem', new TRequiredValidator);
        $destino_cidade_id->addValidation( 'Cidade Destino', new TRequiredValidator);
        $tipo_produto->addValidation( 'Tipo Produto', new TRequiredValidator);
        $data_pedido->addValidation( 'Tipo Produto', new TRequiredValidator);
        $status_id->addValidation( 'Status', new TRequiredValidator);


        
        // define the form action
        $this->form->addAction('Salvar', new TAction(array($this, 'onSave')), 'fa:save green');
        $this->form->addActionLink('Limpar',  new TAction(array($this, 'onClear')), 'fa:eraser red');
        $this->form->addActionLink('Listagem',  new TAction(array('CotacaoEmpresaList', 'onReload')), 'fa:table blue');
      
      
      
      
       
      
      
      
      
      
        // wrap the page content using vertical box
        $vbox = new TVBox;
        $vbox->style = 'width: 100%';
        //$vbox->add(new TXMLBreadCrumb('menu.xml', __CLASS__));
        $vbox->add($this->form);
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



     /**
     * Clear form
     */
    public function onClear()
    {
        $this->form->clear( TRUE );



        $fromCotacao = TSession::getValue('form_from_cotacao');
        if ($fromCotacao) {
            $data = TSession::getValue('form_cotacao_empresa_data');
            TForm::sendData('form_cotacao', $data);
            //$this->form->setData($data);
            //$this->form->setData($data);
            new TMessage('info', json_encode($data));
            
        } else {
            //$this->form->clear( true );
        }
        TSession::setValue('form_from_cotacao', false);






        $obj = new StdClass;
        $obj->status_id = 1;
        $obj->status_id = 1;
        TForm::sendData('form_cotacao', $obj);       
    }


    public static function onRestaure() {
        new TMessage('info', 'aquiaaa');
        $fromCotacao = TSession::getValue('form_from_cotacao');
        if ($fromCotacao) {
            $data = TSession::getValue('form_cotacao_empresa_data');
            TForm::sendData('form_cotacao', $data);
            //$this->form->setData($data);
            new TMessage('info', 'aqui');
            
        } else {
            //$this->form->clear( true );
        }
        TSession::setValue('form_from_cotacao', false);
    }



    public static function onExitValor($param)
    {
        

        $valor = $param['valor_cotacao'];
        $obj = new StdClass;
        if($valor>0) 
        {
            $obj->status_id = 2;   
        }else {
            $obj->status_id = 1;   
        }
        TForm::sendData('form_cotacao', $obj);
        //new TMessage('info', json_encode($param));
        
    }


    public static function onClienteAdd($param) {
        //$data = $this->form->getData();
        //$data = TForm::getFormByName('form_cotacao');
        //print_r($data);
        // put the data back to the form
        //$this->form->setData($data);
        //TForm::sendData('form_cotacao', $data);
        // TSession::setValue('form_cotacao_empresa_data', $data);
        // TSession::setValue('form_from_cotacao', true);
        TSession::setValue('not_editable_grupo', true);

        //new TMessage('info', $data);
        AdiantiCoreApplication::loadPage('SystemUserForm', 'onNewCustumer');
    }


    function onProdutoAdd() {
        
    }



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

                $fromCotacao = TSession::getValue('form_from_cotacao');
                if ($fromCotacao) {
                    $data = TSession::getValue('form_cotacao_empresa_data');
                    $this->form->setData($data);
                } else {
                    $this->form->clear( true );
                }
                TSession::setValue('form_from_cotacao', false);



            }
        }
        catch (Exception $e) // in case of exception
        {
            new TMessage('error', $e->getMessage()); // shows the exception error message
            TTransaction::rollback(); // undo all pending operations
        }
    }




   




    
   
    






}