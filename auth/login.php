<?php
$titulo_pagina = 'Iniciar Sesión - Ciudad Activa';
$pagina_auth = true;
$css_adicional = '../css/auth.css';
require_once '../includes/header.php';

if (isset($_SESSION['usuario_id'])) {
    header('Location: ../dashboard/dashboard.php');
    exit();
}
?>

<div class="auth-page">
    <div class="auth-container">
        <!-- Lado Izquierdo: Información -->
        <div class="auth-left">
            <h1>🏛️ Ciudad Activa</h1>
            <p>Plataforma colaborativa para mejorar tu ciudad</p>
            
            <div class="auth-features">
                <div class="auth-feature">
                    <div class="auth-feature-icon">📍</div>
                    <div>
                        <h4 style="margin: 0; color: white;">Reporta Problemas</h4>
                        <small>Identifica y reporta problemas urbanos</small>
                    </div>
                </div>
                
                <div class="auth-feature">
                    <div class="auth-feature-icon">✅</div>
                    <div>
                        <h4 style="margin: 0; color: white;">Sigue el Progreso</h4>
                        <small>Monitorea el estado de tus reportes</small>
                    </div>
                </div>
                
                <div class="auth-feature">
                    <div class="auth-feature-icon">🤝</div>
                    <div>
                        <h4 style="margin: 0; color: white;">Comunidad</h4>
                        <small>Únete a otros ciudadanos activos</small>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Lado Derecho: Formulario -->
        <div class="auth-right">
            <div class="auth-box">
                <h2>Iniciar Sesión</h2>
                <p class="auth-subtitle">Bienvenido de vuelta</p>
                
                <?php
                if (isset($_GET['error'])) {
                    echo '<div class="alert alert-danger"><i class="fas fa-exclamation-circle"></i> ' . htmlspecialchars($_GET['error']) . '</div>';
                }
                if (isset($_GET['success'])) {
                    echo '<div class="alert alert-success"><i class="fas fa-check-circle"></i> ' . htmlspecialchars($_GET['success']) . '</div>';
                }
                ?>
                
                <form method="POST" action="procesar_login.php" novalidate>
                    <div class="form-group">
                        <label for="email"><i class="fas fa-envelope"></i> Correo Electrónico</label>
                        <input type="email" id="email" name="email" required placeholder="tu@correo.com">
                    </div>
                    
                    <div class="form-group">
                        <label for="password"><i class="fas fa-lock"></i> Contraseña</label>
                        <input type="password" id="password" name="password" required placeholder="••••••••">
                    </div>
                    
                    <button type="submit" class="auth-btn">
                        <i class="fas fa-sign-in-alt"></i> Iniciar Sesión
                    </button>
                </form>
                
                <div class="auth-links">
                    <a href="registro.php" class="link-primary">
                        <i class="fas fa-user-plus"></i> Crear Cuenta
                    </a>
                    <a href="recuperar.php" class="link-secondary">
                        <i class="fas fa-key"></i> Olvidé mi contraseña
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once '../includes/footer.php'; ?>
