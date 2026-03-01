<?php 
	//classe que efetua as funcoes do crud
	class Action{

		// efetua o select e tras as informacoes na pagina followup.
		function Select($selecao,$tabela,$where,$limite){
			
			//conexao com o banco
			include ('key.php');

			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			//query de select	
			$sql = $pdo->prepare("SELECT $selecao FROM $tabela $where $limite");
			
			// Executa
			$sql->execute();
			//retorna o sql
			return $sql;
		}

		function SelectEsp($selecao,$tabela,$where){
			
			//conexao com o banco
			include ('key.php');

			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			//query de select	
			$sql = $pdo->prepare("SELECT $selecao FROM $tabela $where");
			
			// Executa
			$sql->execute();

			// Faz um Array
			$array = $sql->fetch(PDO::FETCH_OBJ);

			// Retorna a informacao desejada
			$info = $array->$selecao;

			//retorna o sql
			return $info;
		}

		function SelectQtd($selecao,$tabela,$where){
			
			//conexao com o banco
			include ('key.php');

			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			//query de select	
			$sql = $pdo->prepare("SELECT $selecao FROM $tabela $where");
			
			// Executa
			$sql->execute();

			// Qtd retornada
			$qtd = $sql->rowCount();

			//retorna o sql
			return $qtd;
		}


		public function Update($tabela, $itens, $where){
			//conexao com o banco
			include ('key.php');

			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			//query de select	
			$sql = $pdo->prepare("UPDATE $tabela SET $itens $where");
			
			// Executa
			$sql->execute();
		}


		function Insert($tabela, $col, $itens){
			//conexao com o banco
			include ('key.php');

			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			//query de select	
			$sql = $pdo->prepare("INSERT INTO $tabela ($col) VALUES ($itens)");
			
			// Executa
			$sql->execute();
		}


		function Limita($texto, $ate){
			$tamanho = strlen($texto);
			$rets = "";

			if ($tamanho > $ate){
				$rets = "...";
			}

			$txt_limit = substr($texto, 0, $ate).$rets;
			return $txt_limit;
		}

		function tempo_atras($timestamp) {
		   $timestamp = (int) $timestamp;
		   $difference = time() - $timestamp;
		   $periods = array('segundos', 'minutos', 'horas', 'dias', 'semanas', 'meses', 'anos', 'decadas');
		   $lengths = array('60','60','24','7','4.35','12','10');

		   for($j = 0; $difference >= $lengths[$j]; $j++)
		   {
		       $difference /= $lengths[$j];
		   }

		   $difference = round($difference);

		   if($difference != 1)
		   {
		           $periods[$j] .= 's';
		   }

		   return $difference . ' ' . $periods[$j] . ' atrás';
		}

		


		function ago($dataantiga){
	
			// Transformar a data antiga em timestamp
			$dataantiga = str_replace(' ', '/', $dataantiga);
			$dataantiga = explode ('/', str_replace(':', '/', $dataantiga));
	
	
			$dataantiga = mktime($dataantiga[3], $dataantiga[4],$dataantiga[5],$dataantiga[1],$dataantiga[0],$dataantiga[2]);

			$periods = array("segundo", "minuto", "hora", "dia", "semana", "mês", "ano", "decada");
			$lengths = array("60","60","24","7","4.35","12","10");

			$now = time();

			$difference     = $now - $dataantiga;

			for($j = 0; $difference >= $lengths[$j] && $j < count($lengths)-1; $j++) {
			    $difference /= $lengths[$j];
			}

			$difference = round($difference);

			if($difference != 1) {
			 if ($periods[$j] == "mês") {
				$periods[$j] = "meses";
			 } else {
			     	$periods[$j] .= "s";
			 }
			}

			return "$difference {$periods[$j]} atrás";
		}


		function NomeMes($mes){
			// NOME DOS MESES
			$nomeMes = "";
			($mes=='01') ? $nomeMes="JAN" : "";
			($mes=='02') ? $nomeMes="FEV" : "";
			($mes=='03') ? $nomeMes="MAR" : "";
			($mes=='04') ? $nomeMes="ABR" : "";
			($mes=='05') ? $nomeMes="MAI" : "";
			($mes=='06') ? $nomeMes="JUN" : "";
			($mes=='07') ? $nomeMes="JUL" : "";
			($mes=='08') ? $nomeMes="AGO" : "";
			($mes=='09') ? $nomeMes="SET" : "";
			($mes=='10') ? $nomeMes="OUT" : "";
			($mes=='11') ? $nomeMes="NOV" : "";
			($mes=='12') ? $nomeMes="DEZ" : "";

			return $nomeMes;
		}

		function Mes($mes){
			// NOME DOS MESES
			$nomeMes = "";
			($mes=='01') ? $nomeMes="Janeiro" : "";
			($mes=='02') ? $nomeMes="Fevereiro" : "";
			($mes=='03') ? $nomeMes="Março" : "";
			($mes=='04') ? $nomeMes="Abril" : "";
			($mes=='05') ? $nomeMes="Maio" : "";
			($mes=='06') ? $nomeMes="Junho" : "";
			($mes=='07') ? $nomeMes="Julho" : "";
			($mes=='08') ? $nomeMes="Agosto" : "";
			($mes=='09') ? $nomeMes="Setembro" : "";
			($mes=='10') ? $nomeMes="Outubro" : "";
			($mes=='11') ? $nomeMes="Novembro" : "";
			($mes=='12') ? $nomeMes="Dezembro" : "";

			return $nomeMes;
		}

		function MesAbr($mes){
			// NOME DOS MESES
			$nomeMes = "";
			($mes=='01') ? $nomeMes="Jan" : "";
			($mes=='02') ? $nomeMes="Fev" : "";
			($mes=='03') ? $nomeMes="Mar" : "";
			($mes=='04') ? $nomeMes="Abr" : "";
			($mes=='05') ? $nomeMes="Mai" : "";
			($mes=='06') ? $nomeMes="Jun" : "";
			($mes=='07') ? $nomeMes="Jul" : "";
			($mes=='08') ? $nomeMes="Ago" : "";
			($mes=='09') ? $nomeMes="Set" : "";
			($mes=='10') ? $nomeMes="Out" : "";
			($mes=='11') ? $nomeMes="Nov" : "";
			($mes=='12') ? $nomeMes="Dez" : "";

			return $nomeMes;
		}


		function DataNoticia($dataH){
			$sep = explode(" ", $dataH);

			// Data
			$data = $sep[0];
			$sepD = explode("-", $data);
			$dia = $sepD[2];
			$mes = $sepD[1];
			$ano = $sepD[0];

			$Nmes = $this->NomeMes($mes);

			// Hora
			$hora = $sep[1];
			$sepH = explode(":", $hora);
			$hor = $sepH[0];
			$min = $sepH[1];
			$seg = $sepH[2];

			$string = $dia.' '.$Nmes.' '.$ano.', '.$hor.'h'.$min;
			return $string;
		}

		function DiaSemana($data){  

	   	// Traz o dia da semana para qualquer data informada
	    $dia =  substr($data,0,2);
	    $mes =  substr($data,3,2);
	    $ano =  substr($data,6,9);

	    $diasemana = date("w", mktime(0,0,0,$mes,$dia,$ano) );

	    switch($diasemana){            
	       case"0": 
	          $diasemana = "Domingo";    
	          break;

	       case"1": 
	          $diasemana = "Segunda-Feira"; 
	          break;    

	       case"2": 
	          $diasemana = "Terça-Feira";   
	          break;  

	       case"3": 
	          $diasemana = "Quarta-Feira";  
	          break;  

	       case"4": 
	          $diasemana = "Quinta-Feira";  
	          break;  

	       case"5": 
	          $diasemana = "Sexta-Feira";   
	          break;   
	                   
	       case"6": 
	          $diasemana = "Sábado";     
	          break;          
	    }
	    return $diasemana;
	   }

	   function BuscaOsDiaData($data){
			//conexao com o banco
			include ('key.php');

			$dataHoje = date('Y-m-d');

			$sql = $pdo->prepare("SELECT * FROM agenda WHERE data = ?");
			$sql->bindParam(1, $data);
			$sql->execute();
			return $sql;
		}

	}
 ?>