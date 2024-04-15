<?php

class Materia {

    private $connection;
    
    public $id_materia;
    public $clave;
    public $nombre;
    public $grupo;

    public function __construct($db){
        $this->connection = $db;
    }

    public function fetchAll() {
        $statement = $this->connection->prepare('SELECT * FROM materia');
        $statement->execute();
        return $statement;
    }

    public function fetchOne() {
        $statement = $this->connection->prepare('SELECT  * FROM materia WHERE id_materia = ?');
        $statement->bindParam(1, $this->id_materia);
        $statement->execute();        

        if($statement->rowCount() > 0) {
            $row = $statement->fetch(PDO::FETCH_ASSOC);

            $this->id_materia = $row['id_materia'];
            $this->clave = $row['clave'];
            $this->nombre = $row['nombre'];
            $this->grupo = $row['grupo'];

            return TRUE;
        }
        
        return FALSE;
    }

    public function postData() {
        $statement = $this->connection->prepare('INSERT INTO materia SET clave = :clave, nombre = :nombre, grupo = :grupo');

        $statement->bindParam(':clave', $this->clave);
        $statement->bindParam(':nombre', $this->nombre);
        $statement->bindParam(':grupo', $this->grupo);

        if($statement->execute()) {
            return TRUE;
        }

        return FALSE;
    }

    public function putData() {
        $statement = $this->connection->prepare('UPDATE materia SET clave = :clave, nombre = :nombre, grupo = :grupo WHERE id_materia = :id_materia');

        $statement->bindParam(':clave', $this->clave);
        $statement->bindParam(':nombre', $this->nombre);
        $statement->bindParam(':grupo', $this->grupo);
        $statement->bindParam(':id_materia', $this->id_materia);

        if($statement->execute()) {
            return TRUE;
        }

        return FALSE;
    }

    public function patchData($attributes) {
        // return var_dump($attributes);
        $sql = 'UPDATE materia SET ';

        foreach ($attributes as $value) {
            $sql .= "$value = :$value, ";
        }
        $sql = rtrim($sql, ', ');
        $sql .= ' WHERE id_materia = :id_materia';
    
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
        $statement = $this->connection->prepare('DELETE FROM materia WHERE id_materia = :id_materia');
        $statement->bindParam(':id_materia', $this->id_materia);

        if($statement->execute()) {
            return TRUE;
        }

        return FALSE;
    }

}