<?php

    $dsn = "mysql:host=localhost;dbname=application;charset=utf8";
    $host = "root";
    $pass = "";

    $options = array(
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8',
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    )

    try {
        //code...
        $db = new PDO($dsn, $host, $pass, $options);
    } catch (PDOExeption $e) {
        //throw $th;
        echo "Connection Field " . $e.getMessage();
    }

    

?>