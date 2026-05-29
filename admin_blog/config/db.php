<?php
$dbConfig = [
    'host' => 'localhost',
    'database' => 'ivanfe67_newblog',
    'username' => 'ivanfe67_newblog',
    'password' => 'VU9f2vg)*AD?',
    'charset' => 'utf8mb4',
];

$localConfigFile = __DIR__ . '/db.local.php';
if (is_file($localConfigFile)) {
    $localConfig = require $localConfigFile;
    if (is_array($localConfig)) {
        $dbConfig = array_merge($dbConfig, array_filter($localConfig, static function ($value) {
            return $value !== null && $value !== '';
        }));
    }
}

$dbConfig['host'] = getenv('UPPERTRUCK_DB_HOST') ?: $dbConfig['host'];
$dbConfig['database'] = getenv('UPPERTRUCK_DB_NAME') ?: $dbConfig['database'];
$dbConfig['username'] = getenv('UPPERTRUCK_DB_USER') ?: $dbConfig['username'];
$dbConfig['password'] = getenv('UPPERTRUCK_DB_PASS') ?: $dbConfig['password'];
$dbConfig['charset'] = getenv('UPPERTRUCK_DB_CHARSET') ?: $dbConfig['charset'];

$dsn = sprintf(
    'mysql:host=%s;dbname=%s;charset=%s',
    $dbConfig['host'],
    $dbConfig['database'],
    $dbConfig['charset']
);

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $dbConfig['username'], $dbConfig['password'], $options);
} catch (PDOException $e) {
    $isDebug = isset($debug) && $debug === true;
    $message = 'Erro ao conectar ao banco de dados.';
    $logDir = dirname(__DIR__) . '/logs';

    if (is_dir($logDir) && is_writable($logDir)) {
        error_log(
            '[' . date('Y-m-d H:i:s') . '] ' . $e->getMessage() . PHP_EOL,
            3,
            $logDir . '/db-error.log'
        );
    }

    if ($isDebug) {
        $message .= ' ' . $e->getMessage();
    }

    die($message);
}
