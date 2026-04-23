<?php
session_start();
include("config/conexion.php");

if (!isset($_SESSION["usuario_id"]) || $_SESSION["rol"] != "doctor") {
    header("Location: ../login.php");
    exit();
}

$doctor_id = $_SESSION["usuario_id"];

/* Obtener citas asignadas al doctor */
$sql = "SELECT c.id, c.fecha, c.hora, c.estado,
               u.nombre AS paciente_nombre,
               u.correo AS paciente_correo
        FROM citas c
        INNER JOIN usuarios u ON c.usuario_id = u.id
        WHERE c.doctor_id = ?
        ORDER BY c.fecha ASC, c.hora ASC";

$stmt = $conexion->prepare($sql);
$stmt->bind_param("i", $doctor_id);
$stmt->execute();
$resultado = $stmt->get_result();

/* Actualizar estado */
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["cita_id"], $_POST["estado"])) {
    $cita_id = intval($_POST["cita_id"]);
    $estado  = $_POST["estado"];

    $sqlUpdate = "UPDATE citas SET estado = ? WHERE id = ? AND doctor_id = ?";
    $stmtUpdate = $conexion->prepare($sqlUpdate);
    $stmtUpdate->bind_param("sii", $estado, $cita_id, $doctor_id);
    $stmtUpdate->execute();

    header("Location: agenda_medico.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agenda del Médico</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container">
        <a class="navbar-brand fw-bold" href="dashboard.php">🩺 Panel Médico</a>
        <div class="ms-auto">
            <a href="../logout.php" class="btn btn-outline-light">Cerrar Sesión</a>
        </div>
    </div>
</nav>

<div class="container py-5">
    <h2 class="mb-4">📋 Agenda de Citas</h2>

    <?php if ($resultado->num_rows > 0): ?>
        <div class="table-responsive">
            <table class="table table-hover table-bordered align-middle">
                <thead class="table-success">
                    <tr>
                        <th>ID</th>
                        <th>Paciente</th>
                        <th>Correo</th>
                        <th>Fecha</th>
                        <th>Hora</th>
                        <th>Estado</th>
                        <th>Actualizar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($fila = $resultado->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $fila["id"]; ?></td>
                            <td><?php echo htmlspecialchars($fila["paciente_nombre"]); ?></td>
                            <td><?php echo htmlspecialchars($fila["paciente_correo"]); ?></td>
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
                            <td>
                                <form method="POST" class="d-flex gap-2">
                                    <input type="hidden" name="cita_id" value="<?php echo $fila["id"]; ?>">
                                    <select name="estado" class="form-select form-select-sm" required>
                                        <option value="Pendiente">Pendiente</option>
                                        <option value="Confirmada">Confirmada</option>
                                        <option value="Cancelada">Cancelada</option>
                                    </select>
                                    <button type="submit" class="btn btn-sm btn-primary">Guardar</button>
                                </form>
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

    <a href="dashboard.php" class="btn btn-success mt-3">⬅ Volver al Panel</a>
</div>

</body>
</html>