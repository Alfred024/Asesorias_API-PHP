<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../classes/database.php';
    include_once '../../models/Materia.php';

    if ($_SERVER['REQUEST_METHOD'] === 'GET') {

        $db = $db->open();
        $materia = new Materia($db);

        $data = json_decode(file_get_contents("php://input"));

        if(isset($data->id_materia)) {
            $materia->id_materia = $data->id_materia;

            if($materia->fetchOne()) {
                print_r(json_encode(array(
                    'id_materia' => $materia->id_materia,
                    'nombre' => $materia->nombre,
                    'clave' => $materia->clave,
                    'grupo' => $materia->grupo
                )));
            } else {
                echo json_encode(array('message' => "No records found!"));
            }
        } else {
            echo json_encode(array('message' => "Error: Materia ID is missing!"));
        }

        $db = NULL;
    } else {
        echo json_encode(array('message' => "Error: incorrect Method!"));
    }

?>