<?php
require_once '../../config/config.php';
require_once '../../config/db.php';
require_once '../../vendor/PHPMailer/src/PHPMailer.php';
require_once '../../vendor/PHPMailer/src/SMTP.php';
require_once '../../vendor/PHPMailer/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function getSetting($key, $pdo) {
    $stmt = $pdo->prepare("SELECT config_value FROM settings WHERE config_key = :key LIMIT 1");
    $stmt->execute(['key' => $key]);
    return $stmt->fetchColumn();
}

$smtp_host     = getSetting('smtp_host', $pdo);
$smtp_port     = getSetting('smtp_port', $pdo);
$smtp_user     = getSetting('smtp_user', $pdo);
$smtp_pass     = getSetting('smtp_pass', $pdo);
$smtp_from     = getSetting('smtp_from', $pdo);
$smtp_fromname = getSetting('smtp_fromname', $pdo);

// E-mail de destino para teste
$destino = $smtp_from;

$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host       = $smtp_host;
    $mail->SMTPAuth   = true;
    $mail->Username   = $smtp_user;
    $mail->Password   = $smtp_pass;
    $mail->SMTPSecure = 'ssl';
    $mail->Port       = $smtp_port;

    $mail->setFrom($smtp_from, $smtp_fromname);
    $mail->addAddress($destino);

    $mail->Subject = 'Teste de envio de e-mail';
    $mail->Body    = 'Este é um e-mail de teste enviado pelo sistema de blog.';

    $mail->send();
    echo '<h3 style="color:green;">✔ E-mail enviado com sucesso para ' . $destino . '</h3>';
} catch (Exception $e) {
    echo '<h3 style="color:red;">✖ Erro ao enviar: ' . $mail->ErrorInfo . '</h3>';
}