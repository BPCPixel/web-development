<?php

require 'conexion.php'; 
echo "<style>
    body { 
        font-family: 'Segoe UI', sans-serif; 
        background-color: #f4f7f6; 
        display: flex; 
        justify-content: center; 
        align-items: center; 
        height: 100vh; 
        margin: 0; 
    }
    .modal {
        background: white;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        text-align: center;
        max-width: 400px;
        width: 90%;
    }
    .success { color: #2e7d32; border-top: 5px solid #4caf50; }
    .error { color: #c62828; border-top: 5px solid #f44336; }
    .btn {
        display: inline-block;
        margin-top: 20px;
        padding: 10px 20px;
        background-color: #4A90E2;
        color: white;
        text-decoration: none;
        border-radius: 6px;
        transition: background 0.3s;
    }
    .btn:hover { background-color: #F06292; }
</style>";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $nombre = $_POST['nombre'] ?? '';
    $duracion = $_POST['duracion_semestres'] ?? 0;


    $sql = "INSERT INTO carreras (nombre, duracion_semestre) VALUES (?, ?)";
    $stmt = mysqli_prepare($conexion, $sql);
    
    
    mysqli_stmt_bind_param($stmt, "si", $nombre, $duracion);
    
    echo "<div class='modal'>";
    
    if (mysqli_stmt_execute($stmt)) {
        echo "<h2 class='success'>¡Registro Exitoso!</h2>";
        echo "<p>La carrera <strong>" . htmlspecialchars($nombre) . "</strong> se guardó correctamente.</p>";
    } else {
        echo "<h2 class='error'>Hubo un problema</h2>";
        echo "<p>Error: " . mysqli_error($conexion) . "</p>";
    }
    
    echo "<a href='index.html' class='btn'>Volver al inicio</a>";
    echo "</div>";

    mysqli_stmt_close($stmt);
}


mysqli_close($conexion);
?>