<?php
require_once 'config/db.php';
session_start();

$error = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $tipo_usuario = $_POST['tipo_usuario']; // 'paciente' o 'medico'

    // Determinamos la tabla según la elección del usuario
    $tabla = ($tipo_usuario == 'medico') ? 'medicos' : 'pacientes';
    
    $stmt = $pdo->prepare("SELECT * FROM $tabla WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    // Verificación de credenciales (Comparación directa para tus pruebas actuales)
    if ($user && $password === $user['contrasenia']) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['nombre'] = $user['nombre'];
        $_SESSION['rol'] = $tipo_usuario;
        
        header("Location: dashboard.php");
        exit;
    } else {
        $error = "Correo o contraseña incorrectos.";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Acceso | BINARIA LAB</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body class="bg-light">
    
    <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="card shadow-lg border-0 rounded-4 p-4" style="max-width: 400px; width: 100%;">
            <div class="text-center mb-4">
                <h2 class="fw-bold text-primary"><i class="bi bi-cpu-fill"></i> BINARIA <span class="text-dark">LAB</span></h2>
                <p class="text-muted">Ingresa a tu cuenta de gestión</p>
            </div>

            <?php if($error): ?>
                <div class="alert alert-danger py-2 small animate__animated animate__shakeX"><?= $error ?></div>
            <?php endif; ?>

            <form method="POST" id="loginForm">
                <div class="mb-3">
                    <label class="form-label small fw-bold">Tipo de Usuario</label>
                    <select name="tipo_usuario" class="form-select border-0 bg-light">
                        <option value="paciente">Paciente</option>
                        <option value="medico">Médico / Especialista</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label small fw-bold">Correo Electrónico</label>
                    <input type="email" name="email" class="form-control border-0 bg-light" placeholder="ejemplo@binarialab.com" required>
                </div>
                <div class="mb-4">
                    <label class="form-label small fw-bold">Contraseña</label>
                    <input type="password" name="password" class="form-control border-0 bg-light" placeholder="........" required>
                </div>

                <button type="submit" class="btn btn-primary w-100 fw-bold py-2 shadow-sm mb-3">Entrar al Sistema</button>
                
                <div class="text-center">
                    <p class="small mb-1">¿Nuevo paciente?</p>
                    <a href="registro.php" class="text-decoration-none fw-bold text-info">Crea una cuenta aquí</a>
                    <hr>
                    <a href="index.php" class="text-muted small text-decoration-none"><i class="bi bi-arrow-left"></i> Volver al inicio</a>
                </div>
            </form>
        </div>
    </div>

    <script src="js/main.js"></script>
</body>
</html>