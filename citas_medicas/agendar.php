<?php
session_start();
include("config/conexion.php");

if (!isset($_SESSION["usuario_id"]) || $_SESSION["rol"] != "paciente") {
    header("Location: ../login.php");
    exit();
}

$usuario_id = $_SESSION["usuario_id"];
$mensaje = "";
$error = "";

/* Obtener doctores disponibles */
$sqlDoctores = "SELECT id, nombre, especialidad FROM doctores ORDER BY nombre ASC";
$resultadoDoctores = $conexion->query($sqlDoctores);

/* Registrar cita */
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $doctor_id = intval($_POST["doctor_id"]);
    $fecha     = $_POST["fecha"];
    $hora      = $_POST["hora"];
    $estado    = "Pendiente";

    /* Validar duplicados */
    $sqlCheck = "SELECT id FROM citas WHERE doctor_id = ? AND fecha = ? AND hora = ?";
    $stmtCheck = $conexion->prepare($sqlCheck);
    $stmtCheck->bind_param("iss", $doctor_id, $fecha, $hora);
    $stmtCheck->execute();
    $stmtCheck->store_result();

    if ($stmtCheck->num_rows > 0) {
        $error = "Ese horario ya está ocupado.";
    } else {
        $sqlInsert = "INSERT INTO citas (usuario_id, doctor_id, fecha, hora, estado)
                      VALUES (?, ?, ?, ?, ?)";
        $stmtInsert = $conexion->prepare($sqlInsert);
        $stmtInsert->bind_param("iisss", $usuario_id, $doctor_id, $fecha, $hora, $estado);

        if ($stmtInsert->execute()) {
            $mensaje = "Cita agendada correctamente.";
        } else {
            $error = "No se pudo registrar la cita.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agendar Cita</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container">
        <a class="navbar-brand fw-bold" href="dashboard.php">🏥 Panel Paciente</a>
        <div class="ms-auto">
            <a href="../logout.php" class="btn btn-outline-light">Cerrar Sesión</a>
        </div>
    </div>
</nav>

<div class="container py-5">
    <div class="card shadow-lg p-4 mx-auto" style="max-width: 700px;">
        <h2 class="text-center mb-4">📅 Agendar Nueva Cita</h2>

        <?php if ($mensaje != ""): ?>
            <div class="alert alert-success"><?php echo $mensaje; ?></div>
        <?php endif; ?>

        <?php if ($error != ""): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>

        <form method="POST">
            <div class="mb-3">
                <label class="form-label">Selecciona un Doctor</label>
                <select name="doctor_id" class="form-select" required>
                    <option value="">-- Elegir doctor --</option>
                    <?php while ($doctor = $resultadoDoctores->fetch_assoc()): ?>
                        <option value="<?php echo $doctor["id"]; ?>">
                            <?php echo htmlspecialchars($doctor["nombre"]) . " - " . htmlspecialchars($doctor["especialidad"]); ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Fecha</label>
                <input type="date" name="fecha" class="form-control" min="<?php echo date('Y-m-d'); ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Hora</label>
                <input type="time" name="hora" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary w-100">Confirmar Cita</button>
        </form>

        <a href="dashboard.php" class="btn btn-secondary mt-3">⬅ Volver</a>
    </div>
</div>

</body>
</html>