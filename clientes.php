<?php
// index.php — página principal

require_once "config.php";    // erro fatal se não encontrar
include      "cabecalho.php"; // warning se não encontrar
include_once "funcoes.php";   // inclui apenas uma vez
require "rodape.html";
?>
<div class="tabela">
<?php
    $clientes = obterClientes($pdo);
    exibirTabelaClientes($clientes);
    ?>
<div>