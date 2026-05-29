<section class="section-shell for-companies" id="para-empresas">
    <div class="container companies-shell">
        <div class="companies-copy reveal">
            <p class="eyebrow companies-eyebrow">Para Empresas</p>
            <h2>Gestao de frete com metodo para liderancas que cobram previsibilidade</h2>
            <p class="companies-lead">
                A Uppertruck atua como parceiro operacional do embarcador para organizar coleta, transito e entrega com visibilidade, padrao tecnico e menor desgaste interno.
            </p>

            <ul class="companies-benefits">
                <?php foreach ($companyBenefits as $benefit): ?>
                    <li>
                        <span class="companies-bullet"><i data-lucide="<?php echo htmlspecialchars($benefit['icon'], ENT_QUOTES, 'UTF-8'); ?>"></i></span>
                        <span><?php echo htmlspecialchars($benefit['text'], ENT_QUOTES, 'UTF-8'); ?></span>
                    </li>
                <?php endforeach; ?>
            </ul>

            <div class="companies-actions">
                <a class="btn companies-cta-primary" href="/uppertruck/para-empresas.php">Conhecer solucoes para empresas</a>
                <a class="companies-cta-secondary" href="/uppertruck/cotacao-contato/falar-com-especialista.php">
                    Falar com especialista <i data-lucide="arrow-up-right"></i>
                </a>
            </div>
        </div>

        <aside class="companies-intel reveal" style="--delay: 110ms">

            <figure class="companies-figure">
                <img src="/uppertruck/img/upper3.png" alt="Equipe acompanhando operacao com indicadores" width="700" height="460" loading="lazy" decoding="async">
                <figcaption>
                    <i data-lucide="radar"></i>
                    Operacao monitorada com padrao tecnico e comunicacao continua.
                </figcaption>
            </figure>
        </aside>
    </div>
</section>
