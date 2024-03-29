<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');

    include_once '../../classes/database.php';
    include_once '../../models/Usuario.php';

	if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
		$db = $db->open();
		$usuario = new Usuario($db);

		$data = json_decode(file_get_contents("php://input"));
		$usuario->id_usuario = isset($data->id_usuario) ? $data->id_usuario : NULL;

		if(!is_null($usuario->id_usuario)){
			// TODO: Comprobar que el usuario exista
			if($usuario->delete()) {
			echo json_encode(array('Mensaje' => 'Usuario eliminado'));
			} else {
			echo json_encode(array('Mensaje' => 'Usuario no eliminado'));
			}
		} else {
		echo json_encode(array('Mensaje' => "Error: Indique el ID de la Usuario a eliminar"));
		}

		$db = NULL;
	} else {
		echo json_encode(array('Mensaje' => "Código de estado 400: Mala petición"));
	}
?>