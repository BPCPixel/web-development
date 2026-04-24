<?php
session_start();
require_once 'config/db.php';

// SEGURIDAD: Solo pacientes logueados pueden agendar
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$doc_id = isset($_GET['doc_id']) ? (int)$_GET['doc_id'] : 0;

// Obtener datos del médico y su especialidad
$stmt = $pdo->prepare("SELECT m.*, esp.nombre as especialidad_nom 
                       FROM medicos m 
                       JOIN especialidades esp ON m.especialidad_id = esp.id 
                       WHERE m.id = ?");
$stmt->execute([$doc_id]);
$medico = $stmt->fetch();

if (!$medico) {
    header("Location: especialistas.php");
    exit;
}

// Lógica de imágenes personalizada para tu equipo
$nombreDoc = $medico['nombre'];
if (stripos($nombreDoc, 'Eduardo') !== false) {
    $avatar = "https://static.vecteezy.com/system/resources/thumbnails/026/375/249/small/ai-generative-portrait-of-confident-male-doctor-in-white-coat-and-stethoscope-standing-with-arms-crossed-and-looking-at-camera-photo.jpg";
} elseif (stripos($nombreDoc, 'Luis') !== false) {
    $avatar = "https://i.pinimg.com/236x/3e/43/5f/3e435f79e723b003a2b3c042fed9498f.jpg";
} elseif (stripos($nombreDoc, 'David') !== false) {
    $avatar = "https://img3.stockfresh.com/files/f/feedough/m/18/3398365_stock-photo-young-doctor-sitting-and-writing.jpg";
} elseif (stripos($nombreDoc, 'Fernando') !== false) {
    $avatar = "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRkVlvm_NiEyuvC06TorpxxBKXWQaHQYcS_jg&s";
} else {
    $avatar = "https://images.pexels.com/photos/4173251/pexels-photo-4173251.jpeg?auto=compress&cs=tinysrgb&w=300";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agendar Cita | BINARIA LAB</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body class="bg-light">

    <?php include 'includes/navbar.php'; ?>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card border-0 shadow-lg overflow-hidden" style="border-radius: 25px;">
                    <div class="row g-0">
                        <!-- Lado Izquierdo: Info del Médico -->
                        <div class="col-md-5 bg-dark text-white p-4 text-center d-flex flex-column justify-content-center">
                            <img src="<?= $avatar ?>" class="rounded-circle mx-auto mb-3 shadow-lg border border-4 border-info" 
                                 style="width: 150px; height: 150px; object-fit: cover;">
                            <h4 class="fw-bold mb-1">Dr. <?= htmlspecialchars($medico['nombre'] . " " . $medico['apellido_paterno']) ?></h4>
                            <span class="badge bg-info text-dark rounded-pill px-3 mb-4"><?= htmlspecialchars($medico['especialidad_nom']) ?></span>
                            <p class="small opacity-75">Estás a un paso de confirmar tu cita en la red de excelencia médica de Puebla.</p>
                            <hr class="bg-info">
                            <div class="text-start small">
                                <p class="mb-1"><i class="bi bi-geo-alt-fill text-info me-2"></i>Sede Angelópolis</p>
                                <p class="mb-0"><i class="bi bi-clock-fill text-info me-2"></i>Lunes a Viernes</p>
                            </div>
                        </div>

                        <!-- Lado Derecho: Formulario -->
                        <div class="col-md-7 p-5 bg-white">
                            <h3 class="fw-bold mb-4 text-primary">Detalles de la Cita</h3>
                            
                            <form action="procesar_cita.php" method="POST">
                                <input type="hidden" name="medico_id" value="<?= $medico['id'] ?>">
                                
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Fecha de la Cita</label>
                                    <input type="date" name="fecha_cita" class="form-control rounded-pill shadow-sm" 
                                           min="<?= date('Y-m-d') ?>" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-bold">Horario Disponible</label>
                                    <select name="hora_cita" class="form-select rounded-pill shadow-sm" required>
                                        <option value="">Selecciona una hora...</option>
                                        <option value="09:00">09:00 AM</option>
                                        <option value="10:00">10:00 AM</option>
                                        <option value="11:00">11:00 AM</option>
                                        <option value="12:00">12:00 PM</option>
                                        <option value="16:00">04:00 PM</option>
                                        <option value="17:00">05:00 PM</option>
                                    </select>
                                </div>

                                <div class="mb-4">
                                    <label class="form-label fw-bold">Motivo de la Consulta</label>
                                    <textarea name="motivo" class="form-control rounded-3 shadow-sm" rows="3" 
                                              placeholder="Describe brevemente tus síntomas..." required></textarea>
                                </div>

                                <button type="submit" class="btn btn-info w-100 rounded-pill fw-bold py-2 shadow">
                                    <i class="bi bi-check2-circle me-2"></i>Confirmar Agendamiento
                                </button>
                                <a href="especialistas.php" class="btn btn-link w-100 text-muted mt-2 small text-decoration-none">Cancelar</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include 'includes/footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>