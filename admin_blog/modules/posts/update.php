<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: ../../auth/login.php');
    exit;
}

require_once '../../config/config.php';
require_once '../../config/db.php';
require_once '../../core/functions.php';

$id               = $_POST['id'] ?? null;
$title            = $_POST['title'] ?? '';
$slug             = $_POST['slug'] ?? '';
$category_id      = $_POST['category_id'] ?? null;
$tags_input       = $_POST['tags'] ?? '';
$status           = $_POST['status'] ?? 'rascunho';
$scheduled_at_raw = $_POST['scheduled_at'] ?? null;
$meta_title       = $_POST['meta_title'] ?? '';
$meta_description = $_POST['meta_description'] ?? '';
$content          = $_POST['content'] ?? '';
$updated_at       = date('Y-m-d H:i:s');

// Converte agendamento
$scheduled = $scheduled_at_raw ? date('Y-m-d H:i:s', strtotime($scheduled_at_raw)) : null;

if (!$id) {
    header('Location: list.php');
    exit;
}

// Define imagem atual (começa nula)
$image_path = null;

// Geração com IA
// Substitui se houve geração com IA (baixar e salvar localmente)
if (!empty($_POST['image_url'])) {
    $url = $_POST['image_url'];
    $ext = '.png';
    $nome_arquivo = time() . '_' . uniqid() . $ext;
    $caminho_absoluto = __DIR__ . '/../../assets/uploads/' . $nome_arquivo;
    $caminho_relat = 'assets/uploads/' . $nome_arquivo;

    $img_data = file_get_contents($url);
    if ($img_data) {
        file_put_contents($caminho_absoluto, $img_data);
        $image_path = $caminho_relat;
    }
}


// Upload manual
if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
    $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
    $nome_arquivo = time() . '_' . uniqid() . '.' . $ext;
    $destino = '../../assets/uploads/' . $nome_arquivo;
    if (move_uploaded_file($_FILES['image']['tmp_name'], $destino)) {
        $image_path = 'assets/uploads/' . $nome_arquivo;
    }
}

// Atualiza o post
$sql = "UPDATE posts SET
    title = :title,
    slug = :slug,
    content = :content,
    status = :status,
    scheduled_at = :scheduled_at,
    category_id = :category_id,
    meta_title = :meta_title,
    meta_description = :meta_description,
    updated_at = :updated_at";

$params = [
    'title' => $title,
    'slug' => $slug,
    'content' => $content,
    'status' => $status,
    'scheduled_at' => $scheduled,
    'category_id' => $category_id,
    'meta_title' => $meta_title,
    'meta_description' => $meta_description,
    'updated_at' => $updated_at,
    'id' => $id
];

// Se tem nova imagem
if ($image_path) {
    $sql .= ", image = :image";
    $params['image'] = $image_path;
}

$sql .= " WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->execute($params);

// Atualiza as tags
$pdo->prepare("DELETE FROM post_tags WHERE post_id = :post_id")
    ->execute(['post_id' => $id]);

if (!empty($tags_input)) {
    $tags = array_map('trim', explode(',', $tags_input));
    foreach ($tags as $tag) {
        if ($tag === '') continue;

        // Verifica se a tag já existe
        $stmt = $pdo->prepare("SELECT id FROM tags WHERE name = :name");
        $stmt->execute(['name' => $tag]);
        $tag_data = $stmt->fetch();

        if ($tag_data) {
            $tag_id = $tag_data['id'];
        } else {
            $slug_tag = strtolower(preg_replace('/[^a-z0-9]+/i', '-', $tag));
            $stmt = $pdo->prepare("INSERT INTO tags (name, slug) VALUES (:name, :slug)");
            $stmt->execute(['name' => $tag, 'slug' => $slug_tag]);
            $tag_id = $pdo->lastInsertId();
        }

        $stmt = $pdo->prepare("INSERT INTO post_tags (post_id, tag_id) VALUES (:post_id, :tag_id)");
        $stmt->execute(['post_id' => $id, 'tag_id' => $tag_id]);
    }
}

// Envia e-mail se foi publicado
if ($status === 'publicado') {
    global $public_url;
    $link = $public_url . "/blog/" . $slug;
    $assunto = "Post publicado ou atualizado: $title";
    $mensagem = "
        <h2>Publicação no blog</h2>
        <p><strong>$title</strong> foi publicado ou atualizado com sucesso.</p>
        <p><a href='$link'>Clique aqui para ver o post</a></p>
    ";

    $settings = getSettings();

    if (!empty($settings['email_admin'])) {
        enviarEmailSMTP($settings['email_admin'], $assunto, $mensagem);
    }

    if (!empty($settings['email_cliente'])) {
        enviarEmailSMTP($settings['email_cliente'], $assunto, $mensagem);
    }
}

header('Location: list.php?sucesso=1');
exit;