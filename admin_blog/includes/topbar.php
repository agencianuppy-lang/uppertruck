<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$nome_usuario = $_SESSION['usuario']['nome'] ?? 'Usuário';
?>

<header class="topbar bg-white border-bottom py-3 mb-4 ddsr">
	<div class="container-fluid d-flex justify-content-between align-items-center ddsr">
		<!-- Saudação -->
		<h6 class="mb-0">Olá,
			<?= htmlspecialchars($nome_usuario) ?> 👋
		</h6>

		<!-- Ações à direita -->
		<div class="d-flex align-items-center gap-3">

			<form action="/admin_blog/modules/tools/generate_sitemap.php" method="post" class="m-0 p-0">
				<input type="hidden" name="csrf" value="<?= $_SESSION['csrf'] ?>">
				<button type="submit" class="btn btn-sm btn-outline-secondary d-inline-flex align-items-center"
					title="Gerar sitemap.xml agora" style="gap:.4rem;">
					<i class="fa fa-sitemap"></i>
					<span>Gerar sitemap</span>
				</button>
			</form>


			<!-- Últimos Posts Dropdown -->
			<div class="dropdown">


				<button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
					aria-expanded="false">
					Últimos Posts
				</button>
				<ul class="dropdown-menu dropdown-menu-end" style="min-width: 280px;">
					<?php
					$stmt = $pdo->query("SELECT id, title, image FROM posts WHERE is_deleted = 0 ORDER BY created_at DESC LIMIT 5");
					$ultimos = $stmt->fetchAll();
					if ($ultimos):
						foreach ($ultimos as $p):
					?>
					<li>
						<a href="/admin_blog/modules/posts/edit.php?id=<?= $p['id'] ?>"
							class="dropdown-item d-flex align-items-center gap-2">
							<?php if (!empty($p['image'])): ?>
							<img src="/admin_blog/<?= $p['image'] ?>" alt="thumb"
								style="width: 32px; height: 32px; object-fit: cover; border-radius: 4px;">
							<?php else: ?>
							<div style="width: 32px; height: 32px; background: #eee; border-radius: 4px;"></div>
							<?php endif; ?>
							<span class="text-truncate" style="max-width: 190px;">
								<?= htmlspecialchars($p['title']) ?>
							</span>
						</a>
					</li>
					<?php endforeach; else: ?>
					<li><span class="dropdown-item text-muted">Nenhum post encontrado</span></li>
					<?php endif; ?>
				</ul>
			</div>

			<button id="botao-bebado" class="btn btn-sm btn-outline-dark me-2">
				🥴 Modo Bêbado
			</button>


			<!-- Botão Novo Post -->
			<a href="/admin_blog/modules/posts/create.php" class="btn btn-sm btn-primary"
				style="background-color: #009688;">
				<i class="fa fa-plus me-1"></i> Criar nova postagem
			</a>

			<!-- Botão Sair -->
			<a href="/admin_blog/auth/logout.php" class="btn btn-outline-danger btn-sm">
				<i class="fa-solid fa-right-from-bracket me-1"></i> Sair
			</a>
		</div>
	</div>
</header>