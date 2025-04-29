    <?php
    // Incluir archivo de configuración de la base de datos
    include '../controladores/config.php'; // Ajusta según tu configuración

    // Iniciar sesión (si no está iniciada)
    session_start();

    // Inicializar variables de mensaje de error y éxito
    $error_msg = '';
    $success_msg = '';

    // Verificar si el formulario ha sido enviado
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Verificar y obtener datos del formulario
        $nombre = isset($_POST['nombre']) ? mysqli_real_escape_string($conn, $_POST['nombre']) : '';
        $apellidos = isset($_POST['apellidos']) ? mysqli_real_escape_string($conn, $_POST['apellidos']) : '';
        $fecha_nacimiento = isset($_POST['fecha_nacimiento']) ? mysqli_real_escape_string($conn, $_POST['fecha_nacimiento']) : '';
        $direccion = isset($_POST['direccion']) ? mysqli_real_escape_string($conn, $_POST['direccion']) : '';
        $telefono = isset($_POST['telefono']) ? mysqli_real_escape_string($conn, $_POST['telefono']) : '';
        $email = isset($_POST['email']) ? mysqli_real_escape_string($conn, $_POST['email']) : '';
        $sexo = isset($_POST['sexo']) ? mysqli_real_escape_string($conn, $_POST['sexo']) : '';
        $password = isset($_POST['password']) ? mysqli_real_escape_string($conn, $_POST['password']) : '';
        $confirm_password = isset($_POST['confirm_password']) ? mysqli_real_escape_string($conn, $_POST['confirm_password']) : '';

        // Verificar si las contraseñas coinciden
        if ($password !== $confirm_password) {
            $error_msg = "Las contraseñas no coinciden.";
        } else {
            // Verificar si el email ya está registrado
            $query = "SELECT * FROM users_data WHERE email = '$email'";
            $result = $conn->query($query);

            if ($result->num_rows > 0) {
                // El email ya está registrado
                $error_msg = "El email ya está registrado.";
            } else {
                // El email no está registrado, proceder con la inserción
                // Hashear la contraseña antes de almacenarla
                $hashed_password = password_hash(trim($password), PASSWORD_DEFAULT);

                $query_insert = "INSERT INTO users_data (nombre, apellidos, fecha_nacimiento, direccion, telefono, email, sexo, password) 
                                VALUES ('$nombre', '$apellidos', '$fecha_nacimiento', '$direccion', '$telefono', '$email', '$sexo', '$hashed_password')";

                if ($conn->query($query_insert) === TRUE) {
                    $success_msg = "Usuario registrado correctamente. Redirigiendo a la página de inicio de sesión...";
                    // Redireccionar a la página de login después del registro
                    header("Location: login.php");
                    exit();
                } else {
                    $error_msg = "Error al registrar usuario: " . $conn->error;
                }
            }

            // Liberar resultado de la consulta
            $result->free();
        }
    }

    // Cerrar conexión a la base de datos
    $conn->close();
    ?>

