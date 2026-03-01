<?php
/**
 * SystemPreferenceForm
 *
 * @version    1.0
 * @package    control
 * @subpackage admin
 * @author     Henrique Finco Mariani
 * @copyright  Copyright (c) 2021 https://ique.dev
 * @derivation changed fork of version 1.0 of SystemPreferenceForm Adianti FrameWork (http://www.adianti.com.br)
 * @license    MIT https://opensource.org/licenses/MIT
 * 
 */
class SystemPreferenceForm extends TStandardForm
{
    protected $form; // formulário
    
    /**
     * método construtor
     * Cria a página e o formulário de cadastro
     */
    function __construct()
    {
        parent::__construct();
        
        $this->setDatabase('permission');
        $this->setActiveRecord('SystemPreference');
        
        // cria o formulário
        $this->form = new BootstrapFormBuilder('form_preferences');
        $this->form->setFormTitle(_t('Preferences'));
        
        $this->form->setFieldSizes('100%'); 
       
        
        // cria os campos do formulário
        $mail_domain   = new TEntry('mail_domain');
        $smtp_auth     = new TCombo('smtp_auth');
        $smtp_host     = new TEntry('smtp_host');
        $smtp_port     = new TEntry('smtp_port');
        $smtp_user     = new TEntry('smtp_user');
        $smtp_pass     = new TPassword('smtp_pass');
        $mail_from     = new TEntry('mail_from');
        $mail_destiny1 = new TEntry('mail_destiny1');
        //$mail_destiny2 = new TEntry('mail_destiny2');
        
        
        $send_msg_cliente             = new TCombo('send_msg_cliente');
        $send_msg_motorista           = new TCombo('send_msg_motorista');
        $send_msg_empresa_cotacao     = new TCombo('send_msg_empresa_cotacao');
        $send_msg_empresa_transporte  = new TCombo('send_msg_empresa_transporte');
        
      
        
        
        $msg_conf_solicitacao_cotacao_cliente       = new THtmlEditor('msg_conf_solicitacao_cotacao_cliente');
        $msg_envio_cotacao_cliente                  = new THtmlEditor('msg_envio_cotacao_cliente');
        $msg_conf_solicitacao_cotacao_motorista     = new THtmlEditor('msg_conf_solicitacao_cotacao_motorista');
        $msg_conf_solicitacao_cotacao_empresa       = new THtmlEditor('msg_conf_solicitacao_cotacao_empresa');
      
        $msg_aceite_cotacao_cliente                 = new THtmlEditor('msg_aceite_cotacao_cliente');
        $msg_rejeicao_cotacao_cliente               = new THtmlEditor('msg_rejeicao_cotacao_cliente');
       
        $msg_aceite_cotacao_empresa                 = new THtmlEditor('msg_aceite_cotacao_empresa');
        $msg_rejeicao_cotacao_empresa               = new THtmlEditor('msg_rejeicao_cotacao_empresa');
      
        $msg_aceite_orcamento_motorista             = new THtmlEditor('msg_aceite_orcamento_motorista');
        $msg_envio_orcamento_empresa                = new THtmlEditor('msg_envio_orcamento_empresa');
        
        $msg_programacao_status_empresa             = new THtmlEditor('msg_programacao_status_empresa');
        $msg_programacao_status_motorista           = new THtmlEditor('msg_programacao_status_motorista');
        $msg_programacao_status_cliente             = new THtmlEditor('msg_programacao_status_cliente');
        
        $msg_cotacao_outros_empresa                 = new THtmlEditor('msg_cotacao_outros_empresa');
        $msg_cotacao_outros_cliente                 = new THtmlEditor('msg_cotacao_outros_cliente');
        $msg_cotacao_outros_motorista               = new THtmlEditor('msg_cotacao_outros_motorista');
      
      
        
        $smtp_host->placeholder = 'ssl://smtp.gmail.com, tls://server.company.com';
        $yesno = array();
        $yesno['1'] = _t('Yes');
        $yesno['0'] = _t('No');
        $smtp_auth->addItems($yesno);
        $send_msg_cliente->addItems($yesno);
        $send_msg_empresa_cotacao->addItems($yesno);
        $send_msg_empresa_transporte->addItems($yesno);
        $send_msg_motorista->addItems($yesno);
  
       
        
       
        
        //aba Gerais
        $this->form->appendPage('Gerais');
        

        
        
        $row = $this->form->addFields( [new TLabel(_t('Mail from')), $mail_from], 
                                [new TLabel(_t('SMTP Auth')), $smtp_auth ]);             
        $row->layout = ['col-sm-6', 'col-sm-6'];
    
        $row = $this->form->addFields( [new TLabel(_t('SMTP Host')), $smtp_host],
                                 [new TLabel(_t('SMTP Port')), $smtp_port]);                   
        $row->layout = ['col-sm-6', 'col-sm-6'];
  
        $row = $this->form->addFields( [new TLabel(_t('SMTP User')), $smtp_user],
                                [new TLabel(_t('SMTP Pass')), $smtp_pass]);                  
        $row->layout = ['col-sm-6', 'col-sm-6'];
         
        $row = $this->form->addFields( [new TLabel('Email de destino'), $mail_destiny1],
                                []);               
        $row->layout = ['col-sm-6', 'col-sm-6'];
        
        
        $row = $this->form->addFields( [ new TLabel('Envia E-Mail cliente'), $send_msg_cliente ],
                                [new TLabel('Envia E-Mail motorista'), $send_msg_motorista ]);               
        $row->layout = ['col-sm-6', 'col-sm-6'];
       
        
        
        $row = $this->form->addFields( [new TLabel('Envia E-Mail UpperTruck - Cotações/Orçamentos'), $send_msg_empresa_cotacao],
                                [new TLabel('Envia E-Mail UpperTruck - Status Transporte'), $send_msg_empresa_transporte ]);               
        $row->layout = ['col-sm-6', 'col-sm-6'];
        
        
  
        //aba msg cliente
        $this->form->appendPage('Mensagens para Cliente');
        $this->form->addFields([new TLabel('Conf. recebimento solicitação de cotaçao'),  $msg_conf_solicitacao_cotacao_cliente] );
        $this->form->addFields([new TLabel('Aviso de envio de cotação'),  $msg_envio_cotacao_cliente] );
        $this->form->addFields( [new TLabel('Conf. aceite da cotação enviada'), $msg_aceite_cotacao_cliente ] );
        $this->form->addFields( [new TLabel('Conf. rejeição da cotação enviada'), $msg_rejeicao_cotacao_cliente] );
        $this->form->addFields( [new TLabel('Outras mudanças cotação'),  $msg_cotacao_outros_cliente] );
        $this->form->addFields( [new TLabel('Notificação status do transporte'), $msg_programacao_status_cliente] );
           
       //aba mensagens para uppertruck
        $this->form->appendPage('Mensagens para UpperTruck');
        $this->form->addFields([new TLabel('Aviso solicitação pedido de cotação'),  $msg_conf_solicitacao_cotacao_empresa] );
        $this->form->addFields([new TLabel('Aviso de aceite de cotação pelo cliente'), $msg_aceite_cotacao_empresa ] );
        $this->form->addFields([new TLabel('Aviso de rejeição de cotação pelo cliente'), $msg_rejeicao_cotacao_empresa] );
        $this->form->addFields([new TLabel('Aviso envio de orçamento de motorista'), $msg_envio_orcamento_empresa  ] );
        $this->form->addFields( [new TLabel('Outras mudanças cotação'),  $msg_cotacao_outros_empresa] );
        $this->form->addFields([new TLabel('Notificação status do transporte'), $msg_programacao_status_empresa ] );
         
        //aba mensagens para motorista
        $this->form->appendPage('Mensagens para Motoristas');
        $this->form->addFields([new TLabel('Aviso solicitação pedido de orçamento'), $msg_conf_solicitacao_cotacao_motorista] );
        $this->form->addFields([new TLabel('Aviso de aceite de orçamento pela UpperTruck'),     $msg_aceite_orcamento_motorista ] );
        $this->form->addFields( [new TLabel('Outras mudanças cotação'),  $msg_cotacao_outros_motorista] );
        $this->form->addFields([new TLabel('Notificação status do transporte'),     $msg_programacao_status_motorista ] );
    
        
       
        $msg_aceite_cotacao_cliente->setSize('100%', 250);
        $msg_aceite_cotacao_empresa->setSize('100%', 250);
        $msg_aceite_orcamento_motorista->setSize('100%', 250);
        $msg_conf_solicitacao_cotacao_cliente->setSize('100%', 250);
        $msg_conf_solicitacao_cotacao_empresa->setSize('100%', 250);
        $msg_conf_solicitacao_cotacao_motorista->setSize('100%', 250);
        $msg_envio_cotacao_cliente->setSize('100%', 250);
        $msg_envio_orcamento_empresa->setSize('100%', 250);
        $msg_programacao_status_cliente->setSize('100%', 250);
        $msg_programacao_status_empresa->setSize('100%', 250);
        $msg_programacao_status_motorista->setSize('100%', 250);
        $msg_rejeicao_cotacao_cliente->setSize('100%', 250);
        $msg_rejeicao_cotacao_empresa->setSize('100%', 250);
        $msg_cotacao_outros_cliente->setSize('100%', 250);
        $msg_cotacao_outros_empresa->setSize('100%', 250);
        $msg_cotacao_outros_motorista->setSize('100%', 250);
       
       
       
        $btn = $this->form->addAction(_t('Save'), new TAction(array($this, 'onSave')), 'far:save');
        $btn->class = 'btn btn-sm btn-primary';

        $container = new TVBox;
        $container->{'style'} = 'width: 100%;';
        $container->add(new TXMLBreadCrumb('menu.xml', __CLASS__));
        $container->add($this->form);
        parent::add($container);
    }
    
    /**
     * Carrega o formulário de preferências
     */
    function onEdit($param)
    {
        try
        {
            // open a transaction with database
            TTransaction::open($this->database);
            
            $preferences = SystemPreference::getAllPreferences();
            if ($preferences)
            {
                $this->form->setData((object) $preferences);
            } 
            
            // close the transaction
            TTransaction::close();
        }
        catch (Exception $e) // in case of exception
        {
            // shows the exception error message
            new TMessage('error', $e->getMessage());
            // undo all pending operations
            TTransaction::rollback();
        }
    }
    
    /**
     * method onSave()
     * Executed whenever the user clicks at the save button
     */
    function onSave()
    {
        try
        {
            // open a transaction with database
            TTransaction::open($this->database);
            
            // get the form data
            $data = $this->form->getData();
            $data_array = (array) $data;
            
            foreach ($data_array as $property => $value)
            {
                $object = new SystemPreference;
                $object->{'id'}    = $property;
                $object->{'value'} = $value;
                $object->store();
            }
            
            // fill the form with the active record data
            $this->form->setData($data);
            
            // close the transaction
            TTransaction::close();
            
            // shows the success message
            new TMessage('info', AdiantiCoreTranslator::translate('Record saved'));
            // reload the listing
        }
        catch (Exception $e) // in case of exception
        {
            // get the form data
            $object = $this->form->getData($this->activeRecord);
            
            // fill the form with the active record data
            $this->form->setData($object);
            
            // shows the exception error message
            new TMessage('error', $e->getMessage());
            
            // undo all pending operations
            TTransaction::rollback();
        }
    }
}
