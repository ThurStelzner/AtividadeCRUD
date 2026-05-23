<?php
    require_once "config.php";
    require "cabecalho.php";
    include_once "funcoes.php";
    require "rodape.html";

    $produtos = obterProdutos($pdo);
    exibirTabelaProdutos($produtos);
?>