<?php
include './controladores/DB.php';

class ControllerLogin {
    public function __construct() {
        session_start();
    }

    public function insertarUsuario($nombre, $email, $contrasena) {
        $result = $this->buscarUsuario($email);
        if ($result[0]) {
            header('location:registro.php?registro=ko');
            exit();
        } else {
            DB::insertar($nombre, $email, $contrasena);
            $_SESSION["usuario"] = ['email' => $email, 'nombre' => $nombre]; // Ajusta según la estructura de tu sesión
            header('location:./admin/control_panel.php?registro=ok');
            exit();
        }
    }

    public function login($email, $contrasena) {
        $login = $this->comprobarUsuario($email, $contrasena);
        if ($login[0]) {
            $_SESSION["usuario"] = ['email' => $email, 'nombre' => $login[1]['nombre']]; // Ajusta según la estructura de tu sesión
            header('location:./admin/control_panel.php?login=ok');
        } else {
            header('location:login.php?login=ko');
            exit();
        }
    }

    public function comprobarUsuario($email, $contrasena = null) {
        $found = false;
        $result = DB::comprobarUsuario($email);
        if (count($result) === 1) {
            if ($email === $result[0]->email && password_verify($contrasena, $result[0]->contrasena)) {
                $found = true;
            }
        }
        return [$found, ['id' => $result[0]->id, 'nombre' => $result[0]->nombre]]; // Ajusta según la estructura de tu retorno
    }

    public function buscarUsuario($email) {
        $found = false;
        $result = DB::comprobarUsuario($email);
        if (count($result) === 1) {
            $found = true;
        }
        return [$found];
    }
}

