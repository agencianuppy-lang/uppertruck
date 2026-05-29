<?php
$segmentosHub = [
    [
        'icon' => 'factory',
        'title' => 'Industria',
        'active' => false,
        'image' => '/uppertruck/img/upper5.png',
        'alt' => 'Operacao industrial com monitoramento logistico da Uppertruck',
        'caption' => 'Operacao industrial com leitura continua de produtividade',
        'label' => 'Performance na cadeia industrial',
        'number' => '+32%',
        'copy' => 'das operacoes industriais monitoradas relatam reducao de ruptura e melhor controle de janela de entrega.',
        'link_label' => 'Conheca as solucoes para industria',
        'link_href' => '/uppertruck/para-empresas.php',
    ],
    [
        'icon' => 'shopping-bag',
        'title' => 'Varejo',
        'active' => true,
        'image' => '/uppertruck/img/varejo.png',
        'alt' => 'Equipe operacional em centro logistico da Uppertruck',
        'caption' => 'Operacao monitorada com leitura continua de status',
        'label' => 'Performance em operacoes recorrentes',
        'number' => '+40%',
        'copy' => 'das operacoes com acompanhamento dedicado relatam ganho de previsibilidade no ciclo de coleta e entrega.',
        'link_label' => 'Conheca as solucoes por segmento',
        'link_href' => '/uppertruck/para-empresas.php',
    ],
    [
        'icon' => 'package-check',
        'title' => 'Distribuicao',
        'active' => false,
        'image' => '/uppertruck/img/distribuicao.png',
        'alt' => 'Centro de distribuicao com expedicao organizada',
        'caption' => 'Fluxos de distribuicao com conferencia e rastreabilidade',
        'label' => 'Distribuicao em escala nacional',
        'number' => '+28%',
        'copy' => 'de melhoria na aderencia de prazo em operacoes com roteirizacao e acompanhamento de ponta a ponta.',
        'link_label' => 'Conheca as solucoes para distribuicao',
        'link_href' => '/uppertruck/solucoes/consolidacao-de-cargas.php',
    ],
    [
        'icon' => 'store',
        'title' => 'E-commerce',
        'active' => false,
        'image' => '/uppertruck/img/ecoomerce.png',
        'alt' => 'Operacao de e-commerce com equipe e frota dedicada',
        'caption' => 'Acompanhamento ativo para picos de expedicao',
        'label' => 'Capilaridade para e-commerce',
        'number' => '+35%',
        'copy' => 'das operacoes digitais observam menor lead time com padrao de coleta e entrega monitorada.',
        'link_label' => 'Conheca as solucoes para e-commerce',
        'link_href' => '/uppertruck/solucoes/last-mile.php',
    ],
    [
        'icon' => 'clock-3',
        'title' => 'Operacoes Recorrentes',
        'active' => false,
        'image' => '/uppertruck/img/operacoes-recorrentes.png',
        'alt' => 'Equipe em operacao recorrente de carga',
        'caption' => 'Janelas recorrentes com protocolo operacional validado',
        'label' => 'Metodo para rotinas criticas',
        'number' => '+30%',
        'copy' => 'de ganho operacional em ciclos frequentes com governanca de SLA e comunicacao estruturada.',
        'link_label' => 'Conheca as solucoes para operacoes recorrentes',
        'link_href' => '/uppertruck/para-empresas.php',
    ],
    [
        'icon' => 'truck',
        'title' => 'Cargas Sob Demanda',
        'active' => false,
        'image' => '/uppertruck/img/cargas-sob-demanda.png',
        'alt' => 'Frota em rota para operacoes sob demanda',
        'caption' => 'Resposta agil para embarques pontuais',
        'label' => 'Elasticidade para necessidades pontuais',
        'number' => '+24%',
        'copy' => 'de reducao de tempo de resposta em embarques urgentes com validacao operacional e controle de risco.',
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
            <h2>OperaÃ§Ã£o sob medida</h2>
            <p>
                Da industria ao e-commerce, estruturamos a malha com metodo operacional, atendimento nacional e execucao consistente.
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
                                aria-label="<?php echo htmlspecialchars('Ver conteudo de ' . $item['title'], ENT_QUOTES, 'UTF-8'); ?>"
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
