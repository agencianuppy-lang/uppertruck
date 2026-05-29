<?php
declare(strict_types=1);


require_once dirname(__DIR__) . '/components/home/path-bootstrap.php';
$metaTitle = 'Carga Dedicada | Transporte Exclusivo para Empresas | Uppertruck';
$metaDescription = 'Carga dedicada para empresas que precisam de transporte exclusivo, rotas recorrentes, capacidade reservada, SLA monitorado e maior previsibilidade operacional.';
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

function dedicatedImage(string $basename, string $fallback): string
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
    'hero' => dedicatedImage('hero-carga-dedicada', '/uppertruck/img/upper5.png'),
    'diagnostic' => dedicatedImage('planejamento-rotas-recorrentes', '/uppertruck/img/ilus-1.png'),
    'comparison' => dedicatedImage('frota-propria-vs-carga-dedicada', '/uppertruck/img/2151994456.jpg'),
    'timeline' => dedicatedImage('operacao-dedicada-monitorada', '/uppertruck/img/consolidacao-de-cargas-2.jpg'),
    'pain' => dedicatedImage('controle-operacional-logistica-b2b', '/uppertruck/img/upper5.png'),
    'insight' => dedicatedImage('painel-visibilidade-carga-dedicada', '/uppertruck/img/ilus-2.png'),
];

$heroFloatingCards = [
    ['title' => 'Capacidade reservada', 'text' => 'Veiculo e operacao planejados conforme sua demanda.'],
    ['title' => 'Rota com prioridade', 'text' => 'Menos desvios, menos paradas e maior previsibilidade.'],
    ['title' => 'Gestao proxima', 'text' => 'Acompanhamento ativo antes, durante e depois da entrega.'],
];

$heroSignals = [
    ['icon' => 'clock-3', 'label' => '24h resposta operacional'],
    ['icon' => 'badge-check', 'label' => '100% planejamento por demanda'],
    ['icon' => 'activity', 'label' => 'SLA monitorado em rota'],
];

$dedicatedShowcaseSlides = [
    [
        'image' => $images['hero'],
        'alt' => 'Caminhao dedicado em operacao de rota planejada',
        'subtitle' => 'Capacidade reservada para sua demanda',
        'text' => 'A Carga Dedicada permite estruturar veiculos e recursos conforme a rotina da sua empresa, reduzindo a dependencia de disponibilidade em cima da hora e trazendo mais previsibilidade para rotas recorrentes.',
        'ctaLabel' => 'Solicitar operacao dedicada',
        'ctaHref' => '/uppertruck/cotacao-contato/solicitar-cotacao.php',
    ],
    [
        'image' => $images['comparison'],
        'alt' => 'Operacao dedicada com carregamento planejado em doca',
        'subtitle' => 'Rotas planejadas, menos improviso',
        'text' => 'A operacao e desenhada considerando origem, destino, frequencia, volume, janela de coleta e criticidade da entrega. Assim, sua empresa ganha uma rotina logistica mais estavel e menos vulneravel a falhas operacionais.',
        'ctaLabel' => 'Falar com especialista',
        'ctaHref' => '/uppertruck/cotacao-contato/falar-com-especialista.php',
    ],
    [
        'image' => $images['timeline'],
        'alt' => 'Equipe acompanhando indicadores de operacao dedicada',
        'subtitle' => 'Acompanhamento proximo do inicio ao fim',
        'text' => 'Com gestao ativa da operacao, comunicacao de status e leitura de performance, a Uppertruck ajuda sua empresa a manter mais controle sobre prazos, SLA, ocorrencias e continuidade logistica.',
        'ctaLabel' => 'Entender a solucao',
        'ctaHref' => '/uppertruck/solucoes/carga-dedicada.php',
    ],
];

$diagnosticQuestions = [
    'Sua empresa possui rotas recorrentes?',
    'Voce precisa reservar capacidade com antecedencia?',
    'O atraso de uma entrega compromete producao ou atendimento?',
    'A carga exige cuidado, prioridade ou menor manuseio?',
    'Voce quer reduzir dependencia de fretes spot?',
    'Sua operacao precisa de SLA, janela e acompanhamento proximo?',
];

$comparisonRows = [
    [
        'aspect' => 'Investimento inicial',
        'ownFleet' => 'Exige compra, locacao ou imobilizacao de capital.',
        'dedicated' => 'Operacao estruturada sem necessidade de frota propria.',
    ],
    [
        'aspect' => 'Contratacao de motoristas',
        'ownFleet' => 'Cliente precisa recrutar, treinar e gerir equipe.',
        'dedicated' => 'Equipe e parceiros alinhados a sua demanda.',
    ],
    [
        'aspect' => 'Manutencao e disponibilidade',
        'ownFleet' => 'Indisponibilidade pode afetar diretamente a rotina.',
        'dedicated' => 'Planejamento para reduzir rupturas e manter continuidade.',
    ],
    [
        'aspect' => 'Escala e substituicao',
        'ownFleet' => 'Gestao interna de folgas, cobertura e contingencia.',
        'dedicated' => 'Operacao coordenada com plano de cobertura.',
    ],
    [
        'aspect' => 'Monitoramento operacional',
        'ownFleet' => 'Depende de sistema e processo interno maduro.',
        'dedicated' => 'Acompanhamento ativo com comunicacao operacional.',
    ],
    [
        'aspect' => 'Flexibilidade de demanda',
        'ownFleet' => 'Mudancas exigem ajustes internos mais lentos.',
        'dedicated' => 'Modelo ajustavel por periodo, rota e criticidade.',
    ],
    [
        'aspect' => 'Gestao de SLA',
        'ownFleet' => 'Controle depende da disciplina operacional interna.',
        'dedicated' => 'Janela, prioridade e SLA acompanhados continuamente.',
    ],
    [
        'aspect' => 'Responsabilidade operacional',
        'ownFleet' => 'Toda complexidade fica com a empresa.',
        'dedicated' => 'Uppertruck estrutura e conduz a rotina de transporte.',
    ],
];

$operationModels = [
    [
        'badge' => 'Recorrencia',
        'title' => 'Rota Fixa Recorrente',
        'description' => 'Para empresas com coletas e entregas frequentes entre pontos definidos, como industria para CD, CD para filial ou fornecedor para planta.',
        'bestFor' => 'Melhor indicado para operacoes com fluxo semanal estavel.',
        'icon' => 'route',
    ],
    [
        'badge' => 'Capacidade',
        'title' => 'Veiculo Exclusivo por Periodo',
        'description' => 'Quando a operacao precisa de disponibilidade dedicada por dia, semana, campanha ou contrato com reforco de distribuicao.',
        'bestFor' => 'Melhor indicado para sazonalidade e expansao temporaria.',
        'icon' => 'truck',
    ],
    [
        'badge' => 'SLA',
        'title' => 'Operacao com Janela Critica',
        'description' => 'Entregas que precisam acontecer dentro de horarios especificos para abastecimento de loja, linha de producao e cliente estrategico.',
        'bestFor' => 'Melhor indicado para embarques com horario de recebimento definido.',
        'icon' => 'timer',
    ],
    [
        'badge' => 'Projeto',
        'title' => 'Projeto Especial Dedicado',
        'description' => 'Cargas sensiveis, rotas fora do padrao, maquinas, equipamentos e materiais de alto valor com planejamento sob medida.',
        'bestFor' => 'Melhor indicado para demandas fora da rotina padrao.',
        'icon' => 'settings-2',
    ],
];

$timelinePhases = [
    [
        'title' => 'Mapeamento da demanda',
        'description' => 'Entendimento de origem, destino, frequencia, volume, tipo de carga e criticidade operacional.',
        'icon' => 'search',
    ],
    [
        'title' => 'Desenho da solucao',
        'description' => 'Definicao do modelo dedicado: rota fixa, veiculo reservado, janela critica ou projeto especial.',
        'icon' => 'drafting-compass',
    ],
    [
        'title' => 'Planejamento de recursos',
        'description' => 'Alocacao de veiculo, perfil operacional, parceiros, horarios e plano de contingencia.',
        'icon' => 'layers-3',
    ],
    [
        'title' => 'Operacao monitorada',
        'description' => 'Acompanhamento ativo da carga, status de rota e tratativa rapida de ocorrencias.',
        'icon' => 'radar',
    ],
    [
        'title' => 'Leitura de performance',
        'description' => 'Avaliacao de SLA, pontualidade, ocorrencias e oportunidades de melhoria continua.',
        'icon' => 'line-chart',
    ],
];

$painReducers = [
    [
        'title' => 'Menos atraso por indisponibilidade',
        'description' => 'Capacidade planejada reduz dependencia de encontrar veiculo em cima da hora.',
        'icon' => 'clock',
    ],
    [
        'title' => 'Menos risco de avaria',
        'description' => 'Rotas mais diretas e menor manuseio ajudam a proteger a integridade da carga.',
        'icon' => 'shield-check',
    ],
    [
        'title' => 'Menos retrabalho interno',
        'description' => 'Sua equipe deixa de apagar incendio e ganha foco em performance operacional.',
        'icon' => 'refresh-cw',
    ],
    [
        'title' => 'Menos variacao de custo',
        'description' => 'Rotas recorrentes trazem previsibilidade e reduzem oscilacoes de frete spot.',
        'icon' => 'badge-dollar-sign',
    ],
    [
        'title' => 'Menos ruido de comunicacao',
        'description' => 'Acompanhamento proximo evita perda de informacao entre coleta, transito e entrega.',
        'icon' => 'messages-square',
    ],
    [
        'title' => 'Menos ruptura operacional',
        'description' => 'Planejamento dedicado reduz falhas que impactam producao, estoque e atendimento.',
        'icon' => 'siren',
    ],
];

$segmentCards = [
    [
        'title' => 'Industrias',
        'description' => 'Abastecimento de plantas, transferencia entre unidades e envios recorrentes para CDs.',
        'icon' => 'factory',
        'class' => 'dedicated-app-card-1',
    ],
    [
        'title' => 'Distribuidores',
        'description' => 'Rotas frequentes, entregas programadas e atendimento regional com controle de prazo.',
        'icon' => 'boxes',
        'class' => 'dedicated-app-card-2',
    ],
    [
        'title' => 'Varejo e redes',
        'description' => 'Abastecimento de lojas, campanhas sazonais e janelas de entrega definidas.',
        'icon' => 'store',
        'class' => 'dedicated-app-card-3',
    ],
    [
        'title' => 'Operacoes B2B criticas',
        'description' => 'Clientes estrategicos, materiais sensiveis e rotas com prioridade operacional.',
        'icon' => 'briefcase-business',
        'class' => 'dedicated-app-card-4',
    ],
    [
        'title' => 'Maquinas e equipamentos',
        'description' => 'Transporte planejado com menor manuseio e rota mais controlada.',
        'icon' => 'wrench',
        'class' => 'dedicated-app-card-5',
    ],
    [
        'title' => 'Projetos especiais',
        'description' => 'Expansao de operacao, reforco logistico em picos e demandas temporarias.',
        'icon' => 'rocket',
        'class' => 'dedicated-app-card-6',
    ],
];

$resultCards = [
    [
        'label' => 'Resposta operacional',
        'value' => 24,
        'suffix' => 'h',
        'description' => 'Retorno rapido para iniciar o desenho da operacao dedicada.',
    ],
    [
        'label' => 'Planejamento por demanda',
        'value' => 100,
        'suffix' => '%',
        'description' => 'Rotas e recursos estruturados conforme frequencia e criticidade.',
    ],
    [
        'label' => 'SLA monitorado',
        'value' => 100,
        'suffix' => '%',
        'description' => 'Acompanhamento de janela, prioridade e status durante a execucao.',
    ],
    [
        'label' => 'Capacidade reservada',
        'value' => 1,
        'prefix' => '1:',
        'suffix' => '',
        'description' => 'Operacao dedicada para quem nao pode depender do improviso.',
    ],
];

$ctaChecklist = [
    'Origem e destino',
    'Frequencia de embarque',
    'Tipo de carga',
    'Volume medio',
    'Janela de coleta e entrega',
    'Pontos criticos da operacao',
];

$faqItems = [
    [
        'question' => 'O que e Carga Dedicada?',
        'answer' => 'Carga Dedicada e uma solucao em que a operacao de transporte e planejada conforme a demanda da empresa, com veiculo, rota, frequencia e acompanhamento definidos para atender uma necessidade especifica. E indicada para operacoes que precisam de mais controle, previsibilidade e prioridade.',
    ],
    [
        'question' => 'Qual a diferenca entre Carga Dedicada e Carga Fracionada?',
        'answer' => 'Na Carga Fracionada, diferentes embarques podem compartilhar a mesma operacao para otimizar espaco e custo. Na Carga Dedicada, a estrutura e desenhada para uma demanda especifica, com maior controle sobre rota, janela, capacidade e acompanhamento operacional.',
    ],
    [
        'question' => 'Quando vale a pena contratar Carga Dedicada?',
        'answer' => 'A Carga Dedicada faz sentido quando sua empresa possui rotas recorrentes, alto volume, prazos criticos, janelas definidas ou quando atrasos e indisponibilidade de transporte afetam producao, estoque, abastecimento ou atendimento ao cliente.',
    ],
    [
        'question' => 'Preciso ter uma frota propria para usar Carga Dedicada?',
        'answer' => 'Nao. A proposta da Carga Dedicada e justamente oferecer uma operacao planejada sem que sua empresa precise assumir toda a complexidade de comprar veiculos, contratar motoristas, cuidar de manutencao, escala e gestao de disponibilidade.',
    ],
    [
        'question' => 'A operacao pode ser personalizada para minha empresa?',
        'answer' => 'Sim. A Uppertruck pode estruturar a operacao conforme origem, destino, frequencia, volume, tipo de carga, janela de coleta e entrega, criticidade da operacao e necessidade de acompanhamento.',
    ],
    [
        'question' => 'A Carga Dedicada ajuda no cumprimento de SLA?',
        'answer' => 'Sim. Como a operacao e planejada com foco em rotina, prioridade e acompanhamento, a Carga Dedicada ajuda a trazer mais previsibilidade e controle para empresas que precisam cumprir prazos e manter indicadores logisticos mais estaveis.',
    ],
    [
        'question' => 'Como solicitar uma analise de Carga Dedicada?',
        'answer' => 'Voce pode solicitar uma analise com a equipe da Uppertruck. A partir das informacoes sobre rota, volume, frequencia, tipo de carga e janela de atendimento, e possivel desenhar uma solucao mais adequada para sua operacao.',
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
    <link rel="stylesheet" href="/uppertruck/assets/css/carga-dedicada.css">
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.4/dist/aos.css">
</head>

<body class="dedicated-page">
    <a class="skip-link" href="#conteudo-principal">Pular para o conteudo principal</a>

    <?php include __DIR__ . '/../components/home/header.php'; ?>

    <main id="conteudo-principal">
        <section class="dedicated-section dedicated-hero">
            <div class="dedicated-hero__container">
                <div class="dedicated-hero__grid">
                    <div class="dedicated-hero__content reveal" data-aos="fade-up">
                        <p class="dedicated-kicker dedicated-hero__eyebrow">Solucao Uppertruck</p>
                        <h1 class="dedicated-hero__title">
                            Carga Dedicada para operacoes que exigem
                            <span>controle, previsibilidade e prioridade.</span>
                        </h1>
                        <p class="dedicated-hero__text">
                            Estruturamos veiculos, rotas e acompanhamento operacional para empresas que precisam de uma solucao exclusiva, recorrente e alinhada ao ritmo da propria operacao.
                        </p>
                        <div class="dedicated-hero__actions">
                            <a class="dedicated-btn dedicated-btn-primary" href="/uppertruck/cotacao-contato/solicitar-cotacao.php">
                                Solicitar operacao dedicada
                                <i data-lucide="arrow-right"></i>
                            </a>
                            <a class="dedicated-btn dedicated-btn-secondary" href="/uppertruck/cotacao-contato/falar-com-especialista.php">
                                Falar com especialista
                            </a>
                        </div>
                        <ul class="dedicated-hero__chips">
                            <?php foreach ($heroSignals as $signal): ?>
                                <li class="dedicated-hero__chip">
                                    <i data-lucide="<?php echo htmlspecialchars($signal['icon'], ENT_QUOTES, 'UTF-8'); ?>"></i>
                                    <?php echo htmlspecialchars($signal['label'], ENT_QUOTES, 'UTF-8'); ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>

                    <div class="dedicated-hero-visual reveal" data-aos="fade-left" data-aos-delay="120">
                        <div class="dedicated-hero-stage">
                            <figure class="dedicated-hero-media">
                                <img src="<?php echo htmlspecialchars($images['hero'], ENT_QUOTES, 'UTF-8'); ?>" alt="Operacao de carga dedicada em andamento" loading="eager" decoding="async">
                                <div class="dedicated-media-overlay" aria-hidden="true"></div>
                            </figure>

                            <aside class="dedicated-status-card dedicated-hero__floating-card--top" aria-label="Painel operacional">
                                <div class="dedicated-status-head">
                                    <p class="dedicated-status-title">Painel operacional</p>
                                </div>
                                <ul>
                                    <li><i data-lucide="truck"></i> Veiculo alocado</li>
                                    <li><i data-lucide="route"></i> Rota dedicada ativa</li>
                                    <li><i data-lucide="target"></i> SLA monitorado</li>
                                    <li><i data-lucide="calendar-check-2"></i> Janela prevista</li>
                                </ul>
                            </aside>
                        </div>

                        <div class="dedicated-hero-badges dedicated-hero__floating-stack" aria-label="Diferenciais da operacao dedicada">
                            <?php foreach ($heroFloatingCards as $index => $card): ?>
                                <div class="dedicated-badge reveal" style="--delay: <?php echo htmlspecialchars((string) (110 + ($index * 70)), ENT_QUOTES, 'UTF-8'); ?>ms;" data-aos="fade-up" data-aos-delay="<?php echo htmlspecialchars((string) (140 + ($index * 80)), ENT_QUOTES, 'UTF-8'); ?>">
                                    <i data-lucide="sparkles"></i>
                                    <span><strong><?php echo htmlspecialchars($card['title'], ENT_QUOTES, 'UTF-8'); ?>:</strong> <?php echo htmlspecialchars($card['text'], ENT_QUOTES, 'UTF-8'); ?></span>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="dedicated-section dedicated-predictability">
            <div class="container dedicated-predictability__grid">
                <figure class="dedicated-predictability__media reveal" data-aos="fade-right">
                    <span class="dedicated-predictability__media-depth" aria-hidden="true"></span>
                    <img src="<?php echo htmlspecialchars($images['comparison'], ENT_QUOTES, 'UTF-8'); ?>" alt="Operacao dedicada com planejamento logistico e controle de transporte" loading="lazy" decoding="async">
                </figure>

                <div class="dedicated-predictability__content reveal" data-aos="fade-left" data-aos-delay="90">
                    <p class="dedicated-kicker">Operacao dedicada para empresas que precisam de previsibilidade</p>
                    <h2>Mais controle para a sua logistica, sem depender do improviso</h2>
                    <p>
                        A Carga Dedicada da Uppertruck e ideal para empresas que precisam de capacidade reservada, rotas recorrentes e acompanhamento proximo da operacao. Com uma estrutura planejada, sua empresa ganha mais previsibilidade no transporte, mais estabilidade para cumprir prazos e mais seguranca para sustentar a rotina logistica com menos ruido operacional.
                    </p>
                    <p>
                        Em vez de depender de solucoes pontuais, sua operacao passa a contar com uma dinamica dedicada, desenhada conforme frequencia, volume, criticidade e janela de atendimento.
                    </p>
                    <div class="dedicated-predictability__actions">
                        <a class="dedicated-btn dedicated-btn-primary" href="/uppertruck/cotacao-contato/solicitar-cotacao.php">
                            Solicitar operacao dedicada
                            <i data-lucide="arrow-right"></i>
                        </a>
                        <a class="dedicated-btn dedicated-btn-secondary" href="/uppertruck/cotacao-contato/falar-com-especialista.php">
                            Falar com especialista
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <section class="dedicated-section dedicated-tabbed-solution">
            <div class="container dedicated-tabbed-solution__grid">
                <figure class="dedicated-tabbed-solution__media reveal" data-aos="fade-right">
                    <img src="<?php echo htmlspecialchars($images['comparison'], ENT_QUOTES, 'UTF-8'); ?>" alt="Operacao de carga dedicada com planejamento logistico e controle de rota" loading="lazy" decoding="async">
                </figure>

                <div class="dedicated-tabbed-solution__content reveal" data-aos="fade-left" data-aos-delay="90">
                    <p class="dedicated-kicker">Solucao exclusiva para operacoes criticas</p>
                    <h2>Carga Dedicada com mais controle para a rotina da sua operacao</h2>

                    <div class="dedicated-tabbed-nav" role="tablist" aria-label="Conteudo sobre carga dedicada">
                        <button type="button" class="is-active" role="tab" aria-selected="true" data-dedicated-tab-button="sobre">Sobre a solucao</button>
                        <button type="button" role="tab" aria-selected="false" data-dedicated-tab-button="operamos">Como operamos</button>
                        <button type="button" role="tab" aria-selected="false" data-dedicated-tab-button="vantagens">Vantagens para sua empresa</button>
                    </div>

                    <div class="dedicated-tabbed-panels">
                        <article class="dedicated-tabbed-panel is-active" data-dedicated-tab-panel="sobre">
                            <p>A carga dedicada e ideal para empresas que precisam de capacidade reservada, prioridade de coleta e entrega e menor variacao na rotina logistica. Nesse modelo, o transporte e planejado para a sua demanda, com mais previsibilidade e controle operacional.</p>
                            <p>E uma solucao estrategica para operacoes recorrentes, janelas criticas e fluxos em que atraso impacta producao, abastecimento ou atendimento.</p>
                            <div class="dedicated-tabbed-actions">
                                <a class="dedicated-btn dedicated-btn-primary" href="/uppertruck/cotacao-contato/solicitar-cotacao.php">Solicitar cotacao</a>
                                <a class="dedicated-btn dedicated-btn-secondary" href="/uppertruck/cotacao-contato/falar-com-especialista.php">Falar com especialista</a>
                            </div>
                        </article>

                        <article class="dedicated-tabbed-panel" data-dedicated-tab-panel="operamos" hidden>
                            <p>Na Uppertruck, a operacao dedicada comeca com diagnostico de rota, frequencia, janela e criticidade. Em seguida, estruturamos veiculo, equipe e plano de contingencia para manter continuidade e nivel de servico ao longo de toda a jornada.</p>
                            <p>O objetivo e transformar uma operacao suscetivel a urgencias em uma rotina com governanca, comunicacao ativa e execucao consistente.</p>
                            <div class="dedicated-tabbed-actions">
                                <a class="dedicated-btn dedicated-btn-secondary" href="/uppertruck/cotacao-contato/falar-com-especialista.php">Entender a operacao</a>
                                <a class="dedicated-btn dedicated-btn-primary" href="/uppertruck/cotacao-contato/solicitar-cotacao.php">Solicitar cotacao</a>
                            </div>
                        </article>

                        <article class="dedicated-tabbed-panel" data-dedicated-tab-panel="vantagens" hidden>
                            <p>Com a carga dedicada, sua empresa reduz dependencia de frete spot, ganha previsibilidade para cumprir SLA e melhora o controle de ponta a ponta sobre embarques estrategicos. E uma alternativa eficiente para crescer sem absorver toda a complexidade de uma frota propria.</p>
                            <p>Entre os principais ganhos estao mais estabilidade operacional, resposta rapida a desvios e melhor alinhamento entre transporte e estrategia do negocio.</p>
                            <ul class="dedicated-tabbed-benefits">
                                <li>Capacidade reservada para rotas recorrentes</li>
                                <li>Mais consistencia no cumprimento de SLA</li>
                                <li>Maior controle com acompanhamento ativo</li>
                            </ul>
                            <div class="dedicated-tabbed-actions">
                                <a class="dedicated-btn dedicated-btn-primary" href="/uppertruck/cotacao-contato/solicitar-cotacao.php">Solicitar cotacao</a>
                                <a class="dedicated-btn dedicated-btn-secondary" href="/uppertruck/cotacao-contato/falar-com-especialista.php">Falar com especialista</a>
                            </div>
                        </article>
                    </div>
                </div>
            </div>
        </section>


        <section class="dedicated-section dedicated-showcase">
            <div class="container dedicated-showcase__grid">
                <div class="dedicated-showcase__left reveal" data-aos="fade-right">
                    <div class="dedicated-showcase__media-stack">
                        <span class="dedicated-showcase__media-depth" aria-hidden="true"></span>
                        <?php foreach ($dedicatedShowcaseSlides as $index => $slide): ?>
                            <figure class="dedicated-showcase__media <?php echo $index === 0 ? 'is-active' : ''; ?>" data-showcase-media="<?php echo htmlspecialchars((string) $index, ENT_QUOTES, 'UTF-8'); ?>" <?php echo $index === 0 ? '' : 'hidden'; ?>>
                                <img src="<?php echo htmlspecialchars($slide['image'], ENT_QUOTES, 'UTF-8'); ?>" alt="<?php echo htmlspecialchars($slide['alt'], ENT_QUOTES, 'UTF-8'); ?>" loading="lazy" decoding="async">
                            </figure>
                        <?php endforeach; ?>
                    </div>

                    <div class="dedicated-showcase__controls" aria-label="Navegacao dos diferenciais">
                        <span class="dedicated-showcase__counter" data-showcase-counter>1/<?php echo htmlspecialchars((string) count($dedicatedShowcaseSlides), ENT_QUOTES, 'UTF-8'); ?></span>
                        <div class="dedicated-showcase__arrows">
                            <button type="button" class="dedicated-showcase__arrow" data-showcase-prev aria-label="Slide anterior">
                                <i data-lucide="arrow-left"></i>
                            </button>
                            <button type="button" class="dedicated-showcase__arrow" data-showcase-next aria-label="Proximo slide">
                                <i data-lucide="arrow-right"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="dedicated-showcase__right reveal" data-aos="fade-left" data-aos-delay="90">
                    <p class="dedicated-kicker">Por que a Uppertruck</p>
                    <h2>Carga Dedicada para operacoes que precisam de controle real</h2>

                    <div class="dedicated-showcase__content-wrap">
                        <?php foreach ($dedicatedShowcaseSlides as $index => $slide): ?>
                            <article class="dedicated-showcase__content <?php echo $index === 0 ? 'is-active' : ''; ?>" data-showcase-content="<?php echo htmlspecialchars((string) $index, ENT_QUOTES, 'UTF-8'); ?>" <?php echo $index === 0 ? '' : 'hidden'; ?>>
                                <h3><?php echo htmlspecialchars($slide['subtitle'], ENT_QUOTES, 'UTF-8'); ?></h3>
                                <p><?php echo htmlspecialchars($slide['text'], ENT_QUOTES, 'UTF-8'); ?></p>
                                <a class="dedicated-btn dedicated-btn-primary" href="<?php echo htmlspecialchars($slide['ctaHref'], ENT_QUOTES, 'UTF-8'); ?>">
                                    <?php echo htmlspecialchars($slide['ctaLabel'], ENT_QUOTES, 'UTF-8'); ?>
                                    <i data-lucide="arrow-right"></i>
                                </a>
                            </article>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </section>

        <section class="dedicated-section dedicated-faq-premium">
            <div class="container dedicated-faq-premium__grid">
                <div class="dedicated-faq-premium__left reveal" data-aos="fade-up">
                    <div class="dedicated-faq-premium__list" role="list" aria-label="Perguntas frequentes sobre carga dedicada">
                        <?php foreach ($faqItems as $index => $faq): ?>
                            <details class="dedicated-faq-item" <?php echo $index === 0 ? 'open' : ''; ?>>
                                <summary>
                                    <span><?php echo htmlspecialchars($faq['question'], ENT_QUOTES, 'UTF-8'); ?></span>
                                    <i data-lucide="chevron-down" aria-hidden="true"></i>
                                </summary>
                                <div class="dedicated-faq-answer">
                                    <p><?php echo htmlspecialchars($faq['answer'], ENT_QUOTES, 'UTF-8'); ?></p>
                                </div>
                            </details>
                        <?php endforeach; ?>
                    </div>
                </div>

                <aside class="dedicated-faq-premium__aside reveal" data-aos="fade-left" data-aos-delay="80" aria-label="Introducao FAQ">
                    <p class="dedicated-kicker">Duvidas frequentes</p>
                    <h2>FAQ</h2>
                    <p>
                        Respostas rapidas sobre Carga Dedicada, operacao exclusiva e planejamento logistico com a Uppertruck.
                    </p>
                    <a class="dedicated-inline-link" href="/uppertruck/cotacao-contato/falar-com-especialista.php">
                        Ainda tem duvidas? Falar com especialista
                        <i data-lucide="arrow-up-right"></i>
                    </a>
                </aside>
            </div>
        </section>
    </main>

    <?php include __DIR__ . '/../components/home/footer.php'; ?>

    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.min.js"></script>
    <script src="/uppertruck/assets/js/home.js"></script>
    <script src="/uppertruck/assets/js/carga-dedicada.js"></script>
</body>

</html>

