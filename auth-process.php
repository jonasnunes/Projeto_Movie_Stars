<?php

    require_once("config/connection.php");
    require_once("config/globals.php");
    require_once("models/user.php");
    require_once("models/message.php");
    require_once("dao/userDAO.php");

    $message = new Message($BASE_URL);
    $userDao = new UserDAO($conn, $BASE_URL);
    
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

            // Verificar se as senhas são iguais
            if($password === $confirmPassword){

                // Verificar se o email já está cadastrado no sistema
                if($userDao->findByEmail($email) === false){

                    $user = new User();

                    // Criação de token e senha
                    $userToken = $user->generateToken();
                    $finalPassword = $user->generatePassword($password);

                    $user->name = $name;
                    $user->lastname = $lastname;
                    $user->email = $email;
                    $user->password = $finalPassword;
                    $user->token = $userToken;

                    $auth = true;

                    $userDao->create($user, $auth);

                } else{

                    // Enviar uma mensagem de erro dizendo que o usuário já está cadastrado
                    $message->setMessage("Usuário já cadastrado!", "error", "back");

                }

            } else{

                // Enviar uma mensagem de erro dizendo que as senhas não são iguais
                $message->setMessage("As senhas não são iguais", "error", "back");

            }

        } else{

            // Enviar uma mensagem de erro de dados que estão faltando
            $message->setMessage("Por favor preencha todos os campos!", "error", "back");

        }

    } else if($type === "login"){

        $email = filter_input(INPUT_POST, "email");
        $password = filter_input(INPUT_POST, "password");

        // Tenta autenticar usuário
        if($userDao->authenticateUser($email, $password)){

            $message->setMessage("Seja bem-vindo!", "success", "editprofile.php");

        } else{

            $message->setMessage("Usuário e/ou senha incorretos!", "error", "back");

        }

    } else{

        // se protegendo contra possíveis dados maliciosos
        $message->setMessage("Informações inválidas!", "error", "index.php");

    }
