<?php 
ini_set( 'default_charset', 'UTF-8' );
$routes = explode("/", $_SERVER['REQUEST_URI']);
$routes = array_filter($routes);

//No viene ninguna ruta
if(count($routes) == 1){
	$datos = [
		'code' => 404,
		'status' => 'No se encontro ningun resultado'
	];
	echo json_encode($datos, http_response_code($datos['code']));
	return;
}

//$_SERVER['REQUEST_METHOD'];

if(count($routes) >= 2 && isset($_SERVER['REQUEST_METHOD'])){


	if($_SERVER['REQUEST_METHOD'] == 'GET'){
		include 'get.php';
	}

	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		include 'post.php';
	}


	if($_SERVER['REQUEST_METHOD'] == 'PUT'){
		include 'put.php';
	}


	if($_SERVER['REQUEST_METHOD'] == 'DELETE'){
		include 'delete.php';
	}
}




return;
?>