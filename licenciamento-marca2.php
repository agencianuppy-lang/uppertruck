<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Licenciamento Uppertruck Express</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">

    <style>
        body {
            margin: 0;
            font-family: system-ui, -apple-system, Segoe UI, Roboto;
            background: #0b0b0b;
            color: white;
        }

        .container {
            max-width: 1100px;
            margin: auto;
            padding: 80px 20px;
        }

        .hero {
            text-align: center;
            padding: 140px 20px;
            background: linear-gradient(180deg, #0b0b0b, #141414);
        }

        .hero h1 {
            font-size: 54px;
            max-width: 900px;
            margin: auto;
        }

        .hero p {
            font-size: 22px;
            opacity: .85;
            margin-top: 20px;
        }

        .cta {
            margin-top: 40px;
            display: inline-block;
            background: #ff2b2b;
            padding: 18px 38px;
            border-radius: 8px;
            text-decoration: none;
            color: white;
            font-weight: bold;
        }

        .section {
            border-top: 1px solid #1d1d1d;
            background: #111;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 25px;
            margin-top: 40px;
        }

        .card {
            background: #1a1a1a;
            padding: 28px;
            border-radius: 10px;
            border: 1px solid #2a2a2a;
            transition: .25s;
        }

        .card:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, .6);
        }

        .metric {
            text-align: center;
        }

        .metric-number {
            font-size: 42px;
            color: #ff2b2b;
            font-weight: bold;
        }

        .highlight {
            background: #ff2b2b;
            text-align: center;
            padding: 90px 20px;
        }

        .simulator {
            background: #151515;
            padding: 40px;
            border-radius: 12px;
            max-width: 600px;
            margin: auto;
        }

        input[type=range] {
            width: 100%;
        }

        .map {
            text-align: center;
            margin-top: 40px;
            background: #1a1a1a;
            border: 1px solid #353535;
            border-radius: 14px;
            padding: 24px;
        }

        .estado {
            fill: #f2f2f2;
            stroke: #ff2b2b;
            stroke-width: 1;
            cursor: pointer;
            transition: .2s;
        }

        .estado:hover {
            fill: #ff2b2b;
            transform: translateY(-3px);
        }

        .whatsapp {
            position: fixed;
            right: 20px;
            bottom: 20px;
            background: #25D366;
            color: white;
            padding: 16px 20px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: bold;
            box-shadow: 0 10px 20px rgba(0, 0, 0, .4);
        }

        form {
            max-width: 600px;
            margin: auto;
        }

        input,
        select,
        textarea {
            width: 100%;
            padding: 14px;
            margin-bottom: 14px;
            border-radius: 6px;
            border: none;
        }

        button {
            width: 100%;
            padding: 16px;
            background: #ff2b2b;
            border: none;
            color: white;
            font-weight: bold;
            font-size: 18px;
            border-radius: 6px;
            cursor: pointer;
        }

        .reveal {
            opacity: 0;
            transform: translateY(40px);
            transition: 1s;
        }

        .reveal.active {
            opacity: 1;
            transform: none;
        }
    </style>

</head>

<body>

    <section class="hero">

        <h1>Construa a operação logística mais forte da sua região</h1>

        <p>Utilize a marca e o modelo operacional Uppertruck para escalar sua transportadora.</p>

        <a class="cta" href="#form">Quero Licenciar</a>

    </section>

    <section class="section reveal">

        <div class="container">

            <h2>Modelo preparado para crescimento</h2>

            <div class="grid">

                <div class="metric">
                    <div class="metric-number">+20</div>
                    anos de experiência
                </div>

                <div class="metric">
                    <div class="metric-number">0</div>
                    royalties mensais
                </div>

                <div class="metric">
                    <div class="metric-number">Brasil</div>
                    expansão nacional
                </div>

            </div>

        </div>

    </section>

    <section class="highlight reveal">

        <h2>Licenciamento sem royalties</h2>

        <p>

            A Uppertruck opera com modelo de licenciamento simples:

            <br><br>

            ✔ taxa de licenciamento
            ✔ percentual apenas sobre fretes realizados

        </p>

    </section>

    <section class="section reveal">

        <div class="container">

            <h2>Simule o faturamento da sua operação</h2>

            <div class="simulator">

                <p>Fretes mensais</p>

                <input type="range" min="10" max="300" value="50" id="fretes">

                <p>Ticket médio por frete (R$)</p>

                <input type="range" min="500" max="10000" value="3000" id="ticket">

                <h3>Faturamento estimado:</h3>

                <h2 id="resultado">R$150000</h2>

            </div>

        </div>

    </section>

    <section class="section reveal">

        <div class="container">

            <h2>Escolha sua região</h2>

            <p>Selecione o estado onde deseja desenvolver sua operação.</p>

            <div class="map">

                <svg viewBox="0 0 500 500" width="400">

                    <rect class="estado" x="220" y="180" width="60" height="60" data="SP" />
                    <rect class="estado" x="300" y="200" width="40" height="40" data="RJ" />
                    <rect class="estado" x="200" y="120" width="80" height="60" data="MG" />
                    <rect class="estado" x="350" y="80" width="70" height="60" data="BA" />

                </svg>

            </div>

        </div>

    </section>

    <section class="section reveal">

        <div class="container">

            <h2>Territórios disponíveis</h2>

            <div class="metric">

                <div class="metric-number" id="territorios">87</div>

                territórios disponíveis para licenciamento

            </div>

        </div>

    </section>

    <section class="section reveal" id="form">

        <div class="container">

            <h2>Solicite informações</h2>

            <form>

                <input placeholder="Nome">

                <input placeholder="WhatsApp">

                <input placeholder="Cidade">

                <input placeholder="Estado">

                <select>

                    <option>Quantos caminhões você possui?</option>
                    <option>1 a 3</option>
                    <option>4 a 10</option>
                    <option>10+</option>

                </select>

                <textarea placeholder="Conte sobre sua operação"></textarea>

                <button>Receber informações</button>

            </form>

        </div>

    </section>

    <a class="whatsapp" href="https://wa.me/5581999999999">WhatsApp</a>

    <script>

        const fretes = document.getElementById("fretes");
        const ticket = document.getElementById("ticket");
        const resultado = document.getElementById("resultado");

        function calcular() {

            let total = fretes.value * ticket.value;

            resultado.innerText = "R$" + total.toLocaleString();

        }

        fretes.oninput = calcular;
        ticket.oninput = calcular;

        calcular();

        function reveal() {

            const reveals = document.querySelectorAll(".reveal");

            reveals.forEach(el => {

                const top = el.getBoundingClientRect().top;

                if (top < window.innerHeight - 100) {

                    el.classList.add("active");

                }

            });

        }

        window.addEventListener("scroll", reveal);

    </script>

</body>

</html>
