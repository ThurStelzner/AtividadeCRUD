<?php

    require_once __DIR__ . "/../models/produto.php";
    require_once __DIR__ . "/../models/produtoDAO.php";
    require_once __DIR__ . "/../config/config.php";

    class ProdutoDAO {

        private $pdo;

        public function __construct() {
            $this->pdo = Conexao::getConexao();
        }

        public function readAllProdutos() {
            $sql = "SELECT * FROM produtos ORDER BY nome";
            $stmt = $this->pdo->query($sql);
            $produtos = [];

            while($dados = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $p = new Produto(
                    $dados['imagem'],
                    $dados['nome'],
                    $dados['descricao'],
                    $dados['preco'],
                    $dados['estoque'],
                    $dados['id']
                );
                $p->setId($dados['id']);
                $produtos[] = $p;
            }
            return $produtos;
        }

        public function createProduto(Produto $p) {
            $sql = "INSERT INTO produtos (imagem, nome, descricao, preco, estoque) VALUES (?,?,?,?,?)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                $p->getImagem(),
                $p->getNome(),
                $p->getDescricao(),
                $p->getPreco(),
                $p->getEstoque(),
            ]);
            $p->setId($this->pdo->lastInsertId());
            return $p;
        }

        public function deleteProduto($id) {
            $pdo = Conexao::getConexao();

            $arquivo = __DIR__ . "/../uploads/";

            $sql = "SELECT * FROM produtos WHERE id = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$id]);
            $produto = $stmt->fetch(PDO::FETCH_ASSOC);

            if(file_exists($arquivo . $produto['imagem'])) {
                if($produto['imagem'] === 'placeholder.jpeg'){
                    $sql = "DELETE FROM produtos WHERE id=?";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute([$id]);
                } else {
                    unlink($arquivo . $produto['imagem']);
                    $sql = "DELETE FROM produtos WHERE id=?";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute([$id]);
                }
            };
        }   

        public function updateProduto($nome, $descricao, $preco, $estoque,$id) {
            $pdo = Conexao::getConexao();
            if (!empty($_FILES['imagem']['name'])) {
                $extensao  = pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION);
                $permitidos = ['jpg', 'jpeg', 'png', 'webp'];
            
                if (!in_array(strtolower($extensao), $permitidos)) {
                    echo 'Tipo de imagem não permitido.';
                } else {
                    $nomeArquivo = uniqid('prod_') . '.' . $extensao;
                    move_uploaded_file($_FILES['imagem']['tmp_name'], '../uploads/' . $nomeArquivo);
                    
                    $sql = "UPDATE produtos SET imagem = ?, nome = ?, descricao = ?, preco = ?, estoque = ? WHERE id = ?";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute([$nomeArquivo, $nome, $descricao, $preco, $estoque, $id]);

                    header("Location: produtos.php");
                    exit();
                }
            } else {
                $sql = "UPDATE produtos SET nome = ?, descricao = ?, preco = ?, estoque = ? WHERE id = ?";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([$nome, $descricao, $preco, $estoque, $id]);
                header("Location: produtos.php");
                exit();
            }
        }
    }