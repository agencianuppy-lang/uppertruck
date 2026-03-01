<?php include('admin/controler_site.php'); ?>

<?php 

  include('admin/conf_paginacao_blog.php');

  $results = $class->Select("COUNT(*) AS total" ,"blog", "", "");

  $results->execute();

  $arr = $results->fetch(PDO::FETCH_OBJ);



  $get_total_rows = $arr->total; //total records



  //break total records into pages

  $pages = ceil($get_total_rows/$item_per_page); 

?>

<!DOCTYPE html>

<html>

    
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Uppertruck| Tudo sobre o universo de transporte de cargas</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="../assets/images/favicon.png">

    <!-- CSS
    ============================================ -->

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/css/preloader.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/meanmenu.css">
    <link rel="stylesheet" href="assets/css/animate.min.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/css/backToTop.css">
    <link rel="stylesheet" href="assets/css/magnific-popup.css">
    <link rel="stylesheet" href="assets/css/ui-range-slider.css">
    <link rel="stylesheet" href="assets/css/nice-select.css">
    <link rel="stylesheet" href="assets/css/fontAwesome5Pro.css">
    <link rel="stylesheet" href="assets/css/flaticon.css">
    <link rel="stylesheet" href="assets/css/default.css">
    <link rel="stylesheet" href="assets/css/style.css">


    <link rel="stylesheet" href="assets2/css/vendor/bootstrap.min.css">
    <link rel="stylesheet" href="assets2/css/vendor/font-awesome.css">
    <link rel="stylesheet" href="assets2/css/vendor/slick.css">
    <link rel="stylesheet" href="assets2/css/vendor/slick-theme.css">
    <link rel="stylesheet" href="assets2/css/vendor/base.css">
    <link rel="stylesheet" href="assets2/css/plugins/plugins.css">
    <link rel="stylesheet" href="assets2/css/style.css">


      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/all.css">

      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/v4-shims.css">




      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


      <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

      

      <script type="text/javascript">

         $(window).scroll(function() {

         if($(this).scrollTop() > 50)

         {

             $('.navbar-trans').addClass('afterscroll');

         } else

         {

             $('.navbar-trans').removeClass('afterscroll');

         }  

         });

         $("a[href^='http']").attr("target", "_blank");

      </script>



      <!-- Paginacao -->


      <!-- JS das noticias -->

      <?php

        if (!empty($_GET['cat'])){

          $where = $_GET['cat'];

        }else{

          $where = "0";

        }

      ?>

       <script type="text/javascript">

         $(document).ready(function() {

           $(".conteudo_blog").load("https://<?= $server ?>/admin/paginacao_blog.php", {'categoria': <?php echo $where; ?>});  //initial page number to load

           $(".pagination").bootpag({

              total: <?php echo $pages; ?>,

              page: 1,

              maxVisible: 6

           }).on("page", function(e, num){

             e.preventDefault();



             //$("#results").prepend('<div class="loading-indication"><img src="ajax-loader.gif" /> Loading...</div>');

             $(".conteudo_blog").load("https://<?= $server ?>/admin/paginacao_blog.php", {'page':num, 'categoria':<?php echo $where; ?>});

           });

       });

       </script>

</head>
<style>.dc{
    padding: 0px 0px 0px 6rem;
}
   
    .navbar-brand img {
        margin-top: 10px;
    }
    .sidebar__area{
        display:none;
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
    color: #EF14A0;
}
.axil-search.form-group .search-button i {
    font-weight: 500;
    font-size: 16px;
}
.mainmenu-nav ul.mainmenu > li > a::after {
    background: #EF14A0;
}
.post-content .post-cat .post-cat-list a:hover, .mainmenu-nav ul.mainmenu > li > a:hover, a.axil-link-button {
    color: #EF14A0;
}
.post-content .post-cat .post-cat-list a:hover, .mainmenu-nav ul.mainmenu > li > a:hover, a.axil-link-button {
    color: #EF14A0;
}
.active {
    color: #EF14A0;
    border-radius: inherit;
    border-bottom: 3px solid #EF14A0;
}
.bbq{
    height: 82vh;
}
.axil-slide.slider-style-3 {
    padding: 80px 0;
}
.creative-slider-area::before {
    position: absolute;
    content: "";
    left: 0;
    top: 0;
    min-width: auto;
    background: #fff;
    height: 100%;
}

.axil-slide.slider-style-3 {
    height: auto;
    overflow: hidden;
}
.axil-slide.slider-style-3 {
    padding: 80px 0 0 0!important;
    background: white;
}
.axil-slide.slider-style-3 {
    padding: 80px 0;
    background: white;
}
.axil-slide.slider-style-3 .content-block .post-content .post-cat .post-cat-list a {
    color: #EF14A0;
}
.axil-slide.slider-style-3::after {
    height: 0rem!important;
}
.content-block.post-medium .post-content .title {
    text-transform: inherit;
    margin-bottom: 10px;
}
.content-block.post-medium .post-thumbnail a img {
    width: 100%;
    height: 119px;
    object-fit: cover;
    -webkit-transition: 0.5s;
    -o-transition: 0.5s;
    transition: 0.5s;
}
.axil-slide.slider-style-3 .content-block .post-content .post-cat .post-cat-list a {
    color: #ffb101;
}
.axil-slide.slider-style-3 {
    padding: 3px 0 0 0 !important;
    background: white;
}
@media(max-width:748px){
    .axil-slide.slider-style-3 {
    height: 800px;
}
.dc{
    padding: 0px 0px 0px 0rem;
}
.bbq {
    height: 82vh;
    display: none;
}
.content-block.post-medium:hover .post-thumbnail a img {
    -webkit-transform: scale(1.1);
    -ms-transform: scale(1.1);
    transform: scale(1.1);
    object-fit: cover;
    height: 102px;
}
.content-block .post-thumbnail a img {
    width: 100%;
    height: 105px;
    object-fit: cover;
}
.content-block .post-thumbnail {
    background: black;
    height: 30vh!important;
}
.content-block.post-medium .post-thumbnail {
    height: 10rem!important;
}
.content-block.post-list-view.is-active .post-content, .content-block.post-list-view:hover .post-content {
    -webkit-box-shadow: var(--shadow-primary);
    box-shadow: var(--shadow-primary);
    background: var(--color-white);
    border: 1px solid #d0d0d0;
}
.axil-slide.slider-style-3::after {
    height: auto;
}
.footer1-widget3{
    display:none;
}
.navbar {
    height: 85px;
}
.axil-slide.slider-style-3 .content-block {
    padding-left: 10px;
}
.navbar-collapse {
    flex-basis: 100%;
    z-index: 9;
    background: black;
    margin-top: 43px;
    align-items: center;
    width: 122%!important;
    margin-left: -11%;
}
.botao {
    width: 50%;
    margin-left: 25%;
}

}
</style>
<body class="theme-color-2">
    <div class="main-wrapper">

        <?php include('includes/header2.php') ?>

<div class="container">
    <div class="row">
        <div class="col-md-12 dc">
            <b><br><br></b>
        <h1>Blog</h1>
 <hr>
        </div>
    </div>
</div>

        <div class="conteudo_blog">


        <!-- Start Banner Area -->



<!-- editar no admin/paginacao_blog.php linha 44 -->


               
                              
                         




                   
                 


            </div>

            
            </div>

    <!-- JS
============================================ -->

<?php include('includes/footer.php') ?>



<script src="../assets/js/vendor/modernizr.min.js"></script>
    <!-- jQuery JS -->




    <script src="../assets/js/vendor/jquery.style.switcher.js"></script>


    <!-- Main JS -->
    <script src="../assets/js/main.js"></script>

    <script>
document.addEventListener('DOMContentLoaded', function() { 
    // Seleciona todos os blocos de conteúdo
    const contentBlocks = document.querySelectorAll('.content-block.post-medium.post-medium-border');
    
    contentBlocks.forEach(function(block) {
        block.addEventListener('mouseover', function() {
            // Obtém a URL da imagem do bloco
            const imageUrl = block.querySelector('.post-thumbnail img').src;
            
            // Atualiza a imagem com o ID "delta"
            document.getElementById('delta').src = imageUrl;
        });
    });
});
</script>

<script type="text/javascript" src="https://<?= $server ?>/admin/_class/caminho_controler.js"></script>




 <script type="text/javascript">

    $('#carouselHacked').carousel();

 </script>

</body>


<script src="assets/js/vendor/jquery-3.6.0.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/meanmenu.js"></script>

</html>