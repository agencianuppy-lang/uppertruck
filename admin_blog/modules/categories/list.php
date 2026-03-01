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

// Buscar todas as categorias
$stmt = $pdo->query("SELECT * FROM categories ORDER BY name ASC");
$categorias = $stmt->fetchAll();
?>

<div class="container-fluid df">
	<div class="d-flex justify-content-between align-items-center mb-4">
		<h4>Categorias</h4>
		<a href="create.php" class="btn btn-primary">
			<i class="fa fa-plus"></i> Nova Categoria
		</a>
	</div>

	<table class="table table-bordered table-hover">
		<thead class="table-light">
			<tr>
				<th>Nome</th>
				<th>Slug</th>
				<th style="width: 130px;">Ações</th>
			</tr>
		</thead>
		<tbody>
			<?php if (empty($categorias)): ?>
			<tr>
				<td colspan="3" class="text-center text-muted">Nenhuma categoria encontrada.</td>
			</tr>
			<?php else: ?>
			<?php foreach ($categorias as $cat): ?>
			<tr>
				<td>
					<?= htmlspecialchars($cat['name']) ?>
				</td>
				<td>
					<?= htmlspecialchars($cat['slug']) ?>
				</td>
				<td style="padding: 1.2rem 0.5rem;">
					<a href="edit.php?id=<?= $cat['id'] ?>" class="btn btn-sm btn-warning">
						<i class="fa fa-edit"></i>
					</a>
					<a href="delete.php?id=<?= $cat['id'] ?>" class="btn btn-sm btn-danger"
						onclick="return confirm('Tem certeza que deseja excluir?')">
						<i class="fa fa-trash"></i>
					</a>
				</td>
			</tr>
			<?php endforeach; ?>
			<?php endif; ?>
		</tbody>
	</table>
</div>

<?php require_once '../../includes/footer.php'; ?>