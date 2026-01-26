<?php
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

if ($_SERVER['REQUEST_METHOD'] == 'POST' && $con) {
    $input = $_POST;
    $sql = "INSERT INTO entradas (titulo, contenido, estado, user_id) VALUES (:titulo, :contenido, :estado, :user_id)";
    $statement = $con->prepare($sql);
    bindAllValues($statement, $input);
    $statement->execute();
    $postId = $con->lastInsertId();
    if($postId) {
        $input['id'] = $postId;
        header("HTTP/1.1 200 OK");
        echo json_encode($input);
        exit();
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    $id = $_GET['id'];
    $statement = $con->prepare("DELETE FROM entradas WHERE id=:id");
    $statement->bindValue(':id', $id);
    $statement->execute();
    header("HTTP/1.1 200 OK");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
    $input = $_GET;
    $postId = $input['id'];
    $fields = getParams($input);
    $sql = "UPDATE entradas SET $fields WHERE id='$postId'";
    $statement = $con->prepare($sql);
    bindAllValues($statement, $input);
    $statement->execute();
    header("HTTP/1.1 200 OK");
    exit();
}

header("HTTP/1.1 400 Bad Request");
?>
