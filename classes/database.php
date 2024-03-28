<?php
    class Database {
        private $sgbd = "mysql";
        private $host = "localhost";
        private $user = "admin";
        private $db = "asesorias";
        private $pwd = "123";
        private $connection = NULL;
    
        public function connect() {
            try{
                //$this->connection = new PDO($this->sgbd.":host=$this->host;dbname=$this->db", $this->user, $this->pwd);
                $this->connection = new PDO("$this->sgbd:host=$this->host;dbname=$this->db", $this->user, $this->pwd);
                $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch(PDOException $exp) {
                echo "Connection Error: " . $e->getMessage();
            }
            return $this->connection;
        }

        public function close() {
            $this->connection = null;
        }


        function query($query_param){
            $this->connect();
            $this->registrersBlock=mysqli_query($this->connection,$query_param);
            $this->registersNum=mysqli_num_rows($this->registrersBlock);
            $this->close();
        }

        function postData($query_param){
            // $statement = $this->connection->prepare('INSERT INTO materia SET clave = :clave, nombre = :nombre, grupo = :grupo');
            // $statement->bindParam(':clave', $this->clave);
            // $statement->bindParam(':nombre', $this->nombre);
            // $statement->bindParam(':grupo', $this->grupo);
            $statement = $this->connection->prepare($query_param);

            if($statement->execute()) {
                return TRUE;
            }

            return FALSE;
        }
    }
    // class Database{
    //     var $connection;
    //     var $server;
    //     var $user;
    //     var $password;
    //     var $database;
    //     var $registrersBlock;
    //     var $registersNum; 

    //     function __construct(){
    //         $this-> password="123";  //para acceder a cualquier elemento de la clase se usa $this->;
    //         $this-> user="admin";
    //         $this-> database="asesorias";
    //         $this-> server="localhost";
    //     }

    //     // function __construct($server, $user, $password, $database){
    //     //     $this-> server=$server;
    //     //     $this-> user=$user;
    //     //     $this-> password=$password;  //para acceder a cualquier elemento de la clase se usa $this->;
    //     //     $this-> database=$database;
    //     // }
        
    //     function open(){
    //         $this-> connection = mysqli_connect($this->server,$this->user,$this->password,$this->database);
    //     }

    //     function close(){
    //         mysqli_close($this->connection);
    //     }

    //     function query($query_param){
    //         $this->open();
    //         $this->registrersBlock=mysqli_query($this->connection,$query_param);
    //         $this->registersNum=mysqli_num_rows($this->registrersBlock);
    //         $this->close();
    //     }

    //     function getRecord($query_param){
    //         $this->open();
    //         $this->registrersBlock=mysqli_query($this->connection,$query_param);
    //         $this->registersNum=mysqli_num_rows($this->registrersBlock);
    //         $this->close();
    //         return mysqli_fetch_object($this->registrersBlock);
    //     }
    // }
    
?>