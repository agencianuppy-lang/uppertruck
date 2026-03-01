<?php
/**
 * Veiculo Active Record
 * @author  ique.dev
 */
class Veiculo extends TRecord
{
    const TABLENAME = 'veiculo';
    const PRIMARYKEY= 'id';
    const IDPOLICY =  'serial'; // {max, serial}
    
    private $tipo;
    
    
    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('tipo_id');
        parent::addAttribute('placa');
        parent::addAttribute('ano_fab');
        parent::addAttribute('ano_mod');
        parent::addAttribute('motorista_id');
    }


    public function get_tipo()
    {
        if (empty($this->$tipo))
        {
            $this->tipo = new TipoVeiculo($this->tipo_id);
        }
        return $this->tipo;
    }



    public function get_motorista()
    {
        return SystemUser::find($this->motorista_id);
    }

}

