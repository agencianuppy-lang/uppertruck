<?php
ob_start(); // Protege contra envios prematuros de headers
session_start();
?>
<?php
require_once '../../config/config.php';
require_once '../../config/db.php';
require_once '../../includes/header.php';
require_once '../../includes/sidebar.php';
require_once '../../includes/topbar.php';

$stmt = $pdo->query("SELECT config_key, config_value FROM settings");
$settings = [];
foreach ($stmt as $row) {
    $settings[$row['config_key']] = $row['config_value'];
}
?>

<div class="container py-5">
  <h2 class="mb-4">Configurações do Sistema</h2>

  <form action="save.php" method="POST">
    <ul class="nav nav-tabs mb-3" id="settingsTabs">
      <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab" href="#geral">Geral</a></li>
      <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#seo">SEO</a></li>
      <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#smtp">SMTP</a></li>
    </ul>

    <div class="tab-content border border-top-0 p-4 bg-white shadow-sm rounded">
      <!-- ABA GERAL -->
      <div class="tab-pane fade show active" id="geral">
        <div class="mb-3">
          <label>Nome do Blog</label>
          <input type="text" name="site_name" class="form-control"
            value="<?= htmlspecialchars($settings['site_name'] ?? '') ?>">
        </div>
        <div class="mb-3">
          <label>Logo (URL)</label>
          <input type="text" name="site_logo" class="form-control"
            value="<?= htmlspecialchars($settings['site_logo'] ?? '') ?>">
        </div>
        <div class="mb-3">
          <label>Favicon (URL)</label>
          <input type="text" name="site_favicon" class="form-control"
            value="<?= htmlspecialchars($settings['site_favicon'] ?? '') ?>">
        </div>
        <div class="mb-3">
          <label>Cor Principal (hex)</label>
          <input type="text" name="primary_color" class="form-control"
            value="<?= htmlspecialchars($settings['primary_color'] ?? '#000000') ?>">
        </div>
      </div>

      <!-- ABA SEO -->
      <div class="tab-pane fade" id="seo">
        <div class="mb-3">
          <label>Meta Description padrão</label>
          <textarea name="meta_description"
            class="form-control"><?= htmlspecialchars($settings['meta_description'] ?? '') ?></textarea>
        </div>
        <div class="mb-3">
          <label>Facebook URL</label>
          <input type="text" name="facebook_url" class="form-control"
            value="<?= htmlspecialchars($settings['facebook_url'] ?? '') ?>">
        </div>
        <div class="mb-3">
          <label>Instagram URL</label>
          <input type="text" name="instagram_url" class="form-control"
            value="<?= htmlspecialchars($settings['instagram_url'] ?? '') ?>">
        </div>
        <div class="mb-3">
          <label>Twitter URL</label>
          <input type="text" name="twitter_url" class="form-control"
            value="<?= htmlspecialchars($settings['twitter_url'] ?? '') ?>">
        </div>
        <div class="mb-3">
          <label>LinkedIn URL</label>
          <input type="text" name="linkedin_url" class="form-control"
            value="<?= htmlspecialchars($settings['linkedin_url'] ?? '') ?>">
        </div>
      </div>

      <!-- ABA SMTP -->
      <div class="tab-pane fade" id="smtp">
        <div class="mb-3">
          <label>SMTP Host</label>
          <input type="text" name="smtp_host" class="form-control"
            value="<?= htmlspecialchars($settings['smtp_host'] ?? '') ?>">
        </div>
        <div class="mb-3">
          <label>SMTP Porta</label>
          <input type="text" name="smtp_port" class="form-control"
            value="<?= htmlspecialchars($settings['smtp_port'] ?? '') ?>">
        </div>
        <div class="mb-3">
          <label>Usuário SMTP</label>
          <input type="text" name="smtp_user" class="form-control"
            value="<?= htmlspecialchars($settings['smtp_user'] ?? '') ?>">
        </div>
        <div class="mb-3">
          <label>Senha SMTP</label>
          <input type="password" name="smtp_pass" class="form-control"
            value="<?= htmlspecialchars($settings['smtp_pass'] ?? '') ?>">
        </div>
        <div class="mb-3">
          <label>Remetente (De)</label>
          <input type="text" name="smtp_from" class="form-control"
            value="<?= htmlspecialchars($settings['smtp_from'] ?? '') ?>">
        </div>
        <div class="mb-3">
          <label>Nome do Remetente</label>
          <input type="text" name="smtp_fromname" class="form-control"
            value="<?= htmlspecialchars($settings['smtp_fromname'] ?? '') ?>">
        </div>
        <div class="mb-3">
          <label>E-mail do Administrador</label>
          <input type="email" name="email_admin" class="form-control"
            value="<?= htmlspecialchars($settings['email_admin'] ?? '') ?>">
        </div>
        <div class="mb-3">
          <label>E-mail do Cliente</label>
          <input type="email" name="email_cliente" class="form-control"
            value="<?= htmlspecialchars($settings['email_cliente'] ?? '') ?>">
        </div>
      </div>
    </div>

    <button type="submit" class="btn btn-success mt-4">Salvar Configurações</button>
  </form>
</div>

<?php require_once '../../includes/footer.php'; ?>

<?php if (isset($_GET['salvo'])): ?>
<script>
  Swal.fire("Configurações salvas!", "Tudo certo por aqui 😎", "success");
</script>
<?php endif; ?>