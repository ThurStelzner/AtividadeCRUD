<?php 
    require_once __DIR__ . "/contato.php";
    require_once __DIR__ . "/../config/config.php";

    class ContatoDAO {
        private $pdo;

        public function __construct() {
            $this->pdo = Conexao::getConexao();
        }

        public function createContato(Contato $contato) {
            $sql = "INSERT INTO contatos (nome, email, telefone) VALUES (?,?,?)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                $contato->getNome(),
                $contato->getEmail(),
                $contato->getTelefone()
            ]);
            $contato->setId($this->pdo->lastInsertId());
            return $contato;
        }

        public function deleteContato($id) {
            $sql = "DELETE FROM contatos WHERE id = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$id]);
        }   

        public function updateContato($nome, $email, $telefone, $id) {
            $sql = "UPDATE contatos SET nome = ?, email = ?, telefone = ? WHERE id = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$nome, $email, $telefone, $id]);
        }

        public function readAllContatos() {
            $sql = "SELECT * FROM contatos ORDER BY nome";
            $stmt = $this->pdo->query($sql);
            $contatos = [];

            while($dados = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $c = new Contato(
                    $dados['nome'],
                    $dados['email'],
                    $dados['telefone'],
                    $dados['id']
                );
                $c->setId($dados['id']);
                $contatos[] = $c;
            }
            return $contatos;
        }
    }

