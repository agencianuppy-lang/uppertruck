<?php
session_start();
include('../includes/header.php');

$loginError = '';

// Se já estiver logado, redireciona via JavaScript
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
  echo "<script>
    Swal.fire({
      icon: 'info',
      title: 'Você já está logado!',
      showConfirmButton: false,
      timer: 1500
    }).then(() => {
      window.location.href = 'dashboard.php';
    });
  </script>";
  exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    // Dados fixos (pode depois migrar para o banco)
    $valid_user = 'admin';
    $valid_pass = 'upper@2025';

    if ($username === $valid_user && $password === $valid_pass) {
        $_SESSION['logged_in'] = true;
        $_SESSION['user'] = $username;
        echo "<script>
          Swal.fire({
            icon: 'success',
            title: 'Login realizado com sucesso!',
            showConfirmButton: false,
            timer: 1500
          }).then(() => {
            window.location.href = 'dashboard.php';
          });
        </script>";
        exit;
    } else {
        $loginError = "Usuário ou senha inválidos.";
    }
}
?>


<style>
  .sidebar {
    display: none;
  }
</style>
<div class="container d-flex justify-content-center align-items-center vh-100">
  <div class="card shadow p-4" style="max-width: 400px; width: 100%;">
    <h3 class="mb-4 text-center">Acesso ao Sistema</h3>
    <form method="post" class="needs-validation" novalidate>
      <div class="mb-3">
        <label for="username" class="form-label">Usuário</label>
        <input type="text" class="form-control" id="username" name="username" required autocomplete="off">
        <div class="invalid-feedback">Informe seu usuário.</div>
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Senha</label>
        <input type="password" class="form-control" id="password" name="password" required autocomplete="off">
        <div class="invalid-feedback">Informe sua senha.</div>
      </div>
      <button type="submit" class="btn btn-primary w-100">Entrar</button>
    </form>
  </div>
</div>

<?php if ($loginError): ?>
<script>
  Swal.fire({
    icon: 'error',
    title: 'Erro ao entrar',
    text: '<?= $loginError ?>',
    confirmButtonText: 'OK'
  });
</script>
<?php endif; ?>

<?php include('../includes/footer.php'); ?>