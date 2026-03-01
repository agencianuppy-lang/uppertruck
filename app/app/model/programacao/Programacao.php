<?php
class Programacao extends TRecord
{
    const TABLENAME = 'programacao';
    const PRIMARYKEY= 'id';
    const IDPOLICY =  'serial'; // {max, serial}
    
    
    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('status_transporte_id');
        parent::addAttribute('data_coleta');
        parent::addAttribute('data_entrega');
        parent::addAttribute('km');
        parent::addAttribute('status_pgmto_id');
        parent::addAttribute('tipo_pgmto_id');
        parent::addAttribute('data_vencimento');
        parent::addAttribute('data_pagamento');
        parent::addAttribute('cte');
        parent::addAttribute('cliente_id');
        parent::addAttribute('num_nf');
        parent::addAttribute('veiculo_id');
        parent::addAttribute('motorista_id');
        parent::addAttribute('embalagem_id');
        parent::addAttribute('origem_cidade_id');
        parent::addAttribute('destino_cidade_id');
        parent::addAttribute('kg');
        parent::addAttribute('m3');
        parent::addAttribute('volumes');
        parent::addAttribute('tipo_produto');
        parent::addAttribute('valor_nf');
        parent::addAttribute('valor_faturado');
        parent::addAttribute('valor_motorista');
        parent::addAttribute('valor_icms');
        parent::addAttribute('valor_seguro');
        parent::addAttribute('valor_comissao');
        parent::addAttribute('valor_gris');
        parent::addAttribute('valor_simples');
        parent::addAttribute('outros_descontos');
        parent::addAttribute('fat_liquido');
        parent::addAttribute('cotacao_id');
        parent::addAttribute('obs');
        parent::addAttribute('avaliacao');
        parent::addAttribute('data_avaliacao');
        parent::addAttribute('tipo_avaliacao');   //1 cliente   0 sistema
        parent::addAttribute('avaliacao_pendente'); //NULL ou 0 Não   1 Sim        
        parent::addAttribute('obs_avaliacao');
        parent::addAttribute('canhoto_entrega');
        parent::addAttribute('pagador_id');
    }

    public function get_cliente()
    {
        return SystemUser::find($this->cliente_id);
    }
    public function get_motorista()
    {
        return SystemUser::find($this->motorista_id);
    }
    public function get_veiculo()
    {
        return SystemUser::find($this->veiculo_id);
    }
    public function get_status_transporte()
    {
        return StatusTransporte::find($this->status_transporte_id);
    }
    public function get_status_pgmto()
    {
        return StatusPgmto::find($this->status_pgmto_id);
    }
    public function get_tipo_pgmto()
    {
        return TipoPgmto::find($this->tipo_pgmto_id);
    }
    public function get_embalagem()
    {
        return Embalagem::find($this->embalagem_id);
    }
    public function get_cotacao()
    {
        return Cotacao::find($this->cotacao_id);
    }
    
    
    
    

}