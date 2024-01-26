<?php

use function PHPSTORM_META\type;

    require_once("globals.php");
    require_once("db.php");
    require_once("models/User.php");
    require_once("models/Message.php");
    require_once("dao/UserDAO.php");

    $message = new Message($BASE_URL);
    $userDao = new UserDAO($conn, $BASE_URL);

    //Resgata o tipo de formulário
    $type = filter_input(INPUT_POST, "type");

    //Atualizar o usuário
    if($type == "update"){

        //Resgata dados do usuário
        $userData = $userDao->verifyByToken();

        //Receber dados do post
        $name = filter_input(INPUT_POST, "name");
        $lastname = filter_input(INPUT_POST, "lastname");
        $email = filter_input(INPUT_POST, "email");
        $bio = filter_input(INPUT_POST, "bio");

        //Criar um novo objeto usuário
        $user = new User();

        //Preencher os dados do usuário
        $userData->setName($name);
        $userData->setLastname($lastname);
        $userData->setEmail($email);
        $userData->setBio($bio);

        $userDao->update($userData);

        //Atualizar senha do usuario
    } else if ($type == "changepassword"){

    } else {
        $message->setMessage("Informações inválidas!", "error", "index.php");
    }

?>