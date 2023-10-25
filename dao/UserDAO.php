<?php

    require_once("models/User.php");
    require_once("models/Message.php");

    class UserDAO implements UserDaoInterface {
        private $conn;
        private $url;
        private $message;

        function __construct(PDO $conn, $url){
            $this->conn = $conn;
            $this->url = $url;
            $this->message = new Message($url);
        }

        public function buildUser($data){
            $user = new User($data["id"], $data["name"], $data["lastname"], $data["email"], $data["password"], ($data["image"] != null) ? $data["image"] : "", ($data["bio"] != null) ? $data["bio"] : "", $data["token"]);
            
            return $user;
        }
        
        public function create(User $user, $authUser = false){
            $name = $user->getName();
            $lastname = $user->getLastname();
            $email = $user->getEmail();
            $password = $user->getPassword();
            $token = $user->getToken();

            $statement = $this->conn->prepare("INSERT INTO users
                        (name, lastname, email, password, token) VALUES
                        (:name, :lastname, :email, :password, :token)");
            $statement->bindParam(":name", $name);
            $statement->bindParam(":lastname", $lastname);
            $statement->bindParam(":email", $email);
            $statement->bindParam(":password", $password);
            $statement->bindParam(":token", $token);
            $statement->execute();

            //Autenticar usuário caso auth seja true
            if($authUser){
                $this->setTokenToSession($user->getToken());
            }

        }

        public function update(User $user){
            //TODO:
        }

        public function verifyByToken($protected = false){
            //TODO:
        }

        public function setTokenToSession($token, $redirect = true){
            //Salvar token na session
            $_SESSION["token"] = $token;

            if($redirect){
                //Redireciona para o perfil do usuário
                $this->message->setMessage("Seja bem-vindo!", "success", "editprofile.php");
            }
        }

        public function authenticateUser($email, $password){
            //TODO:
        }

        public function findByEmail($email){
            if($email != ""){
                $statement = $this->conn->prepare("SELECT * FROM users WHERE email = :email");
                $statement->bindParam(":email", $email);
                $statement->execute();

                if($statement->rowCount() > 0){
                    $data = $statement->fetch();
                    $user = $this->buildUser($data);
                    return $user;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }

        public function findById($id){
            //TODO:
        }

        public function findByToken($token){
            //TODO:
        }

        public function changePassword(User $user){
            //TODO:
        }
    }

?>