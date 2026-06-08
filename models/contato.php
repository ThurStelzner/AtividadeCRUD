<?php
    class Contato {
        private $nome;
        private $email;
        private $telefone;
        private $id;

        public function __construct($nome, $email, $telefone, $id = null) {
            $this->nome = $nome;
            $this->email = $email;
            $this->telefone = $telefone;
            $this->id = $id;
        }

        public function setNome($nome) {
            $this->nome = $nome;
        }

        public function setEmail($email) {
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                throw new Exception("Email inválido");
            }
           $this->email = $email;
        }

        public function setTelefone($telefone) {
            $this->telefone = $telefone;
        }

        public function setId($id) {
            $this->id = $id;
        }

        public function getNome() {
            return $this->nome;
        }

        public function getEmail() {
            return $this->email;
        }

        public function getTelefone() {
            return $this->telefone;
        }

        public function getId() {
            return $this->id;
        }
    }