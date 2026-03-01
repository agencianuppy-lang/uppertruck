<?php
include('../includes/auth.php');
include('../includes/db.php');
include('../includes/header.php');

// Verifica ID
$id = $_GET['id'] ?? 0;
if (!$id || !is_numeric($id)) {
    echo "<script>
      Swal.fire({ icon: 'error', title: 'ID inválido!' }).then(() => {
        window.location.href = 'clientes.php';
      });
    </script>";
    exit;
}

// Busca cliente
$stmt = $conn->prepare("SELECT * FROM clientes WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows === 0) {
    echo "<script>
		Swal.fire({ icon: 'error', title: 'Cliente não encontrado!' }).then(() => {
			window.location.href = 'clientes.php';
		});
	</script>";
    exit;
}
$cliente = $result->fetch_assoc();

// Atualização
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $cnpj = $_POST['cnpj'];
    $endereco = $_POST['endereco'];
    $contato_nome = $_POST['contato_nome'];
    $contato_telefone = $_POST['contato_telefone'];

    $stmt = $conn->prepare("UPDATE clientes SET nome=?, cnpj=?, endereco=?, contato_nome=?, contato_telefone=? WHERE id=?");
    $stmt->bind_param("sssssi", $nome, $cnpj, $endereco, $contato_nome, $contato_telefone, $id);

    if ($stmt->execute()) {
        echo "<script>
			Swal.fire({
				icon: 'success',
				title: 'Cliente atualizado com sucesso!',
				showConfirmButton: false,
				timer: 1600
			}).then(() => {
				window.location.href = 'clientes.php';
			});
		</script>";
    } else {
        echo "<script>
			Swal.fire({
				icon: 'error',
				title: 'Erro ao atualizar cliente.',
				confirmButtonText: 'OK'
			});
		</script>";
    }
}
?>

<div class="container py-5">
	<h2 class="mb-4">Editar Cliente</h2>
	<form method="post" class="needs-validation" novalidate>
		<div class="mb-3">
			<label class="form-label">Nome / Razão Social</label>
			<input type="text" class="form-control" name="nome" required
				value="<?= htmlspecialchars($cliente['nome']) ?>">
		</div>
		<div class="mb-3">
			<label class="form-label">CNPJ</label>
			<input type="text" class="form-control" name="cnpj" value="<?= htmlspecialchars($cliente['cnpj']) ?>">
		</div>
		<div class="mb-3">
			<label class="form-label">Endereço</label>
			<input type="text" class="form-control" name="endereco"
				value="<?= htmlspecialchars($cliente['endereco']) ?>">
		</div>
		<div class="row">
			<div class="col-md-6 mb-3">
				<label class="form-label">Nome do Contato</label>
				<input type="text" class="form-control" name="contato_nome"
					value="<?= htmlspecialchars($cliente['contato_nome']) ?>">
			</div>
			<div class="col-md-6 mb-3">
				<label class="form-label">Telefone do Contato</label>
				<input type="text" class="form-control" name="contato_telefone"
					value="<?= htmlspecialchars($cliente['contato_telefone']) ?>">
			</div>
		</div>
		<button type="submit" class="btn btn-primary">Salvar Alterações</button>
		<a href="clientes.php" class="btn btn-outline-secondary">Cancelar</a>
	</form>
</div>

<?php include('../includes/footer.php'); ?>