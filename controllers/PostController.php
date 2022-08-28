<?php 
require_once 'models/PostModel.php';
require_once 'models/PutModel.php';
require_once 'models/connection.php';
require_once 'vendor/autoload.php';
use Firebase\JWT\JWT;

class PostController{

	static public function registraUsuario($nombre,$apellido,$email,$password,$rol){
		if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$password = hash('sha256', $password);
			$response = new PostModel();
			$response->registraUsuario($nombre,$apellido,$email,$password,$rol);
	    }else{
	        $datos = [
				'code' => 400,
				'status' => 'error',
				'data' => 'Ingrese un email valido.'
			];
			echo json_encode($datos, http_response_code($datos['code']));
	    }

	}

	static function login($email,$password){
		$password = hash('sha256', $password);
		$response = new PostModel();

		$response = PostModel::loginUsuario($email,$password);
		$datos = new PostController();
		$datos->checkLogin($response);
	}

	public function checkLogin($response){
		if(!empty($response)){
			$token = [
				'tiempo' => time(),
				'exp' => time()+(60*60*1),
				'data' => [
					'id' => $response[0]->id,
					'email' => $response[0]->correo
				]
			];

			$jwt = JWT::encode($token, "dfghjs7srtgsk", 'HS256');
			$update = PutModel::actualizaToken($jwt, $response[0]->id, $token['exp']);

			if($update['code'] == 200){
				$response[0]->token = $jwt;
			}

			unset($response[0]->id);
			unset($response[0]->password);
			unset($response[0]->created_at);
			unset($response[0]->updated_at);
			unset($response[0]->deleted_at);
			unset($response[0]->expira_token);

			$datos = [
				'code' => 200,
				'status' => 'success',
				'data' => $response
			];
		}else{
			$datos = [
				'code' => 400,
				'status' => 'error',
				'data' => 'Email o password incorrectos'
			];
		}
		echo json_encode($datos, http_response_code($datos['code']));
	}


	static public function registraPublicacion($titulo,$descripcion,$usuario){
		$response = new PostModel();
		$response->registraPublicacion($titulo,$descripcion,$usuario);

	}

}

?>