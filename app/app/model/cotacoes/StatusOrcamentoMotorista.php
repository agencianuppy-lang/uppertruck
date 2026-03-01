<?php
/**
 * StatusOrcamentoMotorista Active Record
 * @author  ique.dev
 */
class StatusOrcamentoMotorista extends TRecord
{
    const TABLENAME = 'status_orcamento_motorista';
    const PRIMARYKEY= 'id';
    const IDPOLICY =  'max'; // {max, serial}
    
    
    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('visao_motorista');
        parent::addAttribute('visao_empresa');
    }


}

