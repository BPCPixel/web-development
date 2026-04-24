<?php
require_once 'config/db.php';
session_start();
// Seguridad: Solo pacientes [cite: 257]
if (!isset($_SESSION['user_id']) || $_SESSION['rol'] !== 'paciente') { 
    header("Location: login.php"); exit; 
}

$paciente_id = $_SESSION['user_id'];

// SQL Corregido: Alias 'esp' coincidente en JOIN y SELECT [cite: 277, 281, 282]
$sql = "SELECT c.id, c.fecha_cita, c.hora_cita, c.motivo, c.estado, 
               m.nombre as doc_nom, m.apellido_paterno as doc_ape, 
               esp.nombre as especialidad_nom, con.nombre as sede
        FROM citas c
        JOIN medicos m ON c.medico_id = m.id
        JOIN especialidades esp ON m.especialidad_id = esp.id
        JOIN consultorios con ON m.consultorio_id = con.id
        WHERE c.paciente_id = ? 
        ORDER BY c.fecha_cita DESC";

$stmt = $pdo->prepare($sql);
$stmt->execute([$paciente_id]);
$citas = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mis Citas | BINARIA LAB</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body class="bg-light">
    <?php include 'includes/navbar.php'; ?>
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold"><i class="bi bi-calendar-check text-primary"></i> Mis Citas</h2>
            <a href="agendar.php" class="btn btn-primary shadow-sm rounded-pill px-4">
                <i class="bi bi-plus-circle me-2"></i>Agendar Nueva Cita
            </a>
        </div>
        
        <div class="row g-4">
            <?php if (empty($citas)): ?>
                <div class="col-12 text-center p-5 bg-white rounded-4 shadow-sm">
                    <p class="text-muted">No tienes citas agendadas actualmente.</p>
                </div>
            <?php else: ?>
                <?php foreach ($citas as $cita): ?>
                    <div class="col-md-6">
                        <div class="card border-0 shadow-sm p-3 h-100">
                            <div class="card-body">
                                <span class="badge mb-2 <?= ($cita['estado'] == 'Confirmada') ? 'bg-success' : 'bg-warning text-dark' ?>">
                                    <?= strtoupper($cita['estado']) ?>
                                </span>
                                <h5>Dr. <?= $cita['doc_nom'] . " " . $cita['doc_ape'] ?></h5>
                                <p class="text-primary fw-bold mb-1"><?= $cita['especialidad_nom'] ?></p>
                                <p class="text-muted small"><i class="bi bi-geo-alt"></i> <?= $cita['sede'] ?></p>
                                <div class="mt-3">
                                    <span class="me-3"><i class="bi bi-calendar-event"></i> <?= date('d/m/Y', strtotime($cita['fecha_cita'])) ?></span>
                                    <span><i class="bi bi-clock"></i> <?= date('H:i', strtotime($cita['hora_cita'])) ?> hrs</span>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
    <?php include 'includes/footer.php'; ?>
</body>
</html>