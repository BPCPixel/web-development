<?php
require_once 'config/db.php';
session_start();

$error = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $tipo_usuario = $_POST['tipo_usuario']; // 'paciente' o 'medico'

    // Determinar en qué tabla buscar
    $tabla = ($tipo_usuario == 'medico') ? 'medicos' : 'pacientes';
    
    $stmt = $pdo->prepare("SELECT * FROM $tabla WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    // NOTA: En producción usarías password_verify. 
    // Para tus datos de prueba actuales, comparamos directo:
    if ($user && $password === $user['contrasenia']) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['nombre'] = $user['nombre'];
        $_SESSION['rol'] = $tipo_usuario;

        // Redirigir según el rol
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
    <link rel="stylesheet" href="css/styles.css">
    <style>
        .login-container { max-width: 400px; margin-top: 100px; }
        .card { border-radius: 20px; border: none; }
    </style>
</head>
<body class="bg-light">

<div class="container login-container">
    <div class="card shadow-lg p-4">
        <div class="text-center mb-4">
            <h2 class="fw-bold text-primary">BINARIA <span class="text-dark">LAB</span></h2>
            <p class="text-muted">Ingresa a tu cuenta</p>
        </div>

        <?php if($error): ?>
            <div class="alert alert-danger py-2 small"><?php echo $error; ?></div>
        <?php endif; ?>

        <form method="POST" action="">
            <div class="mb-3">
                <label class="form-label small fw-bold">Tipo de Usuario</label>
                <select name="tipo_usuario" class="form-select">
                    <option value="paciente">Paciente</option>
                    <option value="medico">Médico / Especialista</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label small fw-bold">Correo Electrónico</label>
                <input type="email" name="email" class="form-control" placeholder="ejemplo@correo.com" required>
            </div>
            <div class="mb-4">
                <label class="form-label small fw-bold">Contraseña</label>
                <input type="password" name="password" class="form-control" placeholder="••••••••" required>
            </div>
            <button type="submit" class="btn btn-primary w-100 fw-bold py-2 shadow-sm">Entrar al Sistema</button>
            <div class="text-center mt-3">
                <p class="small mb-1">¿Eres nuevo paciente?</p>
                <a href="registro.php" class="btn btn-outline-secondary w-100 btn-sm">Crear una cuenta nueva</a>
            </div>
        </form>
        
        <div class="text-center mt-4">
            <a href="index.php" class="text-decoration-none small text-muted">← Volver al inicio</a>
        </div>
    </div>
</div>

</body>
</html>