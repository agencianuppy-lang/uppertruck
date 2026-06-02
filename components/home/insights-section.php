<?php
$blogInsights = $insights;

if (!function_exists('uppertruckInsightExcerpt')) {
    function uppertruckInsightExcerpt(?string $text, int $limit = 150): string
    {
        $clean = trim(preg_replace('/\s+/', ' ', strip_tags((string) $text)));

        if ($clean === '') {
            return 'Confira este conteúdo da Uppertruck sobre logística, operação e transporte de cargas.';
        }

        if (function_exists('mb_strlen') && mb_strlen($clean, 'UTF-8') > $limit) {
            return rtrim(mb_substr($clean, 0, $limit, 'UTF-8')) . '...';
        }

        if (!function_exists('mb_strlen') && strlen($clean) > $limit) {
            return rtrim(substr($clean, 0, $limit)) . '...';
        }

        return $clean;
    }
}

try {
    $blogDbConfig = [
        'host' => getenv('UPPERTRUCK_DB_HOST') ?: 'localhost',
        'database' => getenv('UPPERTRUCK_DB_NAME') ?: 'ivanfe67_newblog',
        'username' => getenv('UPPERTRUCK_DB_USER') ?: 'ivanfe67_newblog',
        'password' => getenv('UPPERTRUCK_DB_PASS') ?: 'VU9f2vg)*AD?',
        'charset' => getenv('UPPERTRUCK_DB_CHARSET') ?: 'utf8mb4',
    ];

    $localConfigFile = dirname(__DIR__, 2) . '/admin_blog/config/db.local.php';
    if (is_file($localConfigFile)) {
        $localConfig = require $localConfigFile;
        if (is_array($localConfig)) {
            $blogDbConfig = array_merge($blogDbConfig, array_filter($localConfig, static function ($value) {
                return $value !== null && $value !== '';
            }));
        }
    }

    $blogPdo = new PDO(
        sprintf('mysql:host=%s;dbname=%s;charset=%s', $blogDbConfig['host'], $blogDbConfig['database'], $blogDbConfig['charset']),
        $blogDbConfig['username'],
        $blogDbConfig['password'],
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ]
    );

    $stmt = $blogPdo->query("
        SELECT p.title, p.slug, p.image, p.content, p.meta_description, p.created_at, p.published_at, c.name AS category_name
        FROM posts p
        LEFT JOIN categories c ON p.category_id = c.id
        WHERE p.status = 'publicado' AND p.is_deleted = FALSE
        ORDER BY COALESCE(p.published_at, p.created_at) DESC
        LIMIT 3
    ");

    $latestPosts = $stmt->fetchAll();

    if (!empty($latestPosts)) {
        $blogInsights = array_map(static function (array $post, int $index) use ($insights): array {
            $fallback = $insights[$index] ?? $insights[0];
            $image = trim((string) ($post['image'] ?? ''));

            if ($image === '') {
                $image = $fallback['image'];
            } elseif (!preg_match('#^https?://#i', $image)) {
                $image = '/uppertruck/' . ltrim(preg_match('#^admin_blog/#', $image) ? $image : 'admin_blog/' . $image, '/');
            }

            return [
                'image' => $image,
                'title' => $post['title'] ?? $fallback['title'],
                'excerpt' => uppertruckInsightExcerpt($post['meta_description'] ?: ($post['content'] ?? '')),
                'href' => '/uppertruck/blog/' . rawurlencode((string) $post['slug']),
                'tag' => $post['category_name'] ?: ($index === 0 ? 'Análise Operacional' : 'Mercado'),
            ];
        }, $latestPosts, array_keys($latestPosts));

        if (count($blogInsights) < 3) {
            $blogInsights = array_merge($blogInsights, array_slice($insights, count($blogInsights)));
        }
    }
} catch (Throwable $e) {
    $blogInsights = $insights;
}

$insightFeatured = $blogInsights[0];
$insightSide = array_slice($blogInsights, 1, 2);
?>
<section class="section-shell insights" id="insights">
    <div class="container">
        <div class="section-head reveal">
            <p class="eyebrow">Conteúdos e Insights</p>
            <h2>Conhecimento aplicado para decisões logísticas mais maduras</h2>
            <p>Leituras objetivas para quem lidera operação, compras, suprimentos e distribuição.</p>
        </div>

        <div class="insights-layout">
            <article class="insight-feature reveal">
                <img src="<?php echo htmlspecialchars($insightFeatured['image'], ENT_QUOTES, 'UTF-8'); ?>" alt="Conteúdo Uppertruck sobre logística" width="960" height="540" loading="lazy" decoding="async">
                <div class="insight-body">
                    <span class="insight-tag"><?php echo htmlspecialchars($insightFeatured['tag'] ?? 'Análise Operacional', ENT_QUOTES, 'UTF-8'); ?></span>
                    <h3><?php echo htmlspecialchars($insightFeatured['title'], ENT_QUOTES, 'UTF-8'); ?></h3>
                    <p><?php echo htmlspecialchars($insightFeatured['excerpt'], ENT_QUOTES, 'UTF-8'); ?></p>
                    <a class="text-link" href="<?php echo htmlspecialchars($insightFeatured['href'], ENT_QUOTES, 'UTF-8'); ?>">Ler conteúdo <i data-lucide="arrow-right"></i></a>
                </div>
            </article>

            <div class="insights-side">
                <?php foreach ($insightSide as $index => $post): ?>
                    <article class="insight-card reveal" style="--delay: <?php echo htmlspecialchars((string) (($index + 1) * 80), ENT_QUOTES, 'UTF-8'); ?>ms;">
                        <img src="<?php echo htmlspecialchars($post['image'], ENT_QUOTES, 'UTF-8'); ?>" alt="Conteúdo Uppertruck sobre logística" width="520" height="320" loading="lazy" decoding="async">
                        <div class="insight-body">
                            <span class="insight-tag"><?php echo htmlspecialchars($post['tag'] ?? 'Mercado', ENT_QUOTES, 'UTF-8'); ?></span>
                            <h3><?php echo htmlspecialchars($post['title'], ENT_QUOTES, 'UTF-8'); ?></h3>
                            <p><?php echo htmlspecialchars($post['excerpt'], ENT_QUOTES, 'UTF-8'); ?></p>
                            <a class="text-link" href="<?php echo htmlspecialchars($post['href'], ENT_QUOTES, 'UTF-8'); ?>">Ler conteúdo <i data-lucide="arrow-right"></i></a>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>
