<?php
class TipoProdutoForm extends TWindow
{

    protected $form; // form
    
    // trait with onSave, onClear, onEdit
    use Adianti\Base\AdiantiStandardFormTrait;
    
    function __construct()
    {
        parent::__construct();
        
        $this->setDatabase('uppertruck');    // defines the database
        $this->setActiveRecord('TipoProduto');   // defines the active record
        
        // creates the form
        $this->form = new BootstrapFormBuilder('form_tipo_produto');
        $this->form->setFormTitle('Tipo Produto - cadastro');
        $this->form->setClientValidation(true);
        
        // create the form fields
        $id       = new TEntry('id');
        $desc     = new TEntry('descricao');
        $id->setEditable(FALSE);
        
        // add the form fields
        $this->form->addFields( [new TLabel('ID')], [$id] );
        $this->form->addFields( [new TLabel('Descrição', 'red')], [$desc] );
        
        $desc->addValidation( 'Descrição', new TRequiredValidator);
        
        // define the form action
        $this->form->addAction('Salvar', new TAction(array($this, 'onSave')), 'fa:save green');
        $this->form->addActionLink('Limpar',  new TAction(array($this, 'onClear')), 'fa:eraser red');
        $this->form->addActionLink('Listagem',  new TAction(array('TipoProdutoList', 'onReload')), 'fa:table blue');
        // wrap the page content using vertical box
        $vbox = new TVBox;
        $vbox->style = 'width: 100%';
        $vbox->add(new TXMLBreadCrumb('menu.xml', 'TipoProdutoList'));
        $vbox->add($this->form);
        parent::add($vbox);
    }
}
