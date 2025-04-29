<?php
// Incluye el archivo de configuración .env.php
require_once __DIR__ . '/.env.php';

// Conexión a la base de datos usando las constantes definidas en .env.php
$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}


