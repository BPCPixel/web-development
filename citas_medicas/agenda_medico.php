<?php
require_once 'config/db.php';
session_start();

// Seguridad: Solo médicos pueden ver esta página
if (!isset($_SESSION['user_id']) || $_SESSION['rol'] !== 'medico') {
    header("Location: login.php");
    exit;
}

$medico_id = $_SESSION['user_id'];

// Consulta para obtener las citas del médico logueado
// Unimos con la tabla pacientes para saber quién viene a la cita
$sql = "SELECT c.id, c.fecha_cita, c.hora_cita, c.motivo, c.estado, 
               p.nombre, p.apellido_paterno, p.telefono
        FROM citas c
        JOIN pacientes p ON c.paciente_id = p.id
        WHERE c.medico_id = ? 
        ORDER BY c.fecha_cita ASC, c.hora_cita ASC";

$stmt = $pdo->prepare($sql);
$stmt->execute([$medico_id]);
$citas = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agenda Médica | BINARIA LAB</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="dashboard.php">BINARIA LAB - Agenda</a>
            <div class="ms-auto">
                <span class="text-white me-3">Dr. <?php echo $_SESSION['nombre']; ?></span>
                <a href="dashboard.php" class="btn btn-outline-light btn-sm">Volver</a>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold">Mis Citas Programadas</h2>
            <span class="badge bg-primary fs-6"><?php echo count($citas); ?> Citas en total</span>
        </div>

        <?php if (empty($citas)): ?>
            <div class="alert alert-info text-center shadow-sm">
                <h4 class="mt-2">No tienes citas agendadas por ahora.</h4>
                <p>Cuando un paciente agende contigo, aparecerá en esta lista.</p>
            </div>
        <?php else: ?>
            <div class="table-responsive shadow-sm rounded-4 bg-white p-3">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Fecha y Hora</th>
                            <th>Paciente</th>
                            <th>Motivo / Síntomas</th>
                            <th>Teléfono</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($citas as $cita): ?>
                        <tr>
                            <td>
                                <div class="fw-bold text-primary">
                                    <?php echo date('d/m/Y', strtotime($cita['fecha_cita'])); ?>
                                </div>
                                <div class="small text-muted"><?php echo $cita['hora_cita']; ?> hrs</div>
                            </td>
                            <td>
                                <strong><?php echo $cita['nombre'] . " " . $cita['apellido_paterno']; ?></strong>
                            </td>
                            <td>
                                <p class="mb-0 small text-truncate" style="max-width: 200px;">
                                    <?php echo htmlspecialchars($cita['motivo']); ?>
                                </p>
                            </td>
                            <td><?php echo $cita['telefono'] ?? 'N/A'; ?></td>
                            <td>
                                <span class="badge <?php 
                                    echo ($cita['estado'] == 'Confirmada') ? 'bg-success' : 
                                         (($cita['estado'] == 'Pendiente') ? 'bg-warning text-dark' : 'bg-secondary'); 
                                ?>">
                                    <?php echo $cita['estado']; ?>
                                </span>
                            </td>
                            <td>
                                <button class="btn btn-sm btn-outline-primary">Atender</button>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>

    <footer class="text-center mt-5 text-muted small pb-4">
        &copy; 2026 BINARIA LAB - Sistema de Gestión Médica
    </footer>

</body>
</html>