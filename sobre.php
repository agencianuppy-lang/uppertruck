<?php
require_once __DIR__ . '/components/home/path-bootstrap.php';
$metaTitle = 'Sobre | Uppertruck';
$metaDescription = 'Conheça a Uppertruck, transportadora digital com operação nacional, inteligência logística e método para gerar previsibilidade.';
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

$cultureItems = [
    [
        'icon' => 'crown',
        'title' => 'Excelencia operacional',
        'description' => 'Trabalhamos com método, padrão técnico e compromisso de entrega em cada etapa do transporte.',
    ],
    [
        'icon' => 'star',
        'title' => 'Criacao de valor',
        'description' => 'Cada operação é desenhada para reduzir atrito, simplificar rotinas e dar previsibilidade ao cliente.',
    ],
];

$principles = [
    [
        'icon' => 'shield-check',
        'title' => 'Confianca em primeiro plano',
        'description' => 'Processos formais, responsabilidade técnica e acompanhamento ativo da carga.',
    ],
    [
        'icon' => 'map',
        'title' => 'Leitura real de operação',
        'description' => 'Análise de rota, contexto regional e malha para decisão mais inteligente.',
    ],
    [
        'icon' => 'users',
        'title' => 'Time próximo da rotina',
        'description' => 'Atendimento consultivo com foco em agilidade e resposta rápida a desvios.',
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
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@500;600;700;800&family=Sora:wght@500;600&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="/uppertruck/assets/css/home.css">
    <link rel="stylesheet" href="/uppertruck/assets/css/sobre.css">
</head>

<body class="about-page">
    <a class="skip-link" href="#conteudo-principal">Pular para o conteúdo principal</a>

    <?php include __DIR__ . '/components/home/header.php'; ?>

    <main id="conteudo-principal">
        <section class="about-hero">
            <div class="about-hero-media">
                <img src="/uppertruck/img/banner-quemsomos.jpg" alt="Equipe Uppertruck em operação de transporte" fetchpriority="high">
            </div>
            <div class="about-hero-overlay" aria-hidden="true"></div>
            <div class="container about-hero-content reveal">
                <p class="eyebrow">Sobre a Uppertruck</p>
                <h1>Operação real para empresas que exigem clareza, método e previsibilidade.</h1>
                <p class="about-hero-lead">
                    Somos uma transportadora digital com presença nacional, unindo inteligência logística, governança e atendimento próximo para reduzir complexidade operacional.
                </p>
            </div>
        </section>

        <section class="section-shell about-editorial">
            <div class="container">
                <p class="about-kicker reveal">Uppertruck para todo tipo de operação</p>
                <div class="about-editorial-head">
                    <h2 class="reveal">Uma jornada de trabalho mais clara para sua operação logística.</h2>
                    <p class="reveal" style="--delay: 80ms">
                        Simplificamos a gestão de coleta, trânsito e entrega em um único fluxo operacional, com critério técnico e visibilidade ponta a ponta.
                    </p>
                </div>
                <figure class="about-editorial-image reveal" style="--delay: 120ms">
                    <img src="/uppertruck/img/upper4.png" alt="Equipe acompanhando operação em centro logístico" loading="lazy" decoding="async">
                </figure>
            </div>
        </section>

        <section class="section-shell about-culture">
            <div class="container about-culture-grid">
                <div class="about-culture-left reveal">
                    <p class="about-culture-mark">Cultura<br><span>Uppertruck</span></p>
                    <figure class="about-culture-image">
                        <img src="/uppertruck/img/upper5.png" alt="Reuniao de planejamento operacional" loading="lazy" decoding="async">
                    </figure>
                </div>

                <div class="about-culture-right reveal" style="--delay: 80ms">
                    <h2>Saiba como nossos valores determinam soluções mais inteligentes para o dia a dia logístico.</h2>
                    <article class="about-culture-card">
                        <p class="about-culture-step">01</p>
                        <h3>Agimos com foco no cliente e leitura de operação.</h3>
                        <div class="about-culture-points">
                            <?php foreach ($cultureItems as $item): ?>
                                <div class="about-culture-point">
                                    <i data-lucide="<?php echo htmlspecialchars($item['icon'], ENT_QUOTES, 'UTF-8'); ?>" aria-hidden="true"></i>
                                    <h4><?php echo htmlspecialchars($item['title'], ENT_QUOTES, 'UTF-8'); ?></h4>
                                    <p><?php echo htmlspecialchars($item['description'], ENT_QUOTES, 'UTF-8'); ?></p>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </article>
                </div>
            </div>
        </section>

        <section class="section-shell about-principles">
            <div class="container">
                <div class="section-head reveal">
                    <p class="eyebrow">Nossa base operacional</p>
                    <h2>Uma estrutura solida para suportar crescimento com segurança e eficiência.</h2>
                </div>
                <div class="about-principles-grid">
                    <?php foreach ($principles as $index => $item): ?>
                        <article class="about-principle-card reveal" style="--delay: <?php echo htmlspecialchars((string) (($index + 1) * 70), ENT_QUOTES, 'UTF-8'); ?>ms;">
                            <span class="about-principle-icon">
                                <i data-lucide="<?php echo htmlspecialchars($item['icon'], ENT_QUOTES, 'UTF-8'); ?>"></i>
                            </span>
                            <h3><?php echo htmlspecialchars($item['title'], ENT_QUOTES, 'UTF-8'); ?></h3>
                            <p><?php echo htmlspecialchars($item['description'], ENT_QUOTES, 'UTF-8'); ?></p>
                        </article>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
    </main>

    <?php include __DIR__ . '/components/home/footer.php'; ?>

    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.min.js"></script>
    <script src="/uppertruck/assets/js/home.js"></script>
</body>

</html>
