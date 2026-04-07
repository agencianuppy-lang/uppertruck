<?php
declare(strict_types=1);

require_once __DIR__ . '/config.php';

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

function is_admin_logged_in(): bool
{
    return isset($_SESSION['cadastropositivo_admin']) && $_SESSION['cadastropositivo_admin'] === true;
}

function require_admin_login(): void
{
    if (!is_admin_logged_in()) {
        header('Location: login.php');
        exit;
    }
}

function admin_login(string $user, string $pass): bool
{
    if (hash_equals(ADMIN_USER, $user) && hash_equals(ADMIN_PASS, $pass)) {
        $_SESSION['cadastropositivo_admin'] = true;
        $_SESSION['cadastropositivo_login_at'] = time();
        return true;
    }

    return false;
}

function admin_logout(): void
{
    $_SESSION = [];
    if (ini_get('session.use_cookies')) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000, $params['path'], $params['domain'], (bool) $params['secure'], (bool) $params['httponly']);
    }
    session_destroy();
}

function e(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}

function format_datetime(?string $value): string
{
    if (!$value) {
        return '-';
    }

    $ts = strtotime($value);
    if ($ts === false) {
        return $value;
    }

    return date('d/m/Y H:i', $ts);
}

function decode_json_list(?string $json): array
{
    if ($json === null || trim($json) === '') {
        return [];
    }

    $data = json_decode($json, true);
    if (!is_array($data)) {
        return [];
    }

    return array_values(array_filter(array_map(static function ($item) {
        return is_scalar($item) ? trim((string) $item) : '';
    }, $data), static function ($item) {
        return $item !== '';
    }));
}
