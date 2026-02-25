<?php
include 'conexion.php';
if (isset($_POST['nombre_profesor']) && isset($_POST['apellido_paterno_profesor']) && isset($_POST['apellido_materno_profesor']) && isset($_POST['especialidad_profesor'])) {

    $nombre = $_POST['nombre_profesor'];
    $apellido_paterno = $_POST['apellido_paterno_profesor'];
    $apellido_materno = $_POST['apellido_materno_profesor'];
    $especialidad = $_POST['especialidad_profesor'];

    $sql = "INSERT INTO profesores(nombre, apellido_pat, apellido_mat, especialidad) VALUES('$nombre', '$apellido_paterno', '$apellido_materno', '$especialidad')";

    if (mysqli_query($conexion, $sql)) {
        echo "Profesor registrado con exito";
    } else {
        echo "Error";
    }
}
?>



