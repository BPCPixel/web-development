<?php
require 'conexion.php';

$nombre = $_POST['nombre_profesor'];
$apellido_pat = $_POST['apellido_paterno_profesor'];
$apellido_mat = $_POST['apellido_materno_profesor'];
$especialidad = $_POST['especialidad_profesor'];

$sql = "INSERT INTO profesores 
        (nombre, apellido_pat, apellido_mat, especialidad)
        VALUES 
        ('$nombre', '$apellido_pat', '$apellido_mat', '$especialidad')";

if (mysqli_query($conexion, $sql)) {
    echo "Profesor guardado correctamente.";
} else {
    echo "Error: " . mysqli_error($conexion);
}
?>