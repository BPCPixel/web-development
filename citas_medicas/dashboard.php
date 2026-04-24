<?php
session_start();
require_once 'config/db.php';
if (!isset($_SESSION['user_id'])) { header("Location: login.php"); exit; }
$rol = $_SESSION['rol'];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Dashboard | BINARIA LAB</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body class="bg-light">
    <?php include 'includes/navbar.php'; ?>
    <div class="container mt-5">
        <h2 class="fw-bold">Bienvenido, <?= $_SESSION['nombre'] ?></h2>
        
        <div class="row g-4 mt-3">
            <div class="col-md-4">
                <a href="<?= ($rol == 'medico') ? 'agenda_medico.php' : 'mis_citas.php' ?>" class="text-decoration-none text-dark">
                    <div class="card border-0 shadow-sm p-4 text-center h-100">
                        <i class="bi bi-calendar-check text-primary fs-1"></i>
                        <h5 class="mt-2">Mis Citas</h5>
                    </div>
                </a>
            </div>

            <div class="col-md-4">
                <a href="especialistas.php" class="text-decoration-none text-dark">
                    <div class="card border-0 shadow-sm p-4 text-center h-100">
                        <i class="bi bi-people text-info fs-1"></i>
                        <h5 class="mt-2">Especialistas</h5>
                    </div>
                </a>
            </div>

            <div class="col-md-4">
                <?php if ($rol === 'medico'): ?>
                    <a href="ver_pacientes.php" class="text-decoration-none text-dark">
                        <div class="card border-0 shadow-sm p-4 text-center h-100 border-start border-info border-4">
                            <i class="bi bi-person-heart text-danger fs-1"></i>
                            <h5 class="mt-2">Lista de Pacientes</h5>
                        </div>
                    </a>
                <?php else: ?>
                    <div class="card border-0 shadow-sm p-4 text-center h-100 opacity-50 bg-white">
                        <i class="bi bi-lock-fill text-muted fs-1"></i>
                        <h5 class="mt-2 text-muted">Pacientes</h5>
                        <p class="small mb-0">Solo personal médico</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <?php include 'includes/footer.php'; ?>

<!-- 1. Librería SweetAlert2 (Carga rápida desde CDN) -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- 2. Lógica para mostrar la palomita verde -->
<?php if(isset($_GET['msg']) && $_GET['msg'] == 'cita_confirmada'): ?>
<script>
    Swal.fire({
        title: '¡Cita Confirmada!',
        text: 'Tu solicitud ha sido registrada con éxito en el sistema de Binaria Lab.',
        icon: 'success',
        iconColor: '#0dcaf0', // El azul de tu marca
        confirmButtonColor: '#0dcaf0',
        confirmButtonText: 'Entendido',
        buttonsStyling: true,
        customClass: {
            popup: 'rounded-4 shadow',
            confirmButton: 'rounded-pill px-4 fw-bold'
        }
    });
    
    // Limpiar la URL para que no vuelva a aparecer al recargar
    window.history.replaceState({}, document.title, "dashboard.php");
</script>
<?php endif; ?>

<?php if(isset($_GET['error']) && $_GET['error'] == 'horario_ocupado'): ?>
<script>
    Swal.fire({
        title: 'Horario no disponible',
        text: 'Este especialista ya tiene una cita programada en esa hora. Por favor, elige otro horario.',
        icon: 'warning',
        confirmButtonColor: '#ffc107',
        confirmButtonText: 'Intentar de nuevo'
    });
    window.history.replaceState({}, document.title, "dashboard.php");
</script>
<?php endif; ?>

<!-- 3. Tus scripts existentes -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>