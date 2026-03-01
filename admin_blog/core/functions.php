<?php
// Gera um slug URL-friendly a partir de um texto
function gerarSlug($texto) {
    $texto = preg_replace('/[^\p{L}\p{Nd}]+/u', '-', $texto); // troca tudo que não for letra ou número por "-"
    $texto = trim($texto, '-'); // remove traços extras no início/fim
    return strtolower($texto);
}

// Limpa e sanitiza texto (útil para campos como tags, títulos)
function limparTexto($texto) {
    return trim(strip_tags($texto));
}

// Converte uma data para formato exibível no Brasil
function formatarData($data) {
    return date('d/m/Y H:i', strtotime($data));
}

// Envia e-mail com base nas configurações SMTP do painel usando PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . '/libs/PHPMailer/src/Exception.php';
require_once __DIR__ . '/libs/PHPMailer/src/PHPMailer.php';
require_once __DIR__ . '/libs/PHPMailer/src/SMTP.php';

function enviarEmailSMTP($destinatario, $assunto, $mensagemHtml) {
    require __DIR__ . '/../config/db.php';

    // Buscar configurações
    $stmt = $pdo->query("SELECT config_key, config_value FROM settings");
    $settings = [];
    foreach ($stmt->fetchAll() as $row) {
        $settings[$row['config_key']] = $row['config_value'];
    }

    $logPath = __DIR__ . '/../logs/email_error.log';

    // Log básico para saber se chegou aqui
    file_put_contents($logPath, date('Y-m-d H:i:s') . " - Iniciando envio para $destinatario\n", FILE_APPEND);

    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host       = $settings['smtp_host'];
        $mail->SMTPAuth   = true;
        $mail->Username   = $settings['smtp_user'];
        $mail->Password   = $settings['smtp_pass'];
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port       = $settings['smtp_port'];

        $mail->setFrom($settings['smtp_from'], $settings['smtp_fromname']);
        $mail->addAddress($destinatario);

        $mail->isHTML(true);
        $mail->Subject = $assunto;
        $mail->Body    = $mensagemHtml;

        $mail->send();

        file_put_contents($logPath, date('Y-m-d H:i:s') . " - E-mail enviado com sucesso para $destinatario\n", FILE_APPEND);
        return true;
    } catch (Exception $e) {
        file_put_contents($logPath, date('Y-m-d H:i:s') . " - Erro ao enviar para $destinatario: " . $mail->ErrorInfo . "\n", FILE_APPEND);
        return false;
    }
}

// 🔧 Nova função auxiliar para buscar configurações salvas no painel
function getSettings() {
    global $pdo;
    $stmt = $pdo->query("SELECT config_key, config_value FROM settings");
    $settings = [];
    foreach ($stmt->fetchAll() as $row) {
        $settings[$row['config_key']] = $row['config_value'];
    }
    return $settings;
}