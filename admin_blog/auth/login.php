<?php
require_once '../config/config.php';
require_once '../config/db.php';
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login |
		<?= $site_name ?>
	</title>

	<!-- Bootstrap 5 -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

	<!-- SweetAlert2 -->
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

	<style>
		body {
			background: #f7f9fc;
			display: flex;
			align-items: center;
			justify-content: center;
			height: 100vh;
		}

		.login-box {
			width: 100%;
			max-width: 400px;
			background: #fff;
			padding: 30px;
			border-radius: 12px;
			box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
		}
	</style>
</head>

<body>

	<div class="login-box">
		<h4 class="mb-4 text-center">Acesso ao Painel</h4>
		<form action="validate.php" method="POST">
			<div class="mb-3">
				<label for="email" class="form-label">E-mail</label>
				<input type="email" name="email" id="email" class="form-control" required autocomplete="email">
			</div>
			<div class="mb-3">
				<label for="senha" class="form-label">Senha</label>
				<input type="password" name="senha" id="senha" class="form-control" required
					autocomplete="current-password">
			</div>
			<div class="d-grid">
				<button type="submit" class="btn btn-primary">Entrar</button>
			</div>
		</form>
	</div>

	<?php if (isset($_GET['erro']) && $_GET['erro'] == 1): ?>
	<script>
		Swal.fire({
			icon: 'error',
			title: 'Erro ao fazer login',
			text: 'E-mail ou senha incorretos.',
			confirmButtonText: 'OK'
		});
	</script>
	<?php endif; ?>

</body>

</html>