<?php
require_once '../config/config.php';
require_once '../config/db.php';

$stmt = $pdo->prepare("
    SELECT id, title, scheduled_at, status 
    FROM posts 
    WHERE scheduled_at IS NOT NULL AND is_deleted = FALSE
    ORDER BY scheduled_at ASC
");
$stmt->execute();
$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);

$eventos = [];

foreach ($posts as $post) {
    // Cor opcional baseada no status
    $cor = match($post['status']) {
        'publicado' => '#28a745',   // verde
        'agendado'  => '#0d6efd',   // azul
        default     => '#6c757d'    // cinza
    };

    $eventos[] = [
        'id'    => $post['id'],
        'title' => $post['title'],
        'start' => $post['scheduled_at'],
        'color' => $cor
    ];
}

header('Content-Type: application/json');
echo json_encode($eventos);