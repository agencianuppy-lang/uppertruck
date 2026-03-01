<?php
// /upper-sign/index.php
require_once __DIR__ . '/config/config.php';
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Upper Sign - Upload de PDF</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/style.css">
</head>

<body class="bg-light">
  <div class="container py-5">
    <div class="text-center mb-5">
      <img src="assets/img/logo.svg" alt="Logo" height="60" class="mb-3">
      <h1 class="fw-bold text-dark">Painel de Upload de PDF</h1>
      <p class="text-muted">Envie um PDF e gere o link público para assinatura digital</p>
    </div>

    <div class="card shadow-sm">
      <div class="card-body">
        <form id="uploadForm" action="upload.php" method="POST" enctype="multipart/form-data">
          <div class="row g-3">
            <div class="col-md-6">
              <label class="form-label">Arquivo PDF</label>
              <input type="file" name="pdf" class="form-control" accept="application/pdf" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Descrição interna</label>
              <input type="text" name="description" class="form-control"
                placeholder="Ex: Contrato de prestação de serviço" required>
            </div>
          </div>

          <div class="mt-4 text-end">
            <button type="submit" class="btn btn-primary px-4">Enviar PDF</button>
          </div>
        </form>

        <div id="uploadResult" class="alert mt-4 d-none"></div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    const form = document.getElementById('uploadForm');
    const resultDiv = document.getElementById('uploadResult');

    form.addEventListener('submit', async (e) => {
      e.preventDefault();
      resultDiv.className = 'alert mt-4 d-none';
      resultDiv.textContent = '';

      try {
        const formData = new FormData(form);
        const res = await fetch('upload.php', { method: 'POST', body: formData });

        const raw = await res.text(); // pega qualquer coisa que vier
        let data = null;
        try { data = JSON.parse(raw); } catch (_) { }

        if (!res.ok) {
          resultDiv.className = 'alert mt-4 alert-danger';
          resultDiv.innerHTML = `<b>Erro HTTP ${res.status}</b><br><pre style="white-space:pre-wrap">${raw}</pre>`;
          resultDiv.classList.remove('d-none');
          return;
        }

        if (data && data.success) {
          resultDiv.className = 'alert mt-4 alert-success';
          resultDiv.innerHTML = `
        <b>PDF enviado com sucesso!</b><br>
        <small>Link público de assinatura:</small><br>
        <input type="text" class="form-control my-2" value="${data.sign_url}" readonly onclick="this.select()">
      `;
        } else {
          resultDiv.className = 'alert mt-4 alert-danger';
          resultDiv.innerHTML = data && data.message
            ? `<b>Erro:</b> ${data.message}`
            : `<b>Erro inesperado:</b><br><pre style="white-space:pre-wrap">${raw}</pre>`;
        }
        resultDiv.classList.remove('d-none');

      } catch (err) {
        resultDiv.className = 'alert mt-4 alert-danger';
        resultDiv.textContent = 'Falha de rede ou CORS: ' + (err?.message || err);
        resultDiv.classList.remove('d-none');
      }
    });
  </script>

</body>

</html>