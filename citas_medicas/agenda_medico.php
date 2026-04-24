<?php
require_once 'config/db.php';
session_start();

// Seguridad: Solo médicos pueden ver esta página
if (!isset($_SESSION['user_id']) || $_SESSION['rol'] !== 'medico') {
    header("Location: login.php");
    exit;
}

$medico_id = $_SESSION['user_id'];

// Consulta optimizada para traer los datos del paciente que agendó
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body class="bg-light">
    <?php include 'includes/navbar.php'; ?>

    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="fw-bold">Mi Agenda Diaria</h2>
                <p class="text-muted">Gestiona las consultas de tus pacientes hoy.</p>
            </div>
            <span class="badge bg-primary fs-6 p-2 shadow-sm"><?= count($citas) ?> Citas Programadas</span>
        </div>

        <?php if (empty($citas)): ?>
            <div class="card border-0 shadow-sm p-5 text-center rounded-4">
                <i class="bi bi-calendar-check fs-1 text-muted mb-3"></i>
                <h4>No tienes citas para mostrar.</h4>
                <p class="text-muted">Cuando un paciente agende contigo, aparecerá aquí.</p>
            </div>
        <?php else: ?>
            <div class="table-responsive shadow-sm rounded-4 bg-white p-3">
                <table class="table table-hover align-middle" id="tableAgenda">
                    <thead class="table-light">
                        <tr>
                            <th>Fecha y Hora</th>
                            <th>Paciente</th>
                            <th>Motivo</th>
                            <th>Teléfono</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($citas as $cita): ?>
                            <tr>
                                <td>
                                    <div class="fw-bold text-primary"><?= date('d/m/Y', strtotime($cita['fecha_cita'])) ?></div>
                                    <div class="small text-muted"><?= date('H:i', strtotime($cita['hora_cita'])) ?> hrs</div>
                                </td>
                                <td>
                                    <strong><?= $cita['nombre'] . " " . $cita['apellido_paterno'] ?></strong>
                                </td>
                                <td>
                                    <p class="mb-0 small text-truncate" style="max-width: 200px;" title="<?= htmlspecialchars($cita['motivo']) ?>">
                                        <?= htmlspecialchars($cita['motivo']) ?>
                                    </p>
                                </td>
                                <td><?= $cita['telefono'] ?? '<span class="text-muted">N/A</span>' ?></td>
                                <td>
                                    <span class="badge <?= ($cita['estado'] == 'Confirmada') ? 'bg-success' : (($cita['estado'] == 'Pendiente') ? 'bg-warning text-dark' : 'bg-secondary') ?>">
                                        <?= $cita['estado'] ?>
                                    </span>
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-outline-primary rounded-pill px-3" onclick="atenderPaciente('<?= $cita['nombre'] ?>')">
                                        Atender
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>

    <?php include 'includes/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function atenderPaciente(nombre) {
            alert("Iniciando consulta para: " + nombre + ". (Función en desarrollo para Fase 3)");
        }
    </script>
</body>
</html>