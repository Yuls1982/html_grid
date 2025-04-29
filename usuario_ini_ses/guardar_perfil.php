
<?php
session_start();
include '../controladores/config.php'; // Incluye tu archivo de configuración de la base de datos

// Validar si el usuario está autenticado, de lo contrario redirigirlo al login
if (!isset($_SESSION['usuario_id'])) {
    header('Location: ../../views_usuario/login.php');
    exit;
}

// Obtener los datos enviados desde el formulario
$nombre = isset($_POST['nombre']) ? $_POST['nombre'] : '';
$apellidos = isset($_POST['apellidos']) ? $_POST['apellidos'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : '';
$nueva_contrasena = isset($_POST['contrasena']) ? $_POST['contrasena'] : '';

if (!empty($nueva_contrasena)) {
    // Hash de la nueva contraseña
    $hash_contrasena = password_hash($nueva_contrasena, PASSWORD_DEFAULT);

    // Actualizar la contraseña en la base de datos
    $query = "UPDATE users_data SET password = ? WHERE id = ?";

    if ($stmt = $conn->prepare($query)) {
        $stmt->bind_param('si', $hash_contrasena, $_SESSION['usuario_id']); // 'si' indica tipos de datos: string, integer
        
        // Debug: Check if parameters are correct
        echo "Hash de la contraseña: $hash_contrasena <br>";
        echo "ID del usuario: " . $_SESSION['usuario_id'] . "<br>";
        
        if ($stmt->execute()) {
            // Contraseña actualizada correctamente
            header('Location: perfil.php?mensaje=Contraseña actualizada correctamente.');
            exit;
        } else {
            // Error al ejecutar la consulta
            echo "Error al ejecutar la consulta para actualizar la contraseña: " . $stmt->error;
        }
        $stmt->close();
    } else {
        // Error al preparar la consulta
        echo "Error al preparar la consulta: " . $conn->error;
    }
} else {
    // Redirigir a la página de perfil con un mensaje de error
    header('Location: perfil.php?error=No se proporcionó una nueva contraseña.');
    exit;
}

$conn->close();

