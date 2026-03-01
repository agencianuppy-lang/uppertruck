<?php
// /upper-sign/sign.php
require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/config/database.php';

$token = trim($_GET['t'] ?? '');
if ($token === '') {
  http_response_code(400);
  die('<div style="padding:20px;color:red">Token ausente.</div>');
}

// Busca token + doc
$stmt = $pdo->prepare("
  SELECT st.id AS token_id, st.document_id, st.expires_at, st.used_at,
         d.id, d.original_filename, d.stored_path, d.status,
         d.default_page, d.default_offset_x_px, d.default_offset_y_px, d.default_scale_pct
  FROM sign_tokens st
  JOIN documents d ON d.id = st.document_id
  WHERE st.token = ?
  LIMIT 1
");
$stmt->execute([$token]);
$tk = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$tk) { http_response_code(404); die('<div style="padding:20px;color:red">Link inválido.</div>'); }
$now = new DateTimeImmutable('now');
$exp = new DateTimeImmutable($tk['expires_at']);
if ($now > $exp) { http_response_code(410); die('<div style="padding:20px;color:red">Este link expirou.</div>'); }
if (!empty($tk['used_at']) || $tk['status'] === 'SIGNED') {
  http_response_code(409); die('<div style="padding:20px;color:red">Documento já assinado ou link já utilizado.</div>');
}

$pdfUrl = BASE_URL . '/' . ltrim($tk['stored_path'], '/');
$defPage  = (int)($tk['default_page'] ?: 1);
$defX     = (int)($tk['default_offset_x_px'] ?? -50);
$defY     = (int)($tk['default_offset_y_px'] ?? 140);
$defScale = (int)($tk['default_scale_pct'] ?? 50);

// Audit VIEW
try {
  $stmt = $pdo->prepare("
    INSERT INTO audit_logs (document_id, action, ip, user_agent, payload, created_at)
    VALUES (?, 'VIEW', ?, ?, JSON_OBJECT('token', ?), NOW())
  ");
  $stmt->execute([$tk['document_id'], client_ip(), user_agent(), $token]);
} catch(Throwable $e){}
?>
<!doctype html>
<html lang="pt-BR">

<head>
  <meta charset="utf-8">
  <title>Assinar Documento</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: #f6f7fb
    }

    .wrap {
      max-width: 1200px;
      margin: 24px auto
    }

    .viewer {
      position: relative;
      background: #fff;
      border: 1px solid #e8e8e8;
      border-radius: 12px;
      overflow: hidden
    }

    #pdfCanvas {
      display: block;
      width: 100%;
      height: auto;
      background: #fff
    }

    #overlayCanvas {
      position: absolute;
      left: 0;
      top: 0;
      pointer-events: none
    }

    .card {
      border-radius: 12px
    }

    #signPad {
      border: 2px dashed #ced4da;
      border-radius: 12px;
      background: #fff;
      width: 100%;
      height: 180px;
      cursor: crosshair;
      touch-action: none;
      /* essencial no celular */
    }

    .hint {
      font-size: .9rem;
      color: #6c757d
    }
  </style>
</head>

<body>
  <div class="wrap container">
    <div class="row g-4">
      <div class="col-lg-7">
        <div class="viewer" id="viewerBox">
          <canvas id="pdfCanvas"></canvas>
          <canvas id="overlayCanvas"></canvas>
        </div>
        <div class="mt-2 d-flex align-items-center gap-2">
          <button id="btnPrev" class="btn btn-outline-secondary btn-sm">◀ Página anterior</button>
          <button id="btnNext" class="btn btn-outline-secondary btn-sm">Próxima página ▶</button>
          <div class="ms-auto text-muted small">
            Arquivo: <strong>
              <?= htmlspecialchars($tk['original_filename']) ?>
            </strong>
          </div>
        </div>
      </div>

      <div class="col-lg-5">
        <div class="card shadow-sm">
          <div class="card-body">
            <h5 class="fw-bold mb-3">Desenhe sua assinatura</h5>

            <canvas id="signPad"></canvas>
            <div class="d-flex gap-2 mt-2">
              <button id="btnUndo" class="btn btn-outline-secondary btn-sm">Desfazer traço</button>
              <button id="btnClear" class="btn btn-outline-danger btn-sm">Limpar</button>
            </div>
            <div class="hint mt-2">Use o dedo (celular) ou o mouse (desktop). O fundo é transparente.</div>

            <hr>

            <h6 styleclass="fw-bold" style="display: none;">Posicionamento</h6>
            <div class="row g-2" style="display: none;">
              <div class="col-3">
                <label class="form-label mb-1">Páginaa</label>
                <input type="number" id="inpPage" class="form-control form-control-sm" value="1" min="1">
              </div>
              <div class="col-3">
                <label class="form-label mb-1">Offset X (px)</label>
                <input type="number" id="inpX" class="form-control form-control-sm" value="-70">
              </div>
              <div class="col-3">
                <label class="form-label mb-1">Offset Y (px)</label>
                <input type="number" id="inpY" class="form-control form-control-sm" value="140">
              </div>
              <div class="col-3">
                <label class="form-label mb-1">Escala (%)</label>
                <input type="number" id="inpScale" class="form-control form-control-sm" value="50" min="10" max="300">
              </div>
            </div>
            <div class="mt-2" style="display: none;">
              <button id="btnTest" class="btn btn-primary btn-sm">Testar posição</button>
            </div>

            <div class="hint mt-2">
              <strong>Canto inferior direito</strong> é a base. Valores positivos movem para direita (X) e para cima
              (Y).
            </div>

            <hr>
            <button id="btnSign" class="btn btn-success w-100">Assinar e Confirmar</button>
            <div id="msg" class="alert mt-3 d-none"></div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- pdf.js -->
  <script src="https://cdn.jsdelivr.net/npm/pdfjs-dist@3.11.174/build/pdf.min.js"></script>
  <script>
    (() => {
      const PDF_URL = <?= json_encode($pdfUrl) ?>;
      const TOKEN = <?= json_encode($token) ?>;

      pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdn.jsdelivr.net/npm/pdfjs-dist@3.11.174/build/pdf.worker.min.js';

      const pdfCanvas = document.getElementById('pdfCanvas');
      const overlay = document.getElementById('overlayCanvas');
      const viewerBox = document.getElementById('viewerBox');
      const ctxPDF = pdfCanvas.getContext('2d');
      const ctxOverlay = overlay.getContext('2d');

      const btnPrev = document.getElementById('btnPrev');
      const btnNext = document.getElementById('btnNext');
      const inpPage = document.getElementById('inpPage');
      const inpX = document.getElementById('inpX');
      const inpY = document.getElementById('inpY');
      const inpScale = document.getElementById('inpScale');
      const btnTest = document.getElementById('btnTest');
      const btnSign = document.getElementById('btnSign');
      const msgBox = document.getElementById('msg');

      let pdfDoc = null;
      let currentPage = Math.max(parseInt(inpPage.value || '1', 10), 1);
      let pageViewport = null;
      let signaturePNG = null;

      function showMsg(html, type = 'info') {
        msgBox.className = 'alert mt-3 alert-' + type;
        msgBox.innerHTML = html;
        msgBox.classList.remove('d-none');
      }

      // ===== PDF render =====
      async function loadPDF() {
        try {
          const doc = await pdfjsLib.getDocument(PDF_URL).promise;
          pdfDoc = doc;
          if (currentPage > pdfDoc.numPages) currentPage = pdfDoc.numPages;
          await renderPage(currentPage);
        } catch (e) {
          console.error(e);
          showMsg('Erro ao carregar o PDF no navegador.', 'danger');
        }
      }

      async function renderPage(num) {
        const page = await pdfDoc.getPage(num);
        const boxW = viewerBox.clientWidth || 700;
        const vp = page.getViewport({ scale: 1 });
        const scale = boxW / vp.width;
        const viewport = page.getViewport({ scale });

        pdfCanvas.width = Math.floor(viewport.width);
        pdfCanvas.height = Math.floor(viewport.height);
        overlay.width = pdfCanvas.width;
        overlay.height = pdfCanvas.height;

        pageViewport = viewport;

        await page.render({ canvasContext: ctxPDF, viewport }).promise;
        ctxOverlay.clearRect(0, 0, overlay.width, overlay.height);
        if (signaturePNG) drawOverlay();
        updateNav();
      }

      function updateNav() {
        btnPrev.disabled = (currentPage <= 1);
        btnNext.disabled = (pdfDoc && currentPage >= pdfDoc.numPages);
      }

      btnPrev.onclick = async () => {
        if (currentPage > 1) { currentPage--; inpPage.value = currentPage; await renderPage(currentPage); }
      };
      btnNext.onclick = async () => {
        if (pdfDoc && currentPage < pdfDoc.numPages) { currentPage++; inpPage.value = currentPage; await renderPage(currentPage); }
      };
      inpPage.onchange = async () => {
        let p = parseInt(inpPage.value || '1', 10);
        if (!pdfDoc) return;
        p = Math.min(Math.max(1, p), pdfDoc.numPages);
        currentPage = p;
        await renderPage(currentPage);
      };

      // ===== Signature Pad (pointer events + DPR) =====
      const signPad = document.getElementById('signPad');
      const sctx = signPad.getContext('2d', { willReadFrequently: true });
      let drawing = false, paths = [];

      function setupSignPad() {
        const dpr = window.devicePixelRatio || 1;
        const rect = signPad.getBoundingClientRect();
        const w = Math.max(300, Math.floor(rect.width));
        const h = 180;
        signPad.width = Math.floor(w * dpr);
        signPad.height = Math.floor(h * dpr);
        signPad.style.width = w + 'px';
        signPad.style.height = h + 'px';
        sctx.setTransform(1, 0, 0, 1, 0, 0);
        sctx.scale(dpr, dpr);
        sctx.lineWidth = 2;
        sctx.lineCap = 'round';
        sctx.strokeStyle = '#000';
        redrawAll();
      }
      function getPos(e) {
        const r = signPad.getBoundingClientRect();
        const x = (e.clientX ?? (e.touches?.[0]?.clientX || 0)) - r.left;
        const y = (e.clientY ?? (e.touches?.[0]?.clientY || 0)) - r.top;
        return { x: Math.max(0, Math.min(r.width, x)), y: Math.max(0, Math.min(r.height, y)) };
      }
      function redrawAll() {
        const r = signPad.getBoundingClientRect();
        sctx.clearRect(0, 0, r.width, r.height);
        sctx.beginPath();
        for (const path of paths) {
          for (let i = 1; i < path.length; i++) {
            sctx.moveTo(path[i - 1].x, path[i - 1].y);
            sctx.lineTo(path[i].x, path[i].y);
          }
        }
        sctx.stroke();
      }

      signPad.addEventListener('pointerdown', e => {
        signPad.setPointerCapture(e.pointerId);
        const p = getPos(e);
        drawing = true;
        paths.push([p]);
      });
      signPad.addEventListener('pointermove', e => {
        if (!drawing) return;
        const p = getPos(e);
        const path = paths[paths.length - 1];
        const last = path[path.length - 1];
        sctx.beginPath();
        sctx.moveTo(last.x, last.y);
        sctx.lineTo(p.x, p.y);
        sctx.stroke();
        path.push(p);
      });
      ['pointerup', 'pointercancel', 'pointerleave'].forEach(ev => signPad.addEventListener(ev, () => { drawing = false; }));
      window.addEventListener('resize', setupSignPad);

      document.getElementById('btnClear').onclick = () => {
        paths = []; const r = signPad.getBoundingClientRect();
        sctx.clearRect(0, 0, r.width, r.height);
        ctxOverlay.clearRect(0, 0, overlay.width, overlay.height);
      };
      document.getElementById('btnUndo').onclick = () => {
        if (!paths.length) return; paths.pop(); redrawAll();
      };

      function exportSignaturePNG() {
        const r = signPad.getBoundingClientRect();
        const data = sctx.getImageData(0, 0, r.width, r.height).data;
        let hasInk = false; for (let i = 3; i < data.length; i += 4) { if (data[i] !== 0) { hasInk = true; break; } }
        return hasInk ? signPad.toDataURL('image/png') : null;
      }

      // ===== Overlay da assinatura no preview =====
      function drawOverlay() {
        if (!signaturePNG || !pageViewport) return;
        const img = new Image();
        img.onload = () => {
          ctxOverlay.clearRect(0, 0, overlay.width, overlay.height);
          const scalePct = Math.max(10, Math.min(300, parseInt(inpScale.value || '100', 10)));
          const factor = scalePct / 100;
          const imgW = img.width * factor * (pageViewport.width / pageViewport.viewBox[2]);
          const imgH = img.height * factor * (pageViewport.height / pageViewport.viewBox[3]);
          const offX = parseFloat(inpX.value || 0);
          const offY = parseFloat(inpY.value || 0);
          const x = pageViewport.width - imgW + offX;
          const y = pageViewport.height - imgH - offY;
          ctxOverlay.drawImage(img, x, y, imgW, imgH);
        };
        img.src = signaturePNG;
      }

      btnTest.onclick = () => {
        signaturePNG = exportSignaturePNG();
        if (!signaturePNG) { showMsg('Desenhe a assinatura antes de testar.', 'warning'); return; }
        drawOverlay();
      };

      // ===== Assinar =====
      btnSign.onclick = async () => {
        try {
          signaturePNG = exportSignaturePNG();
          if (!signaturePNG) { showMsg('Assinatura vazia. Desenhe sua assinatura.', 'danger'); return; }

          const payload = {
            token: TOKEN,
            page: Math.max(1, parseInt(inpPage.value || '1', 10)),
            offset_x_px: parseInt(inpX.value || '0', 10),
            offset_y_px: parseInt(inpY.value || '0', 10),
            scale_pct: Math.max(10, Math.min(300, parseInt(inpScale.value || '100', 10))),
            signature_png_base64: signaturePNG
          };

          const res = await fetch('apply_signature.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(payload)
          });

          const raw = await res.text();
          let data = null; try { data = JSON.parse(raw); } catch (e) { }

          if (!res.ok) {
            console.error('HTTP', res.status, raw);
            showMsg(`<b>HTTP ${res.status}</b><br><pre style="white-space:pre-wrap">${raw}</pre>`, 'danger');
            return;
          }
          if (!data || !data.success) {
            console.error('APP', raw);
            showMsg(data?.message ? data.message : `<b>Erro inesperado</b><br><pre style="white-space:pre-wrap">${raw}</pre>`, 'danger');
            return;
          }

          showMsg('Assinatura aplicada com sucesso! Abrindo documento...', 'success');
          setTimeout(() => { window.location.href = data.view_url; }, 800);

        } catch (err) {
          console.error(err);
          showMsg('Falha de rede/JS: ' + (err?.message || err), 'danger');
        }
      };

      // start
      setupSignPad();
      loadPDF();
    })();
  </script>
</body>

</html>