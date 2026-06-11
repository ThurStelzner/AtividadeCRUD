<?php

    class Cliente {

        private $nome;
        private $email;
        private $telefone;
        private $cpf;
        private $endereco;
        private $id;

        public function __construct($nome, $email, $telefone, $cpf, $endereco, $id = null) {
            $this->nome = $nome;
            $this->email = $email;
            $this->telefone = $telefone;
            $this->cpf = $cpf;
            $this->endereco = $endereco;
            $this->id = $id;
        }

        public function setNomeCliente($nome) {
            $this->nome = $nome;
        }

        public function setEmailCliente($email) {
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                throw new Exception("Email inválido");
            }
            $this->email = $email;
        }

        public function setTelefoneCliente($telefone) {
            $this->telefone = $telefone;
        }

        public function setCpfCliente($cpf) {
            $this->telefone = $cpf;
        }

        public function setEnderecoCliente($endereco) {
            $this->telefone = $endereco;
        }

        public function setIdCliente($id) {
            $this->id = $id;
        }

        public function getNomeCliente() {
            return $this->nome;
        }

        public function getEmailCliente() {
            return $this->email;
        }

        public function getTelefoneCliente() {
            return $this->telefone;
        }

        public function getCpfCliente() {
            return $this->cpf;
        }

        public function getEnderecoCliente() {
            return $this->endereco;
        }

        public function getIdCliente() {
            return $this->id;
        }
    }