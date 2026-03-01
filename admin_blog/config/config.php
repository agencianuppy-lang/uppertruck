<?php
$site_name = 'Blog Corporativo';

// URL base do painel administrativo (ex: http://localhost/admin_blog)
$base_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http");
$base_url .= "://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
$base_url = str_replace('/config/config.php', '', $base_url);

// URL pública reutilizável para links visíveis fora do admin
$public_url = (isset($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'];

// Fuso horário e idioma padrão
date_default_timezone_set('America/Sao_Paulo');
setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'portuguese');

// Controle de debug
$debug = true;

if ($debug) {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
} else {
    ini_set('display_errors', 0);
}