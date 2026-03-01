<?php
	// Posts
	$dir = $_POST['diretorio'];
	$pasta = $_POST['nome_proj'];

	// Caminho total
	$caminho = $dir.'/'.$pasta;

	// Arquivo a ser copiado
	$copia = $dir.'/painel_adm/';

	// Git
	$git = $dir.'/'.$pasta.'/.git';

	// Verifica se o diretorio já existe
	if (!is_dir($caminho)) {
       // Inicia o processo de cópia da pasta
		function recurse_copy($copia,$caminho) { 
		    $dir = opendir($copia); 
		    @mkdir($caminho); 
		    while(false !== ( $file = readdir($dir)) ) { 
		        if (( $file != '.' ) && ( $file != '..' )) { 
		            if ( is_dir($copia . '/' . $file) ) { 
		                recurse_copy($copia . '/' . $file,$caminho . '/' . $file); 
		            }
		            else { 
		                copy($copia . '/' . $file,$caminho . '/' . $file); 
		            } 
		        } 
		    } 
		    closedir($dir); 
		}

		recurse_copy($copia,$caminho);

		// Exclui a pasta do git

		function delTree($git) { 
			$files = array_diff(scandir($git), array('.','..')); 
			foreach ($files as $file) { 
			  (is_dir("$git/$file")) ? delTree("$git/$file") : unlink("$git/$file"); 
			} 
			return rmdir($git); 
		}


		// Executa o método de deletar o diretorio
		delTree($git);


		echo "ok";
	}else{
		echo "ja_existe";
	}


		

?>