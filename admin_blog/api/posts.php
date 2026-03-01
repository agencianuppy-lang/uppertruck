<?php include('admin/controler_site.php'); ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	
	<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-GX52D94WWT"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-GX52D94WWT');
</script>

	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta charset="UTF-8">
	<meta name="author" content="Nuppy">
	<meta name="description" content="Encontre as melhores soluções online para o crescimento da sua empresa!">
	<meta name="keywords" content="webdesign, marketing digital">

	<title>Nuppy - Digital Marketing</title>

	<link href="https://fonts.googleapis.com/css?family=Poppins:400,600|Roboto:400,400i,500" rel="stylesheet">
	<link href="//cdn-images.mailchimp.com/embedcode/classic-10_7.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="css/linearicons.css">
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/main.css">
	<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
	<link rel="stylesheet" href="css/home.css">
	<link rel="stylesheet" href="css/idenx.css">
	<link rel="stylesheet" href="css/index1.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js">
	<link href="css/hover.css" rel="stylesheet" media="all">
	<link rel="icon" type="image/png" href="img/fav.png" />
	<script src="https://kit.fontawesome.com/ec0f95ce9f.js" crossorigin="anonymous"></script>
	<script src="//code.jquery.com/jquery-1.10.2.min.js"></script>
	<link rel="stylesheet" href="css/aos.css" />
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/cookieconsent@3/build/cookieconsent.min.css" />
	
	<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-3451942621750445"
     crossorigin="anonymous"></script>
	 
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
	<script>
		$(function () {
			$(window).scroll(function () {
				if ($(this).scrollTop() > 100) {
					$('.navbar .navbar-brand img').attr('src', 'img/logo2.svg');
				}
				if ($(this).scrollTop() < 100) {
					$('.navbar .navbar-brand img').attr('src', 'img/logo.svg');
				}
			})
		});
	</script>



<script>
		$(function () {
			$(window).scroll(function () {
				if ($(this).scrollTop() > 100) {
					$('.core').attr('src', 'img/download2.svg');
				}
				if ($(this).scrollTop() < 100) {
					$('.core').attr('src', 'img/download.svg');
				}
			})
		});
	</script>



<script>
		$(function () {
			$(window).scroll(function () {
				if ($(this).scrollTop() > 100) {
					$('.core2').attr('src', 'img/scanner2.svg');
				}
				if ($(this).scrollTop() < 100) {
					$('.core2').attr('src', 'img/scanner.svg');
				}
			})
		});
	</script>

	<!-- Paginacao -->
	
    <script type="text/javascript" src="js/jquery.bootpag.min.js"></script>
      
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
           $(".conteudo_blog").load("admin/paginacao_blog2.php", {'categoria': <?php echo $where; ?>});  
           $(".pagination").bootpag({
              total: <?php echo $pages; ?>,
              page: 1,
              maxVisible: 6
           }).on("page", function(e, num){
             e.preventDefault();
             $(".conteudo_blog").load("admin/paginacao_blog2.php", {'page':num, 'categoria':<?php echo $where; ?>});
           });
       });
	</script>
	
</head>


<style>
	.home-banner-area {
    height: 100%!important;
}
.figura {
    margin-top: -60%;
}
.figura2 {
    margin-top: -60%;
}
.saiba2 {
    color: #e51150!important;
    margin-left: -12px;
}
.saiba {
    color: #e51150!important;
    background: white;
    font-size: 17px;
    border: 2px solid #e51150;
    padding: 1.1rem 4rem;
    letter-spacing: 0px;
    border-radius: 9px;
}
.hr2{
	margin-top: 0rem;
    margin-bottom: 1rem;
    width: 90%;
	border-top: 1px solid rgb(238 238 238);
}
.figura {
    width: 180%;
    margin-left: -15%;
    margin-top: -57.2%;
    position: absolute;
}
.figura {
    margin-top: -37%;
}
.home-banner-area {
    background: url(img/capa-banner.jpg);
    height: 100vh!important;
    background-size: cover;
    margin-bottom: 3rem;
}

.home-banner-content h1 {
    font-size: 60px;
    margin-bottom: 0;
    margin-top: 44%;
    text-align: left;
}
.saiba {
    color: #b0019c!important;
    background: white;
    font-size: 17px;
    border: 2px solid #b80096;
    padding: 1.1rem 4rem;
    letter-spacing: 0px;
    border-radius: 9px;
}
.whatsapp-fixo {
    background-image: linear-gradient(to right, #a500a4, #ea0073)!important;
}
.saiba {
    color: #b0019c!important;
    background: white;
    font-size: 17px;
    border: none;
    padding: 1.1rem 4rem;
    letter-spacing: 0px;
    border-radius: 43px;
}
.logo {
    width: 10rem;
    margin-top: 0rem;
}

.w-150 {
    width: 150% !important;
    margin-top: -30px;
}
.classic{
	color: #463f53;
    font-family: inherit;
    font-weight: 800;
    text-transform: inherit;
}
.section-title h2 {
    margin-top: 1rem;
    margin-bottom: 20px;
    font-size: 4.5rem !important;
    line-height: 0.9!important;
    font-weight: bolder;
    text-transform: inherit;
    font-family: inherit;
    text-transform: math-auto;
}
.negrito {
    font-weight: 600;
    color: #ea007e;
}
.section-title p {
    font-size: 22px;
    margin-bottom: -1rem;
    margin-top: 3rem;
    line-height: 1.3;
    text-align: center;
    letter-spacing: 0px;
    font-family: 'CodecPro', sans-serif;
    color: #463f53;
}
.cemmil{
    text-align: left!important;
    font-size: 3rem!important;
    line-height: 1.1!important;
    font-weight: 900!important;
    color: #ec007f!important;
    font-family: 'Poppins'!important;
}

.ovo3 {
    font-size: 4.4rem !important;
    color: #463f53;
    margin-top: 6rem;
    line-height: 3.9rem;
    font-family: 'CodecPro', sans-serif;
    margin-bottom: 12px;
    font-weight: 700;
    letter-spacing: -2px;
}

body {
    color: #463f53;
}

.w-150-l {
    width: 140% !important;
    margin-top: -10px;
    margin-left: -298px;
}
.w-150-r {
    width: 115% !important;
    margin-top: -40px;
    margin-right: -298px;
}
.w-150-r2 {
    width: 145% !important;
    margin-top: -40px;
    margin-right: -357px;
}
.fundo1{
	position: absolute;
    left: -5%;
}
.fundo2{
	position: absolute;
    right: -5%;
}
body {
    overflow-x: hidden;
}
.tituloj {
    color: #ea007e;
    margin-bottom: 5px;
}
.section-title h2 {
    margin-top: 1rem;
    margin-bottom: 20px;
    font-size: 5.5rem !important;
    line-height: 0.9!important;
    font-weight: bolder;
    text-transform: inherit;
    font-family: inherit;
    text-transform: math-auto;
    letter-spacing: -3px!important;
}
.oii {
    font-size: 2.4rem;
    line-height: 1;
}
.inicio2 {
    color: #ea007e!important;
}
.mobile{
	display:none;
}
.desktop{
	display:block;
}
.detalhes{
	background-image: linear-gradient(to right, #a500a4, #ea0073)!important;
    padding: 1rem 4rem;
    border-radius: 50px;
    color: white;
}
@keyframes zoom-animation {
  0% { background-size: 100% auto; }
  50% { background-size: 105% auto; }
  100% { background-size: 100% auto; }
}

.home-banner-area {
    background: url(img/capa-banner.jpg);
    height: 100vh !important;
    background-size: cover;
    margin-bottom: 3rem;
    animation: zoom-animation 10s infinite;
}

@font-face {
	font-family: 'CodecPro';
	src: url('fonts/CodecPro-News.eot?#iefix') format('embedded-opentype'), /* IE6-IE8 */
     	 url('fonts/CodecPro-News.woff') format('woff'), /* Modern Browsers */
		 url('fonts/CodecPro-News.woff2') format('woff2'), /* Modern Browsers */
         url('fonts/CodecPro-News.ttf')  format('truetype'); /* Safari, Android, iOS */
	font-weight: 400;
	font-style: normal
}

@font-face {
	font-family: 'CodecPro';
	src: url('fonts/CodecPro-Bold.eot?#iefix') format('embedded-opentype'),
	     url('fonts/CodecPro-Bold.woff') format('woff'),
		 url('fonts/CodecPro-Bold.woff2') format('woff2'),
		 url('fonts/CodecPro-Bold.ttf') format('truetype');
	font-weight: 700;
	font-style: normal
}

@font-face {
	font-family: 'CodecPro';
	src: url('fonts/CodecPro-ExtraBold.eot?#iefix') format('embedded-opentype'),
	     url('fonts/CodecPro-ExtraBold.woff') format('woff'),
		 url('fonts/CodecPro-ExtraBold.woff2') format('woff2'),
		 url('fonts/CodecPro-ExtraBold.ttf') format('truetype');
	font-weight: 800;
	font-style: normal
}

@font-face {
	font-family: 'CodecPro';
	src: url('fonts/CodecPro-Ultra.eot?#iefix') format('embedded-opentype'),
         url('fonts/CodecPro-Ultra.woff') format('woff'),
		 url('fonts/CodecPro-Ultra.woff2') format('woff2'),
		 url('fonts/CodecPro-Ultra.ttf') format('truetype');
	font-weight: 900;
	font-style: normal
}

@media(max-width:748px){
	.w-150 {
    display: none;
}
.mobile{
	display:block;
}
.desktop{
	display:none;
}
.section-title h2 {
    margin-top: 1rem;
    margin-bottom: 20px;
    font-size: 3.5rem !important;
    line-height: 0.9!important;
    font-weight: bolder;
    text-transform: inherit;
    font-family: inherit;
    text-transform: math-auto;
    letter-spacing: -3px!important;
}
.w-150-l {
    width: 100% !important;
    margin-top: 2%;
    height: 328px;
    margin-left: 0;
    border-radius: 100%;
    background-image: linear-gradient(to right, #a500a4, #ea0073)!important;
    box-shadow: 3px 12px 11px #380548a8;
    object-fit: cover;
}
.w-150-r {
    width: 100% !important;
    margin-top: 2%;
    height: 328px;
    margin-left: 0;
    border-radius: 100%;
    background-image: linear-gradient(to right, #a500a4, #ea0073)!important;
    box-shadow: 3px 12px 11px #380548a8;
    object-fit: cover;
}
.titulo-inicial {
    font-size: 4.2rem;
    text-align: center;
    line-height: 0;
}
.home-banner-content p {
    margin-bottom: auto;
    color: white;
    line-height: 1.4;
    padding: 30px 0rem;
    text-align: left;
    font-family: 'CodecPro', sans-serif;
    font-size: 1.1rem;
    width: auto!important;
}

.d-view-mb {
    display: none;
    margin-top: -25px;
}
.fundo1 {
    position: absolute;
    right: -11%;
    height: 30%;
}

.fundo2 {
    position: absolute;
    left: -5%;
    height: 32%;
}
.ovo3 {
    font-size: 2.5rem !important;
    color: #463f53;
    margin-left: 4%;
    margin-top: 3rem;
    line-height: normal;
    font-family: 'CodecPro', sans-serif;
    margin-bottom: 1rem;
    font-weight: 700;
    letter-spacing: -2px;
}
.sub-div {
    background-image: linear-gradient(to right, #c8008c, #c6008d)!important;
    height: 7rem;
    margin-top: 0rem;
    font-size: 1rem;
    border-top: 1px solid #dd007d;
    color: white;
    line-height: 4rem;
    position: absolute;
}

.navbar-toggler {
    padding: 0.25rem 0.75rem;
    font-size: 1.25rem;
    line-height: 1;
    background-color: #463f53!important;
    border: none!important;
    border-radius: 0.25rem;
    margin-right: 11px;
}
.home-banner-area {
    background: url(img/capa-banner.jpg);
    height: 110vh!important;
    background-size: cover;
    margin-bottom: 3rem;
    background-position: center;
}
}
</style>

<body>







	<?php include('includes/header.php') ?>

	<a target="_blank" href="https://api.whatsapp.com/send?phone=5511978480001&amp;text=Ol%C3%A1%20vim%20pelo%20site!">
		<div class="whatsapp-fixo">
			<img src="img/whatsapp-white.png" alt="">
			<span class="tem">Atendimento via WhatsApp</span>
		</div>
	</a>

	<section id="inicio"  style="overflow: hidden;" class="home-banner-area" >
		<div class="background-ponto">
			<div class="container">
				<div class="row d-flex align-items-center justify-content-between">


			
				<div class="home-banner-content col-12 col-md-6 d-view">
							<img class="figura" style="width:120%" src="img/modelo2.png">
					</div>

					



				<div class="home-banner-content col-12 col-md-6">
						<h1 style="line-height:1!important">
							<b style="color:#fff; font-family: 'CodecPro';  font-weight: 800; " class="titulo-inicial">O futuro muda. <br> Mude primeiro!</b>
						</h1>
						
						<p>
							Chegou a hora de você ter uma <b style="font-weight: 800; color: white;"> estratégia de marketing digital </b> para a sua empresa.  <br><br>
							a efetividade de nossos serviços permite que sua marca cresça ainda mais e alcance novas
							estratégias digitais.
							<br><br><br>
							<a href="contato.php"><b style="color:white" class="saiba">Saiba mais</b></a>

						</p>
					</div>

			
			
				</div>
			</div>

			
			<div class="stage">
				<a href="#sobre" class="scrollSuave">
					<div class="boxx bounce-1 "></div>
				</a>
			</div>

<br><br>
		

		</div>
	</section>


<section class="caixa-vazia">
	<div class="container">
		<div class="row">
			<div class="col-12">
				
				<h4 style="color: black; font-weight: 300;" class="text-center"> Diversos clientes já evoluiram com a <b class="negrito">Nuppy</b></h4>
			</div>
			<hr> 
		
		</div>
	</div>
</section>    

	<section  class="caixa-vazia">
		<div class="container">
			<div style="margin: 0;" class="row d-flex justify-content-center">
				<div class="col-12 col-md-5">
					<div class="section-title  text-left pr-4">
						<h6 class="pb-0 mb-0"></h6>
						<h2 class=" classic">
							 você conhece a <b class="negrito"> nuppy?</b>
						</h2>
						<p style="text-align: left;"> Nós Somos especialistas em <b class="negrito"> serviços digitais de marketing digital.</b>
<br><br>
trabalhamos para auxiliar <b class="negrito">  nossos clientes</b> a atingirem o <b class="negrito"> crescimento </b>  de seus produtos e serviços. <br> <br>
						</p> 
					
						<p class="cemmil">+100 mil 
leads gerados 
em 2024</p>
					</div>
				</div>
				<div class="col-12 col-md-7">
					<img class="w-150 marketing" src="img/marketing.png" alt="">
				</div>
				<br><br>
			</div>
		</div>
	</section>





	
	<section  class="caixa-vazia" style="background: #f6f6f6;overflow: hidden;">
	<img src="img/fundo1.png" alt="" class="fundo1">
		<div class="container">
			<div style="margin: 0;" class="row d-flex justify-content-center">
			<div class="col-12 col-md-6 ">
					
					<img class="w-150-l marketing" src="img/modelo3.png" alt="">
				</div>

				<div class="col-12 col-md-6">
					<div class="">
					<div class="div">
						<!-- <h2 class="pb-0 mb-0"><b  class="dhh">Criação de sites</b> </h2> -->
						
						<h2 class="d-flex align-middle" style="color: #3e3e3e;">
							<b  class="ovo3 strok">Criação de sites</b> <br><br>
						</h2>


						<div class="col-12 col-md-8 d-view-mb">
							<img  class="tempero3"  src="" alt="">
						</div>
						
						<div class="row">
							<div class="col-md-12">
								<p style="text-align: left;"> 
							<br><br>
								Precisando de um site moderno e personalizado? <br> Nós criamos pra você! 
								
								</p>
							</div>
							<div class="col-md-6">
								<p style="text-align: left;"> 
									 </p><h4 class="tituloj">Design moderno</h4>
									 Criação de sites com design moderno e atraente.  <br>
								<p></p> 
							</div>

							<div class="col-md-6">
								<p style="text-align: left;"> 
									 </p><h4 class="tituloj">Adaptabilidade</h4>
									 Sites adaptados para todos os tipos de dispositivos.  <br>
								<p></p> 
							</div>

							<div class="col-md-6">
								<p style="text-align: left;"> 
									 </p><h4 class="tituloj">Velocidade</h4>
									 Sites com carregamento rápido, melhorando a experiência do usuário.  <br>
								<p></p> 
							</div>

							<div class="col-md-6">
								<p style="text-align: left;"> 
									 </p><h4 class="tituloj">Identidade Visual:</h4>
									 Criação de sites com identidade visual exclusiva para o seu negócio.  <br>
								<p>
								
							</div>

							<div class="col-md-12">
								<p style="text-align: left;" class="oii"> 
									<br>	um site com o seu jeitinho,<b style="font-weight:bold; color:#ea007e"> moderno e seguro :D </b>  <br>
								</p> 
<br><br>

								<a href="empresa-de-criacao-de-sites" class="detalhes">Ver mais detalhes</a>
							</div>
						</div>

						
					</div>
				</div>
				
				<br><br>
			</div>
		</div>
	</section>





	
	<section  class="caixa-vazia" style="overflow: hidden;" >
	<img src="img/fundo2.png" alt="" class="fundo2">
		<div class="container">
			<div style="margin: 0;" class="row d-flex justify-content-center">
		
			<div class="col-12 col-md-6 mobile">
					<img class="w-150-r marketing" src="img/modelo4.png" alt="">
				</div>


				<div class="col-12 col-md-6">
					<div class="">
					<div class="div">
						<!-- <h2 class="pb-0 mb-0"><b  class="dhh">Criação de sites</b> </h2> -->
						
						<h2 class="d-flex align-middle" style="color: #3e3e3e;">
							<b  class="ovo3 strok">Criação de conteúdo</b> <br><br>
						</h2>


						<div class="col-12 col-md-8 d-view-mb">
							<img  class="tempero3"  src="" alt="">
						</div>
						

						<div class="row">
						
							<div class="col-md-6">
								<p style="text-align: left;"> 
									 </p><h4 class="tituloj">Conteúdo Relevante</h4>
									 Criamos conteúdo relevante e de qualidade. <br>
								<p></p> 
							</div>

							<div class="col-md-6">
								<p style="text-align: left;"> 
									 </p><h4 class="tituloj">Criativos incríveis</h4>
									 Realizamos artes incríveis para suas redes sociais.  <br>
								<p></p> 
							</div>

							<div class="col-md-6">
								<p style="text-align: left;"> 
									 </p><h4 class="tituloj">Exclusividade</h4>
									 Conteúdo únido e personalizado para o seu negócio. <br>
								<p></p> 
							</div>

							<div class="col-md-6">
								<p style="text-align: left;"> 
									 </p><h4 class="tituloj">Autoridade</h4>
									 Torne-se referência no seu segmento com nossos conteúdos. <br>
								<p>
								
							</div>

							<div class="col-md-12">
								<p style="text-align: left;" class="oii"> 
									<br> Conteúdo que fala a língua do seu público, porque cada negócio tem <b style="font-weight:bold; color:#ea007e"> a sua história. </b><br><br>
								</p> 

								<a href="criacao-de-posts.php" class="detalhes">Ver mais detalhes</a> 
							</div>
						</div></div>


				</div>
				</div>

				<div class="col-12 col-md-6 desktop">
					
					<img class="w-150-r marketing" src="img/modelo4.png" alt="">
				</div>

				
				<br><br>
			</div>
		</div>
	</section>




	
	
	<section  class="caixa-vazia" style="background: #f6f6f6;overflow: hidden;">
	<img src="img/fundo3.png" alt="" class="fundo1">
		<div class="container">
			<div style="margin: 0;" class="row d-flex justify-content-center">
			<div class="col-12 col-md-6 ">
					
					<img class="w-150-l marketing" src="img/modelo5.png" alt="">
				</div>

				<div class="col-12 col-md-6">
					<div class="">
					<div class="div">
						<!-- <h2 class="pb-0 mb-0"><b  class="dhh">Criação de sites</b> </h2> -->
						
						<h2 class="d-flex align-middle" style="color: #3e3e3e;">
							<b  class="ovo3 strok">Gestão de redes socias</b> <br><br>
						</h2>


						<div class="col-12 col-md-8 d-view-mb">
							<img  class="tempero3"  src="" alt="">
						</div>
						
						<div class="row">
							<div class="col-md-6">
								<p style="text-align: left;"> 
									 <h4 class="tituloj">Engajamento</h2>
									 Aumente o engajamento da sua empresa nas redes sociais.  <br>
								</p> 
							</div>

							<div class="col-md-6">
								<p style="text-align: left;"> 
									 <h4 class="tituloj">Personalização</h2>
									 Conteúdo personalizado para cada rede, mantendo a identidade visual da sua empresa. <br>
								</p> 
							</div>

							<div class="col-md-6">
								<p style="text-align: left;"> 
									 <h4 class="tituloj">Análise de dados</h2>
									 Otimização baseada em dados e análises profundas.  <br>
								</p> 
							</div>

							<div class="col-md-6">
								<p style="text-align: left;"> 
									 <h4 class="tituloj">Identidade</h2>
									 Aplicamos a identidade visual da sua empresa nas redes sociais.  <br>
								</p> 
								
							</div>

							<div class="col-md-12">
								<p style="text-align: left;" class="oii"> 
									<br>	Tenha uma presença forte nas redes sociais e <b style="font-weight:bold; color:#ea007e"> interaja com o seu público :D </b>  <br><br>
								</p> 
								<a href="gerenciamento-de-redes-sociais.php" class="detalhes">Ver mais detalhes</a> 
							</div>
						</div>
					</div>
				</div>
				
				<br><br>
			</div>
		</div>
	</section>





	
	<section  class="caixa-vazia" style="overflow: hidden;" >
	<img src="img/fundo4.png" alt="" class="fundo2">
		<div class="container">
			<div style="margin: 0;" class="row d-flex justify-content-center">
		

			<div class="col-12 col-md-6 mobile">
					<img class="w-150-r marketing" src="img/modelo6.png" alt="">
				</div>

				<div class="col-12 col-md-6">
					<div class="">
					<div class="div">
						<!-- <h2 class="pb-0 mb-0"><b  class="dhh">Criação de sites</b> </h2> -->
						
						<h2 class="d-flex align-middle" style="color: #3e3e3e;">
							<b  class="ovo3 strok">SEO <small>(Otimização de sites)</small> </b> <br><br>
						</h2>


						<div class="col-12 col-md-8 d-view-mb">
							<img  class="tempero3"  src="" alt="">
						</div>
						
						<div class="row">
							<div class="col-md-6">
								<p style="text-align: left;"> 
									 <h4 class="tituloj">Otimização para busca</h2>
									 Seja encontrado nas buscas com nossas técnicas de SEO. <br>
								</p> 
							</div>

							<div class="col-md-6">
								<p style="text-align: left;"> 
									 <h4 class="tituloj">Palavras-chave</h2>
									 Identificamos as palavras-chave certas para o seu negócio.  <br>
								</p> 
							</div>

							<div class="col-md-6">
								<p style="text-align: left;"> 
									 <h4 class="tituloj">Análise de dados</h2>
									 Otimização baseada em dados e análises profundas.  <br>
								</p> 
							</div>

							<div class="col-md-6">
								<p style="text-align: left;"> 
									 <h4 class="tituloj">Link building</h2>
									 Aumente a autoridade do seu site com nossas estratégias.  <br>
								</p> 
								
							</div>

							<div class="col-md-12">
								<p style="text-align: left;" class="oii"> 
									<br>	
									Apareça nas <b style="font-weight:bold; color:#ea007e"> primeiras páginas</b>  dos mecanismos de busca.
									 <br><br>
								</p> 
								<a href="seo.php" class="detalhes">Ver mais detalhes</a> 
							</div>
						</div>
					</div>
				</div>
				</div>

				<div class="col-12 col-md-6 desktop ">
					
					<img class="w-150-r2 marketing" src="img/modelo6.png" alt="">
				</div>

				
				<br><br>
			</div>
		</div>
	</section>


	
	
	<section  class="caixa-vazia" style="background: #f6f6f6;overflow: hidden;">
	<img src="img/fundo5.png" alt="" class="fundo1">
		<div class="container">
			<div style="margin: 0;" class="row d-flex justify-content-center">
			<div class="col-12 col-md-6 ">
					
					<img class="w-150-l marketing" src="img/modelo7.png" alt="">
				</div>

				<div class="col-12 col-md-6">
					<div class="">
					<div class="div">
						<!-- <h2 class="pb-0 mb-0"><b  class="dhh">Criação de sites</b> </h2> -->
						
						<h2 class="d-flex align-middle" style="color: #3e3e3e;">
							<b  class="ovo3 strok">Anúncios patrocionados</b> <br><br>
						</h2>


						<div class="col-12 col-md-8 d-view-mb">
							<img  class="tempero3"  src="" alt="">
						</div>
						
						<div class="row">
							<div class="col-md-6">
								<p style="text-align: left;"> 
									 <h4 class="tituloj">Resultados rápidos</h2>
									 Receba mais visitas rapidamente com nossas campanhas.  <br>
								</p> 
							</div>

							<div class="col-md-6">
								<p style="text-align: left;"> 
									 <h4 class="tituloj">Segmentação</h2>
									 Campanhas direcionadas para o público certo, aumentando o ROI.  <br>
								</p> 
							</div>

							<div class="col-md-6">
								<p style="text-align: left;"> 
									 <h4 class="tituloj">Mensuração</h2>
									 Acompanhe o ROI e receba relatórios detalhados.  <br>
								</p> 
							</div>

							<div class="col-md-6">
								<p style="text-align: left;"> 
									 <h4 class="tituloj">Remarketing</h2>
									 Alcance usuários que já visitaram o site e aumente as conversões  <br>
								</p> 
								
							</div>

							<div class="col-md-12">
								<p style="text-align: left;" class="oii"> 
									<br>	
									
									Criamos campanhas direcionadas para seu <b style="font-weight:bold; color:#ea007e"> o público certo :D </b>  <br>

<br>
								</p> 
								<a href="campanhas-google-ads.php" class="detalhes">Ver mais detalhes</a>
							</div>
						</div>
					</div>
				</div>
				
				<br><br>
			</div>
		</div>
	</section>




	<?php include('includes/footer.php') ?>
	

<script src="js/aos.js"></script>
    <script>
      AOS.init({
        easing: 'ease-in-out-sine'
      });
    </script>



 <script src="https://cdn.jsdelivr.net/npm/cookieconsent@3/build/cookieconsent.min.js" data-cfasync="false"></script>
</div>

	<script>
  AOS.init();
</script>

<script>
window.cookieconsent.initialise({
  "palette": {
    "popup": {
      "background": "#660bad"
    },
    "button": {
      "background": "#cfb3d9"
    }
  },
  "theme": "classic",
  "content": {
    "message": "Nós armazenamos dados temporariamente para melhorar a sua experiência de navegação e recomendar conteúdo de seu interesse. Ao utilizar nossos serviços, você concorda com tal monitoramento.",
    "dismiss": "OK",
    "link": "Política de privacidade",
    "href": "/privacy-policy"
  }
});
</script>
	
	<script type="text/javascript">
        // Este evendo é acionado após o carregamento da página
        jQuery(window).load(function() {
            //Após a leitura da pagina o evento fadeOut do loader é acionado, esta com delay para ser perceptivo em ambiente fora do servidor.
            jQuery("#loading").delay(2000).fadeOut("slow");
        });
    </script>




	<script>
$("nav .scrolll a ").click(function(event){
   event.preventDefault();
   var dest=0;
   if($(this.hash).offset().top > $(document).height()-$(window).height()){
     dest=$(document).height()-$(window).height();
   }else{
     dest=$(this.hash).offset().top;
   }
   $('html,body').animate({scrollTop:dest}, 1000,'swing');
 });
 </script>

	<script>
		$(function () {
			var $tabButtonItem = $('#tab-button li'),
				$tabSelect = $('#tab-select'),
				$tabContents = $('.tab-contents'),
				activeClass = 'is-active';

			$tabButtonItem.first().addClass(activeClass);
			$tabContents.not(':first').hide();

			$tabButtonItem.find('a').on('click', function (e) {
				var target = $(this).attr('href');

				$tabButtonItem.removeClass(activeClass);
				$(this).parent().addClass(activeClass);
				$tabSelect.val(target);
				$tabContents.hide();
				$(target).show();
				e.preventDefault();
			});

			$tabSelect.on('change', function () {
				var target = $(this).val(),
					targetSelectNum = $(this).prop('selectedIndex');

				$tabButtonItem.removeClass(activeClass);
				$tabButtonItem.eq(targetSelectNum).addClass(activeClass);
				$tabContents.hide();
				$(target).show();
			});
		});
	</script>

	</script>



	<script>
		$(function () {


			$(document).scroll(function () {
				var $nav = $(".inicio");
				$nav.toggleClass('inicio2', $(this).scrollTop() > $nav.height());
			});


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



	<script type='text/javascript'src='//s3.amazonaws.com/downloads.mailchimp.com/js/mc-validate.js'></script>
	<script type='text/javascript'>(function ($) {
			window.fnames = new Array(); window.ftypes = new Array(); fnames[1] = 'FNAME'; ftypes[1] = 'text'; fnames[0] = 'EMAIL'; ftypes[0] = 'email'; fnames[4] = 'PHONE'; ftypes[4] = 'phone'; fnames[3] = 'MMERGE3'; ftypes[3] = 'text'; fnames[2] = 'MMERGE2'; ftypes[2] = 'url'; /**
 * Translated default messages for the $ validation plugin.
 * Locale: PT_PT
 */
			$.extend($.validator.messages, {
				required: "Campo de preenchimento obrigat&oacute;rio.",
				remote: "Por favor, corrija este campo.",
				email: "Por favor, introduza um endere&ccedil;o eletr&oacute;nico v&aacute;lido.",
				url: "Por favor, introduza um URL v&aacute;lido.",
				date: "Por favor, introduza uma data v&aacute;lida.",
				dateISO: "Por favor, introduza uma data v&aacute;lida (ISO).",
				number: "Por favor, introduza um n&uacute;mero v&aacute;lido.",
				digits: "Por favor, introduza apenas d&iacute;gitos.",
				creditcard: "Por favor, introduza um n&uacute;mero de cart&atilde;o de cr&eacute;dito v&aacute;lido.",
				equalTo: "Por favor, introduza de novo o mesmo valor.",
				accept: "Por favor, introduza um ficheiro com uma extens&atilde;o v&aacute;lida.",
				maxlength: $.validator.format("Por favor, n&atilde;o introduza mais do que {0} caracteres."),
				minlength: $.validator.format("Por favor, introduza pelo menos {0} caracteres."),
				rangelength: $.validator.format("Por favor, introduza entre {0} e {1} caracteres."),
				range: $.validator.format("Por favor, introduza um valor entre {0} e {1}."),
				max: $.validator.format("Por favor, introduza um valor menor ou igual a {0}."),
				min: $.validator.format("Por favor, introduza um valor maior ou igual a {0}.")
			});
		}(jQuery)); var $mcj = jQuery.noConflict(true);</script>

	<script src="js/vendor/bootstrap.min.js"></script>
	<script src="js/main.js"></script>
</body>

</html>