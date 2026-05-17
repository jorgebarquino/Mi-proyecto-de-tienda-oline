<?php

function conectar_db(){

    $host = "sql300.infinityfree.com";
    $dbname = "if0_41917398_tienda";
    $user = "if0_41917398";
    $password = "VUxueXhauceah9";

    try {

        $dsn = "mysql:host=$host;dbname=$dbname";

        $con = new PDO($dsn, $user, $password);

        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $con;

    } catch (PDOException $e){

        die("Error de conexión: " . $e->getMessage());

    }
}

?>
