<?php
include('../includes/auth.php');
include('../includes/db.php');
include('../includes/header.php');

// Busca clientes cadastrados para dropdown
$clientes = [];
$result = $conn->query("SELECT id, nome FROM clientes ORDER BY nome");
while ($row = $result->fetch_assoc()) {
    $clientes[] = $row;
}
?>

<style>
	.h5,
	h5 {
		font-size: 1.75rem;
		font-weight: 700;
		border-bottom: 1px solid #bebebe;
		padding-bottom: 12px;
	}

	.content {
		margin-left: 240px;
		padding: 30px;
		background-color: #307dca;
		min-height: 100vh;
	}
</style>

<div class="container py-5">
	<h2 class="mb-4" style="color:white">Novo Documento de Transporte</h2>
	<form method="post" action="salvar_documento.php">

		<!-- CLIENTE -->
		<div class="card border-0 shadow-sm bg-body-secondary mb-4">
			<div class="card-body">
				<h5 class="mb-3">Dados do Cliente</h5>

				<!-- Campos manuais por padrão -->
				<div id="camposClienteManuais">
					<div class="row">
						<div class="col-md-6 mb-2">
							<input type="text" class="form-control" name="cliente_nome_manual"
								placeholder="Nome do Cliente">
						</div>
						<div class="col-md-3 mb-2">
							<input type="text" class="form-control" name="cliente_cnpj_manual" placeholder="CNPJ">
						</div>
						<div class="col-md-3 mb-2">
							<input type="text" class="form-control" name="cliente_endereco_manual"
								placeholder="Endereço">
						</div>
					</div>
				</div>

				<!-- Select escondido inicialmente -->
				<div id="selectClienteExistente" style="display: none;">
					<select name="cliente_id" class="form-select mb-2">
						<option value="">Selecione um cliente cadastrado</option>
						<?php foreach ($clientes as $cliente): ?>
						<option value="<?= $cliente['id'] ?>">
							<?= $cliente['nome'] ?>
						</option>
						<?php endforeach; ?>
					</select>
				</div>

				<!-- Botão para trocar -->
				<button type="button" class="btn btn-sm btn-outline-secondary" onclick="alternarCliente()">
					<i class="bi bi-arrow-repeat"></i> Escolher Cliente Cadastrado
				</button>
			</div>
		</div>

		<!-- LOCALIDADES -->
		<div class="card border-0 shadow-sm bg-body-secondary mb-4">
			<div class="card-body">
				<h5 class="mb-3">Origem e Destino</h5>
				<div class="row">
					<div class="col-md-6 mb-3">
						<label class="form-label">Origem</label>
						<input type="text" class="form-control" name="origem" required>
					</div>
					<div class="col-md-6 mb-3">
						<label class="form-label">Destino</label>
						<input type="text" class="form-control" name="destino" required>
					</div>
				</div>

				<div class="mb-3">
					<label class="form-label">Contato no Local</label>
					<input type="text" class="form-control" name="contato_local">
				</div>
			</div>
		</div>

		<!-- MOTORISTA -->
		<div class="card border-0 shadow-sm bg-body-secondary mb-4">
			<div class="card-body">
				<h5 class="mb-3">Dados do Motorista</h5>
				<div class="row">
					<div class="col-md-6 mb-3">
						<label class="form-label">Nome</label>
						<input type="text" class="form-control" name="motorista_nome">
					</div>
					<div class="col-md-6 mb-3">
						<label class="form-label">CPF / CNH</label>
						<input type="text" class="form-control" name="motorista_cpf">
					</div>
				</div>
				<div class="row">
					<div class="col-md-6 mb-3">
						<label class="form-label">Placa</label>
						<input type="text" class="form-control" name="placa_carreta">
					</div>
					<div class="col-md-6 mb-3">
						<label class="form-label">Data</label>
						<input type="date" class="form-control" name="data" required>
					</div>
				</div>
			</div>
		</div>

		<!-- PRODUTO -->
		<div class="card border-0 shadow-sm bg-body-secondary mb-4">
			<div class="card-body">
				<h5 class="mb-3">Descrição do Produto</h5>
				<div class="row">
					<div class="col-md-4 mb-3">
						<label class="form-label">Descrição</label>
						<input type="text" class="form-control" name="produto">
					</div>
					<div class="col-md-2 mb-3">
						<label class="form-label">Quantidade</label>
						<input type="number" class="form-control" name="quantidade">
					</div>
					<div class="col-md-2 mb-3">
						<label class="form-label">Cor</label>
						<input type="text" class="form-control" name="cor">
					</div>
					<div class="col-md-2 mb-3">
						<label class="form-label">Peso</label>
						<input type="text" class="form-control" name="peso">
					</div>
					<div class="col-md-2 mb-3">
						<label class="form-label">Valor</label>
						<input type="text" class="form-control" name="valor">
					</div>
				</div>

				<div class="mb-3">
					<label class="form-label">Notas Fiscais</label>
					<textarea class="form-control" name="notas_fiscais" rows="3"></textarea>
				</div>
			</div>
		</div>

		<!-- BOTÃO FINAL -->
		<div class="text-end">
			<button type="submit" class="btn btn-primary btn-lg" style="background: #0e803a;
    border: 1px solid white;">Salvar Documento</button>
		</div>
	</form>
</div>

<script>
	function alternarCliente() {
		const camposManuais = document.getElementById('camposClienteManuais');
		const selectExistente = document.getElementById('selectClienteExistente');
		if (camposManuais.style.display === 'none') {
			camposManuais.style.display = 'block';
			selectExistente.style.display = 'none';
		} else {
			camposManuais.style.display = 'none';
			selectExistente.style.display = 'block';
		}
	}
</script>



<?php include('../includes/footer.php'); ?>