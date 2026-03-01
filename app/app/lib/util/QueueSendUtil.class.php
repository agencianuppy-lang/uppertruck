<?php
class QueueSendUtil
{
   
   
    
    public static function put($email, $assunto, $msg, $obj= null, $array = null)
    {    
     
     
         
        //se existe a tag {PARAR_ENVIO} ou se a msg não tiver conteúdo, não enviar - retornar false 
        if ( strpos($msg, '{PARAR_ENVIO}') OR trim($msg) == '')
        {
            return FALSE;
        }
     
     
        $arr = [];
        $array_from_obj = (array) $obj;
        
      
         foreach ( $obj as $key => $value)
         {
             $k = '{' . $key . '}';
             
             $pieces = explode('-', $value);
             $arr[$k] =  $value;
             
             if (count($pieces) == 3 )
             {
                 if ( checkdate( $pieces[1], $pieces[2], $pieces[0] ) )
                 {
                     $arr[$k] =  $pieces[2] . '/' . $pieces[1] . '/' . $pieces[0];
                 }
             }
             
             
             
             //new TMessage('info', $key . ' => ' . $value);
         }
        
        
        
        
        $arr['{valor_nf}'] = isset($obj->valor_nf) ? 'R$ ' . number_format($obj->valor_nf, 2, ',', '.') : '';
        $arr['{origem}'] = '';
        if ( isset($obj->origem_cidade_id) )
        {
            $cidade = new Cidade($obj->origem_cidade_id);
            $estado = $cidade->estado;
            $arr['{origem}'] = $cidade->nome . '-' . $estado->uf ;
        } 
        $arr['{destino}'] = '';
        if ( isset($obj->destino_cidade_id) )
        {
            $cidade = new Cidade($obj->destino_cidade_id);
            $estado = $cidade->estado;
            $arr['{destino}'] = $cidade->nome . '-' . $estado->uf ;
        } 
        $arr['{nome_cliente}'] = '';
        if (isset($obj->cliente_id) )
        {
            $cliente = new SystemUser($obj->cliente_id);
            $arr['{nome_cliente}'] = $cliente->name;
        } 
        $arr['{tipo_produto}'] = '';
        if (isset($obj->tipo_produto) )
        {
            $produto = new TipoProduto($obj->tipo_produto);
            $arr['{tipo_produto}'] = $produto->descricao;
        } 
        $arr['{embalagem}'] = '';
        if (isset($obj->embalagem_id) )
        {
            $embalagem = new Embalagem($obj->embalagem_id);
            $arr['{embalagem}'] = $embalagem->nome;
        } 
        $arr['{placa}'] = '';
        if (isset($obj->veiculo_id) )
        {
            $veiculo = new Veiculo($obj->veiculo_id);
            $arr['{placa}'] = $veiculo->placa;
        } 
        
        if ( isset($array) )
        {
        
            foreach ( $array as $key => $value)
            {
                $arr[$key] = $value;
            }
        }
        
        
        $msg_send = strtr($msg,$arr);
        
        $fila = new FilaEnvio; 
        $fila->email = $email;
        $fila->assunto = $assunto;
        $fila->msg = $msg_send;
        $fila->ocorrencia_erro = 0;
        $fila->store();              
        
        
        return true;
     
       
              
    }
    
    
    
}


