<!-- cabecalho.php -->
<?php
    $paginaAtual = basename($_SERVER['SCRIPT_NAME']);

    switch($paginaAtual) {
        case "index.php":
            $titulo = "Lista de contatos";
            break;
        case "clientes.php":
            $titulo = "Lista de clientes";
            break;
        case "produtos.php":
            $titulo = "Lista de produtos";
            break;
        default:
            $titulo = "CRUD PHP";
            break;
    }
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../static/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Archivo+Black&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <title>CRUD PHP</title>
</head>
<body>
    <header>
        <h1><?= $titulo ?></h1>
        <nav>
            <a href="../">Contatos</a>
            <a href="../?pagina=clientes">Clientes</a>
            <a href="../?pagina=produtos">Produtos</a><br>
        </nav>
        <div class="selecao">
            <select onchange="if(this.value) {window.location.href = '../?pagina=' + this.value}">
                <option value="" style="display: none;">Cadastros</option>
                <option value="cadastrarContato">Cadastrar Contato</option>
                <option value="cadastrarCliente">Cadastrar Cliente</option>
                <option value="cadastrarProduto">Cadastrar Produto</option>
            </select>
        </div>
        <button type="button" id="btnModo" class="btnModo" onclick="alterarTema()">Modo Escuro</button>
    </header>
