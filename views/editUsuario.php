<?php
session_start();
include '../controllers/usuarios.php';

$usuariosController = new UsuariosController();

try {
    // Obtener los datos enviados por POST
    $json_data = file_get_contents('php://input');
    // Decodificar el JSON
    $data = json_decode($json_data, true);
    if (isset($data['id'])) {
        $usuario = $usuariosController->viewUsr($data['id']);
        //print_r($usuario);
        $usuario = [
            "id_usuario" => $usuario['id_usuario'],
            "nombre" => $usuario['nombre'],
            "telefono" => $usuario['telefono'],
            "correo" => $usuario['correo'],
            "password" => $usuario['password'],
            "rfc" => $usuario['rfc'],
            "notas" => $usuario['notas'],
        ];

        echo json_encode(array('status' => true, 'usuario' => $usuario));
    }

    if(isset($data['editar'])){
        $edit = $usuariosController->editUsr($data['idUsr'],$data['nombre'],$data['telefono'],$data['correo'],$data['password'],$data['rfc'],$data['notas']);

        echo json_encode(array('status' => true, 'mensaje' => 'Los datos se actualizaron correctamente'));

    }
} catch (Exception $e) {
    //echo $e;
    echo json_encode(array('status' => false, 'mensaje' => 'Hubo un error'));
}
