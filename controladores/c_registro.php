<?php
require 'db_functions.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = [
        'nombre' => $_POST['nombre'],
        'apellidos' => $_POST['apellidos'],
        'email' => $_POST['email'],
        'telefono' => $_POST['telefono'],
        'fecha_nacimiento' => $_POST['fecha_nacimiento'],
        'direccion' => $_POST['direccion'],
        'sexo' => $_POST['sexo'],
        'rol' => $_POST['rol'],
        'usuario' => $_POST['usuario'],
        'password' => $_POST['password']

    ];


    if (registrar_usuario($data)) {
        echo "Registro exitoso";
        header("Location: ../views/login.php");
    } else {
        echo "Error en el registro";
    }
}
