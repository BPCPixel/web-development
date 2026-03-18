<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel de Control | BINARIA LAB</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>

    <nav class="navbar navbar-dark bg-dark">
        <div class="container">
            <span class="navbar-brand">Panel: <strong><?php echo $_SESSION['nombre']; ?></strong></span>
            <a href="logout.php" class="btn btn-outline-danger btn-sm">Cerrar Sesión</a>
        </div>
    </nav>

    <div class="container mt-5 text-center">
        <h1 class="display-5">Bienvenido, <?php echo $_SESSION['nombre']; ?></h1>
        <p class="lead">Has ingresado como <strong><?php echo ucfirst($_SESSION['rol']); ?></strong>.</p>
        
        <div class="row mt-4 justify-content-center">
            <?php if($_SESSION['rol'] == 'paciente'): ?>
                <div class="col-md-4">
                    <div class="card p-4 shadow-sm">
                        <h3>Mis Citas</h3>
                        <p>Consulta tus citas programadas.</p>
                        <a href="mis_citas.php" class="btn btn-primary">Ver Citas</a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card p-4 shadow-sm border-success">
                        <h3>Agendar</h3>
                        <p>Nueva cita con un especialista.</p>
                        <a href="agendar.php" class="btn btn-success">Nueva Cita</a>
                    </div>
                </div>
            <?php else: ?>
                <div class="col-md-4">
                    <div class="card p-4 shadow-sm border-info">
                        <h3>Agenda Diaria</h3>
                        <p>Ver pacientes del día hoy.</p>
                        <a href="agenda_medico.php" class="btn btn-info">Ver Agenda</a>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>

</body>
</html> 