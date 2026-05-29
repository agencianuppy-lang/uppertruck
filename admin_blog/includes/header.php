<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../../components/home/path-bootstrap.php';

if (!defined('UPPERTRUCK_ADMIN_URL_BUFFER_STARTED')) {
    define('UPPERTRUCK_ADMIN_URL_BUFFER_STARTED', true);

    ob_start(static function (string $html): string {
        $adminBase = UPPERTRUCK_URL_PREFIX . '/sistema/';

        return str_replace(
            ['/admin_blog/', 'href="modules/', "href='modules/", 'src="assets/', "src='assets/", 'data-img="assets/', "data-img='assets/"],
            [$adminBase, 'href="' . $adminBase . 'modules/', "href='" . $adminBase . 'modules/', 'src="' . $adminBase . 'assets/', "src='" . $adminBase . 'assets/', 'data-img="' . $adminBase . 'assets/', "data-img='" . $adminBase . 'assets/'],
            $html
        );
    });
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Painel |
		<?= $site_name ?>
	</title>

	<!-- Bootstrap 5 -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

	<!-- Font Awesome -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

	<!-- Animate.css -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

	<!-- AOS -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>

	<!-- SweetAlert2 -->
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

	<!-- CKEditor 5 -->
	<script src="https://uppertruck.com/admin_blog/assets/js/ckeditor.js"></script>

	<!-- FullCalendar -->
	<link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.9/main.min.css" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.9/main.min.js"></script>

	<!-- jQuery -->
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

	<!-- Estilos e scripts customizados -->
	<link rel="stylesheet" href="/admin_blog/assets/css/blog-style.css">
	<link href="/admin_blog/assets/css/ui-dashboard.css" rel="stylesheet">

	<link rel="icon" type="image/png" href="/admin_blog/assets/img/fav.png">





</head>

<body>
