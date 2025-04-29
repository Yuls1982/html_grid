<?php
require 'db_con.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario = $_POST['usuario'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users_login WHERE usuario = ?");
    $stmt->execute([$usuario]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        session_start();
        $_SESSION['idUser'] = $user['idUser'];
        $_SESSION['rol'] = $user['rol'];
        header("Location: ../index.php");
    } else {
        echo "Usuario o contraseña incorrectos";
    }
}

