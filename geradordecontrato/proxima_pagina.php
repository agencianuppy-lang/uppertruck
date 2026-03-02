<?php
session_start();
if (!isset($_SESSION['user_id'])) { header("Location: index.php"); exit(); }

$prefill = [];
$modoReutilizacao = false;
$contratoBaseId = 0;

if (isset($_GET['clonar'])) {
    $contratoBaseId = (int) $_GET['clonar'];

    if ($contratoBaseId > 0) {
        include "conexao/key.php";

        $stmt = $conn->prepare("SELECT
            email, tomador_nome, tomador_doc, solicitante_tel,
            end_coleta, end_entrega,
            produto, medidas, unitizacao, quantidade, peso_total_kg, cubagem_m3,
            valor_frete, pagamento_via, demonstracao_via,
            seguro_perda_total_parcial, seguro_roubo, seguro_avarias, seguro_ambiental,
            prazo_entrega, extras
            FROM contratos
            WHERE id = ?
            LIMIT 1");

        if ($stmt) {
            $stmt->bind_param("i", $contratoBaseId);
            $stmt->execute();
            $result = $stmt->get_result();
            $prefill = $result ? ($result->fetch_assoc() ?: []) : [];
            $modoReutilizacao = !empty($prefill);
            $stmt->close();
        }

        $conn->close();
    }
}

$prefillJson = json_encode(
    $prefill,
    JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT
);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Uppertruck | Gerador de Contrato</title>
    <!-- Inclua o link para o Bootstrap CSS -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/png" href="../img/fav.png" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

</head>
<style>
    .selecione {
        width: 100%;
        font-weight: 900;
        font-size: 1.5rem;
        margin-left: -3rem;
        color: #ff008d;
        text-transform: uppercase;
    }

    .h2,
    h2 {
        font-size: 3rem;
        text-align: center;
        text-transform: uppercase;
        font-weight: 900;
        color: white;
    }

    body {
        background: #ff008d;
        height: 100vh !important;
        background-size: cover;
        margin-bottom: 3rem;
        font-family: 'Poppins', sans-serif;
    }

    .form-check {
        position: relative;
        padding: 0rem;
        border-bottom: 1px solid #80808024;
        display: block;
    }

    .form-check-input[type="checkbox"] {
        transform: scale(1.5);
        background-color: pink;
        margin-top: 1.4rem;
        border-color: pink;
    }

    .form-check-label {
        margin-bottom: 0;
        cursor: pointer;
        width: 100%;
        padding: 1rem;
    }

    .caixa {
        background: white;
        padding: 4rem;
        box-shadow: 6px 7px 8px #cc0272;
        border-radius: 19px;
    }

    .col-md-6 {
        -ms-flex: 0 0 50%;
        flex: 0 0 49%;
        max-width: 49%;
        margin-left: 1%;
    }

    /* Estilo personalizado para os checkboxes */
    .form-check-input[type="checkbox"] {
        transform: scale(1.5);
        /* Aumenta o tamanho dos checkboxes */
        background-color: pink;
        /* Define a cor de fundo rosa */
        border-color: pink;
        /* Define a cor da borda rosa */
    }

    .form-group {
        margin-bottom: 1rem;
        width: 100%;
        margin-left: -9%;
    }

    .btn-primary {
        font-weight: 700;
        font-size: 1.5rem;
        color: #fff;
        background-color: #7c00ff;
        /* border-color: #ffffff; */
        border-radius: 13px;
        border: 2px solid #ff008d;
        margin-top: 3rem;
        padding: 1rem 3rem;
    }

    p {
        margin-top: 0;
        margin-bottom: 1rem;
        text-align: left;
        margin-left: -9%;
        color: gray;
        font-size: 0.8rem;
    }

    .alerta {
        color: white;
        padding: 0rem;
        background: #ff008d;
        padding: 0rem 0.5rem;
        border-radius: 5px;
        margin-right: 0.5rem;
    }

    .icone {
        width: 41px;
        position: absolute;
        right: 0;
        top: 8px;
    }

    .contratos {
        color: white !important;
        position: absolute;
        top: 0;
        font-size: 1rem;
        background: #ff008d;
        right: 12%;
        border: 2px solid white;
    }

    .contratos2 {
        color: white !important;
        position: absolute;
        top: 0;
        font-size: 1rem;
        background: #ff008d;
        right: 3%;
        border: 2px solid white;
    }

    .contratos2:hover {
        color: #ff008d !important;
        position: absolute;
        top: 0;
        font-size: 1rem;
        background: #ffffff;
        right: 3%;
        border: 2px solid white;
    }

    .contratos:hover {
        color: #ff008d !important;
        position: absolute;
        top: 0;
        font-size: 1rem;
        background: #ffffff;
        border: 2px solid white;
    }

    .alerta-validacao {
        color: #ff008d;
        position: absolute;
        font-size: 11px;
        font-weight: 700;
    }

    .form-group {
        margin-bottom: 2rem;
        width: 100%;
        margin-left: 0%;
    }

    @media(max-width:748px) {
        .col-md-6 {
            -ms-flex: 0 0 100%;
            flex: 0 0 100%;
            max-width: 100%;
            margin-left: 0%;
            margin-bottom: 1rem;
        }
    }

    .navbar-expand-lg .navbar-nav .nav-link {
        padding-right: 4.5rem;
        padding-left: .5rem;
    }
</style>

<body>


    <nav class="navbar navbar-expand-lg navbar-dark" style="background-color:#ffffff;">
        <div class="container">

            <!-- Logo -->
            <a class="navbar-brand d-flex align-items-center" href="contratos.php">
                <img src="https://www.uppertruck.com/assets/img/logo/logo.png" alt="Uppertruck" height="40"
                    class="mr-2">
            </a>

            <!-- Botão Mobile -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Links -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">

                    <li class="nav-item">
                        <a class="nav-link" href="proxima_pagina.php" style="color:black">
                            <i class="bi bi-file-text"></i> Gerar contrato novo
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="contratos.php" style="color:black">
                            <i class="bi bi-list-ul"></i> Lista de Contratos
                        </a>
                    </li>

                    <li class="nav-item">
                        <form method="POST" action="logout.php" class="mb-0">
                            <button type="submit" name="logout" class="btn btn-danger btn-sm ml-lg-3">
                                <i class="bi bi-box-arrow-right"></i> Sair
                            </button>
                        </form>
                    </li>

                </ul>
            </div>

        </div>
    </nav>

    <!-- Bootstrap + Icons -->


    <div class="container py-5">

        <style>
            :root {
                --utt-pink: #ff008d;
                --utt-primary: #7c00ff;
                --utt-dark: #1b1b1b;
            }

            body {
                background: var(--utt-pink)
            }

            .wizard {
                max-width: 980px;
                margin: 0 auto
            }

            .stepper {
                display: flex;
                justify-content: space-between;
                margin-bottom: 24px;
                position: relative
            }

            .stepper:before {
                content: "";
                position: absolute;
                left: 0;
                right: 0;
                top: 20px;
                height: 4px;
                background: #eee;
                border-radius: 2px
            }

            .step {
                position: relative;
                z-index: 2;
                text-align: center;
                flex: 1
            }

            .step .dot {
                width: 40px;
                height: 40px;
                border-radius: 50%;
                display: inline-flex;
                align-items: center;
                justify-content: center;
                background: #e9e9ef;
                color: #777;
                font-weight: 700;
                border: 3px solid #fff;
                box-shadow: 0 2px 6px rgba(0, 0, 0, .08)
            }

            .step.active .dot {
                background: var(--utt-primary);
                color: #fff
            }

            .step.done .dot {
                background: #18b26b;
                color: #fff
            }

            .step label {
                display: block;
                margin-top: 8px;
                color: #333;
                font-weight: 700;
                font-size: .9rem
            }

            .card-utt {
                background: #fff;
                border-radius: 16px;
                box-shadow: 0 12px 28px rgba(0, 0, 0, .12);
                overflow: auto;
            }

            .card-utt .card-header {
                background: var(--utt-dark);
                color: #fff;
                padding: 1rem 1.25rem;
                font-weight: 800;
                text-transform: uppercase
            }

            .card-utt .card-body {
                padding: 1.5rem
            }

            .form-group {
                margin-bottom: 1rem
            }

            .form-control {
                height: 48px;
                border-radius: 12px;
                border: 1px solid #e7e7e9
            }

            .form-control:focus {
                border-color: var(--utt-primary);
                box-shadow: 0 0 0 .15rem rgba(124, 0, 255, .15)
            }

            .custom-control {
                margin-bottom: .4rem
            }

            .btn-utt {
                background: var(--utt-primary);
                border: 2px solid var(--utt-pink);
                color: #fff;
                border-radius: 12px;
                font-weight: 700
            }

            .btn-ghost {
                background: #fff;
                border: 2px solid #e6e6ea;
                color: #444;
                border-radius: 12px;
                font-weight: 700
            }

            .footer-actions {
                display: flex;
                gap: 12px
            }

            @media (max-width:575.98px) {
                .footer-actions {
                    flex-direction: column
                }
            }

            /* transições */
            .panel {
                display: none;
                opacity: 0;
                transform: translateY(12px);
                transition: all .25s ease
            }

            .panel.active {
                display: block;
                opacity: 1;
                transform: none
            }

            body {
                background: #093663;
            }

            .step label {
                display: block;
                margin-top: 8px;
                color: #ffffff;
                font-weight: 700;
                font-size: .9rem;
            }

            .step.active .dot {
                background: #008eff;
                color: #fff;
            }

            .btn-utt {
                background: #008eff;
                border: 2px solid #008eff;
                color: #fff;
                border-radius: 9px;
                font-weight: 700;
                padding: 1rem;
            }

            .small,
            small {
                font-size: .675em;
                font-weight: 400;
                line-height: 0.1 !important;
            }
        </style>

        <!-- STEPPER -->
        <div class="wizard">
            <?php if ($modoReutilizacao): ?>
                <div class="alert alert-info border-0 mb-4">
                    Dados do contrato #<?= $contratoBaseId ?> carregados como base. Altere o que precisar e salve para gerar um novo contrato sem alterar o original.
                </div>
            <?php endif; ?>

            <div class="stepper mb-4">
                <div class="step" data-step="1">
                    <div class="dot">1</div><label>Tomador</label>
                </div>
                <div class="step" data-step="2">
                    <div class="dot">2</div><label>Coleta & Entrega</label>
                </div>
                <div class="step" data-step="3">
                    <div class="dot">3</div><label>Carga</label>
                </div>
                <div class="step" data-step="4">
                    <div class="dot">4</div><label>Condições & Resumo</label>
                </div>
            </div>

            <form id="form-utt" method="POST" action="salvar_contrato.php">
                <div class="card-utt">

                    <div class="card-header"><span id="title-step">Tomador</span></div>
                    <div class="card-body">

                        <!-- STEP 1 — TOMADOR -->
                        <div class="panel active" data-panel="1">
                            <div class="form-row">
                                <div class="form-group col-md-8">
                                    <label>Tomador do Serviço</label>
                                    <input type="text" class="form-control" name="tomador_nome"
                                        placeholder="*Nome completo ou razão social" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>CPF/CNPJ</label>
                                    <input type="text" class="form-control" name="tomador_doc" id="tomador_doc"
                                        placeholder="*CPF ou CNPJ" inputmode="numeric" autocomplete="off" required>
                                    <small class="text-muted">Digite apenas números. A formatação aparece
                                        automaticamente.</small>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-8">
                                    <label>E-mail de contato</label>
                                    <input type="email" class="form-control" name="email"
                                        placeholder="*email@empresa.com.br" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Solicitante – Telefone</label>
                                    <input type="text" class="form-control" name="solicitante_tel"
                                        placeholder="*Telefone/WhatsApp" required>
                                </div>
                            </div>
                        </div>

                        <!-- STEP 2 — COLETA/ENTREGA -->
                        <div class="panel" data-panel="2">
                            <div class="form-group">
                                <label>Local Coleta</label>
                                <input type="text" class="form-control" name="end_coleta"
                                    placeholder="*Endereço completo com cidade/UF" required>
                            </div>
                            <div class="form-group">
                                <label>Local Entrega</label>
                                <input type="text" class="form-control" name="end_entrega"
                                    placeholder="*Endereço completo com cidade/UF" required>
                            </div>
                        </div>

                        <!-- STEP 3 — CARGA -->
                        <div class="panel" data-panel="3">
                            <div class="form-group">
                                <label>Produto</label>
                                <input type="text" class="form-control" name="produto"
                                    placeholder="*Tipo de produto/material transportado" required>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>Medidas unitárias (CxLxA)</label>
                                    <input type="text" class="form-control" name="medidas"
                                        placeholder="Ex.: 120x100x150">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Unitização</label>
                                    <select class="form-control" name="unitizacao" id="unitizacao" required>
                                        <option value="">Selecione</option>
                                        <option value="Granel">Granel</option>
                                        <option value="Tubos">Tubos</option>
                                        <option value="Pallet">Pallet</option>
                                        <option value="Caixa">Caixa</option>
                                        <option value="Saco">Saco</option>
                                        <option value="Engradado">Engradado</option>
                                        <option value="Outros">Outros</option>
                                    </select>

                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label>Quantidade (Volumetria/Unid.)</label>
                                    <input type="number" class="form-control" name="quantidade"
                                        placeholder="*Volumetria/Qtde" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Peso total (kg)</label>
                                    <input type="text" step="0.001" min="0" class="form-control" name="peso_total_kg"
                                        placeholder="*Ex.: 850.000" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Cubagem total (m³)</label>
                                    <input type="text" step="0.001" min="0" class="form-control" name="cubagem_m3"
                                        placeholder="Ex.: 12.500">
                                </div>
                            </div>
                        </div>

                        <!-- STEP 4 — CONDIÇÕES & RESUMO -->
                        <div class="panel" data-panel="4">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>Valor do frete (R$)</label>
                                    <input type="number" step="0.01" min="0" class="form-control" name="valor_frete"
                                        placeholder="*Ex.: 1450,00" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Prazo de entrega</label>
                                    <select class="form-control" name="prazo_entrega" required>
                                        <option value="">Selecione</option>
                                        <option>1-2 dias</option>
                                        <option>3-5 dias</option>
                                        <option>7-10 dias</option>
                                        <option> 15-20 dias</option>
                                    </select>
                                </div>
                            </div>

                            <label class="d-block font-weight-bold mt-2">Seguro</label>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="seg1"
                                    name="seguro_perda_total_parcial" value="1" checked>
                                <label class="custom-control-label" for="seg1">Perda Total/Parcial</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="seg2" name="seguro_roubo"
                                    value="1">
                                <label class="custom-control-label" for="seg2">Roubo</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="seg3" name="seguro_avarias"
                                    value="1">
                                <label class="custom-control-label" for="seg3">Avarias</label>
                            </div>
                            <div class="custom-control custom-checkbox mb-3">
                                <input type="checkbox" class="custom-control-input" id="seg4" name="seguro_ambiental"
                                    value="1">
                                <label class="custom-control-label" for="seg4">Ambiental</label>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>Pagamento via</label>
                                    <select class="form-control" name="pagamento_via" required>
                                        <option value="">Selecione</option>
                                        <option>TED</option>
                                        <option>PIX</option>
                                        <option>Boleto</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Demonstração via</label>
                                    <select class="form-control" name="demonstracao_via" required>
                                        <option>Recibo</option>
                                        <option>NF Serviço</option>
                                    </select>
                                </div>
                            </div>

                            <div class="small text-muted">
                                ICMS/ST: Recolhido pelo contratante. Coletas/entregas em zona rural ou acesso não
                                pavimentado podem ter acréscimo.
                            </div>

                            <!-- resumo -->
                            <hr>
                            <h6 class="font-weight-bold">Resumo</h6>
                            <div id="resumo" class="text-secondary"></div>
                        </div>

                    </div>

                    <div class="card-footer bg-white border-0 pt-0 pb-4 px-4">
                        <div class="footer-actions">
                            <button type="button" class="btn btn-ghost px-4" id="btnPrev" disabled>Voltar</button>
                            <button type="button" class="btn btn-utt px-4" id="btnNext">Próximo</button>
                            <button type="submit" class="btn btn-utt px-4 d-none" id="btnSubmit">Gerar Contrato</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <script>
            (function () {
                const prefill = <?= $prefillJson ?: '{}' ?>;
                if (!prefill || !Object.keys(prefill).length) return;

                const setValue = (name, value) => {
                    const field = document.querySelector(`[name="${name}"]`);
                    if (!field || value === null || value === undefined) return;
                    field.value = String(value);
                };

                const setChecked = (name, value) => {
                    const field = document.querySelector(`[name="${name}"]`);
                    if (!field) return;
                    field.checked = !!Number(value);
                };

                [
                    'tomador_nome', 'tomador_doc', 'email', 'solicitante_tel',
                    'end_coleta', 'end_entrega',
                    'produto', 'medidas', 'unitizacao', 'quantidade', 'peso_total_kg', 'cubagem_m3',
                    'valor_frete', 'pagamento_via', 'demonstracao_via', 'prazo_entrega'
                ].forEach(name => setValue(name, prefill[name]));

                const docField = document.querySelector('[name="tomador_doc"]');
                if (docField && docField.value) {
                    const digits = docField.value.replace(/\D/g, '');
                    if (digits.length <= 11) {
                        if (digits.length > 9) {
                            docField.value = digits.replace(/^(\d{3})(\d{3})(\d{3})(\d{0,2}).*/, '$1.$2.$3-$4');
                        } else if (digits.length > 6) {
                            docField.value = digits.replace(/^(\d{3})(\d{3})(\d{0,3}).*/, '$1.$2.$3');
                        } else if (digits.length > 3) {
                            docField.value = digits.replace(/^(\d{3})(\d{0,3}).*/, '$1.$2');
                        } else {
                            docField.value = digits;
                        }
                    } else {
                        if (digits.length > 12) {
                            docField.value = digits.replace(/^(\d{2})(\d{3})(\d{3})(\d{4})(\d{0,2}).*/, '$1.$2.$3/$4-$5');
                        } else if (digits.length > 8) {
                            docField.value = digits.replace(/^(\d{2})(\d{3})(\d{3})(\d{0,4}).*/, '$1.$2.$3/$4');
                        } else if (digits.length > 5) {
                            docField.value = digits.replace(/^(\d{2})(\d{3})(\d{0,3}).*/, '$1.$2.$3');
                        } else if (digits.length > 2) {
                            docField.value = digits.replace(/^(\d{2})(\d{0,3}).*/, '$1.$2');
                        } else {
                            docField.value = digits;
                        }
                    }
                }

                setChecked('seguro_perda_total_parcial', prefill.seguro_perda_total_parcial);
                setChecked('seguro_roubo', prefill.seguro_roubo);
                setChecked('seguro_avarias', prefill.seguro_avarias);
                setChecked('seguro_ambiental', prefill.seguro_ambiental);
            })();
        </script>

        <script>
            (function () {
                const steps = [
                    { title: 'Tomador', req: ['tomador_nome', 'tomador_doc', 'email', 'solicitante_tel'] },
                    { title: 'Coleta & Entrega', req: ['end_coleta', 'end_entrega'] },
                    { title: 'Carga', req: ['produto', 'unitizacao', 'quantidade', 'peso_total_kg'] },
                    { title: 'Condições & Resumo', req: ['valor_frete', 'prazo_entrega', 'pagamento_via', 'demonstracao_via'] }
                ];

                let cur = 1;
                const total = steps.length;
                const $ = s => document.querySelector(s);
                const panels = Array.from(document.querySelectorAll('.panel'));
                const stepDots = Array.from(document.querySelectorAll('.step'));
                const title = $('#title-step');
                const btnPrev = $('#btnPrev'), btnNext = $('#btnNext'), btnSubmit = $('#btnSubmit');

                function setStep(n) {
                    cur = Math.max(1, Math.min(total, n));
                    panels.forEach(p => p.classList.toggle('active', +p.dataset.panel === cur));
                    title.textContent = steps[cur - 1].title;

                    stepDots.forEach((el, i) => {
                        el.classList.toggle('active', i + 1 === cur);
                        el.classList.toggle('done', i + 1 < cur);
                    });

                    btnPrev.disabled = (cur === 1);
                    btnNext.classList.toggle('d-none', cur === total);
                    btnSubmit.classList.toggle('d-none', cur !== total);

                    if (cur === total) renderResumo();
                }

                function validateStep() {
                    const reqNames = steps[cur - 1].req;
                    for (const name of reqNames) {
                        const input = document.querySelector(`[name="${name}"]`);
                        if (input && !input.value) {
                            input.focus();
                            input.classList.add('is-invalid');
                            setTimeout(() => input.classList.remove('is-invalid'), 1200);
                            return false;
                        }
                    }
                    return true;
                }

                function renderResumo() {
                    const get = n => (document.querySelector(`[name="${n}"]`) || {}).value || '-';
                    const checks = ['seguro_perda_total_parcial', 'seguro_roubo', 'seguro_avarias', 'seguro_ambiental']
                        .filter(n => document.querySelector(`[name="${n}"]`)?.checked)
                        .map(n => ({ seguro_perda_total_parcial: 'Perda Total/Parcial', seguro_roubo: 'Roubo', seguro_avarias: 'Avarias', seguro_ambiental: 'Ambiental' }[n]));
                    $('#resumo').innerHTML = `
          <div><b>Tomador:</b> ${get('tomador_nome')} (${get('tomador_doc')}) • ${get('email')} / ${get('solicitante_tel')}</div>
          <div><b>Rota:</b> ${get('end_coleta')} → ${get('end_entrega')}</div>
          <div><b>Carga:</b> ${get('produto')} | ${get('unitizacao')} | Qtde ${get('quantidade')} | Peso ${get('peso_total_kg')} kg | Cubagem ${get('cubagem_m3') || '—'} m³</div>
          <div><b>Frete:</b> R$ ${get('valor_frete')} | Prazo ${get('prazo_entrega')} | Pagto ${get('pagamento_via')} | Doc ${get('demonstracao_via')}</div>
          <div><b>Seguro:</b> ${checks.length ? checks.join(', ') : 'Não contratado'}</div>`;
                }

                btnPrev.addEventListener('click', () => setStep(cur - 1));
                btnNext.addEventListener('click', () => { if (validateStep()) setStep(cur + 1); });
                setStep(1);
            })();
        </script>

        <script>
            (function () {
                const docInput = document.getElementById('tomador_doc');

                if (!docInput) return;

                function formatCpf(d) {
                    // 000.000.000-00
                    d = d.slice(0, 11);
                    if (d.length > 9) return d.replace(/^(\d{3})(\d{3})(\d{3})(\d{0,2}).*/, '$1.$2.$3-$4');
                    if (d.length > 6) return d.replace(/^(\d{3})(\d{3})(\d{0,3}).*/, '$1.$2.$3');
                    if (d.length > 3) return d.replace(/^(\d{3})(\d{0,3}).*/, '$1.$2');
                    return d;
                }

                function formatCnpj(d) {
                    // 00.000.000/0000-00
                    d = d.slice(0, 14);
                    if (d.length > 12) return d.replace(/^(\d{2})(\d{3})(\d{3})(\d{4})(\d{0,2}).*/, '$1.$2.$3/$4-$5');
                    if (d.length > 8) return d.replace(/^(\d{2})(\d{3})(\d{3})(\d{0,4}).*/, '$1.$2.$3/$4');
                    if (d.length > 5) return d.replace(/^(\d{2})(\d{3})(\d{0,3}).*/, '$1.$2.$3');
                    if (d.length > 2) return d.replace(/^(\d{2})(\d{0,3}).*/, '$1.$2');
                    return d;
                }

                function maskCpfCnpj(value) {
                    const digits = value.replace(/\D/g, '');
                    if (digits.length <= 11) {
                        return formatCpf(digits);
                    }
                    return formatCnpj(digits);
                }

                // Mascara durante a digitação
                docInput.addEventListener('input', function (e) {
                    const pos = this.selectionStart;
                    const before = this.value;
                    this.value = maskCpfCnpj(this.value);
                    // Ajuste simples do cursor: mantém no fim
                    if (document.activeElement === this) {
                        this.setSelectionRange(this.value.length, this.value.length);
                    }
                });

                // Opcional: validação leve ao sair do campo
                docInput.addEventListener('blur', function () {
                    const digits = this.value.replace(/\D/g, '');
                    if (digits.length !== 11 && digits.length !== 14) {
                        this.classList.add('is-invalid');
                    } else {
                        this.classList.remove('is-invalid');
                    }
                    this.value = maskCpfCnpj(this.value);
                });

                // No submit: envia APENAS os dígitos (limpo) para o backend
                const form = document.getElementById('form-utt');
                if (form) {
                    form.addEventListener('submit', function () {
                        if (docInput.value) {
                            docInput.value = docInput.value.replace(/\D/g, '');
                        }
                    });
                }
            })();
        </script>

    </div>



    <!-- Inclua o link para o Bootstrap JS e jQuery (necessário para alguns recursos do Bootstrap) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Inclua o link para o SweetAlert -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

</body>

</html>
