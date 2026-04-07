<?php
declare(strict_types=1);

require_once __DIR__ . '/../config.php';

header('Content-Type: application/json; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['ok' => false, 'message' => 'Metodo nao permitido.']);
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

$required = ['nome_completo', 'cpf', 'rntrc', 'whatsapp', 'placa_cavalo', 'categoria_veiculo', 'valor_frete', 'prazo_pagamento', 'prazo_contrato_dias'];
foreach ($required as $field) {
    if (post_str($field) === '') {
        http_response_code(422);
        echo json_encode(['ok' => false, 'message' => 'Preencha os campos obrigatorios.']);
        exit;
    }
}

if (post_str('aceite_clausulas') !== '1' || post_str('aceite_lgpd') !== '1') {
    http_response_code(422);
    echo json_encode(['ok' => false, 'message' => 'Confirme os aceites obrigatorios do contrato.']);
    exit;
}

$anexos = [];
$uploadDir = dirname(__DIR__) . '/uploads/motorista';
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0775, true);
}

if (isset($_FILES['anexos']) && is_array($_FILES['anexos']['name'])) {
    $finfo = new finfo(FILEINFO_MIME_TYPE);
    $allowed = [
        'image/jpeg' => 'jpg',
        'image/png' => 'png',
        'image/webp' => 'webp',
        'image/gif' => 'gif',
        'application/pdf' => 'pdf',
    ];

    $total = count($_FILES['anexos']['name']);
    for ($i = 0; $i < $total; $i++) {
        if (!isset($_FILES['anexos']['error'][$i]) || (int) $_FILES['anexos']['error'][$i] !== UPLOAD_ERR_OK) {
            continue;
        }

        $tmpName = (string) $_FILES['anexos']['tmp_name'][$i];
        if (!is_uploaded_file($tmpName)) {
            continue;
        }

        $mime = $finfo->file($tmpName) ?: '';
        if (!isset($allowed[$mime])) {
            continue;
        }

        $ext = $allowed[$mime];
        $name = 'mot_' . date('Ymd_His') . '_' . bin2hex(random_bytes(4)) . '.' . $ext;
        $target = $uploadDir . '/' . $name;

        if (move_uploaded_file($tmpName, $target)) {
            $anexos[] = $name;
        }
    }
}

$data = [
    'nome_completo' => post_str('nome_completo'),
    'cpf' => post_str('cpf'),
    'rntrc' => post_str('rntrc'),
    'whatsapp' => post_str('whatsapp'),
    'email' => post_str('email'),
    'placa_cavalo' => strtoupper(post_str('placa_cavalo')),
    'placa_carreta_1' => strtoupper(post_str('placa_carreta_1')),
    'placa_carreta_2' => strtoupper(post_str('placa_carreta_2')),
    'categoria_veiculo' => post_str('categoria_veiculo'),
    'modalidades_json' => post_array_json('modalidades'),
    'formas_contratacao_json' => post_array_json('formas_contratacao'),
    'valor_frete' => post_nullable_number('valor_frete'),
    'prazo_pagamento' => post_str('prazo_pagamento'),
    'formas_pagamento_json' => post_array_json('formas_pagamento'),
    'prazo_contrato_dias' => post_nullable_number('prazo_contrato_dias'),
    'foro_juridico' => post_str('foro_juridico'),
    'aceite_clausulas' => post_str('aceite_clausulas') === '1' ? 'Sim' : 'Nao',
    'aceite_lgpd' => post_str('aceite_lgpd') === '1' ? 'Sim' : 'Nao',
    'observacoes' => post_str('observacoes'),
    'anexos_json' => json_encode($anexos, JSON_UNESCAPED_UNICODE),
    'ip_origem' => client_ip(),
    'user_agent' => substr((string) ($_SERVER['HTTP_USER_AGENT'] ?? ''), 0, 1000),
];

$sql = 'INSERT INTO cadastro_motorista_contrato (
    nome_completo, cpf, rntrc, whatsapp, email, placa_cavalo, placa_carreta_1, placa_carreta_2,
    categoria_veiculo, modalidades_json, formas_contratacao_json, valor_frete, prazo_pagamento,
    formas_pagamento_json, prazo_contrato_dias, foro_juridico, aceite_clausulas, aceite_lgpd,
    observacoes, anexos_json, ip_origem, user_agent
) VALUES (
    :nome_completo, :cpf, :rntrc, :whatsapp, :email, :placa_cavalo, :placa_carreta_1, :placa_carreta_2,
    :categoria_veiculo, :modalidades_json, :formas_contratacao_json, :valor_frete, :prazo_pagamento,
    :formas_pagamento_json, :prazo_contrato_dias, :foro_juridico, :aceite_clausulas, :aceite_lgpd,
    :observacoes, :anexos_json, :ip_origem, :user_agent
)';

try {
    $stmt = get_pdo()->prepare($sql);
    $stmt->execute($data);
    echo json_encode(['ok' => true, 'message' => 'Cadastro enviado com sucesso.']);
} catch (Throwable $e) {
    http_response_code(500);
    echo json_encode(['ok' => false, 'message' => 'Erro ao salvar cadastro de motorista.']);
}
