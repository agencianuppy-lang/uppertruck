<?php
session_start();
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['role'] !== 'admin') {
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
    $email = trim($_POST['email'] ?? '');
    $senha = $_POST['password'] ?? '';
    $role = $_POST['role'] ?? 'redator';

    if ($nome === '' || $email === '' || $senha === '') {
        $erro = 'Preencha todos os campos obrigatórios.';
    } else {
        // Verifica se o e-mail já existe
        $stmt = $pdo->prepare("SELECT id FROM users WHERE email = :email");
        $stmt->execute(['email' => $email]);

        if ($stmt->fetch()) {
            $erro = 'E-mail já cadastrado.';
        } else {
            $hash = password_hash($senha, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare("INSERT INTO users (name, email, password, role) VALUES (:name, :email, :password, :role)");
            $stmt->execute([
                'name'     => $nome,
                'email'    => $email,
                'password' => $hash,
                'role'     => $role
            ]);

            header('Location: list.php?sucesso=1');
            exit;
        }
    }
}
?>

<div class="container-fluid">
	<div class="d-flex justify-content-between align-items-center mb-4">
		<h4>Novo Usuário</h4>
		<a href="list.php" class="btn btn-outline-secondary">
			<i class="fa fa-arrow-left me-1"></i> Voltar
		</a>
	</div>

	<form method="POST" class="col-md-6">
		<div class="mb-3">
			<label for="name" class="form-label">Nome</label>
			<input type="text" name="name" id="name" class="form-control" required>
		</div>
		<div class="mb-3">
			<label for="email" class="form-label">E-mail</label>
			<input type="email" name="email" id="email" class="form-control" required>
		</div>
		<div class="mb-3">
			<label for="password" class="form-label">Senha</label>
			<input type="password" name="password" id="password" class="form-control" required>
		</div>
		<div class="mb-3">
			<label for="role" class="form-label">Perfil</label>
			<select name="role" id="role" class="form-select">
				<option value="redator">Redator</option>
				<option value="editor">Editor</option>
				<option value="admin">Administrador</option>
			</select>
		</div>
		<button type="submit" class="btn btn-primary">Salvar Usuário</button>
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