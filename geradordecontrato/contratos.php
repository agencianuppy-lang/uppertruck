<?php
session_start();

// Proteção de rota
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Uppertruck | Lista de Contratos</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="../img/fav.png" />
    <!-- Bootstrap 4/5 (use o que já está no projeto) -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Bootstrap Icons (para os botões de ação) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            background: #ff008d;
            font-family: 'Poppins', sans-serif;
        }

        h2 {
            color: #fff;
            font-weight: 900;
            text-transform: uppercase;
            margin-top: 20px
        }

        .table-wrap {
            max-width: 1100px;
            margin: 0 auto
        }

        .table {
            background: #fff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 10px 25px rgba(0, 0, 0, .08)
        }

        .thead-dark th {
            background: #0f1f3a !important
        }

        .btn-action {
            width: 42px;
            height: 42px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            border: 2px solid transparent;
            transition: .2s
        }

        .btn-view {
            color: #0d6efd;
            border-color: #0d6efd;
            background: #eef5ff
        }

        .btn-del {
            color: #dc3545;
            border-color: #dc3545;
            background: #fff0f1
        }

        .btn-share {
            color: #6c757d;
            border-color: #6c757d;
            background: #f8f9fa
        }

        .btn-action:hover {
            filter: brightness(.95)
        }

        .icone {
            width: 20px;
            margin-right: .5rem
        }

        .contratos2 {
            position: absolute;
            top: 10px;
            right: 20px
        }

        body {
            background: #1c3270;
            font-family: 'Poppins', sans-serif;
        }

        .btn-dark {
            color: #fff;
            background-color: #0aab04;
            border-color: #0aab04;
            padding: 1rem;
        }

        .navbar-expand-lg .navbar-nav .nav-link {
            padding-right: 4.5rem;
            padding-left: .5rem;
        }

        a {
            color: #062d58;
            text-decoration: none;
            background-color: transparent;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark" style="background-color:#ffffff;">
        <div class="container">

            <!-- Logo -->
            <a class="navbar-brand d-flex align-items-center" href="contratos.php">
                <img src="https://www.uppertruck.com/assets/img/logo/logo.png" alt="Uppertruck" height="40"
                    class="mr-2">
            </a>

            <!-- Botão Mobile -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Links -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">

                    <li class="nav-item">
                        <a class="nav-link" href="proxima_pagina.php" style="color:black">
                            <i class="bi bi-file-text"></i> Gerar contrato novo
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="contratos.php" style="color:black">
                            <i class="bi bi-list-ul"></i> Lista de Contratos
                        </a>
                    </li>

                    <li class="nav-item">
                        <form method="POST" action="logout.php" class="mb-0">
                            <button type="submit" name="logout" class="btn btn-danger btn-sm ml-lg-3">
                                <i class="bi bi-box-arrow-right"></i> Sair
                            </button>
                        </form>
                    </li>

                </ul>
            </div>

        </div>
    </nav>





    <div class="container py-4">
        <h2 class="text-center">Lista de Contratos</h2>
        <p class="text-center text-white">Clique no olho para visualizar, na lixeira para excluir ou no link para gerar
            o link de assinatura.</p>

        <div class="table-wrap mt-3">
            <table class="table table-striped table-bordered mb-3">
                <thead class="thead-dark">
                    <tr>
                        <th>Tomador</th>
                        <th>CPF/CNPJ</th>
                        <th>Email</th>
                        <th>Valor do Frete</th>
                        <th style="width:170px" class="text-center">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
          include("conexao/key.php");

          $sql = "SELECT id, tomador_nome, tomador_doc, email, valor_frete, identificador_contrato 
                  FROM contratos ORDER BY id DESC";
          $result = $conn->query($sql);

          if ($result && $result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                  $id = (int)$row['id'];
                  $ident = htmlspecialchars($row['identificador_contrato']);
                  echo '<tr>';
                  echo '<td>
                          <img src="img/acessar.svg" class="icone" alt="">
                          <a class="link-detalhes" href="detalhes_contrato.php?identificador='.$ident.'">'.
                              htmlspecialchars($row["tomador_nome"]).'</a>
                        </td>';
                  echo '<td>'.htmlspecialchars($row["tomador_doc"]).'</td>';
                  echo '<td>'.htmlspecialchars($row["email"]).'</td>';
                  echo '<td>R$ '.number_format((float)$row["valor_frete"], 2, ',', '.').'</td>';
                  echo '<td class="text-center">
                          <div class="btn-group" role="group" aria-label="Ações">
                            <!-- Ver -->
                            <a class="btn-action btn-view mr-2" title="Visualizar contrato"
                               href="detalhes_contrato.php?identificador='.$ident.'">
                               <i class="bi bi-eye"></i>
                            </a>
                            <!-- Excluir -->
                            <button type="button" class="btn-action btn-del mr-2" 
                                    data-toggle="modal" data-target="#modalDelete"
                                    data-id="'.$id.'" data-nome="'.htmlspecialchars($row["tomador_nome"]).'">
                              <i class="bi bi-trash"></i>
                            </button>
                            <!-- Gerar link (assinatura/foto) -->
                            <button type="button" class="btn-action btn-share"
                                    data-toggle="modal" data-target="#modalLink"
                                    data-id="'.$id.'">
                              <i class="bi bi-link-45deg"></i>
                            </button>
                          </div>
                        </td>';
                  echo '</tr>';
              }
          } else {
              echo '<tr><td colspan="5" class="text-center">Nenhum contrato encontrado.</td></tr>';
          }
          $conn->close();
          ?>
                </tbody>
            </table>

            <div class="row">
                <div class="col-md-4 offset-md-4">
                    <a href="proxima_pagina.php" class="btn btn-dark btn-block">GERAR CONTRATO</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal GERAR LINK -->
    <div class="modal fade" id="modalLink" tabindex="-1" role="dialog" aria-labelledby="modalLinkLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-dark text-white">
                    <h5 class="modal-title" id="modalLinkLabel">Gerar link para assinatura/foto</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="linkArea">
                        <p class="mb-2 text-muted">Clique em <b>Gerar link</b> para criar um token exclusivo e
                            compartilhar com o cliente.</p>
                        <div class="input-group mb-2">
                            <input id="campoLink" type="text" class="form-control" readonly
                                placeholder="O link aparecerá aqui...">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="button" id="btnCopy"
                                    disabled>Copiar</button>
                            </div>
                        </div>
                        <div class="d-flex">
                            <button class="btn btn-primary mr-2" id="btnGerar">Gerar link</button>
                            <a id="btnWhats" class="btn btn-success mr-2 disabled" target="_blank" rel="noopener">
                                <i class="bi bi-whatsapp"></i> WhatsApp
                            </a>
                            <a id="btnEmail" class="btn btn-warning text-dark disabled" target="_blank" rel="noopener">
                                <i class="bi bi-envelope"></i> Email
                            </a>
                        </div>
                        <small class="text-muted d-block mt-2">O link expira automaticamente conforme regra do
                            backend.</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal CONFIRMAR EXCLUSÃO -->
    <div class="modal fade" id="modalDelete" tabindex="-1" role="dialog" aria-labelledby="modalDeleteLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="modalDeleteLabel">Excluir contrato</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p class="mb-0">Tem certeza que deseja excluir o contrato de <b id="delNome">—</b>?</p>
                    <small class="text-muted">Essa ação não pode ser desfeita.</small>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
                    <form id="formDelete" method="POST" action="excluir_contrato.php" class="m-0">
                        <input type="hidden" name="id" id="delId">
                        <button type="submit" class="btn btn-danger">Excluir</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- JS (jQuery/Bootstrap) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        // Preenche modal de exclusão
        $('#modalDelete').on('show.bs.modal', function (e) {
            const btn = $(e.relatedTarget);
            const id = btn.data('id');
            const nome = btn.data('nome');
            $('#delId').val(id);
            $('#delNome').text(nome);
        });

        // Gerar link de assinatura/foto
        let contratoId = null;
        $('#modalLink').on('show.bs.modal', function (e) {
            const btn = $(e.relatedTarget);
            contratoId = btn.data('id');
            resetLinkUI();
        });

        function resetLinkUI() {
            $('#campoLink').val('');
            $('#btnCopy').prop('disabled', true);
            $('#btnWhats').addClass('disabled').attr('href', '#');
            $('#btnEmail').addClass('disabled').attr('href', '#');
        }

        $('#btnGerar').on('click', async function () {
            if (!contratoId) return;

            // Ajuste o endpoint abaixo para o que você criar no projeto:
            // ex.: gerar_link_assinatura.php?id=...
            const url = 'gerar_link_assinatura.php?id=' + encodeURIComponent(contratoId);

            try {
                const res = await fetch(url, { credentials: 'same-origin' });
                const data = await res.json();

                if (!data.ok) {
                    alert(data.msg || 'Falha ao gerar o link.');
                    return;
                }

                const link = data.url;
                $('#campoLink').val(link);
                $('#btnCopy').prop('disabled', false);

                // WhatsApp/Email
                const msg = encodeURIComponent('Eu li e aceitei os termos de contrato. Aqui está o link: ' + link);
                const whats = 'https://wa.me/5511986412029?text=' + msg; // TROCAR número!
                const email = 'mailto:?subject=Assinatura%20de%20Contrato&body=' + msg;

                $('#btnWhats').removeClass('disabled').attr('href', whats);
                $('#btnEmail').removeClass('disabled').attr('href', email);

            } catch (err) {
                alert('Erro ao gerar o link.');
            }
        });

        // Copiar
        $('#btnCopy').on('click', async function () {
            const link = $('#campoLink').val();
            if (!link) return;
            try {
                await navigator.clipboard.writeText(link);
                this.textContent = 'Copiado!';
                setTimeout(() => { this.textContent = 'Copiar'; }, 1500);
            } catch {
                const input = document.getElementById('campoLink');
                input.select(); input.setSelectionRange(0, 99999);
                document.execCommand('copy');
            }
        });

    </script>


    <script>
        (function () {
            const $ = s => document.querySelector(s);
            const $$ = s => document.querySelectorAll(s);

            // 1) Visualizar
            $$(".btn-view").forEach(btn => {
                btn.addEventListener("click", () => {
                    const identificador = btn.dataset.identificador; // vem do PHP
                    window.location.href = "detalhes_contrato.php?identificador=" + encodeURIComponent(identificador);
                });
            });

            // 2) Excluir
            $$(".btn-del").forEach(btn => {
                btn.addEventListener("click", async () => {
                    const id = btn.dataset.id;
                    if (!confirm("Tem certeza que deseja excluir este contrato?")) return;
                    try {
                        const res = await fetch("excluir_contrato.php", {
                            method: "POST",
                            headers: { "Content-Type": "application/x-www-form-urlencoded" },
                            body: "id=" + encodeURIComponent(id)
                        });
                        const json = await res.json();
                        if (json.ok) {
                            // Remove a linha da tabela
                            btn.closest("tr").remove();
                        } else {
                            alert(json.msg || "Falha ao excluir.");
                        }
                    } catch (e) { alert("Erro inesperado."); }
                });
            });

            // 3) Link (gera token e monta botões)
            let linkAtual = "";
            const inputLink = $("#assinaturaLinkInput");
            const btnCopy = $("#btnCopyLink");
            const btnWpp = $("#btnShareWpp");
            const btnEmail = $("#btnShareEmail");
            const btnGerar = $("#btnGerarLink");

            // abre modal e gera link
            $$(".btn-link").forEach(btn => {
                btn.addEventListener("click", async () => {
                    const id = btn.dataset.id;
                    const nome = btn.dataset.nome || "cliente";
                    // guarda no botão Gerar o id/nome que usaremos
                    btnGerar.dataset.id = id;
                    btnGerar.dataset.nome = nome;

                    // limpa campo
                    linkAtual = "";
                    inputLink.value = "";
                    // abre o modal (Bootstrap 4/5)
                    $('#modalLink').modal('show');
                });
            });

            // clica em 'Gerar link'
            btnGerar.addEventListener("click", async () => {
                const id = btnGerar.dataset.id;
                try {
                    const res = await fetch("gerar_link_assinatura.php?id=" + encodeURIComponent(id));
                    const json = await res.json();
                    if (!json.ok) return alert(json.msg || "Falha ao gerar link.");
                    // Garante URL absoluta
                    const abs = new URL(json.url, window.location.origin).toString();
                    linkAtual = abs;
                    inputLink.value = abs;
                } catch (e) { alert("Erro inesperado."); }
            });

            // Copiar
            btnCopy.addEventListener("click", async () => {
                if (!linkAtual) return;
                try { await navigator.clipboard.writeText(linkAtual); alert("Link copiado!"); }
                catch (e) { prompt("Copie o link abaixo:", linkAtual); }
            });

            // WhatsApp (sem número) — abre seletor de contato
            btnWpp.addEventListener("click", () => {
                if (!linkAtual) return;
                const msg = `Eu li e aceitei os termos de contrato. Aqui está o link: ${linkAtual}`;
                const url = "https://wa.me/?text=" + encodeURIComponent(msg);
                window.open(url, "_blank");
            });

            // Email (mailto)
            btnEmail.addEventListener("click", () => {
                if (!linkAtual) return;
                const assunto = "Assinatura/Foto – Contrato";
                const corpo = `Olá,%0D%0A%0D%0APor favor, acesse o link abaixo para assinar/enviar a foto do documento:%0D%0A${linkAtual}%0D%0A%0D%0AObrigado.`;
                window.location.href = `mailto:?subject=${encodeURIComponent(assunto)}&body=${corpo}`;
            });

        })();
    </script>

</body>

</html>