<?php

    $database = "movie_star";
    $hostname = "localhost";
    $username = "root";
    $password = "";

    try {
        $conn = new PDO("mysql:dbname=" . $database . ";host=" . $hostname, $username, $password);
    
        //Habilitar erros
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    } catch (PDOException $e) {
        echo "MySQL Connection Exception: " . $e->getMessage();
    }


?>