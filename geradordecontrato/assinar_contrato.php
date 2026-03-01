<?php
// assinar_contrato.php
declare(strict_types=1);
session_start();

require __DIR__ . '/conexao/key.php'; // $conn (mysqli)
if (!isset($conn) || !($conn instanceof mysqli)) {
  die('Falha de conexão.');
}
$conn->set_charset('utf8mb4');

$id    = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$token = isset($_GET['token']) ? trim((string)$_GET['token']) : '';

if ($id <= 0 || $token === '') {
  http_response_code(400);
  echo 'Link inválido';
  exit;
}

// busca e valida token/expiração
$stmt = $conn->prepare("SELECT id, assinatura_token, assinatura_expira_em, tomador_nome, identificador_contrato
                          FROM contratos WHERE id = ? LIMIT 1");
$stmt->bind_param('i', $id);
$stmt->execute();
$c = $stmt->get_result()->fetch_assoc();
$stmt->close();

if (!$c || empty($c['assinatura_token']) || !hash_equals($c['assinatura_token'], $token)) {
  http_response_code(401);
  echo 'Token inválido ou já utilizado.';
  exit;
}
if (!empty($c['assinatura_expira_em']) && strtotime($c['assinatura_expira_em']) < time()) {
  http_response_code(401);
  echo 'Este link expirou. Solicite um novo.';
  exit;
}

// URL de POST
$action = 'salvar_assinatura.php';
?>
<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <title>Assinar contrato</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/signature_pad@4.1.7/dist/signature_pad.umd.min.js"></script>
    <style>
        body {
            background: #0f2241;
        }

        .card-elev {
            max-width: 860px;
            margin: 40px auto;
            background: #fff;
            border: 1px solid #e9ecef;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, .10)
        }

        .card-elev .card-header {
            background: #0f2241;
            color: #fff;
            border-top-left-radius: 16px;
            border-top-right-radius: 16px
        }

        #sigCanvas {
            background: #fff;
            border: 2px dashed #b6c2d1;
            border-radius: 10px;
            width: 100%;
            height: 220px;
            display: block
        }

        .hint {
            color: #6c757d;
            font-size: 13px
        }
    </style>
</head>

<body>
    <div class="card-elev card">
        <div class="card-header">
            <h5 class="mb-0">Assinar contrato —
                <?= htmlspecialchars($c['tomador_nome'] ?? 'Cliente') ?>
            </h5>
        </div>
        <div class="card-body">
            <p class="text-muted mb-3">Assine abaixo com o dedo (no celular) ou com o mouse, e informe seu nome legível.
            </p>

            <form method="post" action="<?= htmlspecialchars($action) ?>" id="sigForm">
                <input type="hidden" name="id" value="<?= (int)$c['id'] ?>">
                <input type="hidden" name="token" value="<?= htmlspecialchars($token) ?>">
                <input type="hidden" name="assinatura_data" id="assinatura_data">

                <div class="mb-3">
                    <canvas id="sigCanvas"></canvas>
                    <div class="d-flex gap-2 mt-2">
                        <input type="text" name="assinatura_nome" id="assinatura_nome" class="form-control" required
                            placeholder="Digite seu nome completo (legível)">
                        <button type="button" class="btn btn-outline-secondary" id="btnLimpar">Limpar</button>
                    </div>
                    <div class="hint mt-1">Ao enviar, você declara que leu e concorda com os termos do contrato.</div>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-success px-4">Enviar assinatura</button>
                    <a class="btn btn-outline-dark"
                        href="detalhes_contrato.php?identificador=<?= urlencode($c['identificador_contrato']) ?>"
                        target="_blank">Ver contrato</a>
                </div>
            </form>
        </div>
    </div>

    <script>
        (function () {
            const canvas = document.getElementById("sigCanvas");
            const hidden = document.getElementById("assinatura_data");
            const nome = document.getElementById("assinatura_nome");
            const limpar = document.getElementById("btnLimpar");
            const form = document.getElementById("sigForm");

            function resizeCanvas() {
                const ratio = Math.max(window.devicePixelRatio || 1, 1);
                const rect = canvas.getBoundingClientRect();
                canvas.width = rect.width * ratio;
                canvas.height = 220 * ratio;
                const ctx = canvas.getContext("2d");
                ctx.scale(ratio, ratio);
                ctx.fillStyle = "#ffffff";
                ctx.fillRect(0, 0, canvas.width, canvas.height);
            }
            window.addEventListener("resize", resizeCanvas);
            resizeCanvas();

            const pad = new SignaturePad(canvas, { backgroundColor: "#ffffff", penColor: "#0f6efd", minWidth: 0.7, maxWidth: 2.5 });

            limpar.addEventListener("click", () => pad.clear());

            form.addEventListener("submit", (e) => {
                if (pad.isEmpty()) {
                    e.preventDefault();
                    alert("Por favor, desenhe sua assinatura no quadro.");
                    return false;
                }
                if (!nome.value.trim()) {
                    e.preventDefault();
                    alert("Informe seu nome completo.");
                    return false;
                }
                hidden.value = pad.toDataURL("image/png");
            });
        })();
    </script>
</body>

</html>