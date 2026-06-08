<?php
    require_once __DIR__ . "/../models/contato.php";
    require_once __DIR__ . "/../models/contatoDAO.php";
    $id = $_GET['id'];
    $dao = new ContatoDAO;
    $dao->deleteContato($id);
    header("Location: ../");
    exit();

?>