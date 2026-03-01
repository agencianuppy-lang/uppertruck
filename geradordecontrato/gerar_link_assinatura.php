<?php
// ------- Sessão (site-wide) -------
function set_session_cookie_sitewide(): void {
    $secure = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on');
    $host   = $_SERVER['HTTP_HOST'] ?? 'localhost';
    $params = [
        'lifetime' => 0,
        'path'     => '/',
        'secure'   => $secure,
        'httponly' => true,
        'samesite' => 'Lax',
    ];
    if ($host !== 'localhost' && strpos($host, 'localhost') === false) {
        $domain = $host;
        if ($domain[0] !== '.') { $domain = '.'.$domain; }
        $params['domain'] = $domain;
    }
    session_set_cookie_params($params);
}
set_session_cookie_sitewide();
session_start();

// ------- Cabeçalho JSON -------
header('Content-Type: application/json; charset=utf-8');

// ------- Autorização: exige admin logado -------
if (empty($_SESSION['user_id'])) {
    http_response_code(401);
    echo json_encode(['ok' => false, 'msg' => 'Não autenticado']);
    exit;
}

// ------- Conexão -------
require __DIR__ . '/conexao/key.php'; // deve criar $conn = new mysqli(...)
if (!($conn instanceof mysqli) || $conn->connect_errno) {
    http_response_code(500);
    echo json_encode(['ok' => false, 'msg' => 'Falha na conexão com o banco.']);
    exit;
}
$conn->set_charset('utf8mb4');

try {
    // ------- Parâmetro -------
    $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
    if ($id <= 0) {
        http_response_code(400);
        echo json_encode(['ok' => false, 'msg' => 'ID inválido']);
        exit;
    }

    // ------- Verifica existência -------
    $chk = $conn->prepare("SELECT id FROM contratos WHERE id = ? LIMIT 1");
    if (!$chk) { throw new Exception('Erro no prepare(SELECT): ' . $conn->error); }
    $chk->bind_param('i', $id);
    $chk->execute();
    $exists = $chk->get_result()->fetch_assoc();
    $chk->close();

    if (!$exists) {
        http_response_code(404);
        echo json_encode(['ok' => false, 'msg' => 'Contrato não encontrado']);
        exit;
    }

    // ------- Token & expiração -------
    $token  = bin2hex(random_bytes(16));                    // 32 chars hex
    $expiry = date('Y-m-d H:i:s', strtotime('+7 days'));    // validade 7 dias

    // ------- Atualiza contrato -------
    $sql = "UPDATE contratos
               SET assinatura_token   = ?,
                   assinatura_expires = ?,
                   assinatura_nome    = NULL,
                   assinatura_at      = NULL,
                   assinatura_path    = NULL,
                   foto_path          = NULL
             WHERE id = ?
             LIMIT 1";
    $stmt = $conn->prepare($sql);
    if (!$stmt) { throw new Exception('Erro no prepare(UPDATE): ' . $conn->error); }
    $stmt->bind_param('ssi', $token, $expiry, $id);
    if (!$stmt->execute()) { throw new Exception('Erro no execute(UPDATE): ' . $stmt->error); }
    $stmt->close();

    // ------- URL pública para assinatura -------
    $scheme   = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') ? 'https' : 'http';
    $host     = $_SERVER['HTTP_HOST'] ?? 'localhost';
    $basePath = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');
    $publicUrl = $scheme . '://' . $host . $basePath . '/upload_foto.php?token='
               . rawurlencode($token) . '&id=' . $id;

    echo json_encode(['ok' => true, 'url' => $publicUrl, 'expires_at' => $expiry]);
} catch (Throwable $e) {
    http_response_code(500);
    echo json_encode(['ok' => false, 'msg' => 'Erro: ' . $e->getMessage()]);
}