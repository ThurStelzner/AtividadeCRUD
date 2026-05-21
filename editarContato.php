<?php
    require_once "config.php";
    include "cabecalho.php";

    $id = $_GET['id'];
    $sql = 'SELECT * FROM contatos WHERE id = ?';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
    $contato = $stmt->fetch(PDO::FETCH_ASSOC);

    if($_SERVER['REQUEST_METHOD'] === "POST") {
        $nome = trim($_POST['nome']) ?? '';
        $email = trim($_POST['email']) ?? '';
        $telefone = trim($_POST['telefone']) ?? '';

        $sql = 'UPDATE contatos SET nome = ?, email = ?, telefone = ?, id = ?';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$nome, $email, $telefone, $id]);

        header("Location: ./");
        exit();
    }

?>


    <form method="POST">
        <label for="nome">Nome:</label>
        <input type="text" name="nome" value="<?= $contato['nome'] ?>" required>
        <label for="email">Email:</label>
        <input type="text" name="email" value="<?= $contato['email'] ?>" required>
        <label for="telefone">Telefone:</label>
        <input type="text" name="telefone" value="<?= $contato['telefone'] ?>" required>
        <button type="submit">Confirmar</button>
    </form>

</body>
</html>