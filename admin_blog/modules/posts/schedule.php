<?php
require_once '../../config/config.php';
require_once '../../config/db.php';

// Atualizar posts agendados cuja data já passou
$sql = "
  UPDATE posts
  SET status = 'publicado',
      published_at = NOW()
  WHERE status = 'agendado'
    AND scheduled_at <= NOW()
    AND is_deleted = FALSE
";

$stmt = $pdo->prepare($sql);
$stmt->execute();
$quantidade = $stmt->rowCount();

echo "✅ $quantidade post(s) agendado(s) publicado(s) automaticamente.";