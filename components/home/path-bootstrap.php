<?php
if (!function_exists('uppertruck_is_local_host')) {
    function uppertruck_is_local_host(): bool
    {
        $host = strtolower((string) ($_SERVER['HTTP_HOST'] ?? ''));
        $host = preg_replace('/:\d+$/', '', $host);

        return in_array($host, ['localhost', '127.0.0.1', '::1'], true);
    }
}

if (!defined('UPPERTRUCK_URL_PREFIX')) {
    define('UPPERTRUCK_URL_PREFIX', uppertruck_is_local_host() ? '/uppertruck' : '');
}

if (!defined('UPPERTRUCK_PATH_BUFFER_STARTED')) {
    define('UPPERTRUCK_PATH_BUFFER_STARTED', true);

    ob_start(static function (string $html): string {
        return preg_replace(
            '~/uppertruck(?=/|["\'?#\s])~',
            UPPERTRUCK_URL_PREFIX,
            $html
        );
    });
}
