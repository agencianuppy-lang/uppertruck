<?php
// /upper-sign/src/Helpers.php

function safe_filename(string $name): string {
    $name = preg_replace('/[^a-zA-Z0-9_\.-]/', '_', $name);
    return trim($name, '_');
}

function uuidv4(): string {
    $data = random_bytes(16);
    $data[6] = chr((ord($data[6]) & 0x0f) | 0x40);
    $data[8] = chr((ord($data[8]) & 0x3f) | 0x80);
    return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
}

function client_ip(): ?string {
    foreach (['HTTP_CF_CONNECTING_IP','HTTP_X_FORWARDED_FOR','HTTP_CLIENT_IP','REMOTE_ADDR'] as $k) {
        if (!empty($_SERVER[$k])) {
            return explode(',', $_SERVER[$k])[0];
        }
    }
    return null;
}

function user_agent(): string {
    return $_SERVER['HTTP_USER_AGENT'] ?? 'unknown';
}

// Conversão: px -> pt (PDF 1/72in)
function pxToPt(float $px, float $dpi = 96.0): float {
    return $px * 72.0 / $dpi;
}