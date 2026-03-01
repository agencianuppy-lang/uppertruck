<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: ../../auth/login.php');
    exit;
}

require_once '../../includes/header.php';
require_once '../../includes/sidebar.php';
require_once '../../includes/topbar.php';

function lerLog($arquivo, $limite = 100) {
    if (!file_exists($arquivo)) return [];

    $linhas = array_reverse(file($arquivo, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES));
    return array_slice($linhas, 0, $limite);
}

$cron_log = lerLog('../../logs/cron.log');
$email_log = lerLog('../../logs/email_error.log');
?>

<div class="container-fluid df">
  <h4 class="mb-4">📊 Relatórios e Logs</h4>

  <div class="row">
    <div class="col-md-6">
      <div class="card border-success mb-4">
        <div class="card-header bg-success text-white">📅 Publicações Automáticas (cron.log)</div>
        <div class="card-body">
          <pre style="white-space: pre-wrap;"><?php foreach ($cron_log as $linha) {
                        echo htmlspecialchars($linha) . "\n";
                    } ?></pre>
        </div>
      </div>
    </div>

    <div class="col-md-6">
      <div class="card border-info mb-4">
        <div class="card-header bg-info text-white">✉️ Envio de E-mails (email_error.log)</div>
        <div class="card-body">
          <pre style="white-space: pre-wrap;"><?php foreach ($email_log as $linha) {
                        echo htmlspecialchars($linha) . "\n";
                    } ?></pre>
        </div>
      </div>
    </div>
  </div>
</div>

<?php require_once '../../includes/footer.php'; ?>