<?php

class ProgramacaoEmpresaForm extends TPage
{
    private $form; // form
    
    /**
     * Class constructor
     * Creates the page and the registration form
     */
    function __construct()
    {
        parent::__construct();
        
        // creates the form
        $this->form = new BootstrapFormBuilder('form_programacao');
        //$this->form->setClientValidation(true);
        $this->form->setFormTitle('Programação de embarque');
        
        // create the form fields
        $cliente_filter = new TCriteria;
        $cliente_filter->add(new TFilter('grupo', '=', 3)); // grupo cliente
        $motorista_filter = new TCriteria;
        $motorista_filter->add(new TFilter('grupo', '=', 4)); // grupo motorista
        
        
        $id                 = new TEntry('id');
        $data_coleta        = new TDate('data_coleta');
        $data_entrega       = new TDate('data_entrega');
        
        $status_transporte  = new TDBCombo('status_transporte_id', 'uppertruck', 'StatusTransporte', 'id', '{descricao}');
        $status_pgmto       = new TDBCombo('status_pgmto_id', 'uppertruck', 'StatusPgmto', 'id', '{descricao}');
        $tipo_pgmto         = new TDBCombo('tipo_pgmto_id', 'uppertruck', 'TipoPgmto', 'id', '{descricao}'); 
        $data_vencimento    = new TDate('data_vencimento');
        $data_pgmto         = new TDate('data_pgmto');
        $cte                = new TEntry('data_pgmto');
        $cliente_id         = new TDBCombo('cliente_id',  'uppertruck', 'SystemUser', 'id', 'name', 'name', $cliente_filter);
        $num_nf             = new TEntry('num_nf');
        
        $filter = new TCriteria;
        $filter->add(new TFilter('id', '<', '0'));
        $motorista_id       = new TDBCombo('motorista_id',  'uppertruck', 'SystemUser', 'id', 'name', 'name', $motorista_filter);
        $motorista_id->setChangeAction( new TAction( [$this, 'onChangeMotorista'] ) );
        $veiculo_id         = new TDBCombo('veiculo_id',  'uppertruck', 'Veiculo', 'id', 'placa', 'placa', $filter);
         
        $origem_estado_id   = new TDBCombo('origem_estado_id', 'uppertruck', 'Estado', 'id', '{nome} ({uf})');
        $origem_estado_id->setChangeAction( new TAction( [$this, 'onChangeEstadoOrigem'] ) );
        $origem_cidade_id   = new TDBCombo('origem_cidade_id',  'uppertruck', 'Cidade', 'id', 'nome', 'nome', $filter);
        
        $destino_estado_id  = new TDBCombo('destino_estado_id', 'uppertruck', 'Estado', 'id', '{nome} ({uf})');
        $destino_estado_id->setChangeAction( new TAction( [$this, 'onChangeEstadoDestino'] ) );
        $destino_cidade_id  = new TDBCombo('destino_cidade_id', 'uppertruck', 'Cidade', 'id', 'nome', 'nome', $filter);
        
        
        $kg                 = new TEntry('kg');
        $volumes            = new TEntry('volumes');
        $m3                 = new TEntry('m3');
        $tipo_produto       = new TEntry('tipo_produto');
       
        $valor_nf           = new TEntry('valor_nf');
        $valor_faturado     = new TEntry('valor_faturado');
        $valor_motorista    = new TEntry('valor_motorista');
        $valor_icms         = new TEntry('valor_icms');
        $valor_seguro       = new TEntry('valor_seguro');
        $valor_comissao     = new TEntry('valor_comissao');
        $valor_gris         = new TEntry('valor_gris');
        $valor_simples      = new TEntry('valor_simples');
        $outros_descontos   = new TEntry('outros_descontos');
        $obs                = new TEntry('obs');
        
  
        $id->setEditable(FALSE);
       
        $valor_nf->setNumericMask(2, ',', '.', true);
        $valor_faturado->setNumericMask(2, ',', '.', true);
        $valor_motorista->setNumericMask(2, ',', '.', true);
        $valor_icms->setNumericMask(2, ',', '.', true);
        $valor_seguro->setNumericMask(2, ',', '.', true);
        $valor_comissao->setNumericMask(2, ',', '.', true);
        $valor_gris->setNumericMask(2, ',', '.', true);
        $valor_simples->setNumericMask(2, ',', '.', true);
        $outros_descontos->setNumericMask(2, ',', '.', true);
 
        $data_coleta->setMask('dd/mm/yyyy');
        $data_coleta->setDatabaseMask('yyyy-mm-dd');
        $data_entrega->setMask('dd/mm/yyyy');
        $data_entrega->setDatabaseMask('yyyy-mm-dd');
        $data_pgmto->setMask('dd/mm/yyyy');
        $data_pgmto->setDatabaseMask('yyyy-mm-dd');
        $data_vencimento->setMask('dd/mm/yyyy');
        $data_vencimento->setDatabaseMask('yyyy-mm-dd');
        
        $obs->setSize('100%', 60);
        
        
        
        // define the form action
        $this->form->addAction('Save', new TAction([$this, 'onSave']), 'fa:save green');
        $this->form->addActionLink('Clear',  new TAction([$this, 'onClear']), 'fa:eraser red');
        $this->form->addActionLink('Listing',  new TAction(['ProgramacaoEmpresaList', 'onReload']), 'fa:table blue');
        
        // wrap the page content using vertical box
        $vbox = new TVBox;
        $vbox->style = 'width: 100%';
        //$vbox->add(new TXMLBreadCrumb('menu.xml', __CLASS__));
        $vbox->add($this->form);
        parent::add($vbox);
    }
    /**
     * method onSave()
     * Executed whenever the user clicks at the save button
     */
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
            $object->store(); // save the object
            
            // fill the form with the active record data
            $this->form->setData($object);
            
            TTransaction::close();  // close the transaction
            
            // shows the success message
            new TMessage('info', 'Record saved');
        }
        catch (Exception $e) // in case of exception
        {
            new TMessage('error', $e->getMessage()); // shows the exception error message
            $this->form->setData( $this->form->getData() ); // keep form data
            TTransaction::rollback(); // undo all pending operations
        }
    }
    
    /**
     * Clear form
     */
    public function onClear()
    {
        $this->form->clear( TRUE );
    }
    
    /**
     * method onEdit()
     * Executed whenever the user clicks at the edit button da datagrid
     */
    public function onEdit($param)
    {
        try
        {
            if (isset($param['id']))
            {
                $key = $param['id'];  // get the parameter
                TTransaction::open('uppertruck');   // open a transaction with database 'samples'
                $object = new Programacao($key);        // instantiates object City
                
                //new TMessage('info', json_encode(var_dump($object->id)));
                //$obj = (object) (array) $object;
                
                //TForm::sendData('form_programacao', $object);
                
                //$this->form->setData( (object)$object);   // fill the form with the active record data
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
    
    
    
    
    public static function onChangeMotorista($param)
    {
        try
        {
            TTransaction::open('uppertruck');
            if (!empty($param['motorista_id']))
            {
                $criteria = TCriteria::create( ['motorista_id' => $param['origem_estado_id'] ] );
                
                // formname, field, database, model, key, value, ordercolumn = NULL, criteria = NULL, startEmpty = FALSE
                TDBCombo::reloadFromModel('form_programacao', 'veiculo_id', 'uppertruck', 'Veiculo', 'id', '{placa} ({tipo_id})', 'nome', $criteria, TRUE);
            }
            else
            {
                TCombo::clearField('form_programacao', 'motorista_id');
            }
            
            TTransaction::close();
        }
        catch (Exception $e)
        {
            new TMessage('error', $e->getMessage());
        }
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
                TDBCombo::reloadFromModel('form_programacao', 'origem_cidade_id', 'uppertruck', 'Cidade', 'id', '{nome} ({id})', 'nome', $criteria, TRUE);
            }
            else
            {
                TCombo::clearField('form_programacao', 'origem_cidade_id');
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
                TDBCombo::reloadFromModel('form_programacao', 'destino_cidade_id', 'uppertruck', 'Cidade', 'id', '{nome} ({id})', 'nome', $criteria, TRUE);
            }
            else
            {
                TCombo::clearField('form_programacao', 'destino_cidade_id');
            }
            
            TTransaction::close();
        }
        catch (Exception $e)
        {
            new TMessage('error', $e->getMessage());
        }
    }
    
    
    
    
    
    
    
    
    
}
