<?php
require_once '../config/config.php';
require_once '../config/db.php';
require_once '../core/functions.php'; // função enviarEmailSMTP com PHPMailer

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once '../core/libs/PHPMailer/src/Exception.php';
require_once '../core/libs/PHPMailer/src/PHPMailer.php';
require_once '../core/libs/PHPMailer/src/SMTP.php';

$sql = "
  SELECT posts.id, posts.title, posts.slug
  FROM posts
  WHERE posts.status = 'agendado'
    AND posts.scheduled_at <= NOW()
";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (!empty($posts)) {
  $update = $pdo->prepare("
    UPDATE posts
    SET status = 'publicado', published_at = NOW()
    WHERE id = :id
  ");

  // Pega e-mails do painel
  $settings = getSettings();
  $email_admin = $settings['email_admin'] ?? '';
  $email_cliente = $settings['email_cliente'] ?? '';

  foreach ($posts as $post) {
    $update->execute(['id' => $post['id']]);

    // Link público do post
    global $public_url;
    $link = $public_url . "/blog/" . $post['slug'];


    // Assunto e corpo do e-mail
    $assunto = "Novo post publicado: {$post['title']}";
    $mensagem = "
      <h2>Publicação no blog</h2>
      <p><strong>{$post['title']}</strong> foi publicado com sucesso.</p>
      <p><a href='{$link}'>Clique aqui para ver o post</a></p>
    ";

    // Enviar para os e-mails definidos no painel
    if ($email_admin) {
      enviarEmailSMTP($email_admin, $assunto, $mensagem);
    }
    if ($email_cliente) {
      enviarEmailSMTP($email_cliente, $assunto, $mensagem);
    }
  }

  // Log da execução
  file_put_contents(
    '../logs/cron.log',
    "[" . date('Y-m-d H:i:s') . "] Publicados " . count($posts) . " post(s) agendado(s)\n",
    FILE_APPEND
  );
} else {
  // Mesmo sem post, registra execução
  file_put_contents(
    '../logs/cron.log',
    "[" . date('Y-m-d H:i:s') . "] Executado cron.php - Nenhum post agendado para publicar\n",
    FILE_APPEND
  );
}