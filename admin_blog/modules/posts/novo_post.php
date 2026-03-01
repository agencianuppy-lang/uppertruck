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

// Buscar categorias
$stmt = $pdo->query("SELECT id, nome FROM categories ORDER BY nome");
$categorias = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container-fluid">
    <h4 class="mb-4">Novo Post</h4>

    <form method="POST" action="salvar_post.php" enctype="multipart/form-data" class="col-md-10">
        <div class="mb-3">
            <label class="form-label">Título do Post</label>
            <input type="text" name="titulo" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Slug (url-amigavel)</label>
            <input type="text" name="slug" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Categoria</label>
            <select name="categoria_id" class="form-select" required>
                <option value="">-- Selecione --</option>
                <?php foreach ($categorias as $cat): ?>
                <option value="<?= $cat['id'] ?>">
                    <?= $cat['nome'] ?>
                </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Imagem Destacada</label>
            <input type="file" name="imagem" class="form-control" accept="image/*">
        </div>

        <div class="mb-3">
            <label class="form-label">Conteúdo</label>
            <textarea name="conteudo" class="form-control" id="editor"></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Data de Publicação</label>
            <input type="datetime-local" name="data_publicacao" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Publicar</button>
    </form>
</div>

<script src="https://cdn.ckeditor.com/4.20.2/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('editor');
</script>

<?php require_once '../../includes/footer.php'; ?>