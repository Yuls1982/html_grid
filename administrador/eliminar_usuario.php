<?php
session_start();

// Verificar si el usuario es administrador
if (!isset($_SESSION['usuario']) || $_SESSION['rol'] !== 'admin') {
    header("Location: ../views_usuario/login.php");
    exit;
}

// Verificar si se ha recibido el ID del usuario a eliminar
if (!isset($_GET['id'])) {
    header("Location: usuarios-administracion.php");
    exit;
}

// Conectar a la base de datos
$conn = new mysqli('localhost', 'root', '918521146', 'ejercicio_final_bd');

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Preparar y ejecutar la eliminación del usuario
$id = $_GET['id'];
$sql = "DELETE FROM usuarios WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->close();
$conn->close();

// Redirigir de vuelta a la página de administración de usuarios
header("Location: usuarios-administracion.php");
exit;
