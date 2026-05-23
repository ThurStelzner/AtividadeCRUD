<?php
define('DB_HOST', 'localhost:3307');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'agenda');
 
try {
	$dsn = 'mysql:host='.DB_HOST.';dbname='.DB_NAME.';charset=utf8mb4';
	$pdo = new PDO($dsn, DB_USER, DB_PASS, [
        //ATTR_ERRMODE serve para entrar no bando interno de erros do PDO
        //ERRMODE_EXCEPRION é um dado do banco que cria o PDOException para formatar erros de banco
    	PDO::ATTR_ERRMODE        	=> PDO::ERRMODE_EXCEPTION,
        //ATTR_DEFAULT_FETCH_MODE FETCH_ASSOC serve para pegar uma formatação para melhor leitura do usuário
    	PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        //ATTR_EMULATE_PREPARES serve para dizer se o banco deve formatar ou não
        //Como está => false, quer dizer que o banco deve formatar as entradas e o php nao fará nada.
    	PDO::ATTR_EMULATE_PREPARES   => false,
	]);
} catch (PDOException $e) {
	die('Erro de conexão: ' . $e->getMessage());
}
