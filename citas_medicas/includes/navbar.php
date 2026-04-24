<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top shadow-sm py-3">
    <div class="container">
        <a class="navbar-brand fw-bold fs-4" href="index.php">
            <i class="bi bi-cpu-fill text-info me-2"></i><span class="text-info">BINARIA</span> LAB
        </a>
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarBinaria" aria-controls="navbarBinaria" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarBinaria">
            <ul class="navbar-nav ms-auto align-items-center">
                <li class="nav-item mx-2">
                    <a class="nav-link" href="index.php#consultorios"><i class="bi bi-geo-alt me-1"></i>Sedes</a>
                </li>
                <li class="nav-item mx-2">
                    <a class="nav-link" href="especialistas.php"><i class="bi bi-person-badge me-1"></i>Especialistas</a>
                </li>

                <?php if(isset($_SESSION['user_id'])): ?>
                    <!-- Menú Desplegable del Usuario (Perfil) -->
                    <li class="nav-item dropdown ms-lg-3">
                        <a class="nav-link dropdown-toggle btn btn-outline-info px-4 rounded-pill text-white" href="#" id="userMenu" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-circle me-2"></i><?= explode(' ', $_SESSION['nombre'])[0] ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow border-0 mt-2" aria-labelledby="userMenu">
                            <li><a class="dropdown-item" href="dashboard.php"><i class="bi bi-speedometer2 me-2"></i>Dashboard</a></li>
                            <?php if($_SESSION['rol'] == 'paciente'): ?>
                                <li><a class="dropdown-item" href="mis_citas.php"><i class="bi bi-calendar-event me-2"></i>Mis Citas</a></li>
                            <?php else: ?>
                                <li><a class="dropdown-item" href="agenda_medico.php"><i class="bi bi-calendar-check me-2"></i>Mi Agenda</a></li>
                                <li><a class="dropdown-item" href="ver_pacientes.php"><i class="bi bi-people me-2"></i>Pacientes</a></li>
                            <?php endif; ?>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item text-danger" href="logout.php"><i class="bi bi-box-arrow-right me-2"></i>Cerrar Sesión</a></li>
                        </ul>
                    </li>
                <?php else: ?>
                    <li class="nav-item ms-lg-3">
                        <a class="btn btn-info px-4 rounded-pill fw-bold shadow-sm" href="login.php">Acceso Staff</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>