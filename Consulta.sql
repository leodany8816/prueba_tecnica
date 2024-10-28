-- creacion de la base de datos
DROP DATABASE IF EXISTS registrosdb;
CREATE DATABASE registrosdb;

-- usar
USE registrosdb;

-- crear la tabla usuarios
CREATE TABLE usuarios (
	id_usuario INT AUTO_INCREMENT PRIMARY KEY,
	nombre VARCHAR(255) NULL,
	telefono CHAR(10) NOT NULL,
	correo VARCHAR(255) NOT NULL,
	password VARCHAR(255) NOT NULL,
	rfc CHAR(15) NOT NULL,
	notas TEXT NOT NULL
);

