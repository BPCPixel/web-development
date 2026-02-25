<?php
include 'conexion.php';
if (isset($_POST['nombre_estudiante']) && isset($_POST['apellido_paterno_estudiante']) && isset($_POST['apellido_materno_estudiante']) && isset($_POST['matricula_estudiante'])) {

    $nombre = $_POST['nombre_estudiante'];
    $apellido_paterno = $_POST['apellido_paterno_estudiante'];
    $apellido_materno = $_POST['apellido_materno_estudiante'];
    $matricula = $_POST['matricula_estudiante'];

    $sql = "INSERT INTO estudiantes(nombre, apellido_pat, apellido_mat, matricula) VALUES('$nombre', '$apellido_paterno', '$apellido_materno', '$matricula')";

    if (mysqli_query($conexion, $sql)) {
        echo "Estudiante registrado con exito";
    } else {
        echo "Error";
    }
}
?>



