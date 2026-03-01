<?php

// header.php - Cabeçalho com menu lateral

?>

<!DOCTYPE html>

<html lang="pt-BR">



<head>

	<meta charset="UTF-8">

	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title>UpperTruck System</title>



	<!-- Bootstrap -->

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">



	<!-- Bootstrap Icons -->

	<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">



	<!-- Google Fonts -->

	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">



	<!-- SweetAlert2 -->

	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>



	<!-- AOS -->

	<link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">

	<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>



	<!-- Animate.css -->

	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/animate.css@4.1.1/animate.min.css" />



	<!-- Custom CSS -->

	<link rel="stylesheet" href="/assets/css/style.css">

	<link rel="icon" href="/assets/images/favicon.png" type="image/png">



	<style>
		body {

			font-family: 'Inter', sans-serif;

			margin: 0;

		}



		.sidebar {

			width: 240px;

			height: 100vh;

			position: fixed;

			top: 0;

			left: 0;

			background-color: #212529;

			padding-top: 60px;

		}



		.sidebar a {

			color: #dee2e6;

			padding: 15px 20px;

			display: block;

			text-decoration: none;

			transition: background 0.2s;

		}



		.sidebar a:hover,

		.sidebar .active {

			background-color: #343a40;

			color: #fff;

		}



		.sidebar i {

			margin-right: 8px;

		}



		.content {

			margin-left: 240px;

			padding: 30px;

			background-color: #f8f9fa;

			min-height: 100vh;

		}



		.sidebar-header {

			position: fixed;

			top: 0;

			width: 240px;

			background-color: #343a40;

			color: white;

			padding: 15px;

			text-align: center;

			font-weight: bold;

		}



		.logout {

			position: absolute;

			bottom: 30px;

			width: 100%;

		}
	</style>

</head>



<body>



	<div class="sidebar">

		<div class="sidebar-header">
			UpperTruck
		</div>

		<a href="dashboard.php" class="<?= basename($_SERVER['PHP_SELF']) === 'dashboard.php' ? 'active' : '' ?>">
			<i class="bi bi-speedometer2"></i> Dashboard
		</a>

		<a href="cadastro_cliente.php"
			class="<?= basename($_SERVER['PHP_SELF']) === 'cadastro_cliente.php' ? 'active' : '' ?>">
			<i class="bi bi-person-plus"></i> Cadastrar Cliente
		</a>

		<a href="clientes.php" class="<?= basename($_SERVER['PHP_SELF']) === 'clientes.php' ? 'active' : '' ?>">
			<i class="bi bi-people"></i> Clientes
		</a>

		<a href="novo_documento.php"
			class="<?= basename($_SERVER['PHP_SELF']) === 'novo_documento.php' ? 'active' : '' ?>">
			<i class="bi bi-file-earmark-plus"></i> Novo Documento
		</a>

		<a href="documentos.php" class="<?= basename($_SERVER['PHP_SELF']) === 'documentos.php' ? 'active' : '' ?>">
			<i class="bi bi-files"></i> Documentos
		</a>

		<hr class="text-white">

		<a href="https://uppertruck.com/geradordecontrato/index.php" target="_blank">
			<i class="bi bi-file-text"></i> Cadastrar Contrato
		</a>

		<div class="logout text-center mt-4">
			<a href="logout.php" class="btn btn-outline-light btn-sm">
				<i class="bi bi-box-arrow-right"></i> Sair
			</a>
		</div>

	</div>



	<div class="content">