<?php
include('../includes/auth.php');
include('../includes/db.php');
include('../includes/header.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $cnpj = $_POST['cnpj'];
    $endereco = $_POST['endereco'];
    $contato_nome = $_POST['contato_nome'];
    $contato_telefone = $_POST['contato_telefone'];

    $stmt = $conn->prepare("INSERT INTO clientes (nome, cnpj, endereco, contato_nome, contato_telefone) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $nome, $cnpj, $endereco, $contato_nome, $contato_telefone);

    if ($stmt->execute()) {
        echo "<script>
			Swal.fire({
				icon: 'success',
				title: 'Cliente cadastrado com sucesso!',
				showConfirmButton: false,
				timer: 1800
			});
		</script>";
    } else {
        echo "<script>
			Swal.fire({
				icon: 'error',
				title: 'Erro ao salvar',
				text: 'Tente novamente mais tarde.'
			});
		</script>";
    }

    $stmt->close();
}
?>

<div class="container py-5">
	<h2 class="mb-4">Cadastro de Cliente</h2>
	<form method="post" class="needs-validation" novalidate>
		<div class="mb-3">
			<label class="form-label">Nome / Razão Social</label>
			<input type="text" class="form-control" name="nome" required>
			<div class="invalid-feedback">Este campo é obrigatório.</div>
		</div>

		<div class="mb-3">
			<label class="form-label">CNPJ</label>
			<input type="text" class="form-control" name="cnpj">
		</div>

		<div class="mb-3">
			<label class="form-label">Endereço</label>
			<input type="text" class="form-control" name="endereco">
		</div>

		<div class="row">
			<div class="col-md-6 mb-3">
				<label class="form-label">Nome do Contato</label>
				<input type="text" class="form-control" name="contato_nome">
			</div>
			<div class="col-md-6 mb-3">
				<label class="form-label">Telefone do Contato</label>
				<input type="text" class="form-control" name="contato_telefone">
			</div>
		</div>

		<button type="submit" class="btn btn-success">Salvar Cliente</button>
	</form>
</div>

<?php include('../includes/footer.php'); ?>