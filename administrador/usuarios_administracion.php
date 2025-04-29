<?php
session_start();

// Verificar si el usuario es administrador
if (!isset($_SESSION['usuario']) || $_SESSION['rol'] !== 'admin') {
    header("Location: ../views_usuario/login.php");
    exit;
}

// Conectar a la base de datos
$servername = "localhost";
$username = "root";
$password = "918521146";
$dbname = "ejercicio_final_bd";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Manejar la creación de usuario
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['crear'])) {
    $usuario = trim($_POST['usuario']);
    $password = trim($_POST['password']);
    $rol = trim($_POST['rol']);

    // Validar los datos antes de insertarlos
    if (!empty($usuario) && !empty($password) && !empty($rol) && strlen($password) >= 6) {
        // Hash de la contraseña
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Preparar la consulta SQL para insertar un nuevo usuario
        $sql = "INSERT INTO users_login (usuario, password, rol) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $usuario, $hashed_password, $rol);

        if ($stmt->execute()) {
            header("Location: usuarios_administracion.php");
            exit;
        } else {
            echo "Error al registrar usuario: " . $conn->error;
        }
        $stmt->close();
    } else {
        echo "Por favor, completa todos los campos y asegúrate de que la contraseña tenga al menos 6 caracteres.";
    }
}

// Obtener lista de usuarios
$sql = "SELECT idLogin, usuario, rol FROM users_login";
$result = $conn->query($sql);

if (!$result) {
    die("Error en la consulta: " . $conn->error);
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../estilos/estilos2.css">
    <title>Administración de Usuarios</title>
</head>
<body>
    <div class="main-container">
        <header>
            <nav class="menu">
                <ul class="lista">
                    <li><a href="index_admin.php">Inicio</a></li>
                    <li><a href="citas_administracion.php">Citaciones</a></li>
                    <li><a href="noticias_administracion.php">Noticias</a></li>
                    <li><a href="registrar_usuario.php">Registro</a></li>
                    <li><a href="usuarios_administracion.php" class="activo">Administración de Usuarios</a></li>
                    <li><a href="usuarios_lista.php">Lista de Usuarios</a></li>
                    <li><a href="cerrar_sesion.php">Cerrar Sesión</a></li>
                </ul>
            </nav>
        </header>

        <main>
            <div class="content">
                <h1>Administración de Usuarios</h1>
                <!-- Formulario para crear usuario -->
                <form action="usuarios_administracion.php" method="post">
                    <label for="usuario">Usuario:</label>
                    <input type="text" id="usuario" name="usuario" required><br><br>
                    <label for="password">Contraseña:</label>
                    <input type="password" id="password" name="password" required><br><br>
                    <label for="rol">Rol:</label>
                    <select id="rol" name="rol">
                        <option value="user">User</option>
                        <option value="admin">Admin</option>
                    </select><br><br>
                    <button type="submit" name="crear">Crear Usuario</button>
                </form>

                <br>
                <h2>Lista de Usuarios</h2>
                <table>
                    <tr>
                        <th>ID</th>
                        <th>Usuario</th>
                        <th>Rol</th>
                        <th>Acciones</th>
                    </tr>
                    <?php while ($row = $result->fetch_assoc()) : ?>
                        <tr>
                            <td><?php echo $row['idLogin']; ?></td>
                            <td><?php echo $row['usuario']; ?></td>
                            <td><?php echo $row['rol']; ?></td>
                            <td>
                                <a href="editar_usuario.php?id=<?php echo $row['idLogin']; ?>">Editar</a> |
                                <a href="eliminar_usuario.php?id=<?php echo $row['idLogin']; ?>" onclick="return confirm('¿Seguro que deseas eliminar este usuario?');">Eliminar</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </table>
            </div>
        </main>
    </div>
</body>
</html>
