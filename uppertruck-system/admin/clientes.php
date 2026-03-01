<?php
include('../includes/auth.php');
include('../includes/db.php');
include('../includes/header.php');

// Busca
$filtro = $_GET['busca'] ?? '';
$filtro_sql = $filtro ? "WHERE nome LIKE ?" : "ORDER BY nome";

if ($filtro) {
    $stmt = $conn->prepare("SELECT * FROM clientes WHERE nome LIKE ? ORDER BY nome");
    $busca_param = "%$filtro%";
    $stmt->bind_param("s", $busca_param);
} else {
    $stmt = $conn->prepare("SELECT * FROM clientes ORDER BY nome");
}

$stmt->execute();
$result = $stmt->get_result();
?>

<div class="container py-5">
	<div class="d-flex justify-content-between align-items-center mb-4">
		<h2 class="mb-0">Clientes Cadastrados</h2>
		<form class="d-flex" method="get">
			<input type="text" name="busca" class="form-control me-2" placeholder="Buscar cliente..."
				value="<?= htmlspecialchars($filtro) ?>">
			<button type="submit" class="btn btn-outline-primary">Buscar</button>
		</form>
	</div>

	<div class="table-responsive">
		<table class="table table-bordered table-striped align-middle">
			<thead class="table-dark">
				<tr>
					<th>#</th>
					<th>Nome / Razão Social</th>
					<th>CNPJ</th>
					<th>Endereço</th>
					<th>Contato</th>
					<th>Ações</th>
				</tr>
			</thead>
			<tbody>
				<?php if ($result->num_rows > 0): ?>
				<?php while ($row = $result->fetch_assoc()): ?>
				<tr>
					<td>
						<?= $row['id'] ?>
					</td>
					<td>
						<?= $row['nome'] ?>
					</td>
					<td>
						<?= $row['cnpj'] ?>
					</td>
					<td>
						<?= $row['endereco'] ?>
					</td>
					<td>
						<?= $row['contato_nome'] ?><br>
						<small>
							<?= $row['contato_telefone'] ?>
						</small>
					</td>
					<td>
						<a href="editar_cliente.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-outline-secondary me-2">
							<i class="bi bi-pencil"></i>
						</a>
						<button onclick="confirmarExclusao(<?= $row['id'] ?>)" class="btn btn-sm btn-outline-danger">
							<i class="bi bi-trash"></i>
						</button>
					</td>
				</tr>
				<?php endwhile; ?>
				<?php else: ?>
				<tr>
					<td colspan="6" class="text-center">Nenhum cliente encontrado.</td>
				</tr>
				<?php endif; ?>
			</tbody>
		</table>
	</div>
</div>

<script>
	function confirmarExclusao(id) {
		Swal.fire({
			title: 'Excluir cliente?',
			text: 'Essa ação não pode ser desfeita.',
			icon: 'warning',
			showCancelButton: true,
			confirmButtonText: 'Sim, excluir',
			cancelButtonText: 'Cancelar'
		}).then((result) => {
			if (result.isConfirmed) {
				window.location.href = 'excluir_cliente.php?id=' + id;
			}
		});
	}
</script>

<?php if (isset($_GET['erro']) && $_GET['erro'] === 'vinculado'): ?>
<script>
	Swal.fire({
		icon: 'error',
		title: 'Ação não permitida',
		text: 'Este cliente possui documentos vinculados. Exclua os documentos antes de remover o cliente.',
		confirmButtonText: 'Entendi'
	});
</script>
<?php endif; ?>

<?php include('../includes/footer.php'); ?>