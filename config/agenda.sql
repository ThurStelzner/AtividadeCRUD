CREATE DATABASE IF NOT EXISTS agenda
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;
 
USE agenda;

create table contatos (
	id int auto_increment primary key,
    nome varchar(100),
    email varchar(100),
    telefone varchar(14),
    criado_em timestamp	default current_timestamp
);

create table clientes (
	id int auto_increment primary key,
    nome varchar(100),
    email varchar(100),
    telefone varchar(14),
    cpf varchar(14) unique,
    endereco varchar(100),
    criado_em timestamp	default current_timestamp
);

create table produtos (
	id int auto_increment primary key,
    imagem varchar(255) null,
    nome varchar(100),
    descricao varchar(200),
    preco decimal(10,2),
    estoque int,
    criado_em timestamp default current_timestamp	
);

-- Inserindo dados na tabela 'contatos'
INSERT INTO contatos (nome, email, telefone) VALUES
('Ana Silva', 'ana.silva@email.com', '(11)98765-4321'),
('Bruno Costa', 'bruno.costa@email.com', '(21)97654-3210'),
('Carlos Souza', 'carlos.souza@email.com', '(31)96543-2109');

-- Inserindo dados na tabela 'clientes'
INSERT INTO clientes (nome, email, telefone, cpf) VALUES
('Mariana Oliveira', 'mariana.o@email.com', '(11)99999-1111', '123.456.789-00'),
('Pedro Santos', 'pedro.santos@email.com', '(21)98888-2222', '987.654.321-11'),
('Julia Lima', 'julia.lima@email.com', '(31)7777-3333', '456.789.123-22');
