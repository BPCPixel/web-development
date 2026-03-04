<?php
session_start();
require 'conexion.php';

$correo = $_POST['correo'];
$contrasenia = $_POST['contrasenia'];

$sql = "SELECT * FROM usuario 
        WHERE email='$correo' 
        AND contrasenia='$contrasenia'";

$resultado = mysqli_query($conexion, $sql);

if (mysqli_num_rows($resultado) > 0) {
    $_SESSION['usuario'] = $correo;
    header("Location: index.php");
} else {
    echo "Correo o contraseña incorrectos";
}
?>