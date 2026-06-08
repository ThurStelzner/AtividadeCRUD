<?php
// index.php — página principal

require_once __DIR__ . "/../config/config.php";    // erro fatal se não encontrar
include __DIR__ . "/cabecalho.php"; // warning se não encontrar
include_once __DIR__ . "/../config/funcoes.php";   // inclui apenas uma vez
require __DIR__ . "/rodape.html";
?>
<div class="tabela">
<?php
    $clientes = obterClientes($pdo);
    exibirTabelaClientes($clientes);
    ?>
<div>