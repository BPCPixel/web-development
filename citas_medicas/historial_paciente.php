<?php
session_start();
require_once 'config/db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['rol'] !== 'medico') {
    header("Location: login.php");
    exit;
}

$pac_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($pac_id === 0) { header("Location: ver_pacientes.php"); exit; }

$stmt = $pdo->prepare("SELECT * FROM pacientes WHERE id = ?");
$stmt->execute([$pac_id]);
$paciente = $stmt->fetch();
if (!$paciente) { die("Error: Paciente no encontrado."); }

$sql_citas = "SELECT c.*, m.nombre as doc_nom, m.apellido_paterno as doc_ape, esp.nombre as especialidad
              FROM citas c
              JOIN medicos m ON c.medico_id = m.id
              JOIN especialidades esp ON m.especialidad_id = esp.id
              WHERE c.paciente_id = ?
              ORDER BY c.fecha_cita DESC";
$stmt_citas = $pdo->prepare($sql_citas);
$stmt_citas->execute([$pac_id]);
$citas = $stmt_citas->fetchAll();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Historial: <?= htmlspecialchars($paciente['nombre']) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body class="bg-light">
    <?php include 'includes/navbar.php'; ?>
    <div class="container py-5">
        <div class="row g-4">
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm p-4 text-center mb-4" style="border-radius: 20px;">
                    <img src="https://ui-avatars.com/api/?name=<?= urlencode($paciente['nombre'].'+'.$paciente['apellido_paterno']) ?>&background=0dcaf0&color=fff&size=150" class="rounded-circle mx-auto mb-3 shadow" width="120">
                    <h4 class="fw-bold"><?= htmlspecialchars($paciente['nombre'] . " " . $paciente['apellido_paterno']) ?></h4>
                    <hr>
                    <div class="text-start small text-muted">
                        <p class="mb-1"><strong>Email:</strong> <?= htmlspecialchars($paciente['email']) ?></p>
                        <p class="mb-0"><strong>Tel:</strong> <?= htmlspecialchars($paciente['telefono'] ?: 'N/A') ?></p>
                    </div>
                </div>
                <div class="card border-0 shadow-sm bg-dark text-white p-3" style="border-radius: 20px;">
                    <img src="https://images.pexels.com/photos/668298/pexels-photo-668298.jpeg?auto=compress&cs=tinysrgb&w=400" class="img-fluid rounded-3 mb-2" style="height: 150px; object-fit: cover;">
                    <p class="small mb-0 text-center opacity-75">Sede Médica Binaria | Puebla</p>
                </div>
            </div>

            <div class="col-lg-8">
                <h4 class="fw-bold mb-4">Registro Médico</h4>
                <?php foreach ($citas as $c): 
                    $nombreDoc = $c['doc_nom'];
                    // LÓGICA DE FOTOS CORREGIDA PARA EL HISTORIAL
                    if (stripos($nombreDoc, 'Eduardo') !== false) {
                        $imgDoc = "https://static.vecteezy.com/system/resources/thumbnails/026/375/249/small/ai-generative-portrait-of-confident-male-doctor-in-white-coat-and-stethoscope-standing-with-arms-crossed-and-looking-at-camera-photo.jpg";
                    } elseif (stripos($nombreDoc, 'Luis') !== false) {
                        $imgDoc = "https://i.pinimg.com/236x/3e/43/5f/3e435f79e723b003a2b3c042fed9498f.jpg";
                    } elseif (stripos($nombreDoc, 'David') !== false) {
                        $imgDoc = "https://img3.stockfresh.com/files/f/feedough/m/18/3398365_stock-photo-young-doctor-sitting-and-writing.jpg";
                    } elseif (stripos($nombreDoc, 'Fernando') !== false) {
                        $imgDoc = "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRkVlvm_NiEyuvC06TorpxxBKXWQaHQYcS_jg&s";
                    } else {
                        $imgDoc = "https://ui-avatars.com/api/?name=".urlencode($nombreDoc)."&background=ccc";
                    }
                ?>
                    <div class="card border-0 shadow-sm mb-3" style="border-radius: 15px;">
                        <div class="card-body d-flex gap-3">
                            <div class="bg-info bg-opacity-10 rounded-3 p-3 text-center" style="min-width: 90px;">
                                <h3 class="fw-bold mb-0 text-info"><?= date('d', strtotime($c['fecha_cita'])) ?></h3>
                                <span class="small fw-bold text-muted text-uppercase"><?= date('M', strtotime($c['fecha_cita'])) ?></span>
                            </div>
                            <div class="w-100">
                                <h5 class="fw-bold mb-1 text-primary"><?= htmlspecialchars($c['especialidad']) ?></h5>
                                <div class="d-flex align-items-center mt-2 mb-2">
                                    <img src="<?= $imgDoc ?>" class="rounded-circle me-2" width="30" height="30" style="object-fit: cover;">
                                    <p class="mb-0 small"><strong>Dr. <?= htmlspecialchars($c['doc_nom'] . " " . $c['doc_ape']) ?></strong></p>
                                </div>
                                <div class="p-2 bg-light rounded small">
                                    <?= htmlspecialchars($c['motivo'] ?: 'Consulta general.') ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <?php include 'includes/footer.php'; ?>
</body>
</html>