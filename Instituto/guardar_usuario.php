<?php
include 'conexion.php';
if (isset($_POST['correo_nuevo']) && isset($_POST['contrasenia_nueva'])) {

    $email = $_POST['correo_nuevo'];
    $contrasenia = $_POST['contrasenia_nueva'];

    $sql = "INSERT INTO usuario(email, contrasenia) VALUES('$email', '$contrasenia')";

    if (mysqli_query($conexion, $sql)) {
        echo "Registrado con exito";
    } else {
        echo "Error";
    }
}
?>