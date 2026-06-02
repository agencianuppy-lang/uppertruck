<section class="section-shell differentials" id="diferenciais">
    <div class="container differentials-layout">
        <div class="differentials-intro reveal">
            <p class="eyebrow">Diferenciais e Segurança</p>
            <h2>Governança para operar frete com segurança jurídica e técnica</h2>
            <p>
                Processo estruturado para proteger carga, empresa e operação com critério de risco, compliance e controle contínuo.
            </p>
            <a class="text-link" href="/uppertruck/cotacao-contato/falar-com-especialista.php">Falar com especialista <i data-lucide="arrow-right"></i></a>
        </div>

        <div class="differentials-grid">
            <?php foreach ($differentials as $index => $item): ?>
                <article class="differential-card reveal" style="--delay: <?php echo htmlspecialchars((string) (($index + 1) * 45), ENT_QUOTES, 'UTF-8'); ?>ms;">
                    <span class="diff-icon"><i data-lucide="<?php echo htmlspecialchars($item['icon'], ENT_QUOTES, 'UTF-8'); ?>"></i></span>
                    <div>
                        <h3><?php echo htmlspecialchars($item['title'], ENT_QUOTES, 'UTF-8'); ?></h3>
                        <p><?php echo htmlspecialchars($item['description'], ENT_QUOTES, 'UTF-8'); ?></p>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>
