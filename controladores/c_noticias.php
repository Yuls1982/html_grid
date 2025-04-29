<?php
require 'db_con.php';

function obtener_noticias() {
    global $pdo;
    $stmt = $pdo->query("SELECT noticias.*, users_data.nombre, users_data.apellidos FROM noticias INNER JOIN users_data ON noticias.idUser = users_data.idUser ORDER BY fecha DESC");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
