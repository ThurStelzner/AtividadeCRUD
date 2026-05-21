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
    cpf varchar(14),
    criado_em timestamp	default current_timestamp
);

create table produtos (
	id int auto_increment primary key,
    nome varchar(100),
    descricao varchar(200),
    preco decimal(10,2),
    estoque int,
    criado_em timestamp default current_timestamp	
);