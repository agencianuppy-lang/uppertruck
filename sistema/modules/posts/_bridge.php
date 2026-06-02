<?php
$script = basename((string) ($_SERVER['SCRIPT_FILENAME'] ?? ''));
$allowedScripts = [
    'create.php',
    'delete.php',
    'edit.php',
    'edit_post.php',
    'generate_article.php',
    'generate_daily_post.php',
    'generate_image.php',
    'list.php',
    'list_posts.php',
    'novo_post.php',
    'restore.php',
    'salvar_post.php',
    'schedule.php',
    'store.php',
    'trash.php',
    'update.php',
    'view.php',
];

if (!in_array($script, $allowedScripts, true)) {
    http_response_code(404);
    exit;
}

$legacyDirectory = __DIR__ . '/../../../admin_blog/modules/posts';
chdir($legacyDirectory);
require $legacyDirectory . '/' . $script;
