<?php require 'conexion.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <link rel="stylesheet" href="css/styles.css">
    <meta charset="UTF-8">
    <title>INSCRIPCIONES</title>

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