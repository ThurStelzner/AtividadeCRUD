<?php
    require_once "config.php";
    $id = $_GET['id'];

    $arquivo = "./uploads/";

    $sql2 = "SELECT * FROM produtos WHERE id = ?";
    $stmt2 = $pdo->prepare($sql2);
    $stmt2->execute([$id]);
    $produto = $stmt2->fetch(PDO::FETCH_ASSOC);

    if(file_exists($arquivo . $produto['imagem'])) {
        unlink($arquivo . $produto['imagem']);
    };

    $sql = "DELETE FROM produtos WHERE id=?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);

    header("Location: produtos.php");
    exit();
?>