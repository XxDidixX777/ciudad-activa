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
    
    <!-- CSS Específico (se carga desde cada página) -->
    <?php if (isset($css_adicional)): ?>
        <link rel="stylesheet" href="<?php echo $css_adicional; ?>">
    <?php endif; ?>
    
    <!-- Font Awesome para iconos (opcional) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
