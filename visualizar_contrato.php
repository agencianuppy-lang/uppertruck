<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Contrato de Prestação | Uppertruck</title>
  <link rel="shortcut icon" href="assets/img/favicon.png" type="image/x-icon">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">

  <style>
    body {
      font-family: 'Inter', sans-serif;
      background: #f9f9f9;
      color: #333;
    }

    .logo {
      max-height: 60px;
    }

    .contract-container {
      background: white;
      padding: 2.5rem;
      border-radius: 8px;
      box-shadow: 0 0 20px rgba(0, 0, 0, 0.05);
      margin-top: 5rem;
      margin-bottom: 5rem;
    }

    .table th {
      background-color: #f1f1f1;
    }

    .section-title {
      font-weight: 700;
      font-size: 1.4rem;
      margin-top: 2rem;
    }

    .accept-buttons {
      margin-top: 2rem;
    }

    .accept-buttons button {
      margin-right: 1rem;
    }

    .table th {
      background-color: #122547;
      color: white;
    }

    .table-responsive {
      border-radius: 11px;
    }

    @media (min-width: 1400px) {

      .container,
      .container-lg,
      .container-md,
      .container-sm,
      .container-xl,
      .container-xxl {
        max-width: 71rem;
      }
    }

    @media (max-width:748px) {
      .contract-container {
        background: white;
        padding: 0.5rem;
        border-radius: 8px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.05);
        margin-top: 5rem;
        margin-bottom: 5rem;
      }

      .accept-buttons button {
        margin-right: 1rem;
        margin-bottom: 1rem;
        width: 100%;
        height: 4rem;
      }

    }

    body {
      font-family: 'Inter', sans-serif;
      background: #122547;
      color: #333;
    }

    li {
      margin-bottom: 1rem;
      margin-top: 1rem;
    }
  </style>
</head>

<body>

  <header class="fixed-top bg-white shadow-sm py-3 border-bottom">
    <div class="container text-center">
      <img src="assets/img/logo/logo.png" alt="Uppertruck Logo" class="logo" style="max-height: 50px;">
    </div>
  </header>

  <!-- Espaço para compensar o header fixo -->
  <div style="height: 90px;"></div>



  <div class="container">


    <div style="color: white; font-family: Arial, sans-serif; line-height: 1.6;padding-left: 1rem;
    margin-top: 1rem;
}">
      <strong>UPPERTRUCK EXPRESS</strong><br>
      CNPJ: 24.940.831/0001-01<br>
      Av. Paulista, 726 Sl 21 Caixa Postal 387<br>
      SÃO PAULO (SP)<br>
      <a href="mailto:contratacao@uppertruck.com" style="color: white;">contratacao@uppertruck.com</a><br>
      <a href="https://www.uppertruck.com" target="_blank" style="color: white;">www.uppertruck.com</a>
    </div>




    <div class="contract-container" style="margin-bottom: 2rem;    margin-top: 2rem;">
      <h2 class="text-center mb-4" style="text-transform: uppercase;font-weight: 700;color: #122547;">CONTRATO DE
        PRESTAÇÃO DE SERVIÇOS DE TRANSPORTE RODOVIÁRIO DE CARGAS</h2>
      <?php
$token = $_GET['token'];
$contratoFile = "contratos/{$token}.txt";

if (file_exists($contratoFile)) {
  $conteudoContrato = file_get_contents($contratoFile);
  $linhas = explode("\n", $conteudoContrato);

  echo '<div class="table-responsive">';
  echo '<table class="table table-hover table-striped align-middle">';
  echo '<thead class="bg-primary text-white">';
  echo '<tr><th scope="col">Campo</th><th scope="col">Valor</th></tr>';
  echo '</thead><tbody>';

  foreach ($linhas as $linha) {
    $item = explode(":", $linha, 2);
    if (count($item) === 2) {
      echo '<tr>';
      echo '<td class="fw-semibold text-dark">' . htmlspecialchars(trim($item[0])) . '</td>';
      echo '<td class="text-muted">' . htmlspecialchars(trim($item[1])) . '</td>';
      echo '</tr>';
    }
  }

  echo '</tbody></table>';
  echo '</div>';
} else {
  echo '<div class="alert alert-danger mt-4">Contrato não encontrado.</div>';
}
?>


      <div class="section-title">🧑‍💼 1. PARTES</div>
      <p><b>1.1.</b> CONTRATANTE: Pessoa física ou jurídica legalmente cadastrada nos bancos de dados governamentais
        conforme a
        legislação brasileira.<br> <br>
        <b>1.2.</b> CONTRATADA: UPPERTRUCK EXPRESS, pessoa jurídica regularmente constituída, doravante denominada
        transportadora.
      </p>

      <div class="section-title">📦 2. OBJETO DO CONTRATO</div>
      <p><b>2.1.</b> O presente contrato tem como objeto a prestação de serviços de transporte rodoviário de cargas em
        território nacional brasileiro, com pagamento sob demanda, nas modalidades fracionada ou dedicada, sob o sistema
        de consolidação e otimização.</p>

      <div class="section-title">🚚 3. CONTRATAÇÃO E UTILIZAÇÃO DOS SERVIÇOS</div>
      <ul>
        <li><b>3.1.</b> A Uppertruck Express garante a prestação do serviço com segurança, sigilo e integridade das
          cargas.
        </li>
        <li><b>3.2.</b> Avaliações públicas da Uppertruck estão disponíveis na web <a href="https://g.co/kgs/dCGCkN6"
            target="_blank">https://g.co/kgs/dCGCkN6</a></li>
        <li><b>3.3.</b> Para confirmação de embarque, serão cobrados à título de compromisso, 10% do valor do frete, via
          depósito em conta da Uppertruck Express com taxa não reembolsável em casos de cancelamentos não justificados.
        </li>
        <li><b>3.4.</b> Após confirmação, o prazo mínimo de agendamento para coleta é de 24h a 48h úteis.</li>
        <li><b>3.5.</b> A Uppertruck Express não se responsabiliza por pendências fiscais da contratante que possam
          acarretar
          retenções em postos fiscais.</li>
        <li><b>3.6.</b> Em caso de retenção do veículo por fiscalização, serão cobradas diárias proporcionais ao tempo
          de
          parada.</li>
        <li><b>3.7.</b> Carga e descarga terão tolerância de até 5h. Após esse período, serão cobradas horas
          adicionais sob
          tabela prevista na legislação federal.</li>
        <li><b>3.8.</b> Endereços errados (erro superior a 2km) gerarão taxa de deslocamento perdido.</li>
        <li><b>3.9.</b> Acesso difícil ou inadequado (ruas não pavimentadas, bloqueadas, com fiação baixa ou
          restrições)
          acarretará taxa adicional.</li>
        <li><b>3.10.</b> A Uppertruck Express realizará uma tentativa de entrega agendada. A partir da segunda
          tentativa,
          será
          cobrada taxa de reentrega, se houver espera superior a 60 minutos ou deslocamento acima de 2km.</li>
        <li><b>3.11.</b> A contratante deve disponibilizar colaborador apto a receber a carga, conferi-la e assinar os
          documentos.</li>
        <li><b>3.12.</b> Por padrão de segurança, os motoristas não estão autorizados a manusear a carga.</li>
      </ul>

      <div class="section-title">🛡️ 4. SEGURO DA CARGA</div>
      <ul>
        <li></b>4.1.</b> A Uppertruck Express oferece até três modalidades de seguro, conforme legislação federal,
          conhecidos
          por RCT-RC, RCF-DC e AV.</li>
        <li></b>4.2.</b> Coberturas incluem: amassamento, abalroamento, fissura, perda total ou parcial, roubo/desvio –
          apenas
          durante o transporte.</li>
        <li><b>4.3.</b> Movimentação de carga na coleta ou entrega não está incluída e deve ser contratada à parte.</li>
        <li><b>4.4.</b> É obrigatório o envio do XML da nota fiscal para: <a
            href="mailto:cte@uppertruck.com">cte@uppertruck.com</a>.</li>
        <li><b>4.5.</b> Produtos sem nota fiscal não terão cobertura.</li>
        <li><b>4.6.</b> Há cobertura adicional de avarias para produtos novos de fábrica.</li>
        <li><b>4.7.</b> Serviços de ajudantes ou máquinas são cobrados à parte, sem cobertura de seguro.</li>
        <li><b>4.8.</b> Em caso de sinistro, o valor de reembolso será o indicado na nota fiscal.</li>
        <li><b>4.9.</b> Há franquia de 10% do valor total da nota fiscal para acionamento do seguro.</li>
        <li><b>4.10.</b> O sinistro deve ser comunicado imediatamente, com fotos e vídeos no ato do recebimento.</li>
        <li><b>4.11.</b> O prazo para análise, reembolso ou indenização é de até 30 dias úteis após a abertura do
          sinistro.
        </li>
        <li><b>4.12.</b> A seguradora pode ou não enviar perito, e é ela quem define o tipo e extensão da indenização
          (total ou
          parcial).</li>
        <li><b>4.13.</b> O contratante poderá escolher entre indenização em valor monetário ou reposição dos produtos,
          conforme
          diretrizes da seguradora.</li>
      </ul>

      <div class="section-title">📸 5. DIREITO DE IMAGEM</div>
      <ul>
        <li><b>5.1.</b> A contratante autoriza o uso de imagens e vídeos do transporte para fins de marketing e
          segurança
          operacional.</li>
        <li><b>5.2.</b> A Uppertruck Express garante o sigilo de informações e cumprimento da Lei Geral de Proteção de
          Dados
          (LGPD).</li>
      </ul>

      <div class="section-title">💳 6. PAGAMENTO</div>
      <ul>
        <li><b>6.1.</b> Prazos ou parcelamentos estarão sujeitos à análise do setor financeiro da Uppertruck Express.
        </li>
        <li><b>6.2.</b> Formas de pagamento: PIX e boleto bancário.</li>
        <li><b>6.3.</b> Outros métodos (PayPal, PicPay, Mercado Pago, Criptomoedas) terão acréscimo de até 10% no valor
          total.
        </li>
        <li><b>6.4.</b> Na modalidade “Buy Now, Pay Later” (contrate e pague na entrega), a descarga somente ocorrerá
          após a
          confirmação do pagamento.</li>
        <li><b>6.5.</b> Pagamentos deverão ser feitos em contas bancárias identificadas com o CNPJ da Uppertruck
          Express.</li>
        <li><b>6.6.</b> Dúvidas relacionadas ao pagamento poderão ser tratadas diretamente com o(a) executivo(a) de
          conta
          Uppertruck Express.</li>
      </ul>

      <div class="section-title">⚖️ CLÁUSULA FINAL – DISPOSIÇÕES JURÍDICAS</div>
      <ul>
        <li><b>7.1.</b> O presente contrato tem validade legal entre as partes a partir do momento de sua assinatura
          eletrônica, física ou da contratação efetiva do serviço.</li>
        <li><b>7.2.</b> Fica eleito o foro da Comarca de [CIDADE/UF], com renúncia de qualquer outro, por mais
          privilegiado que
          seja, para dirimir quaisquer dúvidas ou conflitos oriundos deste contrato.</li>
        <li><b>7.3</b>. As partes declaram que leram, compreenderam e concordam com todas as cláusulas aqui estipuladas,
          comprometendo-se a cumpri-las integralmente.</li>
        <li><b>7.4.</b> Este contrato é parte integrante dos documentos jurídicos e operacionais da Uppertruck Express,
          sendo
          de uso exclusivo entre as partes, com proteção legal garantida pela legislação brasileira vigente.</li>
        <li><b>7.5.</b> Aceitando os termos deste contrato, será gerado um token de verificação e autenticidade pelo
          qual
          recebemos o documento como assinatura digital.</li>
        <li><b>7.6.</b> Uma via deste documento poderá ser solicitada em modo PDF.</li>
      </ul>

    </div>


    <section>

      <div class="container">

        <div class="contract-container" style="    margin: 0rem;
    padding-top: 1rem;
        width: -webkit-fill-available;">

          <div class="accept-buttons">
            <div class="form-check mb-3">
              <input class="form-check-input" type="checkbox" value="" id="aceito">
              <label class="form-check-label" for="aceito">
                Declaro que li e aceito os termos e condições
              </label>
            </div>
            <button type="button" class="btn btn-warning text-dark" onclick="aceitarTermosEmail()">Aceitar via
              Email</button>
            <button type="button" class="btn btn-success" onclick="aceitarTermosWhatsApp()">Aceitar via
              WhatsApp</button>
          </div>
        </div>
      </div>
    </section>


    <footer class="bg-light border-top py-4 mt-5">
      <div class="container text-center">
        <p class="mb-0 small text-muted">
          ©
          <?php echo date('Y'); ?> Uppertruck. Todos os direitos reservados.
        </p>
      </div>
    </footer>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
      function aceitarTermosEmail() {
        var aceitoCheckbox = document.getElementById("aceito");
        if (aceitoCheckbox.checked) {
          var urlParams = new URLSearchParams(window.location.search);
          var token = urlParams.get('token');
          var mensagem = "Eu li e aceitei os termos de contrato do Link: https://www.uppertruck.com/visualizar_contrato.php?token=" + token;
          window.location.href = "mailto:contratacao@uppertruck.com?subject=Termos e Condições Aceitos&body=" + encodeURIComponent(mensagem);
        } else {
          alert("Por favor, marque a caixa de seleção para aceitar os termos e condições.");
        }
      }

      function aceitarTermosWhatsApp() {
        var aceitoCheckbox = document.getElementById("aceito");
        if (aceitoCheckbox.checked) {
          var urlParams = new URLSearchParams(window.location.search);
          var token = urlParams.get('token');
          var mensagemWhatsApp = "Eu li e aceitei os termos de contrato. Aqui está o link: https://www.uppertruck.com/visualizar_contrato.php?token=" + token;
          var telefone = "+554497370488".replace(/\D/g, '');
          var whatsappURL = "https://wa.me/" + telefone + "?text=" + encodeURIComponent(mensagemWhatsApp);
          window.open(whatsappURL, '_blank');
        } else {
          alert("Por favor, marque a caixa de seleção para aceitar os termos e condições.");
        }
      }
    </script>
</body>

</html>