<?php 
require_once 'models/GetModel.php';


class Connection {

	static public function conexion(){
		try {
			$conn = new PDO("mysql:host=localhost;dbname=examen","root","");
			$conn->exec("set names utf8");
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch (PDOException $e) {
			die("Error: ".$e->getMessage());
		}

		return $conn;
	}


	static public function validaToken($token){
		$token = GetModel::getUsuario($token);
		if(!empty($token)){
			if($token[0]->expira_token > time()){
				$datos = [
					'code' => 200,
					'status' => 'success',
					'rol' => $token[0]->id_rol,
					'usuario' => $token[0]->id
				];
			}else{
				$datos = [
					'code' => 404,
					'status' => 'error',
					'data' => 'El token expiro.'
				];
			}
		}else{
			$datos = [
				'code' => 404,
				'status' => 'error',
				'data' => 'Token no valido.'
			];
		}
		return $datos;
	}
}

?>