<?php

    require_once __DIR__ . "/config.php";
    $pdo = Conexao::getConexao();

    $id = $_GET['id'];

    $sql = "DELETE FROM clientes WHERE id=?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);

    header("Location: /clientes.php");
    exit();

?>