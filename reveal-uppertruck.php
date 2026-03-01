<!doctype html>
<html class="no-js" lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Uppertruck | Algo grande chega hoje</title>
  <meta name="description" content="Algo muito grande está prestes a acontecer. Fique atento.">
  <meta property="og:title" content="Uppertruck | Algo grande chega hoje">
  <meta property="og:description" content="Algo muito grande está prestes a acontecer. Fique atento.">
  <meta property="og:locale" content="pt_BR" />
  <meta property="og:type" content="website" />
  <meta property="og:site_name" content="Uppertruck Express" />
  <meta name="author" content="Uppertruck Express">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png">

  <!-- reaproveitando seus CSS -->
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
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
</head>


<style>
  .section__title .sub-title,
  .section__title span {
    color: #ffd601;
    text-transform: uppercase;
    margin-bottom: 14px;
    display: block;
    font-weight: 400;
    font-size: 6rem;
    font-family: 1;
    line-height: 1;
    margin-top: -2px;
  }

  #typing-caret {
    display: inline-block;
    vertical-align: baseline;
    /* mantém alinhado com a linha do texto */
    font-weight: 400;
    font-size: inherit;
    /* mesmo tamanho da fonte do título */
    color: #ffd601;
    /* mesma cor que você usou para o título */
    line-height: 1;
    /* evita alongar */
    margin-left: 2px;
    /* pequeno espaço entre o texto e o cursor */
  }

  h2 {
    font-size: 50px;
    height: 210px;
  }

  #typing-caret {
    display: inline-block;
    vertical-align: middle;
    /* mantém alinhado ao meio da linha */
    font-weight: 400;
    font-size: inherit;
    /* mesmo tamanho da fonte do título */
    color: #ffd601;
    /* cor amarela que você usou */
    line-height: 1;
    /* não alonga verticalmente */
    margin-left: 2px;
    /* pequeno espaço entre texto e cursor */
  }

  /* Moldura com “glow” pulsando */
  .qr-glow {
    position: relative;
    display: inline-block;
    padding: 10px;
    /* respiro da moldura */
    border-radius: 14px;
    background: rgba(255, 255, 255, .04);
  }

  .qr-glow img {
    display: block;
    border-radius: 10px;
  }

  /* halo externo pulsando */
  .qr-glow::before {
    content: "";
    position: absolute;
    inset: -6px;
    border-radius: 18px;
    box-shadow: 0 0 0 0 rgba(255, 214, 1, .85);
    /* #ffd601 */
    animation: qrPulse 1.8s ease-out infinite;
  }

  @keyframes qrPulse {
    0% {
      box-shadow: 0 0 0 0 rgba(255, 214, 1, .85);
    }

    70% {
      box-shadow: 0 0 0 14px rgba(255, 214, 1, 0);
    }

    100% {
      box-shadow: 0 0 0 0 rgba(255, 214, 1, 0);
    }
  }

  /* cantoneiras piscando (dão leitura de “scanner”) */
  .qr-corner {
    position: absolute;
    width: 26px;
    height: 26px;
    border: 3px solid #ffd601;
    opacity: .95;
    animation: qrBlink 1.2s ease-in-out infinite;
  }

  @keyframes qrBlink {

    0%,
    100% {
      opacity: .95;
    }

    50% {
      opacity: .35;
    }
  }

  /* posições das cantoneiras */
  .qr-corner.tl {
    top: 2px;
    left: 2px;
    border-right: none;
    border-bottom: none;
    border-radius: 8px 0 0 0;
  }

  .qr-corner.tr {
    top: 2px;
    right: 2px;
    border-left: none;
    border-bottom: none;
    border-radius: 0 8px 0 0;
  }

  .qr-corner.bl {
    bottom: 2px;
    left: 2px;
    border-right: none;
    border-top: none;
    border-radius: 0 0 0 8px;
  }

  .qr-corner.br {
    bottom: 2px;
    right: 2px;
    border-left: none;
    border-top: none;
    border-radius: 0 0 8px 0;
  }

  @media (max-width:478px) {

    .section__title .sub-title,
    .section__title span {
      color: #ffd601;
      text-transform: uppercase;
      margin-bottom: 14px;
      display: block;
      font-weight: 400;
      font-size: 4rem;
      font-family: 1;
      line-height: 1;
      margin-top: -2px;
    }
  }

  /* Fundo preto */
  .section-black-bg {
    position: relative;
    overflow: hidden;
    background-color: black;
    min-height: 100vh;
  }

  /* Vídeo de fundo */
  .bg-video {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    z-index: -1;
  }

  /* Vídeo dinâmico com altura responsiva */
  .video-dynamic {
    height: 49rem;
  }

  @media (max-width: 767px) {
    .video-dynamic {
      height: auto;
    }
  }

  /* Overlay do botão */
  .video-overlay {
    margin-top: 22rem;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    z-index: 5;
    cursor: pointer;
    padding: 20px 40px;
    background: rgba(255, 255, 255, 0.1);
    border: 2px solid #fff;
    border-radius: 8px;
    animation: pulse 2s infinite;
    transition: all 0.3s ease;
    width: 20rem;
  }

  .video-overlay:hover {
    background: rgba(255, 255, 255, 0.2);
    transform: translate(-50%, -50%) scale(1.05);
  }

  .video-btn-text {
    font-family: 'Poppins', sans-serif;
    font-size: 1.2rem;
    font-weight: 600;
    color: #fff;
    letter-spacing: 1px;
  }

  /* Animação pulsante */
  @keyframes pulse {
    0% {
      box-shadow: 0 0 0 0 rgba(255, 255, 255, 0.4);
    }

    70% {
      box-shadow: 0 0 0 20px rgba(255, 255, 255, 0);
    }

    100% {
      box-shadow: 0 0 0 0 rgba(255, 255, 255, 0);
    }
  }
</style>

<body>

  <main>
    <!-- HERO / SUSPENSE -->
    <!-- SECTION — Revelação (aguarde + vídeo) -->
    <!-- SECTION — Revelação (aguarde + vídeo) -->

    <section class="page-title-area overlay section-black-bg">
      <!-- Vídeo de fundo -->
      <video autoplay muted loop playsinline class="bg-video">
        <source src="img/5976804_CG_Animation_1920x1080.mp4" type="video/mp4">
        Seu navegador não suporta vídeo em background.
      </video>

      <!-- Conteúdo -->
      <div class="container h-100">
        <div class="row justify-content-center align-items-center h-100">
          <div class="col-xl-8 col-lg-9 text-center">

            <!-- Bloco do vídeo -->
            <div class="postbox__wrapper mt-4 position-relative video-wrapper">
              <video id="videoPlayer" class="w-100 rounded d-none video-dynamic" playsinline>
                <source src="UPPERTRUCK-AGRADECIMENTOS.mp4" type="video/mp4">
              </video>

              <!-- Botão animado -->
              <div id="videoOverlay" class="video-overlay" onclick="playVideo()">
                <span class="video-btn-text">Clique aqui para assistir</span>
              </div>
            </div>

          </div>
        </div>
      </div>
    </section>



    <!-- /HERO -->
  </main>

  <script>
    function playVideo() {
      const video = document.getElementById("videoPlayer");
      const overlay = document.getElementById("videoOverlay");

      // Mostra o vídeo com áudio e controles
      video.muted = false;
      video.classList.remove("d-none");
      video.setAttribute('controls', true);

      // Dá play e esconde o overlay
      video.play().then(() => {
        overlay.style.display = 'none';
      }).catch(err => {
        console.warn('Erro ao iniciar vídeo:', err);
      });
    }
  </script>



  <!-- JS -->
  <script src="assets/js/vendor/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="assets/js/meanmenu.js"></script>
</body>

</html>