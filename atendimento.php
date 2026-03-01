<!doctype html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Atendimento | Uppertruck</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet" />

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap"
        rel="stylesheet">

    <!-- Animations -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet" />

    <style>
        :root {
            --brand: #ffac00;
            --text: #e9e6df;
            --muted: #bcb8af;
            --glass: rgba(16, 16, 16, .48);
            --stroke: rgba(255, 255, 255, .10);
            --shadow: 0 18px 60px rgba(0, 0, 0, .45);
        }

        * {
            font-family: "Plus Jakarta Sans", system-ui, -apple-system, Segoe UI, Roboto, Arial, sans-serif;
        }

        body {
            min-height: 100vh;
            color: var(--text);
            background: radial-gradient(1200px 600px at 20% 0%, rgba(255, 172, 0, .22), transparent 55%), radial-gradient(900px 600px at 80% 30%, rgba(255, 255, 255, .10), transparent 55%), url(https://www.uppertruck.com/img/1000.jpg) center / cover no-repeat fixed;
            position: relative;
            overflow-x: clip;
            height: 100vh;
        }

        .backdrop {
            position: absolute;
            inset: 0;
            background: linear-gradient(180deg, rgba(0, 0, 0, .72), rgba(0, 0, 0, .86));
        }

        .noise {
            position: absolute;
            inset: -20%;
            pointer-events: none;
            opacity: .10;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='140' height='140'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='.8' numOctaves='2' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='140' height='140' filter='url(%23n)' opacity='.6'/%3E%3C/svg%3E");
            transform: rotate(6deg);
            mix-blend-mode: overlay;
        }

        .wrap {
            position: relative;
            z-index: 2;
            min-height: 100vh;
            display: flex;
            align-items: center;
            padding: clamp(22px, 4vw, 48px) 0;
        }



        .badge-brand {
            display: inline-flex;
            align-items: center;
            gap: .5rem;
            padding: .55rem .85rem;
            border-radius: 999px;
            background: rgba(255, 172, 0, .12);
            border: 1px solid rgba(255, 172, 0, .25);
            color: #ffe3a1;
            font-weight: 700;
            letter-spacing: .2px;
            box-shadow: 0 10px 30px rgba(255, 172, 0, .08);
        }

        h1 {
            font-weight: 800;
            line-height: 1.02;
            letter-spacing: -0.8px;
            margin: 14px 0 10px;
            font-size: clamp(2.05rem, 4.4vw, 3.2rem);
        }

        .sub {
            color: var(--muted);
            font-size: clamp(1.02rem, 1.6vw, 1.15rem);
            margin: 0 0 22px;
        }

        .panel {
            border-radius: 22px;
            background: linear-gradient(180deg, rgba(255, 255, 255, .06), rgba(255, 255, 255, .03));
            border: 1px solid var(--stroke);
            box-shadow: var(--shadow);
            overflow: hidden;
        }

        .panel-head {
            padding: 18px 18px 0;
        }

        .panel-body {
            padding: 18px;
        }

        .agent-grid {
            display: grid;
            gap: 14px;
            grid-template-columns: repeat(1, minmax(0, 1fr));
        }

        @media (min-width: 992px) {
            .agent-grid {
                grid-template-columns: repeat(3, minmax(0, 1fr));
            }

            .panel-head {
                padding: 22px 22px 0;
            }

            .panel-body {
                padding: 22px;
            }


        }

        .agent {
            position: relative;
            border-radius: 18px;
            background: rgba(10, 10, 10, .38);
            border: 1px solid rgba(255, 255, 255, .10);
            overflow: hidden;
            transition: transform .18s ease, border-color .18s ease, box-shadow .18s ease;
            cursor: pointer;
            min-height: 220px;
        }

        .agent:hover {
            transform: translateY(-4px);
            border-color: rgba(255, 172, 0, .30);
            box-shadow: 0 18px 50px rgba(0, 0, 0, .45);
        }

        .agent::before {
            content: "";
            position: absolute;
            inset: -1px;
            background: radial-gradient(600px 240px at 30% 0%, rgba(255, 172, 0, .18), transparent 55%);
            pointer-events: none;
            opacity: .9;
        }

        .agent-inner {
            position: relative;
            z-index: 1;
            height: 100%;
            padding: 16px 14px 14px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
        }

        .avatar {
            width: 272px;
            height: 272px;
            border-radius: 999px;
            overflow: hidden;
            border: 2px solid rgba(255, 172, 0, .35);
            box-shadow: 0 14px 30px rgba(0, 0, 0, .35);
            flex: 0 0 auto;
            background: rgba(255, 255, 255, .06);
        }

        .avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
            transform: scale(1.03);
        }

        .role {
            font-weight: 800;
            margin: 0;
            font-size: 1.02rem;
            letter-spacing: -.2px;
            text-align: center;
        }

        .mini {
            margin: 0;
            color: var(--muted);
            font-size: .92rem;
            text-align: center;
            line-height: 1.25;
            min-height: 2.2em;
        }

        .cta {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: .55rem;
            padding: .82rem .9rem;
            border-radius: 14px;
            border: 1px solid rgba(21, 181, 81, .35);
            background: linear-gradient(180deg, rgba(21, 181, 81, .95), rgba(13, 160, 69, .92));
            color: #fff;
            font-weight: 800;
            transition: filter .18s ease, transform .18s ease;
            user-select: none;
        }

        .agent:hover .cta {
            filter: brightness(1.04);
        }

        .agent:active {
            transform: translateY(-1px) scale(.995);
        }

        .foot {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            margin-top: 14px;
            color: rgba(233, 230, 223, .78);
            font-size: .95rem;
        }

        .foot a {
            color: rgba(255, 172, 0, .92);
            text-decoration: none;
            font-weight: 700;
        }

        .foot a:hover {
            text-decoration: underline;
        }

        .hint {
            color: rgba(233, 230, 223, .65);
            font-size: .9rem;
        }

        :root {
            height: 100vh;
            overflow: hidden;
        }

        @media (max-width:748px) {
            .agent-grid {
                display: grid;
                gap: 17px;
                grid-template-columns: none;
            }

            .noise {
                display: none;
            }

            :root {
                height: auto;
                overflow: auto;
            }

            .backdrop {
                position: fixed;
                inset: 0;
                height: 100%;
                background: linear-gradient(180deg, rgba(0, 0, 0, .72), rgba(0, 0, 0, .86));
            }
        }
    </style>
</head>

<body>
    <div class="backdrop"></div>
    <div class="noise"></div>

    <main class="wrap">
        <div class="container">
            <div class="hero">
                <div class="text-center mb-3" data-aos="fade-down" data-aos-duration="800">
                    <span class="badge-brand">
                        <i class="fa-solid fa-bolt"></i>
                        Atendimento rápido no WhatsApp
                    </span>
                    <h1 class="mt-3">Fale direto com a área certa.</h1>
                    <p class="sub">Clique no card e você será direcionado pro WhatsApp.</p>
                </div>

                <section class="panel" data-aos="fade-up" data-aos-duration="900">
                    <div class="panel-head px-3 px-lg-4">
                        <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
                            <div class="hint">
                                <i class="fa-solid fa-shield-heart me-1"></i>
                                Atendimento rápido
                            </div>
                            <div class="hint">
                                <i class="fa-solid fa-mobile-screen me-1"></i>
                                100% seguro
                            </div>
                        </div>
                    </div>

                    <div class="panel-body">
                        <div class="agent-grid">

                            <!-- Troque os src pelas suas fotos/avatares já criados -->
                            <div class="agent" data-phone="5511950452788" data-area="Comercial" data-aos="zoom-in"
                                data-aos-duration="650">
                                <div class="agent-inner">
                                    <div class="avatar">
                                        <img src="img/assax.png" alt="Agente Comercial" />
                                    </div>
                                    <div class="w-100">
                                        <p class="role">Comercial</p>
                                        <p class="mini">Orçamentos, propostas e novos negócios</p>
                                    </div>
                                    <div class="cta">
                                        <i class="fa-brands fa-whatsapp"></i>
                                        Chamar agora
                                    </div>
                                </div>
                            </div>


                            <div class="agent" data-phone="551141052380" data-area="Operacional" data-aos="zoom-in"
                                data-aos-duration="650" data-aos-delay="120">
                                <div class="agent-inner">
                                    <div class="avatar">
                                        <img src="img/laurr2.png" alt="Agente Operacional" />
                                    </div>
                                    <div class="w-100">
                                        <p class="role">Operacional</p>
                                        <p class="mini">Coletas, entregas e andamento</p>
                                    </div>
                                    <div class="cta">
                                        <i class="fa-brands fa-whatsapp"></i>
                                        Chamar agora
                                    </div>
                                </div>
                            </div>

                            <div class="agent" data-phone="5511949790558" data-area="Financeiro" data-aos="zoom-in"
                                data-aos-duration="650" data-aos-delay="180">
                                <div class="agent-inner">
                                    <div class="avatar">
                                        <img src="img/ivvn2.png" alt="Agente Financeiro" />
                                    </div>
                                    <div class="w-100">
                                        <p class="role">Financeiro</p>
                                        <p class="mini">Boletos, pagamentos e cobranças</p>
                                    </div>
                                    <div class="cta">
                                        <i class="fa-brands fa-whatsapp"></i>
                                        Chamar agora
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="foot">
                            <div>
                                <i class="fa-solid fa-circle-info me-1"></i>
                                Se preferir, mande só um “Oi” que o agente já te direciona.
                            </div>
                            <div>
                                <a href="https://www.uppertruck.com" target="_blank" rel="noopener">
                                    Voltar ao site <i class="fa-solid fa-arrow-up-right-from-square ms-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>

    <script>
        AOS.init({ once: true, offset: 80 });

        const baseMsg = "Olá! Vim pelo site e queria atendimento com a área: ";
        const isMobile = () => /Android|iPhone|iPad|iPod|Opera Mini|IEMobile/i.test(navigator.userAgent);

        function openWhats(phone, area) {
            const msg = encodeURIComponent(baseMsg + area + ".");
            const url = isMobile()
                ? `https://wa.me/${phone}?text=${msg}`
                : `https://web.whatsapp.com/send?phone=${phone}&text=${msg}`;
            window.open(url, "_blank", "noopener,noreferrer");
        }

        document.querySelectorAll(".agent").forEach((card) => {
            card.addEventListener("mousemove", (e) => {
                const r = card.getBoundingClientRect();
                const x = (e.clientX - r.left) / r.width - 0.5;
                const y = (e.clientY - r.top) / r.height - 0.5;
                gsap.to(card, { rotateY: x * 6, rotateX: -y * 6, transformPerspective: 900, duration: 0.25, ease: "power2.out" });
            });

            card.addEventListener("mouseleave", () => {
                gsap.to(card, { rotateY: 0, rotateX: 0, duration: 0.35, ease: "power2.out" });
            });

            card.addEventListener("click", () => {
                const phone = card.getAttribute("data-phone");
                const area = card.getAttribute("data-area");
                openWhats(phone, area);
            });
        });
    </script>
</body>

</html>