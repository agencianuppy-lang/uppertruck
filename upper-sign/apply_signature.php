<?php
// /upper-sign/apply_signature.php
require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/src/SignatureService.php';

require_once __DIR__ . '/libs/fpdf.php';
require_once __DIR__ . '/libs/autoload.php';

use setasign\Fpdi\Fpdi; // importa a classe principal

// ===== Entrada JSON =====
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    json_fail('Método inválido.');
}
$input = json_decode(file_get_contents('php://input'), true);
if (!is_array($input)) json_fail('JSON inválido.');

$token   = trim($input['token']   ?? '');
$page    = (int)($input['page']   ?? 1);
$offXpx  = (int)($input['offset_x_px'] ?? 0);
$offYpx  = (int)($input['offset_y_px'] ?? 0);
$scale   = (int)($input['scale_pct'] ?? 100);
$dataURL = $input['signature_png_base64'] ?? null;

if ($token === '' || !$dataURL) {
    json_fail('Parâmetros incompletos.');
}
if ($scale < 10 || $scale > 300) {
    json_fail('Escala deve estar entre 10% e 300%.');
}

// ===== Busca token + documento =====
$stmt = $pdo->prepare("
    SELECT st.id AS token_id, st.document_id, st.expires_at, st.used_at,
           d.id, d.original_filename, d.stored_path, d.pdf_sha256, d.status
    FROM sign_tokens st
    JOIN documents d ON d.id = st.document_id
    WHERE st.token = ?
    LIMIT 1
");
$stmt->execute([$token]);
$row = $stmt->fetch();

if (!$row) json_fail('Link inválido.');
$now = new DateTimeImmutable('now');
$exp = new DateTimeImmutable($row['expires_at']);
if ($now > $exp) json_fail('Este link expirou.');
if (!empty($row['used_at']) || $row['status'] === 'SIGNED') json_fail('Documento já assinado ou link já utilizado.');

// Caminho do PDF original
$pdfAbs = USIGN_ROOT . '/' . ltrim($row['stored_path'], '/');
if (!is_file($pdfAbs)) json_fail('PDF original não encontrado no servidor.');

// ===== Salva a assinatura PNG =====
try {
    $sig = save_signature_png($row['document_id'], $token, $dataURL);
} catch (Throwable $e) {
    json_fail($e->getMessage());
}

// ===== Calcula posição/escala usando FPDI (unidade mm) =====
try {
    $pdf = new FPDI(); // unidade: mm, origem: canto superior esquerdo
    $pageCount = $pdf->setSourceFile($pdfAbs);

    // Pagina alvo válida
    $targetPage = max(1, min($pageCount, $page));

    // Precisamos saber a largura/altura da página alvo
    $tplIdx = $pdf->importPage($targetPage);
    $size   = $pdf->getTemplateSize($tplIdx); // ['width'=>..,'height'=>..,'orientation'=>...]

    // Vamos iterar todas as páginas, copiando-as e inserindo a assinatura só na alvo.
    for ($n=1; $n <= $pageCount; $n++) {
        $tpl = $pdf->importPage($n);
        $s   = $pdf->getTemplateSize($tpl);

        $pdf->AddPage($s['orientation'], [$s['width'], $s['height']]);
        $pdf->useTemplate($tpl, 0, 0, $s['width'], $s['height']);

        if ($n === $targetPage) {
            // Dimensões da assinatura em mm (a partir de px + escala %)
            $imgWmm = px_to_mm($sig['width_px'])  * ($scale / 100);
            $imgHmm = px_to_mm($sig['height_px']) * ($scale / 100);

            // Offsets px -> mm
            $offXmm = px_to_mm($offXpx);
            $offYmm = px_to_mm($offYpx);

            // Base canto inferior direito -> convertendo para coordenadas do FPDF (origem TOP-LEFT)
            $x = $s['width']  - $imgWmm + $offXmm;     // direita para esquerda
            $y = $s['height'] - $imgHmm - $offYmm;     // bottom para top (y cresce para baixo)

            // Insere a imagem PNG com transparência preservada
            // (FPDF + FPDI v1.x manejam PNG transparente)
            $pdf->Image($sig['abs_path'], $x, $y, $imgWmm, $imgHmm, 'PNG');
        }
    }

    // Salva arquivo final
    $signedName = $row['document_id'] . '-signed.pdf';
    $signedAbs  = USIGN_SIGNED . '/' . $signedName;
    $pdf->Output($signedAbs, 'F');

    $finalHash = hash_file('sha256', $signedAbs);

} catch (Throwable $e) {
    json_fail('Falha ao aplicar assinatura no PDF: ' . $e->getMessage());
}

// ===== Atualiza banco: marca documento como SIGNED e token como usado =====
try {
    $meta = [
        'page'        => $targetPage,
        'offset_x_px' => $offXpx,
        'offset_y_px' => $offYpx,
        'scale_pct'   => $scale,
        'ip'          => client_ip(),
        'ua'          => user_agent(),
        'signature'   => $sig['rel_path'],
        'original_sha256' => $row['pdf_sha256'],
        'final_sha256'    => $finalHash
    ];

    $pdo->beginTransaction();

    $stmt = $pdo->prepare("UPDATE documents
        SET status='SIGNED',
            signed_at = NOW(),
            signed_file_path = ?,
            sign_meta = ?
        WHERE id = ?");
    $stmt->execute(['storage/signed/' . $signedName, json_encode($meta, JSON_UNESCAPED_UNICODE), $row['document_id']]);

    $stmt = $pdo->prepare("UPDATE sign_tokens SET used_at = NOW() WHERE id = ?");
    $stmt->execute([$row['token_id']]);

    $stmt = $pdo->prepare("
        INSERT INTO audit_logs (document_id, action, ip, user_agent, payload, created_at)
        VALUES (?, 'SIGN_APPLIED', ?, ?, ?, NOW())
    ");
    $stmt->execute([
        $row['document_id'],
        client_ip(),
        user_agent(),
        json_encode($meta, JSON_UNESCAPED_UNICODE)
    ]);

    $pdo->commit();
} catch (Throwable $e) {
    $pdo->rollBack();
    json_fail('Erro ao atualizar o banco: ' . $e->getMessage());
}

// ===== URLs de saída =====
$viewUrl     = BASE_URL . '/view.php?id=' . urlencode($row['document_id']);
$downloadUrl = BASE_URL . '/storage/signed/' . rawurlencode($signedName);

json_ok([
    'view_url'     => $viewUrl,
    'download_url' => $downloadUrl
]);