<?php
$servidor = "localhost";
$usuario = "root";
$contra = "1234"; 
$bd = "sistema_citas";

$conexion = mysqli_connect($servidor, $usuario, $contra, $bd);

if(!$conexion){
    die("Error de conexión: " . mysqli_connect_error());
}
?>