<?php
    require_once __DIR__ . "/config.php";
    require_once __DIR__ . "/../models/produtoDAO.php";
    $id = $_GET['id'];
    $dao = new ProdutoDAO;
    $dao->deleteProduto($id);
    header("Location: ../view/produtos.php");
    exit();
?>