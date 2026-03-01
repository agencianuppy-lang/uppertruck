<?php
class PendenciesMotoristaList extends TPage
{
    //private $datagrid, $pageNavigation, $loaded;
    
   
    public function __construct()
    {
        parent::__construct();
        
        $panel = new TPanelGroup('Avisos');
       
        
        try 
        {
            TTransaction::open('uppertruck'); // open transaction
            
            $user_id = TSession::getValue('userid'); 
            
            
            
            $criteria = new TCriteria; 
            $criteria->add(new TFilter('motorista_id', '=', $user_id)); 
            $criteria->add(new TFilter('status', '=', 1)); 
            $repository = new TRepository('OrcamentoMotorista'); 
            $orc_pendente = $repository->load($criteria); 
            
            $criteria = new TCriteria; 
            $criteria->add(new TFilter('motorista_id', '=', $user_id)); 
            $criteria->add(new TFilter('status_transporte_id', '=', 1)); 
            $repository = new TRepository('Programacao'); 
            $progs_agendar = $repository->load($criteria); 
            
            $criteria = new TCriteria; 
            $criteria->add(new TFilter('motorista_id', '=', $user_id)); 
            $criteria->add(new TFilter('status_transporte_id', '=', 2)); 
            $repository = new TRepository('Programacao'); 
            $progs_agendada = $repository->load($criteria);
            
            $criteria = new TCriteria; 
            $criteria->add(new TFilter('motorista_id', '=', $user_id)); 
            $criteria->add(new TFilter('status_transporte_id', '=', 3)); 
            $repository = new TRepository('Programacao'); 
            $progs_transp = $repository->load($criteria); 
              
            
            $prog_label = '';
            $num_prog_agendar    = count($progs_agendar);
            $num_prog_agendada   = count($progs_agendada);
            $num_prog_transp     = count($progs_transp);
            
            $orc_label = '';
            $num_orc = count($orc_pendente);
           
            
            if ( $num_orc > 0 )
            {
                if ( $num_orc == 1 )
                {
                    $orc_label = '1 solicitação de orçamento pendente de análise.<br/>';         
                }
                else
                {
                    $orc_label = $num_orc . ' solicitações de orçamentos pendentes de análise.<br/>';   
                }
            }
            
            if ( $num_prog_agendar > 0 )
            {
                if ( $num_prog_agendar == 1 )
                {
                    $prog_label = '1 coleta pendente de agendamento. <br/>';         
                }
                else
                {
                    $prog_label = $num_prog_agendar . ' coletas pendentes de agendamento. <br/>';   
                }
            }
            
            if ( $num_prog_agendada > 0 )
            {
                if ( $num_prog_agendada == 1 )
                {
                    $prog_label = $prog_label . '1 coleta agendada<br/>';         
                }
                else
                {
                    $prog_label =  $prog_label . $num_prog_agendar . ' coletas agendadas. <br/>';   
                }
            }
            
            if ( $num_prog_transp > 0 )
            {
                if ( $num_prog_transp == 1 )
                {
                    $prog_label =  $prog_label . '1 frete em transporte - pendente de confirmação de entrega. <br/>';         
                }
                else
                {
                    $prog_label =  $prog_label . $num_prog_transp . ' fretes em transporte - pendentes de confirmação de entrega.<br/>';   
                }
            }
            
           
            
                
            
            
            TTransaction::close(); // close transaction
        
        
            $act_orc     =  new TAction( ['OrcamentoMotoristaPendenteList', 'onReload' ] );
            $orc_link    =  new TActionLink($orc_label, $act_orc, '#37474f', 12, 'bi');
            
            $act_prog     =  new TAction( ['ProgramacaoMotoristaList', 'onReload' ] );
            $prog_link    =  new TActionLink($prog_label, $act_prog, '#37474f', 12, 'bi');
        
            $panel->add( new TElement('br') ); 
            $text_clean = true;
            
            if ($num_orc > 0)
            {
                $panel->add($orc_link);
                $text_clean = false;
            }
            if ($num_prog_agendar > 0 OR $num_prog_agendada > 0 OR $num_prog_transp > 0)
            {
                $panel->add($prog_link);
                $text_clean = false;
            }
            if ($text_clean)
            {
                $text = new TTextDisplay('Sem pendências encontradas.', '#37474f', 12, 'bi');
                $panel->add($text);
            }
            
            
        
        } 
        catch (Exception $e) 
        { 
            new TMessage('error', $e->getMessage()); 
        } 
        
        $panel->add( new TElement('br') );
        $panel->add( new TElement('br') );
        $vbox = new TVBox;
        $vbox->style = 'width: 100%';
        parent::add($panel);
      
    }
    
   
}