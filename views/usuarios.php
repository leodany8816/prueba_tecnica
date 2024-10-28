<?php
session_start();
include '../controllers/usuarios.php';

$usuariosController = new UsuariosController();

$usuarios = $usuariosController->obtenerUsuarios();
$data = array();
foreach ($usuarios as $usuario) {
    if ($usuario['id_usuario'] != $_SESSION["id_usuario"]) {
        $data[] = array(
            "nombre" => $usuario['nombre'],
            "telefono" => $usuario['telefono'],
            "correo" => $usuario['correo'],
            "password" => $usuario['password'],
            "rfc" => $usuario['rfc'],
            "notas" => $usuario['notas'],
            "descargar" => '<button type="button" class="btn btn-primary btnUsuario open-modal-btn" id="' . $usuario['id_usuario'] . '">Editar</button>',
            //     "descargar" => '<button type="button" class="btn btn-primary open-modal-btn" data-bs-toggle="modal" data-bs-target="#editarModal" data-variable="'.$usuario['id_usuario'].'">
            //     Editar
            //     </button>'
        );
    }
}

$json_data = array("data" => $data);
echo json_encode($json_data, JSON_UNESCAPED_UNICODE);
