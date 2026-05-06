<?php
/**
 * Barra lateral de navegación
 * Solo visible para usuarios logueados
 */

if (!isset($_SESSION['usuario_id'])) {
    header('Location: ../auth/login.php');
    exit();
}
?>
<aside class="sidebar">
    <div class="sidebar-header">
        <h3>🏙️ Ciudad Activa</h3>
    </div>
    
    <nav>
        <ul class="sidebar-menu">
            <li>
                <a href="../dashboard/dashboard.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'dashboard.php' ? 'active' : ''; ?>">
                    <i class="fas fa-chart-line"></i> Dashboard
                </a>
            </li>
            <li>
                <a href="../reportes/crear.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'crear.php' ? 'active' : ''; ?>">
                    <i class="fas fa-plus-circle"></i> Crear Reporte
                </a>
            </li>
            <li>
                <a href="../reportes/mis_reportes.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'mis_reportes.php' ? 'active' : ''; ?>">
                    <i class="fas fa-list"></i> Mis Reportes
                </a>
            </li>
            <li>
                <a href="../perfil/perfil.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'perfil.php' ? 'active' : ''; ?>">
                    <i class="fas fa-user"></i> Mi Perfil
                </a>
            </li>
            <li style="border-top: 1px solid rgba(255, 255, 255, 0.2); margin-top: 20px; padding-top: 20px;">
                <a href="../logout.php">
                    <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
                </a>
            </li>
        </ul>
    </nav>
</aside>
