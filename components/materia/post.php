<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');

    include_once '../../classes/database.php';
    include_once '../../models/Materia.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

      $db = new Database();
      $db = $db->connect();

      $materia = new Materia($db);

      $data = json_decode(file_get_contents("php://input"));

      //echo("DATA: ".var_dump($data));

      $materia->clave = $data->clave;
      $materia->nombre = $data->nombre;
      $materia->grupo = $data->grupo;
    
      if($materia->postData()) {
        echo json_encode(array('message' => 'Materia creada'));
      } else {
        echo json_encode(array('message' => 'Materia no creada. Ocurrió un error'));
      }
    } else {
        echo json_encode(array('message' => "Error: Post incorrecto"));
    }
?>