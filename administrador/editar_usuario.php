<?php
session_start();

// Verificar si el usuario es administrador
if (!isset($_SESSION['usuario']) || $_SESSION['rol'] !== 'admin') {
    header("Location: ../views_usuario/login.php");
    exit;
}

// Conectar a la base de datos
$conn = new mysqli('localhost', 'root', '918521146', 'ejercicio_final_bd');

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener ID del usuario a editar
$id = $_GET['idUser'] ?? null;
if (!$id) {
    die("ID de usuario no especificado.");
}

// Obtener los datos actuales del usuario
$sql = "SELECT * FROM users_login WHERE usuario = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $idLogin);
$stmt->execute();
$result = $stmt->get_result();
$usuario = $result->fetch_assoc();
$stmt->close();

if (!$usuario) {
    die("Usuario no encontrado.");
}

// Procesar formulario de actualización
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['idLogin'];
    $nuevo_usuario = $_POST['usuario'];
    $nuevo_rol = $_POST['rol'];
    $nueva_password = $_POST['password'];

    // Si la contraseña está vacía, mantener la anterior
    if (!empty($nueva_password)) {
        $nueva_password = password_hash($nueva_password, PASSWORD_DEFAULT);
        $sql = "UPDATE users_login SET usuario = ?, password = ?, rol = ? WHERE idLogin = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssi", $nuevo_usuario, $nueva_password, $nuevo_rol, $id);
    } else {
        $sql = "UPDATE users_login SET usuario = ?, rol = ? WHERE idLogin = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssi", $nuevo_usuario, $nuevo_rol, $id);
    }

    if ($stmt->execute()) {
        header("Location: usuarios_administracion.php");
        exit;
    } else {
        echo "Error al actualizar usuario.";
    }
    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../estilos/estilos2.css">
    <title>Editar Usuario</title>
</head>
<body>
    <div class="main-container">
        <header>
            <h1>Editar Usuario</h1>
        </header>

        <main>
            <div class="content">
                <form action="" method="post">
                    <input type="hidden" name="idLogin" value="<?php echo $usuario['idLogin']; ?>">

                    <label for="usuario">Usuario:</label>
                    <input type="text" id="usuario" name="usuario" value="<?php echo htmlspecialchars($usuario['usuario']); ?>" required><br><br>

                    <label for="password">Nueva Contraseña (dejar en blanco para mantener actual):</label>
                    <input type="password" id="password" name="password"><br><br>

                    <label for="rol">Rol:</label>
                    <select id="rol" name="rol">
                        <option value="user" <?php if ($usuario['rol'] == 'user') echo 'selected'; ?>>User</option>
                        <option value="admin" <?php if ($usuario['rol'] == 'admin') echo 'selected'; ?>>Admin</option>
                    </select><br><br>

                    <button type="submit">Actualizar Usuario</button>
                </form>
            </div>
        </main>

        <footer class="footer">
            <!-- Pie de página si lo tienes -->
        </footer>
    </div>
</body>
</html>
