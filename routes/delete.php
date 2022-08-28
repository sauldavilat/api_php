<?php 
require_once 'controllers/DeleteController.php';
require_once 'models/connection.php';

if($routes[2] == 'publicaciones'){
	if(count($routes) <= 3){
		$datos = [
			'code' => 404,
			'status' => 'No se encontro ningun resultado'
		];
		echo json_encode($datos, http_response_code($datos['code']));
		return;
	}
	if($routes[3] == 'elimina'){
		if(is_numeric($routes[4])){
			if(count($routes) == 5){
				$validate = Connection::validaToken($routes[5]);

				if($validate['code'] == 200){
					if($validate['rol'] != 5){
						$datos = [
							'code' => 404,
							'status' => 'error',
							'data' => 'No cuenta con los permisos necesarios para realizar esta operacion'
						];
						echo json_encode($datos, http_response_code($datos['code']));
						return;
					}
					$publicacion = $routes[4];

					$response = new DeleteController();
					$response->eliminaPublicacion($publicacion);
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
				'status' => 'Parametro no valido'
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