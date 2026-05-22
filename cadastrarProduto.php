<?php
    include "cabecalho.php";
    include_once "config.php";
    require_once "funcoes.php"; 

    if($_SERVER['REQUEST_METHOD'] === "POST") {

        $nome = $_POST['nome'];
        $descricao = $_POST['descricao'];
        $preco = $_POST['preco'];
        $estoque = $_POST['estoque'];
        $fPreco = formatarPreco($preco);

        if (!empty($_FILES['imagem']['name'])) {
            $extensao  = pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION);
            $permitidos = ['jpg', 'jpeg', 'png', 'webp'];
         
            if (!in_array(strtolower($extensao), $permitidos)) {
                echo 'Tipo de imagem não permitido.';
            } else {
                $nomeArquivo = uniqid('prod_') . '.' . $extensao;
                move_uploaded_file($_FILES['imagem']['tmp_name'], 'uploads/' . $nomeArquivo);
                cadastrarProduto($nomeArquivo, $nome, $descricao, $fPreco, $estoque, $pdo);
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
        <input type="text" name="nome" placeholder="Nome do produto aqui" required>
        <label for="descricao">Descrição do produto:</label>
        <input type="text" name="descricao" placeholder="Descreva o produto aqui" required>
        <label for="preco">Preço do produto:</label>
        <input type="text" name="preco" placeholder="Preço do produto aqui" required>
        <label for="estoque">Estoque do produto:</label>
        <input type="number" name="estoque" min="1" placeholder="Produtos em estoque aqui" required>
        <button type="submit">Cadastrar</button>
    </form>

</body>
</html>