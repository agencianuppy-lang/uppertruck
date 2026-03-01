<?php
// /upper-sign/src/SignatureService.php

require_once __DIR__ . '/../config/config.php';

/**
 * Salva a imagem de assinatura (dataURL base64 PNG) em /storage/signatures/
 * Retorna: caminho absoluto salvo + informações de imagem.
 */
function save_signature_png(string $documentId, string $token, string $dataUrl): array {
    if (strpos($dataUrl, 'data:image/png;base64,') !== 0) {
        throw new RuntimeException('Formato de assinatura inválido (esperado PNG base64).');
    }
    $b64 = substr($dataUrl, strlen('data:image/png;base64,'));

    $bin = base64_decode($b64, true);
    if ($bin === false) {
        throw new RuntimeException('Base64 inválido.');
    }
    if (strlen($bin) < 400) { // assinatura praticamente vazia
        throw new RuntimeException('Assinatura vazia.');
    }

    $filename = sprintf('%s-%s.png', $documentId, substr($token, 0, 12));
    $abs = USIGN_SIGNATURES . '/' . $filename;

    if (@file_put_contents($abs, $bin) === false) {
        throw new RuntimeException('Falha ao salvar a assinatura no servidor.');
    }

    [$w, $h, $type] = getimagesize($abs);
    if (!$w || !$h || $type !== IMAGETYPE_PNG) {
        @unlink($abs);
        throw new RuntimeException('Arquivo de assinatura inválido.');
    }

    return [
        'abs_path' => $abs,
        'rel_path' => 'storage/signatures/' . $filename,
        'width_px' => $w,
        'height_px'=> $h
    ];
}

/** px -> mm (assumindo 96 DPI padrão do navegador) */
function px_to_mm(float $px, float $dpi = 96.0): float {
    return ($px / $dpi) * 25.4;
}