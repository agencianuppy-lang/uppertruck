<?php
$featuredSolution = $solutions[0];
$otherSolutions = array_slice($solutions, 1);
?>
<section class="section-shell solutions" id="solucoes">
    <div class="container">
        <div class="section-head reveal">
            <p class="eyebrow">Solucoes</p>
            <h2>Arquitetura de transporte para operacoes recorrentes e sob demanda</h2>
            <p>Estrutura modular para distribuir melhor, reduzir friccao operacional e manter nivel de servico em escala.</p>
        </div>

        <div class="solutions-layout">
            <article class="solution-feature reveal">
                <span class="solution-chip">Solucao destaque</span>
                <span class="solution-icon"><i data-lucide="<?php echo htmlspecialchars($featuredSolution['icon'], ENT_QUOTES, 'UTF-8'); ?>"></i></span>
                <h3><?php echo htmlspecialchars($featuredSolution['title'], ENT_QUOTES, 'UTF-8'); ?></h3>
                <p><?php echo htmlspecialchars($featuredSolution['description'], ENT_QUOTES, 'UTF-8'); ?></p>
                <a class="btn btn-secondary" href="<?php echo htmlspecialchars($featuredSolution['href'], ENT_QUOTES, 'UTF-8'); ?>">Ver detalhes</a>
            </article>

            <div class="solutions-mosaic">
                <?php foreach ($otherSolutions as $index => $item): ?>
                    <article class="solution-card reveal" style="--delay: <?php echo htmlspecialchars((string) (($index + 1) * 70), ENT_QUOTES, 'UTF-8'); ?>ms;">
                        <span class="solution-icon"><i data-lucide="<?php echo htmlspecialchars($item['icon'], ENT_QUOTES, 'UTF-8'); ?>"></i></span>
                        <h3><?php echo htmlspecialchars($item['title'], ENT_QUOTES, 'UTF-8'); ?></h3>
                        <p><?php echo htmlspecialchars($item['description'], ENT_QUOTES, 'UTF-8'); ?></p>
                        <a class="text-link" href="<?php echo htmlspecialchars($item['href'], ENT_QUOTES, 'UTF-8'); ?>">Saber mais <i data-lucide="arrow-right"></i></a>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>
