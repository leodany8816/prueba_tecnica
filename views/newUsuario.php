<?php
session_start();
include '../controllers/usuarios.php';

$usuariosController = new UsuariosController();
try{
$json_data = file_get_contents('php://input');
$data = json_decode($json_data, true);

$nombre =  $data['nombre'];
$telefono =  $data['telefono'];
$correo =  $data['correo'];
$password =  $data['password'];
$rfc =  $data['rfc'];
$notas =  $data['notas'];

$newUsr = $usuariosController->newUsuario($nombre, $telefono, $correo, $password, $rfc, $notas);

echo json_encode(array('status' => true, 'mensaje' => 'Se creo el usuario correctamente'));
}catch(Exception $e){
    echo json_encode(array('status' => false, 'mensaje' => 'No se pudo crear el usuario correctamente'));
}

