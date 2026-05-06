<?php
$titulo_pagina = 'Recuperar Contraseña - Ciudad Activa';
$css_adicional = '../css/auth.css';
require_once '../includes/header.php';
?>

<div class="auth-container">
    <div class="auth-box">
        <h2>Recuperar Contraseña</h2>
        
        <p style="text-align: center; color: #666; margin-bottom: 20px;">
            Ingresa tu correo y te enviaremos instrucciones para recuperar tu contraseña.
        </p>
        
        <?php
        if (isset($_GET['error'])) {
            echo '<div class="alert alert-danger">Error: ' . htmlspecialchars($_GET['error']) . '</div>';
        }
        if (isset($_GET['success'])) {
            echo '<div class="alert alert-success">' . htmlspecialchars($_GET['success']) . '</div>';
        }
        ?>
        
        <form method="POST" action="procesar_recuperar.php">
            <div class="form-group">
                <label for="email">Correo Electrónico</label>
                <input type="email" id="email" name="email" required>
            </div>
            
            <button type="submit" class="btn btn-primary btn-block">Enviar Instrucciones</button>
        </form>
        
        <div class="auth-links">
            <a href="login.php">Volver a Iniciar Sesión</a>
        </div>
    </div>
</div>

<?php require_once '../includes/footer.php'; ?>
