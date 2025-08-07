<?php
session_start();

// Verificar acceso
if (!isset($_SESSION['usuario_id']) || $_SESSION['usuario_rol'] !== 'Admin') {
    header('Location: login.php');
    exit();
}

require_once 'includes/database.php';
$db = getDB();

// Obtener estadísticas
$totalProductos = $db->fetch("SELECT COUNT(*) as total FROM productos WHERE activo = 1")['total'];
$totalProveedores = $db->fetch("SELECT COUNT(*) as total FROM proveedores WHERE activo = 1")['total'];
$totalClientes = $db->fetch("SELECT COUNT(*) as total FROM clientes WHERE activo = 1")['total'];
$totalCotizaciones = $db->fetch("SELECT COUNT(*) as total FROM cotizaciones")['total'];
$totalUsuarios = $db->fetch("SELECT COUNT(*) as total FROM usuarios WHERE activo = 1")['total'];

// Valor total de cotizaciones
$valorTotal = $db->fetch("SELECT SUM(total) as valor FROM cotizaciones")['valor'] ?? 0;

// Cotizaciones por estado
$cotizacionesPorEstado = $db->fetchAll("
    SELECT estado, COUNT(*) as cantidad, SUM(total) as valor_total 
    FROM cotizaciones 
    GROUP BY estado
");

// Productos más cotizados
$productosMasCotizados = $db->fetchAll("
    SELECT p.nombre, COUNT(cd.id) as veces_cotizado, SUM(cd.cantidad) as cantidad_total
    FROM productos p
    JOIN cotizacion_detalles cd ON p.id = cd.producto_id
    GROUP BY p.id, p.nombre
    ORDER BY veces_cotizado DESC
    LIMIT 5
");

include 'includes/header.php';
?>

<div class="container">
    <div class="card">
        <div class="card-header">
            <h2>Dashboard Administrativo</h2>
        </div>
        
        <div class="dashboard-stats">
            <div class="stat-card">
                <div class="stat-number"><?php echo $totalProductos; ?></div>
                <div class="stat-label">Productos</div>
            </div>
            <div class="stat-card">
                <div class="stat-number"><?php echo $totalProveedores; ?></div>
                <div class="stat-label">Proveedores</div>
            </div>
            <div class="stat-card">
                <div class="stat-number"><?php echo $totalClientes; ?></div>
                <div class="stat-label">Clientes</div>
            </div>
            <div class="stat-card">
                <div class="stat-number"><?php echo $totalCotizaciones; ?></div>
                <div class="stat-label">Cotizaciones</div>
            </div>
            <div class="stat-card">
                <div class="stat-number"><?php echo $totalUsuarios; ?></div>
                <div class="stat-label">Usuarios</div>
            </div>
        </div>
        
        <div class="modules-grid">
            <div class="module-card">
                <h3>Actividad Reciente</h3>
                <ul style="text-align: left; list-style: none;">
                    <li>• Nueva cotización creada por María González</li>
                    <li>• Producto "Casco industrial" actualizado</li>
                    <li>• Cliente "Constructora ABC" registrado</li>
                    <li>• Proveedor "Equipos Pro" añadido</li>
                </ul>
            </div>
            
            <div class="module-card">
                <h3>Cotizaciones del Mes</h3>
                <p>Total: $125,450.00</p>
                <p>Pendientes: 8</p>
                <p>Aprobadas: 12</p>
            </div>
            
            <div class="module-card">
                <h3>Productos Más Cotizados</h3>
                <ul style="text-align: left; list-style: none;">
                    <li>1. Cascos de seguridad</li>
                    <li>2. Guantes industriales</li>
                    <li>3. Botas de seguridad</li>
                    <li>4. Gafas protectoras</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
