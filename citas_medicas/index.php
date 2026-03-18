<?php require_once 'config/db.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BINARIA LAB | Gestión de Citas</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">
                <span class="text-info">BINARIA</span> LAB
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link active" href="index.php">Inicio</a></li>
                    <li class="nav-item"><a class="nav-link" href="#consultorios">Sucursales</a></li>
                    <li class="nav-item"><a class="nav-link" href="#doctores">Especialistas</a></li>
                    <li class="nav-item"><a class="btn btn-outline-info ms-lg-3" href="login.php">Iniciar Sesión</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <header class="hero text-center">
        <div class="container">
            <h1 class="display-4">Bienvenido a <span>BINARIA LAB</span></h1>
            <p class="lead">Sistema inteligente de gestión de citas médicas en Puebla.</p>
            <a href="#doctores" class="btn btn-info btn-lg mt-3 px-5 shadow">Agendar Ahora</a>
        </div>
    </header>

    <main class="container my-5">
        
        <section id="consultorios" class="py-5">
            <h2 class="section-title">Nuestras Sedes</h2>
            <div class="row g-4">
                <?php
                $stmt = $pdo->query("SELECT * FROM consultorios");
                while ($row = $stmt->fetch()): ?>
                <div class="col-md-4">
                    <div class="card h-100 card-consultorio shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title text-primary fw-bold"><?php echo htmlspecialchars($row['nombre']); ?></h5>
                            <p class="card-text text-muted">
                                <i class="bi bi-geo-alt"></i> <?php echo htmlspecialchars($row['ubicacion']); ?>
                            </p>
                            <span class="badge bg-light text-dark">Ext: <?php echo $row['extension_tel']; ?></span>
                        </div>
                    </div>
                </div>
                <?php endwhile; ?>
            </div>
        </section>

        <section id="doctores" class="py-5">
            <h2 class="section-title text-dark">Nuestros Especialistas</h2>
            <div class="table-responsive bg-white p-4 shadow rounded-4">
                <table class="table table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>Médico</th>
                            <th>Especialidad</th>
                            <th>Sede</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Hacemos un JOIN para traer el nombre del consultorio en lugar del ID
                        $sql = "SELECT m.nombre, m.apellido_paterno, m.especialidad, c.nombre as sede 
                                FROM medicos m 
                                JOIN consultorios c ON m.consultorio_id = c.id";
                        $stmt = $pdo->query($sql);
                        while ($medico = $stmt->fetch()): ?>
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="fw-bold">Dr. <?php echo $medico['nombre'] . " " . $medico['apellido_paterno']; ?></div>
                                </div>
                            </td>
                            <td><span class="badge bg-primary"><?php echo $medico['especialidad']; ?></span></td>
                            <td><?php echo $medico['sede']; ?></td>
                            <td>
                                <a href="agendar.php" class="btn btn-sm btn-success rounded-pill px-3">Cita rápida</a>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </section>

    </main>

    <footer class="bg-dark text-white text-center py-4">
        <div class="container">
            <p class="mb-0">© 2026 BINARIA LAB | Gatitos hackers</p>
            <small class="text-muted">Diseñado para la excelencia en salud.</small>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>