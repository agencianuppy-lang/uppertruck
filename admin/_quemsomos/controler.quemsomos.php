<?php
  // chama o texto
  $txtQS = $class->Select("texto", "quemsomos", "", "");
  $rowN = $txtQS->fetch(PDO::FETCH_OBJ);

  $quemsomos = "";

  (empty($rowN->texto)) ? $quemsomos = "" : $quemsomos = $rowN->texto;
?>