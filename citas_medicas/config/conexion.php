<?php
$host = "localhost";
$user = "root";
$pass = "1234";
$db   = "sistema_citas";

$conexion = new mysqli($host, $user, $pass, $db);

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

$conexion->set_charset("utf8");
?>