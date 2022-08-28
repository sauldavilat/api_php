<?php 
	require_once "controllers/RoutesController.php";
	require_once "models/connection.php";

	header('Access-Control-Allow-Origin: *');
	header('Access-Control-Allow-Headers: Origin, X-Request-With, Content-Type, Accept');
	header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
	header('content-type: application/json; charset=utf-8');

	$index = new RoutesController();
	$index->index();
?>