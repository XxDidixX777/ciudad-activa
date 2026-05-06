<?php
/**
 * Página de inicio - Redirige al dashboard o login
 */

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['usuario_id'])) {
    header('Location: dashboard/dashboard.php');
} else {
    header('Location: auth/login.php');
}
exit();
?>
