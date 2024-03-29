<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');

    include_once '../../classes/database.php';
    include_once '../../models/Materia.php';

    if ($_SERVER['REQUEST_METHOD'] === 'PATCH') {
		$db = $db->open();
		$materia = new Materia($db);

		$data = json_decode(file_get_contents("php://input"));

		$put_attributes = array();
		$put_values = array();

		if(isset($data->id_materia)){
			array_push($put_attributes, "id_materia");
			$materia->id_materia = isset($data->id_materia) ? $data->id_materia : NULL;
		}
		if(isset($data->nombre)){
			array_push($put_attributes, "nombre");
			$materia->nombre = $data->nombre;
		}
		if(isset($data->clave)){
			array_push($put_attributes, "clave");
			$materia->clave = $data->clave;
		}
		if(isset($data->grupo)){
			array_push($put_attributes, "grupo");
			$materia->grupo = $data->grupo;
		}

		if(!is_null($materia->id_materia)) {
			if($materia->patchData($put_attributes)) {
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