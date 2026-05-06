<?php
/**
 * Guardar nuevo reporte en la base de datos
 */

require_once '../includes/conexion.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: crear.php');
    exit();
}

if (!isset($_SESSION['usuario_id'])) {
    header('Location: ../auth/login.php');
    exit();
}

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$titulo = $_POST['titulo'] ?? '';
$descripcion = $_POST['descripcion'] ?? '';
$categoria = $_POST['categoria'] ?? '';
$ubicacion = $_POST['ubicacion'] ?? '';
$usuario_id = $_SESSION['usuario_id'];

if (empty($titulo) || empty($descripcion) || empty($categoria) || empty($ubicacion)) {
    header('Location: crear.php?error=Por favor completa todos los campos requeridos');
    exit();
}

// Procesar imagen si se cargó
$imagen_nombre = null;
if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === 0) {
    $archivo = $_FILES['imagen'];
    
    // Validaciones
    $tipos_permitidos = ['image/jpeg', 'image/png', 'image/gif'];
    $tamaño_maximo = 5 * 1024 * 1024; // 5MB
    
    if (!in_array($archivo['type'], $tipos_permitidos)) {
        header('Location: crear.php?error=Tipo de archivo no permitido');
        exit();
    }
    
    if ($archivo['size'] > $tamaño_maximo) {
        header('Location: crear.php?error=El archivo es demasiado grande');
        exit();
    }
    
    // Guardar archivo
    $directorio = '../uploads/reportes/';
    if (!is_dir($directorio)) {
        mkdir($directorio, 0755, true);
    }
    
    $nombre_unico = uniqid() . '_' . basename($archivo['name']);
    $ruta_archivo = $directorio . $nombre_unico;
    
    if (move_uploaded_file($archivo['tmp_name'], $ruta_archivo)) {
        $imagen_nombre = $nombre_unico;
    }
}

// Insertar reporte en la base de datos
$sql = 'INSERT INTO reportes (usuario_id, titulo, descripcion, categoria, ubicacion, imagen, estado, fecha_creacion) VALUES (?, ?, ?, ?, ?, ?, "pendiente", NOW())';
$stmt = $conexion->prepare($sql);

if (!$stmt) {
    header('Location: crear.php?error=Error en la consulta');
    exit();
}

$stmt->bind_param('isssss', $usuario_id, $titulo, $descripcion, $categoria, $ubicacion, $imagen_nombre);

if ($stmt->execute()) {
    $stmt->close();
    $conexion->close();
    header('Location: mis_reportes.php?success=Reporte enviado correctamente');
    exit();
} else {
    $stmt->close();
    $conexion->close();
    header('Location: crear.php?error=Error al guardar el reporte');
    exit();
}
?>
