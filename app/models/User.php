<?php
    class User {
        private $db;

        public function __construct() {
            $this->db = new Database();
        }

        public function findUserByEmail($email){
            $this->db->query('SELECT * FROM users WHERE email = :email');

            $this->db->bind(':email', $email);

            $row = $this->db->single();

            if($this->db->rowCount() > 0){
                // $email exist in database 
                return true;
            }else{
                // $email doesn't exist in database
                return false;
            }
        }

        public function registerUser($user){
            // prepare sql statement
            $this->db->query('INSERT INTO users (name, email, password) VALUES (:name, :email, :password)');

            // bind named parameter in prepared sql statement with value
            $this->db->bind(':name', $user['userName']);
            $this->db->bind(':email', $user['email']);
            $this->db->bind(':password', $user['password']);

            // excute prepared statement
            $isSuccess = $this->db->execute();

            return $isSuccess;
        }
    }
?>