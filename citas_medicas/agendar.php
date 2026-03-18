<?php
require_once 'config/db.php';
session_start();

// Seguridad: Solo pacientes logueados pueden agendar
if (!isset($_SESSION['user_id']) || $_SESSION['rol'] !== 'paciente') {
    header("Location: login.php");
    exit;
}

$mensaje = "";
$tipo_alerta = "";

// LÓGICA PARA GUARDAR LA CITA
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $paciente_id = $_SESSION['user_id'];
    $medico_id = $_POST['medico_id'];
    $fecha = $_POST['fecha'];
    $hora = $_POST['hora'];
    $motivo = $_POST['motivo'];

    try {
        $sql = "INSERT INTO citas (paciente_id, medico_id, fecha_cita, hora_cita, motivo, estado) 
                VALUES (?, ?, ?, ?, ?, 'Pendiente')";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$paciente_id, $medico_id, $fecha, $hora, $motivo]);
        
        $mensaje = "¡Cita agendada con éxito! El médico la revisará pronto.";
        $tipo_alerta = "success";
    } catch (PDOException $e) {
        // Si el UNIQUE KEY que pusimos en el SQL detecta choque de horario:
        if ($e->getCode() == 23000) {
            $mensaje = "Error: El médico ya tiene una cita a esa hora. Elige otro horario.";
            $tipo_alerta = "danger";
        } else {
            $mensaje = "Error al agendar: " . $e->getMessage();
            $tipo_alerta = "danger";
        }
    }
}

// Obtener lista de médicos para el formulario
$stmt = $pdo->query("SELECT m.id, m.nombre, m.apellido_paterno, m.especialidad, c.nombre as sede 
                     FROM medicos m JOIN consultorios c ON m.consultorio_id = c.id");
$medicos = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agendar Cita | BINARIA LAB</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body class="bg-light">

    <nav class="navbar navbar-dark bg-primary shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="dashboard.php">BINARIA LAB</a>
            <a href="dashboard.php" class="btn btn-outline-light btn-sm">Volver al Panel</a>
        </div>
    </nav>

    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-lg border-0 rounded-4">
                    <div class="card-body p-5">
                        <h2 class="text-center fw-bold mb-4">Nueva Cita Médica</h2>
                        
                        <?php if($mensaje): ?>
                            <div class="alert alert-<?php echo $tipo_alerta; ?> alert-dismissible fade show">
                                <?php echo $mensaje; ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        <?php endif; ?>

                        <form method="POST" action="">
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label class="form-label fw-bold">Selecciona al Especialista</label>
                                    <select name="medico_id" class="form-select form-select-lg" required>
                                        <option value="">-- Seleccionar Médico --</option>
                                        <?php foreach($medicos as $m): ?>
                                            <option value="<?php echo $m['id']; ?>">
                                                Dr. <?php echo $m['nombre']." ".$m['apellido_paterno']." - ".$m['especialidad']." (".$m['sede'].")"; ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Fecha de la Cita</label>
                                    <input type="date" name="fecha" class="form-control" min="<?php echo date('Y-m-d'); ?>" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Hora</label>
                                    <select name="hora" class="form-select" required>
                                        <option value="09:00:00">09:00 AM</option>
                                        <option value="10:00:00">10:00 AM</option>
                                        <option value="11:00:00">11:00 AM</option>
                                        <option value="12:00:00">12:00 PM</option>
                                        <option value="16:00:00">04:00 PM</option>
                                        <option value="17:00:00">05:00 PM</option>
                                    </select>
                                </div>

                                <div class="col-md-12 mb-4">
                                    <label class="form-label fw-bold">Motivo de la consulta</label>
                                    <textarea name="motivo" class="form-control" rows="3" placeholder="Describe brevemente tus síntomas..." required></textarea>
                                </div>

                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary btn-lg w-100 shadow-sm fw-bold">Confirmar Cita</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>