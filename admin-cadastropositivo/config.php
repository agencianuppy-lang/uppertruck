<?php
declare(strict_types=1);

date_default_timezone_set('America/Sao_Paulo');

const DB_HOST = 'localhost';
const DB_NAME = 'ivanfe67_cadastropositivo';
const DB_USER = 'ivanfe67_cadastropositivo';
const DB_PASS = '@aBLLxeTCAZ%';

const ADMIN_USER = 'upper';
const ADMIN_PASS = 'amigao';

function get_pdo(): PDO
{
    static $pdo = null;

    if ($pdo instanceof PDO) {
        return $pdo;
    }

    $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8mb4';
    $pdo = new PDO($dsn, DB_USER, DB_PASS, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ]);

    return $pdo;
}
