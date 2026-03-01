<?php
// /geradordecontrato/partials/contrato_view.php
// Espera: $contrato (array)

if(!$contrato){ ?>
<div class="container py-5">
    <div class="alert alert-danger">Contrato não encontrado.</div>
</div>
<?php return; } ?>

<div class="container py-5">



    <div class="card mb-4 shadow-sm">
        <div class="card-header text-white" style="background-color:#093663 !important;">
            <div class="text-center">
                <h3 class="m-0 font-weight-bold"><br>CONTRATO DE PRESTAÇÃO DE SERVIÇOS <br> DE TRANSPORTE RODOVIÁRIO
                    DE
                    CARGAS<br><br>
                </h3>
                <small>
                    CNPJ: 24.940.831/0001-01<br>
                    Av. Paulista, 726 Sl 21 Caixa Postal 387<br>
                    SÃO PAULO (SP)<br>
                    <a href="mailto:contratacao@uppertruck.com" class="text-white">contratacao@uppertruck.com</a> |
                    <a href="https://www.uppertruck.com" target="_blank"
                        class="text-white">www.uppertruck.com</a><br><br>
                </small>
            </div>
        </div>

        <div class="card-body bg-light">

            <!-- TOMADOR -->
            <div class="card mb-3 shadow-sm">
                <div class="card-header bg-dark text-white"><strong>Tomador</strong></div>
                <div class="card-body p-0">
                    <table class="table table-bordered bg-white mb-0">
                        <tbody>
                            <tr>
                                <td class="col-md-6">
                                    <b>Tomador do Serviço:</b><br>
                                    <?= htmlspecialchars($contrato['tomador_nome']) ?>
                                </td>
                                <td class="col-md-6">
                                    <b>Dados do tomador (CPF/CNPJ):</b><br>
                                    <?= htmlspecialchars($contrato['tomador_doc']) ?>
                                </td>
                            </tr>
                            <tr>
                                <td class="col-md-6">
                                    <b>Solicitante Tel:</b><br>
                                    <?= htmlspecialchars($contrato['solicitante_tel']) ?>
                                </td>
                                <td class="col-md-6">
                                    <b>E-mail de contato:</b><br>
                                    <?= htmlspecialchars($contrato['email']) ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- COLETA & ENTREGA -->
            <div class="card mb-3 shadow-sm">
                <div class="card-header bg-dark text-white"><strong>Coleta & Entrega</strong></div>
                <div class="card-body p-0">
                    <table class="table table-bordered bg-white mb-0">
                        <tbody>
                            <tr>
                                <td class="col-md-6">
                                    <b>Local de coleta:</b><br>
                                    <?= htmlspecialchars($contrato['end_coleta']) ?>
                                </td>
                                <td class="col-md-6">
                                    <b>Local de entrega:</b><br>
                                    <?= htmlspecialchars($contrato['end_entrega']) ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- CARGA -->
            <div class="card mb-3 shadow-sm">
                <div class="card-header bg-dark text-white"><strong>Carga</strong></div>
                <div class="card-body p-0">
                    <table class="table table-bordered bg-white mb-0">
                        <tbody>
                            <tr>
                                <td class="col-md-6">
                                    <b>Produto:</b><br>
                                    <?= htmlspecialchars($contrato['produto']) ?>
                                </td>
                                <td class="col-md-6">
                                    <b>Medidas unitárias:</b><br>
                                    <?= htmlspecialchars($contrato['medidas']) ?>
                                </td>
                            </tr>
                            <tr>
                                <td class="col-md-6">
                                    <b>Quantidade:</b><br>
                                    <?= htmlspecialchars($contrato['quantidade']) ?>
                                </td>
                                <td class="col-md-6">
                                    <b>Unitização:</b><br>
                                    <?= htmlspecialchars($contrato['unitizacao']) ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- PESO & CUBAGEM -->
            <div class="card mb-3 shadow-sm">
                <div class="card-header bg-dark text-white"><strong>Peso & Cubagem</strong></div>
                <div class="card-body p-0">
                    <table class="table table-bordered bg-white mb-0">
                        <tbody>
                            <tr>
                                <td class="col-md-6">
                                    <b>Peso total:</b><br>
                                    <?= htmlspecialchars($contrato['peso_total_kg']) ?> kg
                                </td>
                                <td class="col-md-6">
                                    <b>Cubagem total:</b><br>
                                    <?= htmlspecialchars($contrato['cubagem_m3']) ?> m³
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>



            <div class="card mb-3 shadow-sm">
                <div class="card-header bg-dark text-white"><strong>Financeiro & Outros Dados</strong></div>
                <div class="card-body p-0">
                    <table class="table table-bordered bg-white mb-0">
                        <tbody>
                            <tr>
                                <td class="col-md-6">
                                    <b>Valor do frete:</b><br>
                                    R$
                                    <?= number_format((float)$contrato['valor_frete'], 2, ',', '.') ?>
                                </td>
                                <td class="col-md-6">
                                    <b>Seguro:</b><br>
                                    <?php
              $seguros = [];
              if (!empty($contrato['seguro_perda_total_parcial'])) $seguros[] = 'Perda Total/Parcial';
              if (!empty($contrato['seguro_roubo'])) $seguros[] = 'Roubo';
              if (!empty($contrato['seguro_avarias'])) $seguros[] = 'Avarias';
              if (!empty($contrato['seguro_ambiental'])) $seguros[] = 'Ambiental';
              echo $seguros ? implode(', ', $seguros) : '—';
            ?>
                                </td>
                            </tr>
                            <tr>
                                <td class="col-md-6">
                                    <b>Prazo:</b><br>
                                    <?= htmlspecialchars($contrato['prazo_entrega'] ?: '—') ?>
                                </td>
                                <td class="col-md-6">
                                    <b>Extras:</b><br>
                                    <?= htmlspecialchars($contrato['extras'] ?: '—') ?>
                                </td>
                            </tr>
                            <tr>
                                <td class="col-md-6">
                                    <b>Pagamento:</b><br>
                                    <?= htmlspecialchars($contrato['pagamento_via'] ?: '—') ?>
                                </td>
                                <td class="col-md-6">
                                    <b>Demonstracao:</b><br>
                                    <?= htmlspecialchars($contrato['demonstracao_via'] ?: '—') ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>




            <div class="col-md-12"><br>
                <hr>
            </div>

            <!-- CLÁUSULAS -->
            <h5 class="mt-4"><strong> Cláusulas do Contrato</strong></h5> <br>
            <div class="bg-white border rounded p-4">
                <p><b>1 – PARTES</b></p>
                <p>1.1. <b>CONTRATANTE:</b> Pessoa física ou jurídica legalmente cadastrada nos bancos de dados
                    governamentais conforme a legislação brasileira.</p>
                <p>1.2. <b>CONTRATADA:</b> UPPERTRUCK EXPRESS, pessoa jurídica regularmente constituída, doravante
                    denominada transportadora.</p>

                <p><b>2 – OBJETO DO CONTRATO</b></p>
                <p>2.1. O presente contrato tem como objeto a prestação de serviços de transporte rodoviário de cargas
                    em território nacional brasileiro, com pagamento sob demanda, nas modalidades fracionada ou
                    dedicada, sob o sistema de consolidação e otimização.</p>

                <p><b>3 – CONTRATAÇÃO E UTILIZAÇÃO DOS SERVIÇOS</b></p>
                <p>3.1. A Uppertruck Express garante a prestação do serviço com segurança, sigilo e integridade das
                    cargas.</p>
                <p>3.2. Avaliações públicas da Uppertruck estão disponíveis na web <a href="https://g.co/kgs/dCGCkN6"
                        target="_blank">https://g.co/kgs/dCGCkN6</a></p>
                <p>3.3. Para confirmação de embarque, serão cobrados à título de compromisso, 10% do valor do frete, via
                    depósito em conta da Uppertruck Express com taxa não reembolsável em casos de cancelamentos não
                    justificados.</p>
                <p>3.4. Após confirmação, o prazo mínimo de agendamento para coleta é de 24h a 48h úteis.</p>
                <p>3.5. A Uppertruck Express não se responsabiliza por pendências fiscais da contratante que possam
                    acarretar retenções em postos fiscais.</p>
                <p>3.6. Em caso de retenção do veículo por fiscalização, serão cobradas diárias proporcionais ao tempo
                    de parada.</p>
                <p>3.7. Carga e descarga terão tolerância de até 5h. Após esse período, serão cobradas horas adicionais
                    sob tabela prevista na legislação federal.</p>
                <p>3.8. Endereços errados (erro superior a 2km) gerarão taxa de deslocamento perdido.</p>
                <p>3.9. Acesso difícil ou inadequado (ruas não pavimentadas, bloqueadas, com fiação baixa ou restrições)
                    acarretará taxa adicional.</p>
                <p>3.10. A Uppertruck Express realizará uma tentativa de entrega agendada. A partir da segunda
                    tentativa, será cobrada taxa de reentrega, se houver espera superior a 60 minutos ou deslocamento
                    acima de 2km.</p>
                <p>3.11. A contratante deve disponibilizar colaborador apto a receber a carga, conferi-la e assinar os
                    documentos.</p>
                <p>3.12. Por padrão de segurança, os motoristas não estão autorizados a manusear a carga.</p>
                <p>3.13. No ato da entrega, o destinatário/representante deve conferir a quantidade e o estado do
                    material recebido antes de assinar o canhoto/comprovante.</p>
                <p>3.14. Após a conferência e a assinatura do canhoto/comprovante de entrega, a transportadora não se
                    responsabiliza por avarias ou faltas não registradas no momento do recebimento.</p>
                <p>3.15. As cotações de frete consideram entregas em zona urbana. Entregas em zona rural, áreas de
                    difícil acesso ou não pavimentadas devem ser informadas no ato da cotação e estarão sujeitas a
                    custos
                    e prazos diferenciados.</p>

                <p><b>4 – SEGURO DA CARGA</b></p>
                <p>4.1. A Uppertruck Express oferece até três modalidades de seguro, conforme legislação federal,
                    conhecidos por RCT-RC, RCF-DC e AV.</p>
                <p>4.2. Coberturas incluem: amassamento, abalroamento, fissura, perda total ou parcial, roubo/desvio –
                    apenas durante o transporte.</p>
                <p>4.3. Movimentação de carga na coleta ou entrega não está incluída e deve ser contratada à parte.</p>
                <p>4.4. É obrigatório o envio do XML da nota fiscal para: <a
                        href="mailto:cte@uppertruck.com">cte@uppertruck.com</a></p>
                <p>4.5. Produtos sem nota fiscal não terão cobertura.</p>
                <p>4.6. Há cobertura adicional de avarias para produtos novos de fábrica.</p>
                <p>4.7. Serviços de ajudantes ou máquinas são cobrados à parte, sem cobertura de seguro.</p>
                <p>4.8. Em caso de sinistro, o valor de reembolso será o indicado na nota fiscal.</p>
                <p>4.9. Há franquia de 10% do valor total da nota fiscal para acionamento do seguro.</p>
                <p>4.10. O sinistro deve ser comunicado imediatamente, com fotos e vídeos no ato do recebimento.</p>
                <p>4.11. O prazo para análise, reembolso ou indenização é de até 30 dias úteis após a abertura do
                    sinistro.</p>
                <p>4.12. A seguradora pode ou não enviar perito, e é ela quem define o tipo e extensão da indenização
                    (total ou parcial).</p>
                <p>4.13. O contratante poderá escolher entre indenização em valor monetário ou reposição dos produtos,
                    conforme diretrizes da seguradora.</p>

                <p><b>5 – DIREITO DE IMAGEM</b></p>
                <p>5.1. A contratante autoriza o uso de imagens e vídeos do transporte para fins de marketing e
                    segurança operacional.</p>
                <p>5.2. A Uppertruck Express garante o sigilo de informações e cumprimento da Lei Geral de Proteção de
                    Dados (LGPD).</p>

                <p><b>6 – PAGAMENTO</b></p>
                <p>6.1. No ato da contratação, será devido o pagamento de 10% (dez por cento) do valor do frete,
                    referente ao fechamento do contrato.</p>
                <p>6.2. O valor restante deverá ser quitado até a entrega do material no destino final.</p>
                <p>6.3. Observação: as condições financeiras específicas podem ser tratadas diretamente com o setor
                    financeiro no momento da contratação, podendo ser concedidos prazos diferenciados para clientes
                    previamente autorizados.</p>
                <p>6.4. Prazos ou parcelamentos estarão sujeitos à análise do setor financeiro da Uppertruck Express.
                </p>
                <p>6.5. Formas de pagamento: PIX e boleto bancário.</p>
                <p>6.6. Outros métodos (PayPal, PicPay, Mercado Pago, Criptomoedas) terão acréscimo de até 10% no valor
                    total.</p>
                <p>6.7. Na modalidade “Buy Now, Pay Later” (contrate e pague na entrega), a descarga somente ocorrerá
                    após a confirmação do pagamento.</p>
                <p>6.8. Pagamentos deverão ser feitos em contas bancárias identificadas com o CNPJ da Uppertruck
                    Express.</p>
                <p>6.9. Dúvidas relacionadas ao pagamento poderão ser tratadas diretamente com o(a) executivo(a) de
                    conta Uppertruck Express.</p>

                <p><b>7 – CLÁUSULA FINAL – DISPOSIÇÕES JURÍDICAS</b></p>
                <p>7.1. O presente contrato tem validade legal entre as partes a partir do momento de sua assinatura
                    eletrônica, física ou da contratação efetiva do serviço.</p>
                <p>7.2. Fica eleito o foro da Comarca de [CIDADE/UF], com renúncia de qualquer outro, por mais
                    privilegiado que seja, para dirimir quaisquer dúvidas ou conflitos oriundos deste contrato.</p>
                <p>7.3. As partes declaram que leram, compreenderam e concordam com todas as cláusulas aqui estipuladas,
                    comprometendo-se a cumpri-las integralmente.</p>
                <p>7.4. Este contrato é parte integrante dos documentos jurídicos e operacionais da Uppertruck Express,
                    sendo de uso exclusivo entre as partes, com proteção legal garantida pela legislação brasileira
                    vigente.</p>
                <p>7.5. Aceitando os termos deste contrato, será gerado um token de verificação e autenticidade pelo
                    qual recebemos o documento como assinatura digital.</p>
                <p>7.6. Uma via deste documento poderá ser solicitada em modo PDF.</p>
            </div>


        </div>
    </div>
</div>

<?php
// ===============================
// BLOCO FINAL — ASSINATURA
// ===============================
$temAssinatura = !empty($contrato['assinatura_path'] ?? '');
?>

<?php if ($temAssinatura): ?>
<div class="container pb-5">
    <div class="card mt-4 shadow-sm">
        <div class="card-header bg-dark text-white">
            <strong>Assinatura do Cliente</strong>
        </div>
        <div class="card-body">
            <div class="row align-items-center">
                <div class="col-md-6 mb-3 mb-md-0">
                    <div class="border rounded p-2 bg-white text-center">
                        <img src="<?= htmlspecialchars($contrato['assinatura_path']) ?>" alt="Assinatura do cliente"
                            class="img-fluid" style="max-height:220px; object-fit:contain;">
                    </div>
                </div>
                <div class="col-md-6">
                    <p class="mb-1">
                        <strong>Nome:</strong>
                        <?= htmlspecialchars($contrato['assinatura_nome'] ?? '—') ?>
                    </p>
                    <p class="mb-1">
                        <strong>Assinado em:</strong>
                        <?= !empty($contrato['assinatura_at'])
                ? date('d/m/Y H:i', strtotime($contrato['assinatura_at']))
                : '—'
              ?>
                    </p>

                    <a class="btn btn-outline-primary btn-sm mt-2"
                        href="<?= htmlspecialchars($contrato['assinatura_path']) ?>" download target="_blank"
                        rel="noopener">
                        Baixar assinatura
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>