<?php

    $host = "localhost";
    $dbname = "movie_star";
    $username = "root";
    $password = "root";

    try{

        $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

        // Ativar o modo de erros
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

    } catch(PDOException $e){
        // erro na conexão
        $error = $e->getMessage();
        echo "Erro: $error";
    }