<?php
// Chave do banco e limitacao de itens por pagina
include("_class/key.php");
include("conf_paginacao_blog.php");

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
  
  if ($_POST['categoria'] != '0'){
    $where = "WHERE categoria = '".$_POST['categoria']."'";
  }else{
    $where = "";
  }
  

  $total = 1;
  $noticias = $class->Select(  "id, titulo, img, artigo, hora_postagem", "blog", "$where", "ORDER BY id DESC LIMIT $position, $item_per_page"  );  
  
  while  ($row = $noticias->fetch(PDO::FETCH_OBJ)){  
    /* Formata a data da noticia */  
    $fData = new DateTime($row->hora_postagem);
    $horaF = $fData->format('d/m/Y H:i:s');  

    /*Imagem da noticia*/
    $imgN = "https://$server/admin/_blog/".$row->img;

    if ($total <= 0){
?>

<div class="row">

  <div style="background: white;box-shadow: 0px 0px 3px 0px #dadada; padding:0;    position: relative;"
    class="col-md-12">
    <div class="row">


      <div class="blog-ggl col-md-5">
        <a style="height: 100%;" href="https://<?= $server ?>/blog/<?= $row->id ?>">
          <img style="height: 18rem;width: 100%;object-fit: cover;" src="<?= $imgN ?>" alt="">
        </a>
      </div>


      <div style="float: right;" class="pd-ttr col-md-7">
        <h4 class="jkkik_">
          <strong>
            <a style="color: #1e2544; text-decoration: none; font-family: " Poppins", sans-serif; " href="
              https://<?=$server ?>/blog/
              <?= $row->id ?>">
              <?= $class->Limita($row->titulo, 72); ?>
            </a>
          </strong>
        </h4>
        <p class="texto-blog">
          <?= $class->Limita($row->artigo, 200); ?>
        </p>
      </div>

    </div>
  </div>

  <?php
  if ($total == 1){
?>

  <div class="hidden-xs col-md-12">
    <br>
  </div>

  <?php
  }
}else{
?>
  <div class="col-lg-4 col-md-4 col-sm-6 mb-4 col-xs-12">
    <div class="card text-center">
      <a href="https://<?= $server ?>/blog/<?= $row->id ?>">
        <img class="card-img-top" src="<?= $imgN ?>">
      </a>
      <div class="card-pf rounded card-block">
        <h4 class="jkkik_">
          <strong>
            <a style="color: #3e3e3e; text-decoration: none; font-family: " Poppins", sans-serif;height: 80px;"
              href="https://<?= $server ?>/blog/<?= $row->id ?>">
              <?= $class->Limita($row->titulo, 72); ?>
            </a>
          </strong>
        </h4>
        <p class="card-text espaco-topico">
          <?= $class->Limita($row->artigo, 100); ?>
        </p>
      </div>
    </div>
  </div>
  <?php
  }
 $total++;
 }
?>

</div>