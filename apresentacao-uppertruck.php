<?php
declare(strict_types=1);

$pdfUrl = 'https://uppertruck.com/apresentacao-uppertruck.pdf';
$pageUrl = 'https://uppertruck.com/apresentacao-uppertruck.php';
$imageUrl = 'https://www.uppertruck.com/img/1000.jpg';

header('Content-Type: text/html; charset=utf-8');
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Apresentacao Uppertruck | Transportadora Digital</title>
    <meta name="description"
        content="A Uppertruck se tornou a transportadora digital mais buscada e bem avaliada do Brasil, conectando veiculos de diferentes portes para entregas mais ageis e consolidacao inteligente de cargas.">
    <meta name="robots" content="index,follow,max-image-preview:large">
    <link rel="canonical" href="<?= htmlspecialchars($pageUrl, ENT_QUOTES, 'UTF-8') ?>">

    <meta property="og:locale" content="pt_BR">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="Uppertruck">
    <meta property="og:title" content="Apresentacao Uppertruck | Transportadora Digital">
    <meta property="og:description"
        content="Somos a transportadora digital mais buscada e bem avaliada do Brasil. Conectamos veiculos em cidades estrategicas e consolidamos cargas para acelerar entregas e otimizar o frete.">
    <meta property="og:url" content="<?= htmlspecialchars($pageUrl, ENT_QUOTES, 'UTF-8') ?>">
    <meta property="og:image" content="<?= htmlspecialchars($imageUrl, ENT_QUOTES, 'UTF-8') ?>">
    <meta property="og:image:secure_url" content="<?= htmlspecialchars($imageUrl, ENT_QUOTES, 'UTF-8') ?>">
    <meta property="og:image:type" content="image/jpeg">
    <meta property="og:image:alt" content="Apresentacao institucional da Uppertruck">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Apresentacao Uppertruck | Transportadora Digital">
    <meta name="twitter:description"
        content="Conectamos veiculos em cidades estrategicas e consolidamos cargas para entregas mais ageis e melhor aproveitamento do frete.">
    <meta name="twitter:image" content="<?= htmlspecialchars($imageUrl, ENT_QUOTES, 'UTF-8') ?>">

    <meta http-equiv="refresh" content="1;url=<?= htmlspecialchars($pdfUrl, ENT_QUOTES, 'UTF-8') ?>">

    <script>
        window.setTimeout(function () {
            window.location.replace(<?= json_encode($pdfUrl) ?>);
        }, 1000);
    </script>
</head>
<body></body>
</html>
