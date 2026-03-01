<?php
// /upper-sign/config/config.php  (SEM Composer / SEM .env)
declare(strict_types=1);
mb_internal_encoding('UTF-8');
date_default_timezone_set('America/Sao_Paulo');

// ====== CONFIGURAÇÕES FIXAS ======
define('APP_ENV', 'dev'); // dev ou prod

define('DB_HOST', 'localhost');
define('DB_NAME', 'uppertru_upper_sign');
define('DB_USER', 'uppertru_upper_sign');
define('DB_PASS', '%q(ic@lT=~3j+5)u');

// Chave secreta única (já gerada pra você — pode manter assim)
define('TOKEN_SECRET', '9a72d0c3e154c2e81e4ab5b4973c7e82b9f44d1897f1e4a25cc4a6af01fcd6b7');
define('TOKEN_TTL_DAYS', 7);
// =================================================

// Erros (dev mostra; prod oculta)
error_reporting(E_ALL);
ini_set('display_errors', APP_ENV === 'dev' ? '1' : '0');

// Caminhos
define('USIGN_ROOT', dirname(__DIR__));
define('USIGN_PUBLIC', USIGN_ROOT);
define('USIGN_CONFIG', USIGN_ROOT . '/config');
define('USIGN_SRC',    USIGN_ROOT . '/src');
define('USIGN_DB',     USIGN_ROOT . '/db');
define('USIGN_STORAGE',USIGN_ROOT . '/storage');
define('USIGN_UPLOADS',   USIGN_STORAGE . '/uploads');
define('USIGN_SIGNATURES',USIGN_STORAGE . '/signatures');
define('USIGN_SIGNED',    USIGN_STORAGE . '/signed');
define('USIGN_TMP',       USIGN_STORAGE . '/tmp');

// Cria as pastas se não existirem
foreach ([USIGN_STORAGE, USIGN_UPLOADS, USIGN_SIGNATURES, USIGN_SIGNED, USIGN_TMP] as $dir) {
    if (!is_dir($dir)) { @mkdir($dir, 0755, true); }
}

// BASE_URL automático
if (!defined('BASE_URL') || !BASE_URL) {
    $scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
    $host = $_SERVER['HTTP_HOST'] ?? 'localhost';
    $scriptDir = rtrim(str_replace('\\','/', dirname($_SERVER['SCRIPT_NAME'] ?? '/upper-sign')), '/.');
    define('BASE_URL', rtrim($scheme.'://'.$host.$scriptDir, '/'));
}

// Funções JSON de resposta
if (!function_exists('json_ok')) {
    function json_ok(array $extra=[]): void {
        header('Content-Type: application/json; charset=UTF-8');
        echo json_encode(array_merge(['success'=>true], $extra), JSON_UNESCAPED_UNICODE);
        exit;
    }
}
if (!function_exists('json_fail')) {
    function json_fail(string $message='Erro', array $extra=[]): void {
        header('Content-Type: application/json; charset=UTF-8');
        http_response_code(400);
        echo json_encode(array_merge(['success'=>false, 'message'=>$message], $extra), JSON_UNESCAPED_UNICODE);
        exit;
    }
}

// Headers de segurança
header('X-Content-Type-Options: nosniff');
header('X-Frame-Options: DENY');
header("Referrer-Policy: strict-origin-when-cross-origin");
header("Content-Security-Policy: default-src 'self'; img-src 'self' data: blob:; style-src 'self' 'unsafe-inline' https://cdn.jsdelivr.net https://fonts.googleapis.com; font-src https://fonts.gstatic.com 'self'; script-src 'self' 'unsafe-inline' https://cdn.jsdelivr.net; connect-src 'self'; frame-ancestors 'none'");

// Funções auxiliares
require_once USIGN_SRC . '/Helpers.php';