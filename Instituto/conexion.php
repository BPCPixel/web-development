<?php
$servidor="localhost";
$usuario="root";
$contra="1234";
$bd="instituto";
$conexion = mysqli_connect($servidor, $usuario, $contra, $bd);
if(!$conexion){
    die("Erorr de conexion".mysqli_connect_error());
}
?>