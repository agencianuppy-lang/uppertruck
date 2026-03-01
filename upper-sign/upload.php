<?php
// /upper-sign/upload.php
require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/config/database.php';   // garante $pdo

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    json_fail('Método inválido.');
}

if (empty($_FILES['pdf']) || $_FILES['pdf']['error'] !== UPLOAD_ERR_OK) {
    json_fail('Envie um arquivo PDF válido.');
}

$description  = trim($_POST['description'] ?? '');
$default_page = (int)($_POST['default_page'] ?? 1);
$offset_x     = (int)($_POST['offset_x'] ?? -20);
$offset_y     = (int)($_POST['offset_y'] ?? -20);
$scale        = (int)($_POST['scale'] ?? 100);

// Validações simples
if ($description === '') json_fail('Descrição é obrigatória.');
if ($scale < 10 || $scale > 300) json_fail('Escala deve estar entre 10% e 300%.');

// MIME/tamanho
$f = $_FILES['pdf'];
$maxBytes = 20 * 1024 * 1024; // 20MB
if ($f['size'] <= 0 || $f['size'] > $maxBytes) json_fail('PDF muito grande (máx. 20MB).');

$finfo = finfo_open(FILEINFO_MIME_TYPE);
$mime = finfo_file($finfo, $f['tmp_name']) ?: '';
finfo_close($finfo);
// alguns hosts retornam octet-stream para PDF; aceitar ambos
if ($mime !== 'application/pdf' && $mime !== 'application/octet-stream') {
    json_fail('Arquivo não parece ser um PDF (mime: ' . $mime . ').');
}

// Gera UUID e move arquivo
$docId = uuidv4();
$storedFilename = $docId . '.pdf';
$destPath = USIGN_UPLOADS . '/' . $storedFilename;
if (!@move_uploaded_file($f['tmp_name'], $destPath)) {
    json_fail('Falha ao salvar o PDF.');
}

// Hash SHA-256 do PDF
$pdfHash = hash_file('sha256', $destPath);

// Salva DOCUMENT
try {
    $stmt = $pdo->prepare("
        INSERT INTO documents (
            id, original_filename, stored_path, pdf_sha256, status,
            default_page, default_offset_x_px, default_offset_y_px, default_scale_pct,
            created_at
        ) VALUES (?, ?, ?, ?, 'PENDING', ?, ?, ?, ?, NOW())
    ");
    $stmt->execute([
        $docId,
        $_FILES['pdf']['name'],
        'storage/uploads/' . $storedFilename, // caminho relativo para referência
        $pdfHash,
        $default_page ?: null,
        $offset_x,
        $offset_y,
        $scale
    ]);
} catch (Throwable $e) {
    @unlink($destPath);
    json_fail('Erro ao salvar no banco: ' . $e->getMessage());
}

// ===== GERA O TOKEN AQUI MESMO (sem função externa) =====
$ttlDays   = (int)TOKEN_TTL_DAYS;
$expiresAt = (new DateTimeImmutable('now'))->modify("+{$ttlDays} days");

// token = HMAC( docId | expTimestamp | random, TOKEN_SECRET ) => 64 chars
$random    = bin2hex(random_bytes(16));
$payload   = $docId . '|' . $expiresAt->getTimestamp() . '|' . $random;
$token     = hash_hmac('sha256', $payload, TOKEN_SECRET);

// Salva token no banco
try {
    $stmt = $pdo->prepare("
        INSERT INTO sign_tokens (document_id, token, expires_at, created_at)
        VALUES (?, ?, ?, NOW())
    ");
    $stmt->execute([$docId, $token, $expiresAt->format('Y-m-d H:i:s')]);
} catch (Throwable $e) {
    json_fail('Erro ao criar token: ' . $e->getMessage());
}

// Audit log: UPLOAD + LINK_CREATED
try {
    $stmt = $pdo->prepare("
        INSERT INTO audit_logs (document_id, action, ip, user_agent, payload, created_at)
        VALUES (?, 'UPLOAD', ?, ?, JSON_OBJECT('filename', ?, 'size', ?, 'mime', ?), NOW())
    ");
    $stmt->execute([$docId, client_ip(), user_agent(), $_FILES['pdf']['name'], (int)$f['size'], $mime]);

    $stmt = $pdo->prepare("
        INSERT INTO audit_logs (document_id, action, ip, user_agent, payload, created_at)
        VALUES (?, 'LINK_CREATED', ?, ?, JSON_OBJECT('token', ?, 'expires_at', ?), NOW())
    ");
    $stmt->execute([$docId, client_ip(), user_agent(), $token, $expiresAt->format(DateTimeInterface::ATOM)]);
} catch (Throwable $e) {
    // não bloqueia o fluxo principal
}

// Monta URL pública de assinatura
$signUrl = BASE_URL . '/sign.php?t=' . urlencode($token);

// Resposta JSON
json_ok([
    'sign_url'    => $signUrl,
    'document_id' => $docId
]);