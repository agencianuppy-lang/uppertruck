<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Caminho para o arquivo autoload.php do PHPMailer

// Dados do formulário
$nome = $_POST['nome'];
$emailCliente = $_POST['email'];
$contratoHTML = $_POST['contrato'];

// Configuração do PHPMailer
$mail = new PHPMailer(true);

try {
    // Configurações do servidor de email
    $mail->isSMTP();
    $mail->Host = 'smtp.seu-servidor-de-email.com'; // Configure o servidor de email SMTP
    $mail->SMTPAuth = true;
    $mail->Username = 'seu-email@dominio.com'; // Seu email
    $mail->Password = 'sua-senha'; // Sua senha de email
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    // Remetente
    $mail->setFrom('seu-email@dominio.com', 'Seu Nome'); // Seu email e nome

    // Destinatário
    $mail->addAddress($emailCliente, $nome); // Email e nome do destinatário

    // Conteúdo do email
    $mail->isHTML(true);
    $mail->Subject = 'Contrato Gerado'; // Assunto do email
    $mail->Body = $contratoHTML; // Conteúdo do email (o contrato gerado em HTML)

    // Enviar email
    $mail->send();
    
    // Resposta JSON para o JavaScript
    $response = ['success' => true];
    echo json_encode($response);
} catch (Exception $e) {
    // Erro no envio de email
    $response = ['success' => false, 'error' => $mail->ErrorInfo];
    echo json_encode($response);
}
?>