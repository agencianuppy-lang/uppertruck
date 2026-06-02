<?php
declare(strict_types=1);
require_once dirname(__DIR__) . '/components/home/path-bootstrap.php';

$metaTitle = 'Carga Dedicada | Transporte Exclusivo para Empresas | Uppertruck';
$metaDescription = 'Carga dedicada para empresas que precisam de transporte exclusivo, rotas recorrentes, capacidade reservada, SLA monitorado e maior previsibilidade operacional.';
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
    ['title' => 'Capacidade reservada', 'text' => 'Veículo e operação planejados conforme sua demanda.'],
    ['title' => 'Rota com prioridade', 'text' => 'Menos desvios, menos paradas e maior previsibilidade.'],
    ['title' => 'Gestão próxima', 'text' => 'Acompanhamento ativo antes, durante e depois da entrega.'],
];

$heroSignals = [
    ['icon' => 'clock-3', 'label' => '24h resposta operacional'],
    ['icon' => 'badge-check', 'label' => '100% planejamento por demanda'],
    ['icon' => 'activity', 'label' => 'SLA monitorado em rota'],
];

$dedicatedShowcaseSlides = [
    [
        'image' => $images['hero'],
        'alt' => 'Caminhao dedicado em operação de rota planejada',
        'subtitle' => 'Capacidade reservada para sua demanda',
        'text' => 'A Carga Dedicada permite estruturar veículos e recursos conforme a rotina da sua empresa, reduzindo a dependencia de disponibilidade em cima da hora e trazendo mais previsibilidade para rotas recorrentes.',
        'ctaLabel' => 'Solicitar operação dedicada',
        'ctaHref' => '/uppertruck/cotacao-contato/solicitar-cotacao.php',
    ],
    [
        'image' => $images['comparison'],
        'alt' => 'Operação dedicada com carregamento planejado em doca',
        'subtitle' => 'Rotas planejadas, menos improviso',
        'text' => 'A operação é desenhada considerando origem, destino, frequência, volume, janela de coleta e criticidade da entrega. Assim, sua empresa ganha uma rotina logística mais estável e menos vulneravel a falhas operacionais.',
        'ctaLabel' => 'Falar com especialista',
        'ctaHref' => '/uppertruck/cotacao-contato/falar-com-especialista.php',
    ],
    [
        'image' => $images['timeline'],
        'alt' => 'Equipe acompanhando indicadores de operação dedicada',
        'subtitle' => 'Acompanhamento próximo do início ao fim',
        'text' => 'Com gestão ativa da operação, comunicação de status e leitura de performance, a Uppertruck ajuda sua empresa a manter mais controle sobre prazos, SLA, ocorrências e continuidade logística.',
        'ctaLabel' => 'Entender a solução',
        'ctaHref' => '/uppertruck/solucoes/carga-dedicada.php',
    ],
];

$diagnosticQuestions = [
    'Sua empresa possui rotas recorrentes?',
    'Você precisa reservar capacidade com antecedencia?',
    'O atraso de uma entrega compromete produção ou atendimento?',
    'A carga exige cuidado, prioridade ou menor manuseio?',
    'Você quer reduzir dependencia de fretes spot?',
    'Sua operação precisa de SLA, janela e acompanhamento próximo?',
];

$comparisonRows = [
    [
        'aspect' => 'Investimento inicial',
        'ownFleet' => 'Exige compra, locacao ou imobilizacao de capital.',
        'dedicated' => 'Operação estruturada sem necessidade de frota própria.',
    ],
    [
        'aspect' => 'Contratacao de motoristas',
        'ownFleet' => 'Cliente precisa recrutar, treinar e gerir equipe.',
        'dedicated' => 'Equipe e parceiros alinhados a sua demanda.',
    ],
    [
        'aspect' => 'Manutenção e disponibilidade',
        'ownFleet' => 'Indisponibilidade pode afetar diretamente a rotina.',
        'dedicated' => 'Planejamento para reduzir rupturas e manter continuidade.',
    ],
    [
        'aspect' => 'Escala e substituicao',
        'ownFleet' => 'Gestão interna de folgas, cobertura e contingência.',
        'dedicated' => 'Operação coordenada com plano de cobertura.',
    ],
    [
        'aspect' => 'Monitoramento operacional',
        'ownFleet' => 'Depende de sistema e processo interno maduro.',
        'dedicated' => 'Acompanhamento ativo com comunicação operacional.',
    ],
    [
        'aspect' => 'Flexibilidade de demanda',
        'ownFleet' => 'Mudancas exigem ajustes internos mais lentos.',
        'dedicated' => 'Modelo ajustavel por periodo, rota e criticidade.',
    ],
    [
        'aspect' => 'Gestão de SLA',
        'ownFleet' => 'Controle depende da disciplina operacional interna.',
        'dedicated' => 'Janela, prioridade e SLA acompanhados contínuamente.',
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
        'description' => 'Para empresas com coletas e entregas frequentes entre pontos definidos, como indústria para CD, CD para filial ou fornecedor para planta.',
        'bestFor' => 'Melhor indicado para operações com fluxo semanal estável.',
        'icon' => 'route',
    ],
    [
        'badge' => 'Capacidade',
        'title' => 'Veículo Exclusivo por Periodo',
        'description' => 'Quando a operação precisa de disponibilidade dedicada por dia, semana, campanha ou contrato com reforco de distribuição.',
        'bestFor' => 'Melhor indicado para sazonalidade e expansão temporaria.',
        'icon' => 'truck',
    ],
    [
        'badge' => 'SLA',
        'title' => 'Operação com Janela Crítica',
        'description' => 'Entregas que precisam acontecer dentro de horarios específicos para abastecimento de loja, linha de produção e cliente estratégico.',
        'bestFor' => 'Melhor indicado para embarques com horario de recebimento definido.',
        'icon' => 'timer',
    ],
    [
        'badge' => 'Projeto',
        'title' => 'Projeto Especial Dedicado',
        'description' => 'Cargas sensíveis, rotas fora do padrão, maquinas, equipamentos e materiais de alto valor com planejamento sob medida.',
        'bestFor' => 'Melhor indicado para demandas fora da rotina padrão.',
        'icon' => 'settings-2',
    ],
];

$timelinePhases = [
    [
        'title' => 'Mapeamento da demanda',
        'description' => 'Entendimento de origem, destino, frequência, volume, tipo de carga e criticidade operacional.',
        'icon' => 'search',
    ],
    [
        'title' => 'Desenho da solução',
        'description' => 'Definição do modelo dedicado: rota fixa, veículo reservado, janela crítica ou projeto especial.',
        'icon' => 'drafting-compass',
    ],
    [
        'title' => 'Planejamento de recursos',
        'description' => 'Alocacao de veículo, perfil operacional, parceiros, horarios e plano de contingência.',
        'icon' => 'layers-3',
    ],
    [
        'title' => 'Operação monitorada',
        'description' => 'Acompanhamento ativo da carga, status de rota e tratativa rápida de ocorrências.',
        'icon' => 'radar',
    ],
    [
        'title' => 'Leitura de performance',
        'description' => 'Avaliação de SLA, pontualidade, ocorrências e oportunidades de melhoria contínua.',
        'icon' => 'line-chart',
    ],
];

$painReducers = [
    [
        'title' => 'Menos atraso por indisponibilidade',
        'description' => 'Capacidade planejada reduz dependencia de encontrar veículo em cima da hora.',
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
        'title' => 'Menos variação de custo',
        'description' => 'Rotas recorrentes trazem previsibilidade e reduzem oscilacoes de frete spot.',
        'icon' => 'badge-dollar-sign',
    ],
    [
        'title' => 'Menos ruido de comunicação',
        'description' => 'Acompanhamento próximo evita perda de informacao entre coleta, trânsito e entrega.',
        'icon' => 'messages-square',
    ],
    [
        'title' => 'Menos ruptura operacional',
        'description' => 'Planejamento dedicado reduz falhas que impactam produção, estoque e atendimento.',
        'icon' => 'siren',
    ],
];

$segmentCards = [
    [
        'title' => 'Indústrias',
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
        'title' => 'Operações B2B críticas',
        'description' => 'Clientes estratégicos, materiais sensíveis e rotas com prioridade operacional.',
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
        'description' => 'Expansão de operação, reforco logístico em picos e demandas temporarias.',
        'icon' => 'rocket',
        'class' => 'dedicated-app-card-6',
    ],
];

$resultCards = [
    [
        'label' => 'Resposta operacional',
        'value' => 24,
        'suffix' => 'h',
        'description' => 'Retorno rapido para iniciar o desenho da operação dedicada.',
    ],
    [
        'label' => 'Planejamento por demanda',
        'value' => 100,
        'suffix' => '%',
        'description' => 'Rotas e recursos estruturados conforme frequência e criticidade.',
    ],
    [
        'label' => 'SLA monitorado',
        'value' => 100,
        'suffix' => '%',
        'description' => 'Acompanhamento de janela, prioridade e status durante a execução.',
    ],
    [
        'label' => 'Capacidade reservada',
        'value' => 1,
        'prefix' => '1:',
        'suffix' => '',
        'description' => 'Operação dedicada para quem não pode depender do improviso.',
    ],
];

$ctaChecklist = [
    'Origem e destino',
    'Frequência de embarque',
    'Tipo de carga',
    'Volume médio',
    'Janela de coleta e entrega',
    'Pontos críticos da operação',
];

$faqItems = [
    [
        'question' => 'O que e Carga Dedicada?',
        'answer' => 'Carga Dedicada é uma solução em que a operação de transporte é planejada conforme a demanda da empresa, com veículo, rota, frequência e acompanhamento definidos para atender uma necessidade específica. É indicada para operações que precisam de mais controle, previsibilidade e prioridade.',
    ],
    [
        'question' => 'Qual a diferenca entre Carga Dedicada e Carga Fracionada?',
        'answer' => 'Na Carga Fracionada, diferentes embarques podem compartilhar a mesma operação para otimizar espaco e custo. Na Carga Dedicada, a estrutura é desenhada para uma demanda específica, com maior controle sobre rota, janela, capacidade e acompanhamento operacional.',
    ],
    [
        'question' => 'Quando vale a pena contratar Carga Dedicada?',
        'answer' => 'A Carga Dedicada faz sentido quando sua empresa possui rotas recorrentes, alto volume, prazos críticos, janelas definidas ou quando atrasos e indisponibilidade de transporte afetam produção, estoque, abastecimento ou atendimento ao cliente.',
    ],
    [
        'question' => 'Preciso ter uma frota própria para usar Carga Dedicada?',
        'answer' => 'Não. A proposta da Carga Dedicada e justamente oferecer uma operação planejada sem que sua empresa precise assumir toda a complexidade de comprar veículos, contratar motoristas, cuidar de manutenção, escala e gestão de disponibilidade.',
    ],
    [
        'question' => 'A operação pode ser personalizada para minha empresa?',
        'answer' => 'Sim. A Uppertruck pode estruturar a operação conforme origem, destino, frequência, volume, tipo de carga, janela de coleta e entrega, criticidade da operação e necessidade de acompanhamento.',
    ],
    [
        'question' => 'A Carga Dedicada ajuda no cumprimento de SLA?',
        'answer' => 'Sim. Como a operação é planejada com foco em rotina, prioridade e acompanhamento, a Carga Dedicada ajuda a trazer mais previsibilidade e controle para empresas que precisam cumprir prazos e manter indicadores logísticos mais estaveis.',
    ],
    [
        'question' => 'Como solicitar uma análise de Carga Dedicada?',
        'answer' => 'Você pode solicitar uma análise com a equipe da Uppertruck. A partir das informações sobre rota, volume, frequência, tipo de carga e janela de atendimento, é possível desenhar uma solução mais adequada para sua operação.',
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
    <a class="skip-link" href="#conteudo-principal">Pular para o conteúdo principal</a>

    <?php include __DIR__ . '/../components/home/header.php'; ?>

    <main id="conteudo-principal">
        <section class="dedicated-section dedicated-hero">
            <div class="dedicated-hero__container">
                <div class="dedicated-hero__grid">
                    <div class="dedicated-hero__content reveal" data-aos="fade-up">
                        <p class="dedicated-kicker dedicated-hero__eyebrow">Solução Uppertruck</p>
                        <h1 class="dedicated-hero__title">
                            Carga Dedicada para operações que exigem
                            <span>controle, previsibilidade e prioridade.</span>
                        </h1>
                        <p class="dedicated-hero__text">
                            Estruturamos veículos, rotas e acompanhamento operacional para empresas que precisam de uma solução exclusiva, recorrente e alinhada ao ritmo da própria operação.
                        </p>
                        <div class="dedicated-hero__actions">
                            <a class="dedicated-btn dedicated-btn-primary" href="/uppertruck/cotacao-contato/solicitar-cotacao.php">
                                Solicitar operação dedicada
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
                                <img src="<?php echo htmlspecialchars($images['hero'], ENT_QUOTES, 'UTF-8'); ?>" alt="Operação de carga dedicada em andamento" loading="eager" decoding="async">
                                <div class="dedicated-media-overlay" aria-hidden="true"></div>
                            </figure>

                            <aside class="dedicated-status-card dedicated-hero__floating-card--top" aria-label="Painel operacional">
                                <div class="dedicated-status-head">
                                    <p class="dedicated-status-title">Painel operacional</p>
                                </div>
                                <ul>
                                    <li><i data-lucide="truck"></i> Veículo alocado</li>
                                    <li><i data-lucide="route"></i> Rota dedicada ativa</li>
                                    <li><i data-lucide="target"></i> SLA monitorado</li>
                                    <li><i data-lucide="calendar-check-2"></i> Janela prevista</li>
                                </ul>
                            </aside>
                        </div>

                        <div class="dedicated-hero-badges dedicated-hero__floating-stack" aria-label="Diferenciais da operação dedicada">
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
                    <img src="<?php echo htmlspecialchars($images['comparison'], ENT_QUOTES, 'UTF-8'); ?>" alt="Operação dedicada com planejamento logístico e controle de transporte" loading="lazy" decoding="async">
                </figure>

                <div class="dedicated-predictability__content reveal" data-aos="fade-left" data-aos-delay="90">
                    <p class="dedicated-kicker">Operação dedicada para empresas que precisam de previsibilidade</p>
                    <h2>Mais controle para a sua logística, sem depender do improviso</h2>
                    <p>
                        A Carga Dedicada da Uppertruck é ideal para empresas que precisam de capacidade reservada, rotas recorrentes e acompanhamento próximo da operação. Com uma estrutura planejada, sua empresa ganha mais previsibilidade no transporte, mais estabilidade para cumprir prazos e mais segurança para sustentar a rotina logística com menos ruido operacional.
                    </p>
                    <p>
                        Em vez de depender de soluções pontuais, sua operação passa a contar com uma dinâmica dedicada, desenhada conforme frequência, volume, criticidade e janela de atendimento.
                    </p>
                    <div class="dedicated-predictability__actions">
                        <a class="dedicated-btn dedicated-btn-primary" href="/uppertruck/cotacao-contato/solicitar-cotacao.php">
                            Solicitar operação dedicada
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
                    <img src="<?php echo htmlspecialchars($images['comparison'], ENT_QUOTES, 'UTF-8'); ?>" alt="Operação de carga dedicada com planejamento logístico e controle de rota" loading="lazy" decoding="async">
                </figure>

                <div class="dedicated-tabbed-solution__content reveal" data-aos="fade-left" data-aos-delay="90">
                    <p class="dedicated-kicker">Solução exclusiva para operações críticas</p>
                    <h2>Carga Dedicada com mais controle para a rotina da sua operação</h2>

                    <div class="dedicated-tabbed-nav" role="tablist" aria-label="Conteudo sobre carga dedicada">
                        <button type="button" class="is-active" role="tab" aria-selected="true" data-dedicated-tab-button="sobre">Sobre a solução</button>
                        <button type="button" role="tab" aria-selected="false" data-dedicated-tab-button="operamos">Como operamos</button>
                        <button type="button" role="tab" aria-selected="false" data-dedicated-tab-button="vantagens">Vantagens para sua empresa</button>
                    </div>

                    <div class="dedicated-tabbed-panels">
                        <article class="dedicated-tabbed-panel is-active" data-dedicated-tab-panel="sobre">
                            <p>A carga dedicada é ideal para empresas que precisam de capacidade reservada, prioridade de coleta e entrega e menor variação na rotina logística. Nesse modelo, o transporte e planejado para a sua demanda, com mais previsibilidade e controle operacional.</p>
                            <p>É uma solução estratégica para operações recorrentes, janelas críticas e fluxos em que atraso impacta produção, abastecimento ou atendimento.</p>
                            <div class="dedicated-tabbed-actions">
                                <a class="dedicated-btn dedicated-btn-primary" href="/uppertruck/cotacao-contato/solicitar-cotacao.php">Solicitar cotação</a>
                                <a class="dedicated-btn dedicated-btn-secondary" href="/uppertruck/cotacao-contato/falar-com-especialista.php">Falar com especialista</a>
                            </div>
                        </article>

                        <article class="dedicated-tabbed-panel" data-dedicated-tab-panel="operamos" hidden>
                            <p>Na Uppertruck, a operação dedicada começa com diagnóstico de rota, frequência, janela e criticidade. Em seguida, estruturamos veículo, equipe e plano de contingência para manter continuidade e nível de serviço ao longo de toda a jornada.</p>
                            <p>O objetivo e transformar uma operação suscetivel a urgencias em uma rotina com governança, comunicação ativa e execução consistente.</p>
                            <div class="dedicated-tabbed-actions">
                                <a class="dedicated-btn dedicated-btn-secondary" href="/uppertruck/cotacao-contato/falar-com-especialista.php">Entender a operação</a>
                                <a class="dedicated-btn dedicated-btn-primary" href="/uppertruck/cotacao-contato/solicitar-cotacao.php">Solicitar cotação</a>
                            </div>
                        </article>

                        <article class="dedicated-tabbed-panel" data-dedicated-tab-panel="vantagens" hidden>
                            <p>Com a carga dedicada, sua empresa reduz dependencia de frete spot, ganha previsibilidade para cumprir SLA e melhora o controle de ponta a ponta sobre embarques estratégicos. E uma alternativa eficiente para crescer sem absorver toda a complexidade de uma frota própria.</p>
                            <p>Entre os principais ganhos estao mais estabilidade operacional, resposta rápida a desvios e melhor alinhamento entre transporte e estrategia do negócio.</p>
                            <ul class="dedicated-tabbed-benefits">
                                <li>Capacidade reservada para rotas recorrentes</li>
                                <li>Mais consistência no cumprimento de SLA</li>
                                <li>Maior controle com acompanhamento ativo</li>
                            </ul>
                            <div class="dedicated-tabbed-actions">
                                <a class="dedicated-btn dedicated-btn-primary" href="/uppertruck/cotacao-contato/solicitar-cotacao.php">Solicitar cotação</a>
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
                    <h2>Carga Dedicada para operações que precisam de controle real</h2>

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
                    <p class="dedicated-kicker">Dúvidas frequentes</p>
                    <h2>FAQ</h2>
                    <p>
                        Respostas rápidas sobre Carga Dedicada, operação exclusiva e planejamento logístico com a Uppertruck.
                    </p>
                    <a class="dedicated-inline-link" href="/uppertruck/cotacao-contato/falar-com-especialista.php">
                        Ainda tem dúvidas? Falar com especialista
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

