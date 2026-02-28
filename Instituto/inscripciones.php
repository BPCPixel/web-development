<?php require 'conexion.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <link rel="stylesheet" href="css/styles.css">
    <meta charset="UTF-8">
    <title>INSCRIPCIONES</title>
<!--
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
        
        button { 
            width: 100%; background-color: #4A90E2; color: #333; border: none; 
            padding: 12px; border-radius: 6px; font-weight: bold; cursor: pointer; 
            transition: 0.3s; 
        }
        button:hover { background-color: #F06292; }
    </style>
-->
</head>
<body>

<h1> INSCRIPCIONES </h1>

<div class="nav-bg">
        <nav class="main-navegation container">
            <a href="index.html">Iniciar sesion</a>
            <a href="registro.html"> Crear una cuenta </a>
            <a href="registro_estudiantes.html"> Registro de estudiantes </a>
            <a href="registro_profesores.html"> Registro de profesores </a>
            <a href="registro_carrera.html"> Registro de carrera </a>
            <a href="registrar_materia.php"> Registrar materia </a>
            <a href="inscripciones.php"> Inscripciones </a>
        </nav>
    </div>

<label>MATERIAS</label>
        <select name="carrera_id" required>
            <?php
            // Obtenemos las carreras para el dropdown
            $query = mysqli_query($conexion, "SELECT nombre, creditos FROM materias");
            while ($carrera = mysqli_fetch_array($query)) {
                echo "<option value='".$carrera['id']."'>".$carrera['nombre']."</option>";
            }
            ?>
        </select>

<div class="card">
    <h3>SELECCIONAR PERIODO</h3>
    <form action="registro_periodo.php" method="POST">
        <label>Periodo</label>
        <input type="text" name="periodo" required placeholder="Ej. Primavera - Otoño">

        <button type="submit">Guardar Periodo</button>
    </form>
</div>

</body>
</html>