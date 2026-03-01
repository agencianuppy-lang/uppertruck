<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: ../../auth/login.php');
    exit;
}

require_once '../../config/config.php';
require_once '../../config/db.php';
require_once '../../core/functions.php';

$title            = $_POST['title'] ?? '';
$slug             = $_POST['slug'] ?? '';
$category_id      = $_POST['category_id'] ?? null;
$tags_input       = $_POST['tags'] ?? '';
$status           = $_POST['status'] ?? 'rascunho';
$scheduled_at_raw = $_POST['scheduled_at'] ?? null;
$meta_title       = $_POST['meta_title'] ?? '';
$meta_description = $_POST['meta_description'] ?? '';
$content          = $_POST['content'] ?? '';
$author_id        = $_SESSION['usuario']['id'];
$salvar           = $_POST['salvar'] ?? 'rascunho';

$image_path = null;

// Se veio imagem gerada por IA (via input hidden)
if (!empty($_POST['image_url'])) {
    $url = $_POST['image_url'];
    $ext = 'jpg'; // default
    $nome_arquivo = time() . '_' . uniqid() . '.' . $ext;
    $destino = '../../assets/uploads/' . $nome_arquivo;

    // Baixa e salva no servidor
    $conteudo = @file_get_contents($url);
    if ($conteudo !== false && file_put_contents($destino, $conteudo)) {
        $image_path = 'assets/uploads/' . $nome_arquivo;
    }
}

// Ou imagem enviada manualmente
if (!$image_path && isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
    $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
    $nome_arquivo = time() . '_' . uniqid() . '.' . $ext;
    $destino = '../../assets/uploads/' . $nome_arquivo;

    if (move_uploaded_file($_FILES['image']['tmp_name'], $destino)) {
        $image_path = 'assets/uploads/' . $nome_arquivo;
    }
}


// Agendamento e publicação
$created_at   = date('Y-m-d H:i:s');
$published_at = ($salvar === 'publicar' && $status === 'publicado') ? $created_at : null;
$scheduled    = $scheduled_at_raw ? date('Y-m-d H:i:s', strtotime($scheduled_at_raw)) : null;

// Inserir post
$sql = "INSERT INTO posts 
(title, slug, content, image, status, scheduled_at, published_at, category_id, author_id, meta_title, meta_description, created_at)
VALUES 
(:title, :slug, :content, :image, :status, :scheduled_at, :published_at, :category_id, :author_id, :meta_title, :meta_description, :created_at)";

$stmt = $pdo->prepare($sql);
$stmt->execute([
    'title'            => $title,
    'slug'             => $slug,
    'content'          => $content,
    'image'            => $image_path,
    'status'           => $status,
    'scheduled_at'     => $scheduled,
    'published_at'     => $published_at,
    'category_id'      => $category_id,
    'author_id'        => $author_id,
    'meta_title'       => $meta_title,
    'meta_description' => $meta_description,
    'created_at'       => $created_at
]);

$post_id = $pdo->lastInsertId();

// Processar tags
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

        // Relacionar post e tag
        $stmt = $pdo->prepare("INSERT INTO post_tags (post_id, tag_id) VALUES (:post_id, :tag_id)");
        $stmt->execute(['post_id' => $post_id, 'tag_id' => $tag_id]);
    }
}

// Envio de e-mail se publicado diretamente
if ($status === 'publicado') {
    global $public_url;
    $link = $public_url . "/detalhe-newblog.php?slug=" . $slug;
    $assunto = "Novo post publicado: $title";
    $mensagem = "
        <h2>Publicação no blog</h2>
        <p><strong>$title</strong> foi publicado com sucesso.</p>
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