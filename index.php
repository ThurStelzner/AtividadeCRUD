<?php
// index.php — página principal

    require_once __DIR__ . "/config/config.php";  // erro fatal se não encontrar
    require_once __DIR__ . "/models/contato.php";   
    include_once __DIR__ . "/models/contatoDAO.php";
    include __DIR__ . "/view/cabecalho.php"; // warning se não encontrar
    include __DIR__ . "/config/funcoes.php";   // inclui apenas uma vez
    require __DIR__ . "/view/rodape.html";

    $pagina = $_GET['pagina'] ?? '';
    $id = $_GET['id'] ?? '';

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
        case "editarContato":
            header("Location: /view/editarContato.php?id={$id}");
            exit();
        case "editarCliente":
            header("Location: /view/editarCliente.php?id={$id}");
            exit();
        case "editarProduto":
            header("Location: /view/editarProduto.php?id={$id}");
            exit();
        case "excluirContato":
            header("Location: /config/excluirContato.php?id={$id}");
            exit();
        case "excluirCliente":
            header("Location: /config/excluirCliente.php?id={$id}");
            exit();
        case "excluirProduto":
            header("Location: /config/excluirProduto.php?id={$id}");
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
