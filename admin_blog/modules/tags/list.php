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

$stmt = $pdo->query("SELECT * FROM tags ORDER BY name ASC");
$tags = $stmt->fetchAll();
?>

<div class="container-fluid df">
	<div class="d-flex justify-content-between align-items-center mb-4">
		<h4>Tags</h4>
	</div>

	<table class="table table-bordered table-striped">
		<thead class="table-light">
			<tr>
				<th>Nome</th>
				<th>Slug</th>
			</tr>
		</thead>
		<tbody>
			<?php if (empty($tags)): ?>
			<tr>
				<td colspan="2" class="text-center text-muted">Nenhuma tag encontrada.</td>
			</tr>
			<?php else: ?>
			<?php foreach ($tags as $tag): ?>
			<tr>
				<td>
					<?= htmlspecialchars($tag['name']) ?>
				</td>
				<td>
					<?= htmlspecialchars($tag['slug']) ?>
				</td>
			</tr>
			<?php endforeach; ?>
			<?php endif; ?>
		</tbody>
	</table>
</div>

<?php require_once '../../includes/footer.php'; ?>