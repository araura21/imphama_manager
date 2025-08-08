<?php

// Incluir el controlador del dashboard
require_once '../controlador/dashboardController/controladorDashboard.php';


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
