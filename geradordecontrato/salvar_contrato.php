<?php
// salvar_contrato.php
include "conexao/key.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

  // Helpers
  function val($k){ return isset($_POST[$k]) ? trim($_POST[$k]) : null; }
  function bval($k){ return isset($_POST[$k]) && $_POST[$k] == '1' ? 1 : 0; }

  // Normaliza números (aceita "3.213,00" ou "3213.00")
  function num_ptbr_to_float(?string $v): float {
    if ($v === null || $v === '') return 0.0;
    $v = trim($v);
    // remove tudo que não é dígito, ponto ou vírgula
    $v = preg_replace('/[^\d\.,]/', '', $v);
    // se tiver vírgula e ponto, assume ponto = milhar e vírgula = decimal
    if (strpos($v, ',') !== false && strpos($v, '.') !== false) {
      $v = str_replace('.', '', $v);
      $v = str_replace(',', '.', $v);
    } else {
      // se tiver só vírgula, troca por ponto
      $v = str_replace(',', '.', $v);
    }
    return (float)$v;
  }

  $identificador   = bin2hex(random_bytes(16));

  // Step 1
  $email           = val('email');
  $tomador_nome    = val('tomador_nome');
  $tomador_doc     = val('tomador_doc');
  $solicitante_tel = val('solicitante_tel');

  // Step 2
  $end_coleta      = val('end_coleta');
  $end_entrega     = val('end_entrega');

  // Step 3
  $produto         = val('produto');
  $medidas         = val('medidas');
  $unitizacao      = val('unitizacao');
  $quantidade      = (int) val('quantidade');
  $peso_total_kg   = num_ptbr_to_float(val('peso_total_kg'));
  $cubagem_m3      = num_ptbr_to_float(val('cubagem_m3'));

  // Step 4
  $valor_frete      = num_ptbr_to_float(val('valor_frete')); // DECIMAL/DOUBLE
  $pagamento_via    = val('pagamento_via');
  $demonstracao_via = val('demonstracao_via');

  $seg_ptp       = bval('seguro_perda_total_parcial');
  $seg_roubo     = bval('seguro_roubo');
  $seg_avarias   = bval('seguro_avarias');
  $seg_ambiental = bval('seguro_ambiental');

  $prazo_entrega = val('prazo_entrega') ?? '';
  $extras        = val('extras') ?? '';
  $observacoes   = "ICMS/ST de responsabilidade do contratante. Coletas/entregas em zona rural ou acesso não pavimentado podem ter acréscimo.";

  $sql = "INSERT INTO contratos (
            identificador_contrato, email,
            tomador_nome, tomador_doc, solicitante_tel,
            end_coleta, end_entrega,
            produto, medidas, unitizacao, quantidade, peso_total_kg, cubagem_m3,
            valor_frete, pagamento_via, demonstracao_via,
            seguro_perda_total_parcial, seguro_roubo, seguro_avarias, seguro_ambiental,
            prazo_entrega, extras, observacoes, status
          ) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?, 'ativo')";

  $stmt = $conn->prepare($sql);
  if (!$stmt) {
    die("Erro no prepare: " . $conn->error);
  }

  // TIPOS CORRETOS:
  // 1-10: ssssssssss
  // 11:   i      (quantidade)
  // 12-14: ddd   (peso_total_kg, cubagem_m3, valor_frete)
  // 15-16: ss    (pagamento_via, demonstracao_via)
  // 17-20: iiii  (seguros)
  // 21-23: sss   (prazo_entrega, extras, observacoes)
  $stmt->bind_param(
    "ssssssssssidddssiiiisss",
    $identificador, $email,
    $tomador_nome, $tomador_doc, $solicitante_tel,
    $end_coleta, $end_entrega,
    $produto, $medidas, $unitizacao,
    $quantidade, $peso_total_kg, $cubagem_m3,
    $valor_frete, $pagamento_via, $demonstracao_via,
    $seg_ptp, $seg_roubo, $seg_avarias, $seg_ambiental,
    $prazo_entrega, $extras, $observacoes
  );

  if ($stmt->execute()) {
   header("Location: contratos.php");
    exit;
  } else {
    echo "Erro ao salvar: " . $stmt->error;
  }
  $stmt->close();
}
$conn->close();