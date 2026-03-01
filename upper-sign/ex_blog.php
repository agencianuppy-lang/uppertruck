<?php include('admin/controler_site.php'); ?>

<?php 
  include('admin/conf_paginacao_blog.php');
  try {
      $results = $class->Select("COUNT(*) AS total", "blog", "", "");
      $results->execute();
      $arr = $results->fetch(PDO::FETCH_OBJ);
      $get_total_rows = $arr->total; // total records
      $pages = ceil($get_total_rows / $item_per_page); // break total records into pages
  } catch (PDOException $e) {
      echo "Erro: " . $e->getMessage();
  }
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>

  <meta charset="UTF-8">
  <meta name="theme-color" content="#00aa40" />

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Grupo AGS - Perfilados</title>

  <!-- JS Libraries -->

  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/css?family=Poppins:400,600|Roboto:400,400i,500" rel="stylesheet">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


  <link rel="icon" type="image/png" href="img/fav.png" />
  <script src="https://kit.fontawesome.com/ec0f95ce9f.js" crossorigin="anonymous"></script>
  <script src="//code.jquery.com/jquery-1.10.2.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>




  <!-- SEO Meta Tags -->
  <meta name="description"
    content="Os perfilados da Grupo AGS são estruturas metálicas essenciais para a organização, proteção e condução de cabos elétricos em instalações industriais, comerciais e residenciais, garantindo segurança e durabilidade.">
  <meta name="keywords"
    content="perfilados, instalação elétrica, organização de cabos, segurança, perfilados de aço, suporte de cabos, Grupo AGS">
  <meta name="author" content="Grupo AGS">

  <!-- Open Graph Meta Tags -->
  <meta property="og:title" content="Grupo AGS - Perfilados">
  <meta property="og:description"
    content="Os perfilados da Grupo AGS garantem a organização e proteção dos cabos elétricos em instalações industriais, comerciais e residenciais, proporcionando maior segurança e facilidade de manutenção.">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Animate.css -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

  <!-- AOS CSS (Animações ao Scroll) -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">

  <!-- Custom CSS -->
  <link rel="stylesheet" href="https://grupoags.ind.br/css/style.css">
  <!-- Font Awesome CDN -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">


  <!-- Scroll Navbar -->
  <script type="text/javascript">
    $(window).scroll(function () {
      if ($(this).scrollTop() > 50) {
        $('.navbar-trans').addClass('afterscroll');
      } else {
        $('.navbar-trans').removeClass('afterscroll');
      }
    });
    $("a[href^='http']").attr("target", "_blank");
  </script>

  <!-- Pagination JS -->
  <?php $where = !empty($_GET['cat']) ? $_GET['cat'] : "0"; ?>
  <script type="text/javascript">
    $(document).ready(function () {
      $(".conteudo_blog").load("https://<?= $server ?>/admin/paginacao_blog.php", { 'categoria': <?= $where; ?> });
    $(".pagination").bootpag({
      total: <?= $pages; ?>,
      page: 1,
      maxVisible: 6
          }).on("page", function (e, num) {
        e.preventDefault();
        $(".conteudo_blog").load("https://<?= $server ?>/admin/paginacao_blog.php", { 'page': num, 'categoria': <?= $where; ?> });
          });
      });
  </script>
</head>




<style>
  body {
    overflow: inherit;
  }


  h1,
  h2,
  h3,
  h4,
  h5,
  h6 {

    font-family: "Poppins", sans-serif;

    color: #818181;

    line-height: 1.2em !important;

    margin-bottom: 0;

    margin-top: 0;

    font-weight: 600;

  }

  .background-ponto-out {

    background-image: none;

    background-repeat: inherit;

    height: 60vh;

    background-size: 6px;

    background: #0a0a18;

  }

  body {

    font-size: 14px !important;

    line-height: 1.428571429 !important;

    color: #333 !important;

    background-color: #ffffff !important;

  }

  .navbar-default .navbar-nav>.active>a,
  .navbar-default .navbar-nav>.active>a:focus,
  .navbar-default .navbar-nav>.active>a:hover {

    color: #555;

    background-color: #e7e7e7;

    background: #66339900;

    color: white;

    font-weight: bold;

    border-bottom: 2px solid #2570f3;

  }

  .container {

    padding-right: 15px;

    padding-left: 15px;

    padding: 0px;

    margin-right: auto;

    margin-left: auto;

  }

  .hte {

    font-size: 1.6rem;

    color: white;

    font-family: 'exo-thin';

    width: 100%;

    line-height: 1.4;

    padding-bottom: 0%;

  }

  .pd-ttr {

    padding: 20px;

    padding-bottom: 9%;

  }

  .card-pf {

    padding: 6%;

    padding-bottom: 17%;

    background: white;

    box-shadow: 0px -1px 9px 0px #c8c8c8;

  }

  .section-title {

    font-size: 36px;

    line-height: 36px;

    text-transform: uppercase;

    position: relative;

    font-weight: 700;

    color: #1c1b23;

    border-bottom: 1px solid #e0e0e0;

    margin: 0 0 25px;

    padding-bottom: 1%;

  }

  @media (max-width: 748px) {

    .home-banner-content h1 {

      font-size: 60px;

      color: #ffffff;

      margin-top: -2rem;

      margin-bottom: 25px;

      text-align: center;

    }



    .col-xs-12 {

      width: 100%;

      padding: 0px;

      margin-bottom: 8%;

    }

    .card-pf {

      padding: 4%;

      padding-bottom: 17%;

      background: white;

      box-shadow: 2px 2px 3px 0px #dadada;

    }

    .pd-ttr {

      padding: 17px;

      padding-bottom: 18%;

    }

    .col-lg-4 {

      padding: 0px;

      margin-top: 5%;

    }



    .section-title {

      font-size: 28px;

      text-transform: uppercase;

      position: relative;

      font-weight: 700;

      color: #1c1b23;

      border-bottom: 0px solid #e0e0e0;

      margin: 35px 0 35px;

      padding-bottom: 10%;

    }



    .jkkik_ {

      height: auto;

      font-size: 26px;

      text-align: left;

    }

  }

  .background-ponto-out {

    background-image: url(../img/ponto.svg);

    background-repeat: inherit;

    height: 60vh;

    background-size: 6px;

  }

  section {

    padding: 0px 0px;

    font-family: 'Raleway', sans-serif;

  }

  b,
  strong {

    font-weight: 700;

    font-family: "Poppins", sans-serif;

    /* font-family: 'exo-bold'; */

  }

  .row {

    margin-right: 0px;

    margin-left: 0px;

  }

  .pagination li {

    display: inline-block;

    list-style: none;

    padding: 0px;

    margin-right: 1px;

    width: 30px;

    text-align: center;

    background: #ffb5d7;

    line-height: 25px;

  }

  .pagination .disabled {

    display: inline-block;

    list-style: none;

    padding: 0px;

    margin-right: 1px;

    width: 30px;

    text-align: center;

    line-height: 25px;

    background-color: #f3f3f3;

    cursor: inherit;

  }

  .background-ponto-out {

    background-image: url(../img/ponto.svg);

    background-repeat: inherit;

    height: 35vh;

    background-size: 6px;

  }

  .home-banner-area-out {

    background: url(../img/home-banner-bg.webp) center;

    background-size: cover;

    height: 36vh;

  }

  .dxrac {

    height: 35vh !important;

  }

  .home-banner-content h1 {

    font-size: 60px;

    color: #ffffff;

    margin-bottom: 25px;

    text-align: center;

  }

  .recent-post {

    height: 5rem;

  }

  .card-img-top {

    width: 100%;

    object-fit: cover;

    height: 240px;

    min-height: 240px;

    border-top-left-radius: calc(.25rem - 1px);

    border-top-right-radius: calc(.25rem - 1px);

  }

  .card-pf {

    padding: 6%;

    padding-bottom: 17%;

    min-height: 19rem;

    background: white;

    box-shadow: 0px -1px 9px 0px #c8c8c8;

  }

  .pd-ttr {

    padding: 20px;

    padding-bottom: 1rem;

    padding-top: 3.3rem;

  }

  .background-ponto-out {
    background: #04737f;
  }

  .background-ponto-out {
    background: #04737f;
  }

  .home-banner-area-out {
    height: 50vh;
  }

  .background-ponto-out {
    height: 44vh;
  }

  .dxrac {
    height: 60vh !important;
  }
</style>

<body>


  <?php include('includes/header.php') ?>





  <section class="home-banner-area-out">

    <div class="background-ponto-out">

      <div class="container">

        <div class="row fullscreen d-flex align-items-center justify-content-between dxrac">

          <div class="home-banner-content banner-out col-lg-12 col-md-12">

            <h1>

              <br>Blog</b><br>

            </h1>

          </div>

        </div>

      </div>

    </div>

  </section>







  <div class="container-fluid">

    <div style="margin-top: 3%;" class="container">

      <h2 class="section-title">

        <span class="title-content">ÚLTIMAS POSTAGENS</span>



      </h2>

      <div class="row">

        <div style="padding: 0px" class="col-md-12">

          <div class="conteudo_blog">

            <!-- editar no admin/paginacao_blog.php linha 44 -->

          </div>

          <!-- Paginacao -->

          <div class="col-md-12">

            <div style="    margin-top: 3rem;margin-bottom: 3rem;" class="pagination pull-right"></div>

          </div>

        </div>


      </div>

    </div>

  </div>





  <?php include('includes/footer.php') ?>



  <style>
    .sticky-top {
      transition: all 0.25s ease-in;
    }

    .stuck .sticky-top {
      background-color: #222 !important;
      padding-top: 3px !important;
      padding-bottom: 3px !important;
    }

    .card-pf {
      padding: 6%;
      padding-bottom: 17%;
      height: auto;
      min-height: 18rem;
      background: white;
      box-shadow: 0px -1px 9px 0px #c8c8c8;
    }

    .logo {
      width: 16rem;
    }

    .logo.scrolled {
      width: 15rem;
      transition: background-color 10ms linear;
    }

    .navbar-dark .navbar-nav .nav-link {
      color: #6b7684;
    }

    .navbar-fixed-top.scrolled {
      background-color: #fff !important;
      transition: background-color 200ms linear;
      border-bottom: 1px solid #80808040;
      box-shadow: 0 0 5px 0px #dadada;
    }

    .navbar-fixed-top.nav-link {
      color: #6b7684;
    }

    .navbar-fixed-top.scrolled .nav-link {
      color: #555;
    }

    .navbar-fixed-top.scrolled .nav-link .zx {
      color: #555;
    }

    .mb-4,
    .my-4 {
      margin-bottom: 0.5rem !important;
      padding: 5px;
    }

    .sticky-top {
      position: -webkit-sticky;
      position: fixed;
      top: 33px;
      width: 100%;
      z-index: 1020;
      /* border-bottom: 3px solid #ccc; */
      box-shadow: -1px 2px 3px 0px #0000004a;
    }

    .home-banner-area {
      background: #005d8a;
      /* background: url(img/home-banner-bg2.jpg) center; */
      background-size: cover;
      height: 91vh;
    }

    .botao-baner {
      padding: 1rem 2rem;
      font-size: 1.5rem;
      border-radius: 0.4rem;
      background: #191d28;
      border: none;
      color: white;
      border: 2px solid #3b435c;
    }

    .texto-equipe {
      text-align: center;

      color: #005d8a;
    }

    .img-fluid {
      max-width: 100%;
      height: auto;
      width: 100%;
      height: 70vh;
      object-fit: cover;
    }

    .bg-info {
      background-color: #f9f9ff !important;
    }

    .toldos {
      font-size: 3rem;
      font-family: sans-serif;
      color: #6b7684;
    }

    .toldos2 {
      font-size: 3rem;
      font-family: sans-serif;
      color: white;
    }

    .sabermais {
      color: #005d8a;
      font-weight: 900;
      font-size: 1.3rem;
    }

    .serv-toldo2 {
      color: #4d4d4d;
      text-align: center;
      margin-top: 3.2rem;
    }

    .serv-toldo1 {
      color: #4d4d4d;
      text-align: center;
      margin-top: 3.2rem;
    }

    .caixa1 {
      background-color: #ffffff;
      height: 18rem;
      background-repeat: no-repeat;
      border: 2px solid #ffffff;
      margin: 1rem;
      border-radius: 1rem;
    }

    .caixa2 {
      background-color: white;
      height: 18em;
      border: 2px solid white;
      margin: 1rem;
      background-repeat: no-repeat;
      border-radius: 1rem;
    }

    .pl-4,
    .px-4 {
      padding-left: 5rem !important;
    }

    .section-title2 h2 {
      margin-bottom: 20px;
      font-size: 2.8rem;
      font-weight: 900;
      color: #ffffff;
    }

    .caixa1 {
      background-image: url(img/back1.jpg);
    }

    .caixa2 {
      background-image: url(img/back2.jpg);
    }

    .sticky-top {
      position: -webkit-sticky;
      position: fixed;
      top: 33px;
      width: 100%;
      height: 108px;
      z-index: 1020;
      /* border-bottom: 3px solid #ccc; */
      box-shadow: -1px 2px 3px 0px #0000004a;
    }

    .footer h6 {
      color: white;
    }

    .img-fluid {
      max-width: 100%;
      height: auto;
      width: 100%;
      height: auto;
      object-fit: scale-down;
    }

    h5 {
      text-align: left;
      color: white;
      margin: 0;
      padding: 0;
    }

    h5 {
      color: white;
    }


    @media (max-width: 748px) {

      button[type=button],
      button[type=submit] {
        height: 52px;
        width: 3rem;
      }

      .footer h6 {
        color: white;
      }

      .footer {
        padding: 2rem !important;
      }
    }
  </style>



  <script>

    $(function () {

      $(document).scroll(function () {

        var $nav = $(".navbar-fixed-top");

        $nav.toggleClass('scrolled', $(this).scrollTop() > $nav.height());

      });



      $(document).scroll(function () {

        var $nav = $(".logo");

        $nav.toggleClass('scrolled', $(this).scrollTop() > $nav.heightx());

      });



    });

  </script>



  <script>

    $(function () {

      $(document).scroll(function () {

        var $nav = $(".navbar-fixed-top");

        $nav.toggleClass('scrolled', $(this).scrollTop() > $nav.height());

      });



      $(document).scroll(function () {

        var $nav = $(".logo");

        $nav.toggleClass('scrolled', $(this).scrollTop() > $nav.heightx());

      });



    });

  </script>





  <script>



    $(function () {

      $(window).scroll(function () {

        if ($(this).scrollTop() > 100) {

          $('.navbar .navbar-brand img').attr('src', 'https://<?= $server ?>/img/logo2.svg');

        }

        if ($(this).scrollTop() < 100) {

          $('.navbar .navbar-brand img').attr('src', 'https://<?= $server ?>/img/logo.svg');

        }

      })

    });

  </script>







  <script type="text/javascript">

    $(document).ready(function () {



      $(".filter-button").click(function () {

        var value = $(this).attr('data-filter');



        if (value == "all") {

          //$('.filter').removeClass('hidden');

          $('.filter').show('1000');

        }

        else {

          $(".filter").not('.' + value).hide('3000');

          $('.filter').filter('.' + value).show('3000');

        }

      });



      if ($(".filter-button").removeClass("active")) {

        $(this).removeClass("active");

      }

      $(this).addClass("active");



    });

  </script>

  <!-- Boostrap 3 -->

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

  <!-- AOS JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>

  <!-- Seu arquivo JS personalizado -->
  <script src="js/main.js"></script>

</body>

</html>