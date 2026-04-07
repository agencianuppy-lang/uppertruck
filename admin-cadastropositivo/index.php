<?php
declare(strict_types=1);

require_once __DIR__ . '/auth.php';
require_once __DIR__ . '/modules.php';
require_admin_login();

$pdo = get_pdo();
$modules = cadastropositivo_modules();
$module = cadastropositivo_resolve_module((string) ($_GET['mod'] ?? 'deposito'));
$q = trim((string) ($_GET['q'] ?? ''));
$success = '';
$error = '';

if (!isset($_SESSION['cadastropositivo_csrf'])) {
    $_SESSION['cadastropositivo_csrf'] = bin2hex(random_bytes(16));
}
$csrf = (string) $_SESSION['cadastropositivo_csrf'];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && (string) ($_POST['action'] ?? '') === 'delete') {
    $idDelete = (int) ($_POST['id'] ?? 0);
    $token = (string) ($_POST['csrf'] ?? '');
    $postModule = cadastropositivo_resolve_module((string) ($_POST['mod'] ?? 'deposito'));
    $module = $postModule;

    if (!hash_equals($csrf, $token)) {
        $error = 'Sessao invalida. Atualize a pagina.';
    } elseif ($idDelete <= 0) {
        $error = 'Cadastro invalido para exclusao.';
    } else {
        $stmtFile = $pdo->prepare('SELECT ' . $module['upload_json_field'] . ' FROM ' . $module['table'] . ' WHERE id = :id LIMIT 1');
        $stmtFile->execute([':id' => $idDelete]);
        $rowFile = $stmtFile->fetch();

        $stmtDelete = $pdo->prepare('DELETE FROM ' . $module['table'] . ' WHERE id = :id LIMIT 1');
        $stmtDelete->execute([':id' => $idDelete]);

        if ($stmtDelete->rowCount() > 0) {
            $fileJson = '';
            if (is_array($rowFile)) {
                $fileJson = (string) ($rowFile[$module['upload_json_field']] ?? '');
            }
            $files = decode_json_list($fileJson);
            $baseDir = __DIR__ . '/uploads';
            if ($module['upload_subdir'] !== '') {
                $baseDir .= '/' . $module['upload_subdir'];
            }

            foreach ($files as $fileName) {
                $file = $baseDir . '/' . $fileName;
                if (is_file($file)) {
                    @unlink($file);
                }
            }
            $success = 'Cadastro excluido com sucesso.';
        } else {
            $error = 'Cadastro nao encontrado.';
        }
    }
}

$sql = 'SELECT ' . $module['list_sql'] . ' FROM ' . $module['table'];
$params = [];

if ($q !== '') {
    $conditions = [];
    foreach ($module['search_columns'] as $idx => $column) {
        $param = ':q' . $idx;
        $conditions[] = $column . ' LIKE ' . $param;
        $params[$param] = '%' . $q . '%';
    }
    $sql .= ' WHERE ' . implode(' OR ', $conditions);
}

$sql .= ' ORDER BY id DESC LIMIT 500';

$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$items = $stmt->fetchAll();
?>
<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Painel | Cadastro Positivo</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        :root {
            --text: #20242f;
            --muted: #687086;
            --line: #dde3f1;
            --brand: #0065e4;
            --black: #060b16;
        }
        * { box-sizing: border-box; }
        body {
            margin: 0;
            background: linear-gradient(180deg, #eef4ff, #f8f9fd 35%);
            color: var(--text);
            font-family: Inter, sans-serif;
            height: 100vh;
            display: flex;
            flex-direction: column;
        }
        .site-header,
        .site-footer {
            background: var(--black);
            color: #fff;
        }
        .site-header {
            border-bottom: 1px solid rgba(255,255,255,.08);
        }
        .site-footer {
            border-top: 1px solid rgba(255,255,255,.08);
            padding: 10px 0;
            font-size: 13px;
            color: #9fb0d9;
        }
        .container {
            max-width: 1380px;
            margin: 0 auto;
            width: 100%;
            padding: 0 26px;
        }
        .header-inner {
            min-height: 84px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 14px;
            flex-wrap: wrap;
        }
        .logo {
            display: inline-flex;
            align-items: center;
            text-decoration: none;
        }
        .logo img {
            height: 34px;
            width: auto;
            display: block;
        }
        .btn-group {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }
        .btn {
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            border: 0;
            height: 42px;
            border-radius: 11px;
            padding: 0 14px;
            font-weight: 700;
            cursor: pointer;
            color: #fff;
            background: #1f2b44;
        }
        .btn-linkclient {
            background: linear-gradient(90deg, #1373ff, #0050b8);
            box-shadow: 0 8px 24px rgba(0,101,228,.35);
        }
        .btn-logout {
            background: #0f172a;
        }
        .main {
            flex: 1;
            min-height: 0;
            overflow: auto;
        }
        .wrap { padding: 22px 0 24px; }
        .layout {
            display: grid;
            grid-template-columns: 280px minmax(0, 1fr);
            gap: 18px;
            align-items: start;
        }
        .sidebar {
            position: sticky;
            top: 18px;
            background: #fff;
            border: 1px solid var(--line);
            border-radius: 16px;
            padding: 12px;
        }
        .side-title {
            margin: 8px 8px 10px;
            color: #4a5671;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: .08em;
            font-weight: 700;
        }
        .side-link {
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 10px;
            border-radius: 12px;
            padding: 10px 10px;
            color: #2a3346;
            border: 1px solid transparent;
            transition: .15s;
        }
        .side-link i {
            font-size: 16px;
            width: 18px;
            text-align: center;
        }
        .side-link:hover {
            background: #f6f9ff;
            border-color: #d9e5fb;
        }
        .side-link.active {
            background: #edf4ff;
            border-color: #c9dcff;
            color: #0247ab;
            font-weight: 700;
        }
        .content {
            min-width: 0;
        }
        h1 {
            margin: 0;
            font-size: 30px;
            letter-spacing: -.02em;
        }
        .muted { color: var(--muted); margin-top: 4px; font-size: 14px; }
        .bar { display: flex; gap: 10px; flex-wrap: wrap; margin-top: 14px; margin-bottom: 14px; }
        .search {
            display: flex;
            width: min(620px, 100%);
            border: 1px solid var(--line);
            border-radius: 12px;
            overflow: hidden;
            background: #fff;
        }
        .search input {
            border: 0;
            padding: 0 12px;
            height: 44px;
            width: 100%;
            font-size: 14px;
            outline: none;
        }
        .search button {
            border: 0;
            height: 44px;
            border-radius: 0;
            padding: 0 16px;
            font-weight: 700;
            cursor: pointer;
            background: var(--brand);
            color: #fff;
        }
        .alert {
            border-radius: 10px;
            padding: 10px 12px;
            font-size: 14px;
            margin-bottom: 12px;
            font-weight: 600;
        }
        .alert-ok {
            border: 1px solid #9de2b8;
            background: #e9fff1;
            color: #196c34;
        }
        .alert-error {
            border: 1px solid #f7b8c6;
            background: #fff1f5;
            color: #9a2043;
        }
        .panel {
            background: #fff;
            border: 1px solid var(--line);
            border-radius: 16px;
            overflow: auto;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 900px;
        }
        th, td {
            text-align: left;
            padding: 13px 14px;
            border-bottom: 1px solid #edf1f8;
            font-size: 14px;
            vertical-align: top;
        }
        th { color: #41506b; font-size: 12px; text-transform: uppercase; letter-spacing: .05em; }
        tr:hover td { background: #f8fbff; }
        .item-title { font-weight: 700; }
        .mini { color: var(--muted); font-size: 12px; }
        .link {
            text-decoration: none;
            border: 1px solid #c9d8f7;
            border-radius: 10px;
            padding: 8px 10px;
            color: #0047b8;
            font-weight: 700;
            background: #f4f8ff;
            display: inline-block;
            white-space: nowrap;
        }
        .actions {
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .btn-delete {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            border: 1px solid #ffd0d8;
            background: #fff1f4;
            color: #c51f45;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
        }
        .empty {
            padding: 30px;
            text-align: center;
            color: var(--muted);
        }
        .footer-inner {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 10px;
            min-height: 46px;
            flex-wrap: wrap;
        }
        @media (max-width: 1024px) {
            .layout {
                grid-template-columns: 1fr;
            }
            .sidebar {
                position: static;
            }
        }
        @media (max-width: 768px) {
            .container { padding-left: 14px; padding-right: 14px; }
            h1 { font-size: 24px; }
            .logo img { height: 28px; }
        }
    </style>
</head>
<body>
    <header class="site-header">
        <div class="container header-inner">
            <a class="logo" href="index.php" aria-label="Uppertruck">
                <img src="https://uppertruck.com/img/logo.svg" alt="Uppertruck">
            </a>
            <div class="btn-group">
                <button class="btn btn-linkclient" type="button" id="btnShareClient">
                    <i class="bi bi-send"></i> Enviar link para o cliente
                </button>
                <a class="btn btn-logout" href="logout.php">Sair</a>
            </div>
        </div>
    </header>

    <main class="main">
        <div class="container wrap">
            <div class="layout">
                <aside class="sidebar">
                    <div class="side-title">Formularios do Sistema</div>
                    <?php foreach ($modules as $navModule): ?>
                        <a class="side-link <?= $navModule['key'] === $module['key'] ? 'active' : '' ?>"
                            href="index.php?mod=<?= e($navModule['key']) ?>">
                            <i class="<?= e($navModule['icon']) ?>"></i>
                            <span><?= e($navModule['menu_label']) ?></span>
                        </a>
                    <?php endforeach; ?>
                </aside>

                <section class="content">
                    <div>
                        <h1><?= e($module['title']) ?></h1>
                        <div class="muted"><?= e($module['subtitle']) ?> | Total exibido: <?= count($items) ?> (ultimos 500)</div>
                    </div>

                    <?php if ($success !== ''): ?>
                        <div class="alert alert-ok" style="margin-top: 12px;"><?= e($success) ?></div>
                    <?php endif; ?>
                    <?php if ($error !== ''): ?>
                        <div class="alert alert-error" style="margin-top: 12px;"><?= e($error) ?></div>
                    <?php endif; ?>

                    <div class="bar">
                        <form class="search" method="get">
                            <input type="hidden" name="mod" value="<?= e($module['key']) ?>">
                            <input type="text" name="q" value="<?= e($q) ?>" placeholder="<?= e($module['search_placeholder']) ?>">
                            <button type="submit">Buscar</button>
                        </form>
                    </div>

                    <div class="panel">
                        <?php if (!$items): ?>
                            <div class="empty">Nenhum cadastro encontrado.</div>
                        <?php else: ?>
                            <table>
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <?php if ($module['key'] === 'deposito'): ?>
                                            <th>Empresa</th>
                                            <th>CNPJ</th>
                                            <th>Local</th>
                                            <th>Responsavel</th>
                                        <?php elseif ($module['key'] === 'licenciamento'): ?>
                                            <th>Interessado</th>
                                            <th>Contato</th>
                                            <th>Local</th>
                                            <th>Frota</th>
                                        <?php else: ?>
                                            <th>Motorista</th>
                                            <th>RNTRC</th>
                                            <th>Veiculo</th>
                                            <th>Categoria</th>
                                        <?php endif; ?>
                                        <th>Data</th>
                                        <th>Acao</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($items as $row): ?>
                                        <tr>
                                            <td>#<?= (int) $row['id'] ?></td>

                                            <?php if ($module['key'] === 'deposito'): ?>
                                                <td>
                                                    <div class="item-title"><?= e((string) $row['razao_social']) ?></div>
                                                    <div class="mini"><?= e((string) $row['nome_fantasia']) ?></div>
                                                </td>
                                                <td><?= e((string) $row['cnpj']) ?></td>
                                                <td><?= e((string) $row['cidade']) ?>/<?= e((string) $row['estado']) ?></td>
                                                <td><?= e((string) $row['responsavel']) ?></td>
                                            <?php elseif ($module['key'] === 'licenciamento'): ?>
                                                <td>
                                                    <div class="item-title"><?= e((string) $row['nome_interessado']) ?></div>
                                                    <div class="mini"><?= e((string) $row['empresa']) ?></div>
                                                </td>
                                                <td><?= e((string) $row['whatsapp']) ?></td>
                                                <td><?= e((string) $row['cidade']) ?>/<?= e((string) $row['estado']) ?></td>
                                                <td><?= e((string) $row['qtd_caminhoes']) ?></td>
                                            <?php else: ?>
                                                <td>
                                                    <div class="item-title"><?= e((string) $row['nome_completo']) ?></div>
                                                    <div class="mini"><?= e((string) $row['cpf']) ?></div>
                                                </td>
                                                <td><?= e((string) $row['rntrc']) ?></td>
                                                <td><?= e((string) $row['placa_cavalo']) ?></td>
                                                <td><?= e((string) $row['categoria_veiculo']) ?></td>
                                            <?php endif; ?>

                                            <td><?= e(format_datetime((string) $row['criado_em'])) ?></td>
                                            <td>
                                                <div class="actions">
                                                    <a class="link"
                                                        href="detalhe.php?mod=<?= e($module['key']) ?>&id=<?= (int) $row['id'] ?>">
                                                        Ver detalhe
                                                    </a>
                                                    <form method="post"
                                                        onsubmit="return confirm('Tem certeza que deseja excluir este cadastro?');">
                                                        <input type="hidden" name="action" value="delete">
                                                        <input type="hidden" name="mod" value="<?= e($module['key']) ?>">
                                                        <input type="hidden" name="id" value="<?= (int) $row['id'] ?>">
                                                        <input type="hidden" name="csrf" value="<?= e($csrf) ?>">
                                                        <button type="submit" class="btn-delete" title="Excluir cadastro"
                                                            aria-label="Excluir cadastro">
                                                            <i class="bi bi-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        <?php endif; ?>
                    </div>
                </section>
            </div>
        </div>
    </main>

    <footer class="site-footer">
        <div class="container footer-inner">
            <div>Painel administrativo Uppertruck</div>
            <div>Cadastro Positivo</div>
        </div>
    </footer>

    <script>
        const formPath = <?= json_encode((string) $module['public_form']) ?>;

        document.getElementById('btnShareClient').addEventListener('click', async function () {
            const link = window.location.origin + formPath;

            try {
                await navigator.clipboard.writeText(link);
                alert('Link copiado para envio ao cliente:\n' + link);
            } catch (e) {
                prompt('Copie o link abaixo e envie ao cliente:', link);
            }
        });
    </script>
</body>
</html>
