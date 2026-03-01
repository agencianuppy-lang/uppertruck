<?php
header('Content-Type: application/json; charset=utf-8');

try {
    // Ajuste o caminho conforme a localização do arquivo
    // Se este PHP está na raiz /uppertruck-system/
    include __DIR__ . '/includes/auth.php';
    include __DIR__ . '/includes/db.php';

    if (!isset($conn) || !($conn instanceof mysqli)) {
        throw new Exception('Falha na conexão com o banco.');
    }

    $conn->set_charset('utf8mb4');

    $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
    if ($id <= 0) {
        http_response_code(400);
        echo json_encode(['ok' => false, 'msg' => 'ID inválido']);
        exit;
    }

    // Verifica se documento existe
    $check = $conn->prepare("SELECT id FROM documentos WHERE id = ?");
    $check->bind_param('i', $id);
    $check->execute();
    $exists = $check->get_result()->fetch_assoc();
    $check->close();
    if (!$exists) {
        http_response_code(404);
        echo json_encode(['ok' => false, 'msg' => 'Documento não encontrado']);
        exit;
    }

    // Gera token e expiração
    $token  = bin2hex(random_bytes(16));
    $expiry = date('Y-m-d H:i:s', strtotime('+7 days'));

    $stmt = $conn->prepare("UPDATE documentos SET upload_token = ?, token_expires = ? WHERE id = ?");
    if (!$stmt) {
        throw new Exception('Prepare falhou: ' . $conn->error);
    }
    $stmt->bind_param('ssi', $token, $expiry, $id);
    if (!$stmt->execute()) {
        throw new Exception('Update falhou: ' . $stmt->error);
    }
    $stmt->close();

    // URL pública (ajuste conforme o fluxo)
    $linkPublico = "/uppertruck-system/upload_foto.php?token={$token}&id={$id}";

    echo json_encode(['ok' => true, 'url' => $linkPublico]);
} catch (Throwable $e) {
    http_response_code(500);
    echo json_encode(['ok' => false, 'msg' => $e->getMessage()]);
}