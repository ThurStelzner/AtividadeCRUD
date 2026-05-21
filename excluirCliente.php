<?php

    require_once "config.php";

    $id = $_GET['id'];

    $sql = "DELETE FROM clientes WHERE id=?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);

    header("Location: /clientes.php");
    exit();

?>