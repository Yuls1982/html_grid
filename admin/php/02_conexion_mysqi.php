<?php
$host = "localhost";
$usuario = "root";
$pass = "918521146";
$nombreBD = "registro_usuarios";
$errorCon = false;

$miConexion = new mysqli($host, $usuario, $usuario, $pass, $nombreBD);

if ($miConexion->connect_error){
    echo "connect error = $miConexion->connect_error <br>";
    $errorCon = true;
}
if ($miConexion == null || $errorCon == true){
    echo"No se ha podido crear el objeto";

}else{
    echo "Odjeto creado";
    echo "<br>server info = $miConexion->host_info <br>";
    echo "host info = $miConexion->server_info <br>";

}
// Crear conexión
$conn = new mysqli($DB_server, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

