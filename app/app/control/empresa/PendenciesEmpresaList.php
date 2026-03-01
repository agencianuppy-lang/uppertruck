<?php
class PendenciesEmpresaList extends TPage
{
    //private $datagrid, $pageNavigation, $loaded;
    
   
    public function __construct()
    {
        parent::__construct();
        
        $panel = new TPanelGroup('Pendências');
       
        
        try 
        {
            TTransaction::open('uppertruck'); // open transaction
            
        
            $criteria = new TCriteria; 
            $criteria->add(new TFilter('status_id', '=', 1)); 
            $repository = new TRepository('Cotacao'); 
            $cotacoes = $repository->load($criteria); 
           
            $cotacao_label = '';
            $num_cotacao = count($cotacoes);
            if ( $num_cotacao == 1 )
            {
                $cotacao_label = '1 cotação pendente de resposta ao cliente.';         
            }
            if ( $num_cotacao > 1 )
            {
                $cotacao_label = $num_cotacao . ' cotações pendentes de resposta ao cliente.';         
            }
            
            
            
            $criteria = new TCriteria; 
            $criteria->add(new TFilter('status_transporte_id', '=', 1)); 
            $repository = new TRepository('Programacao'); 
            $progs_agendar = $repository->load($criteria); 
            
            $criteria = new TCriteria; 
            $criteria->add(new TFilter('status_pgmto_id', '=', 1)); 
            $repository = new TRepository('Programacao'); 
            $progs_pgmto_pend = $repository->load($criteria); 
            
            $prog_label = '';
            $num_prog_agendar = count($progs_agendar);
            $num_prog_pgmto   = count($progs_pgmto_pend);
            
            if ( $num_prog_agendar > 0 )
            {
                if ( $num_prog_agendar == 1 )
                {
                    $prog_label = '1 coleta pendente de agendamento';         
                }
                else
                {
                    $prog_label = $num_prog_agendar . ' coletas pendentes de agendamento';   
                }
                
                if ( $num_prog_pgmto == 1 )
                {
                    $prog_label =  $prog_label . ' e 1 pagamento pendente de confirmação.';         
                }
                if ( $num_prog_pgmto > 1 )
                {
                    $prog_label = $prog_label . ' e ' . $num_prog_pgmto . ' pagamentos pendentes de confirmação.';         
                }
                if ( $num_prog_pgmto == 0 )
                {
                     $prog_label = $prog_label . '.';
                } 
            }
            else
            {
                if ( $num_prog_pgmto == 1 )
                {
                   $prog_label = '1 pagamento pendente de confirmação.';         
                }
                if ( $num_prog_pgmto > 1 )
                {
                   $prog_label = $num_prog_pgmto . ' pagamentos pendentes de confirmação.';         
                }
            
            }
            
           
            
           
            
            
            
            
            TTransaction::close(); // close transaction
        
        
        
            $act_cotacao  =  new TAction( ['CotacaoEmpresaList', 'onReload' ] );
            $cotacao_link =  new TActionLink($cotacao_label, $act_cotacao, '#37474f', 12, 'bi');
            
            $act_prog     =  new TAction( ['ProgramacaoEmpresaList', 'onReload' ] );
            $prog_link    =  new TActionLink($prog_label, $act_prog, '#37474f', 12, 'bi');
        
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
            if ($num_prog_agendar > 0 OR $num_prog_pgmto>0)
            {
                $panel->add($prog_link);
                $panel->add( new TElement('br') );
                $panel->add( new TElement('br') );
                $text_clean = false;
            }
            if ($text_clean)
            {
                $text = new TTextDisplay('Sem pendências encontradas.', '#37474f', 12, 'bi');
                $panel->add($text);
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
