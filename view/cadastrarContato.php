<?php
    require_once "../config/config.php";
    include "../view/cabecalho.php";
    include_once "../config/funcoes.php";
    require "../view/rodape.html";
    include_once "../models/contatoDAO.php";    
    include_once "../models/contato.php";

    if($_SERVER['REQUEST_METHOD'] === "POST") {
        $dao = new ContatoDAO;
        $nome = trim($_POST['nome']) ?? '';
        $email = trim($_POST['email']) ?? '';
        $telefone = trim($_POST['telefone']) ?? '';
        $fTEL = formatarTelefone($telefone);

        if($fTEL === false) {
            echo "Erro! Telefone inválido.";
        } else {
            $dao->createContato(new Contato($nome, $email, $fTEL));
            header("Location: ../");
            exit();
        }
        
    }
?>


<form method="POST">
    <label for="nome">Nome:</label>
    <input type="text" name="nome" id="nome" placeholder="Seu nome aqui" required>
    <label for="email">Email:</label>
    <input type="email" name="email" id="email" placeholder="Seu email aqui" required>
    <label for="Telefone">Telefone:</label>
    <input type="text" name="telefone" id="telefone" maxlength="14" placeholder="Seu telefone aqui" required>
    <button type="submit">Cadastrar</button>
</form>