<?php
class ControllerClient {
    public function __construct(){
        session_start();
        if(!$_SESSION['email']){
            header('location:http:../login.php');
            exit();

        }
    }
public function insertUsuario($param){

}
public function modificaUsuario($param){
    
}

public function borrartUsuario($param){
    
}

public function cambiarUsuario($param){
    
    }

}