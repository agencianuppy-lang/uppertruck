<?php
if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST') {
    require __DIR__ . '/../admin_blog/auth/validate.php';
    exit;
}

require __DIR__ . '/../admin_blog/auth/login.php';
