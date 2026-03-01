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
$sucesso = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');

    if ($name === '') {
        $erro = 'O nome da categoria é obrigatório.';
    } else {
        $slug = strtolower(preg_replace('/[^a-z0-9]+/i', '-', $name));

        $stmt = $pdo->prepare("INSERT INTO categories (name, slug) VALUES (:name, :slug)");
        $stmt->execute([
            'name' => $name,
            'slug' => $slug
        ]);

        $sucesso = true;
    }
}
?>

<div class="container-fluid df">
	<h4 class="mb-4">Nova Categoria</h4>

	<?php if ($erro): ?>
	<div class="alert alert-danger">
		<?= $erro ?>
	</div>
	<?php endif; ?>

	<?php if ($sucesso): ?>
	<script>
		Swal.fire({
			icon: 'success',
			title: 'Categoria criada com sucesso!',
			showConfirmButton: false,
			timer: 2000
		}).then(() => {
			window.location.href = 'list.php';
		});
	</script>
	<?php endif; ?>

	<form method="POST" class="col-md-6">
		<div class="mb-3">
			<label for="name" class="form-label">Nome da Categoria</label>
			<input type="text" name="name" id="name" class="form-control" required>
		</div>
		<button type="submit" class="btn btn-success">Salvar Categoria</button>
		<a href="list.php" class="btn btn-secondary">Cancelar</a>
	</form>
</div>

<?php require_once '../../includes/footer.php'; ?>