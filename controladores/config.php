<?php
// Configuración de la base de datos
$servername = "localhost"; // Nombre del servidor de base de datos
$username = "root"; // Nombre de usuario de la base de datos
$password = "918521146"; // Contraseña de la base de datos
$dbname = "ejercicio_final_bd"; // Nombre de la base de datos

// Crear una conexión a la base de datos
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}



