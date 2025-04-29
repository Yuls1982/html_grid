<?php
include 'DB.php';
session_start();

if (isset($_GET['lu']) && $_GET['lu'] == 'true') {
    $usuarios = DB::verTodos();
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Listado de Usuarios</title>
</head>
<body>
    <h1>Listado de Usuarios</h1>
    <?php if (isset($usuarios) && !empty($usuarios)) { ?>
        <table border="1">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Rol</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($usuarios as $usuario) { ?>
                    <tr>
                        <td><?php echo $usuario->id; ?></td>
                        <td><?php echo $usuario->nombre; ?></td>
                        <td><?php echo $usuario->email; ?></td>
                        <td><?php echo $usuario->rol; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <p>No hay usuarios para mostrar.</p>
    <?php } ?>
</body>
</html>
