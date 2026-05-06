/**
 * Script principal de la aplicación Ciudad Activa v2.0
 * Funciones de validación, interactividad y utilidades
 */

// =============================================
// EVENTO: Document Ready
// =============================================

document.addEventListener('DOMContentLoaded', function() {
    inicializarAlertas();
    inicializarFormularios();
    inicializarModales();
    inicializarBotones();
    mostrarHoraActual();
});

// =============================================
// ALERTAS AUTOMÁTICAS
// =============================================

function inicializarAlertas() {
    const alertas = document.querySelectorAll('.alert');
    alertas.forEach(alerta => {
        // Agregar botón de cerrar
        const closeBtn = document.createElement('button');
        closeBtn.type = 'button';
        closeBtn.className = 'alert-close';
        closeBtn.innerHTML = '&times;';
        closeBtn.onclick = () => cerrarAlerta(alerta);
        alerta.appendChild(closeBtn);

        // Cerrar automáticamente después de 8 segundos
        setTimeout(() => {
            cerrarAlerta(alerta);
        }, 8000);
    });
}

function cerrarAlerta(alerta) {
    alerta.style.animation = 'fadeOut 0.4s ease';
    setTimeout(() => {
        alerta.remove();
    }, 400);
}

// =============================================
// VALIDACIÓN DE FORMULARIOS
// =============================================

function inicializarFormularios() {
    // Formulario de Login
    const formLogin = document.querySelector('form[action*="procesar_login"]');
    if (formLogin) {
        formLogin.addEventListener('submit', validarFormularioLogin);
    }

    // Formulario de Registro
    const formRegistro = document.querySelector('form[action*="procesar_registro"]');
    if (formRegistro) {
        formRegistro.addEventListener('submit', validarFormularioRegistro);
    }

    // Formulario de Reportes
    const formReporte = document.querySelector('form[action*="guardar_reporte"]');
    if (formReporte) {
        formReporte.addEventListener('submit', validarFormularioReporte);
    }

    // Toggle de mostrar/ocultar contraseña
    inicializarPasswordToggle();
}

function validarFormularioLogin(e) {
    const email = document.getElementById('email')?.value.trim();
    const password = document.getElementById('password')?.value.trim();

    if (!email || !password) {
        e.preventDefault();
        mostrarError('Por favor completa todos los campos');
        return false;
    }

    if (!validarEmail(email)) {
        e.preventDefault();
        mostrarError('Por favor ingresa un correo electrónico válido');
        return false;
    }

    return true;
}

function validarFormularioRegistro(e) {
    const nombre = document.getElementById('nombre')?.value.trim();
    const email = document.getElementById('email')?.value.trim();
    const password = document.getElementById('password')?.value;
    const passwordConfirm = document.getElementById('password_confirm')?.value;

    if (!nombre || !email || !password || !passwordConfirm) {
        e.preventDefault();
        mostrarError('Por favor completa todos los campos');
        return false;
    }

    if (nombre.length < 3) {
        e.preventDefault();
        mostrarError('El nombre debe tener al menos 3 caracteres');
        return false;
    }

    if (!validarEmail(email)) {
        e.preventDefault();
        mostrarError('Por favor ingresa un correo electrónico válido');
        return false;
    }

    if (password.length < 6) {
        e.preventDefault();
        mostrarError('La contraseña debe tener al menos 6 caracteres');
        return false;
    }

    if (password !== passwordConfirm) {
        e.preventDefault();
        mostrarError('Las contraseñas no coinciden');
        return false;
    }

    return true;
}

function validarFormularioReporte(e) {
    const titulo = document.getElementById('titulo')?.value.trim();
    const descripcion = document.getElementById('descripcion')?.value.trim();
    const categoria = document.getElementById('categoria')?.value;
    const ubicacion = document.getElementById('ubicacion')?.value.trim();
    const imagen = document.getElementById('imagen')?.files[0];

    if (!titulo || !descripcion || !categoria || !ubicacion) {
        e.preventDefault();
        mostrarError('Por favor completa todos los campos requeridos');
        return false;
    }

    if (titulo.length < 5) {
        e.preventDefault();
        mostrarError('El título debe tener al menos 5 caracteres');
        return false;
    }

    if (descripcion.length < 20) {
        e.preventDefault();
        mostrarError('La descripción debe tener al menos 20 caracteres');
        return false;
    }

    if (imagen) {
        const maxSize = 5 * 1024 * 1024; // 5MB
        const allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];

        if (!allowedTypes.includes(imagen.type)) {
            e.preventDefault();
            mostrarError('Tipo de archivo no permitido. Solo JPG, PNG, GIF');
            return false;
        }

        if (imagen.size > maxSize) {
            e.preventDefault();
            mostrarError('El archivo es demasiado grande (máximo 5MB)');
            return false;
        }
    }

    return true;
}

function validarEmail(email) {
    const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return regex.test(email);
}

function mostrarError(mensaje) {
    const container = document.querySelector('.auth-right') || document.querySelector('.main-content') || document.body;
    const alertDiv = document.createElement('div');
    alertDiv.className = 'alert alert-danger';
    alertDiv.innerHTML = `
        <i class="fas fa-exclamation-circle"></i>
        <span>${mensaje}</span>
        <button type="button" class="alert-close">&times;</button>
    `;
    container.insertBefore(alertDiv, container.firstChild);

    alertDiv.querySelector('.alert-close').onclick = () => cerrarAlerta(alertDiv);
    setTimeout(() => cerrarAlerta(alertDiv), 6000);
}

// =============================================
// TOGGLE CONTRASEÑA
// =============================================

function inicializarPasswordToggle() {
    const passwordInputs = document.querySelectorAll('input[type="password"]');
    passwordInputs.forEach(input => {
        const wrapper = input.parentElement;
        wrapper.style.position = 'relative';

        const toggleIcon = document.createElement('span');
        toggleIcon.className = 'password-toggle-icon';
        toggleIcon.innerHTML = '<i class="fas fa-eye"></i>';
        toggleIcon.style.cursor = 'pointer';
        toggleIcon.style.position = 'absolute';
        toggleIcon.style.right = '12px';
        toggleIcon.style.top = '50%';
        toggleIcon.style.transform = 'translateY(-50%)';
        wrapper.appendChild(toggleIcon);

        toggleIcon.addEventListener('click', function() {
            if (input.type === 'password') {
                input.type = 'text';
                toggleIcon.innerHTML = '<i class="fas fa-eye-slash"></i>';
            } else {
                input.type = 'password';
                toggleIcon.innerHTML = '<i class="fas fa-eye"></i>';
            }
        });
    });
}

// =============================================
// MODALES
// =============================================

function inicializarModales() {
    const modales = document.querySelectorAll('.modal');
    modales.forEach(modal => {
        const closeBtn = modal.querySelector('.modal-close');
        if (closeBtn) {
            closeBtn.addEventListener('click', () => cerrarModal(modal));
        }

        modal.addEventListener('click', (e) => {
            if (e.target === modal) {
                cerrarModal(modal);
            }
        });
    });
}

function abrirModal(selector) {
    const modal = document.querySelector(selector);
    if (modal) {
        modal.classList.add('active');
    }
}

function cerrarModal(modal) {
    modal.classList.remove('active');
}

// =============================================
// BOTONES CON FUNCIONALIDADES
// =============================================

function inicializarBotones() {
    // Botón de editar perfil
    const btnEditarPerfil = document.querySelector('.btn-editar-perfil');
    if (btnEditarPerfil) {
        btnEditarPerfil.addEventListener('click', () => abrirModal('#modalEditarPerfil'));
    }

    // Botón de cambiar contraseña
    const btnCambiarPassword = document.querySelector('.btn-cambiar-password');
    if (btnCambiarPassword) {
        btnCambiarPassword.addEventListener('click', () => abrirModal('#modalCambiarPassword'));
    }
}

// =============================================
// FUNCIONES DE ELIMINACIÓN
// =============================================

function confirmarEliminacion(id, tipo = 'reporte') {
    if (confirm(`¿Estás seguro de que deseas eliminar este ${tipo}?`)) {
        window.location.href = `eliminar_${tipo}.php?id=${id}`;
    }
}

// =============================================
// COPIAR AL PORTAPAPELES
// =============================================

function copiarAlPortapapeles(texto) {
    navigator.clipboard.writeText(texto).then(() => {
        mostrarExito('Copiado al portapapeles');
    }).catch(() => {
        alert('Error al copiar');
    });
}

function mostrarExito(mensaje) {
    const container = document.querySelector('.main-content') || document.body;
    const alertDiv = document.createElement('div');
    alertDiv.className = 'alert alert-success';
    alertDiv.innerHTML = `
        <i class="fas fa-check-circle"></i>
        <span>${mensaje}</span>
        <button type="button" class="alert-close">&times;</button>
    `;
    container.insertBefore(alertDiv, container.firstChild);

    alertDiv.querySelector('.alert-close').onclick = () => cerrarAlerta(alertDiv);
    setTimeout(() => cerrarAlerta(alertDiv), 4000);
}

// =============================================
// HORA ACTUAL
// =============================================

function mostrarHoraActual() {
    const elementoHora = document.getElementById('hora-actual');
    if (elementoHora) {
        function actualizarHora() {
            const ahora = new Date();
            const horas = String(ahora.getHours()).padStart(2, '0');
            const minutos = String(ahora.getMinutes()).padStart(2, '0');
            elementoHora.textContent = `${horas}:${minutos}`;
        }
        actualizarHora();
        setInterval(actualizarHora, 1000);
    }
}

// =============================================
// FILTROS DE REPORTES
// =============================================

function filtrarReportes(estado) {
    const items = document.querySelectorAll('.reporte-item');
    let visibles = 0;

    items.forEach(item => {
        if (estado === 'todos' || item.dataset.estado === estado) {
            item.style.display = 'block';
            item.style.animation = 'slideInUp 0.3s ease';
            visibles++;
        } else {
            item.style.display = 'none';
        }
    });

    if (visibles === 0) {
        console.log('No hay reportes con ese estado');
    }
}

// =============================================
// BÚSQUEDA EN TIEMPO REAL
// =============================================

function buscarReportes(termino) {
    const items = document.querySelectorAll('.reporte-item');
    termino = termino.toLowerCase();

    items.forEach(item => {
        const titulo = item.querySelector('.reporte-titulo')?.textContent.toLowerCase() || '';
        const descripcion = item.querySelector('.reporte-descripcion')?.textContent.toLowerCase() || '';

        if (titulo.includes(termino) || descripcion.includes(termino)) {
            item.style.display = 'block';
            item.style.animation = 'slideInUp 0.3s ease';
        } else {
            item.style.display = 'none';
        }
    });
}

// =============================================
// EXPORTAR A CSV
// =============================================

function exportarReportesCSV() {
    const items = document.querySelectorAll('.reporte-item');
    let csv = 'Título,Estado,Categoría,Fecha\n';

    items.forEach(item => {
        const titulo = item.querySelector('.reporte-titulo')?.textContent || '';
        const estado = item.querySelector('.reporte-estado')?.textContent || '';
        const categoria = item.querySelector('.reporte-meta span')?.textContent || '';
        const fecha = item.querySelector('.reporte-meta span:last-child')?.textContent || '';

        csv += `"${titulo}","${estado}","${categoria}","${fecha}"\n`;
    });

    const blob = new Blob([csv], { type: 'text/csv' });
    const url = window.URL.createObjectURL(blob);
    const a = document.createElement('a');
    a.href = url;
    a.download = 'reportes.csv';
    a.click();
    window.URL.revokeObjectURL(url);
}

// =============================================
// ANIMACIÓN CSS PARA CERRAR ALERTA
// =============================================

const style = document.createElement('style');
style.textContent = `
    @keyframes fadeOut {
        to {
            opacity: 0;
            transform: translateY(-20px);
        }
    }
`;
document.head.appendChild(style);
