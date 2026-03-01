<?php
require_once 'admin_blog/config/config.php';
require_once 'admin_blog/config/db.php';

// Carregar configurações
$stmt = $pdo->query("SELECT config_key, config_value FROM settings");
$settings = [];
foreach ($stmt as $row) {
  $settings[$row['config_key']] = $row['config_value'];
}

$slug = $_GET['slug'] ?? '';

if (!$slug) {
  header("Location: new-blog.php");
  exit;
}

// Buscar o post pelo slug com nome da categoria
$stmt = $pdo->prepare("
  SELECT p.*, u.name AS autor, c.name AS categoria_nome
  FROM posts p
  LEFT JOIN users u ON u.id = p.author_id
  LEFT JOIN categories c ON c.id = p.category_id
  WHERE p.slug = :slug AND p.status = 'publicado' AND p.is_deleted = FALSE
  LIMIT 1
");
$stmt->execute(['slug' => $slug]);
$post = $stmt->fetch();

if (!$post) {
  echo "<h2 style='text-align:center;'>Post não encontrado.</h2>";
  exit;
}

// SEO dinâmico (ajustado)
$base_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'];
$meta_title = $post['meta_title'] ?: $post['title'];
$meta_description = $post['meta_description'] ?: mb_substr(strip_tags($post['content']), 0, 155);
$image_url = $post['image']
  ? (strpos($post['image'], 'http') === 0 ? $post['image'] : $base_url . "/admin_blog/" . $post['image'])
  : $base_url . "/default.jpg";
$canonical = $base_url . "/blog/" . urlencode($post['slug']);


$formatter = new \IntlDateFormatter(
  'pt_BR',
  \IntlDateFormatter::LONG,
  \IntlDateFormatter::NONE,
  'America/Sao_Paulo',
  \IntlDateFormatter::GREGORIAN,
  "d 'de' MMMM 'de' y"
);

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>
    <?= htmlspecialchars(trim($meta_title ?? '')) ?> |
    <?= $settings['site_name'] ?? 'Blog' ?>
  </title>

  <meta name="description" content="<?= htmlspecialchars($meta_description) ?>">
  <meta name="robots" content="index, follow">
  <meta name="author" content="<?= htmlspecialchars($post['autor']) ?>">
  <link rel="canonical" href="<?= $canonical ?>">
  <link rel="icon" type="image/png" href="<?= $settings['site_favicon'] ?? '/favicon.png' ?>">

  <!-- Open Graph -->
  <meta property="og:type" content="article">
  <meta property="og:title" content="<?= htmlspecialchars($meta_title) ?>">
  <meta property="og:description" content="<?= htmlspecialchars($meta_description) ?>">
  <meta property="og:image" content="<?= $image_url ?>">
  <meta property="og:url" content="<?= $canonical ?>">

  <!-- Twitter Card -->
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="<?= htmlspecialchars($meta_title) ?>">
  <meta name="twitter:description" content="<?= htmlspecialchars($meta_description) ?>">
  <meta name="twitter:image" content="<?= $image_url ?>">

  <!-- Local SEO -->
  <meta name="geo.region" content="BR-SP">
  <meta name="geo.placename" content="São Paulo">
  <meta name="geo.position" content="-23.540155;-46.574210">
  <meta name="ICBM" content="-23.540155, -46.574210">

  <!-- Estilos -->

  <link rel="stylesheet" href="https://uppertruck.com/assets/css/preloader.css">
  <link rel="stylesheet" href="https://uppertruck.com/assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://uppertruck.com/assets/css/meanmenu.css">
  <link rel="stylesheet" href="https://uppertruck.com/assets/css/animate.min.css">
  <link rel="stylesheet" href="https://uppertruck.com/assets/css/owl.carousel.min.css">
  <link rel="stylesheet" href="https://uppertruck.com/assets/css/backToTop.css">
  <link rel="stylesheet" href="https://uppertruck.com/assets/css/magnific-popup.css">
  <link rel="stylesheet" href="https://uppertruck.com/assets/css/ui-range-slider.css">
  <link rel="stylesheet" href="https://uppertruck.com/assets/css/nice-select.css">
  <link rel="stylesheet" href="https://uppertruck.com/assets/css/fontAwesome5Pro.css">
  <link rel="stylesheet" href="https://uppertruck.com/assets/css/flaticon.css">
  <link rel="stylesheet" href="https://uppertruck.com/assets/css/default.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
    crossorigin="anonymous" />



  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

  <link href="/admin_blog/assets/css/blog-style.css" rel="stylesheet">
</head>

<style>
  body {
    font-family: 'Poppins', sans-serif;
    background: #f8f9fa;
  }

  .post-container {
    max-width: 800px;
    margin: auto;
    background: #fff;
    padding: 2rem;
    border-radius: 8px;
  }

  .post-image {
    max-height: 350px;
    object-fit: cover;
    width: 100%;
    margin-bottom: 1rem;
  }

  .post-content img {
    max-width: 100%;
    height: auto;
  }

  .h3,
  h3 {
    font-size: 1.15rem;
    margin-top: 3rem;
  }

  figure.table {
    margin: 2rem 0;
    overflow-x: auto;
  }

  figure.table table {
    width: 100%;
    border-collapse: collapse;
    font-size: 15px;
    background-color: #fff;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
  }

  figure.table {
    margin: 2rem 0;
    overflow-x: auto;
    border: 1px solid gray;
    border-radius: 10px;
  }

  figure.table thead {
    background-color: #0c4b8e;
    color: #fff;
    text-align: left;
  }

  figure.table thead th {
    padding: 14px 18px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
  }

  figure.table tbody td {
    padding: 14px 18px;
    border-bottom: 1px solid #e0e0e0;
    color: #333;
  }

  figure.table tbody tr:last-child td {
    border-bottom: none;
  }

  figure.table tbody tr:nth-child(even) {
    background-color: #f9f9f9;
  }

  figure.table tbody tr:hover {
    background-color: #f1f7ff;
    transition: background 0.3s ease;
  }

  tbody,
  td,
  tfoot,
  th,
  thead,
  tr {
    border-color: inherit;
    border-style: solid;
    border-width: 0;
    background: #edecf5;
  }

  li {
    margin-bottom: 1rem;
  }


  .post-content img {
    max-width: 100%;
    height: 500px;
    object-fit: cover;
    border-radius: 9px;
  }

  .h3,
  h3 {
    font-size: 1.55rem;
    margin-top: 3rem;
    margin-bottom: 25px;
  }

  @media screen and (max-width: 768px) {
    figure.table table {
      font-size: 14px;
    }

    figure.table thead th,
    figure.table tbody td {
      padding: 12px;
    }
  }

  .text-danger {
    --bs-text-opacity: 1;
    color: rgb(61 66 143) !important;
  }

  /* ========= Footer Premium — Uppertruck ========= */
  :root {
    --ft-bg: #0b0f14;
    --ft-bg-2: #0f1620;
    --ft-text: #dfe6ee;
    --ft-muted: #9fb0c3;
    --ft-accent: #39d98a;
    /* verde */
    --ft-accent-2: #7c4dff;
    /* roxo */
    --ft-danger: #ff4d67;
    --ft-card: rgba(255, 255, 255, .04);
    --ft-border: rgba(255, 255, 255, .08);
    --ft-gradient: linear-gradient(135deg, var(--ft-accent) 0%, var(--ft-accent-2) 100%);
  }

  .site-footer {
    color: var(--ft-text);
    background:
      radial-gradient(1200px 600px at 120% -10%, rgba(124, 77, 255, .15), transparent 60%),
      radial-gradient(1000px 400px at -10% 110%, rgba(57, 217, 138, .12), transparent 60%),
      var(--ft-bg);
    position: relative;
    overflow: hidden;
  }

  /* CTA */
  .footer-cta {
    background: linear-gradient(90deg, rgba(57, 217, 138, .12), rgba(124, 77, 255, .12));
    border-bottom: 1px solid var(--ft-border);
    padding: 18px 0;
  }

  .footer-cta h3 {
    font-weight: 800;
  }

  .footer-cta .btn {
    border-radius: 14px;
    padding: 10px 18px;
  }

  /* seção principal */
  .footer-top {
    position: relative;
  }

  .pt-80 {
    padding-top: 80px;
  }

  .pb-40 {
    padding-bottom: 40px;
  }

  .pt-40 {
    padding-top: 40px;
  }

  /* cards */
  .footer-card {
    background: linear-gradient(180deg, rgba(255, 255, 255, .03), rgba(255, 255, 255, .02));
    border: 1px solid var(--ft-border);
    border-radius: 18px;
    padding: 24px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, .2);
    transition: transform .25s ease, border-color .25s ease, box-shadow .25s ease;
  }

  .footer-card:hover {
    transform: translateY(-4px);
    border-color: rgba(124, 77, 255, .35);
    box-shadow: 0 16px 40px rgba(0, 0, 0, .28);
  }

  /* brand */
  .footer-brand .brand-mark {
    width: 28px;
    height: 28px;
    border-radius: 8px;
    background: var(--ft-gradient);
    box-shadow: 0 0 0 6px rgba(124, 77, 255, .15);
    display: inline-block;
  }

  .footer-brand span {
    letter-spacing: .2px;
  }

  /* títulos e listas */
  .footer-title {
    color: #fff;
    font-weight: 700;
    margin-bottom: 14px;
    letter-spacing: .2px;
  }

  .link-list li+li {
    margin-top: 6px;
  }

  .link-list a {
    color: var(--ft-text);
    text-decoration: none;
    opacity: .85;
    border-bottom: 1px dashed transparent;
    transition: opacity .2s ease, border-color .2s ease, color .2s ease, padding-left .2s ease;
  }

  .link-list a:hover {
    color: #fff;
    opacity: 1;
    border-color: var(--ft-border);
    padding-left: 2px;
  }

  /* contato */
  .contact-list li {
    margin-bottom: 6px;
    color: var(--ft-text);
    opacity: .9;
  }

  .contact-list a {
    color: inherit;
    text-decoration: none;
  }

  .contact-list i {
    color: var(--ft-accent);
  }

  /* social */
  .social-list .social-btn {
    --size: 40px;
    width: var(--size);
    height: var(--size);
    border-radius: 12px;
    display: grid;
    place-items: center;
    background: var(--ft-card);
    border: 1px solid var(--ft-border);
    color: #fff;
    transition: transform .2s ease, background .2s ease, border-color .2s ease, box-shadow .2s ease;
  }

  .social-list .social-btn:hover {
    transform: translateY(-2px);
    background: rgba(124, 77, 255, .2);
    border-color: rgba(124, 77, 255, .35);
    box-shadow: 0 8px 20px rgba(124, 77, 255, .25);
  }

  /* newsletter */
  .newsletter .input-wrap {
    position: relative;
  }

  .newsletter .form-control {
    background: rgba(255, 255, 255, .06);
    border: 1px solid var(--ft-border);
    color: #fff;
    border-radius: 14px;
    height: 48px;
    padding-left: 44px;
    box-shadow: inset 0 0 0 1px rgba(255, 255, 255, .02);
  }

  .newsletter .form-control::placeholder {
    color: var(--ft-muted);
  }

  .newsletter .form-control:focus {
    background: rgba(255, 255, 255, .08);
    border-color: rgba(124, 77, 255, .5);
    outline: none;
    box-shadow: 0 0 0 3px rgba(124, 77, 255, .25);
  }

  .newsletter i {
    position: absolute;
    left: 14px;
    top: 50%;
    transform: translateY(-50%);
    color: var(--ft-accent);
    opacity: .9;
  }

  .btn-gradient {
    background: var(--ft-gradient);
    color: #0a0a0a;
    border: none;
    border-radius: 14px;
    height: 48px;
    font-weight: 700;
    letter-spacing: .2px;
    transition: filter .2s ease, transform .15s ease;
  }

  .btn-gradient:hover {
    filter: brightness(1.05);
    transform: translateY(-1px);
  }

  /* badges/selos */
  .badges {
    gap: .75rem;
  }

  .badge-chip {
    display: inline-flex;
    align-items: center;
    padding: 8px 12px;
    border-radius: 999px;
    font-size: .9rem;
    color: var(--ft-text);
    background: rgba(255, 255, 255, .06);
    border: 1px solid var(--ft-border);
    backdrop-filter: blur(6px);
  }

  .badge-chip i {
    color: var(--ft-accent);
  }

  /* base inferior */
  .footer-bottom {
    border-top: 1px solid var(--ft-border);
    background: linear-gradient(180deg, rgba(255, 255, 255, .04), rgba(255, 255, 255, .02));
  }

  .link-underline {
    color: var(--ft-text);
    text-decoration: none;
    border-bottom: 1px solid transparent;
  }

  .link-underline:hover {
    border-color: var(--ft-text);
  }

  /* utilidades locais */
  .opacity-75 {
    opacity: .75;
  }

  /* responsivo */
  @media (max-width: 991.98px) {
    .pt-80 {
      padding-top: 56px;
    }

    .footer-cta h3 {
      font-size: 1.4rem;
    }

    .footer-card {
      padding: 20px;
    }
  }

  @media (max-width: 575.98px) {
    .footer-cta .btn {
      width: 100%;
    }

    .badge-chip {
      font-size: .85rem;
    }
  }

  /* ========= Footer — Uppertruck (Brand: Yellow/Black/White) ========= */
  :root {
    --ft-bg: #0a0a0a;
    /* preto de fundo */
    --ft-text: #f2f2f2;
    /* branco principal (descrições) */
    --ft-muted: #bdbdbd;
    /* branco suave */
    --ft-yellow: #ffd100;
    /* amarelo marca */
    --ft-yellow-2: #f0c200;
    /* amarelo levemente mais escuro */
    --ft-card: rgba(255, 255, 255, .04);
    --ft-border: rgba(255, 255, 255, .12);
  }

  /* contêiner geral */
  .site-footer {
    color: var(--ft-text);
    background: var(--ft-bg);
    position: relative;
    overflow: hidden;
  }

  /* faixa CTA superior opcional */
  .footer-cta {
    background: linear-gradient(180deg, rgba(255, 209, 0, .08), rgba(255, 255, 255, 0));
    border-bottom: 1px solid var(--ft-border);
    padding: 18px 0;
  }

  .footer-cta h3 {
    font-weight: 800;
    color: var(--ft-yellow);
  }

  .footer-cta p {
    color: var(--ft-text);
    opacity: .9;
  }

  .footer-cta .btn {
    background: var(--ft-yellow);
    color: #111;
    border-radius: 14px;
    padding: 10px 18px;
    font-weight: 700;
    border: 1px solid #000;
    transition: transform .15s ease, filter .2s ease;
  }

  .footer-cta .btn:hover {
    transform: translateY(-1px);
    filter: brightness(1.05);
  }

  /* seção principal */
  .footer-top {
    position: relative;
  }

  .pt-80 {
    padding-top: 80px;
  }

  .pb-40 {
    padding-bottom: 40px;
  }

  .pt-40 {
    padding-top: 40px;
  }

  /* cards */
  .footer-card {
    background: linear-gradient(180deg, rgba(255, 255, 255, .03), rgba(255, 255, 255, .015));
    border: 1px solid var(--ft-border);
    border-radius: 18px;
    padding: 24px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, .35);
    transition: transform .25s ease, border-color .25s ease, box-shadow .25s ease;
  }

  .footer-card:hover {
    transform: translateY(-4px);
    border-color: rgba(255, 209, 0, .45);
    box-shadow: 0 16px 40px rgba(0, 0, 0, .5);
  }

  /* brand */
  .footer-brand .brand-mark {
    width: 28px;
    height: 28px;
    border-radius: 8px;
    background: radial-gradient(100% 100% at 30% 20%, #fff 0%, var(--ft-yellow) 60%, var(--ft-yellow-2) 100%);
    box-shadow: 0 0 0 6px rgba(255, 209, 0, .18);
    display: inline-block;
  }

  .footer-brand span {
    letter-spacing: .2px;
    color: #fff;
  }

  /* títulos e listas */
  .footer-title {
    color: var(--ft-yellow);
    /* títulos em amarelo */
    font-weight: 800;
    margin-bottom: 14px;
    letter-spacing: .2px;
  }

  .link-list li+li {
    margin-top: 6px;
  }

  .link-list a {
    color: var(--ft-text);
    /* descrições em branco */
    text-decoration: none;
    opacity: .9;
    border-bottom: 1px dashed transparent;
    transition: opacity .2s ease, border-color .2s ease, color .2s ease, padding-left .2s ease;
  }

  .link-list a:hover {
    color: #fff;
    opacity: 1;
    border-color: var(--ft-border);
    padding-left: 2px;
  }

  /* contato */
  .contact-list li {
    margin-bottom: 6px;
    color: var(--ft-text);
    opacity: .95;
  }

  .contact-list a {
    color: inherit;
    text-decoration: none;
  }

  .contact-list i {
    color: var(--ft-yellow);
    /* ícones de contato em amarelo */
  }

  /* social */
  .social-list .social-btn {
    --size: 40px;
    width: var(--size);
    height: var(--size);
    border-radius: 12px;
    display: grid;
    place-items: center;
    background: var(--ft-card);
    border: 1px solid var(--ft-border);
    color: #fff;
    transition: transform .2s ease, background .2s ease, border-color .2s ease, box-shadow .2s ease, color .2s ease;
  }

  .social-list .social-btn:hover {
    transform: translateY(-2px);
    background: rgba(255, 209, 0, .12);
    border-color: rgba(255, 209, 0, .45);
    box-shadow: 0 8px 20px rgba(255, 209, 0, .18);
    color: var(--ft-yellow);
  }

  /* newsletter */
  .newsletter .input-wrap {
    position: relative;
  }

  .newsletter .form-control {
    background: rgba(255, 255, 255, .06);
    border: 1px solid var(--ft-border);
    color: #fff;
    border-radius: 14px;
    height: 48px;
    padding-left: 44px;
    box-shadow: inset 0 0 0 1px rgba(255, 255, 255, .02);
  }

  .newsletter .form-control::placeholder {
    color: var(--ft-muted);
  }

  .newsletter .form-control:focus {
    background: rgba(255, 255, 255, .08);
    border-color: rgba(255, 209, 0, .6);
    outline: none;
    box-shadow: 0 0 0 3px rgba(255, 209, 0, .25);
  }

  .newsletter i {
    position: absolute;
    left: 14px;
    top: 50%;
    transform: translateY(-50%);
    color: var(--ft-yellow);
    opacity: .95;
  }

  .btn-gradient {
    background: linear-gradient(180deg, var(--ft-yellow), var(--ft-yellow-2));
    color: #111;
    /* texto escuro pra contraste */
    border: 1px solid #000;
    border-radius: 14px;
    height: 48px;
    font-weight: 800;
    letter-spacing: .2px;
    transition: filter .2s ease, transform .15s ease, box-shadow .2s ease;
  }

  .btn-gradient:hover {
    filter: brightness(1.05);
    transform: translateY(-1px);
    box-shadow: 0 10px 24px rgba(255, 209, 0, .25);
  }

  /* badges/selos */
  .badges {
    gap: .75rem;
  }

  .badge-chip {
    display: inline-flex;
    align-items: center;
    padding: 8px 12px;
    border-radius: 999px;
    font-size: .9rem;
    color: var(--ft-text);
    background: rgba(255, 255, 255, .06);
    border: 1px solid var(--ft-border);
    backdrop-filter: blur(6px);
  }

  .badge-chip i {
    color: var(--ft-yellow);
  }

  /* base inferior */
  .footer-bottom {
    border-top: 1px solid var(--ft-border);
    background: linear-gradient(180deg, rgba(255, 255, 255, .03), rgba(255, 255, 255, .015));
  }

  .footer-bottom p,
  .footer-bottom a {
    color: var(--ft-text);
  }

  .link-underline {
    text-decoration: none;
    border-bottom: 1px solid transparent;
  }

  .link-underline:hover {
    border-color: var(--ft-text);
  }

  /* utilidades locais */
  .opacity-75 {
    opacity: .75;
  }

  .h3,
  h3 {
    font-size: 2.55rem;
    margin-top: 3rem;
    margin-bottom: 25px;
  }

  /* responsivo */
  @media (max-width: 991.98px) {
    .pt-80 {
      padding-top: 56px;
    }

    .footer-cta h3 {
      font-size: 1.35rem;
    }

    .footer-card {
      padding: 20px;
    }
  }

  @media (max-width: 575.98px) {
    .footer-cta .btn {
      width: 100%;
    }

    .badge-chip {
      font-size: .85rem;
    }
  }
</style>

<body>

  <?php include('includes/header3.php') ?>


  <?php
  // Buscar categorias do post
  $stmt_cat = $pdo->prepare("SELECT c.name FROM post_tags pt JOIN tags c ON pt.tag_id = c.id WHERE pt.post_id = ?");
  $stmt_cat->execute([$post['id']]);
  $categorias = $stmt_cat->fetchAll(PDO::FETCH_COLUMN);

  // Buscar categoria principal para o banner (primeira associada)
  $stmt_main_cat = $pdo->prepare("SELECT t.name FROM post_tags pt JOIN tags t ON pt.tag_id = t.id WHERE pt.post_id = ? LIMIT 1");
  $stmt_main_cat->execute([$post['id']]);
  $categoria_principal = $stmt_main_cat->fetchColumn();

  // Últimos posts
  $ultimos = $pdo->query("SELECT title, slug, image, published_at FROM posts WHERE status = 'publicado' ORDER BY published_at DESC LIMIT 3")->fetchAll();
  ?>

  <!-- Banner com overlay de gradiente -->
  <?php
$base_url = 'https://' . $_SERVER['HTTP_HOST'];
?>

  <!-- Banner com overlay de gradiente -->
  <section class="post-banner text-white position-relative">
    <div class="container-fluid" style="--bs-gutter-x: 0;">
      <img src="<?= $base_url ?>/admin_blog/<?= $post['image'] ?>" alt="<?= htmlspecialchars($post['title']) ?>"
        class="img-fluid w-100 banner-img loplop" style="max-height: 500px; object-fit: cover;">
      <div class="banner-overlay position-absolute top-0 start-0 w-100 h-100"
        style="background: linear-gradient(to bottom, rgba(0,0,0,0.4), rgba(0,0,0,0.85)); z-index: 1;"></div>
      <div class="banner-content container position-absolute top-50 start-50 translate-middle text-center"
        style="z-index: 2;">
        <p class="small fw-semibold mb-1">
          <?= htmlspecialchars($post['categoria_nome'] ?? 'Sem categoria') ?>
        </p>
        <h1 class="fw-bold display-5">
          <?= htmlspecialchars($post['title']) ?> <br><br>
        </h1>
        <p class="mb-0">
          Por: <strong>
            <?= htmlspecialchars($settings['site_name'] ?? 'Nossa Empresa') ?>
          </strong>
        </p>
      </div>
    </div>
  </section>

  <!-- Conteúdo e lateral -->
  <section>
    <div class="container py-5">
      <div class="row">
        <!-- Coluna principal -->
        <div class="col-lg-12">
          <div class="post-content mb-4 mx-auto">
            <?= $post['content'] ?>

            <hr>
            <b>Tags:</b>
            <?php if ($categorias): ?>
            <div class="mb-4">
              <?php foreach ($categorias as $cat): ?>
              <span class="badge bg-primary me-1">
                <?= htmlspecialchars($cat) ?>
              </span>
              <?php endforeach; ?>
            </div>
            <?php endif; ?>
            <hr>
          </div>

          <!-- Compartilhar -->
          <div class="d-flex gap-2 flex-wrap mb-4 post-content mb-4 mx-auto">
            <span class="fw-semibold">Compartilhar:</span>
            <a href="https://wa.me/?text=<?= urlencode($post['title'] . " \n\nLeia agora: $canonical") ?>"
              target="_blank"
              class="btn btn-sm btn-success"><i class="fab fa-whatsapp me-1"></i> WhatsApp</a>
            <a href="https://www.facebook.com/sharer/sharer.php?u=<?= urlencode($canonical) ?>" target="_blank"
              class="btn btn-sm btn-primary"><i class="fab fa-facebook-f me-1"></i> Facebook</a>
            <a href="https://twitter.com/intent/tweet?text=<?= urlencode($post['title']) ?>&url=<?= urlencode($canonical) ?>"
              target="_blank" class="btn btn-sm btn-info text-white"><i class="fab fa-twitter me-1"></i> Twitter</a>
            <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?= urlencode($canonical) ?>&title=<?= urlencode($post['title']) ?>"
              target="_blank" class="btn btn-sm btn-secondary"><i class="fab fa-linkedin-in me-1"></i> LinkedIn</a>
          </div>
        </div>

        <!-- Sidebar: Últimos posts -->
        <div class="col-lg-12 post-content mb-4 mx-auto">
          <br>
          <hr>
          <a href="/blog" class="btn btn-outline-primary">← Voltar para o blog</a>
          <br>
          <hr><br>

          <h5 class="fw-bold mb-3">Últimas postagens</h5>
          <?php foreach ($ultimos as $p): ?>
          <div class="d-flex mb-3">
            <img src="<?= $base_url ?>/admin_blog/<?= $p['image'] ?>" alt="<?= $p['title'] ?>"
              style="width: 80px; height: 60px; object-fit: cover;" class="me-3 rounded">
            <div>
              <a href="<?= $base_url ?>/blog/<?= $p['slug'] ?>"
                class="fw-semibold text-dark text-decoration-none d-block">
                <?= htmlspecialchars($p['title']) ?>
              </a>
              <small class="text-muted">
                <?= $formatter->format(strtotime($p['published_at'])) ?>
              </small>
            </div>
          </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </section>

  <footer class="site-footer text-light">
    <!-- faixa de destaque/CTA opcional -->
    <div class="footer-cta">
      <div class="container">
        <div class="row align-items-center gy-3">
          <div class="col-lg-8">
            <h3 class="mb-0">Entregas ágeis para o seu negócio</h3>
            <p class="mb-0 opacity-75">Soluções de transporte sob medida: coletas rápidas, rastreio e atendimento
              humano.</p>
          </div>
          <div class="col-lg-4 text-lg-end">
            <a href="contato.php" class="btn btn-light btn-lg fw-semibold">Fale com a Uppertruck</a>
          </div>
        </div>
      </div>
    </div>

    <!-- conteúdo principal -->
    <section class="footer-top pt-80 pb-40">
      <div class="container">
        <div class="row gy-5">
          <!-- Brand / Sobre -->
          <div class="col-12 col-lg-4">
            <div class="footer-card h-100">
              <a href="/" class="footer-brand d-inline-flex align-items-center gap-2 mb-3 text-decoration-none">
                <span class="brand-mark" aria-hidden="true"></span>
                <span class="fs-4 fw-bold text-white">Uppertruck Express</span>
              </a>
              <p class="mb-4">
                A Uppertruck Express surge em 2016 quando os mercados exigiram uma “virada de chave” digital.
                Hoje entregamos velocidade, segurança e atendimento próximo em todo o Brasil.
              </p>

              <ul class="social-list list-unstyled d-flex gap-2 mb-0" aria-label="Redes sociais">
                <li><a class="social-btn" href="https://facebook.com/uppertruck" target="_blank"
                    aria-label="Facebook"><i class="fab fa-facebook-f"></i></a></li>
                <li><a class="social-btn" href="https://instagram.com/uppertruck" target="_blank"
                    aria-label="Instagram"><i class="fab fa-instagram"></i></a></li>
                <li><a class="social-btn" href="https://twitter.com/uppertruck" target="_blank" aria-label="Twitter"><i
                      class="fab fa-twitter"></i></a></li>
                <li><a class="social-btn" href="https://youtube.com/@uppertruck" target="_blank" aria-label="YouTube"><i
                      class="fab fa-youtube"></i></a></li>
              </ul>
            </div>
          </div>

          <!-- Navegação -->
          <div class="col-6 col-lg-4">
            <div class="footer-card h-100">
              <h5 class="footer-title">Institucional</h5>
              <ul class="link-list list-unstyled">
                <li><a href="quemsomos.php">Sobre nós</a></li>
                <li><a href="servicos.php">Serviços</a></li>
                <li><a href="contato.php">Contato</a></li>
                <li><a href="politica.php">Política de Privacidade</a></li>
              </ul>
            </div>
          </div>

          <!-- Serviços / atalhos -->


          <!-- Contato + Newsletter -->
          <div class="col-12 col-lg-3">
            <div class="footer-card h-100">
              <h5 class="footer-title">Contato</h5>
              <ul class="contact-list list-unstyled mb-4">
                <li><i class="fa-regular fa-phone me-2"></i>São Paulo, SP — Brasil</li>
                <li><i class="fas fa-phone me-2"></i>
                  <a href="tel:+554497370488">55 44 97370488</a>
                </li>
                <li><i class="fa-regular fa-envelope me-2"></i><a
                    href="mailto:contato@uppertruck.com.br">contato@uppertruck.com.br</a></li>
                <li><i class="fa-regular fa-clock me-2"></i>Seg–Sex: 8h–18h</li>
              </ul>

              <h6 class="footer-title small mb-2">Receba novidades</h6>
              <form action="#" method="post" class="newsletter needs-validation" novalidate>
                <div class="input-wrap mb-2">
                  <input type="email" class="form-control" placeholder="Seu e-mail" required>
                  <i class="fas fa-envelope" aria-hidden="true"></i>
                  <div class="invalid-feedback">Informe um e-mail válido.</div>
                </div>
                <!-- honeypot -->
                <input type="text" name="website" class="d-none" tabindex="-1" autocomplete="off">
                <button class="btn btn-gradient w-100" type="submit">Inscreva-se</button>
              </form>
            </div>
          </div>
        </div>

        <!-- selos / meios de pagamento (opcional) -->
        <div class="row pt-40">
          <div class="col-12">
            <div class="badges d-flex flex-wrap align-items-center gap-3">
              <span class="badge-chip"><i class="fa-regular fa-shield-check me-2"></i>Empresa verificada</span>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- base inferior -->
    <div class="footer-bottom py-3">
      <div class="container">
        <div class="d-flex flex-column flex-md-row align-items-center justify-content-between gap-2">
          <p class="mb-0 small opacity-75">
            © <span id="year"></span> Uppertruck Express. Todos os direitos reservados.
          </p>
          <ul class="small mb-0 list-unstyled d-flex gap-3">
            <li><a href="termos.php" class="link-underline">Termos de Uso</a></li>
            <li><a href="cookies.php" class="link-underline">Política de Cookies</a></li>
          </ul>
        </div>
      </div>
    </div>
  </footer>

  <script>
    // ano dinâmico (sem dependências)
    document.getElementById('year').textContent = new Date().getFullYear();
  </script>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

  <script src="https://uppertruck.com/assets/js/vendor/jquery-3.6.0.min.js"></script>
  <script src="https://uppertruck.com/assets/js/bootstrap.bundle.min.js"></script>
  <script src="https://uppertruck.com/assets/js/meanmenu.js"></script>



</body>



</html>