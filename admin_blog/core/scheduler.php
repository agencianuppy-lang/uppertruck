<?php
require_once '../config/config.php';
require_once '../config/db.php';

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
echo "✅ " . $stmt->rowCount() . " post(s) publicado(s).";