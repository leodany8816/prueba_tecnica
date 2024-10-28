<?php
 session_start();
include '../controllers/usuarios.php';
$usuariosController = new UsuariosController();

try {
    $json_data = file_get_contents('php://input');
    $data = json_decode($json_data, true);

    $correo =  $data['correo'];
    $password =  $data['password'];

    $login = $usuariosController->login($correo, $password);

    if ($login != '' && !empty($login)) {
        $_SESSION["autenticado_e"] = md5("usuario_e_true");
        $_SESSION["id_usuario"] = $login['id_usuario'];
        $_SESSION["correo"] = $correo;
        $_SESSION["nombre"] = $login['nombre'];

        echo json_encode(array('status' => true, 'mensaje' => 'Login correcto'));
    } else {
        echo json_encode(array('status' => false, 'mensaje' => 'Login incorrecto'));
    }
} catch (Exception $e) {
    echo json_encode(array('status' => false, 'mensaje' => 'Error en el login'));
}
