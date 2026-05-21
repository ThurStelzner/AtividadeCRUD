<?php
// funcoes.php — funções reutilizáveis
include_once "config.php";
/**
 * Retorna o array de contatos.
 * Em um projeto real, isso viria do banco de dados.
 */
function obterContatos($pdo) {
    $sql = "SELECT * FROM contatos";
    $stmt = $pdo->query($sql);
    $dados = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $dados;
}
function obterClientes($pdo) {
    $sql = "SELECT * FROM clientes";
    $stmt = $pdo->query($sql);
    $dados = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $dados;
}

function cadastrarContato($nome, $email, $telefone, $pdo){
    $sql = 'INSERT INTO contatos (nome, email, telefone) VALUES (?,?,?)';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$nome, $email, $telefone]);
    return true;
}
function cadastrarCliente($nome, $email, $telefone, $cpf, $pdo){
    $sql = 'INSERT INTO clientes (nome, email, telefone, cpf) VALUES (?,?,?,?)';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$nome, $email, $telefone, $cpf]);
    return true;
}

/**
 * Renderiza a tabela HTML com a lista de contatos.
 */
function exibirTabelaContatos(array $contatos): void {
    if (empty($contatos)) {
        echo "<p>Nenhum contato encontrado.</p>";
        return;
    }

    echo "<table>\n";
    echo "  <thead>\n";
    echo "    <tr><th>#</th><th>Nome</th><th>E-mail</th><th>Telefone</th><th>Ação</th></tr>\n";
    echo "  </thead>\n";
    echo "  <tbody>\n";

    foreach ($contatos as $contato) {
        $num   = htmlspecialchars($contato['id']);
        $nome  = htmlspecialchars($contato['nome']);
        $email = htmlspecialchars($contato['email']);
        $fone  = htmlspecialchars($contato['telefone']);

        echo "    <tr>\n";
        echo "      <td>{$num}</td>\n";
        echo "      <td>{$nome}</td>\n";
        echo "      <td>{$email}</td>\n";
        echo "      <td>{$fone}</td>\n";
        echo "      <td><a href='editarContato.php?id={$contato['id']}'>Editar</a><a href='excluirContato.php?id={$contato['id']}' onclick='return confirm(`Tem certeza que deseja excluir este contato?`)'>Excluir</a></td>\n";   
        echo "    </tr>\n";
    }

    echo "  </tbody>\n";
    echo "</table>\n";
}

function exibirTabelaClientes(array $clientes): void {
    if (empty($clientes)) {
        echo "<p>Nenhum cliente encontrado.</p>";
        return;
    }

    echo "<table>\n";
    echo "  <thead>\n";
    echo "    <tr><th>#</th><th>Nome</th><th>E-mail</th><th>Telefone</th><th>CPF</th><th>Ação</th></tr>\n";
    echo "  </thead>\n";
    echo "  <tbody>\n";

    foreach ($clientes as $cliente) {
        $num   = htmlspecialchars($cliente['id']);
        $nome  = htmlspecialchars($cliente['nome']);
        $email = htmlspecialchars($cliente['email']);
        $fone  = htmlspecialchars($cliente['telefone']);
        $cpf  = htmlspecialchars($cliente['cpf']);

        echo "    <tr>\n";
        echo "      <td>{$num}</td>\n";
        echo "      <td>{$nome}</td>\n";
        echo "      <td>{$email}</td>\n";
        echo "      <td>{$fone}</td>\n";
        echo "      <td>{$cpf}</td>";
        echo "      <td><a href='editarContato.php?id={$cliente['id']}'>Editar</a><a href='excluirContato.php?id={$cliente['id']}' onclick='return confirm(`Tem certeza que deseja excluir este cliente?`)'>Excluir</a></td>\n";
        echo "    </tr>\n";
    }

    echo "  </tbody>\n";
    echo "</table>\n";
}
