<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Formalização de transporte
    | Uppertruck</title>
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png">
  <link href="https://fonts.googleapis.com/css?family=Karla:400,700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="css-form/materialdesignicons.min.css">
  <link rel="stylesheet" href="css-form/bootstrap.min.css">
  <link rel="stylesheet" href="css-form/bootstrap.css">
  <link rel="stylesheet" href="css-form/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://kit.fontawesome.com/ec0f95ce9f.js" crossorigin="anonymous"></script>
  <script src="js-form/jquery.min.js"></script>

</head>


<style>
  @import url('https://fonts.googleapis.com/css2?family=Inter:wght@700&display=swap');
  p {
    margin-top: 0;
    margin-bottom: 0rem;
}


body {
            background-image: url('img-form/back-form.jpg');
            background-size: cover; /* Para ajustar a imagem ao tamanho da tela */
            background-repeat: no-repeat; /* Para impedir a repetição da imagem */
            background-attachment: fixed;
        }

.login-card .card-body {
    padding: 85px 100px 60px;
}
.login-card-footer-text {
    font-size: 13px;
    color: #0d2366;
    margin-bottom: 60px;
}
.h4, h4 {
    width: 100%;
}
h2{
  font-family: 'Inter', sans-serif;
}

.brand-wrapper .logo {
    height: 60px;
    margin-left: 47%;
}

.h4, h4 {
    font-size: 1.4rem;
    font-weight: 400;
}
.h2, h2 {
    font-size: 2.8rem;
}
.fancy-file-upload{
background: #ebebeb;
    padding: 17px;
    border-radius: 6px;
  }
  .dados {
    margin-bottom: 9px;
    border-bottom: 1px solid #d4d4d4;
}
.lizudo{
	margin-bottom: 1rem;
    margin-top: 1rem;
}
.ul{
	padding: 1rem;
}
.go {
    background: #363636;
    padding: 2rem;
    color: white;
    width: 100%;
}
button, input {
    overflow: visible;
    color: white;
    background: #ff0092;
    padding: 1rem 2rem;
    border: none;
    border-radius: 5px;
    margin-left: 32px;
}
@media (max-width:748px){
  .login-card .card-body {
    padding: 85px 37px 60px;
}
}

</style>


	<body>


  <main class="d-flex align-items-center min-vh-100 py-3 py-md-0" >
    <div class="container">
      <div class="">
        <div class="row no-gutters" style="margin-top: 10rem;">
       
          <div class="col-md-12 card login-card">
            <div class="card-body">


              
            <h2>Contrato de <b style="color: #ebb100;"> prestação de serviços</b></h2> 
            <br>
            <hr>

			<div class="row">

            <?php
$token = $_GET['token'];

// Verificar se o arquivo de contrato existe com o token fornecido
$contratoFile = "contratos/{$token}.txt";
if (file_exists($contratoFile)) {
  // Ler o conteúdo do arquivo de contrato
  $conteudoContrato = file_get_contents($contratoFile);

  // Explodir o conteúdo em linhas
  $linhas = explode("\n", $conteudoContrato);

  // Exibir cada item em uma coluna (col-md-6) com o rótulo em negrito
  echo '<div class="container mt-4">';
  echo '<div class="row">';
  foreach ($linhas as $linha) {
    $item = explode(":", $linha);
    echo '<div class="col-md-6"><strong>' . $item[0] . ':</strong> ' . $item[1] . '</div>';
  }
  echo '</div>';



} else {
  echo "Contrato não encontrado.";
}
?>

<br>
<hr>

			</div>

    <p class="login-card-description">
      <h4><strong>Seguros:</strong></h4> 
    <p>a - O seguro cobre todo o trecho rodoviário, não cobrindo serviços de movimentação no local de descarga;</p>
    <p>b -  Solicite ao seu fornecedor o arquivo XML da Nota Fiscal. Enviar o XML para <a href="mailto:cte@uppertruck.com">cte@uppertruck.com</a></p>
    <p>b - As coberturas oferecidas por nosso sistema são: roubo, acidentes, incêndio, perdas parciais e total, avarias.</p>
    <p>c - Não está coberta a operação de carga/descarga que fica sob responsabilidade da contratante;</p>
    <p>d - Caso seja solicitado o auxílio de ajudantes/máquinas, o serviço adicional deverá ser calculado avulso com a Uppertruck;</p>
    <p>e - O serviço adicional máquina ou ajudantes será calculado com base nas horas trabalhadas;</p>
    <p>f - Seguindo as Leis Federais, todo transporte deve ser acompanhado no mínimo de uma apólice vigente.</p>
    <p>g - Em caso de sinistro serão considerados para reembolso dos produtos o valor destacado em nota fiscal.</p>
    <br><br>
    <h4><strong>Início e fim de operação:</strong></h4> <br>
    <p>a - Aviso prévio de agendamento de 24h a 48h para coleta afim de eliminar o risco de atrasos;</p>
    <p>b - O veículo ficará a disposição pelo período de até 5h. Após, cobrar-se-ão horas adicionais previstas em legislação vigente;</p>
    <p>c - A Uppertruck fará 1 tentativa de entrega. A partir da segunda tentativa será cobrado valor adicional de reentrega;</p>
    <p>d - Sugerimos disponibilizar sempre 1 colaborador para receber a carga, conferir e assinar os canhotos de documentos fiscais;</p>
    <p>e - A Uppertruck não se responsabiliza por pendências fiscais da contratante que acarretem bloqueios em postos fiscais de fronteira.</p>
    <br><br>
    <h4><strong>Imagem:</strong></h4><br>
    <p>a - A contratante autoriza a Uppertruck a utilizar as imagens e vídeo do transporte prestado para fins de publicidade;</p>
    <p>b - A Uppertruck garante a contratada a proteção de dados e sigilo de produto e operação da contratante conforme a Nova LGPD.</p>
    <br><br>
    <h4><strong>Pagamento:</strong></h4><br>
    <p>a - Pagamentos com extensão de prazo ou parcelamentos, ficam submetidos à análise do departamento financeiro da contratada.</p>
    <p>b - Disponibilidade de pagamento Via PIX, TED, TEF e BOLETO;</p>
    <p>c - Pagamentos via PayPal, Picpay, Mercado Pago terão acréscimo de até 10% no valor final da fatura.</p>
    <p>d - Cargas sem contrato de prestação de serviço não são entregues sem a liquidação do valor devido.</p>
    <p>e - O pagamento deverá ser feito em uma das contas identificadas pelo nosso CNPJ garantido sua segurança na transação.</p>
  </p>

			<?php 
              // Adicionar checkbox e botão de aceitar
  echo '<div class="mt-4 go">';
  echo '<label><input type="checkbox" id="aceito" name="aceito"> Declaro que li e aceito os termos e condições</label>';
  echo '<button type="button" style="background: #ebb100;color:black" onclick="aceitarTermos()">Aceitar</button>';
  echo '</div>';

  echo '</div>'; 
  ?>


               

              
                <div class="brand-wrapper">
                <br><br><img src="assets/img/logo/logo.png" alt="logo" class="logo">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>

  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</body>
<script>
function aceitarTermos() {
  var aceitoCheckbox = document.getElementById("aceito");

  if (aceitoCheckbox.checked) {
    // Enviar o email
    var link = window.location.href;
    var mensagem = "Eu li e aceitei os termos de contrato do Link: " + link;

    window.location.href = "mailto:cte@uppertruck.com?subject=Termos e Condições Aceitos&body=" + mensagem;
  } else {
    alert("Por favor, marque a caixa de seleção para aceitar os termos e condições.");
  }
}
</script>
</html>
