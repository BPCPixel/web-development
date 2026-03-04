<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: index.php");
    exit();
}

require 'conexion.php';

$nombre = $_POST['nombre'];
$creditos = $_POST['creditos'];
$carrera_id = $_POST['carrera_id'];

$sql = "INSERT INTO materias (nombre, creditos, carrera_id)
        VALUES ('$nombre', '$creditos', '$carrera_id')";

mysqli_query($conexion, $sql);

header("Location: registrar_materia.php");
?>