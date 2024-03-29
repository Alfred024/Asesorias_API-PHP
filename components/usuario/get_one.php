<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../classes/database.php';
    include_once '../../models/Usuario.php';

    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $db = $db->open();
        $usuario = new Usuario($db);

        $data = json_decode(file_get_contents("php://input"));

        if(isset($data->id_usuario)) {
            // TODO: Verificar las credenciales, a ver si el id_rol será un admin, maestro, jfe de dpto., maestro ó alumno
            if($usuario->fetchOne()) {
                print_r(json_encode(array(
                    'id_usuario' => $usuario->id_usuario,
                    'id_rol' => $usuario->id_rol,
                    'email' => $usuario->email,
                    'nombres' => $usuario->nombres,
                    'apellido_paterno' => $usuario->apellido_paterno,
                    'apellido_materno' => $usuario->apellido_materno
                )));
            } else {
                echo json_encode(array('Mensaje: ' => "No se encontró la usuario con el ID: ".$usuario->id_usuario));
            }
        } else {
            echo json_encode(array('Mensaje: ' => "Por favor. Especifique el ID de la usuario a buscar"));
        }

        $db = NULL;
    } else {
        echo json_encode(array('Mensaje: ' => "Código de estado 400: Mala petición"));
    }

?>