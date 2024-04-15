<?php
    include('../constants.php');

    class Database {
        private $sgbd = "mysql";
        private $host = "localhost";
        private $user = "admin";
        //private $db = "asesorias";
        private $db = $DB_NAME;
        private $pwd = "123";
        private $connection = NULL;
    
        public function open() {
            try{
                //$this->connection = new PDO($this->sgbd.":host=$this->host;dbname=$this->db", $this->user, $this->pwd);
                $this->connection = new PDO("$this->sgbd:host=$this->host;dbname=$this->db", $this->user, $this->pwd);
                $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch(PDOException $exp) {
                echo "Connection Error: " . $exp->getMessage();
            }
            return $this->connection;
        }
    }

    $db = new Database();
?>