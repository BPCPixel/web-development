<?php
include 'conexion.php';

if (isset($_POST['correo']) && isset($_POST['contrasenia'])) {

    $email = $_POST['correo'];
    $contrasenia = $_POST['contrasenia'];

    $sql = "SELECT * FROM usuario 
            WHERE email='$email' 
            AND contrasenia='$contrasenia'";

    $resultado = mysqli_query($conexion, $sql);

    if (mysqli_num_rows($resultado) > 0) {
        echo "Login correcto";
    } else {
        echo "Correo o contraseña incorrectos";
    }
}
?>