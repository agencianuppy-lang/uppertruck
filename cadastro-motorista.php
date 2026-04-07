<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Cadastro de Motorista / Contrato de Motorista</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/filepond/4.32.9/filepond.css" rel="stylesheet">
    <link
        href="https://cdn.jsdelivr.net/npm/filepond-plugin-image-preview@4.6.12/dist/filepond-plugin-image-preview.min.css"
        rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/notyf/3.10.0/notyf.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style-fg.css" />
</head>

<body>
    <header class="app-topbar">
        <div class="container py-3 d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center gap-2">
                <span class="app-mark"><i class="bi bi-person-badge"></i></span>
                <div>
                    <div class="app-title">Cadastro de Motorista / Contrato de Motorista</div>
                    <div class="app-subtitle">Formalizacao TAC para transporte rodoviario de cargas</div>
                </div>
            </div>

            <a class="btn btn-light btn-sm app-help" href="#form" title="Ir para o formulario">
                <i class="bi bi-arrow-down-short me-1"></i> Preencher
            </a>
        </div>
    </header>

    <main class="app-main">
        <div class="container py-4 py-lg-5">
            <section class="col-12 col-lg-12" id="form">
                <form id="motoristaForm" class="app-form" novalidate>
                    <div class="card app-card mb-3" id="s1" data-aos="fade-up">
                        <div class="card-body">
                            <div class="app-h">
                                <div class="app-hicon"><i class="bi bi-person-vcard"></i></div>
                                <div>
                                    <h2 class="app-htitle">1. Dados do Contratado (TAC)</h2>
                                    <p class="app-hdesc">Identificacao cadastral do motorista autonomo.</p>
                                </div>
                            </div>

                            <div class="row g-3">
                                <div class="col-12 col-md-6">
                                    <label class="form-label">Nome completo</label>
                                    <input name="nome_completo" class="form-control" type="text"
                                        placeholder="Nome completo do motorista" required>
                                </div>

                                <div class="col-12 col-md-3">
                                    <label class="form-label">CPF</label>
                                    <input id="cpf" name="cpf" class="form-control" type="text"
                                        placeholder="000.000.000-00" required>
                                </div>

                                <div class="col-12 col-md-3">
                                    <label class="form-label">RNTRC (ANTT)</label>
                                    <input name="rntrc" class="form-control" type="text" placeholder="Numero RNTRC"
                                        required>
                                </div>

                                <div class="col-12 col-md-6">
                                    <label class="form-label">WhatsApp</label>
                                    <div class="input-icon">
                                        <i class="bi bi-whatsapp"></i>
                                        <input id="whatsapp" name="whatsapp" class="form-control" type="text"
                                            placeholder="(11) 99999-9999" required>
                                    </div>
                                </div>

                                <div class="col-12 col-md-6">
                                    <label class="form-label">E-mail</label>
                                    <div class="input-icon">
                                        <i class="bi bi-envelope"></i>
                                        <input name="email" class="form-control" type="email"
                                            placeholder="nome@email.com">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card app-card mb-3" id="s2" data-aos="fade-up">
                        <div class="card-body">
                            <div class="app-h">
                                <div class="app-hicon"><i class="bi bi-truck"></i></div>
                                <div>
                                    <h2 class="app-htitle">2. Dados do Veiculo</h2>
                                    <p class="app-hdesc">Informacoes das placas e categoria de transporte.</p>
                                </div>
                            </div>

                            <div class="row g-3">
                                <div class="col-12 col-md-4">
                                    <label class="form-label">Placa Cavalo Mecanico</label>
                                    <input class="form-control js-placa" name="placa_cavalo" type="text"
                                        placeholder="ABC1D23" maxlength="8" required>
                                </div>

                                <div class="col-12 col-md-4">
                                    <label class="form-label">Placa Carreta 1</label>
                                    <input class="form-control js-placa" name="placa_carreta_1" type="text"
                                        placeholder="ABC1D23" maxlength="8">
                                </div>

                                <div class="col-12 col-md-4">
                                    <label class="form-label">Placa Carreta 2</label>
                                    <input class="form-control js-placa" name="placa_carreta_2" type="text"
                                        placeholder="ABC1D23" maxlength="8">
                                </div>

                                <div class="col-12">
                                    <label class="form-label">Categoria do Veiculo</label>
                                    <input name="categoria_veiculo" class="form-control" type="text"
                                        placeholder="Ex: VUC, Truck, Carreta..." required>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card app-card mb-3" id="s3" data-aos="fade-up">
                        <div class="card-body">
                            <div class="app-h">
                                <div class="app-hicon"><i class="bi bi-signpost-split"></i></div>
                                <div>
                                    <h2 class="app-htitle">3. Modalidade de Transporte</h2>
                                    <p class="app-hdesc">Selecione as modalidades permitidas para operacao TAC.</p>
                                </div>
                            </div>

                            <div class="app-checkgrid">
                                <label class="app-check"><input name="modalidades[]" value="Lotacao" type="checkbox">
                                    <span>Lotacao</span></label>
                                <label class="app-check"><input name="modalidades[]" value="Fracionado"
                                        type="checkbox"> <span>Fracionado</span></label>
                                <label class="app-check"><input name="modalidades[]" value="Transferencia"
                                        type="checkbox"> <span>Transferencia</span></label>
                                <label class="app-check"><input name="modalidades[]" value="Distribuicao"
                                        type="checkbox"> <span>Distribuicao</span></label>
                                <label class="app-check"><input name="modalidades[]" value="Armazenagem"
                                        type="checkbox"> <span>Armazenagem</span></label>
                                <label class="app-check"><input name="modalidades[]" value="Transbordo"
                                        type="checkbox"> <span>Transbordo</span></label>
                            </div>
                        </div>
                    </div>

                    <div class="card app-card mb-3" id="s4" data-aos="fade-up">
                        <div class="card-body">
                            <div class="app-h">
                                <div class="app-hicon"><i class="bi bi-cash-coin"></i></div>
                                <div>
                                    <h2 class="app-htitle">4. Contratacao e Pagamento</h2>
                                    <p class="app-hdesc">Modelo de contratacao por frete e condicoes de pagamento.</p>
                                </div>
                            </div>

                            <div class="row g-3">
                                <div class="col-12">
                                    <label class="form-label">Forma de contratacao por frete</label>
                                    <div class="app-checkgrid">
                                        <label class="app-check"><input name="formas_contratacao[]"
                                                value="Ordem de Carregamento" type="checkbox">
                                            <span>Ordem de Carregamento</span></label>
                                        <label class="app-check"><input name="formas_contratacao[]"
                                                value="Contrato de Frete" type="checkbox">
                                            <span>Contrato de Frete</span></label>
                                    </div>
                                </div>

                                <div class="col-12 col-md-4">
                                    <label class="form-label">Valor do Frete (R$)</label>
                                    <input name="valor_frete" class="form-control" type="number" min="0" step="0.01"
                                        placeholder="Ex: 3200.00" required>
                                </div>

                                <div class="col-12 col-md-4">
                                    <label class="form-label">Prazo de Pagamento</label>
                                    <input name="prazo_pagamento" class="form-control" type="text"
                                        placeholder="Ex: 7 dias apos descarga" required>
                                </div>

                                <div class="col-12 col-md-4">
                                    <label class="form-label">Prazo do contrato (dias)</label>
                                    <input name="prazo_contrato_dias" class="form-control" type="number" min="1"
                                        placeholder="Ex: 365" required>
                                </div>

                                <div class="col-12">
                                    <label class="form-label">Forma de pagamento</label>
                                    <div class="app-checkgrid">
                                        <label class="app-check"><input name="formas_pagamento[]" value="PIX"
                                                type="checkbox"> <span>PIX</span></label>
                                        <label class="app-check"><input name="formas_pagamento[]" value="TEF"
                                                type="checkbox"> <span>TEF</span></label>
                                        <label class="app-check"><input name="formas_pagamento[]" value="TED"
                                                type="checkbox"> <span>TED</span></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card app-card mb-3" id="s5" data-aos="fade-up">
                        <div class="card-body">
                            <div class="app-h">
                                <div class="app-hicon"><i class="bi bi-file-earmark-text"></i></div>
                                <div>
                                    <h2 class="app-htitle">5. Termos Contratuais</h2>
                                    <p class="app-hdesc">Aceites para execucao do contrato de prestacao de servico.</p>
                                </div>
                            </div>

                            <div class="row g-3">
                                <div class="col-12">
                                    <label class="form-label">Foro juridico</label>
                                    <input name="foro_juridico" class="form-control" type="text"
                                        value="Sao Paulo - SP">
                                </div>

                                <div class="col-12">
                                    <div class="app-checkgrid">
                                        <label class="app-check"><input name="aceite_clausulas" value="1"
                                                type="checkbox" required>
                                            <span>Declaro ciencia das clausulas de responsabilidade, multas e
                                                subcontratacao.</span></label>
                                        <label class="app-check"><input name="aceite_lgpd" value="1" type="checkbox"
                                                required>
                                            <span>Autorizo o tratamento de dados pessoais para execucao contratual
                                                (LGPD).</span></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card app-card mb-3" id="s6" data-aos="fade-up">
                        <div class="card-body">
                            <div class="app-h">
                                <div class="app-hicon"><i class="bi bi-chat-left-text"></i></div>
                                <div>
                                    <h2 class="app-htitle">6. Observacoes</h2>
                                    <p class="app-hdesc">Informacoes adicionais relevantes para contratacao TAC.</p>
                                </div>
                            </div>

                            <textarea name="observacoes" class="form-control" rows="5"
                                placeholder="Inclua observacoes sobre disponibilidade, rotas e regras operacionais..."></textarea>
                        </div>
                    </div>

                    <div class="card app-card mb-4" id="s7" data-aos="fade-up">
                        <div class="card-body">
                            <div class="app-h">
                                <div class="app-hicon"><i class="bi bi-paperclip"></i></div>
                                <div>
                                    <h2 class="app-htitle">7. Anexos</h2>
                                    <p class="app-hdesc">CNH, RNTRC, CRLV e demais documentos de apoio.</p>
                                </div>
                            </div>

                            <input class="filepond" type="file" name="anexos[]" multiple
                                accept="image/*,application/pdf" />
                        </div>
                    </div>

                    <div class="app-submitbar">
                        <button id="btnSubmitMotorista" type="submit" class="btn btn-primary btn-lg w-100 app-btn">
                            <i class="bi bi-send me-2"></i> Enviar Cadastro
                        </button>
                        <div class="app-minihelp mt-2">
                            O cadastro e enviado sem recarregar a pagina.
                        </div>
                    </div>
                </form>
            </section>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/imask/7.6.1/imask.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/filepond/4.32.9/filepond.min.js"></script>
    <script
        src="https://cdn.jsdelivr.net/npm/filepond-plugin-image-preview@4.6.12/dist/filepond-plugin-image-preview.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.26.19/dist/sweetalert2.all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/notyf/3.10.0/notyf.min.js"></script>

    <script>
        AOS.init({ once: true, duration: 650, offset: 60 });

        IMask(document.getElementById('cpf'), { mask: '000.000.000-00' });
        IMask(document.getElementById('whatsapp'), { mask: '(00) 00000-0000' });

        document.querySelectorAll('.js-placa').forEach((input) => {
            input.addEventListener('input', () => {
                input.value = input.value.replace(/[^a-zA-Z0-9]/g, '').toUpperCase().slice(0, 7);
            });
        });

        FilePond.registerPlugin(FilePondPluginImagePreview);
        const pond = FilePond.create(document.querySelector('.filepond'), {
            allowMultiple: true,
            instantUpload: false,
            labelIdle: 'Arraste os anexos aqui ou <span class="filepond--label-action">clique para selecionar</span>'
        });

        const notyf = new Notyf({ duration: 2400, ripple: true, dismissible: true });

        document.getElementById('motoristaForm').addEventListener('submit', async function (e) {
            e.preventDefault();

            if (!this.checkValidity()) {
                this.reportValidity();
                return;
            }

            const btn = document.getElementById('btnSubmitMotorista');
            btn.disabled = true;
            btn.classList.add('is-loading');

            notyf.success('Enviando cadastro...');

            try {
                const formData = new FormData(this);
                formData.delete('anexos');
                formData.delete('anexos[]');

                pond.getFiles().forEach((item) => {
                    formData.append('anexos[]', item.file, item.file.name);
                });

                const response = await fetch('admin-cadastropositivo/api/salvar-motorista.php', {
                    method: 'POST',
                    body: formData
                });
                const result = await response.json();

                if (!response.ok || !result.ok) {
                    throw new Error(result.message || 'Nao foi possivel enviar o cadastro.');
                }

                btn.disabled = false;
                btn.classList.remove('is-loading');

                Swal.fire({
                    icon: 'success',
                    title: 'Cadastro enviado!',
                    text: 'O cadastro do motorista foi registrado com sucesso.',
                    confirmButtonText: 'Fechar'
                });

                this.reset();
                pond.removeFiles();
            } catch (error) {
                btn.disabled = false;
                btn.classList.remove('is-loading');

                Swal.fire({
                    icon: 'error',
                    title: 'Erro no envio',
                    text: error.message || 'Tente novamente em instantes.',
                    confirmButtonText: 'Fechar'
                });
            }
        });
    </script>
</body>

</html>
