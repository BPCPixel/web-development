
<?php
require 'conexion.php';

$nombre = $_POST['nombre'];
$duracion = $_POST['duracion_semestre'];

$sql = "INSERT INTO carreras (nombre, duracion_semestre)
        VALUES ('$nombre', '$duracion')";

if (mysqli_query($conexion, $sql)) {
    echo "Carrera guardada correctamente.";
} else {
    echo "Error: " . mysqli_error($conexion);
}
?>