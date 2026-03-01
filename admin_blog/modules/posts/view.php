<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: ../../auth/login.php');
    exit;
}

require_once '../../config/config.php';
require_once '../../config/db.php';
require_once '../../includes/header.php';
require_once '../../includes/sidebar.php';
require_once '../../includes/topbar.php';

$id = $_GET['id'] ?? null;
if (!$id || !is_numeric($id)) {
    echo "<div class='alert alert-danger'>ID inválido.</div>";
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM posts WHERE id = :id AND is_deleted = FALSE");
$stmt->execute(['id' => $id]);
$post = $stmt->fetch();

if (!$post) {
    echo "<div class='alert alert-warning'>Post não encontrado.</div>";
    exit;
}

// Buscar nome da categoria
$categoria = '';
if ($post['category_id']) {
    $cat = $pdo->prepare("SELECT name FROM categories WHERE id = :id");
    $cat->execute(['id' => $post['category_id']]);
    $categoria = $cat->fetchColumn();
}

// Buscar tags
$tags_stmt = $pdo->prepare("
    SELECT t.name
    FROM tags t
    INNER JOIN post_tags pt ON pt.tag_id = t.id
    WHERE pt.post_id = :id
");
$tags_stmt->execute(['id' => $id]);
$tags = $tags_stmt->fetchAll(PDO::FETCH_COLUMN);
?>

<div class="container-fluid">
	<h4 class="mb-4">Visualizar Post</h4>

	<div class="card">
		<div class="card-body">
			<h3>
				<?= htmlspecialchars($post['title']) ?>
			</h3>
			<p><strong>Status:</strong>
				<?= ucfirst($post['status']) ?>
			</p>
			<p><strong>Categoria:</strong>
				<?= $categoria ?: 'Sem categoria' ?>
			</p>
			<p><strong>Tags:</strong>
				<?= implode(', ', $tags) ?: 'Nenhuma' ?>
			</p>
			<p><strong>Publicado em:</strong>
				<?= $post['published_at'] ? date('d/m/Y H:i', strtotime($post['published_at'])) : '—' ?>
			</p>

			<?php if ($post['image']): ?>
			<img src="../../<?= $post['image'] ?>" alt="Imagem do Post" class="img-fluid my-3" style="max-width:300px;">
			<?php endif; ?>

			<div class="mt-4">
				<?= $post['content'] ?>
			</div>
		</div>
	</div>
</div>

<?php require_once '../../includes/footer.php'; ?>