<?php
class PendenciesClienteList extends TPage
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
            $criteria->add(new TFilter('status_id', '=', 2));   // cotação respondida e falta cliente analizar 
            $criteria->add(new TFilter('cliente_id', '=', $user_id)); 
            $repository = new TRepository('Cotacao'); 
            $cotacoes = $repository->load($criteria); 
           
            $cotacao_label = '';
            $num_cotacao = count($cotacoes);
            if ( $num_cotacao == 1 )
            {
                $cotacao_label = '1 resposta de solicitação de cotação recebida e pendente de análise.';         
            }
            if ( $num_cotacao > 1 )
            {
                $cotacao_label = $num_cotacao . ' resposta de solicitações de cotação recebidas e pendentes de análise..';         
            }
            
            
            
            $criteria = new TCriteria; 
            $criteria->add(new TFilter('cliente_id', '=', $user_id)); 
            $criteria->add(new TFilter('status_transporte_id', '=', 1)); 
            $repository = new TRepository('Programacao'); 
            $progs_agendar = $repository->load($criteria); 
            
            $criteria = new TCriteria; 
            $criteria->add(new TFilter('cliente_id', '=', $user_id)); 
            $criteria->add(new TFilter('status_transporte_id', '=', 2)); 
            $repository = new TRepository('Programacao'); 
            $progs_agendada = $repository->load($criteria);
            
            $criteria = new TCriteria; 
            $criteria->add(new TFilter('cliente_id', '=', $user_id)); 
            $criteria->add(new TFilter('status_pgmto_id', '=', 1)); 
            $repository = new TRepository('Programacao'); 
            $progs_pgmto_pend = $repository->load($criteria); 
            
            $criteria = new TCriteria; 
            $criteria->add(new TFilter('cliente_id', '=', $user_id)); 
            $criteria->add(new TFilter('avaliacao_pendente', '=', 1)); 
            $repository = new TRepository('Programacao'); 
            $progs_avaliacao = $repository->load($criteria);
            
            
            
            $prog_label = '';
            $num_prog_agendar    = count($progs_agendar);
            $num_prog_agendada   = count($progs_agendada);
            $num_prog_pgmto      = count($progs_pgmto_pend);
            $num_prog_avaliacao  = count($progs_avaliacao);
            
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
                    $prog_label = $prog_label . '1 coleta agendada. <br/>';         
                }
                else
                {
                    $prog_label =  $prog_label . $num_prog_agendar . ' coletas agendadas. <br/>';   
                }
            }
            
            if ( $num_prog_pgmto > 0 )
            {
                if ( $num_prog_pgmto == 1 )
                {
                    $prog_label =  $prog_label . '1 serviço com pagamento pendente de confirmação. <br/>';         
                }
                else
                {
                    $prog_label =  $prog_label . $num_prog_pgmto . ' serviços com pagamentos pendentes de confirmação. <br/>';   
                }
            }
            
            if ( $num_prog_avaliacao > 0 )
            {
                if ( $num_prog_avaliacao == 1 )
                {
                    $prog_label =  $prog_label . '1 entrega pendente de sua avaliação. <br/>';         
                }
                else
                {
                    $prog_label =  $prog_label . $num_prog_agendar . ' entregas pendentes de sua avaliação. <br/>';   
                }
            }
            
                
            
            
            TTransaction::close(); // close transaction
        
        
        
            $act_cotacao  =  new TAction( ['CotacaoClienteList', 'onReload' ] );
            $cotacao_link =  new TActionLink($cotacao_label, $act_cotacao, '#37474f', 12, 'bi');
            
            $act_prog     =  new TAction( ['ProgramacaoClienteList', 'onReload' ] );
            $prog_link    =  new TActionLink($prog_label, $act_prog, '#37474f', 12, 'bi');
            
            $act_new_cotacao     =  new TAction( ['CotacaoClienteForm', 'onClear' ] );
            $new_cotacao_link    =  new TActionLink('Clique aqui para solicitar uma nova cotação.', $act_new_cotacao, '#37474f', 12, 'bi');
        
            //$vbox = new TVBox;
            //$vbox->style = 'width: 100%';
            $panel->add( new TElement('br') );
            $text_clean = true;
            if ($num_cotacao > 0)
            {              
                $panel->add($cotacao_link);
                $panel->add( new TElement('br') );
                $panel->add( new TElement('br') );
                $text_clean = false;
            }
            if ($num_prog_agendar > 0 OR $num_prog_agendada > 0 OR $num_prog_pgmto > 0 OR $num_prog_avaliacao > 0)
            {
                $panel->add($prog_link);
                $panel->add( new TElement('br') );
                $panel->add( new TElement('br') );
                $text_clean = false;
            }
            if ($text_clean)
            {
                //$text = new TTextDisplay('Sem pendências encontradas.', '#37474f', 12, 'bi');
                //$panel->add($text);
                $panel->add($new_cotacao_link);
                $panel->add( new TElement('br') );
                $panel->add( new TElement('br') );
            }
            
            
            
        
        
        
        } 
        catch (Exception $e) 
        { 
            new TMessage('error', $e->getMessage()); 
        } 
        
        $vbox = new TVBox;
        $vbox->style = 'width: 100%';
        parent::add($panel);
      
    }
    
   
}
