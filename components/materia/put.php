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

		if(!is_null($materia->id_materia)) {
			if($materia->putData()) {
				echo json_encode(array('Mensaje' => 'Materia actualizada correctamente'));
			} else {
				echo json_encode(array('Mensaje' => 'Materia no actualizada. Intente de nuevo'));
			}
		} else {
			echo json_encode(array('Mensaje' => "Error: Indique el ID de la Materia a actualizar"));
		}
	} else {
		echo json_encode(array('Mensaje' => "Código de estado 400: Mala petición"));
	}

?>