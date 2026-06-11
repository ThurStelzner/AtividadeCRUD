<?php
    require_once __DIR__ . "/../config/config.php";    // erro fatal se não encontrar
    include __DIR__ . "/cabecalho.php"; // warning se não encontrar
    include_once __DIR__ . "/../config/funcoes.php";   // inclui apenas uma vez
    require __DIR__ . "/rodape.html";
    require_once __DIR__ . "/../models/contatoDAO.php";
    $pdo = Conexao::getConexao();

    $id = $_GET['id'];
    $sql = 'SELECT * FROM contatos WHERE id = ?';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
    $contato = $stmt->fetch(PDO::FETCH_ASSOC);

    if($_SERVER['REQUEST_METHOD'] === "POST") {
        $nome = trim($_POST['nome']) ?? '';
        $email = trim($_POST['email']) ?? '';
        $telefone = trim($_POST['telefone']) ?? '';
        $fTel = formatarTelefone($telefone);
        if ($fTel === false) {
            echo "Erro! Telefone inválido.";
        } else {
            $dao = new ContatoDAO();
            $dao->updateContato($nome, $email, $fTel, $id);
            header("Location: ../");
            exit();
        }
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
