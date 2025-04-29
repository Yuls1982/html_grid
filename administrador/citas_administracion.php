<?php
session_start();

// Verificar si el usuario es administrador
if (!isset($_SESSION['usuario']) || $_SESSION['rol'] !== 'admin') {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../estilos/estilos2.css">
    <title>Administración de Citas</title>
</head>
<body>
<div class="main-container">
        <header>
            <div class="images-header">
                <div class="bienvenido">
                    <div class="bisel-abajo">       
                        <nav class="menu">
                            <div class="lista-content">
                                <ul class="lista">
                                    <li><a href="index_admin.php">Inicio</a></li>
                                    <li><a href="#" class="activo">Citaciones</a></li>
                                    <li><a href="noticias_administracion.php" class="activo">Noticias</a></li>
                                    <li><a href="registrar_usuario.php">Registro</a></li>
                                    <li><a href="usuario_administracion.php"> Adminitracion Usuario</a></li>
                                    <li><a href="usuario_list.php">Lista usuarios</a></li>
                                    <li><a href="cerrar_sesion.php" >cerrar sesión</a></li>
                                </ul>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </header>
        <main>
            <div class="content">
                <h1>Administración de Citas</h1>
                <!-- Aquí agregare la funcionalidad para crear, ver, modificar y borrar citas -->
            </div>
        </main>

        <footer class="footer">
            <!-- Pie de página si lo tienes -->
        </footer>
    </div>
</body>
</html>
