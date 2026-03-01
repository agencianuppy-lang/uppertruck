<?php
class FilaEnvio extends TRecord
{
    const TABLENAME = 'fila_envio';
    const PRIMARYKEY= 'id';
    const IDPOLICY =  'serial'; // {max, serial}
    
    
    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('email');
        parent::addAttribute('assunto');
        parent::addAttribute('msg');
        parent::addAttribute('registro_fila');
        parent::addAttribute('ocorrencia_erro');
        parent::addAttribute('erro');
        parent::addAttribute('registro_erro');
    }


}