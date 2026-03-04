<?php
require 'conexion.php';

$nombre = $_POST['nombre_estudiante'];
$apellido_pat = $_POST['apellido_paterno_estudiante'];
$apellido_mat = $_POST['apellido_materno_estudiante'];
$matricula = $_POST['matricula_estudiante'];

$sql = "INSERT INTO estudiantes 
        (nombre, apellido_pat, apellido_mat, matricula, usuario_id, carrera_id)
        VALUES 
        ('$nombre', '$apellido_pat', '$apellido_mat', '$matricula', NULL, NULL)";

if (mysqli_query($conexion, $sql)) {
    echo "Estudiante guardado correctamente.";
} else {
    echo "Error: " . mysqli_error($conexion);
}
?>