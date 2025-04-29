<?php


class ControllerAdmin {
    public function __construct(){
        session_start();
        if(isset($_SESSION['usuario'])){
            // en la variable se almacena el nombre 0

        if($_SESSION['usuario'][2]!="admin"){
            header('location:./login.php');
            exit();
        }else{
            $this->listadoUsuario();
            
        }
    }
}
public function listadoUsuario(){
echo 'ey';
$result = DB::verTodos();
$_SESSION['listadoUsers']=$result;
header('location:./admin/usuario_list.php   ');
}
public function insertaUsuario($nombre,$email,$contraseña){

}
public function  modificarUsuario($email){

}
public function borrarUsuario($param){

}
public function cambiarRolUsuario($param){
}

public function cambiarContraseñaUsuario($param){
}
}
