<?php
// db.php - Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "Admin", "bus");

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}
?>
