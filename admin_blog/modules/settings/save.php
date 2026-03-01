<?php
ob_start();
session_start();

require_once '../../config/config.php';
require_once '../../config/db.php';

$dados = [
  // Aba Geral
  'site_name'        => $_POST['site_name'] ?? '',
  'site_logo'        => $_POST['site_logo'] ?? '',
  'site_favicon'     => $_POST['site_favicon'] ?? '',
  'primary_color'    => $_POST['primary_color'] ?? '',

  // Aba SEO
  'meta_description' => $_POST['meta_description'] ?? '',
  'facebook_url'     => $_POST['facebook_url'] ?? '',
  'twitter_url'      => $_POST['twitter_url'] ?? '',
  'linkedin_url'     => $_POST['linkedin_url'] ?? '',
  'instagram_url'     => $_POST['instagram_url'] ?? '',

  // Aba SMTP
  'smtp_host'        => $_POST['smtp_host'] ?? '',
  'smtp_port'        => $_POST['smtp_port'] ?? '',
  'smtp_user'        => $_POST['smtp_user'] ?? '',
  'smtp_pass'        => $_POST['smtp_pass'] ?? '',
  'smtp_from'        => $_POST['smtp_from'] ?? '',
  'smtp_fromname'    => $_POST['smtp_fromname'] ?? '',
  'email_admin'      => $_POST['email_admin'] ?? '',
  'email_cliente'    => $_POST['email_cliente'] ?? '',
];

foreach ($dados as $chave => $valor) {
  $stmt = $pdo->prepare("REPLACE INTO settings (config_key, config_value) VALUES (:chave, :valor)");
  $stmt->execute(['chave' => $chave, 'valor' => $valor]);
}

header('Location: index.php?salvo=1');
exit;