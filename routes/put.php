<?php 
require_once 'controllers/PutController.php';

if($routes[2] == 'publicaciones'){
	if(count($routes) <= 2){
		$datos = [
			'code' => 404,
			'status' => 'No se encontro ningun resultado'
		];
		echo json_encode($datos, http_response_code($datos['code']));
		return;
	}
	if($routes[3] == 'actualiza'){
		$data = [];
		parse_str(file_get_contents("php://input"),$data);


		if(!isset($data['titulo'],$data['descripcion'], $data['id_publicacion'])){
			$datos = [
				'code' => 400,
				'status' => 'error',
				'data' => 'Debe ingresar todos los campos: titulo, descripcion, publicacion'
			];
			echo json_encode($datos, http_response_code($datos['code']));
			return;
		}else if(empty($data['titulo']) || empty($data['descripcion']) || empty($data['id_publicacion'])){
			$datos = [
				'code' => 400,
				'status' => 'error',
				'data' => 'Ningun campo puede ir vacio: titulo y descripcio, publicacion.'
			];
			echo json_encode($datos, http_response_code($datos['code']));
			return;
		}

		if(isset($data['token'])){
			$validate = Connection::validaToken($data['token']);

			if($validate['code'] == 200){
				if($validate['rol'] != 4 && $validate['rol'] != 5){
					$datos = [
						'code' => 404,
						'status' => 'error',
						'data' => 'No cuenta con los permisos necesarios para realizar esta operacion'
					];
					echo json_encode($datos, http_response_code($datos['code']));
					return;
				}
				$titulo = $data['titulo'];
				$descripcion = $data['descripcion'];
				$id_publicacion = $data['id_publicacion'];

				$response = new PutController();
				$response->registraPublicacion($id_publicacion,$titulo,$descripcion,$validate['usuario']);
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

	


}else{
	$datos = [
		'code' => 404,
		'status' => 'No se encontro ningun resultado'
	];
	echo json_encode($datos, http_response_code($datos['code']));
	return;
}


?>