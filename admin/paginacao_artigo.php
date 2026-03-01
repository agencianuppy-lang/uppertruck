<?php
// Chave do banco e limitacao de itens por pagina
include("_class/key.php");
include("conf_paginacao_artigo.php");

// Modelos de querie
include('_class/model.class.php');
$class = new Action;

include('_class/caminho_controler.php');
// Verifica em qual servidor está a aplicação
$server = $_SERVER['SERVER_NAME'];
if ($server == 'localhost'){
	$server = $_SERVER['SERVER_NAME'].'/'.$nome_da_pasta;
}else{
	$server = $_SERVER['SERVER_NAME'];
}

//sanitize post value
if(isset($_POST["page"])){
	$page_number = filter_var($_POST["page"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH);
	if(!is_numeric($page_number)){die('Invalid page number!');} //incase of invalid page number
}else{
	$page_number = 1;
}

//get current starting point of records
$position = (($page_number-1) * $item_per_page);


  $total = 1;
  $noticias = $class->Select(  "id, titulo, img, artigo, hora_postagem", "artigos", "ORDER BY id DESC", "LIMIT $position, $item_per_page"  );  
  while  ($row = $noticias->fetch(PDO::FETCH_OBJ)){  
    /* Formata a data da noticia */  
    $fData = new DateTime($row->hora_postagem);
    $horaF = $fData->format('d/m/Y H:i:s');  

    /*Imagem da noticia*/
    $imgN = "https://$server/admin/_artigos/".$row->img;

    /*Verifica o total de noticias para mudar a estrutura*/
    if($total > 2){ $col="4"; } else { $col="6"; }

    /*tempo atras*/
    $time = strtotime($horaF);
?>
<!-- Estrutura HTML das noticias -->
<div id="item_<?= $row->id ?>" class="col-lg-<?= $col ?> card">
   <div class="card">
      <a href="https://<?= $server ?>/artigo/<?= $row->id ?>">
         <img style="height:400px" class="img-fluid" src="<?= $imgN ?>" alt="">
      </a>
      <div class="card-body2">
         <div class="Novo-title">
            <a href="https://<?= $server ?>/artigo/<?= $row->id ?>">
               <h2 class=" title-small">
                  <?= $class->Limita($row->titulo, 100); ?>
               </h2>
            </a>
         </div>

         <?php 
             if ($total <= 2){
          ?>
         <p class="card-text">
            <?= $class->Limita($row->artigo, 100); ?>
         </p>
         <?php
             }
          ?>

         <p class="card-text">
            <small class="text-time">
               <em>
                  <?= $class->ago($horaF); ?>
               </em>
            </small>
         </p>
      </div>
   </div>
</div>
<?php
 $total++;
 }
?>