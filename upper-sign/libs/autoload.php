<?php
// /upper-sign/libs/autoload.php
// Carrega automaticamente todas as classes da FPDI 2.6.4 (sem Composer)

spl_autoload_register(function($class) {
    $prefix = 'setasign\\Fpdi\\';
    $baseDir = __DIR__ . '/src/';
    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        return;
    }
    $relativeClass = substr($class, $len);
    $file = $baseDir . str_replace('\\', '/', $relativeClass) . '.php';
    if (file_exists($file)) {
        require $file;
    }
});