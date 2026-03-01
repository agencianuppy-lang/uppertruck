<?php
include('../includes/auth.php');
include('../includes/db.php');
include('../includes/header.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verifica se cliente foi selecionado do dropdown
    $cliente_id = $_POST['cliente_id'] ?? null;
    $cliente_id = $cliente_id !== '' ? $cliente_id : null;

    // Se não veio um cliente do select, pega os dados manuais
    $cliente_nome_manual = $_POST['cliente_nome_manual'] ?? null;
    $cliente_cnpj_manual = $_POST['cliente_cnpj_manual'] ?? null;
    $cliente_endereco_manual = $_POST['cliente_endereco_manual'] ?? null;

    $origem = $_POST['origem'];
    $destino = $_POST['destino'];
    $contato_local = $_POST['contato_local'];
    $motorista_nome = $_POST['motorista_nome'];
    $motorista_cpf = $_POST['motorista_cpf'];
    $placa_cavalo = $_POST['placa_cavalo'] ?? '';
    $placa_carreta = $_POST['placa_carreta'];
    $data = $_POST['data'];
    $produto = $_POST['produto'];
    $quantidade = $_POST['quantidade'];
    $cor = $_POST['cor'];
    $peso = $_POST['peso'];
    $valor = $_POST['valor'];
    $notas_fiscais = $_POST['notas_fiscais'];

    // Prepara o INSERT completo com campos manuais
    $stmt = $conn->prepare("
        INSERT INTO documentos (
            cliente_id, cliente_nome_manual, cliente_cnpj_manual, cliente_endereco_manual,
            origem, destino, contato_local,
            motorista_nome, motorista_cpf, placa_cavalo, placa_carreta, data,
            produto, quantidade, cor, peso, valor, notas_fiscais
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
    ");

    $stmt->bind_param("isssssssssssssssss",
        $cliente_id,
        $cliente_nome_manual,
        $cliente_cnpj_manual,
        $cliente_endereco_manual,
        $origem,
        $destino,
        $contato_local,
        $motorista_nome,
        $motorista_cpf,
        $placa_cavalo,
        $placa_carreta,
        $data,
        $produto,
        $quantidade,
        $cor,
        $peso,
        $valor,
        $notas_fiscais
    );

    if ($stmt->execute()) {
        echo "<script>
            Swal.fire({
                icon: 'success',
                title: 'Documento salvo com sucesso!',
                showConfirmButton: false,
                timer: 2000
            }).then(() => {
                window.location.href = 'documentos.php';
            });
        </script>";
    } else {
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Erro ao salvar',
                text: 'Verifique os dados e tente novamente.'
            });
        </script>";
    }

    $stmt->close();
}

include('../includes/footer.php');