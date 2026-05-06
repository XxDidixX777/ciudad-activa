<?php
/**
 * Header reutilizable para todas las páginas
 */

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($titulo_pagina) ? $titulo_pagina : 'Ciudad Activa'; ?></title>
    
    <!-- CSS Generales -->
    <link rel="stylesheet" href="<?php echo isset($ruta_css) ? $ruta_css : ''; ?>../css/estilos.css">
    
    <!-- CSS del Dashboard (para todas las páginas protegidas) -->
    <?php if (isset($_SESSION['usuario_id'])): ?>
        <link rel="stylesheet" href="<?php echo isset($ruta_css) ? $ruta_css : ''; ?>../css/dashboard.css">
    <?php endif; ?>
    
    <!-- CSS Específico (se carga desde cada página) -->
    <?php if (isset($css_adicional)): ?>
        <link rel="stylesheet" href="<?php echo $css_adicional; ?>">
    <?php endif; ?>
    
    <!-- Font Awesome para iconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <?php if (!isset($pagina_auth) || !$pagina_auth): ?>
    <header>
        <div class="logo">
            <a href="<?php echo isset($ruta_css) ? $ruta_css : ''; ?>../index.php">Ciudad Activa</a>
        </div>
        <nav>
            <ul>
                <li><a href="<?php echo isset($ruta_css) ? $ruta_css : ''; ?>../index.php">Inicio</a></li>
                <li><a href="<?php echo isset($ruta_css) ? $ruta_css : ''; ?>../index.php#proyectos">Proyectos</a></li>
                <li><a href="<?php echo isset($ruta_css) ? $ruta_css : ''; ?>../index.php#contacto">Contacto</a></li>
                <?php if (isset($_SESSION['usuario_id'])): ?>
                    <li><a href="<?php echo isset($ruta_css) ? $ruta_css : ''; ?>dashboard.php">Dashboard</a></li>
                    <li><a href="<?php echo isset($ruta_css) ? $ruta_css : ''; ?>logout.php">Cerrar Sesión</a></li>
                <?php else: ?>
                    <li><a href="<?php echo isset($ruta_css) ? $ruta_css : ''; ?>login.php">Iniciar Sesión</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>
    <?php endif; ?>
