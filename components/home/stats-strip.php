<?php
$primaryStat = $stats[0];
$secondaryStats = array_slice($stats, 1);
?>
<section class="proof-band" aria-label="Indicadores institucionais">
    <div class="container proof-layout reveal">
        <article class="proof-main">
            <p class="eyebrow">Capacidade Comprovada</p>
            <h2>
                <span class="stat-number" data-countup data-target="<?php echo htmlspecialchars((string) $primaryStat['target'], ENT_QUOTES, 'UTF-8'); ?>" data-decimals="<?php echo htmlspecialchars((string) $primaryStat['decimals'], ENT_QUOTES, 'UTF-8'); ?>" data-prefix="<?php echo htmlspecialchars($primaryStat['prefix'], ENT_QUOTES, 'UTF-8'); ?>" data-suffix="<?php echo htmlspecialchars($primaryStat['suffix'], ENT_QUOTES, 'UTF-8'); ?>">
                    <?php echo htmlspecialchars($primaryStat['prefix'] . $primaryStat['target'] . $primaryStat['suffix'], ENT_QUOTES, 'UTF-8'); ?>
                </span>
            </h2>
            <p><?php echo htmlspecialchars($primaryStat['label'], ENT_QUOTES, 'UTF-8'); ?></p>
        </article>

        <div class="proof-grid">
            <?php foreach ($secondaryStats as $index => $item): ?>
                <article class="proof-tile" style="--delay: <?php echo htmlspecialchars((string) (($index + 1) * 70), ENT_QUOTES, 'UTF-8'); ?>ms;">
                    <span class="proof-icon"><i data-lucide="<?php echo htmlspecialchars($item['icon'], ENT_QUOTES, 'UTF-8'); ?>"></i></span>
                    <h3>
                        <span class="stat-number" data-countup data-target="<?php echo htmlspecialchars((string) $item['target'], ENT_QUOTES, 'UTF-8'); ?>" data-decimals="<?php echo htmlspecialchars((string) $item['decimals'], ENT_QUOTES, 'UTF-8'); ?>" data-prefix="<?php echo htmlspecialchars($item['prefix'], ENT_QUOTES, 'UTF-8'); ?>" data-suffix="<?php echo htmlspecialchars($item['suffix'], ENT_QUOTES, 'UTF-8'); ?>">
                            <?php echo htmlspecialchars($item['prefix'] . $item['target'] . $item['suffix'], ENT_QUOTES, 'UTF-8'); ?>
                        </span>
                    </h3>
                    <p><?php echo htmlspecialchars($item['label'], ENT_QUOTES, 'UTF-8'); ?></p>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>
