<?php
$titulo_pagina = 'Crear Reporte - Ciudad Activa';
$css_adicional = '../css/reportes.css';
require_once '../includes/header.php';

if (!isset($_SESSION['usuario_id'])) {
    header('Location: ../auth/login.php');
    exit();
}
?>

<div class="dashboard">
    <?php require_once '../includes/sidebar.php'; ?>
    
    <div class="main-content">
        <div class="reportes-header">
            <h2>Crear Nuevo Reporte</h2>
        </div>
        
        <div class="form-reporte">
            <form method="POST" action="guardar_reporte.php" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="titulo">Título del Reporte*</label>
                    <input type="text" id="titulo" name="titulo" required placeholder="Describe brevemente el problema">
                </div>
                
                <div class="form-group">
                    <label for="descripcion">Descripción Detallada*</label>
                    <textarea id="descripcion" name="descripcion" required placeholder="Proporciona más detalles sobre el problema"></textarea>
                </div>
                
                <div class="form-grupo-inline">
                    <div class="form-group">
                        <label for="categoria">Categoría*</label>
                        <select id="categoria" name="categoria" required>
                            <option value="">-- Selecciona una categoría --</option>
                            <option value="infraestructura">Infraestructura</option>
                            <option value="limpieza">Limpieza</option>
                            <option value="seguridad">Seguridad</option>
                            <option value="transito">Tránsito</option>
                            <option value="otros">Otros</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="ubicacion">Ubicación*</label>
                        <input type="text" id="ubicacion" name="ubicacion" required placeholder="Dirección o punto de referencia">
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="imagen">Imagen (Opcional)</label>
                    <input type="file" id="imagen" name="imagen" accept="image/*">
                    <small>Formatos permitidos: JPG, PNG, GIF. Máximo 5MB</small>
                </div>
                
                <div class="form-group">
                    <button type="submit" class="btn btn-success">Enviar Reporte</button>
                    <a href="mis_reportes.php" class="btn btn-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require_once '../includes/footer.php'; ?>
