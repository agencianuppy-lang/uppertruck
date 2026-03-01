<?php
/**
 * StatusCotacao Active Record
 * @author  ique.dev
 */
class StatusCotacao extends TRecord
{
    const TABLENAME = 'status_cotacao';
    const PRIMARYKEY= 'id';
    const IDPOLICY =  'max'; // {max, serial}
    
    
    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('visao_cliente');
        parent::addAttribute('visao_empresa');
    }


}
