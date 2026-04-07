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

$required = ['nome_interessado', 'whatsapp', 'cidade', 'estado', 'qtd_caminhoes'];
foreach ($required as $field) {
    if (post_str($field) === '') {
        http_response_code(422);
        echo json_encode(['ok' => false, 'message' => 'Preencha os campos obrigatorios.']);
        exit;
    }
}

$anexos = [];
$uploadDir = dirname(__DIR__) . '/uploads/licenciamento';
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
        $name = 'lic_' . date('Ymd_His') . '_' . bin2hex(random_bytes(4)) . '.' . $ext;
        $target = $uploadDir . '/' . $name;

        if (move_uploaded_file($tmpName, $target)) {
            $anexos[] = $name;
        }
    }
}

$data = [
    'nome_interessado' => post_str('nome_interessado'),
    'empresa' => post_str('empresa'),
    'cnpj' => post_str('cnpj'),
    'cargo' => post_str('cargo'),
    'whatsapp' => post_str('whatsapp'),
    'email' => post_str('email'),
    'cidade' => post_str('cidade'),
    'estado' => strtoupper(post_str('estado')),
    'qtd_caminhoes' => post_str('qtd_caminhoes'),
    'tipos_operacao_json' => post_array_json('tipos_operacao'),
    'fretes_mensais' => post_nullable_number('fretes_mensais'),
    'ticket_medio' => post_nullable_number('ticket_medio'),
    'faturamento_estimado' => post_nullable_number('faturamento_estimado'),
    'regiao_interesse' => post_str('regiao_interesse'),
    'territorio_interesse' => post_str('territorio_interesse'),
    'modalidades_interesse_json' => post_array_json('modalidades_interesse'),
    'possui_base_operacional' => post_str('possui_base_operacional'),
    'area_base' => post_nullable_number('area_base'),
    'equipe_operacional' => post_nullable_number('equipe_operacional'),
    'investimento_disponivel' => post_str('investimento_disponivel'),
    'prazo_implantacao' => post_str('prazo_implantacao'),
    'observacoes' => post_str('observacoes'),
    'anexos_json' => json_encode($anexos, JSON_UNESCAPED_UNICODE),
    'ip_origem' => client_ip(),
    'user_agent' => substr((string) ($_SERVER['HTTP_USER_AGENT'] ?? ''), 0, 1000),
];

$sql = 'INSERT INTO cadastro_licenciamento_marca (
    nome_interessado, empresa, cnpj, cargo, whatsapp, email, cidade, estado, qtd_caminhoes,
    tipos_operacao_json, fretes_mensais, ticket_medio, faturamento_estimado, regiao_interesse,
    territorio_interesse, modalidades_interesse_json, possui_base_operacional, area_base,
    equipe_operacional, investimento_disponivel, prazo_implantacao, observacoes, anexos_json,
    ip_origem, user_agent
) VALUES (
    :nome_interessado, :empresa, :cnpj, :cargo, :whatsapp, :email, :cidade, :estado, :qtd_caminhoes,
    :tipos_operacao_json, :fretes_mensais, :ticket_medio, :faturamento_estimado, :regiao_interesse,
    :territorio_interesse, :modalidades_interesse_json, :possui_base_operacional, :area_base,
    :equipe_operacional, :investimento_disponivel, :prazo_implantacao, :observacoes, :anexos_json,
    :ip_origem, :user_agent
)';

try {
    $stmt = get_pdo()->prepare($sql);
    $stmt->execute($data);
    echo json_encode(['ok' => true, 'message' => 'Solicitacao enviada com sucesso.']);
} catch (Throwable $e) {
    http_response_code(500);
    echo json_encode(['ok' => false, 'message' => 'Erro ao salvar solicitacao.']);
}
