-- Sistema de Cotizaciones - Equipos de Seguridad Industrial
-- Base de datos: cotizaciones
-- Usuario: admin / Contraseña: admin

-- Crear base de datos
CREATE DATABASE IF NOT EXISTS cotizaciones;
USE cotizaciones;

-- Tabla de usuarios
CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario VARCHAR(50) UNIQUE NOT NULL,
    nombre VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    rol ENUM('Admin', 'Bodeguero', 'Ventas', 'Logística') NOT NULL,
    activo BOOLEAN DEFAULT TRUE,
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    fecha_actualizacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Tabla de categorías de productos
CREATE TABLE categorias (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    descripcion TEXT,
    activo BOOLEAN DEFAULT TRUE,
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabla de productos
CREATE TABLE productos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(200) NOT NULL,
    descripcion TEXT,
    categoria_id INT NOT NULL,
    precio_referencia DECIMAL(10,2) NOT NULL DEFAULT 0,
    codigo VARCHAR(50),
    activo BOOLEAN DEFAULT TRUE,
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    fecha_actualizacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (categoria_id) REFERENCES categorias(id)
);

-- Tabla de proveedores
CREATE TABLE proveedores (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(200) NOT NULL,
    contacto VARCHAR(100),
    telefono VARCHAR(20),
    email VARCHAR(100),
    direccion TEXT,
    especialidad VARCHAR(200),
    activo BOOLEAN DEFAULT TRUE,
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    fecha_actualizacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Tabla de clientes
CREATE TABLE clientes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(200) NOT NULL,
    ruc VARCHAR(11),
    contacto VARCHAR(100),
    telefono VARCHAR(20),
    email VARCHAR(100),
    direccion TEXT,
    sector VARCHAR(100),
    activo BOOLEAN DEFAULT TRUE,
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    fecha_actualizacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Tabla de cotizaciones
CREATE TABLE cotizaciones (
    id INT AUTO_INCREMENT PRIMARY KEY,
    numero VARCHAR(20) UNIQUE NOT NULL,
    cliente_id INT NOT NULL,
    usuario_id INT NOT NULL,
    fecha DATE NOT NULL,
    estado ENUM('Pendiente', 'Aprobada', 'En Revisión', 'Rechazada') DEFAULT 'Pendiente',
    subtotal DECIMAL(10,2) NOT NULL DEFAULT 0,
    impuesto DECIMAL(10,2) NOT NULL DEFAULT 0,
    total DECIMAL(10,2) NOT NULL DEFAULT 0,
    validez VARCHAR(100) DEFAULT '30 días',
    observaciones TEXT,
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    fecha_actualizacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (cliente_id) REFERENCES clientes(id),
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
);

-- Tabla de detalles de cotización
CREATE TABLE cotizacion_detalles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    cotizacion_id INT NOT NULL,
    producto_id INT NOT NULL,
    proveedor_id INT NOT NULL,
    cantidad INT NOT NULL,
    precio_unitario DECIMAL(10,2) NOT NULL,
    descuento DECIMAL(5,2) DEFAULT 0,
    subtotal DECIMAL(10,2) NOT NULL,
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (cotizacion_id) REFERENCES cotizaciones(id) ON DELETE CASCADE,
    FOREIGN KEY (producto_id) REFERENCES productos(id),
    FOREIGN KEY (proveedor_id) REFERENCES proveedores(id)
);

-- Tabla de precios por proveedor
CREATE TABLE producto_proveedor (
    id INT AUTO_INCREMENT PRIMARY KEY,
    producto_id INT NOT NULL,
    proveedor_id INT NOT NULL,
    precio DECIMAL(10,2) NOT NULL,
    descuento DECIMAL(5,2) DEFAULT 0,
    garantia VARCHAR(100),
    colores TEXT,
    activo BOOLEAN DEFAULT TRUE,
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    fecha_actualizacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (producto_id) REFERENCES productos(id),
    FOREIGN KEY (proveedor_id) REFERENCES proveedores(id),
    UNIQUE KEY unique_producto_proveedor (producto_id, proveedor_id)
);

-- ============================================
-- INSERTAR DATOS INICIALES
-- ============================================

-- Insertar usuarios (password ya hasheado para seguridad)
INSERT INTO usuarios (usuario, nombre, email, password, rol) VALUES
('admin', 'Administrador', 'admin@empresa.com', MD5('admin'), 'Admin'),
('bodeguero', 'Juan Pérez', 'juan.perez@empresa.com', MD5('123'), 'Bodeguero'),
('ventas', 'María González', 'maria.gonzalez@empresa.com', MD5('123'), 'Ventas'),
('logistica', 'Carlos López', 'carlos.lopez@empresa.com', MD5('123'), 'Logística');

-- Insertar categorías
INSERT INTO categorias (nombre, descripcion) VALUES
('Protección Cabeza', 'Cascos y protección para la cabeza'),
('Protección Manos', 'Guantes y protección para las manos'),
('Protección Visual', 'Gafas y protección visual'),
('Protección Respiratoria', 'Mascarillas y equipos respiratorios'),
('Protección Auditiva', 'Protectores auditivos'),
('Protección Corporal', 'Overoles y protección del cuerpo'),
('Protección Pies', 'Botas y calzado de seguridad'),
('Protección Altura', 'Arneses y equipos para altura');

-- Insertar productos
INSERT INTO productos (nombre, descripcion, categoria_id, precio_referencia, codigo) VALUES
-- Protección Cabeza (categoria_id = 1)
('Casco de Seguridad Industrial', 'Casco resistente a impactos', 1, 25.00, 'CSI-001'),
('Casco con Barbiquejo', 'Casco con sistema de barbiquejo ajustable', 1, 28.50, 'CBB-002'),
('Casco Dieléctrico', 'Casco para trabajos eléctricos', 1, 32.00, 'CDE-003'),

-- Protección Manos (categoria_id = 2)
('Guantes de Nitrilo', 'Guantes resistentes a químicos', 2, 8.50, 'GNT-001'),
('Guantes de Cuero', 'Guantes de cuero para trabajos pesados', 2, 12.75, 'GCU-002'),
('Guantes Anticorte', 'Protección contra cortes', 2, 15.25, 'GAC-003'),

-- Protección Visual (categoria_id = 3)
('Gafas de Seguridad', 'Protección ocular básica', 3, 7.50, 'GSG-001'),

-- Protección Pies (categoria_id = 7)
('Botas de Seguridad', 'Botas con puntera de acero', 7, 45.00, 'BDS-001'),

-- Protección Altura (categoria_id = 8)
('Arnés de Seguridad', 'Arnés para trabajos en altura', 8, 85.00, 'ADS-001'),

-- Protección Auditiva (categoria_id = 5)
('Tapones Auditivos', 'Protección contra ruido', 5, 2.75, 'TAU-001');

-- Insertar proveedores
INSERT INTO proveedores (nombre, contacto, telefono, email, direccion, especialidad) VALUES
('Equipos Industriales Pro', 'Juan Martínez', '+1-555-0101', 'ventas@equipospro.com', 'Av. Industrial 123', 'Cascos y protección cabeza'),
('Seguridad Total SA', 'Ana López', '+1-555-0102', 'info@seguridadtotal.com', 'Calle Seguridad 456', 'Equipos de protección general'),
('ProtecMax Corp', 'Carlos Rivera', '+1-555-0103', 'contacto@protecmax.com', 'Boulevard Protección 789', 'Guantes y protección manos'),
('SafeWork Solutions', 'María García', '+1-555-0104', 'ventas@safework.com', 'Zona Industrial Norte 101', 'Arneses y protección altura'),
('Visión Segura', 'Roberto Díaz', '+1-555-0105', 'info@visionsegura.com', 'Av. Vista Clara 202', 'Gafas y protección visual');

-- Insertar clientes
INSERT INTO clientes (nombre, ruc, contacto, telefono, email, direccion, sector) VALUES
('Constructora ABC', '12345678901', 'Luis Hernández', '+1-555-0201', 'lhernandez@constructoraabc.com', 'Av. Construcción 100', 'Construcción'),
('Industrias Del Norte', '12345678902', 'Carmen Ruiz', '+1-555-0202', 'cruiz@industriasnorte.com', 'Parque Industrial Norte 250', 'Manufactura'),
('Minera Esperanza', '12345678903', 'Pedro Castillo', '+1-555-0203', 'pcastillo@mineraesperanza.com', 'Km 45 Carretera Minera', 'Minería'),
('Petroquímica Costa', '12345678904', 'Sandra Morales', '+1-555-0204', 'smorales@petrocosta.com', 'Zona Industrial Costa 500', 'Petroquímica'),
('Transportes Rápidos', '12345678905', 'Miguel Torres', '+1-555-0205', 'mtorres@transportesrapidos.com', 'Terminal de Carga 75', 'Transporte'),
('Laboratorios Científicos', '12345678906', 'Elena Vargas', '+1-555-0206', 'evargas@labcientificos.com', 'Ciudad Universitaria 300', 'Investigación');

-- Insertar precios por proveedor para cada producto
INSERT INTO producto_proveedor (producto_id, proveedor_id, precio, descuento, garantia, colores) VALUES
-- Casco de Seguridad Industrial (producto_id = 1)
(1, 1, 25.00, 5, '12 meses', 'Blanco, Amarillo, Azul'),
(1, 2, 23.50, 8, '10 meses', 'Blanco, Amarillo'),
(1, 3, 26.75, 3, '15 meses', 'Blanco, Amarillo, Azul, Rojo'),

-- Guantes de Nitrilo (producto_id = 4)
(4, 2, 8.50, 10, '6 meses', 'Azul, Negro'),
(4, 3, 7.95, 15, '4 meses', 'Azul, Verde'),
(4, 4, 9.25, 5, '8 meses', 'Azul, Negro, Blanco'),

-- Gafas de Seguridad (producto_id = 7)
(7, 2, 7.50, 10, '6 meses', 'Transparente, Gris'),
(7, 4, 8.25, 8, '8 meses', 'Transparente, Amarillo'),
(7, 5, 7.75, 12, '4 meses', 'Azul, Negro, Verde'),

-- Botas de Seguridad (producto_id = 8)
(8, 1, 45.00, 5, '18 meses', 'Negro, Marrón'),
(8, 2, 42.00, 8, '12 meses', 'Negro'),
(8, 4, 48.50, 4, '24 meses', 'Negro, Marrón, Amarillo');

-- Insertar cotizaciones de ejemplo
INSERT INTO cotizaciones (numero, cliente_id, usuario_id, fecha, estado, subtotal, impuesto, total) VALUES
('COT-2025-001', 1, 3, '2025-08-01', 'Pendiente', 2076.27, 373.73, 2450.00),
('COT-2025-002', 2, 3, '2025-08-02', 'Aprobada', 2780.85, 499.90, 3280.75),
('COT-2025-003', 3, 3, '2025-08-03', 'En Revisión', 4745.76, 854.24, 5600.00),
('COT-2025-004', 4, 3, '2025-08-04', 'Rechazada', 1602.12, 288.38, 1890.50),
('COT-2025-005', 5, 3, '2025-08-05', 'Pendiente', 3496.40, 629.15, 4125.25);

-- Insertar detalles de cotizaciones
INSERT INTO cotizacion_detalles (cotizacion_id, producto_id, proveedor_id, cantidad, precio_unitario, descuento, subtotal) VALUES
-- COT-2025-001
(1, 1, 1, 25, 25.00, 5, 593.75),
(1, 4, 2, 50, 8.50, 10, 382.50),
(1, 7, 2, 100, 7.50, 10, 675.00),
(1, 8, 1, 10, 45.00, 5, 427.50),

-- COT-2025-002
(2, 1, 2, 30, 23.50, 8, 648.60),
(2, 4, 3, 80, 7.95, 15, 540.60),
(2, 7, 4, 150, 8.25, 8, 1141.50),
(2, 8, 2, 12, 42.00, 8, 463.68);

-- Crear índices para mejorar rendimiento
CREATE INDEX idx_cotizaciones_fecha ON cotizaciones(fecha);
CREATE INDEX idx_cotizaciones_estado ON cotizaciones(estado);
CREATE INDEX idx_cotizaciones_cliente ON cotizaciones(cliente_id);
CREATE INDEX idx_productos_categoria ON productos(categoria_id);
CREATE INDEX idx_producto_proveedor_producto ON producto_proveedor(producto_id);
CREATE INDEX idx_producto_proveedor_proveedor ON producto_proveedor(proveedor_id);

-- Crear vistas útiles
CREATE VIEW vista_cotizaciones AS
SELECT 
    c.id,
    c.numero,
    cl.nombre as cliente_nombre,
    u.nombre as vendedor_nombre,
    c.fecha,
    c.estado,
    c.total,
    COUNT(cd.id) as total_productos
FROM cotizaciones c
JOIN clientes cl ON c.cliente_id = cl.id
JOIN usuarios u ON c.usuario_id = u.id
LEFT JOIN cotizacion_detalles cd ON c.id = cd.cotizacion_id
WHERE cl.activo = 1
GROUP BY c.id, c.numero, cl.nombre, u.nombre, c.fecha, c.estado, c.total;

CREATE VIEW vista_productos_proveedores AS
SELECT 
    p.id as producto_id,
    p.nombre as producto_nombre,
    p.codigo as producto_codigo,
    c.nombre as categoria_nombre,
    pr.id as proveedor_id,
    pr.nombre as proveedor_nombre,
    pp.precio,
    pp.descuento,
    pp.garantia,
    pp.colores
FROM productos p
JOIN categorias c ON p.categoria_id = c.id
JOIN producto_proveedor pp ON p.id = pp.producto_id
JOIN proveedores pr ON pp.proveedor_id = pr.id
WHERE p.activo = 1 AND pr.activo = 1 AND pp.activo = 1;

-- Crear usuario de base de datos
CREATE USER IF NOT EXISTS 'admin'@'localhost' IDENTIFIED BY 'admin';
GRANT ALL PRIVILEGES ON cotizaciones.* TO 'admin'@'localhost';
FLUSH PRIVILEGES;

-- Mostrar resumen de datos insertados
SELECT 'RESUMEN DE DATOS INSERTADOS:' as mensaje;
SELECT COUNT(*) as total_usuarios FROM usuarios;
SELECT COUNT(*) as total_categorias FROM categorias;
SELECT COUNT(*) as total_productos FROM productos;
SELECT COUNT(*) as total_proveedores FROM proveedores;
SELECT COUNT(*) as total_clientes FROM clientes;
SELECT COUNT(*) as total_cotizaciones FROM cotizaciones;
SELECT COUNT(*) as total_precios_proveedor FROM producto_proveedor;
