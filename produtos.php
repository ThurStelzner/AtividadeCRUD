<?php
    require_once "config.php";
    require "cabecalho.php";
    include_once "funcoes.php";

    $produtos = obterProdutos($pdo);
    exibirTabelaProdutos($produtos);
?>