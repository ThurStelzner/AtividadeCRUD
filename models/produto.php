<?php
    class Produto {
        private $imagem;
        private $nome;
        private $descricao;
        private $preco;
        private $estoque;
        private $id;

        public function __construct($imagem, $nome, $descricao, $preco, $estoque, $id = null){
            $this->imagem = $imagem;
            $this->nome = $nome;
            $this->descricao = $descricao;
            $this->preco = $preco;
            $this->estoque = $estoque;
            $this->id = $id;
        }

        public function setImagem($imagem) {
            $this->imagem = $imagem;
        }
        
        public function setNome($nome) {
            $this->nome = $nome;
        }

        public function setDescricao($descricao) {
            $this->descricao = $descricao;
        }

        public function setPreco($preco) {
            $this->preco = $preco;
        }

        public function setEstoque($estoque) {
            $this->estoque = $estoque;
        }

        public function setId($id) {
            $this->id = $id;
        }

        public function getImagem() {
            return $this->imagem;
        }

        public function getNome() {
            return $this->nome;
        }

        public function getDescricao() {
            return $this->descricao;
        }

        public function getPreco() {
            return $this->preco;
        }

        public function getEstoque() {
            return $this->estoque;
        }

        public function getId() {
            return $this->id;
        }

    }