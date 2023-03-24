<?php

    require_once("config/connection.php");
    require_once("config/globals.php");
    require_once("models/user.php");
    require_once("models/message.php");
    require_once("dao/userDAO.php");

    $message = new Message($BASE_URL);
    
    // Retorna o tipo de formulário
    $type = filter_input(INPUT_POST, "type");

    // Verificação do tipo de formulário
    if($type === "register"){

        $name = filter_input(INPUT_POST, "name");
        $lastname = filter_input(INPUT_POST, "lastname");
        $email = filter_input(INPUT_POST, "email");
        $password = filter_input(INPUT_POST, "password");
        $confirmPassword = filter_input(INPUT_POST, "confirm-password");

        // Verificação de dados mínimos
        if($name && $lastname && $email && $password){



        } else{

            // Enviar uma mensagem de erro de dados que estão faltando
            $message->setMessage("Por favor preencha todos os campos!", "error", "back");

        }

    } else if($type === "login"){



    }
