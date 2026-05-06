<?php
$titulo_pagina = 'Mi Perfil - Ciudad Activa';
$css_adicional = '../css/perfil.css';
require_once '../includes/header.php';
require_once '../includes/conexion.php';

if (!isset($_SESSION['usuario_id'])) {
    header('Location: ../auth/login.php');
    exit();
}
?>

<div class="dashboard">
    <?php require_once '../includes/sidebar.php'; ?>
    
    <div class="main-content">
        <div class="perfil-container">
            <!-- Header del Perfil -->
            <div class="perfil-header">
                <div class="avatar-grande"><?php echo strtoupper(substr($_SESSION['usuario_nombre'], 0, 1)); ?></div>
                <h2><?php echo htmlspecialchars($_SESSION['usuario_nombre']); ?></h2>
                <p class="perfil-email"><?php echo htmlspecialchars($_SESSION['usuario_email']); ?></p>
                
                <?php
                $sql = 'SELECT fecha_creacion FROM usuarios WHERE id = ?';
                $stmt = $conexion->prepare($sql);
                $stmt->bind_param('i', $_SESSION['usuario_id']);
                $stmt->execute();
                $resultado = $stmt->get_result()->fetch_assoc();
                ?>
                <p class="perfil-fecha">Miembro desde: <?php echo date('d \d\e F \d\e Y', strtotime($resultado['fecha_creacion'])); ?></p>
            </div>
            
            <!-- Estadísticas -->
            <div class="perfil-stats">
                <div class="stat-box">
                    <h3>Total de Reportes</h3>
                    <?php
                    $sql = 'SELECT COUNT(*) as total FROM reportes WHERE usuario_id = ?';
                    $stmt = $conexion->prepare($sql);
                    $stmt->bind_param('i', $_SESSION['usuario_id']);
                    $stmt->execute();
                    $resultado = $stmt->get_result()->fetch_assoc();
                    ?>
                    <div class="stat-valor"><?php echo $resultado['total']; ?></div>
                </div>
                
                <div class="stat-box">
                    <h3>Reportes Resueltos</h3>
                    <?php
                    $sql = 'SELECT COUNT(*) as total FROM reportes WHERE usuario_id = ? AND estado = "resuelto"';
                    $stmt = $conexion->prepare($sql);
                    $stmt->bind_param('i', $_SESSION['usuario_id']);
                    $stmt->execute();
                    $resultado = $stmt->get_result()->fetch_assoc();
                    ?>
                    <div class="stat-valor"><?php echo $resultado['total']; ?></div>
                </div>
                
                <div class="stat-box">
                    <h3>Reportes Activos</h3>
                    <?php
                    $sql = 'SELECT COUNT(*) as total FROM reportes WHERE usuario_id = ? AND estado IN ("pendiente", "en_proceso")';
                    $stmt = $conexion->prepare($sql);
                    $stmt->bind_param('i', $_SESSION['usuario_id']);
                    $stmt->execute();
                    $resultado = $stmt->get_result()->fetch_assoc();
                    ?>
                    <div class="stat-valor"><?php echo $resultado['total']; ?></div>
                </div>
            </div>
            
            <!-- Información del Usuario -->
            <div class="perfil-info">
                <h3>Información de la Cuenta</h3>
                
                <div class="info-fila">
                    <span class="info-label">Nombre:</span>
                    <span class="info-valor"><?php echo htmlspecialchars($_SESSION['usuario_nombre']); ?></span>
                </div>
                
                <div class="info-fila">
                    <span class="info-label">Correo Electrónico:</span>
                    <span class="info-valor"><?php echo htmlspecialchars($_SESSION['usuario_email']); ?></span>
                </div>
                
                <div class="info-fila">
                    <span class="info-label">Rol:</span>
                    <span class="info-valor">Ciudadano</span>
                </div>
            </div>
            
            <!-- Acciones -->
            <div class="perfil-acciones">
                <button class="btn btn-primary" onclick="alert('Funcionalidad de editar perfil')">Editar Perfil</button>
                <button class="btn btn-secondary" onclick="alert('Funcionalidad de cambiar contraseña')">Cambiar Contraseña</button>
                <a href="../logout.php" class="btn btn-danger">Cerrar Sesión</a>
            </div>
        </div>
    </div>
</div>

<?php 
$stmt->close();
$conexion->close();
require_once '../includes/footer.php'; 
?>
