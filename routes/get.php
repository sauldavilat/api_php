<?php 
require_once 'controllers/GetController.php';

if($routes[2] == 'publicaciones'){
	if(count($routes) == 3){
		$validate = Connection::validaToken($routes[3]);

		if($validate['code'] == 200){
			if($validate['rol'] == 1 || $validate['rol'] == 3){
				$datos = [
					'code' => 404,
					'status' => 'error',
					'data' => 'No cuenta con los permisos necesarios para realizar esta operacion'
				];
				echo json_encode($datos, http_response_code($datos['code']));
				return;
			}
			$response = new GetController();
			$response->getPublicaciones();
		}else{
			echo json_encode($validate, http_response_code($validate['code']));	
		}
		
	}else{
		$datos = [
			'code' => 404,
			'status' => 'error',
			'data' => 'Token no valido'
		];
		echo json_encode($datos, http_response_code($datos['code']));
		return;
	}

}else{
	$datos = [
		'code' => 404,
		'status' => 'error',
		'data' => 'No se encontro ningun resultado'
	];
	echo json_encode($datos, http_response_code($datos['code']));
	return;
}


?>