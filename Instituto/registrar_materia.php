<?php require 'conexion.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registrar Materia</title>
    <style>
        body { background-color: #f4f7f6; font-family: 'Segoe UI', sans-serif; display: flex; justify-content: center; padding-top: 50px; }
        .card { 
            background: white; padding: 25px; border-radius: 12px; 
            box-shadow: 0 4px 15px rgba(0,0,0,0.1); width: 400px; 
        }
        h2 { color: #333; text-align: center; }
        label { display: block; margin: 10px 0 5px; color: #333; font-weight: 600; }
        input, select { 
            width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 6px; 
            box-sizing: border-box; margin-bottom: 15px;
        }
        /* Tu botón rosita bonito */
        button { 
            width: 100%; background-color: #4A90E2; color: #333; border: none; 
            padding: 12px; border-radius: 6px; font-weight: bold; cursor: pointer; 
            transition: 0.3s; 
        }
        button:hover { background-color: #F06292; }
    </style>
</head>
<body>

<div class="card">
    <h2>Nueva Materia</h2>
    <form action="guardar_materia.php" method="POST">
        <label>Nombre de la Materia:</label>
        <input type="text" name="nombre" required placeholder="Ej. Base de datos para Ing.">

        <label>Créditos:</label>
        <input type="number" name="creditos" required placeholder="Ej. 5">

        <label>Asignar a Carrera:</label>
        <select name="carrera_id" required>
            <option value="">-- Selecciona una carrera --</option>
            <?php
            // Obtenemos las carreras para el dropdown
            $query = mysqli_query($conexion, "SELECT id, nombre FROM carreras");
            while ($carrera = mysqli_fetch_array($query)) {
                echo "<option value='".$carrera['id']."'>".$carrera['nombre']."</option>";
            }
            ?>
        </select>

        <button type="submit">Guardar Materia</button>
    </form>
</div>

</body>
</html>