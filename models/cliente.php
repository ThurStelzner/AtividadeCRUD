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
    }