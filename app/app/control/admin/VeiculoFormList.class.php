<?php
class VeiculoFormList extends TStandardList
{
    protected $form;      // form
    protected $datagrid;  // datagrid
    protected $loaded;
    protected $pageNavigation;  // pagination component
    
    // trait with onSave, onEdit, onDelete, onReload, onSearch...
    use Adianti\Base\AdiantiStandardFormListTrait;
    
    /**
     * Class constructor
     * Creates the page, the form and the listing
     */
    public function __construct()
    {
        parent::__construct();
        
        parent::setTargetContainer('adianti_right_panel');
        
        $motorista_id_filter = TSession::getValue('motorista_id');
        
        $criteria = new TCriteria;
        $criteria->add( new TFilter( 'motorista_id', '=', $motorista_id_filter ) );
        parent::setCriteria($criteria);

//         new TMessage('info', json_encode($param));
        
        $this->setDatabase('uppertruck'); // define the database
        $this->setActiveRecord('Veiculo'); // define the Active Record
        $this->addFilterField('motorista_id', 'like', 'motorista_id');
        $this->setDefaultOrder('id', 'asc'); // define the default order
        $this->setLimit(-1); // turn off limit for datagrid
        
        // create the form
        $this->form = new BootstrapFormBuilder('form_veiculo_form_list');
        $this->form->setFormTitle('Cadastro de Veículos');
        
        // create the form fields
        $id            = new TEntry('id');
       
        $criteria2 = new TCriteria;
        $criteria2->add( new TFilter( 'grupo', '=', '4'  ) );  // grupo = 4 motorista
        $motorista_id  = new TDBCombo('motorista_id', 'uppertruck', 'SystemUser', 'id', 'name', 'name', $criteria2);
        $tipo_id       = new TDBCombo('tipo_id', 'uppertruck', 'TipoVeiculo', 'id', 'tipo');
        $placa         = new TEntry('placa');
        $ano_fab       = new TEntry('ano_fab');
        $ano_mod       = new TEntry('ano_mod');
        
        $placa->setMask('SSS-9A99');
        //$placa->forceUpperCase;
        
        // add the form fields
        $this->form->addFields( [new TLabel('ID')],    [$id] );
        $this->form->addFields( [new TLabel('Motorista')],  [$motorista_id] );
        $this->form->addFields( [new TLabel('Tipo')],  [$tipo_id] );
        $this->form->addFields( [new TLabel('Placa')],  [$placa] );
        $this->form->addFields( [new TLabel('Ano Fabricação')],  [$ano_fab] );
        $this->form->addFields( [new TLabel('Ano Modelo')],  [$ano_mod] );
        
//         $name->addValidation('Name', new TRequiredValidator);
        
        // define the form actions
        $this->form->addAction( 'Salvar', new TAction([$this, 'onSave']), 'fa:save green');
        $this->form->addActionLink( 'Limpar',new TAction([$this, 'onClear']), 'fa:eraser red');
        $this->form->addHeaderAction( 'Fechar',new TAction([$this, 'onClose']), 'fa:times red');
        
        // make id not editable
        $id->setEditable(FALSE);
        $motorista_id->setEditable(FALSE);
        
        // create the datagrid
        $this->datagrid = new BootstrapDatagridWrapper(new TDataGrid);
        $this->datagrid->width = '100%';
        
        // add the columns
        $col_id       = new TDataGridColumn('id', 'Id', 'right');
        $col_tipo_id  = new TDataGridColumn('tipo_id', 'Tipo', 'left');
        $col_placa    = new TDataGridColumn('placa', 'Placa', 'left');
        $col_ano_fab  = new TDataGridColumn('ano_fab', 'Fab', 'left');
        $col_ano_mod  = new TDataGridColumn('ano_mod', 'Mod', 'left');
        
        $this->datagrid->addColumn($col_id);
        $this->datagrid->addColumn($col_tipo_id);
        $this->datagrid->addColumn($col_placa);
        $this->datagrid->addColumn($col_ano_fab);
        $this->datagrid->addColumn($col_ano_mod);
        
        $col_id->setAction( new TAction([$this, 'onReload']),   ['order' => 'id']);
//         $col_name->setAction( new TAction([$this, 'onReload']), ['order' => 'name']);
        
        // define row actions
        $action1 = new TDataGridAction([$this, 'onEdit'],   ['key' => '{id}'] );
        $action2 = new TDataGridAction([$this, 'onDelete'], ['key' => '{id}'] );
        
        $this->datagrid->addAction($action1, 'Editar',   'far:edit blue');
        $this->datagrid->addAction($action2, 'Excluir', 'far:trash-alt red');
        
        // create the datagrid model
        $this->datagrid->createModel();
        
        // wrap objects inside a table
        $vbox = new TVBox;
        $vbox->style = 'width: 100%';
        //$vbox->add(new TXMLBreadCrumb('menu.xml', __CLASS__));
        $vbox->add($this->form);
        $vbox->add(TPanelGroup::pack('', $this->datagrid));
        
        // pack the table inside the page
        parent::add($vbox);
    }
    
    
    public static function onClose($param)
    {
        TScript::create("Template.closeRightPanel()");
    }
    
    public function onStart($param)
    {
        //new TMessage('info', print_r( json_encode($param) ));
        // monta objeto para enviar dados ao formulário
        $obj = new StdClass;
        $obj->motorista_id = $param['id']; // obtém a chave do nodo (índice)
        // preenche o formulário com os atributos do objeto
        TForm::sendData('form_veiculo_form_list', $obj);
        
//         $criteria = new TCriteria;
//         $criteria->add( new TFilter( 'motorista_id', '=', '1111'  ) );
//         parent::setCriteria($criteria);
        
        
        
    }
    
    /**
     * Clear form
     */
    public static function onClear()
    {
//         $data = $this->form->getData();
//         $this->form->clear( true );
        
        $obj = new StdClass;
        $obj->id = NULL;
        $obj->tipo_id = NULL;
        $obj->placa = NULL;
        $obj->ano_fab = NULL;
        $obj->ano_mod = NULL;
        
        // preenche o formulário com os atributos do objeto
        TForm::sendData('form_veiculo_form_list', $obj);
        
        
    }
    
    
    
}

