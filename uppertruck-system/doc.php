<?php
// ===== DEBUG TEMPORÁRIO (remova em produção) =====
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// ===== Conexão direta (use seus dados) =====
$host = "localhost";
$dbname = "uppertru_sistem";
$username = "uppertru_sistem";
$password = "nuppy@2025";

$conn = new mysqli($host, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Erro na conexão: " . $conn->connect_error);
}
$conn->set_charset("utf8mb4");

// ===== Parâmetros =====
$token = $_GET['h'] ?? null;                          // link público com token
$id    = isset($_GET['id']) ? (int)$_GET['id'] : 0;   // link interno por id

// ===== Busca o documento (token tem prioridade) =====
if ($token) {
  $stmt = $conn->prepare("
    SELECT d.*,
           COALESCE(c.nome, d.cliente_nome_manual)         AS cliente_nome,
           COALESCE(c.cnpj, d.cliente_cnpj_manual)         AS cliente_cnpj,
           COALESCE(c.endereco, d.cliente_endereco_manual) AS cliente_endereco
    FROM documentos d
    LEFT JOIN clientes c ON d.cliente_id = c.id
    WHERE d.upload_token = ?
      AND (d.token_expires IS NULL OR d.token_expires >= NOW())
    LIMIT 1
  ");
  $stmt->bind_param("s", $token);
} else {
  if (!$id) {
    die("<h3 style='text-align:center;margin-top:30px;'>ID inválido.</h3>");
  }
  $stmt = $conn->prepare("
    SELECT d.*,
           COALESCE(c.nome, d.cliente_nome_manual)         AS cliente_nome,
           COALESCE(c.cnpj, d.cliente_cnpj_manual)         AS cliente_cnpj,
           COALESCE(c.endereco, d.cliente_endereco_manual) AS cliente_endereco
    FROM documentos d
    LEFT JOIN clientes c ON d.cliente_id = c.id
    WHERE d.id = ?
    LIMIT 1
  ");
  $stmt->bind_param("i", $id);
}
$stmt->execute();
$res = $stmt->get_result();
if ($res->num_rows === 0) {
  die("<h3 style='text-align:center;margin-top:30px;'>Documento não encontrado ou link expirado.</h3>");
}
$doc = $res->fetch_assoc();
$stmt->close();

// ===== Upload da foto (apenas quando acessa com ?h=TOKEN) =====
if ($token && $_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['foto'])) {
  if ($_FILES['foto']['error'] === UPLOAD_ERR_OK) {
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mime  = finfo_file($finfo, $_FILES['foto']['tmp_name']);
    finfo_close($finfo);

    $permitidos = ['image/jpeg'=>'.jpg', 'image/png'=>'.png', 'image/webp'=>'.webp'];
    if (!isset($permitidos[$mime])) {
      $erroUpload = 'Formato inválido. Envie JPG, PNG ou WEBP.';
    } elseif ($_FILES['foto']['size'] > 5 * 1024 * 1024) {
      $erroUpload = 'Arquivo muito grande (máx. 5MB).';
    } else {
      $ext   = $permitidos[$mime];
      $idDoc = (int)$doc['id'];

      $dirFs = rtrim($_SERVER['DOCUMENT_ROOT'], '/') . "/assets/uploads/docs/{$idDoc}/";
      $dirUrl = "/assets/uploads/docs/{$idDoc}/";

      if (!is_dir($dirFs)) { @mkdir($dirFs, 0775, true); }

      $nome = "motorista_" . time() . $ext;
      $destino = $dirFs . $nome;

      if (move_uploaded_file($_FILES['foto']['tmp_name'], $destino)) {
        $fotoPath = $dirUrl . $nome;

        $up = $conn->prepare("UPDATE documentos SET foto_path = ? WHERE id = ?");
        $up->bind_param('si', $fotoPath, $idDoc);
        $up->execute();
        $up->close();

        // Atualiza o array local para renderizar sem novo SELECT
        $doc['foto_path'] = $fotoPath;
        $sucessoUpload = true;
      } else {
        $erroUpload = 'Não foi possível salvar o arquivo.';
      }
    }
  } else {
    $erroUpload = 'Falha no upload.';
  }
}
?>

<!DOCTYPE html>

<html lang="pt-br">



<head>

	<meta charset="UTF-8">

	<title>Documento #

		<?= $id ?> - UpperTruck

	</title>

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

	<style>
		body {

			font-family: Arial, sans-serif;

			background: #e0e1ea;

			padding: 40px;

			font-size: 14px;

		}



		table {

			width: 100%;

			border-collapse: collapse;

			margin-bottom: 20px;

		}



		td,

		th {

			border: 1px solid #000;

			padding: 6px 10px;

			vertical-align: top;

		}



		th {

			background: #ddd;

			text-align: left;

		}



		.section-title {

			background: #ffeb3b;

			font-weight: bold;

			text-align: center;

			padding: 8px;

			border: 1px solid #000;

			margin-top: 20px;

		}



		.container {

			background: white;

			max-width: 800px;

			padding: 3rem;

		}



		@media (min-width: 1400px) {



			.container,

			.container-lg,

			.container-md,

			.container-sm,

			.container-xl,

			.container-xxl {

				max-width: 800px;

			}





		}

		/* ===== Layout do Documento ===== */
		body {
			font-family: "Segoe UI", Arial, sans-serif;
			background-color: #f8f9fa;
			color: #212529;
		}

		/* Card e tabelas */
		.card {
			border-radius: 0.5rem;
			border: 1px solid #e9ecef;
		}

		.table th {
			font-weight: 600;
			color: #495057;
		}

		.table td {
			color: #212529;
		}

		.table thead th {
			background-color: #f1f3f5;
		}

		/* Foto */
		.doc-foto {
			width: 130px;
			height: 130px;
			object-fit: cover;
			border-radius: 10px;
			border: 1px solid #dee2e6;
			background-color: #fff;
		}

		/* Placeholder para quando não houver foto */
		.doc-foto.placeholder {
			background: repeating-linear-gradient(45deg,
					#f8f9fa,
					#f8f9fa 10px,
					#e9ecef 10px,
					#e9ecef 20px);
		}

		/* Botões */
		.btn-primary {
			background-color: #0056b3;
			border-color: #0056b3;
		}

		.btn-primary:hover {
			background-color: #004494;
			border-color: #004494;
		}

		/* Seção do cabeçalho da empresa */
		.empresa-header h3 {
			font-weight: 700;
			font-size: 1.5rem;
		}

		.empresa-header .text-muted {
			font-size: 0.85rem;
			line-height: 1.3;
		}


		body {
			font-family: "Segoe UI", Arial, sans-serif;
			background-color: #494c50;
			color: #212529;
		}

		/* ===== Ajustes de Impressão ===== */
		@media print {
			body {
				background: none;
				-webkit-print-color-adjust: exact;
			}

			.btn,
			.form-control,
			.alert,
			.form-text {
				display: none !important;
			}

			.card {
				border: 1px solid #000 !important;
				box-shadow: none !important;
				margin-bottom: 1rem;
				page-break-inside: avoid;
			}

			.table {
				border: 1px solid #000 !important;
			}

			.table th,
			.table td {
				border: 1px solid #000 !important;
				padding: 4px 6px;
				font-size: 12px;
			}

			img.doc-foto {
				border: 1px solid #000 !important;
			}
		}

		.zoom-link {
			display: inline-block;
			position: relative;
		}

		.zoom-img {
			width: 130px;
			height: 130px;
			object-fit: cover;
			border-radius: 10px;
			display: block;
		}

		.zoom-overlay {
			position: absolute;
			top: 0;
			left: 0;
			width: 100%;
			height: 100%;
			background: rgba(0, 0, 0, 0.4);
			border-radius: 10px;
			display: flex;
			justify-content: center;
			align-items: center;
			opacity: 0;
			transition: opacity 0.25s ease;
		}

		.zoom-overlay i {
			color: #fff;
			font-size: 28px;
		}

		.zoom-link:hover .zoom-overlay {
			opacity: 1;
		}
	</style>



	<section class="py-4">
		<div class="container">

			<!-- Cabeçalho da empresa -->
			<div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-3">
				<div class="d-flex align-items-center gap-3">
					<img src="https://uppertruck.com/uppertruck-system/assets/logo-d.jpg" alt="Uppertruck"
						style="width:72px;height:72px;object-fit:contain;border-radius:12px;border:1px solid #e9ecef;background:#fff;">
					<div>
						<h3 class="mb-1 fw-bold" style="letter-spacing:.5px;">UPPERTRUCK EXPRESS</h3>
						<div class="text-muted small">
							CNPJ: 24.940.831/0001-01 · Av. Paulista, 726 Sl 21 Caixa Postal 387 · SÃO PAULO (SP)<br>
							contratacao@uppertruck.com · www.uppertruck.com
						</div>
					</div>
				</div>
				<div>
					<button onclick="window.print()" class="btn btn-dark btn-sm">🖨️ Imprimir Documento</button>
				</div>
			</div>

			<!-- Solicitante -->
			<div class="card shadow-sm mb-4">
				<div class="card-body">
					<h6 class="fw-bold mb-3">Solicitante</h6>
					<div class="table-responsive">
						<table class="table table-sm table-borderless mb-0">
							<tr>
								<th style="width:180px;">Nome</th>
								<td>
									<?= htmlspecialchars($doc['cliente_nome']) ?>
								</td>
							</tr>
							<tr>
								<th>CNPJ</th>
								<td>
									<?= htmlspecialchars($doc['cliente_cnpj']) ?>
								</td>
							</tr>
							<tr>
								<th>Endereço</th>
								<td>
									<?= htmlspecialchars($doc['cliente_endereco']) ?>
								</td>
							</tr>
						</table>
					</div>
				</div>
			</div>

			<!-- Destinatário -->
			<div class="card shadow-sm mb-4">
				<div class="card-body">
					<h6 class="fw-bold mb-3">Destinatário</h6>
					<div class="table-responsive">
						<table class="table table-sm align-middle">
							<tr>
								<th style="width:25%">DESTINATÁRIO</th>
								<td>
									<?= htmlspecialchars($doc['cliente_nome']) ?>
								</td>
							</tr>
							<tr>
								<th>CNPJ</th>
								<td>
									<?= htmlspecialchars($doc['cliente_cnpj']) ?>
								</td>
							</tr>
							<tr>
								<th>ENDEREÇO</th>
								<td>
									<?= htmlspecialchars($doc['destino']) ?>
								</td>
							</tr>
							<tr>
								<th>CONTATO NO LOCAL</th>
								<td>
									<?= htmlspecialchars($doc['contato_local']) ?>
								</td>
							</tr>
						</table>
					</div>
				</div>
			</div>

			<!-- Motorista com foto -->
			<div class="card shadow-sm mb-4">
				<div class="card-body">
					<h6 class="fw-bold mb-3">Motorista</h6>

					<?php if (!empty($sucessoUpload)): ?>
					<div class="alert alert-success py-2 mb-3">Foto enviada com sucesso!</div>
					<?php elseif (!empty($erroUpload)): ?>
					<div class="alert alert-danger py-2 mb-3">
						<?= htmlspecialchars($erroUpload) ?>
					</div>
					<?php endif; ?>

					<div class="d-flex flex-wrap align-items-start gap-3">
						<!-- Foto -->
						<div class="text-center" style="min-width:140px">
							<div class="rounded-3 border p-1 bg-white d-inline-block">
								<a href="<?= !empty($doc['foto_path']) ? htmlspecialchars($doc['foto_path']) : '/uppertruck-system/assets/img/placeholder-user.png' ?>"
									target="_blank" class="zoom-link">
									<img src="<?= !empty($doc['foto_path']) ? htmlspecialchars($doc['foto_path']) : '/uppertruck-system/assets/img/placeholder-user.png' ?>"
										alt="Foto do motorista" class="zoom-img">
									<div class="zoom-overlay">
										<i class="bi bi-zoom-in"></i>
									</div>
								</a>
							</div>

							<?php if ($token): ?>
							<form method="post" enctype="multipart/form-data" class="mt-2">
								<div class="d-flex gap-2">
									<input type="file" name="foto" class="form-control form-control-sm" accept="image/*"
										required>
									<button type="submit" class="btn btn-primary btn-sm">Enviar</button>
								</div>
								<div class="form-text">JPG/PNG/WEBP até 8MB</div>
							</form>
							<?php endif; ?>
						</div>

						<!-- Dados do Motorista -->
						<div class="flex-grow-1">
							<div class="table-responsive">
								<table class="table table-sm table-borderless mb-0">
									<tr>
										<th style="width:180px;">Motorista</th>
										<td>
											<?= htmlspecialchars($doc['motorista_nome']) ?>
										</td>
									</tr>
									<tr>
										<th>CPF / CNH</th>
										<td>
											<?= htmlspecialchars($doc['motorista_cpf']) ?>
										</td>
									</tr>
									<tr>
										<th>Placa</th>
										<td>
											<?= htmlspecialchars($doc['placa_carreta']) ?>
										</td>
									</tr>
								</table>
							</div>
						</div>
					</div>

					<!-- Assinatura -->
					<?php if (!empty($doc['assinatura_path'])): ?>
					<div class="mt-4">
						<h6 class="fw-semibold mb-2">Assinatura do motorista</h6>
						<div class="p-2 border rounded bg-white d-inline-block" style="width:100%">
							<img src="<?= htmlspecialchars($doc['assinatura_path']) ?>" alt="Assinatura do motorista"
								style="max-width:100%; height:auto; display:block;">
						</div>
						<div class="small text-muted mt-1">
							<?php if (!empty($doc['assinatura_nome'])): ?>
							<strong>Nome:</strong>
							<?= htmlspecialchars($doc['assinatura_nome']) ?> ·
							<?php endif; ?>
							<?php if (!empty($doc['assinatura_at'])): ?>
							<strong>Assinado em:</strong>
							<?= htmlspecialchars($doc['assinatura_at']) ?>
							<?php endif; ?>
						</div>
					</div>
					<?php else: ?>
					<div class="mt-4">
						<h6 class="fw-semibold mb-2">Assinatura do motorista</h6>
						<div class="p-5 border rounded bg-light text-muted" style="max-width:100%;">
							(aguardando assinatura)
						</div>
					</div>
					<?php endif; ?>

				</div>
			</div>

			<!-- Itens -->
			<div class="card shadow-sm mb-4">
				<div class="card-body">
					<h6 class="fw-bold mb-3">Descrição dos Itens para Transporte</h6>
					<div class="table-responsive">
						<table class="table table-sm align-middle">
							<thead class="table-light">
								<tr>
									<th style="width:20%;">DATA</th>
									<th style="width:40%;">PRODUTO</th>
									<th style="width:10%;">QT</th>
									<th style="width:10%;">COR</th>
									<th style="width:20%;">VALOR</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>
										<?= htmlspecialchars($doc['data']) ?>
									</td>
									<td>
										<?= htmlspecialchars($doc['produto']) ?>
									</td>
									<td>
										<?= htmlspecialchars($doc['quantidade']) ?>
									</td>
									<td>
										<?= htmlspecialchars($doc['cor']) ?>
									</td>
									<td>
										<?= htmlspecialchars($doc['valor']) ?>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>

			<!-- Observações -->
			<div class="card shadow-sm">
				<div class="card-body">
					<h6 class="fw-bold mb-3">Observações Adicionais</h6>
					<div class="table-responsive">
						<table class="table table-sm align-middle">
							<thead class="table-light">
								<tr>
									<th style="width:65%;">DESCRIÇÃO DOS SERVIÇOS</th>
									<th style="width:15%;">PESO</th>
									<th style="width:20%;">PEDIDO</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td><strong>Notas Fiscais:</strong>
										<?= nl2br(htmlspecialchars($doc['notas_fiscais'])) ?>
									</td>
									<td>
										<?= htmlspecialchars($doc['peso']) ?>
									</td>
									<td></td>
								</tr>
							</tbody>
						</table>
					</div>

					<p class="text-center text-muted mt-4 mb-0 small">© 2025 UpperTruck. Desenvolvido por sua agência.
					</p>
				</div>
			</div>

		</div>
	</section>



	</body>



</html>