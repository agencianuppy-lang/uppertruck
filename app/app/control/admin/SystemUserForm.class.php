<?php
/**
 * SystemUserForm
 *
 * @version    1.0
 * @package    control
 * @subpackage admin
 * @author     Pablo Dall'Oglio
 * @copyright  Copyright (c) 2006 Adianti Solutions Ltd. (http://www.adianti.com.br)
 * @license    http://www.adianti.com.br/framework-license
 */
class SystemUserForm extends TWindow
{
    protected $form; // form
    protected $program_list;
    
    /**
     * Class constructor
     * Creates the page and the registration form
     */
    function __construct()
    {
        parent::__construct();
        parent::setSize(0.95, null); 
        parent::setTitle('Usuário'); 
        
        //  $fromCotacao = TSession::getValue('form_from_cotacao');
        //  if ($fromCotacao) {
        //      $action = new TAction(array($this, 'onRestaureCotacao'));
        //      parent::setCloseAction($action);
        //  } 
        
      

        // creates the form
        $this->form = new BootstrapFormBuilder('form_System_user');
        
        // create the form fields
        $id            = new TEntry('id');
        $login         = new TEntry('login');
        $password      = new TPassword('password');
        $repassword    = new TPassword('repassword');
        $name          = new TEntry('name');
        $nick_name     = new TEntry('nick_name');
        $type          = new TCombo('type');
        $cpf_cnpj      = new TEntry('cpf_cnpj');
        $cod_state     = new TEntry('cod_state');
        $cod_city      = new TEntry('cod_city');
        $phone         = new TEntry('phone');
        $email         = new TEntry('email');
        $cep           = new TEntry('cep');
        $address       = new TEntry('address');
        $number        = new TEntry('number');
        $complement    = new TEntry('complement');
        $district      = new TEntry('district');
        $estado_id     = new TDBCombo('estado_id', 'uppertruck', 'Estado', 'id', '{nome} ({uf})');
        $estado_id->setChangeAction( new TAction( [$this, 'onChangeEstado'] ) );
        
        $filter = new TCriteria;
        $filter->add(new TFilter('id', '<', '0'));
        $cidade_id = new TDBCombo('cidade_id', 'uppertruck', 'Cidade', 'id', 'nome', 'nome', $filter);
        
        $contact       = new TEntry('contact');
        $obs           = new TText('obs');
        
        $criteria = new TCriteria;
        $criteria->add( new TFilter( 'grupo', '=', '2'  ) ); // filtrar apenas usuários do grupo 2 - colaborador
        $user_responsible_id = new TDBCombo('user_responsible_id','permission','SystemUser','id','name', 'name', $criteria);
       
        $criteria2 = new TCriteria;
        $criteria2->add( new TFilter( 'id', '!=', '1'  ) ); // tirar usuário admin
        $grupo        = new TDBCombo('grupo','permission','SystemGroup','id','name', 'name', $criteria2);
        $grupo->setChangeAction( new TAction( [$this, 'onChangeGrupo'] ) );
        
        $frontpage_id  = new TDBUniqueSearch('frontpage_id', 'permission', 'SystemProgram', 'id', 'name', 'name');
        
        $cep->setExitAction( new TAction([ $this, 'onExitCEP']) );
        $cpf_cnpj->setExitAction( new TAction( [$this, 'onExitCNPJ'] ) );
        
        $type->addItems( ['F' => 'Física', 'J' => 'Jurídica' ] );
        
        $btn = $this->form->addAction( _t('Save'), new TAction(array($this, 'onSave')), 'far:save');
        $btn->class = 'btn btn-sm btn-primary';
        $this->form->addActionLink( _t('Clear'), new TAction(array($this, 'onEdit')), 'fa:eraser red');
        
        $btn2 = $this->form->addAction( 'Veículos', new TAction(array('VeiculoFormList', 'onStart')), 'fa:truck');
        $btn2->class = 'btn btn-sm btn-success iquedev-display-none';
        
        
        // define the sizes
        $id->setSize('100%');
        $name->setSize('100%');
        $nick_name->setSize('100%');
        $type->setSize('100%');
        $cpf_cnpj->setSize('100%');
        $cod_state->setSize('100%');    
        $cod_city->setSize('100%');
        $phone->setSize('100%');
        $email->setSize('100%');
        $cep->setSize('100%');
        $address->setSize('100%');
        $number->setSize('100%');
        $complement->setSize('100%');
        $district->setSize('100%');
        $cidade_id->setSize('100%');
        $estado_id->setSize('100%');
        $contact->setSize('100%');
        $obs->setSize('100%', 60);
        $user_responsible_id->setSize('100%');
        $login->setSize('100%');
        $password->setSize('100%');
        $repassword->setSize('100%');
        $frontpage_id->setSize('100%');
        $frontpage_id->setMinLength(1);
        
        // outros
        $id->setEditable(false);

        $notEditableGrupo = TSession::getValue('not_editable_grupo');
        if ($notEditableGrupo) {
            $grupo->setEditable(false);
            TSession::setValue('not_editable_grupo', false);
        }

        //not_editable_grupo_motorista

        // validations
        $name->addValidation(_t('Name'), new TRequiredValidator);
        $login->addValidation('Login', new TRequiredValidator);
        $email->addValidation('Email', new TEmailValidator);
        
        // add the fields
        $this->form->addFields( [ new TLabel('Id') ], [ $id ], [new TLabel('Grupo') ], [$grupo] );
        $this->form->addFields( [ new TLabel('Tipo') ], [ $type ], [ new TLabel('CPF/CNPJ') ], [ $cpf_cnpj ] );
        $this->form->addFields( [ new TLabel('Nome') ], [ $name ] );
        $this->form->addFields( [ new TLabel('Nome Fantasia') ], [ $nick_name ] );
        $this->form->addFields( [ new TLabel('Contato') ], [ $contact] ); 
        $this->form->addFields( [new TLabel(_t('Login'))] , [$login]);
        $this->form->addFields( [new TLabel(_t('Password'))], [$password],  [new TLabel(_t('Password confirmation'))], [$repassword] );
        $this->form->addFields( [ new TLabel('I.E.') ], [ $cod_state ], [ new TLabel('I.M.') ], [ $cod_city ] );
        $this->form->addFields( [ new TLabel('Fone') ], [ $phone ], [ new TLabel('Email') ], [ $email ] );
        $this->form->addFields( [ new TLabel('Observacao') ], [ $obs ] );
        $this->form->addContent( [new TFormSeparator('Endereço')]);
        $this->form->addFields( [ new TLabel('Cep') ], [ $cep ] )->layout = ['col-sm-2 control-label', 'col-sm-4'];
        $this->form->addFields( [ new TLabel('Logradouro') ], [ $address ], [ new TLabel('Numero') ], [ $number ] );
        $this->form->addFields( [ new TLabel('Complemento') ], [ $complement ], [ new TLabel('Bairro') ], [ $district ] );
        $this->form->addFields( [ new TLabel('Estado') ], [$estado_id], [ new TLabel('Cidade') ], [ $cidade_id ] );
        $this->form->addContent( [new TFormSeparator('')]);
        $this->form->addFields( [ new TLabel('Colaborador/a Responsável') ], [ $user_responsible_id ]);
        
        $container = new TVBox;
        $container->style = 'width: 100%';
        $container->add($this->form);
        // add the container to the page
        parent::add($container);
    }

    /**
     * Save user data
     */
    public function onSave($param)
    {
        try
        {
            // open a transaction with database 'permission'
            TTransaction::open('permission');
            
           

            $data = $this->form->getData();
            $this->form->setData($data);
            
            $object = new SystemUser;
            $object->fromArray( (array) $data );
            
            $senha = $object->password;
            
            if( empty($object->login) )
            {
                $object->login = md5(uniqid(rand(), true));
                $object->active = 'N';
                //throw new Exception(TAdiantiCoreTranslator::translate('The field ^1 is required', _t('Login')));
            }
            
            if( empty($object->id) )
            {
                $object->active = 'Y';
                if (SystemUser::newFromLogin($object->login) instanceof SystemUser)
                {
                    throw new Exception(_t('An user with this login is already registered'));
                }
                
                if (SystemUser::newFromEmail($object->email) instanceof SystemUser)
                {
                    throw new Exception(_t('An user with this e-mail is already registered'));
                }
                
                if ( empty($object->password) )
                {
                    //throw new Exception(TAdiantiCoreTranslator::translate('The field ^1 is required', _t('Password')));
                    $object->password = md5(uniqid(rand(), true));
                    $param['repassword'] = $object->password;
                    $object->active = 'N';
                }
                
                
            }
            
            if( $object->password )
            {
                if( $object->password !== $param['repassword'] )
                    throw new Exception(_t('The passwords do not match'));
                
                //$object->password = md5($object->password);
                $object->password = password_hash($object->password, PASSWORD_DEFAULT);
            }
            else
            {
                unset($object->password);
            }
            
            
            //verificar qual o grupo do usário para salvar a página inicial
            $grupo = $object->grupo;
            switch ($grupo)
            {
                case 2:  // colaborador
                    $object->frontpage_id = 61; //PendenciesEmpresaList 
                    break;
                
                case 3:  //cliente
                    $object->frontpage_id = 62; //PendenciesClienteList
                    break;
                
                case 4:  // motorista
                    $object->frontpage_id = 63; //PendenciesMotoristaList
                    break;
                    
                case 5: //administrador
                    $object->frontpage_id = 61; //PendenciesEmpresaList
                    break;
                default:
                    $object->frontpage_id = null;
                    break;
            }
            
            
            
            $object->store(); 
            $object->clearParts();
          
             if( !empty($data->grupo) )
             {
                $object->addSystemUserGroup( new SystemGroup($data->grupo) );
             }

            
             //Unit A e Unit B
             $object->addSystemUserUnit( new SystemUnit(1) );
             $object->addSystemUserUnit( new SystemUnit(2) );
            
            if (!empty($data->program_list))
            {
                foreach ($data->program_list as $program_id)
                {
                    $object->addSystemUserProgram( new SystemProgram( $program_id ) );
                }
            }
            
            $data = new stdClass;
            $data->id = $object->id;
            
            //se o usuário for do grupo motorista - id = 4 mostrar botão para cadastro de veículos
            if ($object->grupo == 4)
            {
                 TScript::create("showBtnVeiculos()");
            }
            
            TForm::sendData('form_System_user', $data);
            
            // close the transaction
            TTransaction::close();
            
            // shows the success message

            // $fromCotacao = TSession::getValue('form_from_cotacao');
            // if ($fromCotacao) {
            //     $posAction = new TAction(array('CotacaoEmpresaCadastramentoForm', 'onEdit'));
            // } else {
            //     $posAction = new TAction(array('CustomerDataGridView', 'onReload'));
            // }
            //TSession::setValue('form_from_cotacao', false);
            //new TMessage('info', 'Registro salvo', $posAction);
            new TMessage('info', 'Registro salvo');
           //new TMessage('info', 'Registro Salvo - Id: ' . $object->id, $posAction);
        }
        catch (Exception $e) // in case of exception
        {
            new TMessage('error', $e->getMessage());
            TTransaction::rollback();
        }
    }
    
    /**
     * method onEdit()
     * Executed whenever the user clicks at the edit button da datagrid
     */
    function onEdit($param)
    {
        try
        {
        
        
        
            if (isset($param['key']) || isset($param['orcamento_id']) )
            {
                // get the parameter $key
                $key=$param['key'];
                
                // open a transaction with database 'permission'
                TTransaction::open('permission');
                
                if ( isset($param['orcamento_id']) )
                {
                   $orcamento = new OrcamentoMotorista($param['orcamento_id']);
                   $object = new SystemUser($orcamento->motorista_id);
                }
                else
                {
                   // instantiates object System_user
                   $object = new SystemUser($key);
                }
                
                unset($object->password);
                
               // $grupo = array();
                $units  = array();
                
                if( $units_db = $object->getSystemUserUnits() )
                {
                    foreach( $units_db as $unit )
                    {
                        $units[] = $unit->id;
                    }
                }
                
                $program_ids = array();
                foreach ($object->getSystemUserPrograms() as $program)
                {
                    $program_ids[] = $program->id;
                }
                
                $object->program_list = $program_ids;
                //$object->grupo = $grupo;
                $object->units  = $units;
                
                //se o usuário for do grupo motorista - id = 4 mostrar botão para cadastro de veículos
                if ($object->grupo == 4)
                {
                     TSession::setValue('motorista_id', $object->id);
                     TScript::create("showBtnVeiculos()");
                     
                }
                // fill the form with the active record data
                $this->form->setData($object);
                
                // close the transaction
                TTransaction::close();
            }
            else
            {
                $this->form->clear();
            }
        }
        catch (Exception $e) // in case of exception
        {
            new TMessage('error', $e->getMessage());
            TTransaction::rollback();
        }
    }
    
    
    
    /**
     * Autocompleta outros campos a partir do CEP
     */
    public static function onExitCEP($param)
    {
        session_write_close();
        
        //new TMessage('info', 'teste');
        
        try
        {
            $cep = preg_replace('/[^0-9]/', '', $param['cep']);
            //$url = 'https://viacep.com.br/ws/'.$cep.'/json/unicode/';
            
            $url = 'https://viacep.com.br/ws/'.$cep.'/json/';
            $content = @file_get_contents($url);
            
            if ($content !== false)
            {
            
                
                $cep_data = json_decode($content);
               
                
                $data = new stdClass;
                if (is_object($cep_data) && empty($cep_data->erro))
                {
                
                   //new TMessage('info', 'teste');
                   TTransaction::open('uppertruck');
                   $estado = Estado::where('uf', '=', $cep_data->uf)->first();
                   $cidade = Cidade::where('codigo_ibge', '=', $cep_data->ibge)->first();
                   TTransaction::close();
                    
                    $data->address    = $cep_data->logradouro;
                    //$data->complement = $cep_data->complemento;
                    $data->complement = '';
                    $data->district   = $cep_data->bairro;
                    //$data->uf         = $cep_data->uf;
                    //$data->city       = $cep_data->localidade;
                    $data->estado_id   = $estado->id ?? '';
                    $data->cidade_id   = $cidade->id ?? '';
                    
                    TForm::sendData('form_System_user', $data, false, true);
                }
                else
                {
                    $data->address    = '';
                    $data->complement = '';
                    $data->district   = '';
                    $data->uf         = '';
                    $data->city       = '';
                    
                    TForm::sendData('form_System_user', $data, false, true);
                }
            }
        }
        catch (Exception $e)
        {
            new TMessage('error', $e->getMessage());
        }
    }
    
    
    
    /**
     * Autocompleta outros campos a partir do CNPJ
     */
    public static function onExitCNPJ($param)
    {
        session_write_close();
        
        //new TMessage('info', 'teste cnpj');
        
        try
        {
            $cnpj = preg_replace('/[^0-9]/', '', $param['cpf_cnpj']);
            $url  = 'http://receitaws.com.br/v1/cnpj/'.$cnpj;
            
            $content = @file_get_contents($url);
            
            if ($content !== false)
            {
            
                //new TMessage('info', 'teste cnpj');
                $cnpj_data = json_decode($content);
                
                
                $data = new stdClass;
                if (is_object($cnpj_data) && $cnpj_data->status !== 'ERROR')
                {
                    $data->type = 'J';
                    $data->name = $cnpj_data->nome;
                    $data->nick_name = !empty($cnpj_data->fantasia) ? $cnpj_data->fantasia : $cnpj_data->nome;
                    
                    if (empty($param['cep']))
                    {
                        $data->cep = $cnpj_data->cep;
                        $data->number = $cnpj_data->numero;
                    }
                    
                    if (empty($param['fone']))
                    {
                        $data->phone = $cnpj_data->telefone;
                    }
                    
                    if (empty($param['email']))
                    {
                        $data->email = $cnpj_data->email;
                    }
                    
                    TForm::sendData('form_System_user', $data, false, true);
                }
                else
                {
                    $data->name = '';
                    $data->nick_name = '';
                    $data->cep = '';
                    $data->number = '';
                    $data->phone = '';
                    $data->email = '';
                    TForm::sendData('form_System_user', $data, false, true);
                }
            }
        }
        catch (Exception $e)
        {
            new TMessage('error', $e->getMessage());
        }
    }
    
    
    /**
     * Action to be executed when the user changes the state
     * @param $param Action parameters
     */
    public static function onChangeEstado($param)
    {
        try
        {
            TTransaction::open('uppertruck');
            if (!empty($param['estado_id']))
            {
                $criteria = TCriteria::create( ['estado_id' => $param['estado_id'] ] );
                
                // formname, field, database, model, key, value, ordercolumn = NULL, criteria = NULL, startEmpty = FALSE
                TDBCombo::reloadFromModel('form_System_user', 'cidade_id', 'uppertruck', 'Cidade', 'id', '{nome} ({id})', 'nome', $criteria, TRUE);
            }
            else
            {
                TCombo::clearField('form_System_user', 'cidade_id');
            }
            
            TTransaction::close();
        }
        catch (Exception $e)
        {
            new TMessage('error', $e->getMessage());
        }
    }
    
    
    
    public static function onChangeGrupo($param)
    {
        $showBtnVeiculo = !empty($param['id']) && $param['grupo'] == 4;   
        if ($showBtnVeiculo)
        {
            TScript::create("showBtnVeiculos()");
        }
        else
        {
            TScript::create("hideBtnVeiculos()");
        }
    }
    
    
    public function onVeiculos($param)
    {
    
    }



    function onNewCustumer($param)
    {
        $object = new SystemUser;
        $object->grupo = 3; // cliente
        $this->form->setData($object);   // fill the form with the active record data
    }
    function onNewMotorista($param)
    {
        $object = new SystemUser;
        $object->grupo = 4; // motorista
        $this->form->setData($object);   // fill the form with the active record data
    }
    
    // public static function onRestaureCotacao($param) {
    //     AdiantiCoreApplication::loadPage('CotacaoEmpresaCadastramentoForm','onClear');
    // }
    
}
