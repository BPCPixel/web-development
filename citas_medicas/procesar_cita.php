<?php
session_start();
require_once 'config/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $paciente_id = $_SESSION['user_id']; 
    $medico_id   = isset($_POST['medico_id']) ? (int)$_POST['medico_id'] : 0;
    $fecha_cita  = $_POST['fecha_cita'];
    $hora_cita   = $_POST['hora_cita'];
    $motivo      = trim($_POST['motivo']);

    if ($medico_id === 0 || empty($fecha_cita) || empty($hora_cita) || empty($motivo)) {
        header("Location: agenda.php?doc_id=$medico_id&error=campos_vacios");
        exit;
    }

    try {
        // Ajustamos la consulta a tus nombres de columna reales: fecha_cita y hora_cita
        // Usamos 'Pendiente' que es el estado que definiste en tu ENUM
        $sql = "INSERT INTO citas (paciente_id, medico_id, fecha_cita, hora_cita, motivo, estado) 
                VALUES (:paciente_id, :medico_id, :fecha_cita, :hora_cita, :motivo, 'Pendiente')";
        
        $stmt = $pdo->prepare($sql);
        
        $resultado = $stmt->execute([
            ':paciente_id' => $paciente_id,
            ':medico_id'   => $medico_id,
            ':fecha_cita'  => $fecha_cita,
            ':hora_cita'   => $hora_cita,
            ':motivo'      => $motivo
        ]);

        if ($resultado) {
    // Redirige enviando la señal de éxito
    header("Location: dashboard.php?msg=cita_confirmada");
    exit;
}

    } catch (PDOException $e) {
        // Si hay un error de duplicado (médico ocupado), lo manejamos aquí
        if ($e->getCode() == 23000) {
            header("Location: agenda.php?doc_id=$medico_id&error=horario_ocupado");
        } else {
            die("Error crítico en la red de Binaria Lab: " . $e->getMessage());
        }
        exit;
    }

} else {
    header("Location: especialistas.php");
    exit;
}