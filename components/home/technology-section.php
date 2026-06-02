<?php
$segmentosHub = [
    [
        'icon' => 'factory',
        'title' => 'Indústria',
        'active' => false,
        'image' => '/uppertruck/img/upper5.png',
        'alt' => 'Operação industrial com monitoramento logístico da Uppertruck',
        'caption' => 'Operação industrial com leitura contínua de produtividade',
        'label' => 'Performance na cadeia industrial',
        'number' => '+32%',
        'copy' => 'das operações industriais monitoradas relatam redução de ruptura e melhor controle de janela de entrega.',
        'link_label' => 'Conheça as soluções para indústria',
        'link_href' => '/uppertruck/para-empresas.php',
    ],
    [
        'icon' => 'shopping-bag',
        'title' => 'Varejo',
        'active' => true,
        'image' => '/uppertruck/img/varejo.png',
        'alt' => 'Equipe operacional em centro logístico da Uppertruck',
        'caption' => 'Operação monitorada com leitura contínua de status',
        'label' => 'Performance em operações recorrentes',
        'number' => '+40%',
        'copy' => 'das operações com acompanhamento dedicado relatam ganho de previsibilidade no ciclo de coleta e entrega.',
        'link_label' => 'Conheça as soluções por segmento',
        'link_href' => '/uppertruck/para-empresas.php',
    ],
    [
        'icon' => 'package-check',
        'title' => 'Distribuição',
        'active' => false,
        'image' => '/uppertruck/img/distribuicao.png',
        'alt' => 'Centro de distribuição com expedição organizada',
        'caption' => 'Fluxos de distribuição com conferência e rastreabilidade',
        'label' => 'Distribuição em escala nacional',
        'number' => '+28%',
        'copy' => 'de melhoria na aderência de prazo em operações com roteirização e acompanhamento de ponta a ponta.',
        'link_label' => 'Conheça as soluções para distribuição',
        'link_href' => '/uppertruck/solucoes/consolidacao-de-cargas.php',
    ],
    [
        'icon' => 'store',
        'title' => 'E-commerce',
        'active' => false,
        'image' => '/uppertruck/img/ecoomerce.png',
        'alt' => 'Operação de e-commerce com equipe e frota dedicada',
        'caption' => 'Acompanhamento ativo para picos de expedição',
        'label' => 'Capilaridade para e-commerce',
        'number' => '+35%',
        'copy' => 'das operações digitais observam menor lead time com padrão de coleta e entrega monitorada.',
        'link_label' => 'Conheça as soluções para e-commerce',
        'link_href' => '/uppertruck/solucoes/last-mile.php',
    ],
    [
        'icon' => 'clock-3',
        'title' => 'Operações Recorrentes',
        'active' => false,
        'image' => '/uppertruck/img/operacoes-recorrentes.png',
        'alt' => 'Equipe em operação recorrente de carga',
        'caption' => 'Janelas recorrentes com protocolo operacional validado',
        'label' => 'Método para rotinas críticas',
        'number' => '+30%',
        'copy' => 'de ganho operacional em ciclos frequentes com governança de SLA e comunicação estruturada.',
        'link_label' => 'Conheça as soluções para operações recorrentes',
        'link_href' => '/uppertruck/para-empresas.php',
    ],
    [
        'icon' => 'truck',
        'title' => 'Cargas Sob Demanda',
        'active' => false,
        'image' => '/uppertruck/img/cargas-sob-demanda.png',
        'alt' => 'Frota em rota para operações sob demanda',
        'caption' => 'Resposta ágil para embarques pontuais',
        'label' => 'Elasticidade para necessidades pontuais',
        'number' => '+24%',
        'copy' => 'de redução de tempo de resposta em embarques urgentes com validação operacional e controle de risco.',
        'link_label' => 'Fale com especialista para cargas sob demanda',
        'link_href' => '/uppertruck/cotacao-contato/falar-com-especialista.php',
    ],
];

$segmentoAtivo = $segmentosHub[0];
foreach ($segmentosHub as $item) {
    if (!empty($item['active'])) {
        $segmentoAtivo = $item;
        break;
    }
}
?>
<section class="section-shell segment-hub" id="segmentos-hub">
    <div class="container">
        <div class="section-head segment-hub-head reveal">
            <p class="eyebrow">Segmentos Atendidos</p>
            <h2>Operação sob medida</h2>
            <p>
                Da indústria ao e-commerce, estruturamos a malha com método operacional, atendimento nacional e execução consistente.
            </p>
        </div>

        <div class="segment-hub-showcase" data-segment-hub>
            <aside class="segment-hub-nav reveal">
                <ul>
                    <?php foreach ($segmentosHub as $item): ?>
                        <li class="segment-nav-item<?php echo !empty($item['active']) ? ' is-active' : ''; ?>">
                            <button
                                type="button"
                                class="segment-nav-trigger"
                                data-segment-title="<?php echo htmlspecialchars($item['title'], ENT_QUOTES, 'UTF-8'); ?>"
                                data-segment-image="<?php echo htmlspecialchars($item['image'], ENT_QUOTES, 'UTF-8'); ?>"
                                data-segment-alt="<?php echo htmlspecialchars($item['alt'], ENT_QUOTES, 'UTF-8'); ?>"
                                data-segment-caption="<?php echo htmlspecialchars($item['caption'], ENT_QUOTES, 'UTF-8'); ?>"
                                data-segment-label="<?php echo htmlspecialchars($item['label'], ENT_QUOTES, 'UTF-8'); ?>"
                                data-segment-number="<?php echo htmlspecialchars($item['number'], ENT_QUOTES, 'UTF-8'); ?>"
                                data-segment-copy="<?php echo htmlspecialchars($item['copy'], ENT_QUOTES, 'UTF-8'); ?>"
                                data-segment-link-label="<?php echo htmlspecialchars($item['link_label'], ENT_QUOTES, 'UTF-8'); ?>"
                                data-segment-link-href="<?php echo htmlspecialchars($item['link_href'], ENT_QUOTES, 'UTF-8'); ?>"
                                aria-label="<?php echo htmlspecialchars('Ver conteúdo de ' . $item['title'], ENT_QUOTES, 'UTF-8'); ?>"
                            >
                                <span class="segment-nav-icon"><i data-lucide="<?php echo htmlspecialchars($item['icon'], ENT_QUOTES, 'UTF-8'); ?>"></i></span>
                                <span><?php echo htmlspecialchars($item['title'], ENT_QUOTES, 'UTF-8'); ?></span>
                            </button>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </aside>

            <figure class="segment-hub-media reveal" style="--delay: 70ms">
                <img data-segment-media-image src="<?php echo htmlspecialchars($segmentoAtivo['image'], ENT_QUOTES, 'UTF-8'); ?>" alt="<?php echo htmlspecialchars($segmentoAtivo['alt'], ENT_QUOTES, 'UTF-8'); ?>" loading="lazy" decoding="async">
                <figcaption>
                    <i data-lucide="radar"></i>
                    <span data-segment-media-caption><?php echo htmlspecialchars($segmentoAtivo['caption'], ENT_QUOTES, 'UTF-8'); ?></span>
                </figcaption>
            </figure>

            <article class="segment-hub-highlight reveal" style="--delay: 120ms">
                <p class="segment-highlight-label" data-segment-output-label><?php echo htmlspecialchars($segmentoAtivo['label'], ENT_QUOTES, 'UTF-8'); ?></p>
                <p class="segment-highlight-number" data-segment-output-number><?php echo htmlspecialchars($segmentoAtivo['number'], ENT_QUOTES, 'UTF-8'); ?></p>
                <p class="segment-highlight-copy" data-segment-output-copy>
                    <?php echo htmlspecialchars($segmentoAtivo['copy'], ENT_QUOTES, 'UTF-8'); ?>
                </p>
                <a class="text-link segment-highlight-link" data-segment-output-link href="<?php echo htmlspecialchars($segmentoAtivo['link_href'], ENT_QUOTES, 'UTF-8'); ?>">
                    <span data-segment-output-link-label><?php echo htmlspecialchars($segmentoAtivo['link_label'], ENT_QUOTES, 'UTF-8'); ?></span>
                    <i data-lucide="arrow-right"></i>
                </a>
            </article>
        </div>
    </div>
</section>
