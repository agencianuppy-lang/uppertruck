<?php
/**
 * Cotacao Active Record
 * @author  ique.dev
 */
class Cotacao extends TRecord
{
    const TABLENAME = 'cotacao';
    const PRIMARYKEY= 'id';
    const IDPOLICY =  'serial'; // {max, serial}
    
    
    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('cliente_id');
        parent::addAttribute('data_pedido');
        parent::addAttribute('data_cotacao');
        parent::addAttribute('origem_cidade_id');
        parent::addAttribute('destino_cidade_id');
        parent::addAttribute('tipo_produto');
        parent::addAttribute('kg');
        parent::addAttribute('m3');
        parent::addAttribute('volumes');
        parent::addAttribute('embalagem_id');
        parent::addAttribute('valor_nf');
        parent::addAttribute('obs');
        parent::addAttribute('status_id');
        parent::addAttribute('valor_cotacao');
        parent::addAttribute('prazo');
        parent::addAttribute('obs_empresa');
        parent::addAttribute('msg_cliente');
        parent::addAttribute('programacao_id');
        parent::addAttribute('origem_uf');
        parent::addAttribute('destino_uf');
        parent::addAttribute('produto_desc');
        parent::addAttribute('origem_estado_id');
        parent::addAttribute('destino_estado_id');
        parent::addAttribute('pagador_id');
    }

    public function get_cliente()
    {
        return SystemUser::find($this->cliente_id);
    }
    
    public function get_programacao()
    {
        return Programacao::find($this->programacao_id);
    }
    
    public function get_origem()
    {
        $cidade = new Cidade($this->origem_cidade_id);
        $estado = $cidade->estado;
        return $cidade->nome . '-' . $estado->uf;
    }
    
    public function get_destino()
    {
        $cidade = new Cidade($this->destino_cidade_id);
        $estado = $cidade->estado;
        return $cidade->nome . '-' . $estado->uf;
    }
    
   
    
    

}
