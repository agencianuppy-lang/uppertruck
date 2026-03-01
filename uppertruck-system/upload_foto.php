<?php
// /uppertruck-system/upload_foto.php
declare(strict_types=1);
session_start();

/* ========= CONFIG ========= */
$UPLOAD_DIR_PHOTOS = __DIR__ . '/assets/uploads';
$UPLOAD_DIR_SIGS   = __DIR__ . '/assets/signatures';
$BASE_URL_PHOTOS   = '/uppertruck-system/assets/uploads';
$BASE_URL_SIGS     = '/uppertruck-system/assets/signatures';
$MAX_SIZE          = 8 * 1024 * 1024; // 8MB
$ALLOWED_MIME      = ['image/jpeg'=>'jpg','image/png'=>'png','image/webp'=>'webp'];
/* ========================= */

require __DIR__ . '/includes/db.php';

function render($title, $bodyHtml) {
  echo '<!doctype html><html lang="pt-br"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">';
  echo '<title>'.htmlspecialchars($title,ENT_QUOTES,'UTF-8').'</title>';
  echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>';
  echo '<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">';
  echo '<style>
    body{background:#f5f6f7;font-family:system-ui,-apple-system,Segoe UI,Roboto,Helvetica,Arial,sans-serif}
    .card-elev{max-width:720px;margin:40px auto;background:#fff;border:1px solid #e9ecef;border-radius:16px;box-shadow:0 10px 30px rgba(0,0,0,.06)}
    .card-elev .card-header{background:#fff;border-bottom:1px solid #f1f3f5;border-top-left-radius:16px;border-top-right-radius:16px}
    #sigCanvas{background:#fff;border:1px dashed #adb5bd;border-radius:10px;width:100%;height:180px;display:block}
    .hint{color:#6c757d;font-size:13px}
    @media print{.btn,.form-text,.hint,.card-header{display:none!important} .card-elev{box-shadow:none!important;border:1px solid #000} }
  </style>';
echo '</head><body>';
// carrega a lib ANTES do $bodyHtml
echo '<script src="https://cdn.jsdelivr.net/npm/signature_pad@4.1.7/dist/signature_pad.umd.min.js"></script>';
echo $bodyHtml; // aqui vem seu <script> que chama new SignaturePad(...)
echo '<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>';
echo '</body></html>'; exit;

}

/* ===== Parâmetros ===== */
$token = isset($_GET['token']) ? trim($_GET['token']) : '';
$id    = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($id<=0 || $token==='') {
  render('Link inválido','<div class="card-elev card"><div class="card-body">Link inválido.</div></div>');
}

/* ===== Valida token ===== */
$stmt = $conn->prepare("SELECT id, upload_token, token_expires, foto_path, assinatura_path, assinatura_nome, assinatura_at FROM documentos WHERE id=?");
$stmt->bind_param('i', $id);
$stmt->execute();
$doc = $stmt->get_result()->fetch_assoc();
$stmt->close();

if (!$doc || !$doc['upload_token'] || !hash_equals($doc['upload_token'], $token)) {
  render('Token inválido','<div class="card-elev card"><div class="card-body text-danger">Token inválido ou já utilizado.</div></div>');
}
if (!empty($doc['token_expires']) && strtotime($doc['token_expires']) < time()) {
  render('Link expirado','<div class="card-elev card"><div class="card-body text-danger">Este link expirou. Solicite um novo.</div></div>');
}

/* ===== POST: processa upload + assinatura ===== */
if ($_SERVER['REQUEST_METHOD']==='POST') {
  $erros = [];
  $fotoPath = $doc['foto_path'] ?? null;
  $sigPath  = $doc['assinatura_path'] ?? null;

  // 1) Foto (opcional, mas recomendada)
  if (isset($_FILES['foto']) && $_FILES['foto']['error'] !== UPLOAD_ERR_NO_FILE) {
    $f = $_FILES['foto'];
    if ($f['error'] !== UPLOAD_ERR_OK) $erros[] = 'Falha ao receber o arquivo.';
    if ($f['size'] > $MAX_SIZE)       $erros[] = 'Arquivo maior que 8MB.';

    if (empty($erros)) {
      $finfo = new finfo(FILEINFO_MIME_TYPE);
      $mime  = $finfo->file($f['tmp_name']) ?: 'application/octet-stream';
      if (!isset($ALLOWED_MIME[$mime])) $erros[] = 'Formato não suportado (envie JPG, PNG ou WEBP).';
      if (empty($erros)) {
        if (!is_dir($UPLOAD_DIR_PHOTOS)) @mkdir($UPLOAD_DIR_PHOTOS, 0775, true);
        if (!is_writable($UPLOAD_DIR_PHOTOS)) $erros[] = 'Pasta de upload sem permissão.';
      }
      if (empty($erros)) {
        $ext   = $ALLOWED_MIME[$mime];
        $nome  = 'doc_'.$id.'_'.date('Ymd_His').'_'.bin2hex(random_bytes(4)).'.'.$ext;
        $dest  = $UPLOAD_DIR_PHOTOS.'/'.$nome;
        if (!move_uploaded_file($f['tmp_name'], $dest)) $erros[] = 'Não foi possível salvar a foto.';
        else $fotoPath = $BASE_URL_PHOTOS.'/'.$nome;
      }
    }
  }

  // 2) Assinatura (base64 enviada no hidden "assinatura_data", opcional)
  $assinatura_data = isset($_POST['assinatura_data']) ? (string)$_POST['assinatura_data'] : '';
  $assinatura_nome = isset($_POST['assinatura_nome']) ? trim((string)$_POST['assinatura_nome']) : '';
  $assinatura_at   = null;

  if ($assinatura_data !== '') {
    if (strpos($assinatura_data, 'data:image/png;base64,') !== 0) {
      $erros[] = 'Assinatura em formato inválido.';
    } else {
      if (!is_dir($UPLOAD_DIR_SIGS)) @mkdir($UPLOAD_DIR_SIGS, 0775, true);
      if (!is_writable($UPLOAD_DIR_SIGS)) $erros[] = 'Pasta de assinaturas sem permissão.';
      if (empty($erros)) {
        $bin = base64_decode(substr($assinatura_data, strlen('data:image/png;base64,')));
        if ($bin === false) $erros[] = 'Assinatura corrompida.';
        else {
          $fname = 'sig_'.$id.'_'.date('Ymd_His').'_'.bin2hex(random_bytes(3)).'.png';
          $abs   = $UPLOAD_DIR_SIGS.'/'.$fname;
          if (file_put_contents($abs, $bin) === false) $erros[] = 'Falha ao salvar assinatura.';
          else {
            $sigPath = $BASE_URL_SIGS.'/'.$fname;
            $assinatura_at = date('Y-m-d H:i:s');
          }
        }
      }
    }
  }

  if (!empty($erros)) {
    $html = '<div class="card-elev card"><div class="card-header h5 mb-0">Enviar Foto</div><div class="card-body">';
    $html .= '<div class="alert alert-danger"><ul class="mb-0"><li>'.implode('</li><li>', array_map('htmlspecialchars',$erros)).'</li></ul></div>';
    $html .= '<a class="btn btn-secondary" href="'.htmlspecialchars($_SERVER['REQUEST_URI']).'">Voltar</a></div></div>';
    render('Erros no envio',$html);
  }

  // Atualiza BD e invalida token após esta submissão
  $sql = "UPDATE documentos 
             SET foto_path = COALESCE(?, foto_path),
                 assinatura_path = COALESCE(?, assinatura_path),
                 assinatura_at = COALESCE(?, assinatura_at),
                 assinatura_nome = COALESCE(?, assinatura_nome),
                 upload_token = NULL,
                 token_expires = NULL
           WHERE id = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param('ssssi', $fotoPath, $sigPath, $assinatura_at, $assinatura_nome, $id);
  $ok = $stmt->execute();
  $stmt->close();

  if (!$ok) {
    // rollback simples: não apagamos arquivos, mas avisamos
    $html = '<div class="card-elev card"><div class="card-body text-danger">Erro ao registrar no banco.</div></div>';
    render('Erro',$html);
  }

  // Sucesso
  $html = '<div class="card-elev card">
    <div class="card-body">
      <h5 class="mb-2">Envio concluído!</h5>
      <p class="mb-2">Obrigado. Suas informações foram registradas.</p>';
  if ($fotoPath) $html .= '<div class="mb-2"><span class="badge text-bg-success">Foto salva</span></div>';
  if ($sigPath)  $html .= '<div class="mb-2"><span class="badge text-bg-success">Assinatura salva</span></div>';
  $html .= '<a class="btn btn-dark mt-2" href="/uppertruck-system/doc.php?id='.$id.'" target="_self">Ver documento</a>
    </div></div>';
  render('Sucesso', $html);
}

/* ===== GET: formulário com upload + assinatura ===== */
$body = '<div class="card-elev card">
  <div class="card-header h5 mb-0">Enviar Foto</div>
  <div class="card-body">
    <form method="post" enctype="multipart/form-data" id="envioForm">
      <div class="mb-3">
        <label class="form-label">Envie uma <b>foto nítida</b> do documento/entrega.</label>
        <input type="file" name="foto" class="form-control" accept="image/*">
        <div class="hint mt-1">Formatos aceitos: JPG, PNG, WEBP. Tamanho máximo: 8MB.</div>
      </div>

      <div class="mb-2">
        <label class="form-label mb-1">Assinatura do motorista</label>
        <canvas id="sigCanvas"></canvas>
        <div class="d-flex gap-2 mt-2">
          <input type="text" name="assinatura_nome" id="assinatura_nome" class="form-control form-control-sm" placeholder="Nome legível do motorista (opcional)">
          <button type="button" class="btn btn-secondary btn-sm" id="btnSigClear">Limpar</button>
        </div>
        <div class="hint mt-1">Assine com o dedo (no celular) ou mouse.</div>
        <input type="hidden" name="assinatura_data" id="assinatura_data">
      </div>

      <button type="submit" class="btn btn-dark">Enviar foto e assinatura</button>
    </form>
  </div>
</div>

<script>
(function(){
  const canvas = document.getElementById("sigCanvas");
  const hidden = document.getElementById("assinatura_data");
  if (!canvas) return;

  function resizeCanvas(){
    const ratio = Math.max(window.devicePixelRatio || 1, 1);
    const rect  = canvas.getBoundingClientRect();
    canvas.width  = rect.width * ratio;
    canvas.height = 180 * ratio;
    const ctx = canvas.getContext("2d");
    ctx.scale(ratio, ratio);
    ctx.fillStyle = "#fff";
    ctx.fillRect(0,0,canvas.width,canvas.height);
  }
  window.addEventListener("resize", resizeCanvas);
  resizeCanvas();

  const pad = new SignaturePad(canvas, { backgroundColor:"#fff", penColor:"#0f4c81" });

  document.getElementById("btnSigClear").addEventListener("click", ()=>pad.clear());

  document.getElementById("envioForm").addEventListener("submit", (e)=>{
    // Se desenhou algo, envia como base64
    if (!pad.isEmpty()) {
      hidden.value = pad.toDataURL("image/png");
    } else {
      hidden.value = ""; // assinatura opcional
    }
  });
})();
</script>';

render('Enviar Foto e Assinatura', $body);
