<?php 
require_once 'connection.php';

class GetModel{
	static public function getPublicaciones(){
		$sql = "SELECT p.titulo, p.descripcion, p.created_at, concat(cu.nombre,\" \",cu.apellido) as usuario_creacion, cr.rol FROM publicaciones p INNER JOIN cat_usuarios cu ON cu.id = p.id_usuario INNER JOIN cat_roles cr ON cu.id_rol = cr.id  WHERE p.deleted_at is null";
		$conn = Connection::conexion()->prepare($sql);

		$conn->execute();
		return $conn->fetchAll(PDO::FETCH_CLASS);
	}


	static public function getUsuario($token){
		$sql = "SELECT id, id_rol, token, expira_token FROM cat_usuarios WHERE token = ?";
		$conn = Connection::conexion()->prepare($sql);
		$conn->execute([$token]);
		return $conn->fetchAll(PDO::FETCH_CLASS);
	}
}

?>