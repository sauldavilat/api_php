<?php 
require_once 'models/GetModel.php';
class GetController{

	static public function getPublicaciones(){
			$response = GetModel::getPublicaciones();
			
			$datos = new GetController();
			$datos->respuesta($response);
	}


	public function respuesta($response){
		if(!empty($response)){
			$datos = [
				'code' => 200,
				'status' => 'success',
				'data' => $response
			];
		}else{
			$datos = [
				'code' => 200,
				'status' => 'success',
				'data' => 'No existen publicaciones actualmente'
			];
		}
		echo json_encode($datos, http_response_code($datos['code']));

	}

}

?>