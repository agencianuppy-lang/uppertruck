<?php include('admin/controler_site.php'); ?>
<?php
   error_reporting(0);
   
   ?>
<?php


   $slug = $_GET['blog'];
   
   $noticia = $class->Select("*", "blog", "WHERE slug = '$slug'", "");
   
   $row = $noticia->fetch(PDO::FETCH_OBJ);

   $title = $row->title;
   
   $data = $row->hora_postagem;

   $imgNot = "https://$server/admin/_blog/".$row->img;
   
   ?>
<!DOCTYPE html>

<!doctype html>
<html class="no-js" lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>
        <?= $row->titulo ?>
    </title>
    <meta name='robots' content='index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1' />
    <meta charset="UTF-8">
    <meta property="og:type" content="article" />
    <meta property="og:title" content="<?= $row->titulo ?>" />
    <meta property="og:site_name" content="Uppertruck" />
    <meta property="og:image" content="<?= $imgNot ?>" />

    <!-- Open Graph (para compartilhamento em redes sociais como Facebook e WhatsApp) -->
    <meta property="og:image" content="<?= $imgNot ?>" />

    <!-- Twitter Cards (para compartilhamento no Twitter) -->
    <meta name="twitter:image" content="<?= $imgNot ?>" />
    <meta name="twitter:card" content="summary_large_image" />

    <!-- Meta Tag padrão -->
    <link rel="image_src" href="<?= $imgNot ?>" />


    <!-- Pinterest Rich Pins -->
    <meta property="og:image" content="<?= $imgNot ?>" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="<?= $row->titulo ?>" />
    <meta property="og:description" content="<?= $row->description ?>" />

    <!-- MS Tile Image (para Windows) -->
    <meta name="msapplication-TileImage" content="<?= $imgNot ?>" />


    <meta property="og:image:width" content="876" />
    <meta property="og:image:height" content="586" />
    <meta property="og:description" content="<?= $row->description ?>" />
    <meta property="og:url" content="https://uppertruck.com/blog/<?= $slug ?>" />
    <meta name="description" content="<?= $row->description ?>">
    <meta name="keywords" content="<?= $row->keywords ?>">
    <link rel="canonical" href="https://uppertruck.com.com/blog/<?= $slug ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="shortcut icon" type="image/x-icon" href="https://uppertruck.com/assets/img/favicon.png">

    <!-- CSS
    ============================================ -->

    <link rel="stylesheet" href="../assets/css/preloader.css">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/meanmenu.css">
    <link rel="stylesheet" href="../assets/css/animate.min.css">
    <link rel="stylesheet" href="../assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="../assets/css/backToTop.css">
    <link rel="stylesheet" href="../assets/css/magnific-popup.css">
    <link rel="stylesheet" href="../assets/css/ui-range-slider.css">
    <link rel="stylesheet" href="../assets/css/nice-select.css">
    <link rel="stylesheet" href="../assets/css/fontAwesome5Pro.css">
    <link rel="stylesheet" href="../assets/css/flaticon.css">
    <link rel="stylesheet" href="../assets/css/default.css">
    <link rel="stylesheet" href="../assets/css/style.css">



    <!-- Bootstrap CSS -->

    <link rel="stylesheet" href="../assets2/css/vendor/bootstrap.min.css">
    <link rel="stylesheet" href="../assets2/css/vendor/font-awesome.css">
    <link rel="stylesheet" href="../assets2/css/vendor/slick.css">
    <link rel="stylesheet" href="../assets2/css/vendor/slick-theme.css">
    <link rel="stylesheet" href="../assets2/css/vendor/base.css">
    <link rel="stylesheet" href="../assets2/css/plugins/plugins.css">
    <link rel="stylesheet" href="../assets2/css/style.css">




</head>

<style>
    blockquote p {
        margin-bottom: 0;
        font-size: 17px;
        line-height: 1.4;
        color: #0c0c0c;
        font-family: roboto, sans-serif;
        font-weight: 200;
        font-style: italic;
    }

    .navbar-brand img {
        margin-top: 10px;
    }

    h1,
    .h1 {
        text-transform: inherit;
    }

    li {
        list-style: disc;
    }

    h2 {
        text-transform: none;
    }

    .content-block .post-thumbnail {
        background: black;
        border-radius: 0px 0px 55px 55px !important;
    }

    .banner-single-post.post-formate .content-block .post-thumbnail img {
        border-radius: 0px 0px 55px 55px !important;
    }

    .banner-single-post.post-formate .content-block .post-thumbnail img {
        border-radius: 0px 0px 55px 55px !important;
    }

    h1 strong {
        color: black;
    }

    h3 strong {
        color: black;
    }

    h2 strong {
        color: black;
    }

    h4 strong {
        color: black;
    }

    strong {
        color: #1e1e1e;
    }

    .banner-single-post.post-formate .content-block .post-thumbnail img {
        border-radius: 0 0 10px 10px;
        width: 100%;
    }

    .axil-header.header-dark {
        background: #ffffff;
        border-bottom: 1px solid #e7e7e7;
    }

    .axil-header .logo a img {
        max-height: 66px;
    }

    .axil-header .header-search .header-search-form .axil-search.form-group input {
        min-width: 245px;
        height: 40px;
    }

    .axil-header.header-dark .axil-search.form-group .search-button i {
        color: #e6265c;
    }

    .axil-search.form-group .search-button i {
        font-weight: 500;
        font-size: 16px;
    }

    .mainmenu-nav ul.mainmenu>li>a::after {
        background: #ff3870;
    }

    .post-content .post-cat .post-cat-list a:hover,
    .mainmenu-nav ul.mainmenu>li>a:hover,
    a.axil-link-button {
        color: #e6265c;
    }

    .active {
        color: #e6265c;
        border-radius: inherit;
        border-bottom: 3px solid #ff3870;
    }

    b {
        color: #e6265c;
    }

    .banner-single-post.post-formate .content-block .post-thumbnail img {
        border-radius: 0 0 10px 10px;
        width: 100%;
        height: 567px;
        object-fit: cover;
    }

    .content-block .post-thumbnail {
        background: black;
    }

    .banner-single-post.post-formate .content-block .post-thumbnail img {
        opacity: 0.4 !important;
    }

    b {
        color: #000000;
    }


    .banner .adsbygoogle {
        display: none !important;
    }

    p {
        margin: 0 0 5px;
    }


    @media(max-width:748px) {
        .banner-single-post.post-formate.post-standard .post-content .title {
            font-size: 3rem;
            padding-right: 0;
            line-height: 1.2;
        }

        .banner-single-post.post-formate .content-block .post-thumbnail img {
            border-radius: 0 0 10px 10px;
            width: 100%;
            height: 312px;
            object-fit: cover;
        }

        .navbar {

            height: 75px;
        }

        .navbar-brand img {
            margin-top: -8px;
        }

        .navbar-collapse {
            flex-basis: 100%;
            z-index: 9;
            background: black;
            margin-top: 43px;
            align-items: center;
            width: 122% !important;
            margin-left: -11%;
        }

        .botao {
            width: 50%;
            margin-left: 25%;
        }

        .footer1-widget3 {
            display: none;
        }


    }

    h3,
    .h3 {
        font-size: 2rem;
        line-height: 1.14;
        margin-top: 5rem;
    }
</style>



<body>
    <div class="main-wrapper">


        <!-- Start Header -->

        <?php include('includes/header-blog.php') ?>







        <!-- Start Banner Area -->
        <div class="banner banner-single-post post-formate post-standard alignwide adsbygoogle-noablate"
            data-no-ad="true">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <!-- Start Single Slide  -->
                        <div class="content-block">
                            <!-- Start Post Thumbnail  -->
                            <div class="post-thumbnail">
                                <img src="<?= $imgNot ?>" alt="Post Images">
                            </div>
                            <!-- End Post Thumbnail  -->
                            <!-- Start Post Content  -->
                            <div class="post-content">
                                <div class="post-cat">
                                    <div class="post-cat-list">
                                        <a class="hover-flip-item-wrapper" href="#">
                                            <span class="hover-flip-item">
                                                <span data-text="Dicas">Dicas</span>
                                            </span>
                                        </a>
                                    </div>
                                </div>





                                <h1 class="title">
                                    <?= $row->titulo ?>
                                </h1>
                                <!-- Post Meta  -->
                                <div class="post-meta-wrapper">
                                    <div class="post-meta">



                                    </div>

                                </div>
                            </div>
                            <!-- End Post Content  -->
                        </div>
                        <!-- End Single Slide  -->
                    </div>
                </div>
            </div>
        </div>
        <!-- End Banner Area -->

        <!-- Start Post Single Wrapper  -->
        <div class="post-single-wrapper axil-section-gap bg-color-white">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 mx-auto">

                        <div class="axil-post-details">


                            <?= $row->artigo ?>




                        </div>
                    </div>




                </div>
            </div>
        </div>
        <!-- End Post Single Wrapper  -->



        <?php include('includes/footer.php') ?>




        <!-- Start Back To Top  -->
        <a id="backto-top"></a>
        <!-- End Back To Top  -->

    </div>

    <!-- JS
============================================ -->
    <!-- Modernizer JS -->

    <script src="../assets/js/vendor/jquery-3.6.0.min.js"></script>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/meanmenu.js"></script>

</body>



</html>