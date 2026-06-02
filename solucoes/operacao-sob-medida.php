<?php
declare(strict_types=1);
require_once dirname(__DIR__) . '/components/home/path-bootstrap.php';

$metaTitle = 'Operação Sob Medida | Soluções Logísticas Personalizadas | Uppertruck';
$metaDescription = 'Soluções logísticas sob medida para empresas que precisam de operações personalizadas, rotas específicas, acompanhamento operacional e mais previsibilidade.';

$menuItems = [
    ['label' => 'Home', 'href' => '/uppertruck/index.php'],
    ['label' => 'Sobre', 'href' => '/uppertruck/sobre.php'],
    ['label' => 'Soluções', 'href' => '/uppertruck/solucoes.php', 'dropdown' => [
        ['label' => 'Carga Fracionada', 'href' => '/uppertruck/solucoes/carga-fracionada.php'],
        ['label' => 'Carga Dedicada', 'href' => '/uppertruck/solucoes/carga-dedicada.php'],
        ['label' => 'Consolidação de Cargas', 'href' => '/uppertruck/solucoes/consolidacao-de-cargas.php'],
        ['label' => 'Last Mile', 'href' => '/uppertruck/solucoes/last-mile.php'],
        ['label' => 'Operações Sob Medida', 'href' => '/uppertruck/solucoes/operacoes-sob-medida.php'],
    ]],
    ['label' => 'Para Empresas', 'href' => '/uppertruck/para-empresas.php'],
    ['label' => 'Para Transportadores', 'href' => '/uppertruck/para-transportadores.php'],
    ['label' => 'Blog', 'href' => '/uppertruck/blog'],
    ['label' => 'Cotação', 'href' => '/uppertruck/cotacao-contato.php'],
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
    ['title' => 'Diagnóstico operacional', 'text' => 'Análise da rotina, gargalos e prioridades.', 'icon' => 'search-check'],
    ['title' => 'Modelo personalizado', 'text' => 'Solução desenhada conforme a sua demanda.', 'icon' => 'drafting-compass'],
    ['title' => 'Acompanhamento ativo', 'text' => 'Gestão próxima para ajustar e evoluir a operação.', 'icon' => 'radar'],
];

$whenCards = [
    ['title' => 'Rotas específicas', 'text' => 'Quando origem, destino e frequência exigem planejamento proprio.', 'icon' => 'route'],
    ['title' => 'Prazos críticos', 'text' => 'Quando atrasos afetam produção, entrega ou atendimento.', 'icon' => 'alarm-clock-check'],
    ['title' => 'Múltiplos pontos', 'text' => 'Quando a operação envolve coletas, entregas ou unidades diferentes.', 'icon' => 'map-pinned'],
    ['title' => 'Carga com particularidades', 'text' => 'Quando o tipo de produto exige cuidado, prioridade ou fluxo especial.', 'icon' => 'package-check'],
    ['title' => 'Demanda variavel', 'text' => 'Quando o volume muda por campanha, sazonalidade ou crescimento.', 'icon' => 'trending-up'],
    ['title' => 'Gargalos recorrentes', 'text' => 'Quando a logística atual gera retrabalho, atraso ou perda de controle.', 'icon' => 'triangle-alert'],
];

$diagnosticAnalyze = [
    'Origem e destino',
    'Frequência de embarques',
    'Tipo de carga',
    'Volume médio',
    'Janelas de coleta e entrega',
    'Pontos críticos',
    'Nível de acompanhamento',
    'Necessidade de contingência',
];

$diagnosticIdentify = [
    'Gargalos da operação',
    'Riscos de atraso',
    'Oportunidades de consolidação',
    'Melhor modelo de transporte',
    'Necessidade de rota dedicada',
    'Pontos de controle',
    'Ajustes de comunicação',
    'Indicadores de acompanhamento',
];

$solutionFlow = [
    ['title' => 'Diagnóstico', 'text' => 'Entendimento da operação, objetivos e pontos críticos.', 'icon' => 'scan-search'],
    ['title' => 'Desenho do fluxo', 'text' => 'Definição de rotas, frequência, capacidade e prioridades.', 'icon' => 'waypoints'],
    ['title' => 'Estruturação', 'text' => 'Planejamento de recursos, comunicação, prazos e contingências.', 'icon' => 'settings-2'],
    ['title' => 'Execução', 'text' => 'Operação em andamento com acompanhamento próximo.', 'icon' => 'truck'],
    ['title' => 'Otimizacao', 'text' => 'Ajustes contínuos conforme performance, demanda e evolução do cliente.', 'icon' => 'chart-line'],
];

$demandCards = [
    ['badge' => 'Indústria', 'title' => 'Operações industriais', 'text' => 'Fluxos entre fábricas, fornecedores, CDs e clientes estratégicos.', 'icon' => 'factory', 'size' => 'wide'],
    ['badge' => 'Especial', 'title' => 'Projetos especiais', 'text' => 'Demandas fora do padrão, com planejamento e acompanhamento específico.', 'icon' => 'rocket', 'size' => 'small'],
    ['badge' => 'Recorrente', 'title' => 'Distribuição recorrente', 'text' => 'Rotinas de entrega com frequência, prioridade e previsibilidade.', 'icon' => 'repeat', 'size' => 'small'],
    ['badge' => 'Sazonal', 'title' => 'Sazonalidade e picos', 'text' => 'Reforco operacional para campanhas e aumento de volume.', 'icon' => 'calendar-range', 'size' => 'wide'],
    ['badge' => 'Sensível', 'title' => 'Cargas sensíveis', 'text' => 'Operações que exigem menor manuseio, cuidado ou rota controlada.', 'icon' => 'shield-alert', 'size' => 'small'],
    ['badge' => 'Expansão', 'title' => 'Expansão de operação', 'text' => 'Apoio logístico para novas regiões, unidades ou modelos de distribuição.', 'icon' => 'map', 'size' => 'small'],
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
    <a class="skip-link" href="#conteudo-principal">Pular para o conteúdo principal</a>

    <?php include __DIR__ . '/../components/home/header.php'; ?>

    <main id="conteudo-principal">
        <section class="osm-section osm-hero">
            <div class="container osm-hero__grid">
                <div class="osm-hero__content reveal">
                    <p class="osm-kicker">Solução Uppertruck</p>
                    <h1>Operação <span>Sob Medida</span> para logísticas que não cabem em modelos prontos</h1>
                    <p class="osm-hero__lead">
                        Desenhamos soluções logísticas personalizadas a partir da realidade da sua empresa, considerando rotas, volumes, prazos, pontos críticos e nível de acompanhamento necessário.
                    </p>
                    <div class="osm-hero__actions">
                        <a class="btn btn-primary" href="/uppertruck/cotacao-contato/solicitar-cotacao.php">Solicitar análise da operação</a>
                        <a class="btn osm-btn-secondary" href="/uppertruck/cotacao-contato/falar-com-especialista.php">Falar com especialista</a>
                    </div>
                    <p class="osm-hero__microcopy">Ideal para demandas específicas, projetos especiais, fluxos complexos e operações com necessidades próprias.</p>
                </div>

                <div class="osm-hero__visual reveal" style="--delay:80ms;">
                    <figure class="osm-hero__media">
                        <img src="<?php echo htmlspecialchars($images['hero'], ENT_QUOTES, 'UTF-8'); ?>" alt="Planejamento de operação logística personalizada" loading="eager" decoding="async">
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
                    <img src="<?php echo htmlspecialchars($images['intro'], ENT_QUOTES, 'UTF-8'); ?>" alt="Equipe analisando fluxo logístico e mapa de operação" loading="lazy" decoding="async">
                </figure>
                <div class="osm-intro__content reveal" style="--delay:70ms;">
                    <p class="osm-kicker">Solução personalizada para cenários reais</p>
                    <h2>Sua operação tem particularidades. Sua logística também deve ter.</h2>
                    <p>Nem toda empresa se encaixa em uma operação logística padrão. Quando há rotas específicas, prazos críticos, diferentes pontos de coleta ou exigências operacionais, é preciso desenhar um modelo que acompanhe a realidade do negócio.</p>
                    <p>Na Uppertruck, a solução e construida a partir de diagnóstico, planejamento e acompanhamento operacional.</p>
                    <a class="btn btn-primary" href="/uppertruck/cotacao-contato/falar-com-especialista.php">Entender como funciona</a>
                </div>
            </div>
        </section>

        <section class="osm-section osm-when">
            <div class="container">
                <div class="osm-head reveal">
                    <h2>Quando uma solução pronta deixa de ser suficiente?</h2>
                    <p>Algumas operações exigem mais do que transporte. Elas precisam de leitura, desenho e adaptação.</p>
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
                    <h2>Antes da solução, entendemos a operação.</h2>
                    <p>A operação sob medida começa com uma leitura clara da rotina logística, dos pontos críticos e das prioridades do cliente.</p>
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
                    <h2>Da análise ao modelo operacional: como a solução e construida</h2>
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
                    <h2>Projetos logísticos para diferentes realidades operacionais</h2>
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
                    <h2>Uma operação desenhada para ser acompanhada, ajustada e evoluida.</h2>
                    <p>Além de estruturar o modelo, a Uppertruck acompanha a operação para identificar ajustes, reduzir ruídos e manter a logística alinhada ao ritmo da empresa.</p>
                </div>

                <div class="osm-panel__shell reveal" style="--delay:85ms;">
                    <div class="osm-panel__tabs" role="tablist" aria-label="Etapas da operação personalizada">
                        <button type="button" class="is-active" data-osm-tab="diagnostico" aria-selected="true">Diagnóstico</button>
                        <button type="button" data-osm-tab="planejamento" aria-selected="false">Planejamento</button>
                        <button type="button" data-osm-tab="operacao" aria-selected="false">Operação ativa</button>
                    </div>

                    <div class="osm-panel__grid">
                        <div class="osm-panel__summary">
                            <p class="osm-panel__chip">Modelo operacional: Personalizado</p>
                            <h3 id="osm-tab-title">Operação em análise</h3>
                            <p id="osm-tab-text">Mapeamento de rotas, volumes, pontos críticos e prioridades.</p>

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
                                <li><span>Frequência</span><strong id="osm-frequency">Em definição</strong></li>
                                <li><span>Pontos críticos</span><strong id="osm-crítical">Mapeamento inicial</strong></li>
                                <li><span>Contingência</span><strong id="osm-contingency">Em estudo</strong></li>
                                <li><span>Acompanhamento</span><strong id="osm-follow">Ativo</strong></li>
                            </ul>
                        </div>

                        <div class="osm-panel__metrics">
                            <article><span>Pontos de coleta</span><strong id="osm-m1">4</strong></article>
                            <article><span>Destinos recorrentes</span><strong id="osm-m2">8</strong></article>
                            <article><span>Janelas críticas</span><strong id="osm-m3">3</strong></article>
                            <article><span>SLA</span><strong id="osm-m4">Em acompanhamento</strong></article>
                            <article><span>Ajustes sugeridos</span><strong id="osm-m5">2</strong></article>
                            <article><span>Plano de contingência</span><strong id="osm-m6">1</strong></article>
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
                    <h2>Conheça nossa FAQ</h2>
                    <p>Principais dúvidas sobre Operação Sob Medida e soluções logísticas personalizadas.</p>
                </aside>
            </div>
        </section>

        <section class="osm-section osm-cta">
            <div class="container">
                <div class="osm-cta__box reveal">
                    <h2>Vamos desenhar uma operação logística para a sua realidade?</h2>
                    <p>A Uppertruck avalia rotas, volumes, frequência, janelas, pontos críticos e objetivos da sua empresa para construir uma solução sob medida, com mais controle e previsibilidade.</p>
                    <div class="osm-cta__actions">
                        <a class="btn btn-primary" href="/uppertruck/cotacao-contato/solicitar-cotacao.php">Solicitar análise da operação</a>
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
