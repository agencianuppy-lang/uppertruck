<?php
declare(strict_types=1);
require_once dirname(__DIR__) . '/components/home/path-bootstrap.php';

$metaTitle = 'Last Mile | Entrega Final com Controle e Previsibilidade | Uppertruck';
$metaDescription = 'Solução de Last Mile para empresas que precisam de entregas finais mais ágeis, rotas planejadas, acompanhamento operacional e mais previsibilidade.';

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

function lastMileImage(string $basename, string $fallback): string
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
    'hero' => lastMileImage('hero-last-mile', '/uppertruck/img/distribuicao2.png'),
    'intro' => lastMileImage('entrega-final-last-mile', '/uppertruck/img/operacoes-recorrentes.png'),
    'dashboard' => lastMileImage('painel-last-mile', '/uppertruck/img/upper6.png'),
];

$heroFloatingCards = [
    ['title' => 'Rota planejada', 'text' => 'Entrega final com mais organizacao.', 'icon' => 'route'],
    ['title' => 'Status acompanhado', 'text' => 'Mais visibilidade até o destino.', 'icon' => 'activity'],
    ['title' => 'Confirmação de entrega', 'text' => 'Controle sobre o fechamento da operação.', 'icon' => 'check-check'],
];

$críticalItems = [
    ['title' => 'Prazo apertado', 'text' => 'A entrega final costuma ter janelas mais curtas e maior pressao operacional.', 'icon' => 'clock-3'],
    ['title' => 'Mais pontos de parada', 'text' => 'Rotas urbanas podem envolver múltiplos destinos e mudancas durante o dia.', 'icon' => 'map-pinned'],
    ['title' => 'Cliente esperando', 'text' => 'A experiência do destinatario depende da previsibilidade da entrega.', 'icon' => 'user-check'],
    ['title' => 'Ocorrências rápidas', 'text' => 'Ausencia, endereco incorreto, trânsito e restricoes exigem resposta ágil.', 'icon' => 'alert-triangle'],
];

$operationFlow = [
    ['title' => 'Preparacao dos pedidos', 'text' => 'Organizacao dos volumes antes da saida.', 'icon' => 'package-search'],
    ['title' => 'Roteirização', 'text' => 'Definição de sequência, prioridade e região.', 'icon' => 'route'],
    ['title' => 'Saida para entrega', 'text' => 'Distribuição com acompanhamento operacional.', 'icon' => 'truck'],
    ['title' => 'Tratativa de ocorrências', 'text' => 'Ajustes rapidos durante a rota.', 'icon' => 'siren'],
    ['title' => 'Confirmação de entrega', 'text' => 'Fechamento da operação com status atualizado.', 'icon' => 'badge-check'],
];

$benefits = [
    ['title' => 'Mais previsibilidade', 'text' => 'Rotas e janelas organizadas com mais clareza.', 'icon' => 'calendar-check-2'],
    ['title' => 'Menos falhas de entrega', 'text' => 'Tratativa rápida de ocorrências durante a rota.', 'icon' => 'shield-check'],
    ['title' => 'Melhor experiência', 'text' => 'O destinatario sente mais segurança na entrega.', 'icon' => 'smile'],
    ['title' => 'Mais produtividade', 'text' => 'Melhor aproveitamento da equipe e dos veículos.', 'icon' => 'gauge'],
    ['title' => 'Mais controle', 'text' => 'Status e etapas acompanhadas até a confirmação.', 'icon' => 'radar'],
    ['title' => 'Menos retrabalho', 'text' => 'Redução de retornos, reentregas e ruídos internos.', 'icon' => 'refresh-cw'],
];

$operationTypes = [
    ['badge' => 'Varejo', 'title' => 'Abastecimento de lojas', 'text' => 'Entregas programadas para redes, unidades ou pontos comerciais.', 'icon' => 'store', 'size' => 'large'],
    ['badge' => 'B2B', 'title' => 'Distribuição B2B', 'text' => 'Entrega final para clientes empresariais, CDs ou filiais.', 'icon' => 'briefcase-business', 'size' => 'small'],
    ['badge' => 'Urbano', 'title' => 'Operações urbanas', 'text' => 'Rotas com múltiplos pontos em regiões metropolitanas.', 'icon' => 'map', 'size' => 'small'],
    ['badge' => 'Janela', 'title' => 'Projetos com janela', 'text' => 'Entregas que precisam respeitar horario, agenda ou prioridade.', 'icon' => 'alarm-clock', 'size' => 'large'],
    ['badge' => 'Suporte', 'title' => 'Reentregas e ocorrências', 'text' => 'Tratativas para reduzir impacto de falhas no destino.', 'icon' => 'undo-2', 'size' => 'small'],
    ['badge' => 'Escala', 'title' => 'Campanhas e picos', 'text' => 'Reforco operacional para datas sazonais ou aumento de demanda.', 'icon' => 'rocket', 'size' => 'small'],
];

?>
<!doctype html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?php echo htmlspecialchars($metaTitle, ENT_QUOTES, 'UTF-8'); ?>
    </title>
    <meta name="description" content="<?php echo htmlspecialchars($metaDescription, ENT_QUOTES, 'UTF-8'); ?>">
    <meta name="theme-color" content="#072156">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Manrope:wght@600;700;800&family=Plus+Jakarta+Sans:wght@500;600;700;800&family=Sora:wght@500;600&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="/uppertruck/assets/css/home.css">
    <link rel="stylesheet" href="/uppertruck/assets/css/last-mile.css">
</head>

<body class="lm-page">
    <a class="skip-link" href="#conteudo-principal">Pular para o conteúdo principal</a>

    <?php include __DIR__ . '/../components/home/header.php'; ?>

    <main id="conteudo-principal">
        <section class="lm-section lm-hero">
            <div class="container lm-hero__grid">
                <div class="lm-hero__content reveal">
                    <p class="lm-kicker">Solução Uppertruck</p>
                    <h1>
                        Last Mile para entregas finais com mais
                        <span>controle, agilidade e previsibilidade</span>
                    </h1>
                    <p class="lm-hero__lead">
                        Organizamos a etapa final da distribuição com rotas planejadas, acompanhamento operacional e
                        foco na experiência de entrega.
                    </p>
                    <div class="lm-hero__actions">
                        <a class="btn btn-primary" href="/uppertruck/cotacao-contato/solicitar-cotacao.php">Solicitar
                            cotação</a>
                        <a class="btn lm-btn-secondary"
                            href="/uppertruck/cotacao-contato/falar-com-especialista.php">Falar com especialista</a>
                    </div>
                    <p class="lm-hero__microcopy">
                        Ideal para entregas urbanas, distribuição B2B, abastecimento de lojas e operações com prazos
                        definidos.
                    </p>
                </div>

                <div class="lm-hero__visual reveal" style="--delay: 80ms;">
                    <figure class="lm-hero__media">
                        <img src="<?php echo htmlspecialchars($images['hero'], ENT_QUOTES, 'UTF-8'); ?>"
                            alt="Operação de entrega final e distribuição urbana Last Mile" loading="eager"
                            decoding="async">
                        <div class="lm-hero__overlay" aria-hidden="true"></div>
                    </figure>
                    <div class="lm-hero__float-grid">
                        <?php foreach ($heroFloatingCards as $index => $card): ?>
                        <article class="lm-hero__float-card reveal"
                            style="--delay: <?php echo htmlspecialchars((string) (120 + ($index * 80)), ENT_QUOTES, 'UTF-8'); ?>ms;">
                            <i data-lucide="<?php echo htmlspecialchars($card['icon'], ENT_QUOTES, 'UTF-8'); ?>"></i>
                            <h3>
                                <?php echo htmlspecialchars($card['title'], ENT_QUOTES, 'UTF-8'); ?>
                            </h3>
                            <p>
                                <?php echo htmlspecialchars($card['text'], ENT_QUOTES, 'UTF-8'); ?>
                            </p>
                        </article>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </section>

        <section class="lm-section lm-intro">
            <div class="container lm-intro__grid">
                <figure class="lm-intro__media reveal">
                    <img src="<?php echo htmlspecialchars($images['intro'], ENT_QUOTES, 'UTF-8'); ?>"
                        alt="Entrega final com motorista em operação urbana" loading="lazy" decoding="async">
                </figure>
                <div class="lm-intro__content reveal" style="--delay: 70ms;">
                    <p class="lm-kicker">A etapa final da jornada logística</p>
                    <h2>Onde a entrega encontra a experiência do cliente</h2>
                    <p>
                        O Last Mile e a última etapa da distribuição: o trecho que conecta a operação ao destinatario
                        final, seja uma loja, cliente, unidade, obra, empresa ou ponto de entrega.
                    </p>
                    <p>
                        Na Uppertruck, essa etapa é organizada com planejamento de rota, comunicação operacional e
                        acompanhamento para reduzir falhas e atrasos.
                    </p>
                    <a class="btn btn-primary" href="/uppertruck/cotacao-contato/falar-com-especialista.php">Entender a
                        operação</a>
                </div>
            </div>
        </section>

        <section class="lm-section lm-crítical">
            <div class="container">
                <div class="lm-head reveal">
                    <h2>Por que a última etapa exige tanta atenção?</h2>
                    <p>No Last Mile, pequenos atrasos, falhas de comunicação ou rotas mal planejadas podem comprometer
                        toda a percepcao da entrega.</p>
                </div>
                <div class="lm-crítical__grid">
                    <?php foreach ($críticalItems as $index => $item): ?>
                    <article class="lm-crítical__card reveal"
                        style="--delay: <?php echo htmlspecialchars((string) (50 + ($index * 70)), ENT_QUOTES, 'UTF-8'); ?>ms;">
                        <i data-lucide="<?php echo htmlspecialchars($item['icon'], ENT_QUOTES, 'UTF-8'); ?>"></i>
                        <h3>
                            <?php echo htmlspecialchars($item['title'], ENT_QUOTES, 'UTF-8'); ?>
                        </h3>
                        <p>
                            <?php echo htmlspecialchars($item['text'], ENT_QUOTES, 'UTF-8'); ?>
                        </p>
                    </article>
                    <?php endforeach; ?>
                </div>
                <p class="lm-crítical__quote reveal">A entrega final não pode ser o ponto fraco da sua operação.</p>
            </div>
        </section>

        <section class="lm-section lm-flow">
            <div class="container">
                <div class="lm-head reveal">
                    <h2>Da separacao a confirmação: uma operação pensada para o último trecho</h2>
                </div>
                <div class="lm-flow__route">
                    <?php foreach ($operationFlow as $index => $step): ?>
                    <article class="lm-flow__step reveal"
                        style="--delay: <?php echo htmlspecialchars((string) (($index + 1) * 55), ENT_QUOTES, 'UTF-8'); ?>ms;">
                        <span class="lm-flow__dot">
                            <?php echo htmlspecialchars((string) ($index + 1), ENT_QUOTES, 'UTF-8'); ?>
                        </span>
                        <i data-lucide="<?php echo htmlspecialchars($step['icon'], ENT_QUOTES, 'UTF-8'); ?>"></i>
                        <h3>
                            <?php echo htmlspecialchars($step['title'], ENT_QUOTES, 'UTF-8'); ?>
                        </h3>
                        <p>
                            <?php echo htmlspecialchars($step['text'], ENT_QUOTES, 'UTF-8'); ?>
                        </p>
                    </article>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <section class="lm-section lm-dashboard">
            <div class="container">
                <div class="lm-head reveal">
                    <h2>Visibilidade para acompanhar a entrega até o destino</h2>
                    <p>O Last Mile precisa de leitura rápida. Por isso, a operação deve permitir acompanhamento de
                        status, rotas, ocorrências e entregas concluidas.</p>
                </div>

                <div class="lm-dashboard__cta reveal" style="--delay: 90ms;">
                    <a class="btn btn-primary" href="/uppertruck/cotacao-contato/solicitar-cotacao.php">
                        Solicitar cotação de Last Mile
                    </a>
                </div>
            </div>
        </section>

        <section class="lm-section lm-benefits">
            <div class="container">
                <div class="lm-head reveal">
                    <h2>O que melhora quando o Last Mile e bem estruturado?</h2>
                </div>
                <div class="lm-benefits__grid">
                    <?php foreach ($benefits as $index => $benefit): ?>
                    <article class="lm-benefit-card reveal"
                        style="--delay: <?php echo htmlspecialchars((string) (50 + ($index * 45)), ENT_QUOTES, 'UTF-8'); ?>ms;">
                        <i data-lucide="<?php echo htmlspecialchars($benefit['icon'], ENT_QUOTES, 'UTF-8'); ?>"></i>
                        <h3>
                            <?php echo htmlspecialchars($benefit['title'], ENT_QUOTES, 'UTF-8'); ?>
                        </h3>
                        <p>
                            <?php echo htmlspecialchars($benefit['text'], ENT_QUOTES, 'UTF-8'); ?>
                        </p>
                    </article>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <section class="lm-section lm-operations-type">
            <div class="container">
                <div class="lm-head reveal">
                    <h2>Last Mile para diferentes modelos de distribuição</h2>
                </div>
                <div class="lm-mosaic">
                    <?php foreach ($operationTypes as $index => $item): ?>
                    <article
                        class="lm-mosaic__card lm-mosaic__card--<?php echo htmlspecialchars($item['size'], ENT_QUOTES, 'UTF-8'); ?> reveal"
                        style="--delay: <?php echo htmlspecialchars((string) (50 + ($index * 45)), ENT_QUOTES, 'UTF-8'); ?>ms;">
                        <p class="lm-mosaic__badge">
                            <?php echo htmlspecialchars($item['badge'], ENT_QUOTES, 'UTF-8'); ?>
                        </p>
                        <i data-lucide="<?php echo htmlspecialchars($item['icon'], ENT_QUOTES, 'UTF-8'); ?>"></i>
                        <h3>
                            <?php echo htmlspecialchars($item['title'], ENT_QUOTES, 'UTF-8'); ?>
                        </h3>
                        <p>
                            <?php echo htmlspecialchars($item['text'], ENT_QUOTES, 'UTF-8'); ?>
                        </p>
                    </article>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

    </main>

    <?php include __DIR__ . '/../components/home/footer.php'; ?>

    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.min.js"></script>
    <script src="/uppertruck/assets/js/home.js"></script>
    <script src="/uppertruck/assets/js/last-mile.js"></script>
</body>

</html>
