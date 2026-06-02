<section class="section-shell segments" id="segmentos">
    <div class="container segments-layout">
        <div class="segments-intro reveal">
            <p class="eyebrow">Operações Atendidas</p>
            <h2>Amplitude para diferentes segmentos e ciclos de distribuição</h2>
            <p>
                Estruturamos cada projeto conforme volume, recorrencia e criticidade do abastecimento da sua cadeia.
            </p>
        </div>

        <div class="segments-grid">
            <?php foreach ($segments as $index => $item): ?>
                <article class="segment-card reveal" style="--delay: <?php echo htmlspecialchars((string) (($index + 1) * 55), ENT_QUOTES, 'UTF-8'); ?>ms;">
                    <span class="segment-icon"><i data-lucide="<?php echo htmlspecialchars($item['icon'], ENT_QUOTES, 'UTF-8'); ?>"></i></span>
                    <h3><?php echo htmlspecialchars($item['title'], ENT_QUOTES, 'UTF-8'); ?></h3>
                    <p><?php echo htmlspecialchars($item['description'], ENT_QUOTES, 'UTF-8'); ?></p>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>
