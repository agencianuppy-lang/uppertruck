<?php
session_start();
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['role'] !== 'admin') {
	header('Location: ../../auth/login.php');
	exit;
}

require_once '../../config/config.php';
require_once '../../config/db.php';
require_once '../../includes/header.php';
require_once '../../includes/sidebar.php';
require_once '../../includes/topbar.php';

$id = $_GET['id'] ?? null;

$stmt = $pdo->prepare("SELECT * FROM posts WHERE id = ?");
$stmt->execute([$id]);
$post = $stmt->fetch();

$categorias = $pdo->query("SELECT id, name FROM categories ORDER BY name")->fetchAll();
?>

<div class="container-fluid">
    <h4 class="mb-4">Editar Post</h4>

    <form method="POST" action="update.php" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $post['id'] ?>">

        <div class="mb-3">
            <label class="form-label">Título</label>
            <input type="text" name="titulo" class="form-control" value="<?= htmlspecialchars($post['title']) ?>"
                required>
        </div>

        <div class="mb-3">
            <label class="form-label">Slug</label>
            <input type="text" name="slug" class="form-control" value="<?= htmlspecialchars($post['slug']) ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Categoria</label>
            <select name="categoria_id" class="form-select" required>
                <option value="">Selecione</option>
                <?php foreach ($categorias as $cat): ?>
                <option value="<?= $cat['id'] ?>" <?=$cat['id']==$post['category_id'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($cat['name']) ?>
                </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Conteúdo</label>
            <textarea name="conteudo" id="editor" class="form-control"
                rows="10"><?= htmlspecialchars($post['content']) ?></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Imagem Destacada</label><br>
            <?php if ($post['image']): ?>
            <img src="../../<?= $post['image'] ?>" width="200" class="mb-2"><br>
            <?php endif; ?>
            <input type="file" name="imagem" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Data de Publicação</label>
            <input type="datetime-local" name="data_publicacao" class="form-control"
                value="<?= $post['scheduled_at'] ? date('Y-m-d\TH:i', strtotime($post['scheduled_at'])) : '' ?>">
        </div>

        <button type="submit" class="btn btn-primary">Salvar Alterações</button>
        <a href="list_posts.php" class="btn btn-secondary">Cancelar</a>
    </form>
</div>

<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
<script>
    ClassicEditor.create(document.querySelector('#editor')).catch(error => console.error(error));
</script>

<?php require_once '../../includes/footer.php'; ?>