<?php
    require_once "config.php";
    $id = $_GET['id'];

    $sql = "DELETE FROM contatos WHERE id=?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);

    header("Location: ./");
    exit();

?>