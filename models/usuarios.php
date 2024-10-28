<?php
include '../includes/funciones.php';

class Usuarios
{
    /**
     * traer a todos los usuarios
     */
    public function selectUsuarios()
    {
        $usuarios = informacion_registros_query("SELECT * FROM usuarios");
        return $usuarios;
    }

    /**
     * Login
     */
    public function login($correo, $pass){
        $usuario = informacion_registro_query("SELECT * FROM usuarios WHERE correo = '$correo' AND password = md5('$pass')");
        return $usuario;
    }

    /**
     * Insertar nuevo usuario
     */
    public function newUsuario($nombre, $telefono, $correo, $pass, $rfc, $notas){   
        $atributos = array(
            "nombre" => $nombre,
            "telefono" => $telefono,
            "correo" => $correo,
            "password" => md5($pass),
            "rfc" => $rfc,
            "notas" => $notas
        );
        $id = insertar_bd('usuarios', $atributos);
        return $id;
    }

    /**
     * ver la informacion del usuario que se va editar
     */
    public function viewUsr($id){
        $usuario = informacion_registro_query("SELECT * FROM usuarios WHERE id_usuario = '$id'");
        return $usuario;
    }

    /**
     * actualizar los datos del usuario
     */
    public function editUsr($id, $nombre, $telefono, $correo, $pass, $rfc, $notas){
        $atributos = array(
            "nombre" => $nombre,
            "telefono" => $telefono,
            "correo" => $correo,
            "password" => md5($pass),
            "rfc" => $rfc,
            "notas" => $notas,
        );
        actualizar_bd('usuarios', $atributos, 'id_usuario', $id);
        return "a";
    }
}
