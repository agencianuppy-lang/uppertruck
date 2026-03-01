<?php
// /upper-sign/view.php
require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/config/database.php';

// === Parâmetros ===
$id = $_GET['id'] ?? '';
$download = isset($_GET['download']);
if ($id === '') {
    die('<h3>Documento não encontrado.</h3>');
}

// === Busca o documento ===
$stmt = $pdo->prepare("SELECT * FROM documents WHERE id = ? LIMIT 1");
$stmt->execute([$id]);
$doc = $stmt->fetch();

if (!$doc || empty($doc['signed_file_path']) || $doc['status'] !== 'SIGNED') {
    die('<h3>Documento não encontrado ou ainda não foi assinado.</h3>');
}

$filePath = __DIR__ . '/' . $doc['signed_file_path'];
if (!file_exists($filePath)) {
    die('<h3>Arquivo PDF não encontrado no servidor.</h3>');
}

$fileUrl = BASE_URL . '/' . $doc['signed_file_path'];

// === Auditoria ===
$meta = json_decode($doc['sign_meta'] ?? '[]', true);
$metaInfo = '';
if (is_array($meta)) {
    $metaInfo .= '<ul style="font-size:14px;">';
    if (!empty($meta['ip'])) $metaInfo .= '<li><strong>IP do signatário:</strong> ' . htmlspecialchars($meta['ip']) . '</li>';
    if (!empty($meta['ua'])) $metaInfo .= '<li><strong>Navegador:</strong> ' . htmlspecialchars($meta['ua']) . '</li>';
    if (!empty($meta['page'])) $metaInfo .= '<li><strong>Página:</strong> ' . (int)$meta['page'] . '</li>';
    if (!empty($meta['offset_x_px']) || !empty($meta['offset_y_px'])) {
        $metaInfo .= '<li><strong>Offset:</strong> X=' . (int)$meta['offset_x_px'] . 'px, Y=' . (int)$meta['offset_y_px'] . 'px</li>';
    }
    if (!empty($meta['scale_pct'])) $metaInfo .= '<li><strong>Escala:</strong> ' . (int)$meta['scale_pct'] . '%</li>';
    if (!empty($meta['original_sha256'])) $metaInfo .= '<li><strong>Hash original:</strong> ' . htmlspecialchars($meta['original_sha256']) . '</li>';
    if (!empty($meta['final_sha256'])) $metaInfo .= '<li><strong>Hash final:</strong> ' . htmlspecialchars($meta['final_sha256']) . '</li>';
    $metaInfo .= '</ul>';
}

// === Download direto ===
if ($download) {
    header('Content-Type: application/pdf');
    header('Content-Disposition: attachment; filename="' . basename($filePath) . '"');
    readfile($filePath);
    exit;
}

// === HTML Viewer ===
?>
<!doctype html>
<html lang="pt-BR">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Visualizar Documento Assinado</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: #f8f9fa;
      font-family: 'Segoe UI', sans-serif;
    }

    .pdf-container {
      height: 80vh;
      border: 1px solid #ccc;
      border-radius: 6px;
      overflow: hidden;
    }

    footer {
      font-size: 14px;
      color: #555;
      margin-top: 20px;
    }
  </style>
</head>

<body>
  <div class="container py-4">
    <h3 class="mb-3">📄 Documento assinado</h3>
    <div class="pdf-container mb-3">
      <iframe src="<?= htmlspecialchars($fileUrl) ?>" width="100%" height="100%" style="border:0;"></iframe>
    </div>

    <div class="d-flex gap-2">
      <a href="?id=<?= urlencode($id) ?>&download=1" class="btn btn-primary">
        ⬇️ Baixar PDF
      </a>
      <button class="btn btn-outline-secondary" onclick="navigator.clipboard.writeText(window.location.href)">
        📋 Copiar link
      </button>
    </div>

    <footer class="mt-4">
      <p><strong>Assinado em:</strong>
        <?= htmlspecialchars($doc['signed_at']) ?>
      </p>
      <?= $metaInfo ?>
    </footer>
  </div>
</body>

</html>