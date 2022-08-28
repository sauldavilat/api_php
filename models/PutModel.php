<?php 
require_once 'connection.php';

class PutModel{
	static public function actualizaToken($token, $id_usuario, $exp){
		ini_set('display_errors',1);
		$sql = "UPDATE cat_usuarios SET token = ?, expira_token = ? ,updated_at = ? WHERE id = ?;";


		try {
			$conn = Connection::conexion()->prepare($sql);
	        $conn->execute([$token,$exp, date('Y-m-d H:i:s'),$id_usuario]);

	        $datos = [
				'code' => 200,
				'status' => 'success',
				'data' => 'token agregado correctamente'
			];
			return $datos;
	    } catch(PDOException $e) {
	    	$datos = [
				'code' => 400,
				'status' => 'error',
				'data' => $e->getMessage()
			];

			return $datos;
			
	    }
	}


	static public function actualizaPublicacion($id_publicacion,$titulo,$descripcion,$usuario){
		ini_set('display_errors',1);
		$sql = "UPDATE publicaciones SET titulo = ?, descripcion = ? ,updated_at = ? WHERE id = ?;";


		try {
			$conn = Connection::conexion()->prepare($sql);
	        $conn->execute([$titulo,$descripcion, date('Y-m-d H:i:s'),$id_publicacion]);

	        $datos = [
				'code' => 200,
				'status' => 'success',
				'data' => 'Publicacion actualizada correctamente.'
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


	static public function eliminaPublicacion($publicacion){
		$sql = "UPDATE publicaciones SET  deleted_at = ? WHERE id = ?;";


		try {
			$conn = Connection::conexion()->prepare($sql);
	        $conn->execute([date('Y-m-d H:i:s'),$publicacion]);

	        $datos = [
				'code' => 200,
				'status' => 'success',
				'data' => 'Publicacion eliminada correctamente.'
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
}

?>