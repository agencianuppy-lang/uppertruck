<?php
// Incluir o arquivo de configuração do banco de dados
include("conexao/key.php");

// Consulta para obter os registros da tabela contratos
$sql = "SELECT id, servicos FROM contratos";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Obtenha os nomes dos serviços da coluna servicos
        $servicos = explode(", ", $row["servicos"]);
        
        // Inicialize um array para armazenar os IDs dos serviços
        $servico_ids = array();

        // Consulta para mapear os nomes dos serviços para os IDs
        foreach ($servicos as $servico) {
            $servico_sql = "SELECT id FROM servicos WHERE nome_servico = '$servico'";
            $servico_result = $conn->query($servico_sql);

            if ($servico_result->num_rows > 0) {
                $servico_row = $servico_result->fetch_assoc();
                $servico_ids[] = $servico_row["id"];
            }
        }

        // Atualize a coluna servico_id com os IDs dos serviços
        $update_sql = "UPDATE contratos SET servico_id = '" . implode(",", $servico_ids) . "' WHERE id = " . $row["id"];
        $conn->query($update_sql);
    }

    echo "Coluna 'servico_id' atualizada com sucesso!";
} else {
    echo "Nenhum registro encontrado na tabela contratos.";
}

$conn->close();
?>
