CREATE DATABASE examen;

CREATE TABLE cat_roles (
	id INT NOT NULL auto_increment primary key,
    rol varchar(100),
    descripcion varchar(255)
)ENGINE=InnoDB;

INSERT INTO cat_roles (rol,descripcion) VALUES ('Básico','Permiso de acceso'),
('Medio','Permiso de acceso y consulta'),
('Medio alto','Permiso de acceso y agregar'),
('Alto medio','Permiso de acceso, consulta, agregar y actualizar'),
('Alto','Permiso de acceso, consulta, agregar, actualizar y eliminar');

CREATE TABLE cat_usuarios (
	id INT NOT NULL auto_increment primary key,
    id_rol int NOT NULL,
    nombre varchar(100),
    apellido varchar(255),
    correo varchar(255) NOT NULL UNIQUE,
    password varchar(255) NOT NULL,
	token TEXT,
    expira_token TEXT,
    created_at datetime DEFAULT NULL,
    updated_at datetime DEFAULT NULL,
    deleted_at datetime DEFAULT NULL,
    CONSTRAINT fk_usuarios_roles FOREIGN KEY(id_rol) REFERENCES cat_roles(id)
)ENGINE=InnoDB;

CREATE TABLE publicaciones(
	id INT NOT NULL auto_increment primary key,
    id_usuario INT,
    titulo VARCHAR(100),
    descripcion VARCHAR(255),
    created_at datetime DEFAULT NULL,
    updated_at datetime DEFAULT NULL,
    deleted_at datetime DEFAULT NULL,
    CONSTRAINT fy_publicaciones_usuarios FOREIGN KEY(id_usuario) REFERENCES cat_usuarios(id)
)ENGINE=InnoDB;