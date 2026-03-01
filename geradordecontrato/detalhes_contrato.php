<?php
// /geradordecontrato/detalhes_contrato.php
session_start();
include("conexao/key.php");

$contrato = null;
$linkAssinatura = null;

if (isset($_GET['identificador'])) {
  $idc = $conn->real_escape_string($_GET['identificador']);
  $sql = "SELECT * FROM contratos WHERE identificador_contrato = '$idc' LIMIT 1";
  $res = $conn->query($sql);
  if ($res && $res->num_rows === 1) {
    $contrato = $res->fetch_assoc();
  }
}

/**
 * MODO PÚBLICO (sem login):
 * Se veio ?t=TOKEN na URL, valide contra o banco para este contrato.
 * Se for válido e não expirado, monte a URL direta para a página pública de assinatura (upload_foto.php).
 */
if ($contrato && isset($_GET['t'])) {
  $token = $conn->real_escape_string($_GET['t']);
  $rsTok = $conn->query("SELECT assinatura_token, assinatura_expires
                         FROM contratos
                         WHERE id = ".(int)$contrato['id']." LIMIT 1");
  if ($rsTok && $rowTok = $rsTok->fetch_assoc()) {
    $okToken = hash_equals((string)$rowTok['assinatura_token'], (string)$token);
    $naoExpirou = empty($rowTok['assinatura_expires']) || strtotime($rowTok['assinatura_expires']) > time();

    if ($okToken && $naoExpirou) {
      $scheme   = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') ? 'https' : 'http';
      $host     = $_SERVER['HTTP_HOST'] ?? 'localhost';
      $basePath = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');
      $linkAssinatura = $scheme . '://' . $host . $basePath . '/upload_foto.php?token=' . rawurlencode($token) . '&id=' . (int)$contrato['id'];
    }
  }
}

$temAssinatura = !empty($contrato['assinatura_path'] ?? '');
$isAdmin = !empty($_SESSION['user_id'] ?? null);
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Uppertruck | Detalhes do Contrato</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <script src="https://cdn.rawgit.com/davidshimjs/qrcodejs/gh-pages/qrcode.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/contratos.css">
</head>

<body>

    <?php
// ✅ Aqui ele puxa o miolo completo do contrato (incluindo a assinatura no final)
include __DIR__ . '/partials/contrato_view.php';
?>

    <style>
        .pb-5,
        .py-5 {
            padding-bottom: 0 !important;
        }

        @media (max-width:748px) {
            .card-body {
                -ms-flex: 1 1 auto;
                flex: 1 1 auto;
                min-height: 1px;
                padding: 0.25rem;
                font-size: 0.8rem;
                background: #f1f1f1;
            }

            .container,
            .container-fluid,
            .container-lg,
            .container-md,
            .container-sm,
            .container-xl {
                width: 100%;
                padding-right: 8px;
                padding-left: 8px;
                margin-right: auto;
                margin-left: auto;
            }
        }
    </style>
</body>


</html>