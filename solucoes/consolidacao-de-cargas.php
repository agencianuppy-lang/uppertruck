<?php
declare(strict_types=1);
require_once dirname(__DIR__) . '/components/home/path-bootstrap.php';

$metaTitle = 'Consolidação de Cargas | Uppertruck';
$metaDescription = 'Consolidação de cargas com método operacional para reduzir custo, melhorar aproveitamento de transporte e aumentar previsibilidade.';
$currentYear = date('Y');

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

function consolidacaoImage(string $basename, string $fallback): string
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
    'hero' => consolidacaoImage('hero-consolidacao-cargas', '/uppertruck/img/upper5.png'),
    'tabbed' => consolidacaoImage('coleta-consolidacao-cargas', '/uppertruck/img/distribuicao.png'),
    'operations' => consolidacaoImage('gestao-malha-consolidada', '/uppertruck/img/consolidacao-de-cargas-2.jpg'),
    'insight' => consolidacaoImage('hub-consolidacao-cargas', '/uppertruck/img/2151994456.jpg'),
];

$serviceModules = [
    [
        'image' => consolidacaoImage('coleta-consolidacao-cargas', '/uppertruck/img/ilus-1.png'),
        'title' => 'Coleta e Triagem',
        'description' => 'Recebemos os volumes e organizamos por destino, janela de entrega e prioridade operacional.',
        'bullet' => 'Separacao por rota para reduzir dispersao e retrabalho.',
    ],
    [
        'image' => consolidacaoImage('hub-consolidacao-cargas', '/uppertruck/img/ilus-2.png'),
        'title' => 'Consolidação por Estrategia',
        'description' => 'Agrupamos cargas compatíveis para elevar ocupação e melhorar eficiência de transporte.',
        'bullet' => 'Composicao por cubagem, região e criticidade de embarque.',
    ],
    [
        'image' => consolidacaoImage('gestao-malha-consolidada', '/uppertruck/img/ilus-3.png'),
        'title' => 'Distribuição Monitorada',
        'description' => 'Acompanhamos expedição, trânsito e entrega com leitura ativa de status e ocorrências.',
        'bullet' => 'Controle de SLA com comunicação operacional contínua.',
    ],
];

$operationalStats = [
    ['value' => '+22%', 'label' => 'ganho médio no aproveitamento de carga', 'icon' => 'bar-chart-3', 'tag' => 'Eficiência'],
    ['value' => '-18%', 'label' => 'redução media em custo por envio', 'icon' => 'badge-dollar-sign', 'tag' => 'Custo'],
    ['value' => '96%', 'label' => 'embarques dentro da janela planejada', 'icon' => 'target', 'tag' => 'SLA'],
    ['value' => '100%', 'label' => 'visibilidade operacional da jornada', 'icon' => 'radar', 'tag' => 'Controle'],
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
    <a class="skip-link" href="#conteudo-principal">Pular para o conteúdo principal</a>

    <?php include __DIR__ . '/../components/home/header.php'; ?>

    <main id="conteudo-principal">
        <section class="cf-hero">
            <div class="container cf-hero-grid">
                <div class="cf-hero-copy reveal">
                    <p class="eyebrow">Solução Uppertruck</p>
                    <h1>Consolidação de Cargas com mais economia, método e previsibilidade.</h1>
                    <p class="cf-hero-lead">
                        Organizamos embarques por rota, destino e prioridade para reduzir fretes soltos e transformar a operação em um fluxo mais eficiente.
                    </p>
                    <div class="cf-hero-actions">
                        <a class="btn btn-primary" href="/uppertruck/cotacao-contato/solicitar-cotacao.php">Solicitar cotação</a>
                        <a class="btn cf-btn-secondary" href="/uppertruck/cotacao-contato/falar-com-especialista.php">Falar com especialista</a>
                    </div>
                    <div class="cf-hero-kpis">
                        <div><strong>+20%</strong><span>melhor ocupação de carga</span></div>
                        <div><strong>-18%</strong><span>custo médio por envio</span></div>
                        <div><strong>100%</strong><span>monitoramento operacional</span></div>
                    </div>
                </div>

                <figure class="cf-hero-media reveal" style="--delay: 80ms">
                    <img src="<?php echo htmlspecialchars($images['hero'], ENT_QUOTES, 'UTF-8'); ?>" alt="Operação de consolidação de cargas em andamento" loading="eager" decoding="async">
                    <figcaption>
                        <span><i data-lucide="layers-3"></i> Volumes agrupados</span>
                        <span><i data-lucide="route"></i> Rotas planejadas</span>
                    </figcaption>
                </figure>
            </div>
        </section>

        <section class="section-shell cf-tabbed-solution">
            <div class="container cf-tabbed-solution-grid">
                <figure class="cf-tabbed-media reveal" style="--delay: 80ms">
                    <img src="<?php echo htmlspecialchars($images['tabbed'], ENT_QUOTES, 'UTF-8'); ?>" alt="Planejamento logístico para consolidação de cargas" loading="lazy" decoding="async">
                </figure>

                <div class="cf-tabbed-content reveal">
                    <p class="eyebrow">Solução inteligente para cargas recorrentes</p>
                    <h2>Consolidação de Cargas com mais controle para sua rotina</h2>

                    <div class="cf-tabbed-nav" role="tablist" aria-label="Conteudo sobre consolidacao de cargas">
                        <button type="button" class="is-active" role="tab" aria-selected="true" data-cf-tab-button="sobre">Sobre a solução</button>
                        <button type="button" role="tab" aria-selected="false" data-cf-tab-button="operamos">Como operamos</button>
                        <button type="button" role="tab" aria-selected="false" data-cf-tab-button="vantagens">Vantagens para sua empresa</button>
                    </div>

                    <div class="cf-tabbed-panels">
                        <article class="cf-tabbed-panel is-active" data-cf-tab-panel="sobre">
                            <p>A consolidação de cargas é ideal para empresas com embarques recorrentes, múltiplos destinos e volumes que saem de forma pulverizada. Em vez de vários fretes separados, estruturamos uma operação mais inteligente.</p>
                            <p>Com isso, sua empresa ganha melhor aproveitamento do transporte, mais previsibilidade e menos variação de custo logístico.</p>
                            <div class="cf-tabbed-actions">
                                <a class="btn btn-primary" href="/uppertruck/cotacao-contato/solicitar-cotacao.php">Solicitar cotação</a>
                                <a class="btn cf-btn-secondary" href="/uppertruck/cotacao-contato/falar-com-especialista.php">Falar com especialista</a>
                            </div>
                        </article>

                        <article class="cf-tabbed-panel" data-cf-tab-panel="operamos" hidden>
                            <p>Na Uppertruck, o processo comeca com coleta e triagem dos volumes. Depois, consolidamos por estrategia de rota e expedimos com acompanhamento ativo da operação.</p>
                            <p>Isso reduz improviso, melhora o fluxo da malha e ajuda sua equipe a operar com mais consistência no dia a dia.</p>
                            <div class="cf-tabbed-actions">
                                <a class="btn cf-btn-secondary" href="#como-operamos">Entender a operação</a>
                                <a class="btn btn-primary" href="/uppertruck/cotacao-contato/solicitar-cotacao.php">Solicitar cotação</a>
                            </div>
                        </article>

                        <article class="cf-tabbed-panel" data-cf-tab-panel="vantagens" hidden>
                            <p>Consolidar cargas ajuda sua empresa a reduzir fretes soltos, melhorar ocupação de veículo e organizar embarques por prioridade e janela de entrega.</p>
                            <p>Na prática, o resultado e uma operação mais previsível, mais econômica e com melhor governança operacional.</p>
                            <ul class="cf-tabbed-benefits">
                                <li>Mais eficiência no transporte</li>
                                <li>Menos dispersao de embarques</li>
                                <li>Maior previsibilidade de prazos</li>
                            </ul>
                            <div class="cf-tabbed-actions">
                                <a class="btn btn-primary" href="/uppertruck/cotacao-contato/solicitar-cotacao.php">Solicitar cotação</a>
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
                    <h2>Do volume disperso para uma malha consolidada com método.</h2>
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
                    <img src="<?php echo htmlspecialchars($images['operations'], ENT_QUOTES, 'UTF-8'); ?>" alt="Gestão operacional de consolidação de cargas" loading="lazy" decoding="async">
                </figure>
                <div class="cf-operations-copy reveal" style="--delay: 90ms">
                    <p class="eyebrow">Gestão aplicada</p>
                    <h2>Consolidação com planejamento, acompanhamento e leitura de performance.</h2>
                    <p>
                        Trabalhamos com processos claros de agrupamento, controle de rota e visibilidade de status para manter a operação estavel mesmo com variação de demanda.
                    </p>
                    <ul>
                        <li><i data-lucide="radar"></i> Monitoramento ativo da jornada</li>
                        <li><i data-lucide="clock-3"></i> Controle de janelas e prioridade</li>
                        <li><i data-lucide="headset"></i> Comunicação próxima em ocorrências</li>
                    </ul>
                </div>
            </div>
        </section>

        <section class="section-shell cf-stats">
            <div class="container">
                <div class="section-head cf-head-center reveal">
                    <p class="eyebrow cf-stats-eyebrow"><i data-lucide="sparkles"></i> Resultados de operação</p>
                    <h2>Indicadores que reforcam a eficiência da consolidação na prática.</h2>
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
                    <img src="<?php echo htmlspecialchars($images['insight'], ENT_QUOTES, 'UTF-8'); ?>" alt="Equipe acompanhando operação consolidada em centro logístico" loading="lazy" decoding="async">
                </figure>
                <div class="cf-insight-copy reveal" style="--delay: 80ms">
                    <p class="eyebrow">Leitura estratégica</p>
                    <h2>Consolidar cargas deixa de ser opcional quando a meta e escalar com eficiência.</h2>
                    <p>
                        Com métodologia operacional, sua empresa reduz desgaste interno, organiza melhor os fluxos e ganha base para crescer com menos desperdicio logístico.
                    </p>
                    <a class="btn btn-primary" href="/uppertruck/cotacao-contato/solicitar-cotacao.php">Quero estruturar minha operação</a>
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
