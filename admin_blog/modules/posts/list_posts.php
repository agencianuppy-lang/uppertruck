<?php
session_start();
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['role'] !== 'admin') {
    header('Location: ../../auth/login.php');
    exit;
}

require_once '../../config/config.php';
require_once '../../config/db.php';
require_once '../../includes/header.php';
require_once '../../includes/sidebar.php';
require_once '../../includes/topbar.php';

$stmt = $pdo->query("SELECT * FROM posts ORDER BY created_at DESC");
$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container-fluid">
    <h4 class="mb-4">Listar Posts</h4>

    <a href="novo_post.php" class="btn btn-primary mb-3">+ Novo Post</a>

    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Título</th>
                    <th>Resumo</th>
                    <th>Data</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($posts as $post): ?>
                <tr>
                    <td>
                        <?= htmlspecialchars($post['title']) ?>
                    </td>
                    <td>
                        <?= htmlspecialchars($post['excerpt']) ?>
                    </td>
                    <td>
                        <?= date('d/m/Y H:i', strtotime($post['created_at'])) ?>
                    </td>
                    <td>
                        <a href="editar_post.php?id=<?= $post['id'] ?>" class="btn btn-sm btn-warning">Editar</a>
                        <a href="excluir_post.php?id=<?= $post['id'] ?>" class="btn btn-sm btn-danger"
                            onclick="return confirm('Deseja realmente excluir este post?')">Excluir</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require_once '../../includes/footer.php'; ?>