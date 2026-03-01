<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Cadastro de Depósito Logístico</title>

    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap (CSS) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" rel="stylesheet">

    <!-- AOS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" rel="stylesheet">

    <!-- Choices (select bonito) -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/choices.js/2.7.4/styles/css/choices.min.css" rel="stylesheet">

    <!-- FilePond -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/filepond/4.32.9/filepond.css" rel="stylesheet">
    <link
        href="https://cdn.jsdelivr.net/npm/filepond-plugin-image-preview@4.6.12/dist/filepond-plugin-image-preview.min.css"
        rel="stylesheet">

    <!-- Notyf (toast) -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/notyf/3.10.0/notyf.min.css" rel="stylesheet">

    <!-- Seu CSS -->
    <link rel="stylesheet" href="style-fg.css" />
</head>

<body>
    <header class="app-topbar">
        <div class="container py-3 d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center gap-2">
                <span class="app-mark"><i class="bi bi-box-seam"></i></span>
                <div>
                    <div class="app-title">Cadastro de Depósito Logístico</div>
                    <div class="app-subtitle">Mapeamento estrutural para armazenagem, transbordo e apoio</div>
                </div>
            </div>

            <a class="btn btn-light btn-sm app-help" href="#form" title="Ir para o formulário">
                <i class="bi bi-arrow-down-short me-1"></i> Preencher
            </a>
        </div>
    </header>

    <main class="app-main">
        <div class="container py-4 py-lg-5">
            <div class="row g-4">
                <!-- Sidebar / Steps -->


                <!-- Form -->
                <section class="col-12 col-lg-12" id="form" data-aos="fade-left">
                    <form id="depositoForm" class="app-form" novalidate>
                        <!-- S1 -->
                        <div class="card app-card mb-3" id="s1">
                            <div class="card-body">
                                <div class="app-h">
                                    <div class="app-hicon"><i class="bi bi-building"></i></div>
                                    <div>
                                        <h2 class="app-htitle">1. Identificação da Empresa</h2>
                                        <p class="app-hdesc">Dados básicos para contato e validação.</p>
                                    </div>
                                </div>

                                <div class="row g-3">
                                    <div class="col-12">
                                        <label class="form-label">Razão Social</label>
                                        <input name="razao_social" class="form-control" type="text"
                                            placeholder="Ex: Depósitos ABC LTDA" required>
                                    </div>

                                    <div class="col-12">
                                        <label class="form-label">Nome Fantasia</label>
                                        <input name="nome_fantasia" class="form-control" type="text"
                                            placeholder="Ex: Depósito ABC" required>
                                    </div>

                                    <div class="col-12 col-md-6">
                                        <label class="form-label">CNPJ</label>
                                        <div class="input-icon">
                                            <i class="bi bi-upc-scan"></i>
                                            <input id="cnpj" name="cnpj" class="form-control" type="text"
                                                placeholder="00.000.000/0000-00" required>
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-6">
                                        <label class="form-label">Telefone / WhatsApp</label>
                                        <div class="input-icon">
                                            <i class="bi bi-whatsapp"></i>
                                            <input id="whatsapp" name="whatsapp" class="form-control" type="text"
                                                placeholder="(11) 99999-9999" required>
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-6">
                                        <label class="form-label">Responsável pelo Depósito</label>
                                        <input name="responsavel" class="form-control" type="text"
                                            placeholder="Nome completo" required>
                                    </div>

                                    <div class="col-12 col-md-6">
                                        <label class="form-label">Cargo</label>
                                        <input name="cargo" class="form-control" type="text"
                                            placeholder="Ex: Gerente de Operações" required>
                                    </div>

                                    <div class="col-12">
                                        <label class="form-label">E-mail</label>
                                        <div class="input-icon">
                                            <i class="bi bi-envelope"></i>
                                            <input name="email" class="form-control" type="email"
                                                placeholder="nome@empresa.com.br" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- S2 -->
                        <div class="card app-card mb-3" id="s2">
                            <div class="card-body">
                                <div class="app-h">
                                    <div class="app-hicon"><i class="bi bi-geo-alt"></i></div>
                                    <div>
                                        <h2 class="app-htitle">2. Localização do Depósito</h2>
                                        <p class="app-hdesc">Endereço e distância aproximada.</p>
                                    </div>
                                </div>

                                <div class="row g-3">
                                    <div class="col-12">
                                        <label class="form-label">Endereço Completo</label>
                                        <input name="endereco" class="form-control" type="text"
                                            placeholder="Rua, número, complemento" required>
                                    </div>

                                    <div class="col-12 col-md-6">
                                        <label class="form-label">Bairro</label>
                                        <input name="bairro" class="form-control" type="text" required>
                                    </div>

                                    <div class="col-12 col-md-4">
                                        <label class="form-label">Cidade</label>
                                        <input name="cidade" class="form-control" type="text" required>
                                    </div>

                                    <div class="col-12 col-md-2">
                                        <label class="form-label">Estado</label>
                                        <input name="estado" class="form-control" type="text" placeholder="SP"
                                            maxlength="2" required>
                                    </div>

                                    <div class="col-12 col-md-4">
                                        <label class="form-label">CEP</label>
                                        <div class="input-icon">
                                            <i class="bi bi-mailbox"></i>
                                            <input id="cep" name="cep" class="form-control" type="text"
                                                placeholder="00000-000" required>
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-8">
                                        <label class="form-label">Distância aproximada até o centro (km)</label>
                                        <input name="distancia_centro" class="form-control" type="number" min="0"
                                            step="0.1" placeholder="Ex: 12.5">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- S3 -->
                        <div class="card app-card mb-3" id="s3">
                            <div class="card-body">
                                <div class="app-h">
                                    <div class="app-hicon"><i class="bi bi-file-earmark-text"></i></div>
                                    <div>
                                        <h2 class="app-htitle">3. Situação do Imóvel</h2>
                                        <p class="app-hdesc">Tipo e tempo de ocupação.</p>
                                    </div>
                                </div>

                                <div class="row g-3">
                                    <div class="col-12 col-md-6">
                                        <label class="form-label">Tipo de imóvel</label>
                                        <select name="tipo_imovel" class="form-select js-choices">
                                            <option>Imóvel próprio</option>
                                            <option>Imóvel alugado</option>
                                            <option>Imóvel cedido</option>
                                            <option>Outro</option>
                                        </select>
                                    </div>

                                    <div class="col-12 col-md-6">
                                        <label class="form-label">Tempo de ocupação</label>
                                        <select name="tempo_ocupacao" class="form-select js-choices">
                                            <option>Menos de 1 ano</option>
                                            <option>1 a 3 anos</option>
                                            <option>3 a 5 anos</option>
                                            <option>Mais de 5 anos</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- S4 -->
                        <div class="card app-card mb-3" id="s4">
                            <div class="card-body">
                                <div class="app-h">
                                    <div class="app-hicon"><i class="bi bi-rulers"></i></div>
                                    <div>
                                        <h2 class="app-htitle">4. Estrutura Física</h2>
                                        <p class="app-hdesc">Medidas, piso e pé-direito.</p>
                                    </div>
                                </div>

                                <div class="row g-3">
                                    <div class="col-12 col-md-4">
                                        <label class="form-label">Área total do terreno (m²)</label>
                                        <input name="area_terreno" class="form-control" type="number" min="0">
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <label class="form-label">Área coberta (m²)</label>
                                        <input name="area_coberta" class="form-control" type="number" min="0">
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <label class="form-label">Área pátio (m²)</label>
                                        <input name="area_patio" class="form-control" type="number" min="0">
                                    </div>

                                    <div class="col-12 col-md-4">
                                        <label class="form-label">Tipo de estrutura</label>
                                        <select name="tipo_estrutura" class="form-select js-choices">
                                            <option>Galpão fechado</option>
                                            <option>Galpão semiaberto</option>
                                            <option>Área aberta</option>
                                        </select>
                                    </div>

                                    <div class="col-12 col-md-4">
                                        <label class="form-label">Tipo de piso</label>
                                        <select name="tipo_piso" class="form-select js-choices">
                                            <option>Concreto</option>
                                            <option>Asfalto</option>
                                            <option>Terra batida</option>
                                            <option>Outro</option>
                                        </select>
                                    </div>

                                    <div class="col-12 col-md-4">
                                        <label class="form-label">Pé direito</label>
                                        <select name="pe_direito" class="form-select js-choices">
                                            <option>até 5 metros</option>
                                            <option>5 a 8 metros</option>
                                            <option>acima de 8 metros</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- S5 -->
                        <div class="card app-card mb-3" id="s5">
                            <div class="card-body">
                                <div class="app-h">
                                    <div class="app-hicon"><i class="bi bi-truck"></i></div>
                                    <div>
                                        <h2 class="app-htitle">5. Acesso de Veículos ao Endereço</h2>
                                        <p class="app-hdesc">Tipos de veículos e restrições.</p>
                                    </div>
                                </div>

                                <div class="row g-3">
                                    <div class="col-12">
                                        <div class="app-checkgrid">
                                            <label class="app-check"><input name="veiculos[]" value="VUC"
                                                    type="checkbox"> <span>VUC</span></label>
                                            <label class="app-check"><input name="veiculos[]" value="3/4"
                                                    type="checkbox"> <span>3/4</span></label>
                                            <label class="app-check"><input name="veiculos[]" value="Toco"
                                                    type="checkbox"> <span>Toco</span></label>
                                            <label class="app-check"><input name="veiculos[]" value="Truck"
                                                    type="checkbox"> <span>Truck</span></label>
                                            <label class="app-check"><input name="veiculos[]" value="Carreta 2 eixos"
                                                    type="checkbox"> <span>Carreta 2 eixos</span></label>
                                            <label class="app-check"><input name="veiculos[]" value="Carreta LS"
                                                    type="checkbox"> <span>Carreta LS</span></label>
                                            <label class="app-check"><input name="veiculos[]" value="Bitrem"
                                                    type="checkbox"> <span>Bitrem</span></label>
                                            <label class="app-check"><input name="veiculos[]" value="Rodotrem"
                                                    type="checkbox"> <span>Rodotrem</span></label>
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-6">
                                        <label class="form-label">Restrição de acesso</label>
                                        <select name="restricao_acesso" class="form-select js-choices">
                                            <option>Não há restrições</option>
                                            <option>Restrição de horário</option>
                                            <option>Restrição municipal</option>
                                            <option>Rua estreita</option>
                                            <option>Altura limitada</option>
                                            <option>Outro</option>
                                        </select>
                                    </div>

                                    <div class="col-12 col-md-6">
                                        <label class="form-label">Observações</label>
                                        <textarea name="obs_acesso" class="form-control" rows="3"
                                            placeholder="Ex: caminhão só entra fora do horário de pico"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- S6 -->
                        <div class="card app-card mb-3" id="s6">
                            <div class="card-body">
                                <div class="app-h">
                                    <div class="app-hicon"><i class="bi bi-boxes"></i></div>
                                    <div>
                                        <h2 class="app-htitle">6. Capacidade Operacional</h2>
                                        <p class="app-hdesc">Capacidade e docas.</p>
                                    </div>
                                </div>

                                <div class="row g-3">
                                    <div class="col-12 col-md-4">
                                        <label class="form-label">Capacidade (paletes)</label>
                                        <input name="cap_paletes" class="form-control" type="number" min="0">
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <label class="form-label">Capacidade (toneladas)</label>
                                        <input name="cap_toneladas" class="form-control" type="number" min="0"
                                            step="0.1">
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <label class="form-label">Quantidade de docas</label>
                                        <input name="qtd_docas" class="form-control" type="number" min="0">
                                    </div>

                                    <div class="col-12">
                                        <label class="form-label">Possui docas?</label>
                                        <select name="possui_docas" class="form-select js-choices">
                                            <option>Sim</option>
                                            <option>Não</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- S7 -->
                        <div class="card app-card mb-3" id="s7">
                            <div class="card-body">
                                <div class="app-h">
                                    <div class="app-hicon"><i class="bi bi-tools"></i></div>
                                    <div>
                                        <h2 class="app-htitle">7. Equipamentos Disponíveis</h2>
                                        <p class="app-hdesc">Selecione os equipamentos e informe quantidade aproximada.
                                        </p>
                                    </div>
                                </div>

                                <div class="app-checkgrid">
                                    <label class="app-check"><input name="equip[]" value="Empilhadeira" type="checkbox">
                                        <span>Empilhadeira</span></label>
                                    <label class="app-check"><input name="equip[]" value="Paleteira manual"
                                            type="checkbox"> <span>Paleteira manual</span></label>
                                    <label class="app-check"><input name="equip[]" value="Paleteira elétrica"
                                            type="checkbox"> <span>Paleteira elétrica</span></label>
                                    <label class="app-check"><input name="equip[]" value="Guindauto/Munk"
                                            type="checkbox"> <span>Guindauto / Munk</span></label>
                                    <label class="app-check"><input name="equip[]" value="Ponte rolante"
                                            type="checkbox"> <span>Ponte rolante</span></label>
                                    <label class="app-check"><input name="equip[]" value="Estrechadeira"
                                            type="checkbox"> <span>Estrechadeira</span></label>
                                    <label class="app-check"><input name="equip[]" value="Balança" type="checkbox">
                                        <span>Balança</span></label>
                                    <label class="app-check"><input name="equip[]" value="Rampa móvel" type="checkbox">
                                        <span>Rampa móvel</span></label>
                                    <label class="app-check"><input name="equip[]" value="Plataforma hidráulica"
                                            type="checkbox"> <span>Plataforma hidráulica</span></label>
                                </div>

                                <div class="mt-3">
                                    <label class="form-label">Quantidade aproximada de equipamentos</label>
                                    <input name="qtd_equip" class="form-control" type="text"
                                        placeholder="Ex: 2 empilhadeiras, 4 paleteiras">
                                </div>
                            </div>
                        </div>

                        <!-- S8 -->
                        <div class="card app-card mb-3" id="s8">
                            <div class="card-body">
                                <div class="app-h">
                                    <div class="app-hicon"><i class="bi bi-people"></i></div>
                                    <div>
                                        <h2 class="app-htitle">8. Recursos Humanos</h2>
                                        <p class="app-hdesc">Equipe e modelo de operação.</p>
                                    </div>
                                </div>

                                <div class="row g-3">
                                    <div class="col-12 col-md-6">
                                        <label class="form-label">Número de colaboradores</label>
                                        <input name="colaboradores" class="form-control" type="number" min="0">
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label class="form-label">Modelo de funcionamento</label>
                                        <select name="funcionamento" class="form-select js-choices">
                                            <option>Horário comercial</option>
                                            <option>Dois turnos</option>
                                            <option>Operação 24h</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- S9 -->
                        <div class="card app-card mb-3" id="s9">
                            <div class="card-body">
                                <div class="app-h">
                                    <div class="app-hicon"><i class="bi bi-shield-lock"></i></div>
                                    <div>
                                        <h2 class="app-htitle">9. Segurança</h2>
                                        <p class="app-hdesc">Recursos de proteção e controle.</p>
                                    </div>
                                </div>

                                <div class="app-checkgrid">
                                    <label class="app-check"><input name="seg[]" value="Seguro patrimonial"
                                            type="checkbox"> <span>Seguro patrimonial</span></label>
                                    <label class="app-check"><input name="seg[]" value="Câmeras" type="checkbox">
                                        <span>Sistema de câmeras</span></label>
                                    <label class="app-check"><input name="seg[]" value="Alarme" type="checkbox">
                                        <span>Alarme</span></label>
                                    <label class="app-check"><input name="seg[]" value="Vigilância" type="checkbox">
                                        <span>Vigilância</span></label>
                                    <label class="app-check"><input name="seg[]" value="Controle de acesso"
                                            type="checkbox"> <span>Controle de acesso</span></label>
                                    <label class="app-check"><input name="seg[]" value="Muro/cerca" type="checkbox">
                                        <span>Muro / cerca perimetral</span></label>
                                </div>
                            </div>
                        </div>

                        <!-- S10 -->
                        <div class="card app-card mb-3" id="s10">
                            <div class="card-body">
                                <div class="app-h">
                                    <div class="app-hicon"><i class="bi bi-diagram-3"></i></div>
                                    <div>
                                        <h2 class="app-htitle">10. Serviços Disponíveis</h2>
                                        <p class="app-hdesc">Selecione os serviços que o depósito oferece.</p>
                                    </div>
                                </div>

                                <div class="app-checkgrid">
                                    <label class="app-check"><input name="serv[]" value="Armazenagem" type="checkbox">
                                        <span>Armazenagem</span></label>
                                    <label class="app-check"><input name="serv[]" value="Cross docking" type="checkbox">
                                        <span>Cross docking</span></label>
                                    <label class="app-check"><input name="serv[]" value="Transbordo" type="checkbox">
                                        <span>Transbordo</span></label>
                                    <label class="app-check"><input name="serv[]" value="Paletização" type="checkbox">
                                        <span>Paletização</span></label>
                                    <label class="app-check"><input name="serv[]" value="Etiquetagem" type="checkbox">
                                        <span>Etiquetagem</span></label>
                                    <label class="app-check"><input name="serv[]" value="Unitização" type="checkbox">
                                        <span>Unitização</span></label>
                                    <label class="app-check"><input name="serv[]" value="Redespacho" type="checkbox">
                                        <span>Redespacho</span></label>
                                </div>
                            </div>
                        </div>

                        <!-- S11 -->
                        <div class="card app-card mb-3" id="s11">
                            <div class="card-body">
                                <div class="app-h">
                                    <div class="app-hicon"><i class="bi bi-box"></i></div>
                                    <div>
                                        <h2 class="app-htitle">11. Tipos de Carga Aceitos</h2>
                                        <p class="app-hdesc">Selecione e detalhe restrições.</p>
                                    </div>
                                </div>

                                <div class="app-checkgrid">
                                    <label class="app-check"><input name="cargas[]" value="Carga geral" type="checkbox">
                                        <span>Carga geral</span></label>
                                    <label class="app-check"><input name="cargas[]" value="Eletrodomésticos"
                                            type="checkbox"> <span>Eletrodomésticos</span></label>
                                    <label class="app-check"><input name="cargas[]" value="Alimentos" type="checkbox">
                                        <span>Alimentos</span></label>
                                    <label class="app-check"><input name="cargas[]" value="Materiais de construção"
                                            type="checkbox"> <span>Materiais de construção</span></label>
                                    <label class="app-check"><input name="cargas[]" value="Máquinas" type="checkbox">
                                        <span>Máquinas</span></label>
                                    <label class="app-check"><input name="cargas[]" value="Produtos perigosos"
                                            type="checkbox"> <span>Produtos perigosos</span></label>
                                    <label class="app-check"><input name="cargas[]" value="Outros" type="checkbox">
                                        <span>Outros</span></label>
                                </div>

                                <div class="mt-3">
                                    <label class="form-label">Restrições de carga</label>
                                    <textarea name="restricoes_carga" class="form-control" rows="4"
                                        placeholder="Ex: não recebe químicos / não recebe perecíveis"></textarea>
                                </div>
                            </div>
                        </div>

                        <!-- S12 -->
                        <div class="card app-card mb-3" id="s12">
                            <div class="card-body">
                                <div class="app-h">
                                    <div class="app-hicon"><i class="bi bi-chat-left-text"></i></div>
                                    <div>
                                        <h2 class="app-htitle">12. Observações</h2>
                                        <p class="app-hdesc">Qualquer ponto importante para operação.</p>
                                    </div>
                                </div>

                                <textarea name="observacoes" class="form-control" rows="5"
                                    placeholder="Escreva aqui..."></textarea>
                            </div>
                        </div>

                        <!-- S13 -->
                        <div class="card app-card mb-4" id="s13">
                            <div class="card-body">
                                <div class="app-h">
                                    <div class="app-hicon"><i class="bi bi-images"></i></div>
                                    <div>
                                        <h2 class="app-htitle">13. Envio de Fotos</h2>
                                        <p class="app-hdesc">Fachada, área interna e equipamentos (com preview).</p>
                                    </div>
                                </div>

                                <input class="filepond" type="file" name="fotos" multiple accept="image/*" />
                            </div>
                        </div>

                        <div class="app-submitbar">
                            <button id="btnSubmit" type="submit" class="btn btn-primary btn-lg w-100 app-btn">
                                <i class="bi bi-send me-2"></i> Enviar Cadastro
                            </button>
                            <div class="app-minihelp mt-2">
                                Ao enviar, você recebe um feedback na tela (sem recarregar).
                            </div>
                        </div>
                    </form>
                </section>
            </div>
        </div>
    </main>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

    <!-- AOS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>

    <!-- Choices -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/choices.js/2.7.4/choices.min.js"></script>

    <!-- IMask -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/imask/7.6.1/imask.min.js"></script>

    <!-- FilePond -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/filepond/4.32.9/filepond.min.js"></script>
    <script
        src="https://cdn.jsdelivr.net/npm/filepond-plugin-image-preview@4.6.12/dist/filepond-plugin-image-preview.min.js"></script>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.26.19/dist/sweetalert2.all.min.js"></script>

    <!-- Notyf -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/notyf/3.10.0/notyf.min.js"></script>

    <script>
        // Init AOS
        AOS.init({ once: true, duration: 650, offset: 60 });

        // Init Choices
        document.querySelectorAll('.js-choices').forEach((el) => {
            new Choices(el, {
                searchEnabled: false,
                itemSelectText: '',
                shouldSort: false
            });
        });

        // Masks
        IMask(document.getElementById('cnpj'), { mask: '00.000.000/0000-00' });
        IMask(document.getElementById('cep'), { mask: '00000-000' });
        IMask(document.getElementById('whatsapp'), { mask: '(00) 00000-0000' });

        // FilePond
        FilePond.registerPlugin(FilePondPluginImagePreview);
        FilePond.create(document.querySelector('.filepond'), {
            allowMultiple: true,
            instantUpload: false,
            labelIdle: 'Arraste as fotos aqui ou <span class="filepond--label-action">clique para selecionar</span>'
        });

        // Toast + submit feedback (demo)
        const notyf = new Notyf({ duration: 2400, ripple: true, dismissible: true });

        document.getElementById('depositoForm').addEventListener('submit', function (e) {
            e.preventDefault();

            const btn = document.getElementById('btnSubmit');
            btn.disabled = true;
            btn.classList.add('is-loading');

            notyf.success('Enviando cadastro...');

            // Simula envio
            setTimeout(() => {
                btn.disabled = false;
                btn.classList.remove('is-loading');

                Swal.fire({
                    icon: 'success',
                    title: 'Cadastro enviado!',
                    text: 'Recebemos as informações. Em breve o time entra em contato.',
                    confirmButtonText: 'Fechar'
                });

                this.reset();
            }, 900);
        });
    </script>
</body>

</html>