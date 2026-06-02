<?php
declare(strict_types=1);
require_once __DIR__ . '/components/home/path-bootstrap.php';

$metaTitle = 'Para Transportadores | Uppertruck';
$metaDescription = 'Parceria para transportadores com fretes recorrentes, suporte operacional e oportunidades de crescimento em rede nacional.';

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

function transportadoresImage(string $basename, string $fallback): string
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
    'hero' => transportadoresImage('hero-para-transportadores', '/uppertruck/img/upper4.png'),
    'ops' => transportadoresImage('painel-transportadores', '/uppertruck/img/operacoes-recorrentes.png'),
    'case' => transportadoresImage('crescimento-transportador', '/uppertruck/img/upper1.png'),
];

$impactIndicators = [
    ['value' => '+2K', 'label' => 'transportadores conectados a operações recorrentes', 'icon' => 'users'],
    ['value' => '+3.5K', 'label' => 'cidades com oportunidade de atendimento', 'icon' => 'map-pinned'],
    ['value' => '24h', 'label' => 'tempo médio de resposta operacional', 'icon' => 'clock-3'],
    ['value' => '97%', 'label' => 'viagens executadas dentro da janela planejada', 'icon' => 'target'],
];

$solutions = [
    ['number' => '01', 'title' => 'Cadastro de Parceiros', 'text' => 'Entrada estruturada para transportadores que querem operar com mais previsibilidade.', 'icon' => 'user-plus', 'href' => '/uppertruck/para-transportadores/cadastro-de-parceiros.php'],
    ['number' => '02', 'title' => 'Cadastro de Motoristas', 'text' => 'Cadastro de condutores para ampliar capacidade com organizacao e governança.', 'icon' => 'id-card', 'href' => '/uppertruck/para-transportadores/cadastro-de-motoristas.php'],
    ['number' => '03', 'title' => 'Requisitos Operacionais', 'text' => 'Clareza sobre padroes, documentacao e critérios para atuar na rede.', 'icon' => 'clipboard-check', 'href' => '/uppertruck/para-transportadores/requisitos.php'],
    ['number' => '04', 'title' => 'Visão Geral da Parceria', 'text' => 'Entenda como funciona o fluxo de parceria do início da jornada até a execução.', 'icon' => 'layout-dashboard', 'href' => '/uppertruck/para-transportadores/visao-geral.php'],
    ['number' => '05', 'title' => 'Dúvidas Frequentes', 'text' => 'Respostas objetivas para acelerar decisão e onboarding dos parceiros.', 'icon' => 'message-circle-question', 'href' => '/uppertruck/para-transportadores/duvidas-frequentes.php'],
    ['number' => '06', 'title' => 'Atendimento Especializado', 'text' => 'Canal direto para alinhar perfil, região de operação e próximos passos.', 'icon' => 'headset', 'href' => '/uppertruck/cotacao-contato/falar-com-especialista.php'],
];

$whyUppertruck = [
    ['title' => 'Demanda com método', 'text' => 'Operações com planejamento para reduzir improviso na estrada.', 'icon' => 'route'],
    ['title' => 'Suporte no dia a dia', 'text' => 'Time operacional próximo para tratativa de ocorrências.', 'icon' => 'messages-square'],
    ['title' => 'Padrão de execução', 'text' => 'Mais clareza de processo para aumentar consistência das viagens.', 'icon' => 'shield-check'],
    ['title' => 'Relacionamento contínuo', 'text' => 'Parceria para longo prazo com foco em performance e estabilidade.', 'icon' => 'handshake'],
    ['title' => 'Cobertura nacional', 'text' => 'Oportunidades em diferentes regiões para ampliar atendimento.', 'icon' => 'earth'],
    ['title' => 'Gestão com visibilidade', 'text' => 'Mais informacao para acompanhar rotas, status e resultado.', 'icon' => 'activity'],
];

$advantages = [
    ['number' => '01', 'title' => 'Menos ociosidade', 'text' => 'Melhor aproveitamento de frota com operações recorrentes.', 'icon' => 'truck'],
    ['number' => '02', 'title' => 'Mais previsibilidade', 'text' => 'Janelas e fluxo operacional com mais clareza.', 'icon' => 'calendar-check-2'],
    ['number' => '03', 'title' => 'Comunicação ativa', 'text' => 'Acompanhamento para reduzir ruido durante a jornada.', 'icon' => 'radio'],
    ['number' => '04', 'title' => 'Padrão de qualidade', 'text' => 'Processos definidos para manter consistência de atendimento.', 'icon' => 'badge-check'],
    ['number' => '05', 'title' => 'Escala com controle', 'text' => 'Crescimento operacional com governança e segurança.', 'icon' => 'expand'],
    ['number' => '06', 'title' => 'Parceria de longo prazo', 'text' => 'Relação construida para evolução contínua da operação.', 'icon' => 'line-chart'],
];

$transporterTypes = [
    ['badge' => 'Autonomo', 'title' => 'Motorista autonomo', 'text' => 'Para quem busca viagens com processo claro e suporte operacional.', 'icon' => 'user-round', 'size' => 'large'],
    ['badge' => 'Urbano', 'title' => 'Frota leve', 'text' => 'Atendimento de entregas urbanas e operações de última milha.', 'icon' => 'truck', 'size' => 'small'],
    ['badge' => 'Regional', 'title' => 'Frota media', 'text' => 'Rotas intermunicipais com recorrencia e previsibilidade.', 'icon' => 'map', 'size' => 'small'],
    ['badge' => 'Nacional', 'title' => 'Transportadoras', 'text' => 'Operações em escala com padrão de atendimento estruturado.', 'icon' => 'building-2', 'size' => 'large'],
    ['badge' => 'Especial', 'title' => 'Projetos dedicados', 'text' => 'Demandas específicas com acompanhamento do time operacional.', 'icon' => 'shield-alert', 'size' => 'small'],
    ['badge' => 'Recorrente', 'title' => 'Operações contínuas', 'text' => 'Fluxo para parceiros que querem estabilidade de atendimento.', 'icon' => 'repeat', 'size' => 'small'],
];

$caseTabs = [
    [
        'key' => 'autonomo',
        'label' => 'Autonomo',
        'headline' => 'Mais previsibilidade para quem quer rodar com método e suporte.',
        'text' => 'Motoristas autônomos podem aumentar consistência das viagens com um fluxo de parceria estruturado e comunicação ativa durante a operação.',
        'metric' => 'Jornada com orientacao operacional contínua',
    ],
    [
        'key' => 'frota',
        'label' => 'Frota',
        'headline' => 'Melhor ocupação da frota com operações recorrentes.',
        'text' => 'Frotas leves e médias podem ganhar eficiência com alocacao mais organizada, previsibilidade de janelas e tratativa rápida de ocorrências.',
        'metric' => 'Maior aproveitamento com menos ociosidade',
    ],
    [
        'key' => 'transportadora',
        'label' => 'Transportadora',
        'headline' => 'Escala com governança para transportadoras em crescimento.',
        'text' => 'Transportadoras parceiras podem expandir atendimento com padrão operacional, visibilidade de status e relacionamento de longo prazo.',
        'metric' => 'Crescimento com controle e estabilidade operacional',
    ],
];

$caseTabsJson = json_encode($caseTabs, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
if ($caseTabsJson === false) {
    $caseTabsJson = '[]';
}
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
                    <p class="pe-kicker">Para transportadores</p>
                    <h1>Parceria para transportadores que querem mais frete, previsibilidade e suporte operacional</h1>
                    <p class="pe-hero__lead">
                        A Uppertruck conecta sua operação a demandas com método, acompanhamento e relacionamento contínuo para rodar com mais consistência.
                    </p>
                    <div class="pe-hero__actions">
                        <a class="btn btn-primary" href="/uppertruck/para-transportadores/cadastro-de-parceiros.php">Quero ser parceiro</a>
                        <a class="btn pe-btn-secondary" href="/uppertruck/para-transportadores/requisitos.php">Ver requisitos</a>
                    </div>
                </div>

                <div class="pe-hero__visual reveal" style="--delay: 90ms;">
                    <figure class="pe-hero__media">
                        <img src="<?php echo htmlspecialchars($images['hero'], ENT_QUOTES, 'UTF-8'); ?>" alt="Parceria Uppertruck para transportadores em operação" loading="eager" decoding="async">
                        <div class="pe-hero__overlay" aria-hidden="true"></div>
                    </figure>
                </div>
            </div>
            <div class="container pe-hero__metrics-wrap">
                <div class="pe-impact__head reveal">
                    <p class="pe-kicker pe-kicker--dark">Rede ativa para transportadores em diferentes regiões</p>
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
                    <p class="pe-kicker pe-kicker--light">Jornada do parceiro</p>
                    <h2>Um fluxo simples para entrar na rede e operar com mais clareza</h2>
                    <p>Da validação inicial ao suporte em rota, a jornada foi estruturada para facilitar sua rotina operacional.</p>
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
                            <a href="<?php echo htmlspecialchars($solution['href'], ENT_QUOTES, 'UTF-8'); ?>" class="pe-inline-link">Acessar etapa <i data-lucide="arrow-right"></i></a>
                        </article>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <section class="pe-section pe-why">
            <div class="container pe-why__grid">
                <div class="pe-why__intro reveal">
                    <p class="pe-kicker">Por que a Uppertruck</p>
                    <h2>Mais organizacao na estrada. Menos incerteza no dia a dia.</h2>
                    <p>Transportadores precisam de operação com processo, comunicação e capacidade de resposta para manter performance.</p>
                    <p class="pe-why__quote">Parceria para quem quer rodar com mais estabilidade e evoluir com consistência.</p>
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
                    <h2>Visibilidade para apoiar transportadores em todas as etapas</h2>
                    <p>Acompanhamento operacional para que o parceiro tenha mais clareza de jornada e mais confianca na execução das viagens.</p>
                    <ul class="pe-ops-visual__list">
                        <li><i data-lucide="check-circle-2"></i> Alocacao organizada por perfil operacional</li>
                        <li><i data-lucide="check-circle-2"></i> Status de viagem e tratativa de ocorrências</li>
                        <li><i data-lucide="check-circle-2"></i> Comunicação ativa com o time da operação</li>
                        <li><i data-lucide="check-circle-2"></i> Relação contínua para crescimento da parceria</li>
                    </ul>
                </div>

                <figure class="pe-ops-visual__media reveal" style="--delay: 70ms;">
                    <img src="<?php echo htmlspecialchars($images['ops'], ENT_QUOTES, 'UTF-8'); ?>" alt="Acompanhamento operacional para transportadores parceiros" loading="lazy" decoding="async">
                    <figcaption>
                        <span>Operação Parceira</span>
                        <strong>Suporte para rodar com previsibilidade</strong>
                    </figcaption>
                </figure>
            </div>
        </section>

        <section class="pe-section pe-advantages">
            <div class="container">
                <div class="pe-head pe-head--center reveal">
                    <p class="pe-kicker pe-kicker--light">Vantagens para transportadores</p>
                    <h2>Uma parceria que ajuda sua operação a ganhar consistência</h2>
                    <p>Com processos claros e acompanhamento ativo, sua operação pode crescer com mais segurança e controle.</p>
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
                    <p class="pe-kicker">Perfis de parceria</p>
                    <h2>Modelos para diferentes perfis de transportadores e níveis de operação</h2>
                </div>
                <div class="pe-types__mosaic">
                    <?php foreach ($transporterTypes as $index => $item): ?>
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
                    <h2>A parceria se adapta ao perfil da sua operação</h2>

                    <div class="pe-cases__tabs" role="tablist" aria-label="Tipos de parceiro">
                        <?php foreach ($caseTabs as $index => $tab): ?>
                            <button type="button" class="<?php echo $index === 0 ? 'is-active' : ''; ?>" role="tab" aria-selected="<?php echo $index === 0 ? 'true' : 'false'; ?>" data-pt-case-tab="<?php echo htmlspecialchars($tab['key'], ENT_QUOTES, 'UTF-8'); ?>">
                                <?php echo htmlspecialchars($tab['label'], ENT_QUOTES, 'UTF-8'); ?>
                            </button>
                        <?php endforeach; ?>
                    </div>

                    <article class="pe-case-card" id="pt-case-card">
                        <h3 id="pt-case-headline"><?php echo htmlspecialchars($caseTabs[0]['headline'], ENT_QUOTES, 'UTF-8'); ?></h3>
                        <p id="pt-case-text"><?php echo htmlspecialchars($caseTabs[0]['text'], ENT_QUOTES, 'UTF-8'); ?></p>
                        <p class="pe-case-card__metric" id="pt-case-metric"><?php echo htmlspecialchars($caseTabs[0]['metric'], ENT_QUOTES, 'UTF-8'); ?></p>
                        <a class="btn btn-primary pe-case-card__cta" href="/uppertruck/para-transportadores/cadastro-de-parceiros.php">
                            Quero entrar para a rede
                            <i data-lucide="arrow-right"></i>
                        </a>
                    </article>
                </div>

                <figure class="pe-cases__media reveal" style="--delay: 90ms;">
                    <img src="<?php echo htmlspecialchars($images['case'], ENT_QUOTES, 'UTF-8'); ?>" alt="Transportador parceiro crescendo com operação estruturada" loading="lazy" decoding="async">
                </figure>
            </div>
        </section>
    </main>

    <?php include __DIR__ . '/components/home/footer.php'; ?>

    <script id="pt-case-data" type="application/json"><?php echo htmlspecialchars($caseTabsJson, ENT_QUOTES, 'UTF-8'); ?></script>
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.min.js"></script>
    <script src="/uppertruck/assets/js/home.js"></script>
    <script src="/uppertruck/assets/js/para-transportadores.js"></script>
</body>

</html>
