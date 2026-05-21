<?php
    require_once "config.php";
    require "cabecalho.php";

    $id = $_GET['id'];

    $sql = "SELECT * FROM clientes WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);

    $cliente = $stmt->fetch(PDO::FETCH_ASSOC);

    if($_SERVER['REQUEST_METHOD'] === "POST") {
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $telefone = $_POST['telefone'];
        $cpf = $_POST['cpf'];

        $sql = 'UPDATE clientes SET nome = ?, email = ?, telefone = ?, cpf = ? WHERE id = ?';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$nome, $email, $telefone, $cpf, $id]);

        header("Location: clientes.php");
        exit();

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
        <button type="submit">Confirmar</button>
    </form>

</body>
</html>