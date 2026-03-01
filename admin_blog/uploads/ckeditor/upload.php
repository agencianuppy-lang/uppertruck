<?php
if (isset($_FILES['upload'])) {
    $file = $_FILES['upload'];
    $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    $allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

    if (!in_array($ext, $allowed)) {
        http_response_code(400);
        echo json_encode(['error' => ['message' => 'Tipo de arquivo não permitido.']]);
        exit;
    }

    $fileName = uniqid() . '.' . $ext;
    $uploadDir = __DIR__ . '/';
    $uploadUrl = '/admin_blog/uploads/ckeditor/' . $fileName;

    if (move_uploaded_file($file['tmp_name'], $uploadDir . $fileName)) {
        echo json_encode(['url' => $uploadUrl]);
    } else {
        http_response_code(500);
        echo json_encode(['error' => ['message' => 'Erro ao salvar o arquivo.']]);
    }
}