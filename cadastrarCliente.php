<?php
    include "cabecalho.php";
    require_once "config.php";
    include_once "funcoes.php";

    if($_SERVER['REQUEST_METHOD'] === "POST") {
        $nome = trim($_POST['nome']) ?? '';
        $email = trim($_POST['email']) ?? '';
        $telefone = trim($_POST['telefone']) ?? '';
        $cpf = trim($_POST['cpf']) ?? '';

        cadastrarCliente($nome, $email, $telefone, $cpf, $pdo);

        if(true) {
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
        <input type="text" name="cpf" placeholder="Nome do cliente aqui" required>
        <button type="submit">Cadastrar</button>
    </form>

</body>
</html>