<?php
require_once 'config/config.php';
require_once 'config/db.php';
require_once 'core/functions.php';

$assunto = "Teste de envio SMTP";
$mensagem = "
  <h2>Teste de e-mail via PHPMailer</h2>
  <p>Se você recebeu isso, o SMTP está funcionando corretamente.</p>
";

if (enviarEmailSMTP('contato@nuppy.com.br', $assunto, $mensagem)) {
  echo "✅ E-mail enviado com sucesso.";
} else {
  echo "❌ Falha ao enviar e-mail.";
}