<?php
session_start();
require_once 'config/db.php';

// SEGURIDAD: Solo médicos autenticados pueden ver esta lista
if (!isset($_SESSION['user_id']) || $_SESSION['rol'] !== 'medico') {
    header("Location: login.php");
    exit;
}

// Consulta para obtener todos los pacientes registrados
$sql = "SELECT id, nombre, apellido_paterno, apellido_materno, email, telefono, fecha_registro 
        FROM pacientes 
        ORDER BY fecha_registro DESC";
$stmt = $pdo->query($sql);
$pacientes = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Pacientes | BINARIA LAB</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body class="bg-light">

    <?php include 'includes/navbar.php'; ?>

    <div class="container py-5">
        <div class="row mb-4 align-items-center">
            <div class="col-md-6">
                <h2 class="fw-bold"><i class="bi bi-people-fill text-info me-2"></i>Control de Pacientes</h2>
                <p class="text-muted">Directorio oficial de la red médica.</p>
            </div>
            <div class="col-md-6">
                <div class="input-group shadow-sm">
                    <span class="input-group-text bg-white border-end-0"><i class="bi bi-search text-info"></i></span>
                    <input type="text" id="searchPaciente" class="form-control border-start-0" placeholder="Buscar por nombre o teléfono...">
                </div>
            </div>
        </div>

        <div class="row g-4" id="gridPacientes">
            <?php foreach ($pacientes as $p): ?>
                <div class="col-md-4 paciente-card-container">
                    <div class="card border-0 shadow-sm h-100 rounded-4 overflow-hidden">
                        <div class="card-header bg-white border-0 pt-4 px-4">
                            <div class="d-flex align-items-center">
                                <img src="https://ui-avatars.com/api/?name=<?= urlencode($p['nombre'].'+'.$p['apellido_paterno']) ?>&background=0dcaf0&color=fff&bold=true" 
                                     class="rounded-circle me-3" width="50">
                                <div>
                                    <h5 class="fw-bold mb-0"><?= htmlspecialchars($p['nombre'] . " " . $p['apellido_paterno']) ?></h5>
                                    <small class="text-muted">ID: #<?= $p['id'] ?></small>
                                </div>
                            </div>
                        </div>
                        <div class="card-body px-4">
                            <ul class="list-unstyled mb-0 small">
                                <li class="mb-2"><i class="bi bi-envelope text-info me-2"></i><?= htmlspecialchars($p['email']) ?></li>
                                <li class="mb-2"><i class="bi bi-telephone text-info me-2"></i><?= $p['telefono'] ?: 'S/N' ?></li>
                            </ul>
                        </div>
                        <div class="card-footer bg-light border-0 py-3 px-4">
                            <a href="historial_paciente.php?id=<?= $p['id'] ?>" class="btn btn-info w-100 rounded-pill fw-bold btn-sm">
                                <i class="bi bi-file-earmark-medical me-1"></i>Ver Historial Completo
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <?php include 'includes/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('searchPaciente').addEventListener('keyup', function() {
            const term = this.value.toLowerCase();
            const cards = document.querySelectorAll('.paciente-card-container');
            cards.forEach(card => {
                const content = card.innerText.toLowerCase();
                card.style.display = content.includes(term) ? '' : 'none';
            });
        });
    </script>
</body>
</html>