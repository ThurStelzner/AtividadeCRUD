<?php
    require "cabecalho.php";
    require_once "config.php";
    include_once "funcoes.php";
    require "rodape.html";

    $id = $_GET['id'];

    $sql = "SELECT * FROM produtos WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);

    $produto = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if($_SERVER['REQUEST_METHOD'] === "POST") {

        $nome = $_POST['nome'];
        $descricao = $_POST['descricao'];
        $preco = $_POST['preco'];
        $estoque = $_POST['estoque'];
        $fPreco = formatarPreco($preco);

        if($fPreco === false) {
            echo "Preço inválido!";
        } else {
            if (!empty($_FILES['imagem']['name'])) {
                $extensao  = pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION);
                $permitidos = ['jpg', 'jpeg', 'png', 'webp'];
            
                if (!in_array(strtolower($extensao), $permitidos)) {
                    echo 'Tipo de imagem não permitido.';
                } else {
                    $nomeArquivo = uniqid('prod_') . '.' . $extensao;
                    move_uploaded_file($_FILES['imagem']['tmp_name'], 'uploads/' . $nomeArquivo);
                    
                    $sql = "UPDATE produtos SET imagem = ?, nome = ?, descricao = ?, preco = ?, estoque = ? WHERE id = ?";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute([$nomeArquivo, $nome, $descricao, $preco, $estoque, $id]);

                    header("Location: produtos.php");
                    exit();
                }
            } else {
                $sql = "UPDATE produtos SET nome = ?, descricao = ?, preco = ?, estoque = ? WHERE id = ?";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([$nome, $descricao, $preco, $estoque, $id]);
                header("Location: produtos.php");
                exit();
            }
        }
    }
    
?>

    <form method="POST" enctype="multipart/form-data">
        <label for="imagem">Imagem do produto:</label>
        <input type="file" name="imagem">
        <label for="nome">Nome do produto:</label>
        <input type="text" name="nome" value="<?= $produto['nome'] ?>" placeholder="Nome do produto aqui" required>
        <label for="descricao">Descrição do produto:</label>
        <input type="text" name="descricao" value="<?= $produto['descricao'] ?>" placeholder="Descreva o produto aqui" required>
        <label for="preco">Preço do produto:</label>
        <input type="text" name="preco" value="<?= $produto['preco'] ?>" placeholder="Preço do produto aqui" required>
        <label for="estoque">Estoque do produto:</label>
        <input type="number" name="estoque" value="<?= $produto['estoque'] ?>" min="1" placeholder="Produtos em estoque aqui" required>
        <button type="submit">Confirmar</button>
    </form>