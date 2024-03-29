<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../classes/database.php';
    include_once '../../models/Usuario.php';

    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $db = $db->open();
        $usuario = new Usuario($db);

        $res = $usuario->fetchAll();
        $resCount = $res->rowCount();

        if($resCount > 0) {
            $usuarios = array();

            while($row = $res->fetch(PDO::FETCH_ASSOC)) {
                extract($row);
                array_push($usuarios, array(
                    'id_usuario' => $id_usuario,
                    'id_rol' => $id_rol,
                    'email' => $email,
                    'nombres' => $nombres,
                    'apellido_paterno' => $apellido_paterno,
                    'apellido_materno' => $apellido_materno
                ));
            }
            
            echo json_encode($usuarios);
        } else {
            echo json_encode(array('Mensaje: ' => "No hay usuarios registradas."));
        }
    } else {
        echo json_encode(array('Mensaje: ' => "Código de estado 400: Mala petición"));
    }

?>