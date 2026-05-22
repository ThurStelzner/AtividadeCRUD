<?php
    require_once "config.php";
    include "cabecalho.php";
    include_once "funcoes.php";

    if($_SERVER['REQUEST_METHOD'] === "POST") {
        $nome = trim($_POST['nome']) ?? '';
        $email = trim($_POST['email']) ?? '';
        $telefone = trim($_POST['telefone']) ?? '';
        $fTEL = formatarTelefone($telefone);

        if($fTEL === false) {
            echo "Erro! Telefone inválido.";
        } else {
            cadastrarContato($nome, $email, $fTEL, $pdo);
            header("Location: ./");
            exit();
        }
        
    }
?>


<form method="POST">
    <label for="nome">Nome:</label>
    <input type="text" name="nome" id="nome" placeholder="Seu nome aqui" required>
    <label for="email">Email:</label>
    <input type="email" name="email" id="email" placeholder="Seu nome aqui" required>
    <label for="Telefone">Telefone:</label>
    <input type="text" name="telefone" id="telefone" maxlength="14" placeholder="Seu nome aqui" required>
    <button type="submit">Cadastrar</button>
</form>

</body>
</html>