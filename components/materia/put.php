<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');

    include_once '../../classes/database.php';
    include_once '../../models/Materia.php';

    if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
		$db = $db->open();
		$materia = new Materia($db);

		$data = json_decode(file_get_contents("php://input"));

		$materia->id_materia = isset($data->id_materia) ? $data->id_materia : NULL;
		$materia->nombre = $data->nombre;
		$materia->clave = $data->clave;
		$materia->grupo = $data->grupo;

		if(! is_null($materia->id_materia)) {
			if($materia->putData()) {
			echo json_encode(array('message' => 'Materia updated'));
			} else {
			echo json_encode(array('message' => 'Materia Not updated, try again!'));
			}
		} else {
		echo json_encode(array('message' => "Error: Materia ID is missing!"));
		}
	} else {
		echo json_encode(array('message' => "Error: incorrect Method!"));
	}

?>