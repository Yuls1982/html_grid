<?php


class ControllerClient {
    public function __construct(){
        session_start();
        if(!$_SESSION['email']){
            header('location:http:../login.php');
            exit();
        }
}
public function insertaUsuario($param){

}
public function  modificarUsuario($param){

}
public function borrarUsuario($param){

}
public function cambiarRolUsuario($param){

    }
}
