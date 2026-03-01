<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: ../../auth/login.php');
    exit;
}

require_once '../../config/config.php';
require_once '../../config/db.php';
require_once '../../includes/header.php';
require_once '../../includes/sidebar.php';
require_once '../../includes/topbar.php';

// Buscar categorias do banco
$stmt = $pdo->query("SELECT id, name FROM categories ORDER BY name");
$categorias = $stmt->fetchAll();
?>

<style>
	.card {
		padding: 2rem;
	}

	.card-title {
		font-size: 18px;
		font-weight: 600;
		color: #475569;
		margin-bottom: 0.5rem !important;
	}

	.card {
		background: #e0e5ea;
	}

	.list-group-flush>.list-group-item {
		border-width: 0 0 var(--bs-list-group-border-width);
		border-radius: 10px;
		height: 54px;
		margin-bottom: 5px;
		background: #ebeef5;
		color: #5a697e;
	}

	.chh {
		font-weight: 500;
		border-radius: 8px;
		padding: 6px;
		font-size: 12px;
		transition: all 0.2s ease;
	}
</style>
<div class="container-fluid df">
	<h4 class="mb-4">Novo Post</h4>

	<div class="mb-4 p-3 rounded" style="background: #f3f4f6; border: 1px dashed #ccc;">
		<label for="temaIA" class="form-label fw-bold mb-2">🧠 Tema do artigo (ou deixe em branco para tema
			livre):</label>
		<div class="input-group">
			<input type="text" class="form-control" id="temaIA"
				placeholder="Ex: Benefícios do café no ambiente de trabalho">
			<button type="button" class="btn btn-success" id="gerarComIA">Gerar com IA</button>
		</div>
	</div>




	<form action="store.php" method="POST" enctype="multipart/form-data">
		<div class="row">
			<!-- COLUNA ESQUERDA -->

			<div class="col-lg-7">
				<div class="row">
					<!-- Título e Slug -->
					<div class="card shadow-sm mb-4">
						<h5 class="card-title">Realize uma publicação</h5>
						<hr>
						<div class="row">
							<div class="col-md-6 mb-3">
								<label for="title" class="form-label">Título</label>
								<input type="text" name="title" id="title" class="form-control" required
									oninput="gerarSlug(this.value)">
							</div>
							<div class="col-md-6 mb-3">
								<label for="slug" class="form-label">Slug</label>
								<input type="text" name="slug" id="slug" class="form-control">
							</div>

							<!-- Categoria e Tags -->
							<div class="col-md-4 mb-3">
								<label for="category_id" class="form-label">Categoria</label>
								<select name="category_id" id="category_id" class="form-select" required>
									<?php foreach ($categorias as $index => $cat): ?>
									<option value="<?= $cat['id'] ?>" <?=$index===0 ? 'selected' : '' ?>>
										<?= htmlspecialchars($cat['name']) ?>
									</option>
									<?php endforeach; ?>
								</select>
							</div>

							<div class="col-md-4 mb-3">
								<label for="tags" class="form-label">Tags (separadas por vírgula)</label>
								<input type="text" name="tags" id="tags" class="form-control">
							</div>

							<!-- Imagem -->
							<div class="col-4 mb-3">
								<label for="image" class="form-label">Imagem destacada</label>
								<input type="file" name="image" id="image" class="form-control">
							</div>

							<div class="col-12 mb-3">
								<label for="prompt_image" class="form-label">🖼 Gerar imagem com IA (opcional)</label>
								<div class="input-group">
									<input type="text" id="prompt_image" class="form-control"
										placeholder="Descreva o que a imagem deve mostrar">
									<button type="button" class="btn btn-primary" id="btnGerarImagem">Gerar
										imagem</button>
								</div>
								<div id="previewImagemIA" class="mt-3" style="display: none;">
									<strong>Prévia da imagem gerada:</strong><br>
									<img id="imgPreviewIA" src="" alt="Imagem IA"
										style="max-width:100%; border-radius: 6px; margin-top: 8px;">
								</div>
							</div>

							<!-- Status e Agendamento -->
							<div class="col-md-4 mb-3">
								<label for="status" class="form-label">Status</label>
								<select name="status" id="status" class="form-select">
									<option value="agendado">Agendar</option>
									<option value="publicado" selected>Publicar agora!</option>
									<option value="rascunho">Rascunho</option>
								</select>
							</div>

							<div class="col-md-4 mb-3">
								<label for="scheduled_at" class="form-label">Agendar para</label>
								<input type="datetime-local" name="scheduled_at" id="scheduled_at" class="form-control"
									value="<?= date('Y-m-d\TH:i') ?>">
							</div>

							<!-- SEO -->
							<div class="col-md-4 mb-3">
								<label for="meta_title" class="form-label">Meta Title (SEO)</label>
								<input type="text" name="meta_title" id="meta_title" class="form-control">
							</div>
							<div class="col-md-4 mb-3">
								<label for="meta_description" class="form-label">Meta Description (SEO)</label>
								<input type="text" name="meta_description" id="meta_description" class="form-control">
							</div>

							<div class="col-12 mb-3">
								<label for="content" class="form-label">Conteúdo</label>
								<textarea name="content" id="editor" class="form-control" rows="18"></textarea>
							</div>

							<!-- Botões -->
							<div class="col-12 d-flex justify-content-between mt-4">
								<button type="submit" name="salvar" value="rascunho" class="btn btn-secondary">Salvar
									como
									Rascunho</button>
								<button type="submit" name="salvar" value="publicar"
									class="btn btn-primary">Publicar</button>
							</div>
						</div>
					</div>
				</div>
			</div>


			<div class="col-lg-5">
				<div class="card shadow-sm mb-4" style="background: #3F51B5;">
					<div class="card-body">
						<h5 class="card-title" style="color: white;">Últimos Posts</h5>
						<hr>
						<?php
						// Query com imagem incluída
						$stmt = $pdo->query("SELECT id, title, image FROM posts WHERE is_deleted = 0 ORDER BY created_at DESC LIMIT 5");
						$ultimos = $stmt->fetchAll();
						if ($ultimos):
						?>
						<ul class="list-group list-group-flush">
							<?php foreach ($ultimos as $p): ?>
							<li class="list-group-item d-flex justify-content-between align-items-center">
								<div class="d-flex align-items-center gap-2">
									<?php if (!empty($p['image'])): ?>
									<img src="/admin_blog/<?= $p['image'] ?>" alt="thumb"
										style="width: 40px; height: 40px; object-fit: cover; border-radius: 4px;">
									<?php else: ?>
									<div style="width: 40px; height: 40px; background: #eee; border-radius: 4px;"></div>
									<?php endif; ?>
									<span class="text-truncate" style="max-width: 180px;">
										<?= htmlspecialchars($p['title']) ?>
									</span>
								</div>
								<a href="edit.php?id=<?= $p['id'] ?>" class="btn btn-sm btn-outline-primary chh"
									title="Editar">
									<i class="fa-solid fa-pen-to-square"></i>
								</a>
							</li>
							<?php endforeach; ?>
						</ul>
						<?php else: ?>
						<p class="text-muted">Nenhum post encontrado.</p>
						<?php endif; ?>
					</div>
				</div>
				<div class="text-muted small">🧠 Dica: Atualize sempre o SEO antes de publicar.</div>
			</div>

			<!-- COLUNA DIREITA -->


			<!-- CONTEÚDO -->

		</div>
	</form>
</div>
<script>
	function gerarSlug(valor) {
		const slug = valor.toLowerCase()
			.normalize('NFD')
			.replace(/[\u0300-\u036f]/g, '')
			.replace(/[^a-z0-9 ]/g, '')
			.replace(/\s+/g, '-');
		document.getElementById('slug').value = slug;
	}

	let editor;
	ClassicEditor
		.create(document.querySelector('#editor'), {
			toolbar: {
				items: [
					'heading', '|',
					'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', '|',
					'bold', 'italic', 'underline', 'strikethrough', '|',
					'alignment', 'bulletedList', 'numberedList', '|',
					'link', 'blockQuote', 'insertTable', 'imageUpload', 'mediaEmbed', '|',
					'horizontalLine', 'sourceEditing', '|',
					'code', 'subscript', 'superscript', 'highlight', 'specialCharacters', '|',
					'undo', 'redo'
				],
				shouldNotGroupWhenFull: true
			},
			simpleUpload: {
				uploadUrl: '/admin_blog/uploads/ckeditor/upload.php'
			},
			removePlugins: ['CKBox', 'CKFinderUploadAdapter']
		})
		.then(editor => {
			const toolbarElement = editor.ui.view.toolbar.element;
			toolbarElement.classList.add('ck-sticky-toolbar');
			window.editor = editor;

			// Observe alterações no DOM para reaplicar sticky se necessário
			const observer = new MutationObserver(() => {
				const currentToolbar = editor.ui.view.toolbar.element;
				if (!currentToolbar.classList.contains('ck-sticky-toolbar')) {
					currentToolbar.classList.add('ck-sticky-toolbar');
				}
			});

			observer.observe(toolbarElement.parentElement, { childList: true, subtree: true });
		})
		.catch(console.error);

	// Geração com IA
	document.getElementById('gerarComIA').addEventListener('click', function () {
		const tema = document.getElementById('temaIA').value || 'tema livre';

		Swal.fire({
			title: 'Gerando conteúdo com IA...',
			text: 'Aguarde alguns segundos...',
			allowOutsideClick: false,
			didOpen: () => {
				Swal.showLoading();
			}
		});

		fetch('generate_article.php', {
			method: 'POST',
			headers: {
				'Content-Type': 'application/x-www-form-urlencoded',
			},
			body: 'tema=' + encodeURIComponent(tema)
		})
			.then(res => res.json())
			.then(data => {
				if (data.error) {
					console.error('DEBUG IA:', data);
					Swal.fire({
						icon: 'error',
						title: 'Erro na IA',
						text: data.message || 'Algo deu errado. Veja o console.',
					});
					return;
				}

				document.getElementById('title').value = data.title;
				document.getElementById('slug').value = data.slug;
				document.getElementById('meta_title').value = data.meta_title;
				document.getElementById('meta_description').value = data.meta_description;
				document.getElementById('tags').value = data.tags.join(', ');

				if (window.editor) {
					window.editor.setData(data.content);
				} else {
					document.getElementById('editor').value = data.content;
				}

				Swal.fire({
					icon: 'success',
					title: 'Artigo gerado!',
					text: 'Revise e publique quando quiser.',
					timer: 3000,
					showConfirmButton: false
				});
			})
			.catch(err => {
				console.error(err);
				Swal.fire({
					icon: 'error',
					title: 'Erro de conexão',
					text: 'Não foi possível se comunicar com a IA.',
				});
			});
	});

	// Geração de imagem com IA
	document.getElementById('btnGerarImagem').addEventListener('click', function () {
		const prompt = document.getElementById('prompt_image').value.trim();
		if (!prompt) {
			Swal.fire('Informe um tema!', 'Digite o que a imagem deve representar.', 'warning');
			return;
		}

		Swal.fire({
			title: 'Gerando imagem...',
			text: 'Aguarde enquanto a IA cria uma imagem para seu post.',
			allowOutsideClick: false,
			didOpen: () => {
				Swal.showLoading();
			}
		});

		fetch('generate_image.php', {
			method: 'POST',
			headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
			body: 'prompt=' + encodeURIComponent(prompt)
		})
			.then(res => res.json())
			.then(data => {
				if (data.success) {
					document.getElementById('previewImagemIA').style.display = 'block';
					document.getElementById('imgPreviewIA').src = data.image_url;

					const hiddenInput = document.createElement('input');
					hiddenInput.type = 'hidden';
					hiddenInput.name = 'image_url';
					hiddenInput.value = data.image_url;
					document.querySelector('form').appendChild(hiddenInput);

					Swal.close();
				} else {
					throw new Error(data.message || 'Erro inesperado');
				}
			})
			.catch(err => {
				console.error(err);
				Swal.fire('Erro', 'Não foi possível gerar a imagem.', 'error');
			});
	});
</script>

<style>
	.ck-rounded-corners .ck.ck-editor__main>.ck-editor__editable,
	.ck.ck-editor__main>.ck-editor__editable.ck-rounded-corners {
		border-radius: var(--ck-border-radius);
		border-top-left-radius: 0;
		border-top-right-radius: 0;
		height: 45rem;
	}
</style>


<?php require_once '../../includes/footer.php'; ?>