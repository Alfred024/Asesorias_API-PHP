<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');

    include_once '../../classes/database.php';
    include_once '../../models/Usuario.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $db = $db->open();

      $usuario = new Usuario($db);

      $data = json_decode(file_get_contents("php://input"));

      // Agregar middleware para asignar rol de acuerdo a las credenciales
      $usuario->id_rol = 2;
      //$usuario->id_rol = $data->id_rol;
      $usuario->email = $data->email;
      $usuario->nombres = $data->nombres;
      $usuario->apellido_paterno = $data->apellido_paterno;
      $usuario->apellido_materno = $data->apellido_materno;
    
      if($usuario->postData()) {
        echo json_encode(array('Mensaje' => 'Usuario creado'));
      } else {
        echo json_encode(array('Mensaje' => 'Usuario no creado. Ocurrió un error'));
      }

      $db = NULL;
    } else {
        echo json_encode(array('Mensaje' => "Código de estado 400: Mala petición"));
    }
?>