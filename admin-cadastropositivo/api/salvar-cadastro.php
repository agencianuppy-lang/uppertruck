<?php
declare(strict_types=1);

require_once __DIR__ . '/../config.php';

header('Content-Type: application/json; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['ok' => false, 'message' => 'Método não permitido.']);
    exit;
}

function post_str(string $key): string
{
    return trim((string) ($_POST[$key] ?? ''));
}

function post_array_json(string $key): string
{
    $raw = $_POST[$key] ?? [];
    if (!is_array($raw)) {
        return json_encode([], JSON_UNESCAPED_UNICODE);
    }

    $items = array_values(array_filter(array_map(static function ($item) {
        return trim((string) $item);
    }, $raw), static function ($item) {
        return $item !== '';
    }));

    return json_encode($items, JSON_UNESCAPED_UNICODE);
}

function post_nullable_number(string $key): ?string
{
    $value = post_str($key);
    if ($value === '') {
        return null;
    }

    $value = str_replace(',', '.', $value);
    if (!is_numeric($value)) {
        return null;
    }

    return $value;
}

function client_ip(): string
{
    $keys = ['HTTP_X_FORWARDED_FOR', 'HTTP_CLIENT_IP', 'REMOTE_ADDR'];
    foreach ($keys as $k) {
        $value = trim((string) ($_SERVER[$k] ?? ''));
        if ($value !== '') {
            if (strpos($value, ',') !== false) {
                $parts = explode(',', $value);
                return trim((string) $parts[0]);
            }
            return $value;
        }
    }
    return '';
}

$required = ['razao_social', 'nome_fantasia', 'cnpj', 'whatsapp', 'responsavel', 'cargo', 'email', 'endereco', 'bairro', 'cidade', 'estado', 'cep'];
foreach ($required as $field) {
    if (post_str($field) === '') {
        http_response_code(422);
        echo json_encode(['ok' => false, 'message' => 'Preencha os campos obrigatórios.']);
        exit;
    }
}

$fotos = [];
$uploadDir = dirname(__DIR__) . '/uploads';
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0775, true);
}

if (isset($_FILES['fotos']) && is_array($_FILES['fotos']['name'])) {
    $finfo = new finfo(FILEINFO_MIME_TYPE);
    $allowed = [
        'image/jpeg' => 'jpg',
        'image/png' => 'png',
        'image/webp' => 'webp',
        'image/gif' => 'gif',
    ];

    $total = count($_FILES['fotos']['name']);
    for ($i = 0; $i < $total; $i++) {
        if (!isset($_FILES['fotos']['error'][$i]) || (int) $_FILES['fotos']['error'][$i] !== UPLOAD_ERR_OK) {
            continue;
        }

        $tmpName = (string) $_FILES['fotos']['tmp_name'][$i];
        if (!is_uploaded_file($tmpName)) {
            continue;
        }

        $mime = $finfo->file($tmpName) ?: '';
        if (!isset($allowed[$mime])) {
            continue;
        }

        $ext = $allowed[$mime];
        $name = 'foto_' . date('Ymd_His') . '_' . bin2hex(random_bytes(4)) . '.' . $ext;
        $target = $uploadDir . '/' . $name;

        if (move_uploaded_file($tmpName, $target)) {
            $fotos[] = $name;
        }
    }
}

$data = [
    'razao_social' => post_str('razao_social'),
    'nome_fantasia' => post_str('nome_fantasia'),
    'cnpj' => post_str('cnpj'),
    'whatsapp' => post_str('whatsapp'),
    'responsavel' => post_str('responsavel'),
    'cargo' => post_str('cargo'),
    'email' => post_str('email'),
    'endereco' => post_str('endereco'),
    'bairro' => post_str('bairro'),
    'cidade' => post_str('cidade'),
    'estado' => strtoupper(post_str('estado')),
    'cep' => post_str('cep'),
    'distancia_centro' => post_nullable_number('distancia_centro'),
    'tipo_imovel' => post_str('tipo_imovel'),
    'tempo_ocupacao' => post_str('tempo_ocupacao'),
    'area_terreno' => post_nullable_number('area_terreno'),
    'area_coberta' => post_nullable_number('area_coberta'),
    'area_patio' => post_nullable_number('area_patio'),
    'tipo_estrutura' => post_str('tipo_estrutura'),
    'tipo_piso' => post_str('tipo_piso'),
    'pe_direito' => post_str('pe_direito'),
    'veiculos_json' => post_array_json('veiculos'),
    'restricao_acesso' => post_str('restricao_acesso'),
    'obs_acesso' => post_str('obs_acesso'),
    'cap_paletes' => post_nullable_number('cap_paletes'),
    'cap_toneladas' => post_nullable_number('cap_toneladas'),
    'qtd_docas' => post_nullable_number('qtd_docas'),
    'possui_docas' => post_str('possui_docas'),
    'equip_json' => post_array_json('equip'),
    'qtd_equip' => post_str('qtd_equip'),
    'colaboradores' => post_nullable_number('colaboradores'),
    'funcionamento' => post_str('funcionamento'),
    'seg_json' => post_array_json('seg'),
    'serv_json' => post_array_json('serv'),
    'cargas_json' => post_array_json('cargas'),
    'restricoes_carga' => post_str('restricoes_carga'),
    'observacoes' => post_str('observacoes'),
    'fotos_json' => json_encode($fotos, JSON_UNESCAPED_UNICODE),
    'ip_origem' => client_ip(),
    'user_agent' => substr((string) ($_SERVER['HTTP_USER_AGENT'] ?? ''), 0, 1000),
];

$sql = 'INSERT INTO cadastro_deposito_logistico (
    razao_social, nome_fantasia, cnpj, whatsapp, responsavel, cargo, email,
    endereco, bairro, cidade, estado, cep, distancia_centro, tipo_imovel, tempo_ocupacao,
    area_terreno, area_coberta, area_patio, tipo_estrutura, tipo_piso, pe_direito,
    veiculos_json, restricao_acesso, obs_acesso, cap_paletes, cap_toneladas, qtd_docas, possui_docas,
    equip_json, qtd_equip, colaboradores, funcionamento, seg_json, serv_json, cargas_json,
    restricoes_carga, observacoes, fotos_json, ip_origem, user_agent
) VALUES (
    :razao_social, :nome_fantasia, :cnpj, :whatsapp, :responsavel, :cargo, :email,
    :endereco, :bairro, :cidade, :estado, :cep, :distancia_centro, :tipo_imovel, :tempo_ocupacao,
    :area_terreno, :area_coberta, :area_patio, :tipo_estrutura, :tipo_piso, :pe_direito,
    :veiculos_json, :restricao_acesso, :obs_acesso, :cap_paletes, :cap_toneladas, :qtd_docas, :possui_docas,
    :equip_json, :qtd_equip, :colaboradores, :funcionamento, :seg_json, :serv_json, :cargas_json,
    :restricoes_carga, :observacoes, :fotos_json, :ip_origem, :user_agent
)';

try {
    $stmt = get_pdo()->prepare($sql);
    $stmt->execute($data);
    echo json_encode(['ok' => true, 'message' => 'Cadastro enviado com sucesso.']);
} catch (Throwable $e) {
    http_response_code(500);
    echo json_encode(['ok' => false, 'message' => 'Erro ao salvar cadastro.']);
}
