/**
 * Script principal de la aplicación Ciudad Activa
 */

// Validar formularios antes de enviar
document.addEventListener('DOMContentLoaded', function() {
    
    // Validar formulario de login
    const formLogin = document.querySelector('form[action*="procesar_login"]');
    if (formLogin) {
        formLogin.addEventListener('submit', function(e) {
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;
            
            if (!email || !password) {
                e.preventDefault();
                alert('Por favor completa todos los campos');
            }
        });
    }
    
    // Validar formulario de registro
    const formRegistro = document.querySelector('form[action*="procesar_registro"]');
    if (formRegistro) {
        formRegistro.addEventListener('submit', function(e) {
            const password = document.getElementById('password').value;
            const passwordConfirm = document.getElementById('password_confirm').value;
            
            if (password !== passwordConfirm) {
                e.preventDefault();
                alert('Las contraseñas no coinciden');
            }
            
            if (password.length < 6) {
                e.preventDefault();
                alert('La contraseña debe tener al menos 6 caracteres');
            }
        });
    }
    
    // Validar formulario de reportes
    const formReporte = document.querySelector('form[action*="guardar_reporte"]');
    if (formReporte) {
        formReporte.addEventListener('submit', function(e) {
            const imagen = document.getElementById('imagen').files[0];
            
            if (imagen) {
                const maxSize = 5 * 1024 * 1024; // 5MB
                const allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
                
                if (!allowedTypes.includes(imagen.type)) {
                    e.preventDefault();
                    alert('Tipo de archivo no permitido. Solo JPG, PNG, GIF');
                }
                
                if (imagen.size > maxSize) {
                    e.preventDefault();
                    alert('El archivo es demasiado grande (máximo 5MB)');
                }
            }
        });
    }
    
    // Cerrar alertas automáticamente
    const alertas = document.querySelectorAll('.alert');
    alertas.forEach(alerta => {
        setTimeout(() => {
            alerta.style.opacity = '0';
            setTimeout(() => {
                alerta.style.display = 'none';
            }, 300);
        }, 5000);
    });
});

// Función para confirmar eliminación
function confirmarEliminacion(mensaje = '¿Estás seguro de que deseas eliminar esto?') {
    return confirm(mensaje);
}

// Función para copiar al portapapeles
function copiarAlPortapapeles(texto) {
    navigator.clipboard.writeText(texto).then(() => {
        alert('Copiado al portapapeles');
    }).catch(() => {
        alert('Error al copiar');
    });
}
