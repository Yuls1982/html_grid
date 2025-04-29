<?php
// Incluir archivo de configuración de la base de datos
include '../controladores/config.php';

// Datos del usuario
$usuario = 'Yuli222';
$nombre = 'pepi';
$apellidos = 'mmmmmmmm';
$fecha_nacimiento = '1982-05-04';
$direccion = 'c/ bla bla bla bla';
$telefono = '665559685';
$email = 'yulie@hotmail.com';
$sexo = 'femenino';
$password = '000000';
$rol = 'admin';

// Hashear la contraseña
$hashed_password = password_hash($password, PASSWORD_BCRYPT);

// Insertar en users_data
$query1 = "INSERT INTO `users_data` (`usuario`, `nombre`, `apellidos`, `fecha_nacimiento`, `direccion`, `telefono`, `email`, `sexo`) 
           VALUES ('$usuario', '$nombre', '$apellidos', '$fecha_nacimiento', '$direccion', '$telefono', '$email', '$sexo')";

if ($conn->query($query1) === TRUE) {
    // Obtener el idUser generado
    $idUser = $conn->insert_id;
    
    // Insertar en users_login
    $query2 = "INSERT INTO `users_login` (`idUser`, `usuario`, `password`, `rol`) 
               VALUES ('$idUser', '$usuario', '$hashed_password', '$rol')";
    
    if ($conn->query($query2) === TRUE) {
        echo "Usuario insertado correctamente.";
    } else {
        echo "Error: " . $query2 . "<br>" . $conn->error;
    }
} else {
    echo "Error: " . $query1 . "<br>" . $conn->error;
}

// Cerrar conexión
$conn->close();

