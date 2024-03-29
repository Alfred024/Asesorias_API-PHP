<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');

    include_once '../../classes/database.php';
    include_once '../../models/Usuario.php';

    if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
		$db = $db->open();
		$usuario = new Usuario($db);

		$data = json_decode(file_get_contents("php://input"));

		$usuario->id_usuario = isset($data->id_usuario) ? $data->id_usuario : NULL;
		$usuario->email = $data->email;
		$usuario->nombres = $data->nombres;
		$usuario->apellido_paterno = $data->apellido_paterno;
		$usuario->apellido_materno = $data->apellido_materno;
		$usuario->grupo = $data->grupo;

		if(!is_null($usuario->id_usuario)) {
			if($usuario->putData()) {
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