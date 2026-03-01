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

$stmt = $pdo->query("SELECT id, title, slug, status, created_at, scheduled_at, image FROM posts ORDER BY created_at DESC");
$posts = $stmt->fetchAll();
?>

<div class="container-fluid px-4 py-4 df">
	<div class="d-flex justify-content-between align-items-center mb-4">
		<h4 class="mb-0">Gerenciar Postagens</h4>
		<input type="text" id="searchPost" class="form-control w-25" placeholder="Buscar posts...">
	</div>

	<div class="table-responsive">
		<table class="table table-hover align-middle table-striped">
			<thead class="table-light">
				<tr>
					<th>Imagem</th>
					<th>Título</th>
					<th>Status</th>
					<th>Agendado para</th>
					<th>Criado em</th>
					<th class="text-center" style="width: 180px;">Ações</th>
				</tr>
			</thead>
			<tbody id="postsTable">
				<?php foreach ($posts as $post): ?>
				<tr>
					<td>
						<?php if (!empty($post['image'])): ?>
						<img src="/admin_blog/<?= $post['image'] ?>" alt="thumb"
							style="width: 60px; border-radius: 6px;">
						<?php else: ?>
						<span class="text-muted small">—</span>
						<?php endif; ?>
					</td>
					<td>
						<a href="edit.php?id=<?= $post['id'] ?>" class="text-decoration-none fw-semibold">
							<?= htmlspecialchars(mb_strimwidth($post['title'], 0, 60, '...')) ?>
						</a>
					</td>
					<td>
						<span
							class="badge bg-<?= $post['status'] === 'publicado' ? 'success' : ($post['status'] === 'agendado' ? 'info' : 'secondary') ?>">
							<i
								class="fa <?= $post['status'] === 'publicado' ? 'fa-check-circle' : ($post['status'] === 'agendado' ? 'fa-clock' : 'fa-pencil-alt') ?>"></i>
							<?= ucfirst($post['status']) ?>
						</span>
					</td>
					<td>
						<?= $post['status'] === 'agendado' ? date('d/m/Y H:i', strtotime($post['scheduled_at'])) : '-' ?>
					</td>
					<td>
						<?= date('d/m/Y H:i', strtotime($post['created_at'])) ?>
					</td>
					<td class="text-center" style="padding: 1.2rem 0.5rem;">


						<?php
						$mensagem = "*Novo post publicado!* \n\n" .
						  "*Título:* " . $post['title'] . "\n\n" .
						  "Leia agora: https://" . $_SERVER['HTTP_HOST'] . "/blog/" . $post['slug'];
						
						$link_whatsapp = "https://wa.me/?text=" . rawurlencode($mensagem);
						?>
						<a href="<?= $link_whatsapp ?>" target="_blank" class="btn btn-sm btn-outline-success"
							title="Compartilhar no WhatsApp">
							<i class="fab fa-whatsapp"></i>
						</a>



						<a href="edit.php?id=<?= $post['id'] ?>" class="btn btn-sm btn-outline-warning" title="Editar">
							<i class="fa fa-edit"></i>
						</a>
						<a href="delete.php?id=<?= $post['id'] ?>" class="btn btn-sm btn-outline-danger"
							title="Excluir">
							<i class="fa fa-trash"></i>
						</a>
					</td>
				</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</div>

<style>
	.me-1 {
		margin-right: 0rem !important;
	}
</style>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
	$(document).ready(function () {
		$('#searchPost').on('keyup', function () {
			var value = $(this).val().toLowerCase();
			$("#postsTable tr").filter(function () {
				$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
			});
		});
	});
</script>

<?php if (isset($_GET['sucesso']) && $_GET['sucesso'] == 1): ?>
<script>
	Swal.fire({
		icon: 'success',
		title: 'Post salvo com sucesso!',
		showConfirmButton: false,
		timer: 2000
	});
</script>
<?php endif; ?>

<?php require_once '../../includes/footer.php'; ?>