                    <?php
                    include '../controladores/config.php'; // Ajustar según tu configuración

                    $servername = "localhost"; // Nombre del servidor de base de datos
                    $username = "root"; // Nombre de usuario de la base de datos
                    $password = "918521146"; // Contraseña de la base de datos
                    $dbname = "ejercicio_final_bd"; // Nombre de la base de datos

                    // Crear conexión a la base de datos
                    $conn = new mysqli($servername, $username, $password, $dbname);

                    // Verificar conexión
                    if ($conn->connect_error) {
                        die("Conexión fallida: " . $conn->connect_error);
                    }

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
                        $usuario = isset($_POST['usuario']) ? mysqli_real_escape_string($conn, $_POST['usuario']) : '';
                        $password = isset($_POST['password']) ? mysqli_real_escape_string($conn, $_POST['password']) : '';
                        $confirm_password = isset($_POST['confirm_password']) ? mysqli_real_escape_string($conn, $_POST['confirm_password']) : '';

                        if ($password !== $confirm_password) {
                            $error_msg = "Las contraseñas no coinciden.";
                        } else {
                            $query = "SELECT * FROM usuarios WHERE email = '$email'";
                            $result = $conn->query($query);

                            if ($result->num_rows > 0) {
                                $error_msg = "El email ya está registrado.";
                            } else {
                                // El email no está registrado, proceder con la inserción
                                // Hashear la contraseña antes de almacenarla
                                $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                                // Iniciar una transacción
                                $conn->begin_transaction();

                                try {
                                    // Insertar datos en la tabla usuarios
                                    $query_insert_usuarios = "INSERT INTO usuarios (nombre, apellidos, fecha_nacimiento, direccion, telefono, email, sexo) 
                                                            VALUES (?, ?, ?, ?, ?, ?, ?)";
                                    $stmt_insert_usuarios = $conn->prepare($query_insert_usuarios);
                                    $stmt_insert_usuarios->bind_param("sssssss", $nombre, $apellidos, $fecha_nacimiento, $direccion, $telefono, $email, $sexo);
                                    $stmt_insert_usuarios->execute();

                                    // Insertar datos en la tabla user_login
                                    $query_insert_user_login = "INSERT INTO users_login (email, password) VALUES (?, ?)";
                                    $stmt_insert_user_login = $conn->prepare($query_insert_user_login);
                                    $stmt_insert_user_login->bind_param("ss", $email, $hashed_password);
                                    $stmt_insert_user_login->execute();

                                    // Confirmar la transacción
                                    $conn->commit();

                                    $success_msg = "Usuario registrado correctamente. <a href='login.php'>Inicia sesión aquí</a>.";
                                } catch (mysqli_sql_exception $exception) {
                                    // En caso de error, deshacer la transacción
                                    $conn->rollback();
                                    $error_msg = "Error al registrar usuario: " . $exception->getMessage();
                                }

                                // Liberar los statement resources
                                $stmt_insert_usuarios->close();
                                $stmt_insert_user_login->close();
                            }

                            // Liberar resultado de la consulta
                            $result->free();
                        }
                    }

                    // Cerrar conexión a la base de datos
                    $conn->close();
                    ?>

                    <!DOCTYPE html>
                    <html lang="es">
                    <head>
                        <meta charset="UTF-8">
                        <title>Registro de Usuario</title>
                        <link rel="stylesheet" href="../estilos/estilos2.css">
                    </head>
                    <body>
                        <div class="container">
                            <h2>Registro de Usuario</h2>
                            <?php if (!empty($error_msg)) : ?>
                                <div class="error"><?php echo $error_msg; ?></div>
                            <?php endif; ?>
                            <?php if (!empty($success_msg)) : ?>
                                <div class="success"><?php echo $success_msg; ?></div>
                            <?php endif; ?>
                            <!-- Incluir el formulario de registro -->
                            <?php include 'registro_form.php'; ?>
                        </div>
                    </body>
                    </html>
