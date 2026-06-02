<?php
$script = basename((string) ($_SERVER['SCRIPT_FILENAME'] ?? ''));
$allowedScripts = [
    'login.php',
    'logout.php',
    'validate.php',
];

if (!in_array($script, $allowedScripts, true)) {
    http_response_code(404);
    exit;
}

$legacyDirectory = __DIR__ . '/../../admin_blog/auth';
chdir($legacyDirectory);
require $legacyDirectory . '/' . $script;
