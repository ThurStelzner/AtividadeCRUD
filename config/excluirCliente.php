<?php

    require_once __DIR__ . "/config.php";
    require_once __DIR__ . "/../models/clienteDAO.php";

    $id = $_GET['id'];
    $dao = new ClienteDAO;
    $dao->deleteCliente($id);

    header("Location: ../view/clientes.php");
    exit();

?>