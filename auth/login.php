<?php
$titulo_pagina = 'Iniciar Sesión - Ciudad Activa';
$css_adicional = '../css/auth.css';
require_once '../includes/header.php';

if (isset($_SESSION['usuario_id'])) {
    header('Location: ../dashboard/dashboard.php');
    exit();
}
?>

<div class="auth-container">
    <div class="auth-box">
        <h2>Iniciar Sesión</h2>
        
        <?php
        if (isset($_GET['error'])) {
            echo '<div class="alert alert-danger">Error: ' . htmlspecialchars($_GET['error']) . '</div>';
        }
        if (isset($_GET['success'])) {
            echo '<div class="alert alert-success">' . htmlspecialchars($_GET['success']) . '</div>';
        }
        ?>
        
        <form method="POST" action="procesar_login.php">
            <div class="form-group">
                <label for="email">Correo Electrónico</label>
                <input type="email" id="email" name="email" required>
            </div>
            
            <div class="form-group">
                <label for="password">Contraseña</label>
                <input type="password" id="password" name="password" required>
            </div>
            
            <button type="submit" class="btn btn-primary btn-block">Iniciar Sesión</button>
        </form>
        
        <div class="auth-links">
            <a href="registro.php">¿No tienes cuenta? Regístrate</a>
            <a href="recuperar.php">¿Olvidaste tu contraseña?</a>
        </div>
    </div>
</div>

<?php require_once '../includes/footer.php'; ?>
