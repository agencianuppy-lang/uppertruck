<?php
require_once __DIR__ . '/components/home/path-bootstrap.php';
$metaTitle = 'Uppertruck | Transporte de Cargas com Inteligencia Operacional';
$metaDescription = 'A Uppertruck e uma transportadora digital com operacao nacional, gestao de frete, seguranca da carga e tecnologia aplicada para empresas que buscam previsibilidade e eficiencia logistica.';
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
    ['label' => 'Blog', 'href' => '/uppertruck/blog'],
    ['label' => 'Cotacao', 'href' => '/uppertruck/cotacao-contato.php'],
];

$stats = [
    ['icon' => 'users', 'target' => 1, 'decimals' => 0, 'prefix' => '+', 'suffix' => 'K', 'label' => 'clientes atendidos com operacao recorrente'],
    ['icon' => 'map-pin', 'target' => 3.5, 'decimals' => 1, 'prefix' => '+', 'suffix' => 'K', 'label' => 'cidades cobertas em operacoes nacionais'],
    ['icon' => 'bar-chart-2', 'target' => 20, 'decimals' => 0, 'prefix' => '', 'suffix' => '%', 'label' => 'crescimento anual sustentado'],
    ['icon' => 'shield-check', 'target' => 0, 'decimals' => 0, 'prefix' => '', 'suffix' => '', 'label' => 'roubos e sinistros reportados nas operacoes monitoradas'],
];

$solutions = [
    ['icon' => 'package', 'title' => 'Carga Fracionada', 'description' => 'Distribua volumes menores com melhor aproveitamento de malha e custo competitivo para entregas recorrentes.', 'href' => '/uppertruck/solucoes/carga-fracionada.php'],
    ['icon' => 'truck', 'title' => 'Carga Dedicada', 'description' => 'Operacao exclusiva para rotas criticas, com controle de prazo, janela de coleta e prioridade operacional.', 'href' => '/uppertruck/solucoes/carga-dedicada.php'],
    ['icon' => 'box', 'title' => 'Consolidacao de Cargas', 'description' => 'Unificamos embarques para reduzir ociosidade, simplificar processos e elevar eficiencia logistica.', 'href' => '/uppertruck/solucoes/consolidacao-de-cargas.php'],
    ['icon' => 'navigation', 'title' => 'Last Mile', 'description' => 'Capilaridade para entrega final com rastreabilidade, padrao de atendimento e previsibilidade da operacao.', 'href' => '/uppertruck/solucoes/last-mile.php'],
    ['icon' => 'settings', 'title' => 'Operacoes Sob Medida', 'description' => 'Projetos desenhados conforme perfil de carga, sazonalidade, SLA e exigencias do seu fluxo logistico.', 'href' => '/uppertruck/solucoes/operacoes-sob-medida.php'],
];

$companyBenefits = [
    ['icon' => 'line-chart', 'text' => 'Reducao de custo com frete sem comprometer nivel de servico'],
    ['icon' => 'gauge', 'text' => 'Agilidade operacional para reduzir gargalos internos'],
    ['icon' => 'route', 'text' => 'Previsibilidade de coleta, transito e entrega'],
    ['icon' => 'users', 'text' => 'Atendimento nacional com suporte proximo e responsavel'],
    ['icon' => 'clipboard-check', 'text' => 'Gestao operacional da logistica com menos burocracia para sua equipe'],
];

$techItems = [
    ['icon' => 'navigation', 'title' => 'Rastreamento', 'description' => 'Visibilidade do status da carga durante toda a jornada de transporte.'],
    ['icon' => 'radio', 'title' => 'Monitoramento', 'description' => 'Acompanhamento continuo com protocolos de comunicacao operacional.'],
    ['icon' => 'monitor', 'title' => 'Gestao Operacional', 'description' => 'Painel de controle para consolidar eventos, ocorrencias e prazos.'],
    ['icon' => 'bar-chart-2', 'title' => 'Inteligencia da Operacao', 'description' => 'Dados aplicados para ajuste de rota, capacidade e desempenho logistico.'],
];

$differentials = [
    ['icon' => 'shield', 'title' => 'Seguro da Carga', 'description' => 'Cobertura adequada ao perfil de operacao e tipo de mercadoria.'],
    ['icon' => 'eye', 'title' => 'Gerenciamento de Riscos', 'description' => 'Rotinas de controle preventivo para preservar carga e prazo.'],
    ['icon' => 'map-pin', 'title' => 'Avaliacao de Rotas', 'description' => 'Analise previa para reduzir exposicao e melhorar consistencia operacional.'],
    ['icon' => 'file-text', 'title' => 'Responsabilidade Tecnica', 'description' => 'Processos conduzidos com criterio tecnico e governanca operacional.'],
    ['icon' => 'briefcase', 'title' => 'Confiabilidade Juridica', 'description' => 'Atuacao alinhada a exigencias legais e compliance do transporte.'],
    ['icon' => 'book-open', 'title' => 'Obrigacoes Fiscais', 'description' => 'Tratativa fiscal e tributaria com padrao formal e rastreavel.'],
    ['icon' => 'users', 'title' => 'Transportadores Avaliados', 'description' => 'Rede homologada com criterios de desempenho e conformidade.'],
    ['icon' => 'check-circle', 'title' => 'Monitoramento do Transporte', 'description' => 'Acompanhamento ativo da operacao para resposta rapida a desvios.'],
];

$segments = [
    ['icon' => 'briefcase', 'title' => 'Industria', 'description' => 'Fluxos com previsao de demanda, janelas de abastecimento e controle de SLA.'],
    ['icon' => 'shopping-bag', 'title' => 'Varejo', 'description' => 'Reposicao organizada para pontos de venda e centros de distribuicao.'],
    ['icon' => 'repeat', 'title' => 'Distribuicao', 'description' => 'Operacoes recorrentes com padrao de atendimento em escala nacional.'],
    ['icon' => 'package', 'title' => 'E-commerce', 'description' => 'Capilaridade para entregas urbanas e regionais com acompanhamento continuo.'],
    ['icon' => 'layers', 'title' => 'Operacoes Recorrentes', 'description' => 'Projetos estruturados para ciclos frequentes e alto volume de expedicao.'],
    ['icon' => 'clock', 'title' => 'Cargas Sob Demanda', 'description' => 'Flexibilidade para necessidades pontuais com resposta operacional rapida.'],
];

$insights = [
    ['image' => '/uppertruck/img/upper4.png', 'title' => 'Como estruturar uma operacao de frete previsivel em cenario de variacao de demanda', 'excerpt' => 'Praticas para reduzir instabilidade no transporte e proteger indicadores de abastecimento.', 'href' => '/uppertruck/blog'],
    ['image' => '/uppertruck/img/upper5.png', 'title' => 'Risco logistico: pontos criticos para elevar seguranca da carga e da operacao', 'excerpt' => 'Uma leitura pratica sobre monitoramento, avaliacao de rota e governanca operacional.', 'href' => '/uppertruck/blog'],
    ['image' => '/uppertruck/img/upper6.png', 'title' => 'Consolidacao de cargas: eficiencia de malha e impacto direto no custo de frete', 'excerpt' => 'Quando consolidar, como planejar e quais ganhos operacionais buscar no medio prazo.', 'href' => '/uppertruck/blog'],
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
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@500;600;700;800&family=Sora:wght@500;600&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="/uppertruck/assets/css/home.css">
</head>

<body>
    <a class="skip-link" href="#conteudo-principal">Pular para o conteudo principal</a>

    <?php include __DIR__ . '/components/home/header.php'; ?>

    <main id="conteudo-principal">
        <?php include __DIR__ . '/components/home/hero.php'; ?>
        <?php include __DIR__ . '/components/home/about-preview.php'; ?>
        <?php include __DIR__ . '/components/home/solutions-grid.php'; ?>
        <?php include __DIR__ . '/components/home/for-companies.php'; ?>
        <?php include __DIR__ . '/components/home/technology-section.php'; ?>
        <?php include __DIR__ . '/components/home/differentials-grid.php'; ?>
        <?php include __DIR__ . '/components/home/how-it-works.php'; ?>
        <?php include __DIR__ . '/components/home/insights-section.php'; ?>
        <?php include __DIR__ . '/components/home/final-cta.php'; ?>
    </main>

    <?php include __DIR__ . '/components/home/footer.php'; ?>

    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.min.js"></script>
    <script src="/uppertruck/assets/js/home.js"></script>
</body>

</html>