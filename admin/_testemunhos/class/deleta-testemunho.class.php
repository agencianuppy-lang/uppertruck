<?php 
	// FAZ A CONEXAO COM O BANCO
	include('../../_class/key.php');

	if($_POST){

		function delTree($dir) { 
			$files = array_diff(scandir($dir), array('.','..')); 
			foreach ($files as $file) { 
			  (is_dir("$dir/$file")) ? delTree("$dir/$file") : unlink("$dir/$file"); 
			} 
			return rmdir($dir); 
		}
		
		$id = $_POST['idTst'];

		$cam = dirname(dirname(__FILE__)).'/imagens/'.$id.'/';
		$uploaddir = str_replace('\\', '/', $cam);

		delTree($uploaddir);

		$del = $pdo->prepare("DELETE FROM testemunhos WHERE id='$id'");
		$del->execute();

		echo "ok";
	}else{
		echo "erro";
		header("location: https://$server/");
	}
?>