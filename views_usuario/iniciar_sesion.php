        <?php
        session_start();

        // Verificar si ya hay una sesión activa
        if (isset($_SESSION['usuario'])) {
            // Verificar el rol del usuario
            if ($_SESSION['rol'] === 'admin') {
                header("Location: ../administrador/index_admin.php"); // Redirigir a página de administrador
            } else {
                header("Location: ../usuario_ini_ses/index.php"); // Redirigir a página de usuario normal
            }
            exit();
        }

        // Conexión a la base de datos
        include '../controladores/config.php'; // Ajusta según tu configuración

        $error_msg = '';

        // Verificar si se envió el formulario
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Verificar y obtener datos del formulario
        // Verificar y obtener datos del formulario
        $usuario = isset($_POST['usuario']) ? mysqli_real_escape_string($conn, $_POST['usuario']) : '';
        $password = isset($_POST['password']) ? mysqli_real_escape_string($conn, $_POST['password']) : '';

        var_dump($usuario, $password); // Verificar qué valores están recibiendo $usuario y $password

        // Verificar si el usuario existe en la base de datos
        $query = "SELECT * FROM users_data WHERE usuario = '$usuario'";
        $result = $conn->query($query);

        if (!$result) {
            // Manejo de errores de consulta SQL
            die("Error en la consulta: " . mysqli_error($conn));
        }

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            
            // Verificar la contraseña utilizando password_verify
            $hashed_password = $user['password'];

            if (password_verify(trim($password), $hashed_password)) {
                // Iniciar sesión exitosa
                $_SESSION['idUser'] = $user['id'];
                $_SESSION['usuario'] = $user['usuario'];
                $_SESSION['rol'] = $user['rol']; // Guardar el rol del usuario en la sesión
                
                // Redirigir según el rol del usuario
                if ($_SESSION['rol'] == 'admin') {
                    header("Location: ../administrador/index_admin.php"); // Página de administrador
                } else {
                    header("Location: ../usuario_ini_ses/index.php"); // Página de usuario normal
                }
                exit();
            } else {
                $error_msg = "Contraseña incorrecta.";
            }
        } else {
            $error_msg = "No existe una cuenta con ese usuario.";
        }

            // Liberar resultado de la consulta
            $result->free();
        }

        // Cerrar conexión a la base de datos
        $conn->close();
        ?>
        <!DOCTYPE html>
        <html lang="es">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="../estilos/estilos2.css">
            <title>Iniciar Sesión</title>
        </head>
        <body>
        <div class="container">
            <h2>Iniciar Sesión</h2>
            <?php if (!empty($error_msg)) : ?>
                <div class="error"><?php echo $error_msg; ?></div>
            <?php endif; ?>
            <form method="post" action="iniciar_sesion.php">
                <label for="usuario">Usuario:</label>
                <input type="text" id="usuario" name="usuario" required><br>
                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password" required><br>
                <input type="submit" value="Iniciar Sesión">
            </form>
        </div>
        </body>
        </html>
