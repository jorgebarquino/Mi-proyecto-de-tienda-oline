<?php
function conectar_db(){
    define("USER_DB","root"); 
    define("PASSWORD","");
    try {
        $dsn = "mysql:host=localhost;dbname=tienda_online";
        $con = new PDO($dsn, USER_DB, PASSWORD);
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $con;
    } catch (PDOException $e){
        echo 'Error: '.$e->getMessage();
    }
}

function getParams($input) {
    $filterParams = [];
    foreach($input as $param => $value) {
        $filterParams[] = "$param=:$param";
    }
    return implode(", ", $filterParams);
}

function bindAllValues($statement, $params) {
    foreach($params as $param => $value) {
        $statement->bindValue(':'.$param, $value);
    }
    return $statement;
}
?>
