<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Programa de Indicação - Uppertruck Express</title>
  <style>
    :root {
      --yellow: #FBC62C;
      --black: #000;
      --white: #fff;
      --gray: #f4f4f4;
    }

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: Arial, sans-serif;
      background: var(--gray);
      color: var(--black);
      line-height: 1.6;
    }

    header {
      background: var(--black);
      color: var(--yellow);
      padding: 20px;
      text-align: center;
    }

    header h1 {
      font-size: 2rem;
    }

    header p {
      font-size: 1.1rem;
      color: var(--white);
    }

    nav {
      background: var(--yellow);
      display: flex;
      justify-content: center;
      gap: 20px;
      padding: 10px;
    }

    nav a {
      color: var(--black);
      text-decoration: none;
      font-weight: bold;
    }

    section {
      padding: 40px 20px;
      max-width: 1000px;
      margin: auto;
    }

    section h2 {
      color: var(--black);
      margin-bottom: 20px;
      border-left: 6px solid var(--yellow);
      padding-left: 10px;
    }

    .card {
      background: var(--white);
      padding: 20px;
      border-radius: 10px;
      margin-bottom: 20px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
      gap: 20px;
    }

    .cta {
      text-align: center;
      margin-top: 30px;
    }

    .cta button {
      background: var(--yellow);
      border: none;
      padding: 15px 25px;
      font-size: 1rem;
      border-radius: 8px;
      cursor: pointer;
      font-weight: bold;
      transition: 0.3s;
    }

    .cta button:hover {
      background: #e6b020;
    }

    footer {
      background: var(--black);
      color: var(--white);
      text-align: center;
      padding: 20px;
    }

    /* Painel Login */
    #painel {
      background: var(--white);
      max-width: 400px;
      margin: 40px auto;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    #painel h3 {
      margin-bottom: 20px;
      color: var(--black);
    }

    form {
      display: flex;
      flex-direction: column;
      gap: 15px;
    }

    input {
      padding: 12px;
      border: 1px solid #ccc;
      border-radius: 8px;
    }

    input:focus {
      outline: 2px solid var(--yellow);
    }

    form button {
      background: var(--yellow);
      border: none;
      padding: 12px;
      font-size: 1rem;
      border-radius: 8px;
      cursor: pointer;
      font-weight: bold;
    }

    form button:hover {
      background: #e6b020;
    }
  </style>
</head>

<body>
  <header>
    <h1>Programa de Indicação</h1>
    <p>Uppertruck Express - Nós entregamos primeiro</p>
  </header>

  <nav>
    <a href="#objetivo">Objetivo</a>
    <a href="#funcionamento">Funcionamento</a>
    <a href="#recompensas">Recompensas</a>
    <a href="#beneficios">Benefícios</a>
    <a href="#painel">Painel</a>
  </nav>

  <section id="objetivo">
    <h2>Objetivo</h2>
    <div class="card">
      <p>Recompensar clientes e motoristas parceiros que indicarem novos negócios para a Uppertruck Express,
        fortalecendo nossa rede de confiança.</p>
    </div>
  </section>

  <section id="funcionamento">
    <h2>Funcionamento</h2>
    <div class="card">
      <ul>
        <li>Cadastre-se no painel.</li>
        <li>Indique novos clientes ou motoristas.</li>
        <li>Acompanhe o status de suas indicações.</li>
        <li>Receba recompensas em até 30 dias.</li>
      </ul>
    </div>
  </section>

  <section id="recompensas">
    <h2>Recompensas</h2>
    <div class="grid">
      <div class="card">
        <h3>Clientes</h3>
        <p>Recebem crédito de R$ 500,00 em fretes por cada nova empresa indicada.</p>
      </div>
      <div class="card">
        <h3>Motoristas</h3>
        <p>Recebem bônus em dinheiro ou crédito por cada novo parceiro indicado.</p>
      </div>
    </div>
  </section>

  <section id="beneficios">
    <h2>Benefícios Estratégicos</h2>
    <div class="card">
      <ul>
        <li>Expansão da rede de confiança.</li>
        <li>Mais oportunidades de negócios.</li>
        <li>Fortalecimento da relação com clientes e motoristas.</li>
        <li>Recompensas rápidas e transparentes.</li>
      </ul>
    </div>
  </section>

  <section id="painel">
    <h3>Painel de Acesso</h3>
    <form action="mailto:contato@uppertruck.com" method="post" enctype="text/plain">
      <input type="text" name="nome" placeholder="Nome completo" required>
      <input type="email" name="email" placeholder="Seu e-mail" required>
      <input type="password" name="senha" placeholder="Senha" required>
      <button type="submit">Cadastrar / Entrar</button>
    </form>
  </section>

  <footer>
    <p>&copy; 2025 Uppertruck Express - Nós entregamos primeiro</p>
  </footer>
</body>

</html>