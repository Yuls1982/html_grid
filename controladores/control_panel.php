<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Panel de Control</title>
</head>
<body>
    Bienvenido:
    <?php
    // Incluir el archivo que contiene la clase DB
    include '../DB.php';

    // Iniciar sesión si no está iniciada
    session_start();

    // Obtener datos del usuario de la sesión (ejemplo)
    $datos = $_SESSION['usuario'];

    // Obtener el objeto usuario usando DB::buscarID()
    $usuario = DB::buscarID($datos['id']);

    // Verificar si se encontró un usuario con ese ID
    if ($usuario !== null) {
        echo $usuario->nombre;

        // Verificar el rol del usuario para mostrar enlaces adicionales solo si es admin
        if ($usuario->rol == 'admin') {
            ?>
            <a href="../router.php?lu=true">Listado de usuarios</a>
            <?php
        }
    } else {
        echo "Usuario no encontrado.";
    }
    ?>
    <ul>
        <li>Datos personales</li>
        <li>Citas</li>
    </ul>
</body>
</html>
