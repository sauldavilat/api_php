<?php 
require_once 'models/PutModel.php';

class PutController{

	static public function registraPublicacion($id_publicacion,$titulo,$descripcion,$usuario){
		$response = new PutModel();
		$response->actualizaPublicacion($id_publicacion,$titulo,$descripcion,$usuario);

	}

}

?>