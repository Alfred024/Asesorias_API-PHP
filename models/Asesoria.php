<?php

class Asesoria {

    private $connection;
    
    public $id_asesoria;
    public $id_usuario;
    public $id_materia;
    public $id_periodo;
    public $confirmada;
    public $competencia;
    public $descripcion;
    public $hora;
    public $fecha;

    public $id;
    public $name;
    public $address;
    public $age;

    public function __construct($database){
        $this->connection = $database;
    }

    public function fetchAll() {
        
        $stmt = $this->connection->prepare('SELECT * FROM asesoria');
        $stmt->execute();
        return $stmt;
    }

    public function fetchOne() {

        $stmt = $this->connection->prepare('SELECT  * FROM asesoria WHERE id = ?');
        $stmt->bindParam(1, $this->id_asesoria);
        $stmt->execute();        

        if($stmt->rowCount() > 0) {
            
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            $this->id_asesoria = $row['id_asesoria'];
            $this->name = $row['name'];
            $this->address = $row['address'];
            $this->age = $row['age'];

            return TRUE;

        }
        
        return FALSE;
    }

    public function postData() {

        $stmt = $this->connection->prepare('INSERT INTO Asesorias SET name = :name, address = :address, age = :age');

        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':address', $this->address);
        $stmt->bindParam(':age', $this->age);

        if($stmt->execute()) {
            return TRUE;
        }

        return FALSE;
    }

    public function putData() {

        $stmt = $this->connection->prepare('UPDATE Asesorias SET name = :name, address = :address, age = :age WHERE id = :id');

        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':address', $this->address);
        $stmt->bindParam(':age', $this->age);
        $stmt->bindParam(':id', $this->id);

        if($stmt->execute()) {
            return TRUE;
        }

        return FALSE;
    }

    public function delete() {

        $stmt = $this->connection->prepare('DELETE FROM Asesorias WHERE id = :id');
        $stmt->bindParam(':id', $this->id);

        if($stmt->execute()) {
            return TRUE;
        }

        return FALSE;
    }


}