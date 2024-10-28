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

-- insertar registro en la tabla usuarios
INSERT INTO usuarios (nombre, telefono, correo, PASSWORD, rfc, notas) VALUES
	('Test', '1234567890', 'mail@mail.com', MD5('123A'), 'CAGL881116QM3', 'Nota1');
	
SELECT * FROM usuarios; 

SELECT * FROM usuarios WHERE correo = 'usuario@mail.com' AND password = MD5('123')