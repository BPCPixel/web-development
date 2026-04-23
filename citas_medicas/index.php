<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Citas Médicas</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Estilos -->
    <link rel="stylesheet" href="css/styles.css">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
</head>
<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark sticky-top">
    <div class="container">
        <a class="navbar-brand fw-bold" href="#">🏥 MediCare Plus</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menuNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="menuNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a href="#servicios" class="nav-link">Servicios</a></li>
                <li class="nav-item"><a href="#doctores" class="nav-link">Doctores</a></li>
                <li class="nav-item"><a href="login.php" class="nav-link">Iniciar Sesión</a></li>
                <li class="nav-item">
                    <a href="registro.php" class="btn btn-primary ms-2">Registrarse</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- HERO -->
<section class="hero">
    <div class="container fade-up">
        <h1 class="display-4 fw-bold">
            Tu salud, <span>nuestra prioridad</span>
        </h1>
        <p class="lead mt-3">
            Agenda citas médicas en línea de manera rápida, segura y eficiente.
        </p>
        <a href="registro.php" class="btn btn-light btn-lg mt-4 px-4">
            Agendar Ahora
        </a>
    </div>
</section>

<!-- SERVICIOS -->
<section id="servicios" class="py-5">
    <div class="container text-center">
        <h2 class="section-title">Nuestros Servicios</h2>

        <div class="row mt-5 g-4">
            <div class="col-md-4">
                <div class="card p-4 fade-up">
                    <h4>Consulta General</h4>
                    <p>Atención médica integral para todas las edades.</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card p-4 fade-up">
                    <h4>Especialistas</h4>
                    <p>Doctores altamente capacitados en diversas áreas.</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card p-4 fade-up">
                    <h4>Agenda Digital</h4>
                    <p>Reserva y gestiona tus citas desde cualquier lugar.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- DOCTORES -->
<section id="doctores" class="py-5 bg-light">
    <div class="container text-center">
        <h2 class="section-title">Nuestro Equipo Médico</h2>

        <div class="row mt-5 g-4">
            <div class="col-md-4">
                <div class="card card-consultorio">
                    <img src="img/doctor1.jpg" class="card-img-top rounded" alt="Doctor">
                    <div class="card-body">
                        <h5 class="card-title">Dr. Carlos Ramírez</h5>
                        <p class="card-text">Cardiología</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card card-consultorio">
                    <img src="img/doctor2.jpg" class="card-img-top rounded" alt="Doctor">
                    <div class="card-body">
                        <h5 class="card-title">Dra. Sofía Herrera</h5>
                        <p class="card-text">Pediatría</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card card-consultorio">
                    <img src="img/doctor3.jpg" class="card-img-top rounded" alt="Doctor">
                    <div class="card-body">
                        <h5 class="card-title">Dr. Miguel Torres</h5>
                        <p class="card-text">Neurología</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FOOTER -->
<footer class="text-center">
    <div class="container">
        <p class="mb-0">© 2026 MediCare Plus - Sistema de Citas Médicas</p>
    </div>
</footer>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="js/main.js"></script>

</body>
</html>