<?php
    include_once(__DIR__ . "/db.php");

    class User {
        private $email;
        private $username;
        private $password;

        public function getEmail()
        {
                return $this->email;
        }

        public function setEmail($email)
        {
            if(empty($email)){
                throw new Exception("Email cannot be empty.");
            }
            $this->email = $email;
            return $this;
        }

        public function getUsername()
        {
                return $this->username;
        }

        //set username but checks if not duplicate in database
        public function setUsername($username)
        {
            $conn = Db::getInstance();
            $stmt = $conn->prepare("SELECT username FROM users WHERE username = :username");
            $stmt -> bindValue(":username", $username);
            $stmt -> execute();
            // $user = ($stmt->fetch());

            //     if ($user) {
            //             throw new Exception("Username already exists");
            //             return false;
            //     }
                $this->username = $username;
                return $this->username;
        }

        public function getPassword()
        {
            return $this->password;
        }

        public function setPassword( $password )
        {
            if(strlen($password) < 5){
                throw new Exception("Passwords must be longer than 6 characters.");
            }

            $this->password = $password;
            return $this;
        }

        public function getError()
        {
                return $this->error;
        }
        public function setError($error)
        {
                $this->error = $error;

                return $this;
        }

        public function canLogin() 
        {
            $conn = Db::getInstance();;
            $stmt = $conn->prepare("select * from users where username = :username");
            $stmt -> bindValue(":username", $this -> username);
            $stmt -> execute();
            $user = ($stmt->fetch());
          
            if(!$user){
                throw new Exception("User not exist.");
                return false;
            }

            if(password_verify($this->password, $user['password'])){
                return true;
            }

            else{
                throw new Exception("Password not right.");
                return false;
            }
        }

        public function register()
        {
                $conn = Db::getInstance();
                $statement = $conn->prepare("select * from users where email = :email;");
                $statement->bindValue(':email', $this->email);
                $statement->execute();
                $user = ($statement->fetch());
                if ($user) {
                        throw new Exception("Username already taken");
                        return false;
                }
                $options = [
                    'cost' => 12
                ];
                $hash = password_hash($this->password, PASSWORD_DEFAULT, $options);
                $statement = $conn->prepare("insert into users (username, email, password) values (:username, :email, :password)");
                $statement->bindValue(":username", $this->username);
                $statement->bindValue(":email", $this->email);
                $statement->bindValue(":password", $hash);
                $statement->execute();
                return true;
        }

        public static function getEmailByUsername($username) {
            $conn = Db::getInstance();
            $stmt = $conn->prepare("select * from users where username = :username");
            $stmt -> bindValue(":username", $username);
            $stmt -> execute();
            $user = ($stmt->fetch());
            return $user;
        }

        public static function getUserByEmail($email) {
            $conn = Db::getInstance();
            $stmt = $conn->prepare("select * from users where email = :email");
            $stmt -> bindValue(":email", $email);
            $stmt -> execute();
            $user = ($stmt->fetch());
            return $user;
        }
    }