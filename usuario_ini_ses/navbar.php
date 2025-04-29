<?php
session_start();

// Verificar si el usuario está autenticado
$usuario_autenticado = isset($_SESSION['usuario_id']);

?>

<ul>
    <li><a href="index.php">index</a></li>
    <li><a href="noticias.php">noticias</a></li>
    <?php if ($usuario_autenticado): ?>
        <li><a href="citaciones.php">citaciones</a></li>
        <li><a href="perfil.php">perfil</a></li>
        <li><a href="cerrar_sesion.php">cerrar sesión</a></li>
    <?php endif; ?>
</ul>

