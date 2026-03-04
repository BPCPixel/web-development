<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: index.php");
    exit();
}

require 'conexion.php';

$estudiante_id = $_POST['estudiante_id'];
$materia_id = $_POST['materia_id'];
$profesor_id = $_POST['profesor_id'];
$periodo = $_POST['periodo'];

$sql = "INSERT INTO inscripciones 
        (estudiante_id, materia_id, profesor_id, periodo)
        VALUES 
        ('$estudiante_id', '$materia_id', '$profesor_id', '$periodo')";

mysqli_query($conexion, $sql);

header("Location: inscripciones.php");
?>