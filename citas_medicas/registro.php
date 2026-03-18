<?php
require_once 'config/db.php';
session_start();

$mensaje = "";
$tipo_alerta = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $ap_paterno = $_POST['apellido_paterno'];
    $ap_materno = $_POST['apellido_materno'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];
    $pass = $_POST['password'];
    $confirm_pass = $_POST['confirm_password'];

    // Validaciones básicas
    if ($pass !== $confirm_pass) {
        $mensaje = "Las contraseñas no coinciden.";
        $tipo_alerta = "danger";
    } else {
        try {
            // Verificar si el correo ya existe
            $checkEmail = $pdo->prepare("SELECT id FROM pacientes WHERE email = ?");
            $checkEmail->execute([$email]);
            
            if ($checkEmail->fetch()) {
                $mensaje = "Este correo ya está registrado. Intenta iniciar sesión.";
                $tipo_alerta = "warning";
            } else {
                // Insertar nuevo paciente
                $sql = "INSERT INTO pacientes (nombre, apellido_paterno, apellido_materno, email, telefono, contrasenia) 
                        VALUES (?, ?, ?, ?, ?, ?)";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([$nombre, $ap_paterno, $ap_materno, $email, $telefono, $pass]);

                $mensaje = "¡Registro exitoso! Ya puedes iniciar sesión.";
                $tipo_alerta = "success";
            }
        } catch (PDOException $e) {
            $mensaje = "Error en el registro: " . $e->getMessage();
            $tipo_alerta = "danger";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Paciente | BINARIA LAB</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body class="bg-light">

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg border-0 rounded-4 p-4">
                <div class="text-center mb-4">
                    <h2 class="fw-bold text-primary">Crear Cuenta</h2>
                    <p class="text-muted">Únete a la red médica de BINARIA LAB</p>
                </div>

                <?php if($mensaje): ?>
                    <div class="alert alert-<?php echo $tipo_alerta; ?> alert-dismissible fade show">
                        <?php echo $mensaje; ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>

                <form method="POST" action="">
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Nombre(s)</label>
                        <input type="text" name="nombre" class="form-control" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label small fw-bold">Apellido Paterno</label>
                            <input type="text" name="apellido_paterno" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label small fw-bold">Apellido Materno</label>
                            <input type="text" name="apellido_materno" class="form-control">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Correo Electrónico</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Teléfono</label>
                        <input type="tel" name="telefono" class="form-control" placeholder="2221234567">
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label small fw-bold">Contraseña</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-4">
                            <label class="form-label small fw-bold">Confirmar</label>
                            <input type="password" name="confirm_password" class="form-control" required>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary w-100 fw-bold py-2 shadow">Registrarme</button>
                </form>

                <div class="text-center mt-4">
                    <p class="small">¿Ya tienes cuenta? <a href="login.php" class="text-decoration-none">Inicia sesión aquí</a></p>
                    <a href="index.php" class="text-muted small text-decoration-none">← Volver al inicio</a>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>