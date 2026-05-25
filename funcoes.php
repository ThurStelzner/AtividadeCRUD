<?php
// funcoes.php — funções reutilizáveis

use BcMath\Number;

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
function obterProdutos($pdo) {
    $sql = "SELECT * FROM produtos";
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
function cadastrarCliente($nome, $email, $telefone, $cpf, $endereco, $pdo){
    $sql = 'INSERT INTO clientes (nome, email, telefone, cpf, endereco) VALUES (?,?,?,?,?)';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$nome, $email, $telefone, $cpf, $endereco]);
    return true;
}
function cadastrarProduto($nomeArquivo, $nome, $descricao, $preco, $estoque, $pdo){
    $sql = 'INSERT INTO produtos (imagem, nome, descricao, preco, estoque) VALUES (?,?,?,?,?)';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$nomeArquivo, $nome, $descricao, $preco, $estoque]);
    return true;
}
/**
 * Renderiza a tabela HTML com a lista de contatos.
 */
function exibirTabelaContatos(array $contatos): void {
    if (empty($contatos)) {
        echo "<span>Nenhum contato encontrado.</span>";
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
        echo "      <td><a href='editarContato.php?id={$contato['id']}' class='btnEditar'>Editar</a><a href='excluirContato.php?id={$contato['id']}' onclick='return confirm(`Tem certeza que deseja excluir este contato?`)' class='btnExcluir'>Excluir</a></td>\n";   
        echo "    </tr>\n";
    }

    echo "  </tbody>\n";
    echo "</table>\n";
}

function exibirTabelaClientes(array $clientes): void {
    if (empty($clientes)) {
        echo "<span>Nenhum cliente encontrado.</span>";
        return;
    }

    echo "<table>\n";
    echo "  <thead>\n";
    echo "    <tr><th>#</th><th>Nome</th><th>E-mail</th><th>Telefone</th><th>CPF</th><th>Endereco</th><th>Ação</th></tr>\n";
    echo "  </thead>\n";
    echo "  <tbody>\n";

    foreach ($clientes as $cliente) {
        $num   = htmlspecialchars($cliente['id']);
        $nome  = htmlspecialchars($cliente['nome']);
        $email = htmlspecialchars($cliente['email']);
        $fone  = htmlspecialchars($cliente['telefone']);
        $cpf  = htmlspecialchars($cliente['cpf']);
        $endereco = htmlspecialchars($cliente['endereco']);

        echo "    <tr>\n";
        echo "      <td>{$num}</td>\n";
        echo "      <td>{$nome}</td>\n";
        echo "      <td>{$email}</td>\n";
        echo "      <td>{$fone}</td>\n";
        echo "      <td>{$cpf}</td>";
        echo "      <td>{$endereco}</td>";
        echo "      <td><a href='editarCliente.php?id={$cliente['id']}' class='btnEditar'>Editar</a><a href='excluirCliente.php?id={$cliente['id']}' onclick='return confirm(`Tem certeza que deseja excluir este cliente?`)' class='btnExcluir'>Excluir</a></td>\n";
        echo "    </tr>\n";
    }

    echo "  </tbody>\n";
    echo "</table>\n";
}

function exibirTabelaProdutos(array $produtos): void {
    if (empty($produtos)) {
        echo "<span>Nenhum produto encontrado.</span>";
        return;
    }

    echo "<table>\n";
    echo "  <thead>\n";
    echo "    <tr><th>#</th><th>Imagem</th><th>Nome</th><th>Descrição</th><th>Preço</th><th>Estoque</th><th>Ação</th></tr>\n";
    echo "  </thead>\n";
    echo "  <tbody>\n";

    foreach ($produtos as $produto) {
        $num   = htmlspecialchars($produto['id']);
        $image = htmlspecialchars($produto['imagem']);
        $nome  = htmlspecialchars($produto['nome']);
        $descricao = htmlspecialchars($produto['descricao']);
        $preco  = htmlspecialchars($produto['preco']);
        $estoque  = htmlspecialchars($produto['estoque']);

        echo "    <tr>\n";
        echo "      <td>{$num}</td>\n";
        echo "      <td><img src='./uploads/{$image}' alt='Foto produto {$nome}'></td>";
        echo "      <td>{$nome}</td>\n";
        echo "      <td>{$descricao}</td>\n";
        echo "      <td>R$:$preco</td>\n";
        echo "      <td>{$estoque}</td>";
        echo "      <td><a href='editarProduto.php?id={$produto['id']}' class='btnEditar'>Editar</a><a href='excluirProduto.php?id={$produto['id']}' onclick='return confirm(`Tem certeza que deseja excluir este produto?`)' class='btnExcluir'>Excluir</a></td>\n";
        echo "    </tr>\n";
    }

    echo "  </tbody>\n";
    echo "</table>\n";
}

function formatarCpf($cpf) {
  $CPF_LENGTH = 11;
  $fCpf = preg_replace("/\D/", '', $cpf);
  
    if (strlen($fCpf) === $CPF_LENGTH) {
        return preg_replace("/(\d{3})(\d{3})(\d{3})(\d{2})/", "\$1.\$2.\$3-\$4", $fCpf);
    } else {
        return false;
    }
}

function formatarTelefone($telefone) {
    $TEL_LENGHT = 11;
    $TEL_FIX_LENGHT = 10;
    $fTel = preg_replace("/\D/", '', $telefone);

    if (strlen($fTel) === $TEL_FIX_LENGHT) {
        return preg_replace("/(\d{2})(\d{4})(\d{4})/", "(\$1)\$2-\$3", $fTel);
    } elseif (strlen($fTel) === $TEL_LENGHT) {
        return preg_replace("/(\d{2})(\d{5})(\d{4})/", "(\$1)\$2-\$3", $fTel);
    } else {
        return false;
    }
}

function formatarPreco($preco) {
    if(is_int($preco)){
        if($preco > 0) {
            $resultado = number_format($preco, 2, '.', '');
            return $resultado;
        } else {
            return false;
        }
    } else {
        return false;
    }
}

function criarDiretorio() {
    $pasta = __DIR__ . '/uploads/';
    if(!file_exists($pasta)){
        mkdir($pasta, 0755, true);
    };

    $local = $pasta . "placeholder.jpeg";
    $imagem = @file_get_contents("https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_1280.png");
    @file_put_contents($local, $imagem);
}