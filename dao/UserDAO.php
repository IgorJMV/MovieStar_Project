<?php

    require_once("models/User.php");

    class UserDAO implements UserDaoInterface {
        private $conn;
        private $url;

        function __construct(PDO $conn, $url){
            $this->conn = $conn;
            $this->url = $url;
        }

        public function buildUser($data){
            $user = new User($data["id"], $data["name"], $data["lastname"], $data["email"], $data["password"], $data["image"], $data["bio"], $data["token"]);
            
            return $user;
        }
        
        public function create(User $user, $authUser = false){
            //TOOO
        }

        public function update(User $user){
            //TOOO
        }

        public function verifyByToken($protected = false){
            //TOOO
        }

        public function setTokenToSession($token, $redirect = true){
            //TOOO
        }

        public function authenticateUser($email, $password){
            //TOOO
        }

        public function findByEmail($email){
            //TOOO
        }

        public function findById($id){
            //TOOO
        }

        public function findByToken($token){
            //TOOO
        }

        public function changePassword(User $user){
            //TOOO
        }
    }

?>