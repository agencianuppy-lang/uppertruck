<?php

class AvaliacaoClienteForm extends TWindow
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
        parent::setTitle('Avaliação do cliente');
        
        parent::setSize(0.6, null);
        
        $this->setDatabase('uppertruck');    // defines the database
        $this->setActiveRecord('Programacao');   // defines the active record
        
        // creates the form
        $this->form = new BootstrapFormBuilder('form_avaliacao');
        $this->form->setFormTitle('Registre sua avaliação sobre o serviço');
        $this->form->setClientValidation(true);
        
        // create the form fields
        $id            = new TEntry('id');
        $avaliacao     = new TRadioGroup('avaliacao');
        $avaliacao->setLayout('horizontal');
        $items = ['1'=>'Péssimo', '2'=>'Ruim', '3'=>'Regular', '4'=>'Bom', '5'=>'Ótimo'];
        $avaliacao->addItems($items);
        
        $obs_avaliacao = new TText('obs_avaliacao');
        $id->setEditable(FALSE);
        
        // add the form fields
        $this->form->addFields( [new TLabel('ID')], [$id] );
        $this->form->addFields( [], [$avaliacao] );
        $this->form->addFields( [new TLabel('Obs.')], [$obs_avaliacao] );
        
        $avaliacao->addValidation( 'Avaliação', new TRequiredValidator);
        $id->addValidation( 'ID', new TRequiredValidator);
     
        
        // define the form action
        $this->form->addAction('Enviar avaliação', new TAction(array($this, 'onSave')), 'fa:paper-plane green');
        //$this->form->addActionLink('Clear',  new TAction(array($this, 'onClear')), 'fa:eraser red');
        //$this->form->addActionLink('Listing',  new TAction(array('StandardDataGridView', 'onReload')), 'fa:table blue');
        // wrap the page content using vertical box
        $vbox = new TVBox;
        $vbox->style = 'width: 100%';
        //$vbox->add(new TXMLBreadCrumb('menu.xml', __CLASS__));
        $vbox->add($this->form);
        parent::add($vbox);
        
    }
    
    
    
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
            $object->data_avaliacao = date('Y-m-d');
            $object->avaliacao_pendente = 0;
            $object->tipo_avaliacao = 1; // cliente
            $object->store(); // save the object
            
            
            $programacao = new Programacao($object->id);
            //$cotação = new Cotacao( new Programacao( $object->) );
            //new TMessage('info', json_encode(var_dump($programacao->cotacao->id)));
            $repos = new TRepository('OrcamentoMotorista');
            $criteria = new TCriteria;
            $criteria->add(new TFilter('cotacao_id', '=', $programacao->cotacao->id)); 
            $values = array('finalizado' => 1);
            $repos->update($values, $criteria);
            
            
            
            
            
            
            
            
            // fill the form with the active record data
            $this->form->setData($object);
            
            
            
            
            
            
            
            
            
            
            
            TTransaction::close();  // close the transaction
            
            // shows the success message
            $act = new TAction(['ProgramacaoClienteList','onReload']);
            new TMessage('info', 'Avaliação enviada com sucesso', $act);
        }
        catch (Exception $e) // in case of exception
        {
            new TMessage('error', $e->getMessage()); // shows the exception error message
            $this->form->setData( $this->form->getData() ); // keep form data
            TTransaction::rollback(); // undo all pending operations
        }
    }
    
    
    
    
}
