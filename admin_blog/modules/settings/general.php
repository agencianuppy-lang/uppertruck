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
        'site_name'       => $_POST['site_name'] ?? '',
        'site_description'=> $_POST['site_description'] ?? '',
        'site_logo'       => $_POST['site_logo'] ?? '',
        'site_favicon'    => $_POST['site_favicon'] ?? '',
        'facebook_url'    => $_POST['facebook_url'] ?? '',
        'instagram_url'   => $_POST['instagram_url'] ?? '',
        'linkedin_url'    => $_POST['linkedin_url'] ?? ''
    ];

    foreach ($campos as $chave => $valor) {
        $stmt = $pdo->prepare("INSERT INTO settings (config_key, config_value)
            VALUES (:key, :val)
            ON DUPLICATE KEY UPDATE config_value = :val");
        $stmt->execute(['key' => $chave, 'val' => $valor]);
    }

    $sucesso = true;
}

// Carregar valores atuais
$config = [
    'site_name'        => getSetting('site_name', $pdo),
    'site_description' => getSetting('site_description', $pdo),
    'site_logo'        => getSetting('site_logo', $pdo),
    'site_favicon'     => getSetting('site_favicon', $pdo),
    'facebook_url'     => getSetting('facebook_url', $pdo),
    'instagram_url'    => getSetting('instagram_url', $pdo),
    'linkedin_url'     => getSetting('linkedin_url', $pdo)
];
?>

<div class="container-fluid">
	<h4 class="mb-4">Configurações Gerais</h4>

	<form method="POST" class="col-md-8">
		<div class="mb-3">
			<label class="form-label">Nome do Site</label>
			<input type="text" name="site_name" class="form-control"
				value="<?= htmlspecialchars($config['site_name']) ?>">
		</div>

		<div class="mb-3">
			<label class="form-label">Descrição do Site</label>
			<textarea name="site_description"
				class="form-control"><?= htmlspecialchars($config['site_description']) ?></textarea>
		</div>

		<div class="mb-3">
			<label class="form-label">URL do Logo</label>
			<input type="text" name="site_logo" class="form-control"
				value="<?= htmlspecialchars($config['site_logo']) ?>">
		</div>

		<div class="mb-3">
			<label class="form-label">URL do Favicon</label>
			<input type="text" name="site_favicon" class="form-control"
				value="<?= htmlspecialchars($config['site_favicon']) ?>">
		</div>

		<div class="mb-3">
			<label class="form-label">Facebook</label>
			<input type="url" name="facebook_url" class="form-control"
				value="<?= htmlspecialchars($config['facebook_url']) ?>">
		</div>

		<div class="mb-3">
			<label class="form-label">Instagram</label>
			<input type="url" name="instagram_url" class="form-control"
				value="<?= htmlspecialchars($config['instagram_url']) ?>">
		</div>

		<div class="mb-3">
			<label class="form-label">LinkedIn</label>
			<input type="url" name="linkedin_url" class="form-control"
				value="<?= htmlspecialchars($config['linkedin_url']) ?>">
		</div>

		<button type="submit" class="btn btn-success">Salvar Configurações</button>
	</form>
</div>

<?php if ($sucesso): ?>
<script>
	Swal.fire({
		icon: 'success',
		title: 'Configurações salvas com sucesso!',
		showConfirmButton: false,
		timer: 2000
	});
</script>
<?php endif; ?>

<?php require_once '../../includes/footer.php'; ?>