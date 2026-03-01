<?php
/**
 * StandardDataGridView Listing
 *
 * @version    1.0
 * @package    samples
 * @subpackage tutor
 * @author     Pablo Dall'Oglio
 * @copyright  Copyright (c) 2006 Adianti Solutions Ltd. (http://www.adianti.com.br)
 * @license    http://www.adianti.com.br/framework-license
 */
class VeiculoList extends TStandardList
{
    protected $form;     // registration form
    protected $datagrid; // listing
    protected $pageNavigation;
    
    // trait with onReload, onSearch, onDelete...
    use Adianti\Base\AdiantiStandardListTrait;
    
    /**
     * Class constructor
     * Creates the page, the form and the listing
     */
    public function __construct()
    {
        parent::__construct();
        
        $this->setDatabase('uppertruck');      // defines the database
        $this->setActiveRecord('Veiculo');       // defines the active record
        $this->addFilterField('motorista_id', 'like', 'motorista_id'); // filter field, operator, form field
        $this->addFilterField('tipo_id', 'like', 'tipo_id'); // filter field, operator, form field
        $this->addFilterField('placa', 'like', 'placa');
        $this->setDefaultOrder('id', 'asc');  // define the default order
        
        // creates the form
        $this->form = new BootstrapFormBuilder('form_veiculos_list');
        $this->form->setFormTitle('Cadastro de Veículos - Listagem');
        
        $criteria = new TCriteria;
        $criteria->add( new TFilter( 'grupo', '=', '4'  ) );  // grupo = 4 motorista
        $motorista_id  = new TDBCombo('motorista_id', 'uppertruck', 'SystemUser', 'id', 'name', 'name', $criteria);
        $tipo_id       = new TDBCombo('tipo_id', 'uppertruck', 'TipoVeiculo', 'id', 'tipo');
        $placa         = new TEntry('placa');
        
        
        $placa->setMask('SSS-9A99');
        $placa->forceUpperCase();
        
        $this->form->addFields( [new TLabel('Motorista')], [$motorista_id] );
        $this->form->addFields( [new TLabel('Tipo')], [$tipo_id] );
        $this->form->addFields( [new TLabel('Placa')], [$placa] );
        
        // add form actions
        $this->form->addAction('Buscar', new TAction([$this, 'onSearch']), 'fa:search blue');
        $this->form->addActionLink('Novo',  new TAction(['VeiculoForm', 'onClear']), 'fa:plus-circle green');
        $this->form->addActionLink('Limpar',  new TAction([$this, 'clear']), 'fa:eraser red');
        
        // keep the form filled with the search data
        $this->form->setData( TSession::getValue('VeiculoList_filter_data') );
        
        $this->form->addExpandButton( "", "fa:grip-lines", false);


        // creates the DataGrid
        $this->datagrid = new BootstrapDatagridWrapper(new TDataGrid);
        $this->datagrid->width = "100%";
        
        // creates the datagrid columns
        $col_id        = new TDataGridColumn('id', 'Id', 'right');
        $col_tipo_id   = new TDataGridColumn('tipo_id', 'Tipo', 'left');
        $col_placa     = new TDataGridColumn('placa', 'Placa', 'left');
        $col_ano_fab   = new TDataGridColumn('ano_fab', 'Fab', 'left');
        $col_ano_mod   = new TDataGridColumn('ano_mod', 'Mod', 'left');
        $col_motorista = new TDataGridColumn('motorista_id', 'Motorista', 'left');
        
        $this->datagrid->addColumn($col_id);
        $this->datagrid->addColumn($col_tipo_id);
        $this->datagrid->addColumn($col_placa);
        $this->datagrid->addColumn($col_ano_fab);
        $this->datagrid->addColumn($col_ano_mod);
        $this->datagrid->addColumn($col_motorista);
        
        
        $col_tipo_id->setTransformer( function($value, $object, $row) {
            TTransaction::open('uppertruck');
            $tipo = new TipoVeiculo($value); 
            TTransaction::close();
            return $tipo->tipo;
        }); 
        
        $col_motorista->setTransformer( function($value, $object, $row) {
            TTransaction::open('uppertruck');
            $motorista = new SystemUser($value); 
            TTransaction::close();
            return $motorista->name;
        }); 
        
        
        
        
        //Criar ações de coluna - ordenações
        
        $action1 = new TDataGridAction(['VeiculoForm', 'onEdit'],   ['key' => '{id}'] );
        $action2 = new TDataGridAction([$this, 'onDelete'],   ['key' => '{id}'] );
        
        $this->datagrid->addAction($action1, 'Editar',   'far:edit blue');
        $this->datagrid->addAction($action2, 'Deletar', 'far:trash-alt red');
        
        // create the datagrid model
        $this->datagrid->createModel();
        
        // creates the page navigation
        $this->pageNavigation = new TPageNavigation;
        $this->pageNavigation->setAction(new TAction(array($this, 'onReload')));
        
        // creates the page structure using a table
        $vbox = new TVBox;
        $vbox->style = 'width: 100%';
        $vbox->add(new TXMLBreadCrumb('menu.xml', __CLASS__));
        $vbox->add($this->form);
        $vbox->add(TPanelGroup::pack('', $this->datagrid, $this->pageNavigation));
        
        // add the table inside the page
        parent::add($vbox);
    }
    
    /**
     * Clear filters
     */
    function clear()
    {
        $this->clearFilters();
        $this->onReload();
    }
}
