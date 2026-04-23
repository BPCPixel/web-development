<?php
session_start();
include("config/conexion.php");

if (!isset($_SESSION["usuario_id"]) || $_SESSION["rol"] != "paciente") {
    header("Location: ../login.php");
    exit();
}

$usuario_id = $_SESSION["usuario_id"];

/* Obtener citas del paciente */
$sql = "SELECT c.id, c.fecha, c.hora, c.estado, 
               d.nombre AS doctor_nombre, 
               d.especialidad
        FROM citas c
        INNER JOIN doctores d ON c.doctor_id = d.id
        WHERE c.usuario_id = ?
        ORDER BY c.fecha DESC, c.hora DESC";

$stmt = $conexion->prepare($sql);
$stmt->bind_param("i", $usuario_id);
$stmt->execute();
$resultado = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Citas</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container">
        <a class="navbar-brand fw-bold" href="dashboard.php">🏥 Panel Paciente</a>
        <div class="ms-auto">
            <a href="../logout.php" class="btn btn-outline-light">Cerrar Sesión</a>
        </div>
    </div>
</nav>

<div class="container py-5">
    <h2 class="mb-4">📅 Mis Citas Médicas</h2>

    <?php if ($resultado->num_rows > 0): ?>
        <div class="table-responsive">
            <table class="table table-hover table-bordered align-middle">
                <thead class="table-primary">
                    <tr>
                        <th>ID</th>
                        <th>Doctor</th>
                        <th>Especialidad</th>
                        <th>Fecha</th>
                        <th>Hora</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($fila = $resultado->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $fila["id"]; ?></td>
                            <td><?php echo htmlspecialchars($fila["doctor_nombre"]); ?></td>
                            <td><?php echo htmlspecialchars($fila["especialidad"]); ?></td>
                            <td><?php echo $fila["fecha"]; ?></td>
                            <td><?php echo $fila["hora"]; ?></td>
                            <td>
                                <?php
                                $estado = $fila["estado"];
                                $badge = "secondary";

                                if ($estado == "Pendiente") $badge = "warning";
                                elseif ($estado == "Confirmada") $badge = "success";
                                elseif ($estado == "Cancelada") $badge = "danger";

                                echo "<span class='badge bg-$badge'>$estado</span>";
                                ?>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <div class="alert alert-info">
            No tienes citas registradas.
        </div>
    <?php endif; ?>

    <a href="dashboard.php" class="btn btn-primary mt-3">⬅ Volver al Panel</a>
</div>

</body>
</html>