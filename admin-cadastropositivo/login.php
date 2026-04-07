<?php
declare(strict_types=1);

require_once __DIR__ . '/auth.php';

if (is_admin_logged_in()) {
    header('Location: index.php');
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = trim((string) ($_POST['usuario'] ?? ''));
    $pass = (string) ($_POST['senha'] ?? '');

    if (admin_login($user, $pass)) {
        header('Location: index.php');
        exit;
    }

    $error = 'Usuário ou senha inválidos.';
}
?>
<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Admin Cadastro Positivo</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        :root {
            --bg1: #f6ebff;
            --bg2: #fdf6fb;
            --card: #ffffff;
            --text: #1f1533;
            --muted: #6b6680;
            --accent1: #ff0a8b;
            --accent2: #7c26ff;
            --line: #eadff5;
        }
        * { box-sizing: border-box; }
        body {
            margin: 0;
            min-height: 100vh;
            font-family: Inter, sans-serif;
            background: radial-gradient(circle at 15% 20%, rgba(255, 10, 139, 0.15), transparent 25%),
                        radial-gradient(circle at 70% 75%, rgba(124, 38, 255, 0.12), transparent 30%),
                        linear-gradient(120deg, var(--bg1), var(--bg2));
            color: var(--text);
            display: grid;
            place-items: center;
            padding: 24px;
        }
        .card {
            width: 100%;
            max-width: 420px;
            background: var(--card);
            border: 1px solid var(--line);
            border-radius: 24px;
            padding: 28px;
            box-shadow: 0 15px 45px rgba(31, 21, 51, 0.12);
        }
        .tag {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 12px;
            font-weight: 700;
            letter-spacing: .08em;
            text-transform: uppercase;
            color: #e2007a;
            margin-bottom: 12px;
        }
        h1 {
            margin: 0 0 10px;
            font-size: 38px;
            line-height: 1.05;
        }
        p {
            color: var(--muted);
            margin: 0 0 20px;
        }
        label {
            display: block;
            margin: 0 0 7px;
            font-size: 14px;
            font-weight: 600;
        }
        input {
            width: 100%;
            border: 1px solid #d9d0e7;
            border-radius: 13px;
            height: 48px;
            padding: 0 14px;
            font-size: 15px;
            margin-bottom: 14px;
            outline: none;
        }
        input:focus {
            border-color: #b188ff;
            box-shadow: 0 0 0 3px rgba(124, 38, 255, 0.15);
        }
        .btn {
            width: 100%;
            height: 50px;
            border: 0;
            border-radius: 14px;
            color: #fff;
            font-weight: 800;
            font-size: 16px;
            cursor: pointer;
            background: linear-gradient(90deg, var(--accent1), var(--accent2));
            box-shadow: 0 12px 28px rgba(124, 38, 255, 0.34);
        }
        .error {
            margin-bottom: 12px;
            border: 1px solid #f6b8ca;
            background: #fff2f7;
            color: #b7174e;
            border-radius: 10px;
            padding: 10px 12px;
            font-size: 14px;
            font-weight: 600;
        }
    </style>
</head>
<body>
    <form class="card" method="post" autocomplete="off">
        <div class="tag"><i class="bi bi-shield-lock"></i> Acesso seguro</div>
        <h1>Painel<br>de formularios</h1>
        <p>Use seu acesso para visualizar os envios de Deposito, Licenciamento e Cadastro de Motorista.</p>

        <?php if ($error !== ''): ?>
            <div class="error"><?= e($error) ?></div>
        <?php endif; ?>

        <label for="usuario">Usuário</label>
        <input id="usuario" name="usuario" type="text" required>

        <label for="senha">Senha</label>
        <input id="senha" name="senha" type="password" required>

        <button type="submit" class="btn">Entrar no painel</button>
    </form>
</body>
</html>
