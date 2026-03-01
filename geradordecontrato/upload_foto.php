<?php
// /geradordecontrato/upload_foto.php
declare(strict_types=1);
session_start();

require __DIR__ . '/conexao/key.php'; // $conn (mysqli)

function page(string $title, string $bodyHtml): void {
  echo '<!doctype html><html lang="pt-br"><head><meta charset="utf-8">';
  echo '<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">';
  echo '<title>'.htmlspecialchars($title,ENT_QUOTES,'UTF-8').'</title>';

  // CSS do contrato (o mesmo do detalhes)
  echo '<link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">';
  echo '<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">';
  echo '<link rel="stylesheet" href="css/contratos.css">';

  // Signature pad
  echo '<script src="https://cdn.jsdelivr.net/npm/signature_pad@4.1.7/dist/signature_pad.umd.min.js"></script>';

  // Estilo extra só do canvas
  echo '<style>
    body{background:#f5f6f7}
    #sigCanvas{border:1px dashed #adb5bd;border-radius:10px;background:#fff;height:200px;width:100%}
  </style>';

  echo '</head><body>';
  echo $bodyHtml;
  echo '<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>';
  echo '</body></html>';
  exit;
}

// ===== Caminhos =====
$UPLOAD_DIR_SIGS = __DIR__ . '/uploads/signatures';
$BASE_URL_SIGS   = '/geradordecontrato/uploads/signatures';

// ===== Parâmetros =====
$id    = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$token = isset($_GET['token']) ? trim((string)$_GET['token']) : '';

if ($id <= 0 || $token === '') {
  page('Link inválido','<div class="container py-4"><div class="alert alert-danger">Link inválido.</div></div>');
}

if (!($conn instanceof mysqli) || $conn->connect_errno) {
  page('Erro','<div class="container py-4"><div class="alert alert-danger">Falha na conexão com o banco.</div></div>');
}
$conn->set_charset('utf8mb4');

// Valida token do contrato + pega identificador (pra redirecionar depois) + puxa dados do contrato pra exibir
$st = $conn->prepare("SELECT * FROM contratos WHERE id=? LIMIT 1");
$st->bind_param('i', $id);
$st->execute();
$ct = $st->get_result()->fetch_assoc();
$st->close();

if (!$ct || empty($ct['assinatura_token']) || !hash_equals((string)$ct['assinatura_token'], (string)$token)) {
  page('Token inválido', '<div class="container py-4"><div class="alert alert-danger">Token inválido ou já utilizado.</div></div>');
}
if (!empty($ct['assinatura_expires']) && strtotime((string)$ct['assinatura_expires']) < time()) {
  page('Link expirado', '<div class="container py-4"><div class="alert alert-warning">Este link expirou. Solicite um novo.</div></div>');
}

// Se já assinou, não deixa assinar de novo (opcional, mas recomendado)
if (!empty($ct['assinatura_path'])) {
  $detalhesUrl = "/geradordecontrato/detalhes_contrato.php?identificador=" . urlencode((string)$ct['identificador_contrato']);
  page('Já assinado', '
    <div class="container py-4">
      <div class="alert alert-info text-center">
        <h5 class="mb-2">Este contrato já está assinado.</h5>
        <a class="btn btn-primary btn-sm" href="'.htmlspecialchars($detalhesUrl).'">Ver contrato</a>
      </div>
    </div>
  ');
}

// ========= POST: recebe assinatura =========
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  $assinatura_data = $_POST['assinatura_data'] ?? '';
  $assinatura_nome = trim((string)($_POST['assinatura_nome'] ?? ''));

  $erros = [];

  if ($assinatura_data === '' || strpos($assinatura_data, 'data:image/png;base64,') !== 0) {
    $erros[] = 'Desenhe sua assinatura no quadro.';
  }

  if (!is_dir($UPLOAD_DIR_SIGS)) @mkdir($UPLOAD_DIR_SIGS, 0775, true);
  if (!is_writable($UPLOAD_DIR_SIGS)) {
    $erros[] = 'Pasta de assinaturas sem permissão de escrita.';
  }

  if ($erros) {
    page('Erro', '<div class="container py-4"><div class="alert alert-danger"><ul class="mb-0"><li>'
      . implode('</li><li>', $erros) . '</li></ul></div></div>');
  }

  $bin = base64_decode(substr($assinatura_data, strlen('data:image/png;base64,')));
  if ($bin === false) {
    page('Erro', '<div class="container py-4"><div class="alert alert-danger">Assinatura corrompida.</div></div>');
  }

  $fname = 'sig_'.$id.'_'.date('Ymd_His').'_'.bin2hex(random_bytes(3)).'.png';
  $abs   = $UPLOAD_DIR_SIGS . '/' . $fname;

  if (file_put_contents($abs, $bin) === false) {
    page('Erro', '<div class="container py-4"><div class="alert alert-danger">Falha ao salvar arquivo no servidor.</div></div>');
  }

  $pathRel = $BASE_URL_SIGS . '/' . $fname;
  $agora   = date('Y-m-d H:i:s');

  $sql = "UPDATE contratos
             SET assinatura_path = ?,
                 assinatura_nome = ?,
                 assinatura_at   = ?,
                 assinatura_token = NULL,
                 assinatura_expires = NULL
           WHERE id = ?";
  $st = $conn->prepare($sql);
  $st->bind_param('sssi', $pathRel, $assinatura_nome, $agora, $id);
  $ok = $st->execute();
  $st->close();

  if (!$ok) {
    @unlink($abs);
    page('Erro', '<div class="container py-4"><div class="alert alert-danger">Erro ao registrar no banco.</div></div>');
  }

  // ✅ Sucesso e redirect pro detalhes
  $detalhesUrl = "/geradordecontrato/detalhes_contrato.php?identificador=" . urlencode((string)$ct['identificador_contrato']);
  page('Sucesso', '
    <div class="container py-4">
      <div class="alert alert-success text-center">
        <h4 class="alert-heading">Assinatura recebida!</h4>
        <p class="mb-2">Obrigado. Seus dados foram registrados.</p>
        <p id="contador" class="text-muted">Redirecionando em 3...</p>
      </div>
    </div>
    <script>
      let segundos = 3;
      const contador = document.getElementById("contador");
      const destino = "'.$detalhesUrl.'";
      const timer = setInterval(() => {
        segundos--;
        contador.textContent = "Redirecionando em " + segundos + "...";
        if (segundos <= 0) {
          clearInterval(timer);
          window.location.href = destino;
        }
      }, 1000);
    </script>
  ');
}

// ========= GET: exibe contrato + formulário assinatura =========

// pro include do contrato_view.php
$contrato = $ct;
$linkAssinatura = null; // aqui não usa (já estamos na tela de assinatura)

// Render do “contrato igual”
ob_start();
include __DIR__ . '/partials/contrato_view.php';
$contratoHtml = ob_get_clean();

// bloco assinatura embaixo
$formHtml = '
<div class="container pb-5">
  <div class="card shadow-sm">
    <div class="card-header bg-white"><b>Assinar contrato</b></div>
    <div class="card-body">
      <form method="post">
        <div class="form-group">
          <label>Assinatura (use o dedo/mouse)</label>
          <canvas id="sigCanvas"></canvas>

          <div class="mt-2 d-flex">
            <input type="text" name="assinatura_nome" class="form-control" placeholder="Seu nome legível (opcional)" />
            <button type="button" id="btnClear" class="btn btn-secondary ml-2">Limpar</button>
          </div>

          <input type="hidden" name="assinatura_data" id="assinatura_data">
        </div>

        <button type="submit" class="btn btn-dark">Enviar assinatura</button>
      </form>
    </div>
  </div>
</div>

<style>
  .pb-5, .py-5 {
    padding-bottom: 0rem !important;
}
.form-group {
    margin-bottom: 2rem;
    width: 100%;
    margin-left: 0;
}
@media (max-width:748px){
  .card-body {
    -ms-flex: 1 1 auto;
    flex: 1 1 auto;
    min-height: 1px;
    padding: 0.25rem;
    font-size: 0.8rem;
    background: #f1f1f1;
}
.container, .container-fluid, .container-lg, .container-md, .container-sm, .container-xl {
    width: 100%;
    padding-right: 8px;
    padding-left: 8px;
    margin-right: auto;
    margin-left: auto;
}
}
</style>

<script>
  (function () {
    const canvas = document.getElementById("sigCanvas");
    const hidden = document.getElementById("assinatura_data");

    function resizeCanvas() {
      const ratio = Math.max(window.devicePixelRatio || 1, 1);
      const rect = canvas.getBoundingClientRect();
      canvas.width = rect.width * ratio;
      canvas.height = 200 * ratio;
      const ctx = canvas.getContext("2d");
      ctx.setTransform(ratio, 0, 0, ratio, 0, 0);
      ctx.fillStyle = "#fff";
      ctx.fillRect(0, 0, rect.width, 200);
    }
    window.addEventListener("resize", resizeCanvas);
    resizeCanvas();

    const pad = new SignaturePad(canvas, { backgroundColor: "#fff", penColor: "#0f4c81" });

    document.getElementById("btnClear").addEventListener("click", () => pad.clear());

    document.querySelector("form").addEventListener("submit", (e) => {
      if (pad.isEmpty()) {
        e.preventDefault();
        alert("Assine no quadro antes de enviar.");
        return false;
      }
      hidden.value = pad.toDataURL("image/png");
    });
  })();
</script>
';

page('Assinar contrato', $contratoHtml . $formHtml);