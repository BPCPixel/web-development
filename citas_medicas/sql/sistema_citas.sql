CREATE DATABASE sistema_citas;
USE sistema_citas;

-- Tabla de Consultorios
CREATE TABLE consultorios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    ubicacion VARCHAR(255) NOT NULL
);

-- Tabla de Médicos
CREATE TABLE medicos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    apellido_pat VARCHAR(100) NOT NULL,
    especialidad VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    contrasenia VARCHAR(255) NOT NULL,
    consultorio_id INT,
    FOREIGN KEY (consultorio_id) REFERENCES consultorios(id)
);

-- Tabla de Pacientes
CREATE TABLE pacientes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    apellido_pat VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    contrasenia VARCHAR(255) NOT NULL,
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabla de Citas
CREATE TABLE citas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    paciente_id INT,
    medico_id INT,
    fecha_cita DATE NOT NULL,
    hora_cita TIME NOT NULL,
    motivo VARCHAR(255),
    FOREIGN KEY (paciente_id) REFERENCES pacientes(id),
    FOREIGN KEY (medico_id) REFERENCES medicos(id)
);

-- Insertar Consultorios
INSERT INTO consultorios (nombre, ubicacion) VALUES 
('Angelópolis', 'Puebla'), ('Centro Zócalo', 'Puebla'), ('Cholula', 'Puebla');

-- Insertar Doctores
INSERT INTO medicos (nombre, apellido_pat, especialidad, email, contrasenia, consultorio_id) VALUES 
('Luis', 'Guridi', 'General', 'lguridi@correo.com', '123@doctor', 1),
('David', 'Jimenez', 'Pediatría', 'djimenez@correo.com', '123@doctor', 2),
('Fernando', 'Guzman', 'Cardiología', 'fguzman@correo.com', '123@doctor', 3),
('Eduardo', 'Tellez', 'Dermatología', 'etellez@correo.com', '123@doctor', 1),
('José', 'Hernández', 'Odontología', 'jhernandez@correo.com', '123@doctor', 2),
('María', 'García', 'Ginecología', 'mgarcia@correo.com', '123@doctor', 3),
('Francisco', 'López', 'Oftalmología', 'flopez@correo.com', '123@doctor', 1),
('Guadalupe', 'Pérez', 'Nutrición', 'gperez@correo.com', '123@doctor', 2),
('Antonio', 'Martínez', 'Psicología', 'amartinez@correo.com', '123@doctor', 3),
('Juan', 'Sánchez', 'Urología', 'jsanchez@correo.com', '123@doctor', 1),
('Rosa', 'Rodríguez', 'Endocrinología', 'rrodriguez@correo.com', '123@doctor', 2),
('Pedro', 'Cruz', 'Ortopedia', 'pcruz@correo.com', '123@doctor', 3),
('Leticia', 'Flores', 'Neurología', 'lflores@correo.com', '123@doctor', 1);

-- Insertar Pacientes
INSERT INTO pacientes (nombre, apellido_pat, email, contrasenia) VALUES 
('Ximena', 'Rojas', 'ximena@correo.com', '123@paciente'),
('Hugo', 'Sosa', 'hugo@correo.com', '123@paciente'),
('Camila', 'Méndez', 'camila@correo.com', '123@paciente'),
('Roberto', 'Gómez', 'rgomez@correo.com', '123@paciente'),
('Margarita', 'Vázquez', 'mvazquez@correo.com', '123@paciente'),
('Miguel', 'Reyes', 'mreyes@correo.com', '123@paciente'),
('Beatriz', 'Morales', 'bmorales@correo.com', '123@paciente'),
('Ricardo', 'Jiménez', 'rjimenez2@correo.com', '123@paciente'),
('Adriana', 'Torres', 'atorres@correo.com', '123@paciente'),
('Alejandro', 'Ramírez', 'aramirez@correo.com', '123@paciente');
