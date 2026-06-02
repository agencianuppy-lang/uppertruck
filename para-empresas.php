<?php
declare(strict_types=1);
require_once __DIR__ . '/components/home/path-bootstrap.php';

$metaTitle = 'Soluções Logísticas para Empresas | Uppertruck';
$metaDescription = 'Soluções logísticas para empresas que precisam de transporte de cargas, carga dedicada, carga fracionada, consolidação, Last Mile e operações sob medida.';

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

function empresasImage(string $basename, string $fallback): string
{
    $safeBasename = trim($basename);
    if ($safeBasename === '') {
        return $fallback;
    }

    $extensions = ['webp', 'png', 'jpg', 'jpeg'];
    foreach ($extensions as $extension) {
        $relative = '/img/ai/' . $safeBasename . '.' . $extension;
        $absolute = __DIR__ . str_replace('/', DIRECTORY_SEPARATOR, $relative);
        if (is_file($absolute)) {
            return '/uppertruck' . $relative;
        }
    }

    return $fallback;
}

$images = [
    'hero' => '/uppertruck/img/f9e298b0-74fd-440c-9055-e38e43b55fa1.png',
    'ops' => empresasImage('painel-operacional-logistico', '/uppertruck/img/upper6.png'),
    'case' => '/uppertruck/img/f80202b2-a625-44c2-92fe-f19c6c0cbf72.png',
];

$impactIndicators = [
    ['value' => '+3.5K', 'label' => 'Cidades atendidas em malha nacional', 'icon' => 'map-pinned'],
    ['value' => '24h', 'label' => 'Resposta operacional para demandas comerciais', 'icon' => 'clock-3'],
    ['value' => '100%', 'label' => 'Operações planejadas conforme necessidade', 'icon' => 'target'],
    ['value' => 'SLA', 'label' => 'Acompanhamento para rotas e entregas críticas', 'icon' => 'badge-check'],
];

$solutions = [
    ['number' => '01', 'title' => 'Carga Fracionada', 'text' => 'Para transportar volumes menores com economia, flexibilidade e acompanhamento.', 'icon' => 'package', 'href' => '/uppertruck/solucoes/carga-fracionada.php'],
    ['number' => '02', 'title' => 'Carga Dedicada', 'text' => 'Para operações recorrentes com veículo, rota e capacidade reservada.', 'icon' => 'truck', 'href' => '/uppertruck/solucoes/carga-dedicada.php'],
    ['number' => '03', 'title' => 'Consolidação de Cargas', 'text' => 'Para agrupar volumes, otimizar rotas e reduzir desperdícios logísticos.', 'icon' => 'boxes', 'href' => '/uppertruck/solucoes/consolidacao-de-cargas.php'],
    ['number' => '04', 'title' => 'Last Mile', 'text' => 'Para entregas finais com status, agilidade e previsibilidade até o destino.', 'icon' => 'navigation', 'href' => '/uppertruck/solucoes/last-mile.php'],
    ['number' => '05', 'title' => 'Operação Sob Medida', 'text' => 'Para fluxos que não cabem em modelos prontos e exigem personalização.', 'icon' => 'workflow', 'href' => '/uppertruck/solucoes/operacoes-sob-medida.php'],
    ['number' => '06', 'title' => 'Projetos Especiais', 'text' => 'Para sazonalidade, expansão e operações críticas fora do padrão.', 'icon' => 'rocket', 'href' => '/uppertruck/cotacao-contato/falar-com-especialista.php'],
];

$whyUppertruck = [
    ['title' => 'Atendimento consultivo', 'text' => 'Entendemos sua demanda antes de indicar o melhor modelo.', 'icon' => 'messages-square'],
    ['title' => 'Planejamento por operação', 'text' => 'Rotas, volumes, prazos e prioridades analisados com critério.', 'icon' => 'clipboard-list'],
    ['title' => 'Acompanhamento ativo', 'text' => 'Status, comunicação e tratativa de ocorrências durante a jornada.', 'icon' => 'activity'],
    ['title' => 'Flexibilidade operacional', 'text' => 'Modelos ajustáveis para demanda recorrente, sazonal ou especial.', 'icon' => 'sliders-horizontal'],
    ['title' => 'Controle de SLA', 'text' => 'Mais previsibilidade para operações com prazos e janelas críticas.', 'icon' => 'alarm-check'],
    ['title' => 'Escala nacional', 'text' => 'Suporte para empresas que precisam operar em diferentes regiões.', 'icon' => 'earth'],
];

$advantages = [
    ['number' => '01', 'title' => 'Redução de gargalos', 'text' => 'Operações desenhadas para diminuir atritos no transporte.', 'icon' => 'traffic-cone'],
    ['number' => '02', 'title' => 'Mais previsibilidade', 'text' => 'Rotas, prazos e janelas acompanhados com mais clareza.', 'icon' => 'calendar-check-2'],
    ['number' => '03', 'title' => 'Menos retrabalho', 'text' => 'Comunicação e status reduzem cobranças manuais e ruídos internos.', 'icon' => 'refresh-cw'],
    ['number' => '04', 'title' => 'Melhor custo operacional', 'text' => 'Modelos adequados ao volume, frequência e tipo de operação.', 'icon' => 'badge-dollar-sign'],
    ['number' => '05', 'title' => 'Escala com segurança', 'text' => 'Soluções ajustáveis para crescimento e sazonalidade.', 'icon' => 'expand'],
    ['number' => '06', 'title' => 'Decisão mais estratégica', 'text' => 'Mais informacao para planejar, ajustar e evoluir a logística.', 'icon' => 'line-chart'],
];

$companyTypes = [
    ['badge' => 'Industrial', 'title' => 'Indústrias', 'text' => 'Transporte entre fábricas, fornecedores, CDs e clientes estratégicos.', 'icon' => 'factory', 'size' => 'large'],
    ['badge' => 'Distribuição', 'title' => 'Distribuidores', 'text' => 'Rotas recorrentes, entregas regionais e múltiplos destinos.', 'icon' => 'warehouse', 'size' => 'small'],
    ['badge' => 'Varejo', 'title' => 'Varejo e redes', 'text' => 'Abastecimento de lojas, campanhas e janelas críticas.', 'icon' => 'store', 'size' => 'small'],
    ['badge' => 'Digital', 'title' => 'E-commerce', 'text' => 'Distribuição e Last Mile com foco em experiência de entrega.', 'icon' => 'shopping-cart', 'size' => 'large'],
    ['badge' => 'B2B', 'title' => 'Empresas B2B', 'text' => 'Entregas para filiais, unidades e clientes empresariais.', 'icon' => 'briefcase-business', 'size' => 'small'],
    ['badge' => 'Especial', 'title' => 'Operações especiais', 'text' => 'Demandas fora do padrão, expansão e cargas específicas.', 'icon' => 'shield-alert', 'size' => 'small'],
];

$caseTabs = [
    [
        'key' => 'industria',
        'label' => 'Indústria',
        'headline' => 'Mais controle no transporte entre fornecedores, produção e clientes estratégicos.',
        'text' => 'Operações industriais podem usar a Uppertruck para organizar rotas recorrentes, reduzir ruídos e acompanhar entregas críticas com mais previsibilidade.',
        'metric' => 'Fluxo recorrente com prioridade operacional',
    ],
    [
        'key' => 'distribuicao',
        'label' => 'Distribuição',
        'headline' => 'Rotas mais organizadas para quem entrega em múltiplos destinos.',
        'text' => 'Distribuidores ganham previsibilidade ao estruturar coletas, entregas, janelas e acompanhamento operacional em uma rotina de maior escala.',
        'metric' => 'Maior clareza no cumprimento de janela e SLA',
    ],
    [
        'key' => 'varejo',
        'label' => 'Varejo',
        'headline' => 'Abastecimento mais previsível para lojas, unidades e campanhas.',
        'text' => 'Redes varejistas podem contar com soluções para entregas programadas, Last Mile e operações sazonais em diferentes regiões.',
        'metric' => 'Abastecimento com menor risco de ruptura',
    ],
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
    <link rel="stylesheet" href="/uppertruck/assets/css/para-empresas.css">
</head>

<body class="pe-page">
    <a class="skip-link" href="#conteudo-principal">Pular para o conteúdo principal</a>

    <?php include __DIR__ . '/components/home/header.php'; ?>

    <main id="conteudo-principal">
        <section class="pe-section pe-hero pe-hero--light">
            <div class="container pe-hero__grid">
                <div class="pe-hero__content reveal">
                    <p class="pe-kicker">Para empresas</p>
                    <h1>Transporte e logística para empresas que precisam de controle, eficiência e previsibilidade</h1>
                    <p class="pe-hero__lead">
                        A Uppertruck conecta sua empresa a soluções logísticas estruturadas para cargas fracionadas, dedicadas, consolidadas, Last Mile e operações sob medida.
                    </p>
                    <div class="pe-hero__actions">
                        <a class="btn btn-primary" href="/uppertruck/cotacao-contato/solicitar-cotacao.php">Solicitar cotação</a>
                        <a class="btn pe-btn-secondary" href="/uppertruck/solucoes.php">Conhecer soluções</a>
                    </div>
                </div>

                <div class="pe-hero__visual reveal" style="--delay: 90ms;">
                    <figure class="pe-hero__media">
                        <img src="<?php echo htmlspecialchars($images['hero'], ENT_QUOTES, 'UTF-8'); ?>" alt="Operação logística empresarial da Uppertruck" loading="eager" decoding="async">
                        <div class="pe-hero__overlay" aria-hidden="true"></div>
                    </figure>
                </div>
            </div>
            <div class="container pe-hero__metrics-wrap">
                <div class="pe-impact__head reveal">
                    <p class="pe-kicker pe-kicker--dark">Logística com mais previsibilidade para sua operação</p>
                </div>
                <div class="pe-impact__grid pe-impact__grid--hero">
                    <?php foreach ($impactIndicators as $index => $item): ?>
                        <article class="pe-impact__card reveal" style="--delay: <?php echo htmlspecialchars((string) ($index * 60), ENT_QUOTES, 'UTF-8'); ?>ms;">
                            <span class="pe-impact__icon"><i data-lucide="<?php echo htmlspecialchars($item['icon'], ENT_QUOTES, 'UTF-8'); ?>"></i></span>
                            <p class="pe-impact__value"><?php echo htmlspecialchars($item['value'], ENT_QUOTES, 'UTF-8'); ?></p>
                            <p class="pe-impact__label"><?php echo htmlspecialchars($item['label'], ENT_QUOTES, 'UTF-8'); ?></p>
                        </article>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <section class="pe-section pe-solutions">
            <div class="container">
                <div class="pe-head pe-head--center reveal">
                    <p class="pe-kicker pe-kicker--light">Soluções logísticas</p>
                    <h2>Uma estrutura logística para diferentes desafios da sua empresa</h2>
                    <p>Da coleta a entrega final, a Uppertruck desenha soluções para tornar sua operação mais organizada, previsível e eficiente.</p>
                </div>
                <div class="pe-solutions__grid">
                    <?php foreach ($solutions as $index => $solution): ?>
                        <article class="pe-solution-card reveal" style="--delay: <?php echo htmlspecialchars((string) (40 + ($index * 40)), ENT_QUOTES, 'UTF-8'); ?>ms;">
                            <div class="pe-solution-card__head">
                                <span class="pe-solution-card__number"><?php echo htmlspecialchars($solution['number'], ENT_QUOTES, 'UTF-8'); ?></span>
                                <i data-lucide="<?php echo htmlspecialchars($solution['icon'], ENT_QUOTES, 'UTF-8'); ?>"></i>
                            </div>
                            <h3><?php echo htmlspecialchars($solution['title'], ENT_QUOTES, 'UTF-8'); ?></h3>
                            <p><?php echo htmlspecialchars($solution['text'], ENT_QUOTES, 'UTF-8'); ?></p>
                            <a href="<?php echo htmlspecialchars($solution['href'], ENT_QUOTES, 'UTF-8'); ?>" class="pe-inline-link">Conhecer solução <i data-lucide="arrow-right"></i></a>
                        </article>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <section class="pe-section pe-why">
            <div class="container pe-why__grid">
                <div class="pe-why__intro reveal">
                    <p class="pe-kicker">Por que a Uppertruck</p>
                    <h2>Menos ruido operacional. Mais controle para sua logística.</h2>
                    <p>Empresas que dependem de transporte precisam de mais do que frete. Precisam de planejamento, acompanhamento, comunicação e capacidade de resposta.</p>
                    <p class="pe-why__quote">Logística para empresas que precisam sair do improviso e operar com mais controle.</p>
                </div>
                <div class="pe-why__cards">
                    <?php foreach ($whyUppertruck as $index => $item): ?>
                        <article class="pe-why-card reveal" style="--delay: <?php echo htmlspecialchars((string) (($index + 1) * 40), ENT_QUOTES, 'UTF-8'); ?>ms;">
                            <i data-lucide="<?php echo htmlspecialchars($item['icon'], ENT_QUOTES, 'UTF-8'); ?>"></i>
                            <h3><?php echo htmlspecialchars($item['title'], ENT_QUOTES, 'UTF-8'); ?></h3>
                            <p><?php echo htmlspecialchars($item['text'], ENT_QUOTES, 'UTF-8'); ?></p>
                        </article>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <section class="pe-section pe-ops-visual">
            <div class="container pe-ops-visual__grid">
                <div class="pe-ops-visual__content reveal">
                    <p class="pe-kicker pe-kicker--light">Gestão operacional</p>
                    <h2>Acompanhe sua operação com mais clareza em cada etapa</h2>
                    <p>A Uppertruck estrutura a comunicação operacional para que sua empresa tenha mais visibilidade sobre coletas, rotas, entregas, ocorrências e status críticos.</p>
                    <ul class="pe-ops-visual__list">
                        <li><i data-lucide="check-circle-2"></i> Status de coleta e entrega</li>
                        <li><i data-lucide="check-circle-2"></i> Rotas e janelas planejadas</li>
                        <li><i data-lucide="check-circle-2"></i> Ocorrências em tratativa</li>
                        <li><i data-lucide="check-circle-2"></i> SLA em acompanhamento</li>
                    </ul>
                </div>

                <figure class="pe-ops-visual__media reveal" style="--delay: 70ms;">
                    <img src="<?php echo htmlspecialchars($images['ops'], ENT_QUOTES, 'UTF-8'); ?>" alt="Painel visual de gestão operacional logística da Uppertruck" loading="lazy" decoding="async">
                    <figcaption>
                        <span>Painel Logístico</span>
                        <strong>Visibilidade em cada etapa</strong>
                    </figcaption>
                </figure>
            </div>
        </section>

        <section class="pe-section pe-advantages">
            <div class="container">
                <div class="pe-head pe-head--center reveal">
                    <p class="pe-kicker pe-kicker--light">Vantagens para empresas</p>
                    <h2>Simplifique sua gestão logística sem perder controle</h2>
                    <p>Com a Uppertruck, sua empresa ganha uma operação mais organizada, menos dependente de improvisos e mais preparada para crescer.</p>
                </div>
                <div class="pe-advantages__grid">
                    <?php foreach ($advantages as $index => $item): ?>
                        <article class="pe-adv-card reveal" style="--delay: <?php echo htmlspecialchars((string) ($index * 40), ENT_QUOTES, 'UTF-8'); ?>ms;">
                            <span class="pe-adv-card__number"><?php echo htmlspecialchars($item['number'], ENT_QUOTES, 'UTF-8'); ?></span>
                            <i data-lucide="<?php echo htmlspecialchars($item['icon'], ENT_QUOTES, 'UTF-8'); ?>"></i>
                            <h3><?php echo htmlspecialchars($item['title'], ENT_QUOTES, 'UTF-8'); ?></h3>
                            <p><?php echo htmlspecialchars($item['text'], ENT_QUOTES, 'UTF-8'); ?></p>
                        </article>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <section class="pe-section pe-types">
            <div class="container">
                <div class="pe-head reveal">
                    <p class="pe-kicker">Para diferentes operações</p>
                    <h2>Soluções para empresas que dependem de logística para vender, abastecer ou entregar</h2>
                </div>
                <div class="pe-types__mosaic">
                    <?php foreach ($companyTypes as $index => $item): ?>
                        <article class="pe-type-card pe-type-card--<?php echo htmlspecialchars($item['size'], ENT_QUOTES, 'UTF-8'); ?> reveal" style="--delay: <?php echo htmlspecialchars((string) (40 + ($index * 35)), ENT_QUOTES, 'UTF-8'); ?>ms;">
                            <span class="pe-type-card__badge"><?php echo htmlspecialchars($item['badge'], ENT_QUOTES, 'UTF-8'); ?></span>
                            <i data-lucide="<?php echo htmlspecialchars($item['icon'], ENT_QUOTES, 'UTF-8'); ?>"></i>
                            <h3><?php echo htmlspecialchars($item['title'], ENT_QUOTES, 'UTF-8'); ?></h3>
                            <p><?php echo htmlspecialchars($item['text'], ENT_QUOTES, 'UTF-8'); ?></p>
                        </article>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <section class="pe-section pe-cases">
            <div class="container pe-cases__grid">
                <div class="pe-cases__content reveal">
                    <p class="pe-kicker pe-kicker--light">Aplicacoes práticas</p>
                    <h2>Empresas que organizam melhor a logística ganham previsibilidade para crescer</h2>

                    <div class="pe-cases__tabs" role="tablist" aria-label="Tipos de operação">
                        <?php foreach ($caseTabs as $index => $tab): ?>
                            <button type="button" class="<?php echo $index === 0 ? 'is-active' : ''; ?>" role="tab" aria-selected="<?php echo $index === 0 ? 'true' : 'false'; ?>" data-pe-case-tab="<?php echo htmlspecialchars($tab['key'], ENT_QUOTES, 'UTF-8'); ?>">
                                <?php echo htmlspecialchars($tab['label'], ENT_QUOTES, 'UTF-8'); ?>
                            </button>
                        <?php endforeach; ?>
                    </div>

                    <article class="pe-case-card" id="pe-case-card">
                        <h3 id="pe-case-headline"><?php echo htmlspecialchars($caseTabs[0]['headline'], ENT_QUOTES, 'UTF-8'); ?></h3>
                        <p id="pe-case-text"><?php echo htmlspecialchars($caseTabs[0]['text'], ENT_QUOTES, 'UTF-8'); ?></p>
                        <p class="pe-case-card__metric" id="pe-case-metric"><?php echo htmlspecialchars($caseTabs[0]['metric'], ENT_QUOTES, 'UTF-8'); ?></p>
                        <a class="btn btn-primary pe-case-card__cta" href="/uppertruck/cotacao-contato/falar-com-especialista.php">
                            Falar com especialista
                            <i data-lucide="arrow-right"></i>
                        </a>
                    </article>
                </div>

                <figure class="pe-cases__media reveal" style="--delay: 90ms;">
                    <img src="<?php echo htmlspecialchars($images['case'], ENT_QUOTES, 'UTF-8'); ?>" alt="Operação logística empresarial com controle de distribuição" loading="lazy" decoding="async">
                </figure>
            </div>
        </section>

    </main>

    <?php include __DIR__ . '/components/home/footer.php'; ?>

    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.min.js"></script>
    <script src="/uppertruck/assets/js/home.js"></script>
    <script src="/uppertruck/assets/js/para-empresas.js"></script>
</body>

</html>
