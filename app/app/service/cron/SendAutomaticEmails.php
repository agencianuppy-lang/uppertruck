<?php
class SendAutomaticEmails
{
    
    public static function send( $request )
    {
         TTransaction::open('uppertruck');
         
         $criteria = new TCriteria;
         $criteria->add(new TFilter('ocorrencia_erro', '=', 0)); 
         $repository = new TRepository('FilaEnvio'); 
         $fila = $repository->load($criteria);
         
         foreach ($fila as $el) 
         { 
            try
            {
                MailService::send( $el->email, $el->assunto, $el->msg, 'html' );
                $el->delete();
            }
            catch(Exception $e)
            {
                $el->erro = $e->getMessage();
                $el->registro_erro = date("Y-m-d H:i:s");
                $el->ocorrencia_erro = 1;
                $el->store();
            } 
            //echo $el->email . ' - ' . $el->assunto.'<br>'; 
         }
         TTransaction::close();
        //return $user;
        //echo 'aaaaaaaaaaaaa';
    }
}
