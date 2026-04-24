<?php
require_once 'config/db.php';
$mensaje = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = trim($_POST['nombre']);
    $ape_pat = trim($_POST['apellido_paterno']);
    $ape_mat = trim($_POST['apellido_materno']);
    $email = trim($_POST['email']);
    $telefono = trim($_POST['telefono']);
    $pass = $_POST['password']; // Texto plano para pruebas

    try {
        $sql = "INSERT INTO pacientes (nombre, apellido_paterno, apellido_materno, email, contrasenia, telefono) 
                VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        
        if ($stmt->execute([$nombre, $ape_pat, $ape_mat, $email, $pass, $telefono])) {
            echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
            echo "<script>
                window.onload = function() {
                    Swal.fire({
                        title: '¡Registro Exitoso!',
                        text: 'Paciente registrado en Binaria Lab.',
                        icon: 'success',
                        confirmButtonColor: '#0dcaf0'
                    }).then(() => { window.location.href = 'login.php'; });
                };
            </script>";
            exit;
        }
    } catch (PDOException $e) {
        $mensaje = ($e->getCode() == 23000) ? "El correo ya existe." : "Error: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro | BINARIA LAB</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>.rounded-pill { border-radius: 50px; }</style>
</head>
<body class="bg-light">
    <div class="container py-5">
        <div class="card mx-auto shadow border-0" style="max-width: 600px; border-radius: 20px;">
            <div class="card-body p-4">
                <h3 class="fw-bold text-center text-info mb-4">Registro de Paciente</h3>
                <?php if($mensaje): ?> <div class="alert alert-danger small"><?= $mensaje ?></div> <?php endif; ?>
                <form method="POST">
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Nombre(s)</label>
                        <input type="text" name="nombre" class="form-control rounded-pill" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label small fw-bold">Apellido Paterno</label>
                            <input type="text" name="apellido_paterno" class="form-control rounded-pill" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label small fw-bold">Apellido Materno</label>
                            <input type="text" name="apellido_materno" class="form-control rounded-pill">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8 mb-3">
                            <label class="form-label small fw-bold">Correo Electrónico</label>
                            <input type="email" name="email" class="form-control rounded-pill" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label small fw-bold">Teléfono</label>
                            <input type="text" name="telefono" class="form-control rounded-pill" required>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="form-label small fw-bold">Contraseña</label>
                        <input type="password" name="password" class="form-control rounded-pill" required>
                    </div>
                    <button type="submit" class="btn btn-info w-100 fw-bold rounded-pill shadow-sm">Registrar Paciente</button>
                    <div class="text-center mt-3"><a href="login.php" class="text-muted small">¿Ya tienes cuenta? Inicia sesión</a></div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>