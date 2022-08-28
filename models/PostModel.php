<?php 
require_once 'connection.php';

class PostModel{
	static public function registraUsuario($nombre,$apellido,$email,$password,$rol){
		ini_set('display_errors',1);
		$sql = "INSERT INTO cat_usuarios (id_rol,nombre,apellido,correo,password,created_at,updated_at) VALUES (?,?,?,?,?,?,?);";


		try {
			$conn = Connection::conexion()->prepare($sql);
	        $conn->execute([$rol,$nombre,$apellido,$email,$password,date('Y-m-d H:i:s'),date('Y-m-d H:i:s')]);

	        $datos = [
				'code' => 200,
				'status' => 'success',
				'data' => 'Usuario registrado correctamente'
			];
			echo json_encode($datos, http_response_code($datos['code']));
	    } catch(PDOException $e) {
	    	$datos = [
				'code' => 400,
				'status' => 'error',
				'data' => $e->getMessage()
			];
			echo json_encode($datos, http_response_code($datos['code']));
	    }
	}


	static function loginUsuario($email,$password){
		$sql = "SELECT * FROM cat_usuarios WHERE correo = ? AND password = ?;";
		$conn = Connection::conexion()->prepare($sql);

		$conn->execute([$email,$password]);
		return $conn->fetchAll(PDO::FETCH_CLASS);
	}

	static public function registraPublicacion($titulo,$descripcion,$usuario){
		ini_set('display_errors',1);
		$sql = "INSERT INTO publicaciones (id_usuario,titulo,descripcion,created_at,updated_at) VALUES (?,?,?,?,?);";


		try {
			$conn = Connection::conexion()->prepare($sql);
	        $conn->execute([$usuario,$titulo,$descripcion,date('Y-m-d H:i:s'),date('Y-m-d H:i:s')]);

	        $datos = [
				'code' => 200,
				'status' => 'success',
				'data' => 'publicacion registrada correctamente'
			];
			echo json_encode($datos, http_response_code($datos['code']));
	    } catch(PDOException $e) {
	    	$datos = [
				'code' => 400,
				'status' => $usuario,
				'data' => $e->getMessage()
			];
			echo json_encode($datos, http_response_code($datos['code']));
	    }
	}
}

?>