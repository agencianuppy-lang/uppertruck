<?php
/**
 * SystemUserList
 *
 * @version    1.0
 * @package    control
 * @subpackage admin
 * @author     Pablo Dall'Oglio
 * @copyright  Copyright (c) 2006 Adianti Solutions Ltd. (http://www.adianti.com.br)
 * @license    http://www.adianti.com.br/framework-license
 */
class SystemUserList extends TStandardList
{
    protected $form;     // registration form
    protected $datagrid; // listing
    protected $pageNavigation;
    protected $formgrid;
    protected $deleteButton;
    protected $transformCallback;
    
    /**
     * Page constructor
     */
    public function __construct()
    {
        parent::__construct();
        
        parent::setDatabase('permission');            // defines the database
        parent::setActiveRecord('SystemUser');   // defines the active record
        parent::setDefaultOrder('id', 'asc');         // defines the default order
        
        $criteria = new TCriteria;
        $criteria->add( new TFilter( 'id', '!=', '1'  ) ); // tirar usuário admin 
        parent::setCriteria($criteria);
        
        parent::addFilterField('type', 'like', 'type'); // filterField, operator, formField
        parent::addFilterField('grupo','like', 'grupo'); // filterField, operator, formField
        
        parent::addFilterField('id', '=', 'id'); // filterField, operator, formField
        parent::addFilterField('name', 'like', 'name'); // filterField, operator, formField
        
        
        parent::addFilterField('nick_name', 'like', 'nick_name'); // filterField, operator, formField
        parent::addFilterField('cpf_cnpj', 'like', 'cpf_cnpj'); // filterField, operator, formField
        
        
        parent::addFilterField('email', 'like', 'email'); // filterField, operator, formField
        
        
        parent::addFilterField('uf', 'like', 'uf'); // filterField, operator, formField
        
        parent::addFilterField('active', '=', 'active'); // filterField, operator, formField
        
        // creates the form
        $this->form = new BootstrapFormBuilder('form_search_SystemUser');
        $this->form->setFormTitle(_t('Users'));
        

        // create the form fields
        $id = new TEntry('id');
        
        $type  = new TCombo('type');
        
        //$criteria = new TCriteria;
        //$criteria->add( new TFilter( 'id', '!=', '1'  ) ); // tirar usuário admin
        $grupo = new TDBCombo('grupo','permission','SystemGroup','id','name', 'name', $criteria);
        
        
        $name = new TEntry('name');
        
        $nick_name = new TEntry('nick_name');
        $cpf_cnpj  = new TEntry('cpf_cnpj');
        
        $email = new TEntry('email');
        
        $uf = new TDBCombo('uf', 'uppertruck', 'State', 'uf', 'name', 'id'); 
        
        $active = new TCombo('active');
        
        $active->addItems( [ 'Y' => _t('Yes'), 'N' => _t('No') ] );
        $type->addItems( [ 'F' => 'Pessoa Física', 'J' => 'Pessoa Jurídica' ] );
        
        // add the fields
        $this->form->addFields( [new TLabel('Id')], [$id] );
        
        $this->form->addFields( [new TLabel('Tipo')], [$type] );
        $this->form->addFields( [new TLabel('Grupo')], [$grupo] );
        
        $this->form->addFields( [new TLabel(_t('Name'))], [$name] );
        $this->form->addFields( [new TLabel('Nome Fantasia')], [$nick_name] );
        $this->form->addFields( [new TLabel('CPF/CNPJ')], [$cpf_cnpj] );
        
        $this->form->addFields( [new TLabel(_t('Email'))], [$email] );
        $this->form->addFields( [new TLabel('UF')], [$uf] );
        
        $this->form->addFields( [new TLabel(_t('Active'))], [$active] );
        
//         $id->setSize('30%');
//         $name->setSize('70%');
//         $email->setSize('70%');
//         $active->setSize('70%');
        
        // keep the form filled during navigation with session data
        $this->form->setData( TSession::getValue('SystemUser_filter_data') );
        
        // add the search form actions
        $btn = $this->form->addAction(_t('Find'), new TAction(array($this, 'onSearch')), 'fa:search');
        $btn->class = 'btn btn-sm btn-primary';
        $this->form->addAction(_t('New'),  new TAction(array('SystemUserForm', 'onEdit')), 'fa:plus green');

        //$this->form->addAction('Recolher',  new TAction(array($this, 'onRecolher')), 'fa:plus green');
        



       
        // $button = new TButton('show_hide');
        // $button->class = 'btn btn-default btn-sm active';
        // $button->setLabel('Mostra / Recolhe');
        // $this->form->oid="frame-form";
        // $button->addFunction("\$('[oid=frame-form]').slideToggle(); $(this).toggleClass( 'active' )");
        // $this->form->addHeaderWidget($button);
        $this->form->addExpandButton( "", "fa:grip-lines", false);

        






        // creates a DataGrid
        $this->datagrid = new BootstrapDatagridWrapper(new TDataGrid);
        //$this->datagrid->datatable = 'true';
        $this->datagrid->style = 'width: 100%';
        $this->datagrid->setHeight(320);
        

        // creates the datagrid columns
        $column_id = new TDataGridColumn('id', 'Id', 'center', 50);
        
        $column_type = new TDataGridColumn('type', 'Tipo', 'center', 50);      
  
  
        $column_name      = new TDataGridColumn('name', _t('Name'), 'left');
        $column_nick_name = new TDataGridColumn('nick_name', 'Nome Fantasia', 'left');
        
        
        $column_cpf_cnpj = new TDataGridColumn('cpf_cnpj', 'CPF/CNPJ', 'left');
        
        $column_login = new TDataGridColumn('login', _t('Login'), 'left');
        $column_email = new TDataGridColumn('email', _t('Email'), 'left');
        
     
        $column_grupo = new TDataGridColumn('grupo', 'Grupo', 'left');
        
        $column_uf = new TDataGridColumn('uf', 'UF', 'center', 50);
        
        
        $column_active = new TDataGridColumn('active', _t('Active'), 'center');
        
        $column_login->enableAutoHide(500);
        $column_nick_name->enableAutoHide(1200);
        $column_email->enableAutoHide(800);
        $column_active->enableAutoHide(500);
        $column_cpf_cnpj->enableAutoHide(1100);
        $column_grupo->enableAutoHide(500);
        $column_uf->enableAutoHide(800);
        
        
        // add the columns to the DataGrid
        $this->datagrid->addColumn($column_id);
        $this->datagrid->addColumn($column_type);
        
        $this->datagrid->addColumn($column_name);
        $this->datagrid->addColumn($column_nick_name);
        
        $this->datagrid->addColumn($column_cpf_cnpj);
        
        $this->datagrid->addColumn($column_login);
        $this->datagrid->addColumn($column_email);
        
        $this->datagrid->addColumn($column_grupo);
        
        $this->datagrid->addColumn($column_uf);
        
        $this->datagrid->addColumn($column_active);

        $column_active->setTransformer( function($value, $object, $row) {
            $class = ($value=='N') ? 'danger' : 'success';
            $label = ($value=='N') ? _t('No') : _t('Yes');
            $div = new TElement('span');
            $div->class="label label-{$class}";
            $div->style="text-shadow:none; font-size:12px; font-weight:lighter";
            $div->add($label);
            return $div;
        });
        
       
        $column_grupo->setTransformer( function($value, $object, $row) {
            TTransaction::open('permission');
            $grupo = new SystemGroup($value); 
            TTransaction::close();
            return $grupo->name;
        }); 
       
        
        
         
        
        
        // creates the datagrid column actions
        $order_id = new TAction(array($this, 'onReload'));
        $order_id->setParameter('order', 'id');
        $column_id->setAction($order_id);
        
        $order_name = new TAction(array($this, 'onReload'));
        $order_name->setParameter('order', 'name');
        $column_name->setAction($order_name);
        
        $order_nick_name = new TAction(array($this, 'onReload'));
        $order_nick_name->setParameter('order', 'nick_name');
        $column_nick_name->setAction($order_nick_name);
        
        $order_login = new TAction(array($this, 'onReload'));
        $order_login->setParameter('order', 'login');
        $column_login->setAction($order_login);
        
        $order_email = new TAction(array($this, 'onReload'));
        $order_email->setParameter('order', 'email');
        $column_email->setAction($order_email);
        
        $order_type = new TAction(array($this, 'onReload'));
        $order_type->setParameter('order', 'type');
        $column_type->setAction($order_type);
        
        $order_cpf_cnpj = new TAction(array($this, 'onReload'));
        $order_cpf_cnpj->setParameter('order', 'cpf_cnpj');
        $column_cpf_cnpj->setAction($order_cpf_cnpj);
        
        $order_grupo = new TAction(array($this, 'onReload'));
        $order_grupo->setParameter('order', 'grupo');
        $column_grupo->setAction($order_grupo);
        
        $order_uf = new TAction(array($this, 'onReload'));
        $order_uf->setParameter('order', 'uf');
        $column_uf->setAction($order_uf);

        
        // create EDIT action
        $action_edit = new TDataGridAction(array('SystemUserForm', 'onEdit'));
        $action_edit->setButtonClass('btn btn-default');
        $action_edit->setLabel(_t('Edit'));
        $action_edit->setImage('far:edit blue');
        $action_edit->setField('id');
        $this->datagrid->addAction($action_edit);
        
        // create DELETE action
        $action_del = new TDataGridAction(array($this, 'onDelete'));
        $action_del->setButtonClass('btn btn-default');
        $action_del->setLabel(_t('Delete'));
        $action_del->setImage('far:trash-alt red');
        $action_del->setField('id');
        $this->datagrid->addAction($action_del);
        
        // create CLONE action
        $action_clone = new TDataGridAction(array($this, 'onClone'));
        $action_clone->setButtonClass('btn btn-default');
        $action_clone->setLabel(_t('Clone'));
        $action_clone->setImage('far:clone green');
        $action_clone->setField('id');
        $this->datagrid->addAction($action_clone);
        
        // create ONOFF action
        $action_onoff = new TDataGridAction(array($this, 'onTurnOnOff'));
        $action_onoff->setButtonClass('btn btn-default');
        $action_onoff->setLabel(_t('Activate/Deactivate'));
        $action_onoff->setImage('fa:power-off orange');
        $action_onoff->setField('id');
        $this->datagrid->addAction($action_onoff);
        
        // create Impersonation action
        $action_person = new TDataGridAction(array($this, 'onImpersonation'));
        //$action_person = new TDataGridAction(array($this, 'onTeste'));
        $action_person->setButtonClass('btn btn-default');
        $action_person->setLabel(_t('Impersonation'));
        $action_person->setImage('far:user-circle gray');
        $action_person->setFields(['id','login']);
        $this->datagrid->addAction($action_person);
        
        // create the datagrid model
        $this->datagrid->createModel();
        
        // create the page navigation
        $this->pageNavigation = new TPageNavigation;
        $this->pageNavigation->enableCounters();
        $this->pageNavigation->setAction(new TAction(array($this, 'onReload')));
        $this->pageNavigation->setWidth($this->datagrid->getWidth());
        
        $panel = new TPanelGroup;
        $panel->add($this->datagrid)->style = 'overflow-x:auto';
        $panel->addFooter($this->pageNavigation);
        
        // header actions
        $dropdown = new TDropDown(_t('Export'), 'fa:list');
        $dropdown->setPullSide('right');
        $dropdown->setButtonClass('btn btn-default waves-effect dropdown-toggle');
        $dropdown->addAction( _t('Save as CSV'), new TAction([$this, 'onExportCSV'], ['register_state' => 'false', 'static'=>'1']), 'fa:table fa-fw blue' );
        $dropdown->addAction( _t('Save as PDF'), new TAction([$this, 'onExportPDF'], ['register_state' => 'false', 'static'=>'1']), 'far:file-pdf fa-fw red' );
        $dropdown->addAction( _t('Save as XML'), new TAction([$this, 'onExportXML'], ['register_state' => 'false', 'static'=>'1']), 'fa:code fa-fw green' );
        $panel->addHeaderWidget( $dropdown );
        
        // vertical box container
        $container = new TVBox;
        $container->style = 'width: 100%';
        $container->add(new TXMLBreadCrumb('menu.xml', __CLASS__));
        //$container->add($button);
        $container->add($this->form);
        //$container->add($frame);
        $container->add($panel);
        
        parent::add($container);
    }
    
    /**
     * Turn on/off an user
     */
    public function onTurnOnOff($param)
    {
        try
        {
            TTransaction::open('permission');
            $user = SystemUser::find($param['id']);
            if ($user instanceof SystemUser)
            {
                $user->active = $user->active == 'Y' ? 'N' : 'Y';
                $user->store();
            }
            
            TTransaction::close();
            
            $this->onReload($param);
        }
        catch (Exception $e)
        {
            new TMessage('error', $e->getMessage());
            TTransaction::rollback();
        }
    }
    
    /**
     * Clone group
     */
    public function onClone($param)
    {
        try
        {
            TTransaction::open('permission');
            $user = new SystemUser($param['id']);
            $user->cloneUser();
            TTransaction::close();
            
            $this->onReload();
        }
        catch (Exception $e)
        {
            new TMessage('error', $e->getMessage());
            TTransaction::rollback();
        }
    }
    
    /**
     * Impersonation user
     */
    public function onImpersonation($param)
    {
        try
        {
            TTransaction::open('permission');
            TSession::regenerate();
            $user = SystemUser::validate( $param['login'] );
            ApplicationAuthenticationService::loadSessionVars($user);
            SystemAccessLogService::registerLogin(true);
            AdiantiCoreApplication::gotoPage('EmptyPage');
            TTransaction::close();
        }
        catch (Exception $e)
        {
            new TMessage('error', $e->getMessage());
            TTransaction::rollback();
        }
    }
    
    
    public function onTeste($param)
    {
        $obj = new StdClass;
        $obj->type = 'F';
        // envia os dados ao formulário
        TForm::sendData('form_search_SystemUser', $obj);
        
        $filter = new TFilter('type', 'like', "%{$obj->type}%");
        TSession::setValue('SystemUser_filter', $filter); // BC compatibility
        TSession::setValue('SystemUser_filter_type', $filter);
        TSession::setValue('SystemUser_type', $obj->type);
        
        //$this->form->setData($data);
        $param = array();
        $param['offset']    =0;
        $param['first_page']=1;
        $this->onReload($param);
        
        
//         new TMessage('info', 'ok' .
//         $param['input_exit'])
    }

    public static function onRecolher($param) {
        TScript::create("changeFormFindVisible()");
    }


    
    
    
    
}
