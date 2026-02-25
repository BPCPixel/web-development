<?php
require 'conexion.php';

echo "<style>
    body { 
        background-color: #f4f7f6; 
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
        display: flex; 
        justify-content: center; 
        align-items: center; 
        height: 100vh; 
        margin: 0; 
    }
    .respuesta-card {
        background: white;
        padding: 40px;
        border-radius: 15px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        text-align: center;
        max-width: 450px;
        width: 90%;
        border-top: 6px solid #F8BBD0; /* Detalle rosita arriba */
    }
    h2 { color: #333; margin-bottom: 10px; }
    p { color: #666; font-size: 1.1rem; }
    
    .exito-icon { color: #F8BBD0; font-size: 50px; margin-bottom: 20px; }
    
    .btn-volver {
        display: inline-block;
        margin-top: 25px;
        padding: 12px 30px;
        background-color: #4A90E2;
        color: #333;
        text-decoration: none;
        border-radius: 8px;
        font-weight: bold;
        transition: all 0.3s ease;
    }
    .btn-volver:hover {
        background-color: #F06292;
        transform: translateY(-2px);
    }
</style>";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $creditos = $_POST['creditos'];
    $carrera_id = $_POST['carrera_id'];

    $sql = "INSERT INTO materias (nombre, creditos, carrera_id) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($conexion, $sql);
    mysqli_stmt_bind_param($stmt, "sii", $nombre, $creditos, $carrera_id);
    
    echo "<div class='respuesta-card'>";
    
    if (mysqli_stmt_execute($stmt)) {
        echo "<div class='exito-icon'>:)</div>";
        echo "<h2>¡Materia Guardada!</h2>";
        echo "<p>La materia <strong>" . htmlspecialchars($nombre) . "</strong> se registró correctamente en el sistema.</p>";
    } else {
        echo "<h2 style='color: #d32f2f;'>Ups, hubo un error</h2>";
        echo "<p>" . mysqli_error($conexion) . "</p>";
    }
    
    echo "<a href='registrar_materia.php' class='btn-volver'>Volver al Registro</a>";
    echo "</div>";
    
    mysqli_stmt_close($stmt);
}
mysqli_close($conexion);
?>