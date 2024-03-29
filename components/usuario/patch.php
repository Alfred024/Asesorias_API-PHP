<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');

    include_once '../../classes/database.php';
    include_once '../../models/Usuario.php';

    if ($_SERVER['REQUEST_METHOD'] === 'PATCH') {
		$db = $db->open();
		$usuario = new Usuario($db);

		$data = json_decode(file_get_contents("php://input"));

		$put_attributes = array();

		if(isset($data->id_usuario)){
			array_push($put_attributes, "id_usuario");
			$usuario->id_usuario = isset($data->id_usuario) ? $data->id_usuario : NULL;
		}
		if(isset($data->email)){
			array_push($put_attributes, "email");
			$usuario->email = $data->email;
		}
		if(isset($data->nombres)){
			array_push($put_attributes, "nombres");
			$usuario->nombres = $data->nombres;
		}
		if(isset($data->apellido_paterno)){
			array_push($put_attributes, "apellido_paterno");
			$usuario->apellido_paterno = $data->apellido_paterno;
		}
		if(isset($data->apellido_materno)){
			array_push($put_attributes, "apellido_materno");
			$usuario->apellido_materno = $data->apellido_materno;
		}

		if(!is_null($usuario->id_usuario)) {
			if($usuario->patchData($put_attributes)) {
				echo json_encode(array('Mensaje' => 'Usuario actualizada correctamente'));
			} else {
				echo json_encode(array('Mensaje' => 'Usuario no actualizada. Intente de nuevo'));
			}
		} else {
			echo json_encode(array('Mensaje' => "Error: Indique el ID de la Usuario a actualizar"));
		}
	} else {
		echo json_encode(array('Mensaje' => "Código de estado 400: Mala petición"));
	}

?>