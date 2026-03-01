<?php
/**
 * Estado Active Record
 * @author  <your-name-here>
 */
class TipoVeiculo extends TRecord
{
    const TABLENAME = 'tipo_veiculo';
    const PRIMARYKEY= 'id';
    const IDPOLICY =  'serial'; // {max, serial}
    
    
    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('tipo');
        parent::addAttribute('obs');
    }


}
