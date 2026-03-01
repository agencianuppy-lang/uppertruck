<?php
session_start();
session_destroy();
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
	<meta charset="UTF-8">
	<title>Logout</title>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
	<script>
		Swal.fire({
			icon: 'info',
			title: 'Sessão encerrada!',
			text: 'Você foi desconectado com sucesso.',
			showConfirmButton: false,
			timer: 1800
		}).then(() => {
			window.location.href = 'login.php';
		});
	</script>
</body>

</html>