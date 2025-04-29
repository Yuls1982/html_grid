<?php
$servername = "localhost";
$username = "root";
$password = "918521146";
$dbname = "ejercicio_final_bd";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Recibir datos del formulario
$nombre = $_POST['nombre'];
$apellidos = $_POST['apellidos'];
$email = $_POST['email'];
$telefono = $_POST['telefono'];
$fecha_nacimiento = $_POST['fecha_nacimiento'];
$direccion = $_POST['direccion'];
$sexo = $_POST['sexo'];
$usuario = $_POST['usuario'];
$password = $_POST['password']; // Contraseña en texto plano

// Encriptar la contraseña
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Consulta preparada para insertar datos en la tabla users_data
$sql_insert_user_data = "INSERT INTO users_data (nombre, apellidos, email, telefono, fecha_de_nacimiento, direccion, sexo) VALUES (?, ?, ?, ?, ?, ?, ?)";
$stmt_insert_user_data = $conn->prepare($sql_insert_user_data);
$stmt_insert_user_data->bind_param("sssssss", $nombre, $apellidos, $email, $telefono, $fecha_nacimiento, $direccion, $sexo);

if ($stmt_insert_user_data->execute()) {
    // Obtener el ID del usuario insertado
    $last_id = $conn->insert_id;
    
    // Consulta preparada para insertar datos en la tabla users_login, usando la contraseña encriptada
    $sql_insert_user_login = "INSERT INTO users_login (idUser, usuario, password, rol) VALUES (?, ?, ?, 'user')";
    $stmt_insert_user_login = $conn->prepare($sql_insert_user_login);
    $stmt_insert_user_login->bind_param("iss", $last_id, $usuario, $hashed_password);
    
    if ($stmt_insert_user_login->execute()) {
        // Redirigir al usuario al login
        header("Location: login.php");
        exit();
    } else {
        echo "Error: " . $stmt_insert_user_login->error;
    }
} else {
    echo "Error: " . $stmt_insert_user_data->error;
}

$stmt_insert_user_data->close();
$stmt_insert_user_login->close();
$conn->close();

