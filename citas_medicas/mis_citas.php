<?php
require_once 'config/db.php';
session_start();

// Seguridad: Solo pacientes logueados
if (!isset($_SESSION['user_id']) || $_SESSION['rol'] !== 'paciente') {
    header("Location: login.php");
    exit;
}

$paciente_id = $_SESSION['user_id'];
$mensaje = "";

// LÓGICA PARA CANCELAR CITA
if (isset($_POST['cancelar_id'])) {
    $id_cita = $_POST['cancelar_id'];
    try {
        // Solo puede cancelar si la cita le pertenece a él
        $stmt = $pdo->prepare("UPDATE citas SET estado = 'Cancelada' WHERE id = ? AND paciente_id = ?");
        $stmt->execute([$id_cita, $paciente_id]);
        $mensaje = "Cita cancelada correctamente.";
    } catch (PDOException $e) {
        $mensaje = "Error al cancelar: " . $e->getMessage();
    }
}

// Consulta: Traemos las citas del paciente con el nombre del médico y la sede
$sql = "SELECT c.id, c.fecha_cita, c.hora_cita, c.motivo, c.estado, 
               m.nombre as doc_nom, m.apellido_paterno as doc_ape, m.especialidad,
               con.nombre as sede
        FROM citas c
        JOIN medicos m ON c.medico_id = m.id
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
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
</head>
<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow">
        <div class="container">
            <a class="navbar-brand fw-bold" href="dashboard.php">BINARIA LAB</a>
            <div class="ms-auto">
                <a href="dashboard.php" class="btn btn-outline-light btn-sm">Volver al Panel</a>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="row mb-4">
            <div class="col-md-8">
                <h2 class="fw-bold"><i class="bi bi-calendar-check text-primary"></i> Mi Historial de Citas</h2>
                <p class="text-muted">Aquí puedes revisar tus citas pasadas y próximas consultas.</p>
            </div>
        </div>

        <?php if($mensaje): ?>
            <div class="alert alert-info alert-dismissible fade show shadow-sm" role="alert">
                <?php echo $mensaje; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <?php if (empty($citas)): ?>
            <div class="card border-0 shadow-sm p-5 text-center rounded-4">
                <div class="mb-3">
                    <i class="bi bi-calendar-x fs-1 text-muted"></i>
                </div>
                <h4>Aún no tienes ninguna cita.</h4>
                <p class="text-muted">¿Necesitas ver a un especialista?</p>
                <div class="mt-2">
                    <a href="agendar.php" class="btn btn-primary px-4 shadow">Agendar mi primera cita</a>
                </div>
            </div>
        <?php else: ?>
            <div class="row g-4">
                <?php foreach ($citas as $cita): ?>
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 border-0 shadow-sm rounded-4 card-hover">
                        <div class="card-header bg-white border-0 pt-3">
                            <span class="badge <?php 
                                echo ($cita['estado'] == 'Confirmada') ? 'bg-success' : 
                                     (($cita['estado'] == 'Pendiente') ? 'bg-warning text-dark' : 'bg-secondary'); 
                            ?>">
                                <?php echo strtoupper($cita['estado']); ?>
                            </span>
                        </div>
                        <div class="card-body">
                            <h5 class="fw-bold mb-1">Dr. <?php echo $cita['doc_nom'] . " " . $cita['doc_ape']; ?></h5>
                            <p class="text-primary small fw-bold mb-3"><?php echo $cita['especialidad']; ?></p>
                            
                            <div class="d-flex mb-2">
                                <i class="bi bi-calendar3 me-2 text-muted"></i>
                                <span><?php echo date('d/m/Y', strtotime($cita['fecha_cita'])); ?></span>
                            </div>
                            <div class="d-flex mb-2">
                                <i class="bi bi-clock me-2 text-muted"></i>
                                <span><?php echo date('H:i', strtotime($cita['hora_cita'])); ?> hrs</span>
                            </div>
                            <div class="d-flex mb-3">
                                <i class="bi bi-geo-alt me-2 text-muted"></i>
                                <span><?php echo $cita['sede']; ?></span>
                            </div>
                            
                            <hr>
                            <p class="small text-muted mb-0"><strong>Motivo:</strong> <?php echo htmlspecialchars($cita['motivo']); ?></p>
                        </div>
                        
                        <?php if($cita['estado'] == 'Pendiente' || $cita['estado'] == 'Confirmada'): ?>
                        <div class="card-footer bg-white border-0 pb-3 text-end">
                            <form method="POST" onsubmit="return confirm('¿Estás seguro de que deseas cancelar esta cita?');">
                                <input type="hidden" name="cancelar_id" value="<?php echo $cita['id']; ?>">
                                <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill px-3">
                                    <i class="bi bi-x-circle"></i> Cancelar Cita
                                </button>
                            </form>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>

    <footer class="text-center mt-5 text-muted small pb-4">
        &copy; 2026 BINARIA LAB | Eduardo Téllez. Gestión Médica Digital.
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>