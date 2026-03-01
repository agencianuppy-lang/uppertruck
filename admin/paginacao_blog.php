<div class="slider-area creative-slider-area bg-color-grey">
    <div class="axil-slide slider-style-3">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6 order-2 order-lg-1">
                    <div class="slider-inner slick-nav-avtivation-new">


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
    if ($server == 'localhost') {
        $server = $_SERVER['SERVER_NAME'].'/'.$nome_da_pasta;
    } else {
        $server = $_SERVER['SERVER_NAME'];
    }

    //sanitize post value
    if(isset($_POST["page"])) {
        $page_number = filter_var($_POST["page"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH);
        if(!is_numeric($page_number)) {
            die('Invalid page number!');
        }
    } else {
        $page_number = 1;
    }

    //get current starting point of records
    $position = (($page_number-1) * $item_per_page);

    if ($_POST['categoria'] != '0') {
        $where = "WHERE categoria = '".$_POST['categoria']."'";
    } else {
        $where = "";
    }

    $total = 1;
    $noticias = $class->Select("id, titulo, img, artigo, hora_postagem, slug", "blog", "$where", "ORDER BY id DESC LIMIT $position, $item_per_page");  

    while ($row = $noticias->fetch(PDO::FETCH_OBJ)) {  
        $fData = new DateTime($row->hora_postagem);
        $horaF = $fData->format('d/m/Y H:i:s');  
        $imgN = "https://$server/admin/_blog/".$row->img;

        if ($total <= 3) {
?>

                        <div class="content-block post-medium post-medium-border">

                            <div class="post-thumbnail">
                                <a href="https://<?= $server ?>/blog/<?= $row->slug ?>">
                                    <div class="card card-for-hover" id="card1" data-img-src="<?= $imgN ?>">
                                        <img src="<?= $imgN ?>" alt="Imagem 1">
                                    </div>
                                </a>
                            </div>
                            <div class="post-content title" data-image="<?= $imgN ?>">
                                <div class="post-cat">
                                    <div class="post-cat-list">
                                        <a href="#">Artigo</a>
                                    </div>
                                </div>
                                <h4 class="title"><a href="https://<?= $server ?>/blog/<?= $row->slug ?>">
                                        <?= $class->Limita($row->titulo, 71); ?>
                                    </a></h4>
                                <div class="post-button">
                                    <a class="axil-button button-rounded color-secondary-alt"
                                        href="https://<?= $server ?>/blog/<?= $row->slug ?>">Saber mais</a>
                                </div>
                            </div>
                        </div>

                        <!-- End Banner Area -->


                        <?php
            if ($total == 3) {
?>


                    </div>

                </div>

                <div class="col-lg-6 order-1 order-lg-2">
                    <div class="thumbnail-wrapper slick-for-avtivation-new">

                        <div class="thumbnail bbq xxx">
                            <a href="#" class="bbq image-container">
                                <img class="h-100" id="delta" src="<?= $imgN ?>" alt="Imagem Delta">
                            </a>
                        </div>



                    </div>
                </div>

            </div>
        </div>
    </div>


    <!-- Start Post List Wrapper  -->
    <div class="axil-post-list-area post-listview-visible-color axil-section-gap bg-color-white">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-xl-8">






                    <?php
            }
        } else {
?>



                    <style>
                        .hover-flip-item span:after,
                        .hover-flip-item span:before {
                            content: attr(data-text);
                            display: block;
                            position: absolute;
                            color: #ffc107;
                        }

                        #delta {
                            object-fit: cover;
                        }
                    </style>


                    <!-- Start Post List  -->
                    <div class="content-block post-list-view is-active mt--30">
                        <div class="post-thumbnail">
                            <a href="https://<?= $server ?>/blog/<?= $row->slug ?>">
                                <img src="<?= $imgN ?>" alt="Post Images">
                            </a>
                        </div>
                        <div class="post-content">
                            <div class="post-cat">
                                <div class="post-cat-list">
                                    <a class="hover-flip-item-wrapper" href="#">
                                        <span class="hover-flip-item">
                                            <span data-text="Tecnologia">Tecnologia</span>
                                        </span>
                                    </a>
                                </div>
                            </div>
                            <h4 class="title">
                                <a href="https://<?= $server ?>/blog/<?= $row->slug ?>">
                                    <?= $class->Limita($row->titulo, 72); ?>
                                </a>
                            </h4>
                            <div class="post-meta-wrapper">
                                <div class="post-meta">
                                    <div class="content">
                                        <h6 class="post-author-name">
                                            <a class="hover-flip-item-wrapper" href="">
                                                <span class="hover-flip-item">
                                                    <span data-text="Uppertruck">UPPERTRUCK EXPRESS</span>
                                                </span>
                                            </a>
                                        </h6>
                                        <ul class="post-meta-list">
                                            <li>2024</li>
                                        </ul>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>






                    <?php
        }
        $total++;
    }
?>
                </div>



                <?php include('../includes/sidebar.php') ?>



            </div>
        </div>