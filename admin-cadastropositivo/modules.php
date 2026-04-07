<?php
declare(strict_types=1);

function cadastropositivo_modules(): array
{
    return [
        'deposito' => [
            'key' => 'deposito',
            'menu_label' => 'Cadastro de Deposito Logistico',
            'title' => 'Cadastros de Deposito Logistico',
            'subtitle' => 'Mapeamento estrutural para armazenagem, transbordo e apoio',
            'icon' => 'bi bi-box-seam',
            'table' => 'cadastro_deposito_logistico',
            'public_form' => '/cadastro-deposito-logistico.php',
            'search_columns' => ['razao_social', 'nome_fantasia', 'cnpj', 'cidade', 'responsavel'],
            'search_placeholder' => 'Buscar por empresa, CNPJ, cidade ou responsavel',
            'upload_json_field' => 'fotos_json',
            'upload_subdir' => '',
            'list_sql' => 'id, razao_social, nome_fantasia, cnpj, cidade, estado, responsavel, criado_em',
        ],
        'licenciamento' => [
            'key' => 'licenciamento',
            'menu_label' => 'Licenciamento de Marca',
            'title' => 'Solicitacoes de Licenciamento de Marca',
            'subtitle' => 'Candidatos para expansao regional da marca',
            'icon' => 'bi bi-award',
            'table' => 'cadastro_licenciamento_marca',
            'public_form' => '/licenciamento-marca.php',
            'search_columns' => ['nome_interessado', 'empresa', 'cidade', 'estado', 'whatsapp'],
            'search_placeholder' => 'Buscar por nome, empresa, cidade ou WhatsApp',
            'upload_json_field' => 'anexos_json',
            'upload_subdir' => 'licenciamento',
            'list_sql' => 'id, nome_interessado, empresa, whatsapp, cidade, estado, qtd_caminhoes, criado_em',
        ],
        'motorista' => [
            'key' => 'motorista',
            'menu_label' => 'Cadastro de Motorista',
            'title' => 'Cadastros de Motorista / Contrato TAC',
            'subtitle' => 'Cadastro e formalizacao contratual de motoristas autonomos',
            'icon' => 'bi bi-person-badge',
            'table' => 'cadastro_motorista_contrato',
            'public_form' => '/cadastro-motorista.php',
            'search_columns' => ['nome_completo', 'cpf', 'rntrc', 'placa_cavalo', 'categoria_veiculo'],
            'search_placeholder' => 'Buscar por nome, CPF, RNTRC, placa ou categoria',
            'upload_json_field' => 'anexos_json',
            'upload_subdir' => 'motorista',
            'list_sql' => 'id, nome_completo, cpf, rntrc, placa_cavalo, categoria_veiculo, criado_em',
        ],
    ];
}

function cadastropositivo_resolve_module(?string $moduleKey = null): array
{
    $modules = cadastropositivo_modules();
    $key = trim((string) $moduleKey);

    if ($key === '' || !isset($modules[$key])) {
        return $modules['deposito'];
    }

    return $modules[$key];
}
