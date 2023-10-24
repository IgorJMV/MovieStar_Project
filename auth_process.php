<?php

    require_once("globals.php");
    require_once("db.php");
    require_once("models/User.php");
    require_once("models/Message.php");
    require_once("dao/UserDAO.php");

    $message = new Message($BASE_URL);
    $userDao = new UserDAO($conn, $BASE_URL);

    //Resgata o tipo de formulário
    $type = filter_input(INPUT_POST, "type");

    //Verificação do tipo de formulário
    if($type === "register"){
        $name = filter_input(INPUT_POST, "name");
        $lastname = filter_input(INPUT_POST, "lastname");
        $email = filter_input(INPUT_POST, "email");
        $password = filter_input(INPUT_POST, "password");
        $confirmpassword = filter_input(INPUT_POST, "confirmpassword");

        //Verificação de dados mínimos
        if($name && $lastname && $email && $password){

            //Verificar se as senhas batem
            if($password === $confirmpassword){

                //Verificar se o email já está cadastrado no sistema
                if($userDao->findByEmail($email) === false){

                    //TODO:
                } else {

                    //Enviar mensagem de erro de usuário já existente
                    $message->setMessage("Usuário já cadastrado, tente outro e-mail.", "error", "back");
                }
            } else {

                //Enviar mensagem de erro de senhas não batem
                $message->setMessage("As senhas não são iguais.", "error", "back");
            }
        } else {

            //Enviar mensagem de erro de dados faltantes
            $message->setMessage("Por favor, preencha todos os campos.", "error", "back");
        }
    } else if($type === "login"){

    }

?>