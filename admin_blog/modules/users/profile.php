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

$usuario_id = $_SESSION['usuario']['id'];
$erro = '';
$sucesso = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $senha = $_POST['password'] ?? '';

    if ($nome === '' || $email === '') {
        $erro = 'Preencha os campos obrigatórios.';
    } else {
        // Atualiza dados
        $dados = [
            'name'  => $nome,
            'email' => $email,
            'id'    => $usuario_id
        ];

        $sql = "UPDATE users SET name = :name, email = :email";

        // Se senha for preenchida, atualiza também
        if (!empty($senha)) {
            $sql .= ", password = :password";
            $dados['password'] = password_hash($senha, PASSWORD_DEFAULT);
        }

        $sql .= " WHERE id = :id";

        $stmt = $pdo->prepare($sql);
        $stmt->execute($dados);

        // Atualiza sessão
        $_SESSION['usuario']['nome'] = $nome;
        $_SESSION['usuario']['email'] = $email;

        $sucesso = true;
    }
}

// Carregar dados atuais
$stmt = $pdo->prepare("SELECT name, email FROM users WHERE id = :id LIMIT 1");
$stmt->execute(['id' => $usuario_id]);
$usuario = $stmt->fetch();
?>

<div class="container-fluid">
	<h4 class="mb-4">Meu Perfil</h4>

	<form method="POST" class="col-md-6">
		<div class="mb-3">
			<label for="name" class="form-label">Nome</label>
			<input type="text" name="name" id="name" class="form-control"
				value="<?= htmlspecialchars($usuario['name']) ?>" required>
		</div>

		<div class="mb-3">
			<label for="email" class="form-label">E-mail</label>
			<input type="email" name="email" id="email" class="form-control"
				value="<?= htmlspecialchars($usuario['email']) ?>" required>
		</div>

		<div class="mb-3">
			<label for="password" class="form-label">Nova Senha (opcional)</label>
			<input type="password" name="password" id="password" class="form-control"
				placeholder="Deixe em branco para manter a atual">
		</div>

		<button type="submit" class="btn btn-primary">Salvar Alterações</button>
	</form>
</div>

<?php if ($erro): ?>
<script>
	Swal.fire({
		icon: 'error',
		title: 'Erro',
		text: <?= json_encode($erro) ?>,
		confirmButtonText: 'Ok'
	});
</script>
<?php elseif ($sucesso): ?>
<script>
	Swal.fire({
		icon: 'success',
		title: 'Perfil atualizado com sucesso!',
		showConfirmButton: false,
		timer: 2000
	});
</script>
<?php endif; ?>

<?php require_once '../../includes/footer.php'; ?>