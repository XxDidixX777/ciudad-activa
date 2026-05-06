<?php
/**
 * Procesar registro de usuario
 */

require_once '../includes/conexion.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: registro.php');
    exit();
}

$nombre = $_POST['nombre'] ?? '';
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';
$password_confirm = $_POST['password_confirm'] ?? '';

if (empty($nombre) || empty($email) || empty($password) || empty($password_confirm)) {
    header('Location: registro.php?error=Por favor completa todos los campos');
    exit();
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header('Location: registro.php?error=El correo no es válido');
    exit();
}

if ($password !== $password_confirm) {
    header('Location: registro.php?error=Las contraseñas no coinciden');
    exit();
}

if (strlen($password) < 6) {
    header('Location: registro.php?error=La contraseña debe tener al menos 6 caracteres');
    exit();
}

// Verificar si el correo ya existe
$sql = 'SELECT id FROM usuarios WHERE email = ?';
$stmt = $conexion->prepare($sql);
$stmt->bind_param('s', $email);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows > 0) {
    header('Location: registro.php?error=Este correo ya está registrado');
    exit();
}

// Hashear contraseña
$password_hash = password_hash($password, PASSWORD_DEFAULT);

// Insertar nuevo usuario
$sql = 'INSERT INTO usuarios (nombre, email, contraseña, fecha_creacion) VALUES (?, ?, ?, NOW())';
$stmt = $conexion->prepare($sql);

if (!$stmt) {
    header('Location: registro.php?error=Error en la consulta');
    exit();
}

$stmt->bind_param('sss', $nombre, $email, $password_hash);

if ($stmt->execute()) {
    $stmt->close();
    $conexion->close();
    header('Location: login.php?success=Registro exitoso. Por favor, inicia sesión');
    exit();
} else {
    $stmt->close();
    $conexion->close();
    header('Location: registro.php?error=Error al registrar el usuario');
    exit();
}
?>
