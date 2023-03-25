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

    // Atualizar usuário
    if($type === "update"){

        // Resgata dados do usuário
        $userData = $userDao->verifyToken();

        // Receber dados do post
        $name = filter_input(INPUT_POST, "name");
        $lastname = filter_input(INPUT_POST, "lastname");
        $email = filter_input(INPUT_POST, "email");
        $bio = filter_input(INPUT_POST, "bio");

        // Criar um novo objeto de usuário
        $user = new User();

        // Preencher os dados do usuário
        $userData->name = $name;
        $userData->lastname = $lastname;
        $userData->email = $email;
        $userData->bio = $bio;

        // Upload da imagem
        if(isset($_FILES["image"]) && !empty($_FILES["image"]["tmp_name"])){

            $image = $_FILES["image"];
            $imageTypes = ["image/jpeg", "image/jpg", "image/png"];
            $jpgArray = ["image/jpg", "image/jpeg"];

            // Checar se o arquivo é uma imagem
            if(in_array($image["type"], $imageTypes)){

                // Checar se a imagem é jpg
                if(in_array($image, $jpgArray)){

                    $imageFile = imagecreatefromjpeg($image["tmp_name"]);

                } else{

                    $imageFile = imagecreatefrompng($image["tmp_name"]);

                }

                $imageName = $user->imageGenerateName();

                imagejpeg($imageFile, "./img/users/" . $imageName, 100);

                $userData->image = $imageName;

            } else{

                $message->setMessage("Tipo inválido de imagem, insira PNG ou JPEG", "error", "back");

            }

        }

        $userDao->update($userData);

      // Atualizar senha do usuário
    } else if($type === "changepassword"){

        // Receber dados do post
        $password = filter_input(INPUT_POST, "password");
        $confirmpassword = filter_input(INPUT_POST, "confirmpassword");

        // Resgata dados do usuário
        $userData = $userDao->verifyToken();

        $id = $userData->id;

        if($password == $confirmpassword){

            // Criar um novo objeto de usuário
            $user = new User();

            $finalPassword = $user->generatePassword($password);

            $user->password = $finalPassword;
            $user->id = $id;

            $userDao->changePassword($user);

        } else{

            $message->setMessage("As senhas não correspondem!", "error", "back");

        }

    } else{

        $message->setMessage("Informações inválidas!", "error", "index.php");

    }