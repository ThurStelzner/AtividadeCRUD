<?php
// funcoes.php — funções reutilizáveis
include_once __DIR__ . "/../config/config.php";
include_once __DIR__ . "/../models/contatoDAO.php";
include_once __DIR__ . "/../models/contato.php";
include_once __DIR__ . "/../models/cliente.php";
include_once __DIR__ . "/../models/clienteDAO.php";
include_once __DIR__ . "/../models/produto.php";
include_once __DIR__ . "/../models/produtoDAO.php";
/**
 * Retorna o array de contatos.
 * Em um projeto real, isso viria do banco de dados.
 */
function obterProdutos($pdo) {
    $sql = "SELECT * FROM produtos";
    $stmt = $pdo->query($sql);
    $dados = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $dados;
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
function exibirTabelaContatos() {
    $dao = new ContatoDAO;
    $listaContatos = $dao->readAllContatos();
    if (empty($listaContatos)) {
        echo "<span>Nenhum contato encontrado.</span>";
        return;
    }

    echo "<table>\n";
    echo "  <thead>\n";
    echo "    <tr><th>#</th><th>Nome</th><th>E-mail</th><th>Telefone</th><th>Ação</th></tr>\n";
    echo "  </thead>\n";
    echo "  <tbody>\n";

    foreach ($listaContatos as $contato) {
        $id   = htmlspecialchars($contato->getId());
        $nome  = htmlspecialchars($contato->getNome());
        $email = htmlspecialchars($contato->getEmail());
        $fone  = htmlspecialchars($contato->getTelefone());

        echo "    <tr>\n";
        echo "      <td>{$id}</td>\n";
        echo "      <td>{$nome}</td>\n";
        echo "      <td>{$email}</td>\n";
        echo "      <td>{$fone}</td>\n";
        echo "      <td><a href='../?pagina=editarContato&id={$contato->getId()}' class='btnEditar'>Editar</a><a href='../?pagina=excluirContato&id={$contato->getId()}' onclick='return confirm(`Tem certeza que deseja excluir este contato?`)' class='btnExcluir'>Excluir</a></td>\n";   
        echo "    </tr>\n";
    }

    echo "  </tbody>\n";
    echo "</table>\n";
}

function exibirTabelaClientes() {
    $dao = new ClienteDAO;
    $listaClientes = $dao->readAllClientes();
    if (empty($listaClientes)) {
        echo "<span>Nenhum cliente encontrado.</span>";
        return;
    }

    echo "<table>\n";
    echo "  <thead>\n";
    echo "    <tr><th>#</th><th>Nome</th><th>E-mail</th><th>Telefone</th><th>CPF</th><th>Endereço</th><th>Ação</th></tr>\n";
    echo "  </thead>\n";
    echo "  <tbody>\n";

    foreach ($listaClientes as $cliente) {
        $num   = htmlspecialchars($cliente->getIdCliente());
        $nome  = htmlspecialchars($cliente->getNomeCliente());
        $email = htmlspecialchars($cliente->getEmailCliente());
        $fone  = htmlspecialchars($cliente->getTelefoneCliente());
        $cpf  = htmlspecialchars($cliente->getCpfCliente());
        $endereco = htmlspecialchars($cliente->getEnderecoCliente());

        echo "    <tr>\n";
        echo "      <td>{$num}</td>\n";
        echo "      <td>{$nome}</td>\n";
        echo "      <td>{$email}</td>\n";
        echo "      <td>{$fone}</td>\n";
        echo "      <td>{$cpf}</td>";
        echo "      <td>{$endereco}</td>";
        echo "      <td><a href='../?pagina=editarCliente&id={$cliente->getIdCliente()}' class='btnEditar'>Editar</a><a href='../?pagina=excluirCliente&id={$cliente->getIdCliente()}' onclick='return confirm(`Tem certeza que deseja excluir este cliente?`)' class='btnExcluir'>Excluir</a></td>\n";
        echo "    </tr>\n";
    }

    echo "  </tbody>\n";
    echo "</table>\n";
}

function exibirTabelaProdutos() {
    $dao = new ProdutoDAO;
    $listaProdutos = $dao->readAllProdutos();
    if (empty($listaProdutos)) {
        echo "<span>Nenhum produto encontrado.</span>";
        return;
    }

    echo "<table>\n";
    echo "  <thead>\n";
    echo "    <tr><th>#</th><th>Imagem</th><th>Nome</th><th>Descrição</th><th>Preço</th><th>Estoque</th><th>Ação</th></tr>\n";
    echo "  </thead>\n";
    echo "  <tbody>\n";

    foreach ($listaProdutos as $produto) {
        $num   = htmlspecialchars($produto->getId());
        $image = htmlspecialchars($produto->getImagem());
        $nome  = htmlspecialchars($produto->getNome());
        $descricao = htmlspecialchars($produto->getDescricao());
        $preco  = htmlspecialchars($produto->getPreco());
        $estoque  = htmlspecialchars($produto->getEstoque());

        echo "    <tr>\n";
        echo "      <td>{$num}</td>\n";
        echo "      <td><img src='../uploads/{$image}' alt='Foto produto {$nome}'></td>";
        echo "      <td>{$nome}</td>\n";
        echo "      <td>{$descricao}</td>\n";
        echo "      <td>R$:$preco</td>\n";
        echo "      <td>{$estoque}</td>";
        echo "      <td><a href='../?pagina=editarProduto&id={$produto->getId()}' class='btnEditar'>Editar</a><a href='../?pagina=excluirProduto&id={$produto->getId()}' onclick='return confirm(`Tem certeza que deseja excluir este produto?`)' class='btnExcluir'>Excluir</a></td>\n";
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
    if(is_numeric($preco)){
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
    $pasta = __DIR__ . '/../uploads/';
    if(!file_exists($pasta)){
        mkdir($pasta, 0755, true);
    };

    $local = $pasta . "placeholder.jpeg";
    $imagem = @file_get_contents("https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_1280.png");
    @file_put_contents($local, $imagem);
}