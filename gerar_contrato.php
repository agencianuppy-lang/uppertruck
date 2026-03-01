
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
.ovo{
  font-weight: 400;
    color: #0c9712;
}
.caixa-cinza{
    background: #ececec;
    padding: 2rem;
    border: 2px solid white;
    border-radius: 8px;
}
.login-card .card-body {
    padding: 85px 100px 60px;
}
.login-card-footer-text {
    font-size: 13px;
    color: #0d2366;
    margin-bottom: 60px;
}
h2{
  font-family: 'Inter', sans-serif;
}
.brand-wrapper .logo {
    height: 37px;
    margin-left: 25%;
}

.h4, h4 {
    width: 100%;
}
.eospan{
  font-weight: 700;
    font-size: 1.2rem;
}

body {
            background-image: url('img-form/back-form.jpg');
            background-size: cover; /* Para ajustar a imagem ao tamanho da tela */
            background-repeat: no-repeat; /* Para impedir a repetição da imagem */
            background-attachment: fixed;
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
.boxxxa {
    background: #282828;
    padding: 3rem;
    color: white;
}
.h4, h4 {
    width: 100%;
}
.brand-wrapper .logo {
    height: 60px;
    margin-left: 47%;
}
.enviarwhats {
    background: #2fab02;
    color: white;
    padding: 1rem 4rem;
    border: none;
    font-weight: 500;
    border-radius: 3px;
}
.copiarlink {
    background: #ff9000;
    color: white;
    color: black;
    padding: 1rem 4rem;
    border: none;
    font-weight: 500;
    border-radius: 3px;
    margin-left: 33%;
}
.brand-wrapper{
  width:100%;
}
.enviaremail {
    background: #3030c8;
    color: white;
    padding: 1rem 4rem;
    border: none;
    font-weight: 500;
    border-radius: 3px;
}
.enviar-b{
  margin-left: 1rem;
    color: #000000;
    font-weight: 600;
    background: #ffb300;
    padding: 1rem;
    border-radius: 5px;
}
@media (max-width:748px){
  .login-card .card-body {
    padding: 85px 37px 60px;
}
}

</style>

	<?php
    $tomador = $_POST['tomador'];
    $dadostomador = $_POST['dadostomador'];
    $localcoleta = $_POST['localcoleta'];
    $solicitantetel = $_POST['solicitantetel'];
    $localentrega = $_POST['localentrega'];
    $produto = $_POST['produto'];
    $medidasunitarias = $_POST['medidasunitarias'];
    $quantidade = $_POST['quantidade'];
    $unitizacao = $_POST['unitizacao'];
    $pesototal = $_POST['pesototal'];
    $cubagemtotal = $_POST['cubagemtotal'];
    $transporte = $_POST['transporte'];
    $seguro = $_POST['seguro'];
    $valor = $_POST['valor'];
    $prazodeentrega = $_POST['prazodeentrega'];
    $extras = $_POST['extras'];
    $pagamentovia = $_POST['pagamentovia'];
    $demonstracao = $_POST['demonstracao'];
	// Gerar um token único usando a função uniqid()
	$token = uniqid();



  // Processar os valores do seguro
if (isset($_POST['seguro']) && is_array($_POST['seguro'])) {
  $seguroSelecionado = implode(", ", $_POST['seguro']);
} else {
  $seguroSelecionado = "Nenhum seguro selecionado";
}

	// Salvar os dados do contrato em um arquivo com o nome do token
	$contratoFile = fopen("contratos/{$token}.txt", "w");
  fwrite($contratoFile, "Tomador do Serviço: $tomador\n");
  fwrite($contratoFile, "Dados do tomador: $dadostomador\n");
  fwrite($contratoFile, "Local de coleta: $localcoleta\n");
  fwrite($contratoFile, "Solicitante Tel: $solicitantetel\n");
  fwrite($contratoFile, "Local de entrega: $localentrega\n");
  fwrite($contratoFile, "Produto: $produto\n");
  fwrite($contratoFile, "Medidas unitarias: $medidasunitarias\n");
  fwrite($contratoFile, "Quantidade: $quantidade\n");
  fwrite($contratoFile, "Unitilizacao: $unitizacao\n");
  fwrite($contratoFile, "Peso total: $pesototal\n");
  fwrite($contratoFile, "Valor: $valor\n");
  fwrite($contratoFile, "Cubagem total: $cubagemtotal\n");
  fwrite($contratoFile, "Seguro: $seguroSelecionado\n");
  fwrite($contratoFile, "Prazo: $prazodeentrega\n");
  fwrite($contratoFile, "Extras: $extras\n");
  fwrite($contratoFile, "Pagamento: $pagamentovia\n");
  fwrite($contratoFile, "Demonstracao: $demonstracao\n");
	fclose($contratoFile);
  ?>



	<body>
  <main class="d-flex align-items-center min-vh-100 py-3 py-md-0" >
    <div class="container">
      <div class="">
        <div class="row no-gutters" style="margin-top: 5rem;">
       
          <div class="col-md-12 card login-card">
            <div class="card-body">

        
              
            <h2 style="text-align: left;"> Contrato de prestação de serviços</h2> <br>
           
      <hr>
      <br>
			<div class="row">
				<div class="col-md-6"><p class="dados"><b> Tomador:</b> <?php echo $tomador; ?></p></div>
        <div class="col-md-6"><p class="dados"><b> Dados do tomador:</b> <?php echo $dadostomador; ?></p></div>
        <div class="col-md-6"><p class="dados"><b> Local de coleta:</b> <?php echo $localcoleta; ?></p></div>
        <div class="col-md-6"><p class="dados"><b> Solicitante tel:</b> <?php echo $solicitantetel; ?></p></div>
        <div class="col-md-6"><p class="dados"><b> Local de entrega:</b> <?php echo $localentrega; ?></p></div>
        <div class="col-md-6"><p class="dados"><b> Produto:</b> <?php echo $produto; ?></p></div>
        <div class="col-md-6"><p class="dados"><b> Medidas unitarias:</b> <?php echo $medidasunitarias; ?></p></div>
        <div class="col-md-6"><p class="dados"><b> Quantidade:</b> <?php echo $quantidade; ?></p></div>
        <div class="col-md-6"><p class="dados"><b> Unitilização:</b> <?php echo $unitizacao; ?></p></div>
        <div class="col-md-6"><p class="dados"><b> Valor:</b> <?php echo $valor; ?></p></div>
        <div class="col-md-6"><p class="dados"><b> Peso total:</b> <?php echo $pesototal; ?></p></div>
        <div class="col-md-6"><p class="dados"><b> Cubagem total:</b> <?php echo $cubagemtotal; ?></p></div>
        <div class="col-md-6"><p class="dados"><b> Seguro:</b> <?php echo $seguroSelecionado; ?></p></div>
        <div class="col-md-6"><p class="dados"><b> Prazo:</b> <?php echo $prazodeentrega; ?></p></div>

        <div class="col-md-6"><p class="dados"><b> Extras:</b><span id="mensagemDemonstracao2"> <?php echo $extras; ?></span></p>
          <div id="mensagemCTE2" style="display: none;">
                <!-- A mensagem que você deseja mostrar quando "CT-e" for selecionado -->
                Esta é a mensagem quando "CT-e" é selecionado.
            </div>
        </div>

        <div class="col-md-6"><p class="dados"><b> Pagamento:</b> <?php echo $pagamentovia; ?></p>
        <small><b class="ovo">ICMS/ST: Recolhido pelo contratante (não caberá a transportadora responsabilidade sobre estes).</b> </small>
      </div>

        <div class="col-md-6">
          <p class="dados"><b> Demonstraçao:</b> <span id="mensagemDemonstracao"><?php echo $demonstracao; ?></span></p>
      </div>
      <div class="col-md-6">
          <div id="mensagemCTE" style="display: none;">
              <!-- A mensagem que você deseja mostrar quando "CT-e" for selecionado -->
              Esta é a mensagem quando "CT-e" é selecionado.
          </div>
      </div>

      <div class="col-sm-12">
           <br><br>
           <small><b>Coletas e/ou entregas em Zona Rural terão um acréscimo de R$200,00 + R$22,00 por Km. (compreende-se Zona Rural o acesso à vias não pavimentadas)

           </b> </small>
      
   </div>
              

			</div>
<br>
      <hr>
      <br>
      <p class="login-card-description">
      <h4><strong>Seguros:</strong></h4> 
    <p>a - O seguro cobre todo o trecho rodoviário, não cobrindo serviços de movimentação no local de descarga;</p>
    <p>b -  Solicite ao seu fornecedor o arquivo XML da Nota Fiscal. Enviar o XML para <a href="mailto:contratacao@uppertruck.com">contratacao@uppertruck.com</a></p>
    <p>b - As coberturas oferecidas por nosso sistema são: roubo, acidentes, incêndio, perdas parciais e total, avarias.</p>
    <p>c - Não está coberta a operação de carga/descarga que fica sob responsabilidade da contratante;</p>
    <p>d - Caso seja solicitado o auxílio de ajudantes/máquinas, o serviço adicional deverá ser calculado avulso com a Uppertruck;</p>
    <p>e - O serviço adicional máquina ou ajudantes será calculado com base nas horas trabalhadas;</p>
    <p>f - Seguindo as Leis Federais, todo transporte deve ser acompanhado no mínimo de uma apólice vigente.</p>
    <p>g - Em caso de sinistro serão considerados para reembolso dos produtos o valor destacado em nota fiscal.</p>
    <br><br>
    <h4><strong>Início e fim de operação:</strong></h4>
    <p>a - Aviso prévio de agendamento de 24h a 48h para coleta afim de eliminar o risco de atrasos;</p>
    <p>b - O veículo ficará a disposição pelo período de até 5h. Após, cobrar-se-ão horas adicionais previstas em legislação vigente;</p>
    <p>c - A Uppertruck fará 1 tentativa de entrega. A partir da segunda tentativa será cobrado valor adicional de reentrega;</p>
    <p>d - Sugerimos disponibilizar sempre 1 colaborador para receber a carga, conferir e assinar os canhotos de documentos fiscais;</p>
    <p>e - A Uppertruck não se responsabiliza por pendências fiscais da contratante que acarretem bloqueios em postos fiscais de fronteira.</p>
    <br><br>
    <h4><strong>Imagem:</strong></h4>
    <p>a - A contratante autoriza a Uppertruck a utilizar as imagens e vídeo do transporte prestado para fins de publicidade;</p>
    <p>b - A Uppertruck garante a contratada a proteção de dados e sigilo de produto e operação da contratante conforme a Nova LGPD.</p>
    <br><br>
    <h4><strong>Pagamento:</strong></h4>
    <p>a - Pagamentos com extensão de prazo ou parcelamentos, ficam submetidos à análise do departamento financeiro da contratada.</p>
    <p>b - Disponibilidade de pagamento Via PIX, TED, TEF e BOLETO;</p>
    <p>c - Pagamentos via PayPal, Picpay, Mercado Pago terão acréscimo de até 10% no valor final da fatura.</p>
    <p>d - Cargas sem contrato de prestação de serviço não são entregues sem a liquidação do valor devido.</p>
    <p>e - O pagamento deverá ser feito em uma das contas identificadas pelo nosso CNPJ garantido sua segurança na transação.</p>
    <br><br><br>
  </p>

               
			


              
<div class="row">
  <div class="col-md-6 caixa-cinza">
    <span class="eospan">Enviar por whatspp</span><br><br>
    <input type="text" id="numeroWhatsapp" class="form-control" placeholder="Digite o número do WhatsApp"> <br>
    <!-- Botão para enviar por WhatsApp com o número digitado -->
    <button class="enviarwhats"  id="enviarWhatsapp">Enviar por WhatsApp</button>
  </div>

  <div class="col-md-6 caixa-cinza">
    <span class="eospan">Enviar por e-mail</span><br><br>
    <input type="text" id="enderecoEmail" class="form-control" placeholder="Digite o endereço de e-mail"> <br>
    <!-- Botão para enviar por e-mail com o endereço digitado -->
    <button class="enviaremail" id="enviarEmail">Enviar por E-mail</button>
</div>
<div class="col-md-12">
<hr>
</div>

<div class="col-md-12 caixa-cinza" style="background: #2e2e2e;">
    <h4 class="eospan" style="color: white; text-align:center">Copie o link e envie manualmente:</h4><br>
    <input type="text" id="linkContrato" value="https://www.uppertruck.com/visualizar_contrato.php?token=<?php echo $token; ?>" readonly style="display: none;">
    <button class="copiarlink" id="copiarLink">Copiar Link do Contrato</button>
</div>


                <div class="brand-wrapper">
					<br><br>
              <img src="assets/img/logo/logo.png" alt="logo" class="logo">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
  <script>
// Captura o elemento <span> com base em seu ID
const mensagemDemonstracao = document.getElementById("mensagemDemonstracao");

// Verifica o conteúdo do <span>
if (mensagemDemonstracao.textContent.trim() === "CT-e") {
    // Se o conteúdo for "CT-e", cria um elemento <small> com uma quebra de linha antes dele
    const novoSmall = document.createElement("small");
    novoSmall.innerHTML = "<br><b class='ovo'>Caso escolhido CT-e, será adicionada a alíquota proporcional ao estado.</b><br>"; // Altere "Texto aqui" para o texto desejado
    mensagemDemonstracao.insertAdjacentElement("afterend", novoSmall);
}
</script>


<script>
// Captura o elemento <span> com base em seu ID
const mensagemDemonstracao2 = document.getElementById("mensagemDemonstracao2");

// Verifica o conteúdo do <span>
const conteudo = mensagemDemonstracao2.textContent.trim();
if (conteudo === "Empilhadeira" || conteudo === "Munk" || conteudo === "Paleteira") {
    // Se o conteúdo for "Nenhuma", "Dois" ou "Três", cria um elemento <small> com uma quebra de linha antes dele
    const novoSmall = document.createElement("small");
    novoSmall.innerHTML = "<br><b class='ovo'>Custos cobrados a parte</b><br>"; // Altere "Texto aqui" para o texto desejado
    mensagemDemonstracao2.insertAdjacentElement("afterend", novoSmall);
}
</script>
</script>

  <script>
document.getElementById("enviarWhatsapp").addEventListener("click", function() {
    var numero = document.getElementById("numeroWhatsapp").value;
    
    // Remover caracteres não numéricos do número (como espaços em branco e hífens)
    numero = numero.replace(/\D/g, '');

    // Verificar se o número não está vazio
    if (numero !== '') {
        // Construir o link de envio para o WhatsApp
        var linkWhatsapp = "https://api.whatsapp.com/send?phone=55" + numero + "&text=Olá, este é o contrato de prestação de serviço! Para acessá-lo, clique no link abaixo: https://www.uppertruck.com/visualizar_contrato.php?token=<?php echo $token; ?>";
        
        // Redirecionar para o link do WhatsApp
        window.location.href = linkWhatsapp;
    } else {
        alert("Por favor, digite um número de WhatsApp válido.");
    }
});
</script>


<script>
document.getElementById("enviarEmail").addEventListener("click", function() {
    var enderecoEmail = document.getElementById("enderecoEmail").value;

    if (enderecoEmail !== '') {
        var linkEmail = "mailto:" + enderecoEmail + "?subject=Contrato&body=Olá, esse é o contrato da prestação de serviço acesse o link: https://www.uppertruck.com/visualizar_contrato.php?token=<?php echo $token; ?>";
        
        window.location.href = linkEmail;
    } else {
        alert("Por favor, digite um endereço de e-mail válido.");
    }
});
</script>

<script>
document.getElementById("copiarLink").addEventListener("click", function() {
    // Obter o valor do link do contrato
    var linkContrato = document.getElementById("linkContrato").value;
    
    // Criar um elemento de texto temporário para copiar o link
    var elementoTemporario = document.createElement("textarea");
    elementoTemporario.value = linkContrato;
    
    // Adicionar o elemento temporário à página
    document.body.appendChild(elementoTemporario);
    
    // Selecionar o texto no elemento temporário
    elementoTemporario.select();
    
    // Copiar o texto para a área de transferência
    document.execCommand("copy");
    
    // Remover o elemento temporário
    document.body.removeChild(elementoTemporario);
    
    // Exibir um alerta SweetAlert
    Swal.fire({
        title: "Link copiado!",
        text: "O link do contrato foi copiado para a área de transferência.",
        icon: "success",
        timer: 3000, // Tempo que o alerta será exibido em milissegundos (3 segundos neste caso)
        showConfirmButton: false // Ocultar o botão "OK"
    });
});
</script>


  <script src="js-form/bootstrap.min.js"></script>
</body>
</html>
