<?php
if (!isset($_GET['text'])) {
    echo json_encode(['slug' => '']);
    exit;
}

require_once 'functions.php';

$texto = $_GET['text'];
$slug = gerarSlug($texto);

echo json_encode(['slug' => $slug]);