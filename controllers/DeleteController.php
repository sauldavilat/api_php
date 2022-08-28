<?php 
require_once 'models/PutModel.php';

class DeleteController{

	static public function eliminaPublicacion($publicacion){
		$response = new PutModel();
		$response->eliminaPublicacion($publicacion);
	}

}

?>