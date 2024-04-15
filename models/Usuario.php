<?php
class Usuario {

    private $connection;
    
    public $id_usuario;
    public $id_rol;
    public $email; 
    public $contrasena; 
    // public $usuario; // RFC maestros y Nmr. Ctrl alumnos
    public $nombres; 
    public $apellido_paterno;
    public $apellido_materno;

    public function __construct($db){
        $this->connection = $db;
    }

    public function fetchAll() {
        $statement = $this->connection->prepare('SELECT * FROM usuario');
        $statement->execute();
        return $statement;
    }

    public function fetchOne() {
        $statement = $this->connection->prepare('SELECT  * FROM usuario WHERE id_usuario = ?');
        $statement->bindParam(1, $this->id_usuario);
        $statement->execute();        

        if($statement->rowCount() > 0) {
            $row = $statement->fetch(PDO::FETCH_ASSOC);

            $this->id_usuario = $row['id_usuario'];
            $this->email = $row['email'];
            $this->nombres = $row['nombres'];
            $this->apellido_paterno = $row['apellido_paterno'];
            $this->apellido_paterno = $row['apellido_materno'];

            return TRUE;
        }
        
        return FALSE;
    }

    public function postData() {
        $statement = $this->connection->prepare('INSERT INTO usuario SET id_rol = :id_rol, email = :email, contrasena = :contrasena, nombres = :nombres, apellido_paterno = :apellido_paterno, apellido_materno = :apellido_materno');

        $statement->bindParam(':id_rol', $this->id_rol);
        $statement->bindParam(':email', $this->email);
        $statement->bindParam(':contrasena', $this->contrasena);
        $statement->bindParam(':nombres', $this->nombres);
        $statement->bindParam(':apellido_paterno', $this->apellido_paterno);
        $statement->bindParam(':apellido_materno', $this->apellido_paterno);

        if($statement->execute()) {
            return TRUE;
        }

        return FALSE;
    }

    public function putData() {
        $statement = $this->connection->prepare('UPDATE usuario SET email = :email, nombres = :nombres, apellido_paterno = :apellido_paterno WHERE id_usuario = :id_usuario');

        $statement->bindParam(':email', $this->email);
        $statement->bindParam(':nombres', $this->nombres);
        $statement->bindParam(':apellido_paterno', $this->apellido_paterno);
        $statement->bindParam(':id_usuario', $this->id_usuario);

        if($statement->execute()) {
            return TRUE;
        }

        return FALSE;
    }

    public function patchData($attributes) {
        $sql = 'UPDATE usuario SET ';

        foreach ($attributes as $value) {
            $sql .= "$value = :$value, ";
        }
        $sql = rtrim($sql, ', ');
        $sql .= ' WHERE id_usuario = :id_usuario';
    
        $statement = $this->connection->prepare($sql);
        
        foreach ($attributes as $value) {
            $statement->bindParam(":".$value, $this->$value);
        }
    
        if ($statement->execute()) {
            return TRUE;
        }
        return FALSE;
    }

    public function delete() {
        $statement = $this->connection->prepare('DELETE FROM usuario WHERE id_usuario = :id_usuario');
        $statement->bindParam(':id_usuario', $this->id_usuario);

        if($statement->execute()) {
            return TRUE;
        }

        return FALSE;
    }

}