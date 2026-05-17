<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

include "utils.php";

$con = conectar_db();

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    if (isset($_GET['id'])) {

        $sql = $con->prepare("SELECT * FROM entradas WHERE id=:id");

        $sql->bindValue(':id', $_GET['id']);

        $sql->execute();

        header("HTTP/1.1 200 OK");

        echo json_encode($sql->fetch(PDO::FETCH_ASSOC));

        exit();

    } else {

        $sql = $con->prepare("SELECT * FROM entradas");

        $sql->execute();

        $sql->setFetchMode(PDO::FETCH_ASSOC);

        header("HTTP/1.1 200 OK");

        echo json_encode($sql->fetchAll());

        exit();
    }
}

header("HTTP/1.1 400 Bad Request");

?>
