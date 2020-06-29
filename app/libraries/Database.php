<?php
    /**
     * PDO Database Class
     * Use PDO to establish a connection and interact with database  
     */

    class Database {
        private $hostName = DB_HOST;
        private $userName = DB_USER;
        private $userPassword = DB_PASS;
        private $dbName = DB_NAME;

        private $conn;
        private $sth;
        private $error;

        public function __construct(){
            $dsn = 'mysql:host=' . $this->hostName . ';dbname=' . $this->dbName;
            $options = [
                PDO::ATTR_PERSISTENT => true,
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ];

            try {

                $this->conn = new PDO($dsn, $this->userName, $this->userPassword, $options); 

            } catch(PDOException $e){
                $this->error = $e->getMessage();
                echo $this->error;
            }
        }

        public function query($sql){
            $this->sth = $this->conn->prepare($sql);
        }

        public function bind($params, $value, $type = null){
            if(is_null($type)){
                switch(true){
                    case is_int($value):
                        $type = PDO::PARAM_INT;
                        break;
                    case is_bool($value):
                        $type = PDO::PARAM_BOOL;
                        break;
                    case is_null($value):
                        $type = PDO::PARAM_NULL;
                        break;
                    default:
                        $type = PDO::PARAM_STR;   
                }
            }

            $this->sth->bindValue($params, $value, $type);
        }

        public function execute(){
            return $this->sth->execute();
        }

        public function resultSet(){
            $this->execute();
            return $this->sth->fetchAll(PDO::FETCH_OBJ);
        }

        public function single(){
            $this->execute();
            return $this->sth->fetch(PDO::FETCH_OBJ);
        }

        public function rowCount(){
            return $this->sth->rowCount();
        }
    }
?>