<?php 
session_start();
require_once 'config/db.php'; 
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BINARIA LAB | Gestión de Citas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body class="bg-light">

    <?php include 'includes/navbar.php'; ?>

    <header class="hero text-center py-5 shadow-sm">
        <div class="container">
            <h1 class="display-4">Bienvenido a <span>BINARIA LAB</span></h1>
            <p class="lead text-white-50">Infraestructura médica de primer nivel en Puebla.</p>
            <a href="#doctores" class="btn btn-info btn-lg mt-3 px-5 shadow">Agendar Ahora</a>
        </div>
    </header>

    <main class="container my-5">
        <section id="consultorios" class="py-5">
            <h2 class="section-title">Nuestras sedes en Puebla</h2>
            <div class="row g-4">
                <?php
                $stmt = $pdo->query("SELECT * FROM consultorios");
                while ($row = $stmt->fetch()): 
                    $nombreSede = mb_strtolower($row['nombre']);
                    
                    // Imágenes de Edificios de Hospitales Profesionales
                    // Sede Norte - Edificio Hospitalario Clásico
                    $img = "https://images.pexels.com/photos/236380/pexels-photo-236380.jpeg?auto=compress&cs=tinysrgb&w=600"; 
                    
                    if (str_contains($nombreSede, 'cholula') || str_contains($nombreSede, 'poniente')) {
                        // Sede Poniente - Edificio Médico Moderno
                        $img = "https://images.pexels.com/photos/668298/pexels-photo-668298.jpeg?auto=compress&cs=tinysrgb&w=600";
                    } elseif (str_contains($nombreSede, 'angel')) {
                        // Sede Angelópolis - Complejo Hospitalario de Lujo
                        $img = "https://images.pexels.com/photos/4386466/pexels-photo-4386466.jpeg?auto=compress&cs=tinysrgb&w=600";
                    }
                ?>
                    <div class="col-md-4">
                        <div class="card h-100 card-consultorio border-0 shadow-sm overflow-hidden" style="border-radius: 20px;">
                            <img src="<?= $img ?>" class="card-img-top" alt="<?= htmlspecialchars($row['nombre']) ?>" style="height: 220px; object-fit: cover;">
                            <div class="card-body">
                                <h5 class="card-title text-primary fw-bold"><?= htmlspecialchars($row['nombre']) ?></h5>
                                <p class="card-text text-muted mb-3 small">
                                    <i class="bi bi-geo-alt-fill text-info me-1"></i> <?= htmlspecialchars($row['ubicacion']) ?>
                                </p>
                                <span class="badge bg-light text-dark border">Extensión: <?= $row['extension_tel'] ?></span>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        </section>

        <section id="doctores" class="py-5">
            <div class="row mb-4 align-items-center">
                <div class="col-md-6"><h2 class="section-title text-dark mb-0">Médicos</h2></div>
                <div class="col-md-6">
                    <div class="input-group shadow-sm">
                        <span class="input-group-text bg-white border-end-0"><i class="bi bi-search text-info"></i></span>
                        <input type="text" id="searchDoc" class="form-control border-start-0" placeholder="Filtrar por nombre o especialidad...">
                    </div>
                </div>
            </div>

            <div class="table-responsive bg-white p-4 shadow rounded-4">
                <table class="table table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>Médico</th>
                            <th>Especialidad</th>
                            <th>Ubicación</th>
                            <th class="text-center">Acción</th>
                        </tr>
                    </thead>
                    <tbody id="tableMedicos">
                        <?php
                        $sql = "SELECT m.id, m.nombre, m.apellido_paterno, esp.nombre as especialidad_nom, c.nombre as sede 
                                FROM medicos m 
                                JOIN especialidades esp ON m.especialidad_id = esp.id
                                JOIN consultorios c ON m.consultorio_id = c.id";
                        $stmt = $pdo->query($sql);
                        while ($medico = $stmt->fetch()): ?>
                            <tr class="medico-row">
                                <td class="fw-bold">Dr. <?= htmlspecialchars($medico['nombre'] . " " . $medico['apellido_paterno']) ?></td>
                                <td><span class="badge bg-primary rounded-pill px-3"><?= htmlspecialchars($medico['especialidad_nom']) ?></span></td>
                                <td><?= htmlspecialchars($medico['sede']) ?></td>
                                <td class="text-center">
                                    <a href="especialistas.php" class="btn btn-sm btn-outline-info rounded-pill px-4 fw-bold">Ver Perfil</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </section>
    </main>

    <?php include 'includes/footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/main.js"></script>
</body>
</html>