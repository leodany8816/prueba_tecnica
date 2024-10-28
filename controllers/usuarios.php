<?php
include '../models/usuarios.php';

class UsuariosController
{

    private $usuariosModel;

    public function __construct()
    {
        $this->usuariosModel = new Usuarios();
    }

    function obtenerUsuarios()
    {
        return $this->usuariosModel->selectUsuarios();
    }

    function newUsuario($nombre, $telefono, $correo, $pass, $rfc, $notas)
    {
        return $this->usuariosModel->newUsuario($nombre, $telefono, $correo, $pass, $rfc, $notas);
    }

    function login($correo, $pass){
        return $this->usuariosModel->login($correo, $pass);
    }

    function viewUsr($id){
        return $this->usuariosModel->viewUsr($id);
    }

    function editUsr($id, $nombre, $telefono, $correo, $pass, $rfc, $notas){
        return $this->usuariosModel->editUsr($id, $nombre, $telefono, $correo, $pass, $rfc, $notas);
    }
}
