<?php

    require_once __DIR__ . "/../config/config.php";
    require_once __DIR__ . "/../models/cliente.php";

    class ClienteDAO {
        private $pdo;

        public function __construct(){
            $this->pdo = Conexao::getConexao();
        }

        public function readAllClientes() {
            $sql = "SELECT * FROM clientes ORDER BY nome";
            $stmt = $this->pdo->query($sql);
            
            $clientes = [];

            while($dados = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $c = new Cliente(
                    $dados['nome'],
                    $dados['email'],
                    $dados['telefone'],
                    $dados['cpf'],
                    $dados['endereco'],
                    $dados['id']
                );
                $c->setIdCliente($dados['id']);
                $clientes[] = $c;
            }
            return $clientes;
        }

        public function createCliente(Cliente $cliente) {
            try {
                $sql = "INSERT INTO clientes (nome, email, telefone, cpf, endereco) VALUES (?,?,?,?,?)";
                $stmt = $this->pdo->prepare($sql);
                $stmt->execute([
                    $cliente->getNomeCliente(),
                    $cliente->getEmailCliente(),
                    $cliente->getTelefoneCliente(),
                    $cliente->getCpfCliente(),
                    $cliente->getEnderecoCliente()
                ]);

                $cliente->setIdCliente($this->pdo->lastInsertId());
                return $cliente;
            } catch (PDOException $e) {
                if($e->errorInfo[1] == 1062) {
                    return "CPF duplicado";
                }
            }
        }

        public function updateCliente($nome, $email, $telefone, $cpf, $endereco, $id) {
            $sql = "UPDATE clientes SET nome=?, email=?, telefone=?, cpf=?, endereco=? WHERE id=?";
            $stmt = $this->pdo->prepare($sql);  
            $stmt->execute([$nome, $email, $telefone, $cpf, $endereco, $id]);
        }

        public function deleteCliente($id) {
            $sql = "DELETE FROM clientes WHERE id = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$id]);
        }   
    }