<?php 
require_once 'controllers/PostController.php';
require_once 'models/connection.php';

if($routes[2] == 'usuario'){
	if(count($routes) <= 2){
		$datos = [
			'code' => 404,
			'status' => 'No se encontro ningun resultado'
		];
		echo json_encode($datos, http_response_code($datos['code']));
		return;
	}
	if($routes[3] == 'registro'){
		if(!isset($_POST['nombre'],$_POST['apellido'],$_POST['email'],$_POST['password'],$_POST['rol'])){
			$datos = [
				'code' => 400,
				'status' => 'error',
				'data' => 'Debe ingresar todos los campos: Nombre, apellido, email, password y rol.'
			];
			echo json_encode($datos, http_response_code($datos['code']));
			return;
		}else if(empty($_POST['nombre']) || empty($_POST['apellido']) || empty($_POST['email']) || empty($_POST['password']) || empty($_POST['rol'])){
			$datos = [
				'code' => 400,
				'status' => 'error',
				'data' => 'Ningun campo puede ir vacio: Nombre, apellido, email, password y rol.'
			];
			echo json_encode($datos, http_response_code($datos['code']));
			return;
		}else if(!is_numeric($_POST['rol']) || ($_POST['rol'] >= 6 || $_POST['rol'] <= 0)){
			$datos = [
				'code' => 400,
				'status' => 'error',
				'data' => 'Ingrese un rol valido: 1,2,3,4,5.'
			];
			echo json_encode($datos, http_response_code($datos['code']));
			return;
		}

		$nombre = $_POST['nombre'];
		$apellido = $_POST['apellido'];
		$email = $_POST['email'];
		$password = $_POST['password'];
		$rol = $_POST['rol'];

		$response = new PostController();
		$response->registraUsuario($nombre,$apellido,$email,$password,$rol);

	}else if($routes[3] == 'login'){
		if(!isset($_POST['email'],$_POST['password'])){
			$datos = [
				'code' => 400,
				'status' => 'error',
				'data' => 'Debe ingresar todos los campos:  email y password.'
			];
			echo json_encode($datos, http_response_code($datos['code']));
			return;
		}

		$email = $_POST['email'];
		$password = $_POST['password'];

		$response = new PostController();
		$response->login($email,$password);
	}else{
		$datos = [
			'code' => 404,
			'status' => 'No se encontro ningun resultado'
		];
		echo json_encode($datos, http_response_code($datos['code']));
		return;	
	}


}else if($routes[2] == 'publicaciones'){
	if(count($routes) <= 2){
		$datos = [
			'code' => 404,
			'status' => 'No se encontro ningun resultado'
		];
		echo json_encode($datos, http_response_code($datos['code']));
		return;
	}
	if($routes[3] == 'nueva'){
		if(!isset($_POST['titulo'],$_POST['descripcion'])){
			$datos = [
				'code' => 400,
				'status' => 'error',
				'data' => 'Debe ingresar todos los campos: titullo, descripcion.'
			];
			echo json_encode($datos, http_response_code($datos['code']));
			return;
		}else if(empty($_POST['titulo']) || empty($_POST['descripcion'])){
			$datos = [
				'code' => 400,
				'status' => 'error',
				'data' => 'Ningun campo puede ir vacio: titulo y descripcion.'
			];
			echo json_encode($datos, http_response_code($datos['code']));
			return;
		}

		if(isset($_POST['token'])){
			$validate = Connection::validaToken($_POST['token']);

			if($validate['code'] == 200){
				if($validate['rol'] == 1 || $validate['rol'] == 2){
					$datos = [
						'code' => 404,
						'status' => 'error',
						'data' => 'No cuenta con los permisos necesarios para realizar esta operacion'
					];
					echo json_encode($datos, http_response_code($datos['code']));
					return;
				}
				$titulo = $_POST['titulo'];
				$descripcion = $_POST['descripcion'];

				$response = new PostController();
				$response->registraPublicacion($titulo,$descripcion,$validate['usuario']);
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
		'status' => 'error',
		'data' => 'No se encontro ningun resultado'
	];
	echo json_encode($datos, http_response_code($datos['code']));
	return;
}


?>