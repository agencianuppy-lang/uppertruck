<?php
$insightFeatured = $insights[0];
$insightSide = array_slice($insights, 1);
?>
<section class="section-shell insights" id="insights">
    <div class="container">
        <div class="section-head reveal">
            <p class="eyebrow">Conteudos e Insights</p>
            <h2>Conhecimento aplicado para decisoes logisticas mais maduras</h2>
            <p>Leituras objetivas para quem lidera operacao, compras, suprimentos e distribuicao.</p>
        </div>

        <div class="insights-layout">
            <article class="insight-feature reveal">
                <img src="<?php echo htmlspecialchars($insightFeatured['image'], ENT_QUOTES, 'UTF-8'); ?>" alt="Conteudo Uppertruck sobre logistica" width="960" height="540" loading="lazy" decoding="async">
                <div class="insight-body">
                    <span class="insight-tag">Analise Operacional</span>
                    <h3><?php echo htmlspecialchars($insightFeatured['title'], ENT_QUOTES, 'UTF-8'); ?></h3>
                    <p><?php echo htmlspecialchars($insightFeatured['excerpt'], ENT_QUOTES, 'UTF-8'); ?></p>
                    <a class="text-link" href="<?php echo htmlspecialchars($insightFeatured['href'], ENT_QUOTES, 'UTF-8'); ?>">Ler conteudo <i data-lucide="arrow-right"></i></a>
                </div>
            </article>

            <div class="insights-side">
                <?php foreach ($insightSide as $index => $post): ?>
                    <article class="insight-card reveal" style="--delay: <?php echo htmlspecialchars((string) (($index + 1) * 80), ENT_QUOTES, 'UTF-8'); ?>ms;">
                        <img src="<?php echo htmlspecialchars($post['image'], ENT_QUOTES, 'UTF-8'); ?>" alt="Conteudo Uppertruck sobre logistica" width="520" height="320" loading="lazy" decoding="async">
                        <div class="insight-body">
                            <span class="insight-tag">Mercado</span>
                            <h3><?php echo htmlspecialchars($post['title'], ENT_QUOTES, 'UTF-8'); ?></h3>
                            <p><?php echo htmlspecialchars($post['excerpt'], ENT_QUOTES, 'UTF-8'); ?></p>
                            <a class="text-link" href="<?php echo htmlspecialchars($post['href'], ENT_QUOTES, 'UTF-8'); ?>">Ler conteudo <i data-lucide="arrow-right"></i></a>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>
