<?php
/**
 * Cerrar sesión
 */

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Destruir la sesión
session_destroy();

// Redirigir al login
header('Location: auth/login.php?success=Has cerrado sesión correctamente');
exit();
?>
