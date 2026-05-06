<?php
$titulo_pagina = 'Mis Reportes - Ciudad Activa';
$css_adicional = '../css/reportes.css';
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
        <div class="reportes-header">
            <h2>Mis Reportes</h2>
            <a href="crear.php" class="crear-reporte-btn">+ Crear Reporte</a>
        </div>
        
        <?php
        if (isset($_GET['success'])) {
            echo '<div class="alert alert-success">' . htmlspecialchars($_GET['success']) . '</div>';
        }
        if (isset($_GET['error'])) {
            echo '<div class="alert alert-danger">Error: ' . htmlspecialchars($_GET['error']) . '</div>';
        }
        ?>
        
        <div class="reportes-list">
            <?php
            $sql = 'SELECT id, titulo, descripcion, categoria, estado, fecha_creacion FROM reportes WHERE usuario_id = ? ORDER BY fecha_creacion DESC';
            $stmt = $conexion->prepare($sql);
            $stmt->bind_param('i', $_SESSION['usuario_id']);
            $stmt->execute();
            $resultados = $stmt->get_result();
            
            if ($resultados->num_rows === 0) {
                echo '<div class="sin-reportes">';
                echo '<p>No has creado ningún reporte aún.</p>';
                echo '<a href="crear.php" class="btn btn-primary">Crear mi primer reporte</a>';
                echo '</div>';
            } else {
                while ($reporte = $resultados->fetch_assoc()) {
                    $clase_estado = 'estado-' . $reporte['estado'];
                    echo '<div class="reporte-item">';
                    echo '<div class="reporte-header">';
                    echo '<h4 class="reporte-titulo">' . htmlspecialchars($reporte['titulo']) . '</h4>';
                    echo '<span class="reporte-estado ' . $clase_estado . '">' . ucfirst($reporte['estado']) . '</span>';
                    echo '</div>';
                    echo '<p class="reporte-descripcion">' . htmlspecialchars(substr($reporte['descripcion'], 0, 150)) . '...</p>';
                    echo '<div class="reporte-meta">';
                    echo '<span><i class="fas fa-tag"></i> ' . htmlspecialchars($reporte['categoria']) . '</span>';
                    echo '<span><i class="fas fa-calendar"></i> ' . date('d/m/Y', strtotime($reporte['fecha_creacion'])) . '</span>';
                    echo '</div>';
                    echo '<div class="reporte-acciones">';
                    echo '<a href="ver_reporte.php?id=' . $reporte['id'] . '" class="btn-ver">Ver Detalles</a>';
                    echo '<a href="editar_reporte.php?id=' . $reporte['id'] . '" class="btn-editar">Editar</a>';
                    echo '<button class="btn-eliminar" onclick="if(confirm(\'¿Estás seguro?\')) window.location=\'eliminar_reporte.php?id=' . $reporte['id'] . '\'">Eliminar</button>';
                    echo '</div>';
                    echo '</div>';
                }
            }
            
            $stmt->close();
            $conexion->close();
            ?>
        </div>
    </div>
</div>

<?php require_once '../includes/footer.php'; ?>
