<?php
require_once __DIR__ . '/../components/home/path-bootstrap.php';

ob_start(static function (string $html): string {
    $adminBase = UPPERTRUCK_URL_PREFIX . '/sistema/';

    return str_replace(
        ['/admin_blog/', 'href="modules/', "href='modules/", 'src="assets/', "src='assets/", 'data-img="assets/', "data-img='assets/"],
        [$adminBase, 'href="' . $adminBase . 'modules/', "href='" . $adminBase . 'modules/', 'src="' . $adminBase . 'assets/', "src='" . $adminBase . 'assets/', 'data-img="' . $adminBase . 'assets/', "data-img='" . $adminBase . 'assets/'],
        $html
    );
});

require __DIR__ . '/../admin_blog/dashboard.php';
