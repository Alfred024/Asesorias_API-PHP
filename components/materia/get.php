<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../classes/database.php';
    include_once '../../models/Materia.php';

    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $db = $db->open();
        $materia = new Materia($db);

        $res = $materia->fetchAll();
        $resCount = $res->rowCount();

        if($resCount > 0) {
            $materias = array();

            while($row = $res->fetch(PDO::FETCH_ASSOC)) {
                extract($row);
                array_push($materias, array( 'id_materia' => $id_materia, 'nombre' => $nombre, 'clave' => $clave, 'grupo' => $grupo));
            }
            
            echo json_encode($materias);
        } else {
            echo json_encode(array('Mensaje: ' => "No hay materias registradas."));
        }
    } else {
        echo json_encode(array('Mensaje: ' => "Código de estado 400: Mala petición"));
    }

?>