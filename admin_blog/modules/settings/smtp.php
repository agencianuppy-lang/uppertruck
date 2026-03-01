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

// Função auxiliar
function getSetting($key, $pdo) {
    $stmt = $pdo->prepare("SELECT config_value FROM settings WHERE config_key = :key LIMIT 1");
    $stmt->execute(['key' => $key]);
    return $stmt->fetchColumn();
}

$sucesso = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $campos = [
        'smtp_host'     => $_POST['smtp_host'] ?? '',
        'smtp_port'     => $_POST['smtp_port'] ?? '',
        'smtp_user'     => $_POST['smtp_user'] ?? '',
        'smtp_pass'     => $_POST['smtp_pass'] ?? '',
        'smtp_from'     => $_POST['smtp_from'] ?? '',
        'smtp_fromname' => $_POST['smtp_fromname'] ?? ''
    ];

    foreach ($campos as $chave => $valor) {
        $stmt = $pdo->prepare("INSERT INTO settings (config_key, config_value) VALUES (:chave, :valor)
            ON DUPLICATE KEY UPDATE config_value = VALUES(config_value)");
        $stmt->bindParam(':chave', $chave);
        $stmt->bindParam(':valor', $valor);
        $stmt->execute();
    }

    $sucesso = true;
}

$config = [
    'smtp_host'     => getSetting('smtp_host', $pdo),
    'smtp_port'     => getSetting('smtp_port', $pdo),
    'smtp_user'     => getSetting('smtp_user', $pdo),
    'smtp_pass'     => getSetting('smtp_pass', $pdo),
    'smtp_from'     => getSetting('smtp_from', $pdo),
    'smtp_fromname' => getSetting('smtp_fromname', $pdo)
];
?>

<div class="container-fluid df">
	<h4 class="mb-4">Configurações de SMTP</h4>

	<form method="POST" class="col-md-8">
		<div class="mb-3">
			<label class="form-label">Servidor SMTP (Host)</label>
			<input type="text" name="smtp_host" class="form-control"
				value="<?= htmlspecialchars($config['smtp_host']) ?>">
		</div>

		<div class="mb-3">
			<label class="form-label">Porta</label>
			<input type="text" name="smtp_port" class="form-control"
				value="<?= htmlspecialchars($config['smtp_port']) ?>">
		</div>

		<div class="mb-3">
			<label class="form-label">Usuário</label>
			<input type="text" name="smtp_user" class="form-control"
				value="<?= htmlspecialchars($config['smtp_user']) ?>">
		</div>

		<div class="mb-3">
			<label class="form-label">Senha</label>
			<input type="password" name="smtp_pass" class="form-control"
				value="<?= htmlspecialchars($config['smtp_pass']) ?>">
		</div>

		<div class="mb-3">
			<label class="form-label">E-mail de envio (From)</label>
			<input type="email" name="smtp_from" class="form-control"
				value="<?= htmlspecialchars($config['smtp_from']) ?>">
		</div>

		<div class="mb-3">
			<label class="form-label">Nome remetente (From Name)</label>
			<input type="text" name="smtp_fromname" class="form-control"
				value="<?= htmlspecialchars($config['smtp_fromname']) ?>">
		</div>

		<button type="submit" class="btn btn-success">Salvar SMTP</button>
	</form>
</div>

<?php if ($sucesso): ?>
<script>
	Swal.fire({
		icon: 'success',
		title: 'Configurações de e-mail salvas com sucesso!',
		showConfirmButton: false,
		timer: 2000
	});
</script>
<?php endif; ?>

<?php require_once '../../includes/footer.php'; ?>