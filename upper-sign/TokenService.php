<?php
// /upper-sign/src/TokenService.php
require_once __DIR__ . '/../config/config.php';

/**
 * Gera um token HMAC de 64 chars, atrelado ao documentId e à expiração.
 */
function usign_generate_token(string $documentId, DateTimeImmutable $expiresAt): string {
    $random  = bin2hex(random_bytes(16));
    $payload = $documentId . '|' . $expiresAt->getTimestamp() . '|' . $random;
    return hash_hmac('sha256', $payload, TOKEN_SECRET); // 64 chars
}

/** Monta a URL pública de assinatura */
function usign_sign_url(string $token): string {
    return BASE_URL . '/sign.php?t=' . urlencode($token);
}