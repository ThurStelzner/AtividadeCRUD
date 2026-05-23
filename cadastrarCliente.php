<?php
    include "cabecalho.php";
    require_once "config.php";
    include_once "funcoes.php";
    require "rodape.html";

    if($_SERVER['REQUEST_METHOD'] === "POST") {
        $nome = trim($_POST['nome']) ?? '';
        $email = trim($_POST['email']) ?? '';
        $telefone = trim($_POST['telefone']) ?? '';
        $cpf = trim($_POST['cpf']) ?? '';
        $endereco = trim($_POST['endereco']);
        $fCPF = formatarCpf($cpf);
        $fTEL = formatarTelefone($telefone);

        if($fTEL === false && $fCPF === false) {
            echo "Erro! Telefone e CPF inválidos.";
        } elseif($fTEL === false) {
            echo "Erro! Telefone inválido.";
        } elseif ($fCPF === false) {
            echo "Erro! CPF inválido.";
        } else {
            cadastrarCliente($nome, $email, $fTEL, $fCPF, $endereco, $pdo);
            header("Location: clientes.php");
            exit();
        }

    }
?>
    <form method="POST">
        <label for="nome">Nome:</label>
        <input type="text" name="nome" placeholder="Nome do cliente aqui" required>
        <label for="email">Email:</label>
        <input type="email" name="email" placeholder="Email do cliente aqui" required>
        <label for="telefone">Telefone:</label>
        <input type="text" name="telefone" placeholder="Telefone do cliente aqui" required>
        <label for="cpf">CPF:</label>
        <input type="text" name="cpf" placeholder="CPF do cliente aqui" required>
        <label for="endereco">Endereço:</label>
        <input type="text" name="endereco" placeholder="Endereço do cliente aqui" required>
        <button type="submit">Cadastrar</button>
    </form>