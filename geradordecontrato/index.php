<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Uppertruck | Gerador de Contrato</title>
  <!-- Inclua o link para o Bootstrap CSS -->
  <link rel="icon" type="image/png" href="../img/fav.png" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
  <!-- Inclua o link para o arquivo CSS do SweetAlert2 -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10">
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <style>
    .logo {
      width: 15rem;
    }

    .imgf {
      height: 100%;
      object-fit: cover;
      width: 100%;
    }

    body {
      font-family: 'Poppins', sans-serif;
    }
  </style>

  <section class="vh-100" style="    background-color: #ec0081;">
    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col col-xl-10">
          <div class="card" style="border-radius: 1rem;">
            <div class="row g-0">
              <div class="col-md-6 col-lg-5 d-none d-md-block">
                <img class="imgf" src="img/img1.jpg" alt="login form" class="img-fluid"
                  style="border-radius: 1rem 0 0 1rem;" />
              </div>
              <div class="col-md-6 col-lg-7 d-flex align-items-center">
                <div class="card-body p-4 p-lg-5 text-black">

                  <form method="POST" action="processa_login.php">

                    <div class="d-flex align-items-center mb-3 pb-1">
                      <i class="fas fa-cubes fa-2x me-3" style="color: #ff6219;"></i>
                      <span class="h1 fw-bold mb-0"><img src="https://nuppy.com.br/img/logo2.svg" class="logo"
                          alt=""></span>
                    </div>

                    <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Esse é o nosso gerador de contrato!
                    </h5>

                    <div class="form-outline mb-4">
                      <input type="text" name="username" placeholder="Nome de usuário"
                        class="form-control form-control-lg" />
                    </div>

                    <div class="form-outline mb-4">
                      <input type="password" placeholder="Senha" name="password" class="form-control form-control-lg" />
                    </div>

                    <div class="pt-1 mb-4">
                      <button class="btn btn-dark btn-lg btn-block" type="submit" style="background: #72008b;
    border: 1px solid #72008b;">Login</button>
                    </div>

                    <a class="small text-muted"
                      href="https://api.whatsapp.com/send?phone=5511978480001&text=Olá esqueci a senha do gerador de contrato!">Não
                      lembra a senha?</a>
                    <p class="mb-5 pb-lg-2" style="color: #393f81;">Entre em contato com o suporte técnico! </p>

                  </form>

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>


  <!-- Inclua o link para o Bootstrap JS e jQuery (necessário para alguns recursos do Bootstrap) -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <!-- Inclua o link para o arquivo JavaScript do SweetAlert2 -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

  <!-- Verifique se há um erro na URL e exiba o SweetAlert2 se necessário -->
  <?php
    if (isset($_GET["error"]) && $_GET["error"] == 1) {
        echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Erro de login',
                    text: 'Login ou senha incorretos. Por favor, tente novamente.'
                });
              </script>";
    }
    ?>
</body>

</html>