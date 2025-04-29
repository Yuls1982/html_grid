<?php
    // Importar el archivo de conexión
    require_once 'db_con.php';

    // Se comprueba si hay sesión y si no la hay, se inicia una.
    if(session_status() == PHP_SESSION_NONE){
        session_start();
    }

    // Comprobamos si se ha recibido un formulario a través del método POST
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        // echo "Formulario recibido"; --> ELIMINAR ESTA LÍNEA DE CÓDIGO CUANDO SE HAYA COMPROBADO QUE EL FORMULARIO SE RECIBE CORRECTAMENTE

        // Obtenemos los datos del formulario que se registrarán en users_data
        $nombre = htmlspecialchars($_POST['nombre']);
        $apellidos = htmlspecialchars($_POST['apellidos']);
        $fecha_nacimiento = htmlspecialchars($_POST['fecha_nacimiento']);
        $direccion = htmlspecialchars($_POST['direccion']);
        $telefono = htmlspecialchars($_POST['telefono']);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $sexo = htmlspecialchars($_POST['sexo']);

        // Obtenemos los datos del formulario que se registrarán en users_login
        $username = htmlspecialchars($_POST['usuario']);
        $password = htmlspecialchars($_POST['password']);


        // FALTARÍA POR REALIZAR:
            // 1. VALIDAR LOS DATOS DEL FORMULARIO MEDIANTE EXPRESIONES REGULARES
            // En este apartado será necesario VALIDAR LOS DATOS DEL FORMULARIO MEDIANTE EXPRESIONES REGULARES
            // Por ejemplo, validar qué el nombre y apellidos contengan solo letras, que el email tenga un formato correcto, etc.
            // En caso de que los datos no sean válidos se deberá redirigir al usuario a registro.php (la vista) enviando un mensaje de error.

            // 2. COMPROBAR SI EL NOMBRE DE USUARIO O EL CORREO ELECTRÓNICO YA ESTÁN REGISTRADOS
            // Si los datos son válido SE DEBERÁ COMPROBAR SI el nombre de usuario o el correo electrónico ya están registrados en la base de datos
            // En caso de que el nombre de usuario o el correo electrónico ya estén registrados se deberá redirigir al usuario a registro.php (la vista) enviando un mensaje de error.

            // 3. HASHEAR LA CONTRASEÑA
            // Si los datos son válidos y el nombre de usuario y correo electrónico no están registrados, se deberá hashear la contraseña antes de almacenarla en la base de datos

            // 4. INSERTAR LOS DATOS EN LA BASE DE DATOS
            // Si los datos son válidos y el nombre de usuario y correo electrónico no están registrados, deberás:
                // 4.1 - INTENTAR INSERTAR LOS DATOS EN LA TABLA users_data
                // Si la inserción es correcta, se deberá obtener el id del usuario recién registrado para insertar los datos en la tabla users_login
                // En caso de que la inserción no sea correcta, se deberá redirigir al usuario a registro.php (la vista) enviando un mensaje de error

                // 4.2 - INTENTAR INSERTAR LOS DATOS EN LA TABLA users_login    
                // Si la inserción es correcta, se deberá redirigir al usuario a login.php o index.html (vistas) enviando un mensaje de éxito
                // En caso de que la inserción no sea correcta, se deberá redirigir al usuario a registro.php (la vista) enviando un mensaje de error


            // 5. CERRAR LA CONEXIÓN A LA BASE DE DATOS
            // Al final del script se deberá cerrar la conexión a la base de datos


            /* EJEMPLOS: */
            
                // 1. Redirección a la página principal
                    // header("Location: ../index.html");
                    // exit();

                // 2. Redirección a la página de registro con mensaje de error
                    // $_SESSION['error_msg'] = "Error al registrar usuario.";
                    // header("Location: registro.php");
                    // exit();    

                // 3. Redirección a la página principal con mensaje de éxito
                    // $_SESSION['success_msg'] = "Usuario registrado correctamente.";
                    // header("Location: ../index.html");
                    // exit();

                // 4. Validar los datos del formulario creando expresiones regulares
                    // define('REGEX_NOMBRE', '/^[A-Za-zÁÉÍÓÚÜÑáéíóúüñ]{3,15}( [A-Za-zÁÉÍÓÚÜÑáéíóúüñ]{3,15})?$/');  
                    // if (!preg_match(REGEX_NOMBRE, $nombre)) {
                    //     $_SESSION['error_msg'] = "El nombre introducido no es válido.";
                    //     header("Location: registro.php");
                    //     exit();  
                    // }
                    // Nota: Se deberá crear una expresión regular para cada campo del formulario
                    // Nota: Se podría realizar una función que compruebe todos los campos del formulario
                    // y devuelva un array con los mensajes de error de cada campo. En caso de que no existiese ningún error, devolvería un array vacío.
                    // Se redirigiría al usuario a registro.php con los mensajes de error o se continuaría con el registro dependiendo del resultado de la función.

                // 5. Hashear la contraseña
                    // $hashed_password = password_hash(trim($password), PASSWORD_DEFAULT);
                    
                    
                // 6. Realizar una consulta a la base de datos para comprobar si el email existe
                    // $query = "SELECT * FROM users_data WHERE email = '$email'";
                    // $result = $conn->query($query);

                    // if ($result->num_rows > 0) {
                    //     // El email ya está registrado
                    //      $_SESSION['error_msg'] = "El email ya está registrado.";
                    //      header("Location: registro.php");
                    //      exit();
                    // } 

                // 7. Inserción de los datos en user_data con mysqli + obtención del id registrado
                    // $query_insercion = "INSERT INTO users_data (nombre, apellidos, fecha_nacimiento, direccion, telefono, email, sexo) VALUES (?, ?, ?, ?, ?, ?, ?)";
                    // $stmt = $conn->prepare($query_insercion);
                    // $stmt->bind_param("sssssss", $nombre, $apellidos, $fecha_nacimiento, $direccion, $telefono, $email, $sexo);

                    // if ($stmt->execute()) {
                        //$id_usuario = $conn->insert_id;
                        // Se continuaría con la inserción de los datos en la tabla users_login
                    // } else {
                        // $_SESSION['error_msg'] = "Error al registrar usuario: " . $conn->error;
                        // header("Location: registro.php");
                        // exit();
                    // }

                // 8. Cerrar la conexión a la base de datos
                    // $conn->close();
       
    }

?>