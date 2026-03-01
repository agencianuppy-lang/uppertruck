<?php
// DEBUG TEMPORÁRIO — remova depois em produção
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// includes com caminho absoluto
include(__DIR__ . '/../includes/auth.php');
include(__DIR__ . '/../includes/db.php');
include(__DIR__ . '/../includes/header.php');

// --- Métricas do dashboard ---
$resClientes = $conn->query("SELECT COUNT(*) AS total FROM clientes");
$totalClientes = $resClientes->fetch_assoc()['total'];

$resDocs = $conn->query("SELECT COUNT(*) AS total FROM documentos");
$totalDocs = $resDocs->fetch_assoc()['total'];

$resUltimo = $conn->query("SELECT id, data FROM documentos ORDER BY id DESC LIMIT 1");
$ultimoDoc  = $resUltimo->fetch_assoc();
$ultimoId   = $ultimoDoc ? $ultimoDoc['id'] : '-';
$dataUltimo = $ultimoDoc ? date("d/m/Y", strtotime($ultimoDoc['data'])) : '-';
?>

<div class="container py-5">
	<h2 class="mb-4">Bem-vindo,
		<?= htmlspecialchars($_SESSION['user'] ?? 'Admin') ?>!
	</h2>

	<div class="row g-4">
		<div class="col-md-4">
			<div class="card shadow-sm border-0 text-white bg-primary">
				<div class="card-body">
					<h5 class="card-title">Clientes Cadastrados</h5>
					<p class="card-text fs-3">
						<?= $totalClientes ?>
					</p>
				</div>
			</div>
		</div>

		<div class="col-md-4">
			<div class="card shadow-sm border-0 text-white bg-success">
				<div class="card-body">
					<h5 class="card-title">Documentos Criados</h5>
					<p class="card-text fs-3">
						<?= $totalDocs ?>
					</p>
				</div>
			</div>
		</div>

		<div class="col-md-4">
			<div class="card shadow-sm border-0 text-white bg-dark">
				<div class="card-body">
					<h5 class="card-title">Último Documento</h5>
					<p class="card-text fs-6">
						ID:
						<?= $ultimoId ?><br>
						<small>
							<?= $dataUltimo ?>
						</small>
					</p>
				</div>
			</div>
		</div>
	</div>
</div>

<?php include(__DIR__ . '/../includes/footer.php'); ?>