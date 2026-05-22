<?php
    require_once "config.php";
    require_once "funcoes.php";
    require "cabecalho.php";

    $id = $_GET['id'];

    $sql = "SELECT * FROM clientes WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);

    $cliente = $stmt->fetch(PDO::FETCH_ASSOC);

    if($_SERVER['REQUEST_METHOD'] === "POST") {
        $nome = trim($_POST['nome']) ?? '';
        $email = trim($_POST['email']) ?? '';
        $telefone = trim($_POST['telefone']) ?? '';
        $cpf = trim($_POST['cpf']) ?? '';
        $endereco = trim($_POST['endereco']) ?? '';
        $fCPF = formatarCpf($cpf);
        $fTEL = formatarTelefone($telefone);

        if($fTEL === false && $fCPF === false) {
            echo "Erro! Telefone e CPF inválidos.";
        } elseif($fTEL === false) {
            echo "Erro! Telefone inválido.";
        } elseif ($fCPF === false) {
            echo "Erro! CPF inválido.";
        } else {
            $sql = 'UPDATE clientes SET nome = ?, email = ?, telefone = ?, cpf = ?, endereco = ? WHERE id = ?';
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$nome, $email, $telefone, $cpf, $endereco, $id]);

            header("Location: clientes.php");
            exit();
        }

    }
?>
    
    <form method="POST">
        <label for="nome">Nome:</label>
        <input type="text" name="nome" value="<?= $cliente['nome']?>" required>
        <label for="email">Email:</label>
        <input type="email" name="email" value="<?= $cliente['email']?>" required>
        <label for="telefone">Telefone:</label>
        <input type="text" name="telefone" value="<?= $cliente['telefone']?>" required>
        <label for="cpf">CPF:</label>
        <input type="text" name="cpf" value="<?= $cliente['cpf']?>" required>
        <label for="endereco">Endereço:</label>
        <input type="text" name="endereco" value="<?= $cliente['endereco']?>" required>
        <button type="submit">Confirmar</button>
    </form>

</body>
</html>