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

$erro = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = trim($_POST['name'] ?? '');

    if ($nome === '') {
        $erro = 'O nome da tag é obrigatório.';
    } else {
        $slug = strtolower(preg_replace('/[^a-z0-9]+/i', '-', $nome));

        $stmt = $pdo->prepare("SELECT id FROM tags WHERE slug = :slug");
        $stmt->execute(['slug' => $slug]);

        if ($stmt->fetch()) {
            $erro = 'Essa tag já existe.';
        } else {
            $stmt = $pdo->prepare("INSERT INTO tags (name, slug) VALUES (:name, :slug)");
            $stmt->execute(['name' => $nome, 'slug' => $slug]);

            header('Location: list.php?sucesso=1');
            exit;
        }
    }
}
?>

<div class="container-fluid df">
	<div class="d-flex justify-content-between align-items-center mb-4">
		<h4>Nova Tag</h4>
		<a href="list.php" class="btn btn-outline-secondary">
			<i class="fa fa-arrow-left me-1"></i> Voltar
		</a>
	</div>

	<form method="POST" class="col-md-6">
		<div class="mb-3">
			<label for="name" class="form-label">Nome da Tag</label>
			<input type="text" name="name" id="name" class="form-control" required>
		</div>
		<button type="submit" class="btn btn-primary">Salvar Tag</button>
	</form>

	<?php if ($erro): ?>
	<script>
		Swal.fire({
			icon: 'error',
			title: 'Erro',
			text: <?= json_encode($erro) ?>,
			confirmButtonText: 'Ok'
		});
	</script>
	<?php endif; ?>
</div>

<?php require_once '../../includes/footer.php'; ?>