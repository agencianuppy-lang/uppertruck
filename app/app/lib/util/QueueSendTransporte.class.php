<?php
class QueueSendTransporte

{
   
    public static function put(Programacao $obj, $act, $date=null)
    {    
     
            
        //TTransaction::open('permission');
        $preferences = SystemPreference::getAllPreferences();
        //TTransaction::close();
        
        
        $motorista = new SystemUser($obj->motorista_id);
        $cliente   = new SystemUser($obj->cliente_id);
        
        $arr = ['{nome_motorista}' => $motorista->name,
                '{id_programacao}' => $obj->id,
                '{id_cotacao}' => $obj->cotacao_id,
                '{nome_cliente}' => $cliente->name];  
        
        $data_coleta  = $date ? $date : $obj->data_coleta;
        $data_entrega = $date ? $date : $obj->data_entrega;    
        
        $data_coleta  = preg_replace("/[^0-9]/", "", $data_coleta);   
        $data_coleta  = strlen($data_coleta)==8 ? substr($data_coleta, 6, 2) . '-' . substr($data_coleta, 4, 2) . '-' . substr($data_coleta, 0, 4) : ''; 
        $data_entrega = preg_replace("/[^0-9]/", "", $data_entrega);   
        $data_entrega = strlen($data_entrega)==8 ? substr($data_entrega, 6, 2) . '-' . substr($data_entrega, 4, 2) . '-' . substr($data_entrega, 0, 4) : ''; 
        
        
        
        $send = true;
        switch ($act) 
        {
            case 'agendar_coleta':
                $subject = 'Coleta agendada - Uppertruck';
                $arr['{status_programacao}'] = 'Coleta agendada para ' . $data_coleta;
                break;
            case 'canc_coleta':
                $subject = 'Agendamento de coleta cancelado - Uppertruck';
                $arr['{status_programacao}'] = 'O agendamento da coleta marcado para ' . $data_coleta . ' foi cancelado.';
                break;
            case 'registrar_coleta':
                $subject = 'Coleta efetuada - em transporte - Uppertruck';
                $arr['{status_programacao}'] = 'Coleta efetuada em ' . $data_coleta . '. Em transporte.';
                break;
            case 'registrar_entrega':
                $subject = 'Entrega efetuada - Uppertruck';
                $arr['{status_programacao}'] = 'Entrega efetuada em ' . $data_entrega;
                break;
            default:
                $send = false;
                break;
        }
        
        
        if ( !$send )
        {
            throw new Exception('Parâmetro de tipo de ação/assunto para a fila de envio de emails inválido.');
        }
        
        if ($preferences['send_msg_motorista'])
        {
            $msg = $preferences['msg_programacao_status_motorista'];
            $email = trim($motorista->email);
            QueueSendUtil::put($email, $subject, $msg, $obj, $arr);
        }
        if ($preferences['send_msg_cliente'])
        {
            $msg = $preferences['msg_programacao_status_cliente'];
            $email = trim($cliente->email);
            QueueSendUtil::put($email, $subject, $msg, $obj, $arr);
        }
        if ($preferences['send_msg_empresa_transporte'])
        {
            $msg = $preferences['msg_programacao_status_empresa'];
            $email = trim($preferences['mail_destiny1']);
            QueueSendUtil::put($email, $subject, $msg, $obj, $arr);
        }                            
        
        return true;
     
       
              
    }
    
    
}


