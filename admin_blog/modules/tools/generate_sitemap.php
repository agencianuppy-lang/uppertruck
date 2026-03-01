<?php
session_start();
if (!isset($_SESSION['usuario'])) {
  http_response_code(302);
  header('Location: /admin_blog/auth/login.php');
  exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || empty($_POST['csrf']) || $_POST['csrf'] !== ($_SESSION['csrf'] ?? '')) {
  http_response_code(403);
  $isAjax = isset($_POST['ajax']);
  if ($isAjax) { header('Content-Type: application/json'); echo json_encode(['ok'=>false, 'error'=>'forbidden']); }
  else { echo 'Ação não permitida.'; }
  exit;
}

require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../../config/db.php';

// Settings (base URL)
$settings = [];
try {
  $st = $pdo->query("SELECT config_key, config_value FROM settings");
  foreach ($st as $row) $settings[$row['config_key']] = $row['config_value'];
} catch (Exception $e) {}

$scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
$host   = $_SERVER['HTTP_HOST'] ?? 'localhost';
$autoBase = $scheme . '://' . $host;

$base = rtrim(
  $settings['site_base_url']
    ?? $settings['base_url']
    ?? $settings['site_url']
    ?? $autoBase
, '/');

// Posts publicados
$stmt = $pdo->prepare("
  SELECT slug, COALESCE(updated_at, created_at, NOW()) AS lastmod
  FROM posts
  WHERE status = 'publicado'
    AND (is_deleted = FALSE OR is_deleted IS NULL)
    AND slug IS NOT NULL AND slug <> ''
  ORDER BY COALESCE(updated_at, created_at) DESC
");
$stmt->execute();
$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);

// URLs "fixas" (ajuste conforme seu site)
$nowIso = (new DateTime('now', new DateTimeZone('America/Sao_Paulo')))->format('c');
$urls = [
  [
    'loc'        => $base . '/',
    'lastmod'    => $nowIso,
    'changefreq' => 'daily',
    'priority'   => '1.0'
  ],
  [
    'loc'        => $base . '/new-blog.php', // lista do blog
    'lastmod'    => $nowIso,
    'changefreq' => 'daily',
    'priority'   => '0.9'
  ]
];

// Detalhes dos posts: /blog/{slug}
foreach ($posts as $p) {
  $last = (new DateTime($p['lastmod']))->format('c');
  $urls[] = [
    'loc'        => $base . '/blog/' . $p['slug'],
    'lastmod'    => $last,
    'changefreq' => 'weekly',
    'priority'   => '0.8'
  ];
}

// XML
$xml  = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
$xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
  foreach ($urls as $u) {
  $xml .= " <url>\n";
    $xml .= " <loc>" . htmlspecialchars($u['loc'], ENT_XML1) . "</loc>\n";
    if (!empty($u['lastmod'])) $xml .= " <lastmod>{$u['lastmod']}</lastmod>\n";
    if (!empty($u['changefreq'])) $xml .= " <changefreq>{$u['changefreq']}</changefreq>\n";
    if (!empty($u['priority'])) $xml .= " <priority>{$u['priority']}</priority>\n";
    $xml .= " </url>\n";
  }
  $xml .= '</urlset>';

// Salvar na raiz pública como sitemap2.xml
$publicRoot = realpath(__DIR__ . '/../../../'); // sobe até a raiz do site
if ($publicRoot === false) { $publicRoot = dirname(__DIR__, 3); }
$target = rtrim($publicRoot, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . 'sitemap2.xml';

$ok = @file_put_contents($target, $xml);

// Respostas
$isAjax = isset($_POST['ajax']);
if ($isAjax) {
header('Content-Type: application/json');
echo json_encode(['ok' => $ok !== false, 'file' => '/sitemap2.xml']);
exit;
}

// fallback (se alguém acessar sem ajax)
require_once __DIR__ . '/../../includes/header.php';
require_once __DIR__ . '/../../includes/sidebar.php';
require_once __DIR__ . '/../../includes/topbar.php';
?>
<div class="container mt-4">
  <?php if ($ok !== false): ?>
  <div class="alert alert-success">
    <strong>Pronto!</strong> O arquivo <code>sitemap2.xml</code> foi gerado.
    <a href="/sitemap2.xml" class="ms-2" download>Baixar agora</a>
  </div>
  <?php else: ?>
  <div class="alert alert-danger">
    Não foi possível salvar o <code>sitemap2.xml</code>. Verifique permissões na raiz do site.
  </div>
  <?php endif; ?>
</div>
<?php require_once __DIR__ . '/../../includes/footer.php';