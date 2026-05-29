<?php
declare(strict_types=1);


require_once dirname(__DIR__) . '/components/home/path-bootstrap.php';
$metaTitle = 'Operacao Sob Medida | Solucoes Logisticas Personalizadas | Uppertruck';
$metaDescription = 'Solucoes logisticas sob medida para empresas que precisam de operacoes personalizadas, rotas especificas, acompanhamento operacional e mais previsibilidade.';

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
    ['label' => 'Blog', 'href' => '/uppertruck/blog'],
    ['label' => 'Cotacao', 'href' => '/uppertruck/cotacao-contato.php'],
];

function sobMedidaImage(string $basename, string $fallback): string
{
    $safeBasename = trim($basename);
    if ($safeBasename === '') {
        return $fallback;
    }

    $extensions = ['webp', 'png', 'jpg', 'jpeg'];
    foreach ($extensions as $extension) {
        $relative = '/img/ai/' . $safeBasename . '.' . $extension;
        $absolute = dirname(__DIR__) . str_replace('/', DIRECTORY_SEPARATOR, $relative);
        if (is_file($absolute)) {
            return '/uppertruck' . $relative;
        }
    }

    return $fallback;
}

$images = [
    'hero' => sobMedidaImage('hero-operacoes-sob-medida', '/uppertruck/img/cargas-sob-demanda.png'),
    'intro' => sobMedidaImage('diagnostico-operacao-sob-medida', '/uppertruck/img/upper3.png'),
    'panel' => sobMedidaImage('painel-operacao-sob-medida', '/uppertruck/img/upper6.png'),
];

$heroCards = [
    ['title' => 'Diagnostico operacional', 'text' => 'Analise da rotina, gargalos e prioridades.', 'icon' => 'search-check'],
    ['title' => 'Modelo personalizado', 'text' => 'Solucao desenhada conforme a sua demanda.', 'icon' => 'drafting-compass'],
    ['title' => 'Acompanhamento ativo', 'text' => 'Gestao proxima para ajustar e evoluir a operacao.', 'icon' => 'radar'],
];

$whenCards = [
    ['title' => 'Rotas especificas', 'text' => 'Quando origem, destino e frequencia exigem planejamento proprio.', 'icon' => 'route'],
    ['title' => 'Prazos criticos', 'text' => 'Quando atrasos afetam producao, entrega ou atendimento.', 'icon' => 'alarm-clock-check'],
    ['title' => 'Multiplos pontos', 'text' => 'Quando a operacao envolve coletas, entregas ou unidades diferentes.', 'icon' => 'map-pinned'],
    ['title' => 'Carga com particularidades', 'text' => 'Quando o tipo de produto exige cuidado, prioridade ou fluxo especial.', 'icon' => 'package-check'],
    ['title' => 'Demanda variavel', 'text' => 'Quando o volume muda por campanha, sazonalidade ou crescimento.', 'icon' => 'trending-up'],
    ['title' => 'Gargalos recorrentes', 'text' => 'Quando a logistica atual gera retrabalho, atraso ou perda de controle.', 'icon' => 'triangle-alert'],
];

$diagnosticAnalyze = [
    'Origem e destino',
    'Frequencia de embarques',
    'Tipo de carga',
    'Volume medio',
    'Janelas de coleta e entrega',
    'Pontos criticos',
    'Nivel de acompanhamento',
    'Necessidade de contingencia',
];

$diagnosticIdentify = [
    'Gargalos da operacao',
    'Riscos de atraso',
    'Oportunidades de consolidacao',
    'Melhor modelo de transporte',
    'Necessidade de rota dedicada',
    'Pontos de controle',
    'Ajustes de comunicacao',
    'Indicadores de acompanhamento',
];

$solutionFlow = [
    ['title' => 'Diagnostico', 'text' => 'Entendimento da operacao, objetivos e pontos criticos.', 'icon' => 'scan-search'],
    ['title' => 'Desenho do fluxo', 'text' => 'Definicao de rotas, frequencia, capacidade e prioridades.', 'icon' => 'waypoints'],
    ['title' => 'Estruturacao', 'text' => 'Planejamento de recursos, comunicacao, prazos e contingencias.', 'icon' => 'settings-2'],
    ['title' => 'Execucao', 'text' => 'Operacao em andamento com acompanhamento proximo.', 'icon' => 'truck'],
    ['title' => 'Otimizacao', 'text' => 'Ajustes continuos conforme performance, demanda e evolucao do cliente.', 'icon' => 'chart-line'],
];

$demandCards = [
    ['badge' => 'Industria', 'title' => 'Operacoes industriais', 'text' => 'Fluxos entre fabricas, fornecedores, CDs e clientes estrategicos.', 'icon' => 'factory', 'size' => 'wide'],
    ['badge' => 'Especial', 'title' => 'Projetos especiais', 'text' => 'Demandas fora do padrao, com planejamento e acompanhamento especifico.', 'icon' => 'rocket', 'size' => 'small'],
    ['badge' => 'Recorrente', 'title' => 'Distribuicao recorrente', 'text' => 'Rotinas de entrega com frequencia, prioridade e previsibilidade.', 'icon' => 'repeat', 'size' => 'small'],
    ['badge' => 'Sazonal', 'title' => 'Sazonalidade e picos', 'text' => 'Reforco operacional para campanhas e aumento de volume.', 'icon' => 'calendar-range', 'size' => 'wide'],
    ['badge' => 'Sensivel', 'title' => 'Cargas sensiveis', 'text' => 'Operacoes que exigem menor manuseio, cuidado ou rota controlada.', 'icon' => 'shield-alert', 'size' => 'small'],
    ['badge' => 'Expansao', 'title' => 'Expansao de operacao', 'text' => 'Apoio logistico para novas regioes, unidades ou modelos de distribuicao.', 'icon' => 'map', 'size' => 'small'],
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
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Manrope:wght@600;700;800&family=Plus+Jakarta+Sans:wght@500;600;700;800&family=Sora:wght@500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/uppertruck/assets/css/home.css">
    <link rel="stylesheet" href="/uppertruck/assets/css/operacao-sob-medida.css">
</head>

<body class="osm-page">
    <a class="skip-link" href="#conteudo-principal">Pular para o conteudo principal</a>

    <?php include __DIR__ . '/../components/home/header.php'; ?>

    <main id="conteudo-principal">
        <section class="osm-section osm-hero">
            <div class="container osm-hero__grid">
                <div class="osm-hero__content reveal">
                    <p class="osm-kicker">Solucao Uppertruck</p>
                    <h1>Operacao <span>Sob Medida</span> para logisticas que nao cabem em modelos prontos</h1>
                    <p class="osm-hero__lead">
                        Desenhamos solucoes logisticas personalizadas a partir da realidade da sua empresa, considerando rotas, volumes, prazos, pontos criticos e nivel de acompanhamento necessario.
                    </p>
                    <div class="osm-hero__actions">
                        <a class="btn btn-primary" href="/uppertruck/cotacao-contato/solicitar-cotacao.php">Solicitar analise da operacao</a>
                        <a class="btn osm-btn-secondary" href="/uppertruck/cotacao-contato/falar-com-especialista.php">Falar com especialista</a>
                    </div>
                    <p class="osm-hero__microcopy">Ideal para demandas especificas, projetos especiais, fluxos complexos e operacoes com necessidades proprias.</p>
                </div>

                <div class="osm-hero__visual reveal" style="--delay:80ms;">
                    <figure class="osm-hero__media">
                        <img src="<?php echo htmlspecialchars($images['hero'], ENT_QUOTES, 'UTF-8'); ?>" alt="Planejamento de operacao logistica personalizada" loading="eager" decoding="async">
                        <div class="osm-hero__overlay" aria-hidden="true"></div>
                    </figure>
                    <div class="osm-hero__cards">
                        <?php foreach ($heroCards as $index => $card): ?>
                            <article class="osm-hero__card reveal" style="--delay: <?php echo htmlspecialchars((string) (120 + ($index * 70)), ENT_QUOTES, 'UTF-8'); ?>ms;">
                                <i data-lucide="<?php echo htmlspecialchars($card['icon'], ENT_QUOTES, 'UTF-8'); ?>"></i>
                                <h3><?php echo htmlspecialchars($card['title'], ENT_QUOTES, 'UTF-8'); ?></h3>
                                <p><?php echo htmlspecialchars($card['text'], ENT_QUOTES, 'UTF-8'); ?></p>
                            </article>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </section>

        <section class="osm-section osm-intro">
            <div class="container osm-intro__grid">
                <figure class="osm-intro__media reveal">
                    <img src="<?php echo htmlspecialchars($images['intro'], ENT_QUOTES, 'UTF-8'); ?>" alt="Equipe analisando fluxo logistico e mapa de operacao" loading="lazy" decoding="async">
                </figure>
                <div class="osm-intro__content reveal" style="--delay:70ms;">
                    <p class="osm-kicker">Solucao personalizada para cenarios reais</p>
                    <h2>Sua operacao tem particularidades. Sua logistica tambem deve ter.</h2>
                    <p>Nem toda empresa se encaixa em uma operacao logistica padrao. Quando ha rotas especificas, prazos criticos, diferentes pontos de coleta ou exigencias operacionais, e preciso desenhar um modelo que acompanhe a realidade do negocio.</p>
                    <p>Na Uppertruck, a solucao e construida a partir de diagnostico, planejamento e acompanhamento operacional.</p>
                    <a class="btn btn-primary" href="/uppertruck/cotacao-contato/falar-com-especialista.php">Entender como funciona</a>
                </div>
            </div>
        </section>

        <section class="osm-section osm-when">
            <div class="container">
                <div class="osm-head reveal">
                    <h2>Quando uma solucao pronta deixa de ser suficiente?</h2>
                    <p>Algumas operacoes exigem mais do que transporte. Elas precisam de leitura, desenho e adaptacao.</p>
                </div>
                <div class="osm-when__grid">
                    <?php foreach ($whenCards as $index => $item): ?>
                        <article class="osm-when__card reveal" style="--delay: <?php echo htmlspecialchars((string) (50 + ($index * 45)), ENT_QUOTES, 'UTF-8'); ?>ms;">
                            <i data-lucide="<?php echo htmlspecialchars($item['icon'], ENT_QUOTES, 'UTF-8'); ?>"></i>
                            <h3><?php echo htmlspecialchars($item['title'], ENT_QUOTES, 'UTF-8'); ?></h3>
                            <p><?php echo htmlspecialchars($item['text'], ENT_QUOTES, 'UTF-8'); ?></p>
                        </article>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <section class="osm-section osm-diagnostic">
            <div class="container">
                <div class="osm-head reveal">
                    <h2>Antes da solucao, entendemos a operacao.</h2>
                    <p>A operacao sob medida comeca com uma leitura clara da rotina logistica, dos pontos criticos e das prioridades do cliente.</p>
                </div>
                <div class="osm-diagnostic__grid reveal" style="--delay:80ms;">
                    <article class="osm-diagnostic__block">
                        <h3>O que analisamos</h3>
                        <ul>
                            <?php foreach ($diagnosticAnalyze as $item): ?>
                                <li><i data-lucide="scan-search"></i> <?php echo htmlspecialchars($item, ENT_QUOTES, 'UTF-8'); ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </article>
                    <article class="osm-diagnostic__block">
                        <h3>O que identificamos</h3>
                        <ul>
                            <?php foreach ($diagnosticIdentify as $item): ?>
                                <li><i data-lucide="check-check"></i> <?php echo htmlspecialchars($item, ENT_QUOTES, 'UTF-8'); ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </article>
                </div>
            </div>
        </section>

        <section class="osm-section osm-flow">
            <div class="container">
                <div class="osm-head reveal">
                    <h2>Da analise ao modelo operacional: como a solucao e construida</h2>
                </div>
                <div class="osm-flow__timeline">
                    <?php foreach ($solutionFlow as $index => $item): ?>
                        <article class="osm-flow__step reveal" style="--delay: <?php echo htmlspecialchars((string) (($index + 1) * 55), ENT_QUOTES, 'UTF-8'); ?>ms;">
                            <span class="osm-flow__point"><?php echo htmlspecialchars((string) ($index + 1), ENT_QUOTES, 'UTF-8'); ?></span>
                            <i data-lucide="<?php echo htmlspecialchars($item['icon'], ENT_QUOTES, 'UTF-8'); ?>"></i>
                            <h3><?php echo htmlspecialchars($item['title'], ENT_QUOTES, 'UTF-8'); ?></h3>
                            <p><?php echo htmlspecialchars($item['text'], ENT_QUOTES, 'UTF-8'); ?></p>
                        </article>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <section class="osm-section osm-demands">
            <div class="container">
                <div class="osm-head reveal">
                    <h2>Projetos logisticos para diferentes realidades operacionais</h2>
                </div>
                <div class="osm-demands__mosaic">
                    <?php foreach ($demandCards as $index => $item): ?>
                        <article class="osm-demands__card osm-demands__card--<?php echo htmlspecialchars($item['size'], ENT_QUOTES, 'UTF-8'); ?> reveal" style="--delay: <?php echo htmlspecialchars((string) (45 + ($index * 40)), ENT_QUOTES, 'UTF-8'); ?>ms;">
                            <p class="osm-demands__badge"><?php echo htmlspecialchars($item['badge'], ENT_QUOTES, 'UTF-8'); ?></p>
                            <i data-lucide="<?php echo htmlspecialchars($item['icon'], ENT_QUOTES, 'UTF-8'); ?>"></i>
                            <h3><?php echo htmlspecialchars($item['title'], ENT_QUOTES, 'UTF-8'); ?></h3>
                            <p><?php echo htmlspecialchars($item['text'], ENT_QUOTES, 'UTF-8'); ?></p>
                        </article>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <section class="osm-section osm-panel">
            <div class="container">
                <div class="osm-head reveal">
                    <h2>Uma operacao desenhada para ser acompanhada, ajustada e evoluida.</h2>
                    <p>Alem de estruturar o modelo, a Uppertruck acompanha a operacao para identificar ajustes, reduzir ruidos e manter a logistica alinhada ao ritmo da empresa.</p>
                </div>

                <div class="osm-panel__shell reveal" style="--delay:85ms;">
                    <div class="osm-panel__tabs" role="tablist" aria-label="Etapas da operacao personalizada">
                        <button type="button" class="is-active" data-osm-tab="diagnostico" aria-selected="true">Diagnostico</button>
                        <button type="button" data-osm-tab="planejamento" aria-selected="false">Planejamento</button>
                        <button type="button" data-osm-tab="operacao" aria-selected="false">Operacao ativa</button>
                    </div>

                    <div class="osm-panel__grid">
                        <div class="osm-panel__summary">
                            <p class="osm-panel__chip">Modelo operacional: Personalizado</p>
                            <h3 id="osm-tab-title">Operacao em analise</h3>
                            <p id="osm-tab-text">Mapeamento de rotas, volumes, pontos criticos e prioridades.</p>

                            <div class="osm-progress">
                                <div class="osm-progress__meta">
                                    <span>Progresso do projeto</span>
                                    <strong id="osm-progress-value">30%</strong>
                                </div>
                                <div class="osm-progress__track">
                                    <span id="osm-progress-bar" style="width:30%"></span>
                                </div>
                            </div>
                        </div>

                        <div class="osm-panel__status">
                            <ul>
                                <li><span>Rota</span><strong id="osm-route">Sob planejamento</strong></li>
                                <li><span>Frequencia</span><strong id="osm-frequency">Em definicao</strong></li>
                                <li><span>Pontos criticos</span><strong id="osm-critical">Mapeamento inicial</strong></li>
                                <li><span>Contingencia</span><strong id="osm-contingency">Em estudo</strong></li>
                                <li><span>Acompanhamento</span><strong id="osm-follow">Ativo</strong></li>
                            </ul>
                        </div>

                        <div class="osm-panel__metrics">
                            <article><span>Pontos de coleta</span><strong id="osm-m1">4</strong></article>
                            <article><span>Destinos recorrentes</span><strong id="osm-m2">8</strong></article>
                            <article><span>Janelas criticas</span><strong id="osm-m3">3</strong></article>
                            <article><span>SLA</span><strong id="osm-m4">Em acompanhamento</strong></article>
                            <article><span>Ajustes sugeridos</span><strong id="osm-m5">2</strong></article>
                            <article><span>Plano de contingencia</span><strong id="osm-m6">1</strong></article>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="osm-section osm-faq">
            <div class="container osm-faq__grid">
                <div class="osm-faq__list reveal">
                    <?php foreach ($faqItems as $index => $item): ?>
                        <details class="osm-faq__item" <?php echo $index === 0 ? 'open' : ''; ?>>
                            <summary>
                                <span><?php echo htmlspecialchars($item['question'], ENT_QUOTES, 'UTF-8'); ?></span>
                                <i data-lucide="chevron-down"></i>
                            </summary>
                            <div class="osm-faq__answer">
                                <p><?php echo htmlspecialchars($item['answer'], ENT_QUOTES, 'UTF-8'); ?></p>
                            </div>
                        </details>
                    <?php endforeach; ?>
                </div>
                <aside class="osm-faq__aside reveal" style="--delay:70ms;">
                    <p class="osm-kicker">FAQ</p>
                    <h2>Conheca nossa FAQ</h2>
                    <p>Principais duvidas sobre Operacao Sob Medida e solucoes logisticas personalizadas.</p>
                </aside>
            </div>
        </section>

        <section class="osm-section osm-cta">
            <div class="container">
                <div class="osm-cta__box reveal">
                    <h2>Vamos desenhar uma operacao logistica para a sua realidade?</h2>
                    <p>A Uppertruck avalia rotas, volumes, frequencia, janelas, pontos criticos e objetivos da sua empresa para construir uma solucao sob medida, com mais controle e previsibilidade.</p>
                    <div class="osm-cta__actions">
                        <a class="btn btn-primary" href="/uppertruck/cotacao-contato/solicitar-cotacao.php">Solicitar analise da operacao</a>
                        <a class="btn osm-btn-secondary" href="/uppertruck/cotacao-contato/falar-com-especialista.php">Falar com especialista</a>
                    </div>
                    <p class="osm-cta__label">Avaliamos:</p>
                    <ul class="osm-cta__checklist">
                        <?php foreach ($ctaChecklist as $item): ?>
                            <li><i data-lucide="check"></i> <?php echo htmlspecialchars($item, ENT_QUOTES, 'UTF-8'); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </section>
    </main>

    <?php include __DIR__ . '/../components/home/footer.php'; ?>

    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.min.js"></script>
    <script src="/uppertruck/assets/js/home.js"></script>
    <script src="/uppertruck/assets/js/operacao-sob-medida.js"></script>
</body>

</html>
