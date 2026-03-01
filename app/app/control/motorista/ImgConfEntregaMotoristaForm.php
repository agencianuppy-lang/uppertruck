<?php
class ImgConfEntregaMotoristaForm extends TPage
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
        $this->setActiveRecord('Programacao');   // defines the active record
        
        // creates the form
        $this->form = new BootstrapFormBuilder('form_conf_entrega');
        $this->form->setFormTitle('Canhoto de entrega');
        //$this->form->setClientValidation(true);
        
        // create the form fields
        $id    = new TEntry('id');
        $canhoto_entrega = new TImageCapture('canhoto_entrega');
        $canhoto_entrega->setAllowedExtensions( ['gif', 'png', 'jpg', 'jpeg'] );
        $canhoto_entrega->setSize(300, 200);
        $canhoto_entrega->setCropSize(300, 200);
        
        
        $id->setEditable(FALSE);
        //escode campo do ID
        //TQuickForm::hideField('form_conf_entrega', 'id');
       
        $label = new TLabel('Salve uma foto do canhoto de entrega assinado pelo cliente.', '#7D78B6', 14, 'bi');
        $label->style='text-align:left;border-bottom:1px solid #c0c0c0;width:100%';
       
        // add the form fields
        $this->form->addContent( [$label] );
        $this->form->addFields( [new TLabel('ID')], [$id] );
        $this->form->addFields( [new TLabel('Canhoto')], [$canhoto_entrega] );
        
        $canhoto_entrega->addValidation('Foto do canhoto de entrega', new TRequiredValidator);
        $id->addValidation('Id', new TRequiredValidator);
              
        // define the form action
        $this->form->addAction('Confirmar entrega',   new TAction(array($this, 'onSave')), 'fa:thumbs-up green');
        $this->form->addAction('Cancelar', new TAction(array('ProgramacaoMotoristaList', 'onReload')), 'fa:times red');
        // wrap the page content using vertical box
        $vbox = new TVBox;
        $vbox->style = 'width: 100%';
        $vbox->add(new TXMLBreadCrumb('menu.xml', 'ProgramacaoMotoristaList'));
        $vbox->add($this->form);
        parent::add($vbox);
    }
    
 
// carrega o formulário com os dados do banco
//     public function onEdit($param)
//     {    
//         try 
//         {
//             TTransaction::open('uppertruck');
//             $obj = new Programacao();
//             TTransaction::close();
//             $this->form->setData($widget);
//         }
//         catch (Exception $e)
//         {
//             new TMessage('error', $e->getMessage());
//             TTransaction::rollback();
//         }
//       
//     }
// 
    
    
//  public static function onSave($param)
//     {
// 
//         //$action = new TAction(array(__CLASS__, 'ConfEntrega'));
//         
//         $action = new TAction(array('ImgConfEntregaMotoristaForm', 'Save'));
//         $action->setParameters($param); // pass the key parameter ahead
//         new TQuestion('Confirma a ENTREGA?', $action);  
//     }    
    
    
    
 public function onSave($param)
    {

        try
        {
                            
            $object = $this->form->getData();
            $this->form->validate();
            
            TTransaction::open('uppertruck');
            
            $programacao = new Programacao($object->id);                                                         
            //$programacao->fromArray( (array) $object);
            
            if ($object->canhoto_entrega)
            {
            
                new TMessage('info', 'TESTE');
                $source_file   = 'tmp/'.$object->canhoto_entrega;     
               
                
                if (file_exists($source_file))
                {
                                
                    //$target_file   = 'app/images/programacao/canhotos_entrega/' . uniqid() . '.png';
                    $target_file   = 'app/images/programacao/canhotos_entrega/' . uniqid() . '.jpg';
                    CustomImages::compress($source_file, $target_file, 75);
                    //rename($source_file, $target_file);
                    $programacao->canhoto_entrega = $target_file; 
                 }              
            }
            
            $programacao->status_transporte_id = 4; // Entrege
            $programacao->data_entrega = date('Y-m-d');
            if (!$programacao->avaliacao_pendente OR $programacao->avaliacao_pendente == 0 )
            {
                $programacao->avaliacao_pendente = 1;
            }
        
            $programacao->store();   
            
            $repos = new TRepository('OrcamentoMotorista');
            $criteria = new TCriteria;
            $criteria->add(new TFilter('cotacao_id', '=', $programacao->cotacao->id)); 
            $values = array('finalizado' => 1);
            $repos->update($values, $criteria);
            
            
             
            $this->form->setData($programacao);
            if (file_exists($source_file))
            {
                unlink($source_file);
            } 
            
            QueueSendTransporte::put($programacao, 'registrar_entrega');
            
            
            TTransaction::close();
            
            $action = new TAction(array('ProgramacaoMotoristaList', 'onReload'));
            $action->setParameters($param); // pass the key parameter ahead
            //new TQuestion('Confirma a ENTREGA?', $action);  
            new TMessage('info', 'Entrega confirmada com sucesso!', $action);
                           
        }
        catch (Exception $e)
        {
            new TMessage('error', $e->getMessage());
            TTransaction::rollback();
        }
 
    }

    
}