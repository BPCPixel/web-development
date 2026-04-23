<?php
session_start();
include("config/conexion.php");

if (!isset($_SESSION["usuario_id"]) || $_SESSION["rol"] != "paciente") {
    header("Location: ../login.php");
    exit();
}

$usuario_id = $_SESSION["usuario_id"];
$nombre = $_SESSION["nombre"];

/* Obtener estadísticas */
$sqlCitas = "SELECT COUNT(*) AS total FROM citas WHERE usuario_id = ?";
$stmtCitas = $conexion->prepare($sqlCitas);
$stmtCitas->bind_param("i", $usuario_id);
$stmtCitas->execute();
$totalCitas = $stmtCitas->get_result()->fetch_assoc()["total"];

$sqlPendientes = "SELECT COUNT(*) AS total FROM citas WHERE usuario_id = ? AND estado = 'Pendiente'";
$stmtPendientes = $conexion->prepare($sqlPendientes);
$stmtPendientes->bind_param("i", $usuario_id);
$stmtPendientes->execute();
$totalPendientes = $stmtPendientes->get_result()->fetch_assoc()["total"];

$sqlConfirmadas = "SELECT COUNT(*) AS total FROM citas WHERE usuario_id = ? AND estado = 'Confirmada'";
$stmtConfirmadas = $conexion->prepare($sqlConfirmadas);
$stmtConfirmadas->bind_param("i", $usuario_id);
$stmtConfirmadas->execute();
$totalConfirmadas = $stmtConfirmadas->get_result()->fetch_assoc()["total"];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Paciente</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container">
        <a class="navbar-brand fw-bold" href="#">🏥 Sistema de Citas</a>
        <div class="ms-auto">
            <a href="../logout.php" class="btn btn-outline-light">Cerrar Sesión</a>
        </div>
    </div>
</nav>

<div class="container py-5">
    <h2 class="mb-4">Bienvenido, <?php echo htmlspecialchars($nombre); ?> 👋</h2>

    <div class="row g-4">
        <div class="col-md-4">
            <div class="card shadow text-center p-4">
                <h3><?php echo $totalCitas; ?></h3>
                <p>Total de Citas</p>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow text-center p-4">
                <h3><?php echo $totalPendientes; ?></h3>
                <p>Citas Pendientes</p>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow text-center p-4">
                <h3><?php echo $totalConfirmadas; ?></h3>
                <p>Citas Confirmadas</p>
            </div>
        </div>
    </div>

    <div class="mt-5 d-flex flex-wrap gap-3">
        <a href="agendar.php" class="btn btn-primary btn-lg">📅 Agendar Cita</a>
        <a href="mis_citas.php" class="btn btn-success btn-lg">📋 Ver Mis Citas</a>
    </div>
</div>

</body>
</html>