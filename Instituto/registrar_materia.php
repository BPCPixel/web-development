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
    <title>Registrar Materia</title>
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
    <h2>Nueva Materia</h2>

    <form action="guardar_materia.php" method="POST" class="form">

        <label>Nombre de la Materia:</label>
        <input type="text" name="nombre" required>

        <label>Créditos:</label>
        <input type="number" name="creditos" required>

        <label>Asignar a Carrera:</label>
        <select name="carrera_id" required>
            <option value="">-- Selecciona una carrera --</option>
            <?php
            $query = mysqli_query($conexion, "SELECT id, nombre FROM carreras");
            while ($carrera = mysqli_fetch_array($query)) {
                echo "<option value='".$carrera['id']."'>".$carrera['nombre']."</option>";
            }
            ?>
        </select>

        <button type="submit">Guardar Materia</button>

    </form>
</main>

</body>
</html>