-- Datos de prueba para la base de datos Ciudad Activa

USE ciudad_activa;

-- Insertar usuarios de prueba
-- Contraseña para todos: password123
INSERT INTO usuarios (nombre, email, contraseña, fecha_creacion) VALUES
('Juan Pérez', 'juan@example.com', '$2y$10$9qWz7Dv1qWzWzWzWzWzWzOqWzWzWzWzWzWzWzWzWzWzWzWzWzWzWzWz', NOW()),
('María García', 'maria@example.com', '$2y$10$9qWz7Dv1qWzWzWzWzWzWzOqWzWzWzWzWzWzWzWzWzWzWzWzWzWzWzWz', NOW()),
('Carlos López', 'carlos@example.com', '$2y$10$9qWz7Dv1qWzWzWzWzWzWzOqWzWzWzWzWzWzWzWzWzWzWzWzWzWzWzWz', NOW());

-- Insertar reportes de prueba
INSERT INTO reportes (usuario_id, titulo, descripcion, categoria, ubicacion, estado, fecha_creacion) VALUES
(1, 'Bache en la Calle Principal', 'Hay un bache muy grande en la calle principal que es peligroso para los vehículos', 'infraestructura', 'Calle Principal 123', 'pendiente', NOW()),
(1, 'Acumulación de basura', 'Hay mucha basura acumulada en la esquina del parque central', 'limpieza', 'Parque Central', 'en_proceso', DATE_SUB(NOW(), INTERVAL 5 DAY)),
(2, 'Semáforo roto', 'El semáforo de la avenida norte no funciona correctamente', 'transito', 'Avenida Norte 456', 'resuelto', DATE_SUB(NOW(), INTERVAL 10 DAY)),
(2, 'Iluminación deficiente', 'La iluminación en la plaza es muy débil y oscuro por las noches', 'seguridad', 'Plaza Mayor', 'pendiente', NOW()),
(3, 'Comercio ambulante descontrolado', 'Hay vendedores informales obstaculizando el paso en el parque', 'otros', 'Parque Metropolitano', 'pendiente', DATE_SUB(NOW(), INTERVAL 3 DAY));

-- Insertar comentarios de prueba
INSERT INTO comentarios (reporte_id, usuario_id, contenido, fecha_creacion) VALUES
(1, 2, 'Yo también he visto ese bache, es realmente peligroso', NOW()),
(2, 3, 'Se debería limpiar esa zona más frecuentemente', DATE_SUB(NOW(), INTERVAL 4 DAY)),
(3, 1, 'Gracias por reportarlo, ya está arreglado', DATE_SUB(NOW(), INTERVAL 9 DAY));
