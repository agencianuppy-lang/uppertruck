<?php
class VeiculoForm extends TWindow
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
        
        //parent::setTargetContainer('adianti_right_panel');
        
        $this->setDatabase('uppertruck');    // defines the database
        $this->setActiveRecord('Veiculo');   // defines the active record
        
        // creates the form
        $this->form = new BootstrapFormBuilder('form_veiculo');
        $this->form->setFormTitle('Cadastro Veículo');
        $this->form->setClientValidation(true);
        
        // create the form fields
        $id            = new TEntry('id');
        $criteria2 = new TCriteria;
        $criteria2->add( new TFilter( 'grupo', '=', '4'  ) );  // grupo = 4 motorista
        $motorista_id  = new TDBCombo('motorista_id', 'uppertruck', 'SystemUser', 'id', 'name', 'name', $criteria2);
        $tipo_id       = new TDBCombo('tipo_id', 'uppertruck', 'TipoVeiculo', 'id', 'tipo');
        $placa         = new TEntry('placa');
        $ano_fab       = new TEntry('ano_fab');
        $ano_mod       = new TEntry('ano_mod');
        $id->setEditable(FALSE);
        
        $placa->setMask('SSS-9A99');
        $placa->forceUpperCase();
        
        // add the form fields
        $this->form->addFields( [new TLabel('ID')],    [$id] );
        $this->form->addFields( [new TLabel('Motorista')],  [$motorista_id] );
        $this->form->addFields( [new TLabel('Tipo')],  [$tipo_id] );
        $this->form->addFields( [new TLabel('Placa')],  [$placa] );
        $this->form->addFields( [new TLabel('Ano Fabricação')],  [$ano_fab] );
        $this->form->addFields( [new TLabel('Ano Modelo')],  [$ano_mod] );
        
       // $name->addValidation( 'Name', new TRequiredValidator);
       //$state_id->addValidation( 'State', new TRequiredValidator);
        
        // define the form action
        $this->form->addAction('Save', new TAction(array($this, 'onSave')), 'fa:save green');
        $this->form->addActionLink('Limpar',  new TAction(array($this, 'onClear')), 'fa:eraser red');
        $this->form->addActionLink('Voltar',  new TAction(array('VeiculoList', 'onReload')), 'fa:table blue');
        // wrap the page content using vertical box
        $vbox = new TVBox;
        $vbox->style = 'width: 100%';
        //$vbox->add(new TXMLBreadCrumb('menu.xml', __CLASS__));
        $vbox->add($this->form);
        parent::add($vbox);
    }
}
