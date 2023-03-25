<?php

require_once("config/connection.php");
require_once("config/globals.php");
require_once("models/movie.php.php");
require_once("models/message.php");
require_once("dao/userDAO.php");
require_once("dao/movieDAO.php");

$message = new Message($BASE_URL);
$userDao = new UserDAO($conn, $BASE_URL);

// Retorna o tipo de formulário
$type = filter_input(INPUT_POST, "type");

// Resgata dados do usuário
$userData = $userDao->verifyToken();

if($type === "create"){

    // Receber os dados dos inputs
    $title = filter_input(INPUT_POST, "title");
    $description = filter_input(INPUT_POST, "description");
    $trailer = filter_input(INPUT_POST, "trailer");
    $category = filter_input(INPUT_POST, "category");
    $length = filter_input(INPUT_POST, "length");

    $movie = new Movie();

    // Validação mínima de dados
    if(!empty($title) && !empty($description) && !empty($category)){

        $movie->title = $title;
        $movie->description = $description;
        $movie->trailer = $trailer;
        $movie->category = $category;
        $length->length = $length;

        // Upload de imagem do filme
        if(isset($_FILES["image"]) && !empty($_FILES["imagem"]["tmp_name"])){

            $image = $_FILES["image"];

            $imageTypes = ["image/jpeg", "image/jpg", "image/png"];
            $jpgArray = ["image/jpeg", "image/jpg"];

            // Checando tipo da imagem
            if(in_array($image["type"], $imageTypes)){

                // Checa se imagem é jpg
                if(in_array($image["type"], $jpgArray)){

                    $imageFile = imagecreatefromjpeg($image["tmp_name"]);

                } else{

                    $imageFile = imagecreatefrompng($image["tmp_name"]);

                }

                // Gerando o nome da imagem
                $imageName = $movie->imageGenerateName();

                imagejpeg($imageFile, "./img/users/" . $imageName, 100);

                $movie->image = $imageName;

            } else {

                $message->setMessage("Tipo inválido de imagem, insira PNG ou JPEG!", "error", "back");

            }

        }

        $movieDao->create($movie);

    } else{

        $message->setMessage("Informações insuficientes!", "error", "back");

    }

} else{

    $message->setMessage("Informações inválidas!", "error", "index.php");

}

