<?php
$metaTitle = 'Carga Fracionada | Uppertruck';
$metaDescription = 'Carga fracionada com metodo operacional, rastreabilidade e previsibilidade para empresas com operacao nacional.';
$currentYear = date('Y');

$menuItems = [
    ['label' => 'Home', 'href' => '/uppertruck/index.php'],
    ['label' => 'Sobre', 'href' => '/uppertruck/sobre.php'],
    ['label' => 'Solucoes', 'href' => '/uppertruck/solucoes.php', 'dropdown' => [
        ['label' => 'Carga Fracionada', 'href' => '/uppertruck/solucoes/carga-fracionada.php'],
        ['label' => 'Carga Dedicada', 'href' => '/uppertruck/solucoes/carga-dedicada.php'],
        ['label' => 'Consolidacao de Cargas', 'href' => '/uppertruck/solucoes/consolidacao-de-cargas.php'],
        ['label' => 'Last Mile', 'href' => '/uppertruck/solucoes/last-mile.php'],
        ['label' => 'Operacoes Sob Medida', 'href' => '/uppertruck/solucoes/operacoes-sob-medida.php'],
    ]],
    ['label' => 'Para Empresas', 'href' => '/uppertruck/para-empresas.php'],
    ['label' => 'Para Transportadores', 'href' => '/uppertruck/para-transportadores.php'],
    ['label' => 'Blog', 'href' => '/uppertruck/blog.php'],
    ['label' => 'Cotacao', 'href' => '/uppertruck/cotacao-contato.php'],
];

$serviceModules = [
    [
        'image' => '/uppertruck/img/ilus-1.png',
        'title' => 'Coleta Programada',
        'description' => 'Rotas recorrentes com janelas definidas para reduzir gargalos no embarque.',
        'bullet' => 'Roteirizacao por densidade e prioridade de atendimento.',
    ],
    [
        'image' => '/uppertruck/img/ilus-2.png',
        'title' => 'Consolidacao Inteligente',
        'description' => 'Combinacao de volumes para melhorar ocupacao de frota e eficiencia de custo.',
        'bullet' => 'Balanceamento por regiao, cubagem e criticidade de entrega.',
    ],
    [
        'image' => '/uppertruck/img/ilus-3.png',
        'title' => 'Entrega Rastreada',
        'description' => 'Acompanhamento ativo da carga com leitura operacional em tempo real.',
        'bullet' => 'Comunicacao proxima com status e tratativa rapida de ocorrencias.',
    ],
];

$operationalStats = [
    ['value' => '+3.5K', 'label' => 'cidades atendidas com malha nacional', 'icon' => 'map-pinned', 'tag' => 'Cobertura'],
    ['value' => '97%', 'label' => 'entregas dentro da janela planejada', 'icon' => 'target', 'tag' => 'SLA'],
    ['value' => '24h', 'label' => 'tempo medio de resposta operacional', 'icon' => 'clock-3', 'tag' => 'Resposta'],
    ['value' => '0', 'label' => 'sinistros em operacoes monitoradas', 'icon' => 'shield-check', 'tag' => 'Risco'],
];
?>
<!doctype html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo htmlspecialchars($metaTitle, ENT_QUOTES, 'UTF-8'); ?></title>
    <meta name="description" content="<?php echo htmlspecialchars($metaDescription, ENT_QUOTES, 'UTF-8'); ?>">
    <meta name="theme-color" content="#072156">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@500;600;700;800&family=Sora:wght@500;600&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="/uppertruck/assets/css/home.css">
    <link rel="stylesheet" href="/uppertruck/assets/css/carga-fracionada.css">
</head>

<body class="cf-page">
    <a class="skip-link" href="#conteudo-principal">Pular para o conteudo principal</a>

    <?php include __DIR__ . '/../components/home/header.php'; ?>

    <main id="conteudo-principal">
        <section class="cf-hero">
            <div class="container cf-hero-grid">
                <div class="cf-hero-copy reveal">
                    <p class="eyebrow">Solucao Uppertruck</p>
                    <h1>Carga Fracionada com previsibilidade, controle e escala nacional.</h1>
                    <p class="cf-hero-lead">
                        Estruturamos a operacao para embarques de menor volume com metodo, rastreabilidade e atendimento proximo do primeiro contato ate a entrega.
                    </p>
                    <div class="cf-hero-actions">
                        <a class="btn btn-primary" href="/uppertruck/cotacao-contato/solicitar-cotacao.php">Solicitar cotacao</a>
                        <a class="btn cf-btn-secondary" href="/uppertruck/cotacao-contato/falar-com-especialista.php">Falar com especialista</a>
                    </div>
                    <div class="cf-hero-kpis">
                        <div><strong>+1K</strong><span>clientes ativos</span></div>
                        <div><strong>20%</strong><span>ganho medio de eficiencia</span></div>
                        <div><strong>100%</strong><span>visibilidade operacional</span></div>
                    </div>
                </div>

                <figure class="cf-hero-media reveal" style="--delay: 80ms">
                    <img src="/uppertruck/img/upper5.png" alt="Equipe Uppertruck em operacao de carga fracionada" loading="eager" decoding="async">
                    <figcaption>
                        <span><i data-lucide="activity"></i> Operacao monitorada</span>
                        <span><i data-lucide="shield-check"></i> Protocolos de risco ativos</span>
                    </figcaption>
                </figure>
            </div>
        </section>

        <section class="section-shell cf-tabbed-solution">
            <div class="container cf-tabbed-solution-grid">
                <figure class="cf-tabbed-media reveal" style="--delay: 80ms">
                    <img src="/uppertruck/img/distribuicao.png" alt="Operacao logistica de carga fracionada com distribuicao organizada" loading="lazy" decoding="async">
                </figure>

                <div class="cf-tabbed-content reveal">
                    <p class="eyebrow">SoluÃ§Ã£o flexÃ­vel para embarques inteligentes</p>
                    <h2>Carga Fracionada com mais eficiÃªncia para a rotina da sua operaÃ§Ã£o</h2>

                    <div class="cf-tabbed-nav" role="tablist" aria-label="Conteudo sobre carga fracionada">
                        <button type="button" class="is-active" role="tab" aria-selected="true" data-cf-tab-button="sobre">Sobre a soluÃ§Ã£o</button>
                        <button type="button" role="tab" aria-selected="false" data-cf-tab-button="operamos">Como operamos</button>
                        <button type="button" role="tab" aria-selected="false" data-cf-tab-button="vantagens">Vantagens para sua empresa</button>
                    </div>

                    <div class="cf-tabbed-panels">
                        <article class="cf-tabbed-panel is-active" data-cf-tab-panel="sobre">
                            <p>A carga fracionada Ã© ideal para empresas que precisam transportar volumes menores sem ocupar um veÃ­culo inteiro. Nesse modelo, a carga Ã© consolidada com outros embarques, permitindo melhor aproveitamento de espaÃ§o, mais economia e maior eficiÃªncia no transporte.</p>
                            <p>Ã‰ uma soluÃ§Ã£o estratÃ©gica para operaÃ§Ãµes recorrentes, distribuiÃ§Ã£o regional e empresas que buscam equilibrar custo logÃ­stico com previsibilidade.</p>
                            <div class="cf-tabbed-actions">
                                <a class="btn btn-primary" href="/uppertruck/cotacao-contato/solicitar-cotacao.php">Solicitar cotaÃ§Ã£o</a>
                                <a class="btn cf-btn-secondary" href="/uppertruck/cotacao-contato/falar-com-especialista.php">Falar com especialista</a>
                            </div>
                        </article>

                        <article class="cf-tabbed-panel" data-cf-tab-panel="operamos" hidden>
                            <p>Na Uppertruck, a operaÃ§Ã£o de carga fracionada Ã© organizada para reduzir atritos desde a coleta atÃ© a entrega. Trabalhamos com planejamento de embarque, consolidaÃ§Ã£o inteligente de volumes, acompanhamento operacional e comunicaÃ§Ã£o prÃ³xima ao longo da jornada.</p>
                            <p>O objetivo Ã© trazer mais fluidez para a rotina logÃ­stica, reduzir gargalos e dar Ã  sua empresa mais visibilidade sobre cada envio.</p>
                            <div class="cf-tabbed-actions">
                                <a class="btn cf-btn-secondary" href="#como-operamos">Entender a operaÃ§Ã£o</a>
                                <a class="btn btn-primary" href="/uppertruck/cotacao-contato/solicitar-cotacao.php">Solicitar cotaÃ§Ã£o</a>
                            </div>
                        </article>

                        <article class="cf-tabbed-panel" data-cf-tab-panel="vantagens" hidden>
                            <p>Com a carga fracionada, sua empresa pode reduzir custo com transporte, melhorar o aproveitamento da operaÃ§Ã£o e manter mais previsibilidade em embarques de menor volume. Ã‰ uma alternativa eficiente para quem precisa escalar a logÃ­stica sem gerar ociosidade.</p>
                            <p>Entre os principais ganhos estÃ£o mais economia, maior flexibilidade, melhor organizaÃ§Ã£o dos embarques e mais controle sobre o fluxo logÃ­stico.</p>
                            <ul class="cf-tabbed-benefits">
                                <li>Melhor aproveitamento de custo</li>
                                <li>Flexibilidade para volumes menores</li>
                                <li>Mais previsibilidade operacional</li>
                            </ul>
                            <div class="cf-tabbed-actions">
                                <a class="btn btn-primary" href="/uppertruck/cotacao-contato/solicitar-cotacao.php">Solicitar cotaÃ§Ã£o</a>
                                <a class="btn cf-btn-secondary" href="/uppertruck/cotacao-contato/falar-com-especialista.php">Falar com especialista</a>
                            </div>
                        </article>
                    </div>
                </div>
            </div>
        </section>

        <section class="section-shell cf-modules" id="como-operamos">
            <div class="container">
                <div class="section-head cf-head-center reveal">
                    <p class="eyebrow">Como operamos</p>
                    <h2>Um fluxo desenhado para reduzir atrito e aumentar previsibilidade no transporte fracionado.</h2>
                </div>
                <div class="cf-module-grid">
                    <?php foreach ($serviceModules as $index => $item): ?>
                        <article class="cf-module-card reveal" style="--delay: <?php echo htmlspecialchars((string) (($index + 1) * 70), ENT_QUOTES, 'UTF-8'); ?>ms;">
                            <img src="<?php echo htmlspecialchars($item['image'], ENT_QUOTES, 'UTF-8'); ?>" alt="<?php echo htmlspecialchars($item['title'], ENT_QUOTES, 'UTF-8'); ?>" loading="lazy" decoding="async">
                            <div class="cf-module-body">
                                <p class="cf-module-step">Etapa <?php echo htmlspecialchars((string) ($index + 1), ENT_QUOTES, 'UTF-8'); ?></p>
                                <h3><?php echo htmlspecialchars($item['title'], ENT_QUOTES, 'UTF-8'); ?></h3>
                                <p class="cf-module-description"><?php echo htmlspecialchars($item['description'], ENT_QUOTES, 'UTF-8'); ?></p>
                                <hr class="cf-module-divider" aria-hidden="true">
                                <span><i data-lucide="check-circle-2"></i> <?php echo htmlspecialchars($item['bullet'], ENT_QUOTES, 'UTF-8'); ?></span>
                            </div>
                        </article>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <section class="section-shell cf-operations">
            <div class="container cf-operations-grid">
                <figure class="cf-operations-media reveal">
                    <img src="/uppertruck/img/consolidacao-de-cargas-2.jpg" alt="Gestao operacional de consolidacao de cargas" loading="lazy" decoding="async">
                </figure>
                <div class="cf-operations-copy reveal" style="--delay: 90ms">
                    <p class="eyebrow">Gestao aplicada</p>
                    <h2>Coleta, consolidacao e entrega com visibilidade continua.</h2>
                    <p>
                        Atuamos com protocolos de monitoramento, comunicacao operacional e controle de SLA para manter consistencia da malha mesmo em cenarios de variacao de demanda.
                    </p>
                    <ul>
                        <li><i data-lucide="radar"></i> Visibilidade de status em cada etapa da jornada</li>
                        <li><i data-lucide="route"></i> Ajuste de rota por prioridade e janela de atendimento</li>
                        <li><i data-lucide="headset"></i> Atendimento proximo com tratativa ativa de ocorrencias</li>
                    </ul>
                </div>
            </div>
        </section>

        <section class="section-shell cf-stats">
            <div class="container">
                <div class="section-head cf-head-center reveal">
                    <p class="eyebrow cf-stats-eyebrow"><i data-lucide="sparkles"></i> Resultados de operacao</p>
                    <h2>Indicadores que sustentam decisoes mais seguras no transporte fracionado.</h2>
                </div>
                <div class="cf-stats-grid">
                    <?php foreach ($operationalStats as $index => $item): ?>
                        <article class="cf-stat-card reveal" style="--delay: <?php echo htmlspecialchars((string) (($index + 1) * 65), ENT_QUOTES, 'UTF-8'); ?>ms;">
                            <div class="cf-stat-head">
                                <span class="cf-stat-icon">
                                    <i data-lucide="<?php echo htmlspecialchars($item['icon'], ENT_QUOTES, 'UTF-8'); ?>"></i>
                                </span>
                                <span class="cf-stat-tag"><?php echo htmlspecialchars($item['tag'], ENT_QUOTES, 'UTF-8'); ?></span>
                            </div>
                            <p class="cf-stat-value"><?php echo htmlspecialchars($item['value'], ENT_QUOTES, 'UTF-8'); ?></p>
                            <p class="cf-stat-label"><?php echo htmlspecialchars($item['label'], ENT_QUOTES, 'UTF-8'); ?></p>
                        </article>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <section class="section-shell cf-insight">
            <div class="container cf-insight-grid">
                <figure class="cf-insight-media reveal">
                    <img src="/uppertruck/img/2151994456.jpg" alt="Operador logÃ­stico em armazem com carga fracionada" loading="lazy" decoding="async">
                </figure>
                <div class="cf-insight-copy reveal" style="--delay: 80ms">
                    <p class="eyebrow">Leitura estrategica</p>
                    <h2>Transporte fracionado deixa de ser uma dor quando existe metodo operacional real.</h2>
                    <p>
                        Com governanca, tecnologia e acompanhamento ativo, sua equipe ganha previsibilidade para planejar abastecimento, reduzir desgaste interno e crescer com mais consistencia.
                    </p>
                    <a class="btn btn-primary" href="/uppertruck/cotacao-contato/solicitar-cotacao.php">Quero estruturar minha operacao</a>
                </div>
            </div>
        </section>
    </main>

    <?php include __DIR__ . '/../components/home/footer.php'; ?>

    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.min.js"></script>
    <script src="/uppertruck/assets/js/home.js"></script>
    <script>
        (function () {
            const buttons = Array.from(document.querySelectorAll('[data-cf-tab-button]'));
            const panels = Array.from(document.querySelectorAll('[data-cf-tab-panel]'));
            if (!buttons.length || !panels.length) return;

            const setActiveTab = (target) => {
                buttons.forEach((button) => {
                    const isActive = button.getAttribute('data-cf-tab-button') === target;
                    button.classList.toggle('is-active', isActive);
                    button.setAttribute('aria-selected', isActive ? 'true' : 'false');
                });

                panels.forEach((panel) => {
                    const isActive = panel.getAttribute('data-cf-tab-panel') === target;
                    panel.classList.toggle('is-active', isActive);
                    panel.toggleAttribute('hidden', !isActive);
                });
            };

            buttons.forEach((button) => {
                button.addEventListener('click', () => setActiveTab(button.getAttribute('data-cf-tab-button')));
            });
        })();
    </script>
</body>

</html>
