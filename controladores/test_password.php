<?php
$password = '000000'; // Contraseña original

// Generar un hash de la contraseña
$hash = password_hash($password, PASSWORD_BCRYPT);
echo "Contraseña original: $password<br>";
echo "Hash generado: $hash<br>";

// Verificar manualmente la contraseña
if (password_verify($password, $hash)) {
    echo "La verificación de la contraseña fue exitosa.<br>";
} else {
    echo "La verificación de la contraseña falló.<br>";
}
?>
