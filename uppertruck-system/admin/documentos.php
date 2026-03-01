<?php

include('../includes/auth.php');

include('../includes/db.php');

include('../includes/header.php');



// Consulta documentos + nome do cliente

$sql = "SELECT 

            d.id, d.origem, d.destino, d.data,

            COALESCE(c.nome, d.cliente_nome_manual) AS cliente

        FROM documentos d

        LEFT JOIN clientes c ON d.cliente_id = c.id

        ORDER BY d.criado_em DESC";

$result = $conn->query($sql);

?>



<div class="container py-5">

	<h2 class="mb-4">Documentos Cadastrados</h2>



	<table class="table table-bordered table-striped">

		<thead class="table-dark">

			<tr>

				<th>ID</th>

				<th>Cliente</th>

				<th>Origem</th>

				<th>Destino</th>

				<th>Data</th>

				<th>Ações</th>

			</tr>

		</thead>

		<tbody>

			<?php if ($result->num_rows > 0): ?>

			<?php while ($row = $result->fetch_assoc()): ?>

			<tr>

				<td>#

					<?= $row['id'] ?>

				</td>

				<td>

					<?= $row['cliente'] ?>

				</td>

				<td>

					<?= $row['origem'] ?>

				</td>

				<td>

					<?= $row['destino'] ?>

				</td>

				<td>

					<?= date("d/m/Y", strtotime($row['data'])) ?>

				</td>

				<td>

					<a href="/uppertruck-system/doc.php?id=<?= $row['id'] ?>" target="_blank"
						class="btn btn-sm btn-outline-primary me-2">

						<i class="bi bi-eye"></i>

					</a>

					<button onclick="confirmarExclusaoDoc(<?= $row['id'] ?>)" class="btn btn-sm btn-outline-danger">

						<i class="bi bi-trash"></i>

					</button>


					<a href="javascript:void(0)" onclick="gerarLinkFoto(<?= $row['id'] ?>)"
						class="btn btn-sm btn-outline-secondary me-2" title="Gerar link para foto">
						<i class="bi bi-camera"></i>
					</a>



					<!-- Botão interno futuro -->

				</td>

			</tr>

			<?php endwhile; ?>

			<?php else: ?>

			<tr>

				<td colspan="6" class="text-center">Nenhum documento cadastrado ainda.</td>

			</tr>

			<?php endif; ?>

		</tbody>

	</table>

</div>
<script>
	async function gerarLinkFoto(id) {
		try {
			const res = await fetch('../gerar_link_foto.php?id=' + encodeURIComponent(id), {
				credentials: 'same-origin',
				headers: { 'Accept': 'application/json' }
			});
			if (!res.ok) throw new Error('HTTP ' + res.status);
			const data = await res.json();
			if (!data.ok || !data.url) {
				Swal.fire({ icon: 'error', title: 'Erro', text: data.msg || 'Não foi possível gerar o link.' });
				return;
			}
			// Resolve URL corretamente mesmo se vier relativo
			const url = new URL(data.url, location.origin).href;

			Swal.fire({
				icon: 'success',
				title: 'Link gerado!',
				html: `
					<div class="text-start">
						<p class="mb-2">Envie ao motorista este link para subir a foto:</p>
						<input id="linkFoto" class="form-control mb-2" value="${url}" readonly />
						<button class="btn btn-primary btn-sm" onclick="copyLink()">Copiar</button>
						<a class="btn btn-outline-secondary btn-sm ms-2" href="${url}" target="_blank" rel="noopener">Abrir</a>
					</div>
				`,
				showConfirmButton: false
			});
		} catch (e) {
			Swal.fire({ icon: 'error', title: 'Erro', text: 'Falha ao gerar link.' });
		}
	}

	async function copyLink() {
		try {
			const el = document.getElementById('linkFoto');
			await navigator.clipboard.writeText(el.value);
			Swal.fire({ toast: true, position: 'top-end', timer: 1500, showConfirmButton: false, icon: 'success', title: 'Copiado!' });
		} catch {
			// Fallback simples
			const el = document.getElementById('linkFoto');
			el.select();
			el.setSelectionRange(0, 99999);
			document.execCommand('copy');
			Swal.fire({ toast: true, position: 'top-end', timer: 1500, showConfirmButton: false, icon: 'success', title: 'Copiado!' });
		}
	}
</script>



<script>

	function confirmarExclusaoDoc(id) {

		Swal.fire({

			title: 'Excluir documento?',

			text: 'Essa ação não pode ser desfeita.',

			icon: 'warning',

			showCancelButton: true,

			confirmButtonText: 'Sim, excluir',

			cancelButtonText: 'Cancelar'

		}).then((result) => {

			if (result.isConfirmed) {

				window.location.href = 'excluir_documento.php?id=' + id;

			}

		});

	}

</script>





<?php include('../includes/footer.php'); ?>