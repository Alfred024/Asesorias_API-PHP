<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');

    include_once '../../classes/database.php';
    include_once '../../models/Materia.php';

	if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
		$db = $db->open();
		$materia = new Materia($db);

		$data = json_decode(file_get_contents("php://input"));
		$materia->id_materia = isset($data->id_materia) ? $data->id_materia : NULL;

		if(!is_null($materia->id_materia)){
			// TODO: Comprobar que la materia exista
			if($materia->delete()) {
			echo json_encode(array('Mensaje' => 'Materia eliminada'));
			} else {
			echo json_encode(array('Mensaje' => 'Materia no eliminada'));
			}
		} else {
		echo json_encode(array('Mensaje' => "Error: Indique el ID de la Materia a eliminar"));
		}

		$db = NULL;
	} else {
		echo json_encode(array('Mensaje' => "Código de estado 400: Mala petición"));
	}
?>