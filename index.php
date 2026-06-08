<?php
// index.php — página principal

    require_once __DIR__ . "/config/config.php";  // erro fatal se não encontrar
    require_once __DIR__ . "/models/contato.php";   
    include_once __DIR__ . "/models/contatoDAO.php";
    include __DIR__ . "/view/cabecalho.php"; // warning se não encontrar
    include __DIR__ . "/config/funcoes.php";   // inclui apenas uma vez
    require __DIR__ . "/view/rodape.html";

    $pagina = $_GET['pagina'] ?? '';

    switch($pagina) {
        case "cadastrarContato":
            header("Location: /view/cadastrarContato.php");
            exit();
        case "cadastrarCliente":
            header("Location: /view/cadastrarCliente.php");
            exit();
        case "cadastrarProduto":
            header("Location: /view/cadastrarProduto.php");
            exit();
        case "clientes":
            header("Location: /view/clientes.php");
            exit();
        case "produtos":
            header("Location: /view/produtos.php");
            exit();
        default:
            break;
    }

?>
<div class="tabela">
    <?php
        exibirTabelaContatos();
        criarDiretorio();
    ?>
<div>
