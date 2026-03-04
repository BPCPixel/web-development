<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: index.php");
    exit();
}

require 'conexion.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Inscripciones</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>

<header>
    <h1 class="title">INSTITUTO <span>Base de datos</span></h1>
</header>

<div class="nav-bg">
    <nav class="main-navegation container">
        <a href="registro_estudiantes.html">Registro de estudiantes</a>
        <a href="registro_profesores.html">Registro de profesores</a>
        <a href="registro_carrera.html">Registro de carrera</a>
        <a href="registrar_materia.php">Registrar materia</a>
        <a href="inscripciones.php">Inscripciones</a>
        <a href="logout.php">Cerrar sesión</a>
    </nav>
</div>

<main class="form-container">
    <h2>Nueva Inscripción</h2>

    <form action="guardar_inscripcion.php" method="POST" class="form">

        <label>Estudiante:</label>
        <select name="estudiante_id" required>
            <option value="">-- Selecciona --</option>
            <?php
            $estudiantes = mysqli_query($conexion, "SELECT id, nombre, apellido_pat FROM estudiantes");
            while ($est = mysqli_fetch_array($estudiantes)) {
                echo "<option value='".$est['id']."'>".$est['nombre']." ".$est['apellido_pat']."</option>";
            }
            ?>
        </select>

        <label>Materia:</label>
        <select name="materia_id" required>
            <option value="">-- Selecciona --</option>
            <?php
            $materias = mysqli_query($conexion, "SELECT id, nombre FROM materias");
            while ($mat = mysqli_fetch_array($materias)) {
                echo "<option value='".$mat['id']."'>".$mat['nombre']."</option>";
            }
            ?>
        </select>

        <label>Profesor:</label>
        <select name="profesor_id" required>
            <option value="">-- Selecciona --</option>
            <?php
            $profesores = mysqli_query($conexion, "SELECT id, nombre, apellido_pat FROM profesores");
            while ($prof = mysqli_fetch_array($profesores)) {
                echo "<option value='".$prof['id']."'>".$prof['nombre']." ".$prof['apellido_pat']."</option>";
            }
            ?>
        </select>

        <label>Periodo:</label>
        <input type="text" name="periodo" required>

        <button type="submit">Guardar Inscripción</button>

    </form>
</main>

</body>
</html>