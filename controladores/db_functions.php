<?php
require 'db_con.php';

function obtener_usuario_por_email($email) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM users_data WHERE email = ?");
    $stmt->execute([$email]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function registrar_usuario($data) {
    global $pdo;
    try {
        $pdo->beginTransaction();
        $stmt = $pdo->prepare("INSERT INTO users_data (nombre, apellidos, email, telefono, fecha_nacimiento, direccion, sexo) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$data['nombre'], $data['apellidos'], $data['email'], $data['telefono'], $data['fecha_nacimiento'], $data['direccion'], $data['sexo']]);
        $idUser = $pdo->lastInsertId();

        $stmt = $pdo->prepare("INSERT INTO users_login (idUser, usuario, password, rol) VALUES (?, ?, ?, 'user')");
        $stmt->execute([$idUser, $data['usuario'], password_hash($data['password'], PASSWORD_BCRYPT)]);
        $pdo->commit();
        return true;
    } catch (Exception $e) {
        $pdo->rollBack();
        return false;
    }
}

function obtener_noticias() {
    global $pdo;
    $stmt = $pdo->query("SELECT noticias.*, users_data.nombre, users_data.apellidos FROM noticias INNER JOIN users_data ON noticias.idUser = users_data.idUser ORDER BY fecha DESC");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function obtener_citas($idUser) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM citas WHERE idUser = ? ORDER BY fecha_cita DESC");
    $stmt->execute([$idUser]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function agregar_cita($idUser, $fecha_cita, $motivo_cita) {
    global $pdo;
    $stmt = $pdo->prepare("INSERT INTO citas (idUser, fecha_cita, motivo_cita) VALUES (?, ?, ?)");
    return $stmt->execute([$idUser, $fecha_cita, $motivo_cita]);
}

function eliminar_cita($idCita) {
    global $pdo;
    $stmt = $pdo->prepare("DELETE FROM citas WHERE idCita = ?");
    return $stmt->execute([$idCita]);
}

