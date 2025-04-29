<?php
// Incluir archivo de configuración de la base de datos
include '../controladores/config.php'; // Ajusta según tu configuración

// Iniciar sesión
session_start();

// Inicializar variable de mensaje de error
$error_msg = '';

// Verificar si el formulario ha sido enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar y obtener datos del formulario
    $usuario = isset($_POST['usuario']) ? mysqli_real_escape_string($conn, trim($_POST['usuario'])) : '';
    $password = isset($_POST['password']) ? trim($_POST['password']) : '';

    if (!empty($usuario) && !empty($password)) {
        // Buscar al usuario en la tabla users_login
        $query = "SELECT idUser, idLogin, usuario, password FROM users_login WHERE usuario = ?";
        $stmt = $conn->prepare($query);

        if ($stmt) {
            $stmt->bind_param('s', $usuario);
            $stmt->execute();
            $result = $stmt->get_result();

            // Si el número de filas es mayor a 0, muestra el resultado
            if ($result->num_rows > 0) {
                $user = $result->fetch_assoc();
                
                // Verifica la contraseña
                if (!empty($user['password'])) {
                    $hashed_password = $user['password'];

                    if (password_verify($password, $hashed_password)) {
                        // Iniciar sesión exitosa
                        $_SESSION['idUser'] = $user['idUser'];
                        $_SESSION['usuario'] = $user['usuario'];
                        
                        // Verificar si el usuario es un administrador
                        // Asume que hay un campo de rol o similar para determinar si el usuario es admin
                        $query_role = "SELECT rol FROM users_login WHERE idUser = ?";
                        $stmt_role = $conn->prepare($query_role);
                        $stmt_role->bind_param('i', $user['idUser']);
                        $stmt_role->execute();
                        $role_result = $stmt_role->get_result();
                        $role = $role_result->fetch_assoc();

                        if ($role['rol'] == 'admin') {
                            $_SESSION['rol'] = 'admin';
                            header("Location: ../administrador/index_admin.php");
                        } else {
                            $_SESSION['rol'] = 'user';
                            header("Location: ../usuario_ini_ses/index.php");
                        }
                        exit();
                    } else {
                        $error_msg = "Contraseña incorrecta.";
                    }
                } else {
                    $error_msg = "Error: El usuario no tiene una contraseña registrada.";
                }
            } else {
                $error_msg = "No existe una cuenta con ese usuario.";
            }
            $stmt->close();
        } else {
            $error_msg = "Error en la consulta: " . $conn->error;
        }
    } else {
        $error_msg = "Por favor, complete todos los campos.";
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="../estilos/estilos2.css">
</head>
<body>
<div class="main-container">
    <header>
        <nav class="menu">
            <ul class="lista">
                <li><a href="../index.html">Inicio</a></li>
                <li><a href="noticias.php">Noticias</a></li>
                <li><a href="registro.php">Registro</a></li>
                <li><a href="#" class="activo">Login</a></li>
            </ul>
        </nav>
    </header>

    <div class="container">
        <h2>Iniciar Sesión</h2>
        <?php if (!empty($error_msg)) : ?>
            <div class="error"> <?php echo htmlspecialchars($error_msg); ?> </div>
        <?php endif; ?>
        <form action="login.php" method="post">
            <label for="usuario">Usuario:</label>
            <input type="text" id="usuario" name="usuario" required><br><br>

            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" required><br><br>

            <input type="submit" value="Iniciar Sesión">
        </form>
    </div> 
</div>
</body>
</html>
