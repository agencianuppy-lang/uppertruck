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
        'meta_title_default'       => $_POST['meta_title_default'] ?? '',
        'meta_description_default' => $_POST['meta_description_default'] ?? '',
        'meta_image_default'       => $_POST['meta_image_default'] ?? ''
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
    'meta_title_default'       => getSetting('meta_title_default', $pdo),
    'meta_description_default' => getSetting('meta_description_default', $pdo),
    'meta_image_default'       => getSetting('meta_image_default', $pdo)
];
?>

<div class="container-fluid">
	<h4 class="mb-4">Configurações de SEO</h4>

	<form method="POST" class="col-md-8">
		<div class="mb-3">
			<label class="form-label">Meta Title padrão</label>
			<input type="text" name="meta_title_default" class="form-control"
				value="<?= htmlspecialchars($config['meta_title_default']) ?>">
		</div>

		<div class="mb-3">
			<label class="form-label">Meta Description padrão</label>
			<textarea name="meta_description_default"
				class="form-control"><?= htmlspecialchars($config['meta_description_default']) ?></textarea>
		</div>

		<div class="mb-3">
			<label class="form-label">Imagem de Compartilhamento (URL)</label>
			<input type="text" name="meta_image_default" class="form-control"
				value="<?= htmlspecialchars($config['meta_image_default']) ?>">
		</div>

		<button type="submit" class="btn btn-success">Salvar SEO</button>
	</form>
</div>

<?php if ($sucesso): ?>
<script>
	Swal.fire({
		icon: 'success',
		title: 'SEO salvo com sucesso!',
		showConfirmButton: false,
		timer: 2000
	});
</script>
<?php endif; ?>

<?php require_once '../../includes/footer.php'; ?>