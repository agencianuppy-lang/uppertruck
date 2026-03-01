<?php
/**
 * OrcamentoMotorista Active Record
 * @author  ique.dev
 */
class OrcamentoMotorista extends TRecord
{
    const TABLENAME = 'orcamento_motorista';
    const PRIMARYKEY= 'id';
    const IDPOLICY =  'serial'; // {max, serial}
    
    
    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('cotacao_id');
        parent::addAttribute('motorista_id');
        parent::addAttribute('valor');
        parent::addAttribute('prazo');
        parent::addAttribute('obs');
        parent::addAttribute('status');
        parent::addAttribute('data_orcamento');
        parent::addAttribute('finalizado');
    }
    
    
    public function get_cotacao()
    {
        return Cotacao::find($this->cotacao_id);
    }
    
    public function get_motorista()
    {
        return SystemUser::find($this->motorista_id);
    }


}
