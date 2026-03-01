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

// Buscar posts marcados como excluídos
$stmt = $pdo->query("SELECT id, title, status, created_at FROM posts WHERE is_deleted = TRUE ORDER BY created_at DESC");
$posts = $stmt->fetchAll();
?>

<div class="container-fluid">
	<div class="d-flex justify-content-between align-items-center mb-4">
		<h4>Lixeira de Posts</h4>
		<a href="list.php" class="btn btn-outline-secondary">
			<i class="fa fa-arrow-left me-1"></i> Voltar à Lista
		</a>
	</div>

	<table class="table table-bordered table-striped">
		<thead class="table-light">
			<tr>
				<th>Título</th>
				<th>Status</th>
				<th>Data de Criação</th>
				<th style="width: 120px;">Ação</th>
			</tr>
		</thead>
		<tbody>
			<?php if (empty($posts)): ?>
			<tr>
				<td colspan="4" class="text-center text-muted">Nenhum post excluído encontrado.</td>
			</tr>
			<?php else: ?>
			<?php foreach ($posts as $post): ?>
			<tr>
				<td>
					<?= htmlspecialchars($post['title']) ?>
				</td>
				<td>
					<span class="badge bg-<?=
                $post['status'] === 'publicado' ? 'success' :
                ($post['status'] === 'agendado' ? 'info' : 'secondary')
              ?>">
						<?= ucfirst($post['status']) ?>
					</span>
				</td>
				<td>
					<?= date('d/m/Y H:i', strtotime($post['created_at'])) ?>
				</td>
				<td>
					<a href="restore.php?id=<?= $post['id'] ?>" class="btn btn-sm btn-success">
						<i class="fa fa-rotate-left"></i> Restaurar
					</a>
				</td>
			</tr>
			<?php endforeach; ?>
			<?php endif; ?>
		</tbody>
	</table>
</div>

<?php require_once '../../includes/footer.php'; ?>