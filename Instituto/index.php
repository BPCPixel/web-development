<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Inicio</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>

<header>
    <h1 class="title">INSTITUTO <span>Base de datos</span></h1>
</header>

<div class="nav-bg">
    <nav class="main-navegation container">

        <?php if (!isset($_SESSION['usuario'])): ?>

            <a href="index.php">Iniciar sesion</a>
            <a href="registro.html">Crear una cuenta</a>

        <?php else: ?>

            <a href="registro_estudiantes.html">Registro de estudiantes</a>
            <a href="registro_profesores.html">Registro de profesores</a>
            <a href="registro_carrera.html">Registro de carrera</a>
            <a href="registrar_materia.php">Registrar materia</a>
            <a href="inscripciones.php">Inscripciones</a>
            <a href="logout.php">Cerrar sesión</a>

        <?php endif; ?>

    </nav>
</div>

<?php if (!isset($_SESSION['usuario'])): ?>

<main class="form-container">
    <h2>Iniciar Sesion</h2>

    <form action="login.php" method="POST" class="form">
        <label>Email:</label>
        <input type="email" name="correo" required>

        <label>Contrasenia:</label>
        <input type="password" name="contrasenia" required>

        <button type="submit">Login</button>
    </form>
</main>

<?php else: ?>

<main class="form-container">
    <h2>Bienvenido</h2>
    <p>Has iniciado sesión correctamente.</p>
</main>

<?php endif; ?>

</body>
</html>