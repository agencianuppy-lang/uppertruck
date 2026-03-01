<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header('Location: auth/login.php');
    exit;
}

require_once 'config/config.php';
require_once 'config/db.php';
require_once 'includes/header.php';
require_once 'includes/sidebar.php';
require_once 'includes/topbar.php';

$nome_usuario = $_SESSION['usuario']['nome'];

// Contagens
$total_posts = $pdo->query("SELECT COUNT(*) FROM posts")->fetchColumn();
$publicados = $pdo->query("SELECT COUNT(*) FROM posts WHERE status = 'publicado'")->fetchColumn();
$agendados = $pdo->query("SELECT COUNT(*) FROM posts WHERE status = 'agendado'")->fetchColumn();
$rascunhos = $pdo->query("SELECT COUNT(*) FROM posts WHERE status = 'rascunho'")->fetchColumn();

// Últimos posts
$stmt = $pdo->query("SELECT id, title, created_at, status FROM posts ORDER BY created_at DESC LIMIT 5");
$ultimos_posts = $stmt->fetchAll();
?>

<div class="container-fluid mt-4 df">
	<h4>Olá,
		<?= htmlspecialchars($nome_usuario) ?> 👋
	</h4>

	<div class="row mt-4">
		<div class="col-md-3 mb-3">
			<a href="modules/posts/list.php" class="text-decoration-none text-dark">
				<div class="card border-primary hover-shadow">
					<div class="card-body text-center">
						<img src="assets/img/1v.png" alt="" class="gt" id="img-publicado2">
						<h5 class="card-title">Total de Posts</h5>
						<h3>
							<span class="pulse-number">
								<?= $total_posts ?>
							</span>
						</h3>
					</div>
				</div>
			</a>
		</div>
		<div class="col-md-3 mb-3">
			<a href="modules/posts/list.php" class="text-decoration-none text-dark">
				<div class="card border-success hover-shadow">
					<div class="card-body text-center">
						<img src="assets/img/2v.png" alt="" class="gt" id="img-publicado">
						<h5 class="card-title">Publicados</h5>

						<h3>
							<span class="pulse-number">
								<?= $publicados ?>
							</span>
						</h3>
					</div>
				</div>
			</a>
		</div>
		<div class="col-md-3 mb-3">
			<a href="modules/posts/list.php" class="text-decoration-none text-dark">
				<div class="card border-info hover-shadow">
					<div class="card-body text-center">
						<img src="assets/img/3v.png" alt="" class="gt">
						<h5 class="card-title">Agendados</h5>
						<h3>
							<span class="pulse-number">
								<?= $agendados ?>
							</span>
						</h3>
					</div>
				</div>
			</a>
		</div>
		<div class="col-md-3 mb-3">
			<a href="modules/posts/list.php" class="text-decoration-none text-dark">
				<div class="card border-secondary hover-shadow">
					<div class="card-body text-center">
						<img src="assets/img/4v.png" alt="" class="gt">
						<h5 class="card-title">Rascunhos</h5>
						<h3>
							<span class="pulse-number">
								<?= $rascunhos ?>
							</span>
						</h3>
					</div>
				</div>
			</a>
		</div>
	</div>


	<div class="mt-5">
		<h5>Últimos Posts</h5>
		<table class="table table-bordered table-striped mt-3">
			<thead>
				<tr>
					<th>Título</th>
					<th>Data</th>
					<th>Status</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($ultimos_posts as $post): ?>
				<tr>
					<td>
						<a href="modules/posts/edit.php?id=<?= $post['id'] ?>">
							<?= htmlspecialchars($post['title']) ?>
						</a>
					</td>
					<td>
						<?= date('d/m/Y H:i', strtotime($post['created_at'])) ?>
					</td>
					<td>
						<span class="badge bg-<?=
                $post['status'] === 'publicado' ? 'success' :
                ($post['status'] === 'agendado' ? 'info' : 'secondary')
              ?>">
							<?= ucfirst($post['status']) ?>
						</span>
					</td>
				</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</div>

<style>
	.gt {
		width: 27vh !important;
		margin-bottom: 1rem;
	}

	.card h3 {
		font-size: 26px;
		font-weight: 700;
		background: #e7e7e7;
		color: #4339c0;
		width: fit-content;
		text-align: center;
		padding: 1rem 2rem;
		margin: 1rem auto 0 auto;
		border-radius: 6px;
	}

	.pulse-number {
		display: inline-block;
		animation: pulseFont 1.5s infinite;
	}

	/* Só o número pulsa */
	@keyframes pulseFont {
		0% {
			transform: scale(1);
		}

		50% {
			transform: scale(1.2);
		}

		100% {
			transform: scale(1);
		}
	}
</style>

<?php require_once 'includes/footer.php'; ?>