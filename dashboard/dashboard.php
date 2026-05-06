<?php
$titulo_pagina = 'Dashboard - Ciudad Activa';
$css_adicional = '../css/dashboard.css';
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
        <div class="header">
            <h1>Dashboard</h1>
            <div class="user-info">
                <div class="user-avatar"><?php echo strtoupper(substr($_SESSION['usuario_nombre'], 0, 1)); ?></div>
                <span><?php echo htmlspecialchars($_SESSION['usuario_nombre']); ?></span>
            </div>
        </div>
        
        <!-- Estadísticas -->
        <div class="stats-grid">
            <div class="stat-card">
                <h3>Mis Reportes</h3>
                <?php
                $sql = 'SELECT COUNT(*) as total FROM reportes WHERE usuario_id = ?';
                $stmt = $conexion->prepare($sql);
                $stmt->bind_param('i', $_SESSION['usuario_id']);
                $stmt->execute();
                $resultado = $stmt->get_result()->fetch_assoc();
                ?>
                <div class="stat-number"><?php echo $resultado['total']; ?></div>
            </div>
            
            <div class="stat-card">
                <h3>Reportes Resueltos</h3>
                <?php
                $sql = 'SELECT COUNT(*) as total FROM reportes WHERE usuario_id = ? AND estado = "resuelto"';
                $stmt = $conexion->prepare($sql);
                $stmt->bind_param('i', $_SESSION['usuario_id']);
                $stmt->execute();
                $resultado = $stmt->get_result()->fetch_assoc();
                ?>
                <div class="stat-number"><?php echo $resultado['total']; ?></div>
            </div>
            
            <div class="stat-card">
                <h3>Reportes Pendientes</h3>
                <?php
                $sql = 'SELECT COUNT(*) as total FROM reportes WHERE usuario_id = ? AND estado = "pendiente"';
                $stmt = $conexion->prepare($sql);
                $stmt->bind_param('i', $_SESSION['usuario_id']);
                $stmt->execute();
                $resultado = $stmt->get_result()->fetch_assoc();
                ?>
                <div class="stat-number"><?php echo $resultado['total']; ?></div>
            </div>
        </div>
        
        <!-- Mapa -->
        <div class="map-container">
            <div class="map-placeholder">🗺️ Mapa de Reportes (Integración con API de mapas)</div>
        </div>
        
        <!-- Reportes Recientes -->
        <div class="recent-reports">
            <h3>Reportes Recientes</h3>
            <?php
            $sql = 'SELECT id, titulo, descripcion, estado, fecha_creacion FROM reportes WHERE usuario_id = ? ORDER BY fecha_creacion DESC LIMIT 5';
            $stmt = $conexion->prepare($sql);
            $stmt->bind_param('i', $_SESSION['usuario_id']);
            $stmt->execute();
            $resultados = $stmt->get_result();
            
            if ($resultados->num_rows > 0) {
                echo '<table>';
                echo '<thead><tr><th>Título</th><th>Estado</th><th>Fecha</th></tr></thead>';
                echo '<tbody>';
                
                while ($reporte = $resultados->fetch_assoc()) {
                    $clase_estado = 'estado-' . $reporte['estado'];
                    echo '<tr>';
                    echo '<td>' . htmlspecialchars($reporte['titulo']) . '</td>';
                    echo '<td><span class="reporte-estado ' . $clase_estado . '">' . ucfirst($reporte['estado']) . '</span></td>';
                    echo '<td>' . date('d/m/Y', strtotime($reporte['fecha_creacion'])) . '</td>';
                    echo '</tr>';
                }
                
                echo '</tbody>';
                echo '</table>';
            } else {
                echo '<p>No tienes reportes aún. <a href="../reportes/crear.php">Crear uno ahora</a></p>';
            }
            
            $stmt->close();
            $conexion->close();
            ?>
        </div>
    </div>
</div>

<?php require_once '../includes/footer.php'; ?>
