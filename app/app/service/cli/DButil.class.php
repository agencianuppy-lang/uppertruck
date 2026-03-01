<?php
class DButil
{
    
    // exemplo de uso 
    // php -f cmd.php "class=DButil&method=into&arq=produtos.txt&col=descricao&model=TipoProduto"
    // arquivo na raiz
    public static function into( $request )
    {
         TTransaction::open('uppertruck');
         $path_arq = $request['arq'];
         $model    = $request['model'];
         $col      = $request['col'];
         $lines = file($path_arq);
         foreach ( $lines as $line )
         {
         
             $data = trim($line);
             if ( strlen($data) > 0)
             {
                 $obj = new $model;
                 $obj->$col = $data;
                 $obj->store();
             }
            
             //echo $line;
         }
         TTransaction::close();
    }
}
