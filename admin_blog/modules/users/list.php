<?php
session_start();
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['role'] !== 'admin') {
	header('Location: ../../auth/login.php');
	exit;
}

require_once '../../config/config.php';
require_once '../../config/db.php';

$id = $_GET['id'] ?? null;

if (!$id || !is_numeric($id)) {
	header('Location: list.php');
	exit;
}

// Buscar usuário atual
$stmt = $pdo->prepare("SELECT id, name, email, role FROM users WHERE id = :id");
$stmt->execute(['id' => $id]);
$usuario = $stmt->fetch();

if (!$usuario) {
	header('Location: list.php');
	exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$nova_role = $_POST['role'] ?? 'redator';

	if (!in_array($nova_role, ['admin', 'editor', 'redator'])) {
		$nova_role = 'redator';
	}

	$stmt = $pdo->prepare("UPDATE users SET role = :role WHERE id = :id");
	$stmt->execute(['role' => $nova_role, 'id' => $id]);

	header("Location: list.php?sucesso=1");
	exit;
}
?>

<?php require_once '../../includes/header.php'; ?>
<?php require_once '../../includes/sidebar.php'; ?>
<?php require_once '../../includes/topbar.php'; ?>

<div class="container-fluid">
	<h4 class="mb-4">Permissões de Acesso</h4>

	<div class="card col-md-6 p-4">
		<form method="POST">
			<p><strong>Usuário:</strong>
				<?= htmlspecialchars($usuario['name']) ?> (
				<?= $usuario['email'] ?>)
			</p>

			<div class="mb-3">
				<label class="form-label">Tipo de Permissão</label>
				<select name="role" class="form-select" required>
					<option value="admin" <?=$usuario['role']==='admin' ? 'selected' : '' ?>>Administrador</option>
					<option value="editor" <?=$usuario['role']==='editor' ? 'selected' : '' ?>>Editor</option>
					<option value="redator" <?=$usuario['role']==='redator' ? 'selected' : '' ?>>Redator</option>
				</select>
			</div>

			<button type="submit" class="btn btn-primary">Salvar Permissão</button>
			<a href="list.php" class="btn btn-secondary">Cancelar</a>
		</form>
	</div>
</div>

<?php require_once '../../includes/footer.php'; ?>