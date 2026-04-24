<?php
session_start();
require_once 'config/db.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Especialistas | BINARIA LAB</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body class="bg-light">
    <?php include 'includes/navbar.php'; ?>

    <div class="container py-5">
        <h2 class="text-center fw-bold mb-5">Equipo Médico Profesional</h2>
        <div class="row g-4">
            <?php
            $sql = "SELECT m.*, esp.nombre as especialidad_nom FROM medicos m JOIN especialidades esp ON m.especialidad_id = esp.id";
            $stmt = $pdo->query($sql);
            while($doc = $stmt->fetch()): 
                $nombre = $doc['nombre'];
                
                // LÓGICA DE IMÁGENES CORREGIDA
                if (stripos($nombre, 'Eduardo') !== false) {
                    $avatar = "https://static.vecteezy.com/system/resources/thumbnails/026/375/249/small/ai-generative-portrait-of-confident-male-doctor-in-white-coat-and-stethoscope-standing-with-arms-crossed-and-looking-at-camera-photo.jpg";
                    $desc = "Director Ejecutivo y Especialista en Sistemas Médicos. Lidera la innovación tecnológica de Binaria Lab.";
                } elseif (stripos($nombre, 'Luis') !== false) {
                    $avatar = "https://i.pinimg.com/236x/3e/43/5f/3e435f79e723b003a2b3c042fed9498f.jpg";
                    $desc = "Especialista en Cardiología con enfoque en diagnóstico digital avanzado.";
                } elseif (stripos($nombre, 'David') !== false) {
                    $avatar = "https://img3.stockfresh.com/files/f/feedough/m/18/3398365_stock-photo-young-doctor-sitting-and-writing.jpg";
                    $desc = "Médico General experto en optimización de flujos de atención hospitalaria.";
                } elseif (stripos($nombre, 'Fernando') !== false) {
                    $avatar = "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRkVlvm_NiEyuvC06TorpxxBKXWQaHQYcS_jg&s";
                    $desc = "Especialista en Dermatología Clínica e Infraestructura de Soporte Médico.";
                } else {
                    $avatar = "https://ui-avatars.com/api/?name=".urlencode($nombre)."&background=0dcaf0&color=fff";
                    $desc = "Especialista certificado de la red médica Binaria Lab.";
                }
            ?>
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm text-center p-4 h-100" style="border-radius: 25px;">
                        <img src="<?= $avatar ?>" class="rounded-circle mx-auto mb-3 shadow" style="width: 130px; height: 130px; object-fit: cover; border: 4px solid #0dcaf0;">
                        <h4 class="fw-bold mb-1">Dr. <?= htmlspecialchars($doc['nombre']." ".$doc['apellido_paterno']) ?></h4>
                        <span class="badge bg-primary px-3 mb-3"><?= htmlspecialchars($doc['especialidad_nom']) ?></span>
                        <p class="small text-muted mb-4"><?= $desc ?></p>
                        <div class="mt-auto">
                            <a href="agendar.php?doc_id=<?= $doc['id'] ?>" class="btn btn-info w-100 rounded-pill fw-bold shadow-sm">Agendar Cita</a>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>

    <?php include 'includes/footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>