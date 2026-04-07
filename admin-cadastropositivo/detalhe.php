<?php
declare(strict_types=1);

require_once __DIR__ . '/auth.php';
require_once __DIR__ . '/modules.php';
require_admin_login();

$module = cadastropositivo_resolve_module((string) ($_GET['mod'] ?? 'deposito'));
$id = (int) ($_GET['id'] ?? 0);

if ($id <= 0) {
    http_response_code(404);
    exit('Cadastro invalido.');
}

$stmt = get_pdo()->prepare('SELECT * FROM ' . $module['table'] . ' WHERE id = :id LIMIT 1');
$stmt->execute([':id' => $id]);
$row = $stmt->fetch();

if (!$row) {
    http_response_code(404);
    exit('Cadastro nao encontrado.');
}

function campo(array $row, string $key): string
{
    $value = trim((string) ($row[$key] ?? ''));
    return $value === '' ? '-' : e($value);
}

$uploadRelBase = 'uploads';
if ($module['upload_subdir'] !== '') {
    $uploadRelBase .= '/' . $module['upload_subdir'];
}
$files = decode_json_list((string) ($row[$module['upload_json_field']] ?? ''));
?>
<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Detalhe #<?= (int) $row['id'] ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { box-sizing: border-box; }
        body { margin: 0; background: #f3f6fc; color: #1f2430; font-family: Inter, sans-serif; }
        .wrap { max-width: 1160px; margin: 0 auto; padding: 22px; }
        .top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 16px;
            gap: 10px;
            flex-wrap: wrap;
        }
        h1 { margin: 0; font-size: 28px; letter-spacing: -.02em; }
        .sub { color: #667189; font-size: 14px; margin-top: 4px; }
        .btn {
            text-decoration: none;
            background: #0f172a;
            color: #fff;
            border-radius: 10px;
            padding: 10px 14px;
            font-weight: 700;
        }
        .section {
            background: #fff;
            border: 1px solid #dde4f1;
            border-radius: 14px;
            padding: 16px;
            margin-bottom: 12px;
        }
        .section h2 { margin: 0 0 12px; font-size: 18px; }
        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 10px;
        }
        .item {
            border: 1px solid #e7edf6;
            border-radius: 10px;
            padding: 10px;
            background: #fafcff;
        }
        .label {
            color: #6c7691;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: .05em;
            margin-bottom: 6px;
            font-weight: 700;
        }
        .value { font-size: 14px; white-space: pre-wrap; word-break: break-word; }
        .chips { display: flex; flex-wrap: wrap; gap: 8px; }
        .chip {
            background: #e8f1ff;
            color: #0f4fb8;
            border: 1px solid #cfe1ff;
            border-radius: 999px;
            padding: 5px 10px;
            font-size: 13px;
            font-weight: 600;
        }
        .files {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(170px, 1fr));
            gap: 10px;
        }
        .files a {
            border-radius: 10px;
            overflow: hidden;
            border: 1px solid #d9e2f2;
            display: block;
            background: #fff;
            aspect-ratio: 4 / 3;
        }
        .files img { width: 100%; height: 100%; object-fit: cover; display: block; }
        .file-generic {
            height: 100%;
            display: grid;
            place-items: center;
            color: #3f4f71;
            font-weight: 700;
            font-size: 13px;
            text-align: center;
            padding: 8px;
        }
    </style>
</head>
<body>
    <div class="wrap">
        <div class="top">
            <div>
                <h1><?= e($module['menu_label']) ?> #<?= (int) $row['id'] ?></h1>
                <div class="sub">Recebido em <?= e(format_datetime((string) $row['criado_em'])) ?></div>
            </div>
            <a class="btn" href="index.php?mod=<?= e($module['key']) ?>">Voltar para lista</a>
        </div>

        <?php if ($module['key'] === 'deposito'): ?>
            <?php
            $veiculos = decode_json_list((string) ($row['veiculos_json'] ?? ''));
            $equip = decode_json_list((string) ($row['equip_json'] ?? ''));
            $seg = decode_json_list((string) ($row['seg_json'] ?? ''));
            $serv = decode_json_list((string) ($row['serv_json'] ?? ''));
            $cargas = decode_json_list((string) ($row['cargas_json'] ?? ''));
            ?>
            <div class="section">
                <h2>1. Identificacao da Empresa</h2>
                <div class="grid">
                    <div class="item"><div class="label">Razao social</div><div class="value"><?= campo($row, 'razao_social') ?></div></div>
                    <div class="item"><div class="label">Nome fantasia</div><div class="value"><?= campo($row, 'nome_fantasia') ?></div></div>
                    <div class="item"><div class="label">CNPJ</div><div class="value"><?= campo($row, 'cnpj') ?></div></div>
                    <div class="item"><div class="label">WhatsApp</div><div class="value"><?= campo($row, 'whatsapp') ?></div></div>
                    <div class="item"><div class="label">Responsavel</div><div class="value"><?= campo($row, 'responsavel') ?></div></div>
                    <div class="item"><div class="label">Cargo</div><div class="value"><?= campo($row, 'cargo') ?></div></div>
                    <div class="item"><div class="label">E-mail</div><div class="value"><?= campo($row, 'email') ?></div></div>
                </div>
            </div>

            <div class="section">
                <h2>2. Localizacao do Deposito</h2>
                <div class="grid">
                    <div class="item"><div class="label">Endereco</div><div class="value"><?= campo($row, 'endereco') ?></div></div>
                    <div class="item"><div class="label">Bairro</div><div class="value"><?= campo($row, 'bairro') ?></div></div>
                    <div class="item"><div class="label">Cidade</div><div class="value"><?= campo($row, 'cidade') ?></div></div>
                    <div class="item"><div class="label">Estado</div><div class="value"><?= campo($row, 'estado') ?></div></div>
                    <div class="item"><div class="label">CEP</div><div class="value"><?= campo($row, 'cep') ?></div></div>
                    <div class="item"><div class="label">Distancia centro (km)</div><div class="value"><?= campo($row, 'distancia_centro') ?></div></div>
                </div>
            </div>

            <div class="section">
                <h2>3 a 8. Estrutura e Operacao</h2>
                <div class="grid">
                    <div class="item"><div class="label">Tipo imovel</div><div class="value"><?= campo($row, 'tipo_imovel') ?></div></div>
                    <div class="item"><div class="label">Tempo ocupacao</div><div class="value"><?= campo($row, 'tempo_ocupacao') ?></div></div>
                    <div class="item"><div class="label">Area terreno</div><div class="value"><?= campo($row, 'area_terreno') ?></div></div>
                    <div class="item"><div class="label">Area coberta</div><div class="value"><?= campo($row, 'area_coberta') ?></div></div>
                    <div class="item"><div class="label">Area patio</div><div class="value"><?= campo($row, 'area_patio') ?></div></div>
                    <div class="item"><div class="label">Tipo estrutura</div><div class="value"><?= campo($row, 'tipo_estrutura') ?></div></div>
                    <div class="item"><div class="label">Tipo piso</div><div class="value"><?= campo($row, 'tipo_piso') ?></div></div>
                    <div class="item"><div class="label">Pe direito</div><div class="value"><?= campo($row, 'pe_direito') ?></div></div>
                    <div class="item"><div class="label">Restricao acesso</div><div class="value"><?= campo($row, 'restricao_acesso') ?></div></div>
                    <div class="item"><div class="label">Obs. acesso</div><div class="value"><?= campo($row, 'obs_acesso') ?></div></div>
                    <div class="item"><div class="label">Cap. paletes</div><div class="value"><?= campo($row, 'cap_paletes') ?></div></div>
                    <div class="item"><div class="label">Cap. toneladas</div><div class="value"><?= campo($row, 'cap_toneladas') ?></div></div>
                    <div class="item"><div class="label">Qtd. docas</div><div class="value"><?= campo($row, 'qtd_docas') ?></div></div>
                    <div class="item"><div class="label">Possui docas</div><div class="value"><?= campo($row, 'possui_docas') ?></div></div>
                    <div class="item"><div class="label">Qtd. equipamentos</div><div class="value"><?= campo($row, 'qtd_equip') ?></div></div>
                    <div class="item"><div class="label">Colaboradores</div><div class="value"><?= campo($row, 'colaboradores') ?></div></div>
                    <div class="item"><div class="label">Funcionamento</div><div class="value"><?= campo($row, 'funcionamento') ?></div></div>
                </div>
            </div>

            <div class="section">
                <h2>Listas Selecionadas</h2>
                <div class="grid">
                    <div class="item"><div class="label">Veiculos</div><div class="chips"><?php foreach ($veiculos as $i): ?><span class="chip"><?= e($i) ?></span><?php endforeach; ?><?= !$veiculos ? '-' : '' ?></div></div>
                    <div class="item"><div class="label">Equipamentos</div><div class="chips"><?php foreach ($equip as $i): ?><span class="chip"><?= e($i) ?></span><?php endforeach; ?><?= !$equip ? '-' : '' ?></div></div>
                    <div class="item"><div class="label">Seguranca</div><div class="chips"><?php foreach ($seg as $i): ?><span class="chip"><?= e($i) ?></span><?php endforeach; ?><?= !$seg ? '-' : '' ?></div></div>
                    <div class="item"><div class="label">Servicos</div><div class="chips"><?php foreach ($serv as $i): ?><span class="chip"><?= e($i) ?></span><?php endforeach; ?><?= !$serv ? '-' : '' ?></div></div>
                    <div class="item"><div class="label">Cargas aceitas</div><div class="chips"><?php foreach ($cargas as $i): ?><span class="chip"><?= e($i) ?></span><?php endforeach; ?><?= !$cargas ? '-' : '' ?></div></div>
                </div>
            </div>

            <div class="section">
                <h2>Observacoes Finais</h2>
                <div class="grid">
                    <div class="item"><div class="label">Restricoes de carga</div><div class="value"><?= campo($row, 'restricoes_carga') ?></div></div>
                    <div class="item"><div class="label">Observacoes gerais</div><div class="value"><?= campo($row, 'observacoes') ?></div></div>
                    <div class="item"><div class="label">IP origem</div><div class="value"><?= campo($row, 'ip_origem') ?></div></div>
                </div>
            </div>
        <?php elseif ($module['key'] === 'licenciamento'): ?>
            <?php
            $tiposOperacao = decode_json_list((string) ($row['tipos_operacao_json'] ?? ''));
            $modalidadesInteresse = decode_json_list((string) ($row['modalidades_interesse_json'] ?? ''));
            ?>
            <div class="section">
                <h2>1. Identificacao e Contato</h2>
                <div class="grid">
                    <div class="item"><div class="label">Nome interessado</div><div class="value"><?= campo($row, 'nome_interessado') ?></div></div>
                    <div class="item"><div class="label">Empresa</div><div class="value"><?= campo($row, 'empresa') ?></div></div>
                    <div class="item"><div class="label">CNPJ</div><div class="value"><?= campo($row, 'cnpj') ?></div></div>
                    <div class="item"><div class="label">Cargo</div><div class="value"><?= campo($row, 'cargo') ?></div></div>
                    <div class="item"><div class="label">WhatsApp</div><div class="value"><?= campo($row, 'whatsapp') ?></div></div>
                    <div class="item"><div class="label">E-mail</div><div class="value"><?= campo($row, 'email') ?></div></div>
                </div>
            </div>

            <div class="section">
                <h2>2. Perfil Operacional</h2>
                <div class="grid">
                    <div class="item"><div class="label">Cidade</div><div class="value"><?= campo($row, 'cidade') ?></div></div>
                    <div class="item"><div class="label">Estado</div><div class="value"><?= campo($row, 'estado') ?></div></div>
                    <div class="item"><div class="label">Quantidade de caminhoes</div><div class="value"><?= campo($row, 'qtd_caminhoes') ?></div></div>
                    <div class="item"><div class="label">Fretes mensais</div><div class="value"><?= campo($row, 'fretes_mensais') ?></div></div>
                    <div class="item"><div class="label">Ticket medio</div><div class="value"><?= campo($row, 'ticket_medio') ?></div></div>
                    <div class="item"><div class="label">Faturamento estimado</div><div class="value"><?= campo($row, 'faturamento_estimado') ?></div></div>
                </div>
            </div>

            <div class="section">
                <h2>3. Expansao e Estrutura</h2>
                <div class="grid">
                    <div class="item"><div class="label">Regiao de interesse</div><div class="value"><?= campo($row, 'regiao_interesse') ?></div></div>
                    <div class="item"><div class="label">Territorio alvo</div><div class="value"><?= campo($row, 'territorio_interesse') ?></div></div>
                    <div class="item"><div class="label">Possui base operacional</div><div class="value"><?= campo($row, 'possui_base_operacional') ?></div></div>
                    <div class="item"><div class="label">Area de base</div><div class="value"><?= campo($row, 'area_base') ?></div></div>
                    <div class="item"><div class="label">Equipe operacional</div><div class="value"><?= campo($row, 'equipe_operacional') ?></div></div>
                    <div class="item"><div class="label">Investimento disponivel</div><div class="value"><?= campo($row, 'investimento_disponivel') ?></div></div>
                    <div class="item"><div class="label">Prazo de implantacao</div><div class="value"><?= campo($row, 'prazo_implantacao') ?></div></div>
                </div>
            </div>

            <div class="section">
                <h2>4. Listas Selecionadas</h2>
                <div class="grid">
                    <div class="item">
                        <div class="label">Tipos de operacao</div>
                        <div class="chips"><?php foreach ($tiposOperacao as $i): ?><span class="chip"><?= e($i) ?></span><?php endforeach; ?><?= !$tiposOperacao ? '-' : '' ?></div>
                    </div>
                    <div class="item">
                        <div class="label">Modalidades de licenciamento</div>
                        <div class="chips"><?php foreach ($modalidadesInteresse as $i): ?><span class="chip"><?= e($i) ?></span><?php endforeach; ?><?= !$modalidadesInteresse ? '-' : '' ?></div>
                    </div>
                </div>
            </div>

            <div class="section">
                <h2>5. Observacoes e Auditoria</h2>
                <div class="grid">
                    <div class="item"><div class="label">Observacoes</div><div class="value"><?= campo($row, 'observacoes') ?></div></div>
                    <div class="item"><div class="label">IP origem</div><div class="value"><?= campo($row, 'ip_origem') ?></div></div>
                </div>
            </div>
        <?php else: ?>
            <?php
            $modalidades = decode_json_list((string) ($row['modalidades_json'] ?? ''));
            $formasContratacao = decode_json_list((string) ($row['formas_contratacao_json'] ?? ''));
            $formasPagamento = decode_json_list((string) ($row['formas_pagamento_json'] ?? ''));
            ?>
            <div class="section">
                <h2>1. Identificacao do TAC</h2>
                <div class="grid">
                    <div class="item"><div class="label">Nome completo</div><div class="value"><?= campo($row, 'nome_completo') ?></div></div>
                    <div class="item"><div class="label">CPF</div><div class="value"><?= campo($row, 'cpf') ?></div></div>
                    <div class="item"><div class="label">RNTRC</div><div class="value"><?= campo($row, 'rntrc') ?></div></div>
                    <div class="item"><div class="label">WhatsApp</div><div class="value"><?= campo($row, 'whatsapp') ?></div></div>
                    <div class="item"><div class="label">E-mail</div><div class="value"><?= campo($row, 'email') ?></div></div>
                </div>
            </div>

            <div class="section">
                <h2>2. Dados do Veiculo</h2>
                <div class="grid">
                    <div class="item"><div class="label">Placa cavalo mecanico</div><div class="value"><?= campo($row, 'placa_cavalo') ?></div></div>
                    <div class="item"><div class="label">Placa carreta 1</div><div class="value"><?= campo($row, 'placa_carreta_1') ?></div></div>
                    <div class="item"><div class="label">Placa carreta 2</div><div class="value"><?= campo($row, 'placa_carreta_2') ?></div></div>
                    <div class="item"><div class="label">Categoria</div><div class="value"><?= campo($row, 'categoria_veiculo') ?></div></div>
                </div>
            </div>

            <div class="section">
                <h2>3. Condicoes Contratuais</h2>
                <div class="grid">
                    <div class="item"><div class="label">Valor do frete</div><div class="value"><?= campo($row, 'valor_frete') ?></div></div>
                    <div class="item"><div class="label">Prazo de pagamento</div><div class="value"><?= campo($row, 'prazo_pagamento') ?></div></div>
                    <div class="item"><div class="label">Prazo do contrato (dias)</div><div class="value"><?= campo($row, 'prazo_contrato_dias') ?></div></div>
                    <div class="item"><div class="label">Foro juridico</div><div class="value"><?= campo($row, 'foro_juridico') ?></div></div>
                    <div class="item"><div class="label">Aceite clausulas</div><div class="value"><?= campo($row, 'aceite_clausulas') ?></div></div>
                    <div class="item"><div class="label">Aceite LGPD</div><div class="value"><?= campo($row, 'aceite_lgpd') ?></div></div>
                </div>
            </div>

            <div class="section">
                <h2>4. Listas Selecionadas</h2>
                <div class="grid">
                    <div class="item">
                        <div class="label">Modalidades de transporte</div>
                        <div class="chips"><?php foreach ($modalidades as $i): ?><span class="chip"><?= e($i) ?></span><?php endforeach; ?><?= !$modalidades ? '-' : '' ?></div>
                    </div>
                    <div class="item">
                        <div class="label">Formas de contratacao</div>
                        <div class="chips"><?php foreach ($formasContratacao as $i): ?><span class="chip"><?= e($i) ?></span><?php endforeach; ?><?= !$formasContratacao ? '-' : '' ?></div>
                    </div>
                    <div class="item">
                        <div class="label">Formas de pagamento</div>
                        <div class="chips"><?php foreach ($formasPagamento as $i): ?><span class="chip"><?= e($i) ?></span><?php endforeach; ?><?= !$formasPagamento ? '-' : '' ?></div>
                    </div>
                </div>
            </div>

            <div class="section">
                <h2>5. Observacoes e Auditoria</h2>
                <div class="grid">
                    <div class="item"><div class="label">Observacoes</div><div class="value"><?= campo($row, 'observacoes') ?></div></div>
                    <div class="item"><div class="label">IP origem</div><div class="value"><?= campo($row, 'ip_origem') ?></div></div>
                </div>
            </div>
        <?php endif; ?>

        <div class="section">
            <h2><?= $module['key'] === 'deposito' ? 'Fotos enviadas' : 'Anexos enviados' ?></h2>
            <?php if (!$files): ?>
                <div class="value">Nenhum arquivo enviado.</div>
            <?php else: ?>
                <div class="files">
                    <?php foreach ($files as $fileName): ?>
                        <?php
                        $url = $uploadRelBase . '/' . rawurlencode($fileName);
                        $isImage = (bool) preg_match('/\.(jpg|jpeg|png|gif|webp)$/i', $fileName);
                        ?>
                        <a href="<?= e($url) ?>" target="_blank" rel="noopener">
                            <?php if ($isImage): ?>
                                <img src="<?= e($url) ?>" alt="Arquivo enviado">
                            <?php else: ?>
                                <div class="file-generic">Abrir arquivo<br><?= e($fileName) ?></div>
                            <?php endif; ?>
                        </a>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
