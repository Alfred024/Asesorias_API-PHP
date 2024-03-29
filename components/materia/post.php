<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');

    include_once '../../classes/database.php';
    include_once '../../models/Materia.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $db = $db->open();

      $materia = new Materia($db);

      $data = json_decode(file_get_contents("php://input"));

      $materia->clave = $data->clave;
      $materia->nombre = $data->nombre;
      $materia->grupo = $data->grupo;
    
      if($materia->postData()) {
        echo json_encode(array('Mensaje' => 'Materia creada'));
      } else {
        echo json_encode(array('Mensaje' => 'Materia no creada. Ocurrió un error'));
      }

      $db = NULL;
    } else {
        echo json_encode(array('Mensaje' => "Código de estado 400: Mala petición"));
    }
?>