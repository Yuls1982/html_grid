<?php
class DB {
    // Método para insertar un nuevo usuario en la base de datos
    public static function insertar($nombre, $email, $contrasena) {
        $conn = self::getConnection(); // Obtener conexión a la base de datos

        // Hash de la contraseña
        $hashed_password = password_hash($contrasena, PASSWORD_DEFAULT);

        // Preparar la consulta de inserción
        $query = "INSERT INTO usuarios (nombre, email, contrasena) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sss", $nombre, $email, $hashed_password);

        // Ejecutar la consulta
        if (!$stmt->execute()) {
            throw new Exception("Error al insertar usuario: " . $stmt->error);
        }

        // Cerrar statement y conexión
        $stmt->close();
        $conn->close();
    }

    // Método para comprobar si un usuario existe en la base de datos por su email
    public static function comprobarUsuario($email) {
        $conn = self::getConnection(); // Obtener conexión a la base de datos

        // Preparar la consulta
        $query = "SELECT id, nombre, email, contrasena FROM usuarios WHERE email = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $email);

        // Ejecutar la consulta
        if (!$stmt->execute()) {
            throw new Exception("Error al comprobar usuario: " . $stmt->error);
        }

        // Vincular el resultado a variables
        $stmt->bind_result($id, $nombre, $email, $contrasena);

        // Obtener resultados
        $usuarios = array();
        while ($stmt->fetch()) {
            $usuario = new stdClass();
            $usuario->id = $id;
            $usuario->nombre = $nombre;
            $usuario->email = $email;
            $usuario->contrasena = $contrasena; // Ajusta según la estructura de tu tabla
            $usuarios[] = $usuario;
        }

        // Cerrar statement y conexión
        $stmt->close();
        $conn->close();

        return $usuarios;
    }

    // Método para buscar un usuario por ID
    public static function buscarID($id) {
        $conn = self::getConnection(); // Obtener conexión a la base de datos

        // Preparar la consulta
        $query = "SELECT id, nombre, email, rol FROM usuarios WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $id); // "i" indica que $id es un entero

        // Ejecutar la consulta
        if (!$stmt->execute()) {
            throw new Exception("Error al buscar usuario por ID: " . $stmt->error);
        }

        // Vincular el resultado a variables
        $stmt->bind_result($id, $nombre, $email, $rol);

        // Obtener resultados
        $stmt->fetch();

        // Crear un objeto usuario con los resultados
        $usuario = new stdClass();
        $usuario->id = $id;
        $usuario->nombre = $nombre;
        $usuario->email = $email;
        $usuario->rol = $rol;

        // Cerrar statement y conexión
        $stmt->close();
        $conn->close();

        return $usuario;
    }

    // Método para obtener todos los usuarios
    public static function verTodos() {
        $conn = self::getConnection(); // Obtener conexión a la base de datos

        // Preparar la consulta
        $query = "SELECT id, nombre, email, rol FROM usuarios";
        $result = $conn->query($query);

        // Verificar si hay resultados
        if ($result->num_rows > 0) {
            $usuarios = array();

            // Recorrer resultados y guardar en un array de objetos usuario
            while ($row = $result->fetch_object()) {
                $usuario = new stdClass();
                $usuario->id = $row->id;
                $usuario->nombre = $row->nombre;
                $usuario->email = $row->email;
                $usuario->rol = $row->rol;
                $usuarios[] = $usuario;
            }

            // Liberar resultados y cerrar conexión
            $result->free();
            $conn->close();

            return $usuarios;
        } else {
            // No hay usuarios encontrados, cerrar conexión y devolver vacío
            $conn->close();
            return array();
        }
    }

    // Método para obtener conexión a la base de datos
    private static function getConnection() {
        // Configuración de conexión a la base de datos
        $servername = "localhost";
        $username = "root";
        $password = "918521146";
        $dbname = "ejercicio_final_bd";

        // Crear conexión
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Verificar conexión
        if ($conn->connect_error) {
            throw new Exception("Conexión fallida: " . $conn->connect_error);
        }

        return $conn;
    }
}

