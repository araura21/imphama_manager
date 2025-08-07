<?php
session_start();

// Verificar acceso
if (!isset($_SESSION['usuario_id']) || 
    ($_SESSION['usuario_rol'] !== 'Admin' && $_SESSION['usuario_rol'] !== 'Ventas')) {
    header('Location: login.php');
    exit();
}

require_once 'includes/database.php';

$mensaje = '';
$db = getDB();

// Procesar acciones
if ($_POST) {
    try {
        $accion = $_POST['accion'] ?? '';
        
        switch ($accion) {
            case 'cambiar_estado':
                $id = $_POST['id'];
                $estado = $_POST['estado'];
                $db->update('cotizaciones', ['estado' => $estado], 'id = :id', ['id' => $id]);
                $mensaje = '<div class="alert alert-success">Estado de cotización actualizado exitosamente</div>';
                break;
                
            case 'eliminar':
                $id = $_POST['id'];
                $db->delete('cotizaciones', 'id = :id', ['id' => $id]);
                $mensaje = '<div class="alert alert-success">Cotización eliminada exitosamente</div>';
                break;
        }
    } catch (Exception $e) {
        $mensaje = '<div class="alert alert-error">Error: ' . $e->getMessage() . '</div>';
    }
}

// Obtener cotizaciones con datos de clientes y vendedores
$sql = "SELECT c.*, cl.nombre as cliente_nombre, u.nombre as vendedor_nombre,
               COUNT(cd.id) as total_productos
        FROM cotizaciones c
        JOIN clientes cl ON c.cliente_id = cl.id
        JOIN usuarios u ON c.usuario_id = u.id
        LEFT JOIN cotizacion_detalles cd ON c.id = cd.cotizacion_id
        WHERE cl.activo = 1
        GROUP BY c.id
        ORDER BY c.fecha DESC";

$cotizaciones = $db->fetchAll($sql);

// Calcular estadísticas
$totalCotizaciones = count($cotizaciones);
$pendientes = count(array_filter($cotizaciones, fn($c) => $c['estado'] === 'Pendiente'));
$aprobadas = count(array_filter($cotizaciones, fn($c) => $c['estado'] === 'Aprobada'));
$valorTotal = array_sum(array_column($cotizaciones, 'total'));

include 'includes/header.php';
?>

<div class="container">
    <div class="card">
        <div class="card-header">
            <h2>Gestión de Cotizaciones</h2>
            <div>
                <a href="hacer_cotizacion.php" class="btn btn-primary">Nueva Cotización</a>
            </div>
        </div>
        
        <?php echo $mensaje; ?>
        
        <!-- Estadísticas rápidas -->
        <div class="stats-grid" style="margin-bottom: 2rem;">
            <div class="stat-item">
                <div class="stat-number"><?php echo $totalCotizaciones; ?></div>
                <div class="stat-label">Total Cotizaciones</div>
            </div>
            <div class="stat-item">
                <div class="stat-number"><?php echo $pendientes; ?></div>
                <div class="stat-label">Pendientes</div>
            </div>
            <div class="stat-item">
                <div class="stat-number"><?php echo $aprobadas; ?></div>
                <div class="stat-label">Aprobadas</div>
            </div>
            <div class="stat-item">
                <div class="stat-number"><?php echo formatearMoneda($valorTotal); ?></div>
                <div class="stat-label">Valor Total</div>
            </div>
        </div>
        
        <!-- Filtros -->
        <div class="filters-section">
            <div class="filter-group">
                <label>Estado:</label>
                <select id="filtroEstado" onchange="filtrarCotizaciones()">
                    <option value="">Todos</option>
                    <option value="Pendiente">Pendiente</option>
                    <option value="Aprobada">Aprobada</option>
                    <option value="En Revisión">En Revisión</option>
                    <option value="Rechazada">Rechazada</option>
                </select>
            </div>
            <div class="filter-group">
                <label>Cliente:</label>
                <input type="text" id="filtroCliente" placeholder="Buscar cliente..." onkeyup="filtrarCotizaciones()">
            </div>
            <div class="filter-group">
                <label>Fecha desde:</label>
                <input type="date" id="filtroFechaDesde" onchange="filtrarCotizaciones()">
            </div>
        </div>
        
        <div class="table">
            <table id="tablaCotizaciones">
                <thead>
                    <tr>
                        <th>Número</th>
                        <th>Cliente</th>
                        <th>Fecha</th>
                        <th>Estado</th>
                        <th>Productos</th>
                        <th>Total</th>
                        <th>Vendedor</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($cotizaciones as $cotizacion): ?>
                    <tr data-estado="<?php echo $cotizacion['estado']; ?>" data-cliente="<?php echo strtolower($cotizacion['cliente_nombre']); ?>" data-fecha="<?php echo $cotizacion['fecha']; ?>">
                        <td><strong><?php echo escape($cotizacion['numero']); ?></strong></td>
                        <td><?php echo escape($cotizacion['cliente_nombre']); ?></td>
                        <td><?php echo date('d/m/Y', strtotime($cotizacion['fecha'])); ?></td>
                        <td>
                            <span class="badge badge-<?php echo strtolower(str_replace(' ', '-', $cotizacion['estado'])); ?>">
                                <?php echo escape($cotizacion['estado']); ?>
                            </span>
                        </td>
                        <td><?php echo $cotizacion['total_productos']; ?></td>
                        <td><strong><?php echo formatearMoneda($cotizacion['total']); ?></strong></td>
                        <td><?php echo escape($cotizacion['vendedor_nombre']); ?></td>
                        <td>
                            <button class="btn btn-sm" onclick="verCotizacion(<?php echo $cotizacion['id']; ?>)">Ver</button>
                            <button class="btn btn-sm btn-success" onclick="imprimirCotizacion(<?php echo $cotizacion['id']; ?>)">PDF</button>
                            <div class="dropdown" style="display: inline-block;">
                                <button class="btn btn-sm dropdown-toggle" onclick="toggleDropdown(<?php echo $cotizacion['id']; ?>)">Estado</button>
                                <div class="dropdown-menu" id="dropdown-<?php echo $cotizacion['id']; ?>" style="display: none;">
                                    <a href="#" onclick="cambiarEstado(<?php echo $cotizacion['id']; ?>, 'Pendiente')">Pendiente</a>
                                    <a href="#" onclick="cambiarEstado(<?php echo $cotizacion['id']; ?>, 'Aprobada')">Aprobada</a>
                                    <a href="#" onclick="cambiarEstado(<?php echo $cotizacion['id']; ?>, 'En Revisión')">En Revisión</a>
                                    <a href="#" onclick="cambiarEstado(<?php echo $cotizacion['id']; ?>, 'Rechazada')">Rechazada</a>
                                </div>
                            </div>
                            <button class="btn btn-sm btn-danger" onclick="eliminarCotizacion(<?php echo $cotizacion['id']; ?>)">Eliminar</button>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Ver Cotización -->
<div id="modalVerCotizacion" class="modal" style="display: none;">
    <div class="modal-content modal-large">
        <span class="close" onclick="hideModal('modalVerCotizacion')">&times;</span>
        <h3>Detalle de Cotización</h3>
        <div id="cotizacionContent">
            <!-- Contenido dinámico -->
        </div>
        <div style="margin-top: 2rem; text-align: right;">
            <button type="button" class="btn btn-success" onclick="imprimirDesdeModal()">Generar PDF</button>
            <button type="button" class="btn" onclick="hideModal('modalVerCotizacion')">Cerrar</button>
        </div>
    </div>
</div>

<style>
.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
    gap: 1rem;
}

.stat-item {
    background: #f8f9fa;
    padding: 1.5rem;
    border-radius: 8px;
    text-align: center;
    border-left: 4px solid #3498db;
}

.stat-number {
    font-size: 1.8rem;
    font-weight: bold;
    color: #2c3e50;
}

.stat-label {
    color: #7f8c8d;
    font-size: 0.9rem;
    margin-top: 0.5rem;
}

.filters-section {
    background: #f8f9fa;
    padding: 1.5rem;
    border-radius: 8px;
    margin-bottom: 2rem;
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 1rem;
}

.filter-group label {
    display: block;
    margin-bottom: 0.5rem;
    font-weight: bold;
    color: #2c3e50;
}

.filter-group input,
.filter-group select {
    width: 100%;
    padding: 0.5rem;
    border: 1px solid #ddd;
    border-radius: 4px;
}

.badge-pendiente { background-color: #f39c12; color: white; }
.badge-aprobada { background-color: #27ae60; color: white; }
.badge-en-revisión { background-color: #3498db; color: white; }
.badge-rechazada { background-color: #e74c3c; color: white; }

.dropdown {
    position: relative;
}

.dropdown-menu {
    position: absolute;
    top: 100%;
    left: 0;
    background: white;
    border: 1px solid #ddd;
    border-radius: 4px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    z-index: 1000;
    min-width: 120px;
}

.dropdown-menu a {
    display: block;
    padding: 0.5rem 1rem;
    text-decoration: none;
    color: #333;
    border-bottom: 1px solid #eee;
}

.dropdown-menu a:hover {
    background-color: #f8f9fa;
}

.dropdown-menu a:last-child {
    border-bottom: none;
}

.modal-large .modal-content {
    max-width: 800px;
    width: 95%;
}

.cotizacion-detalle {
    border: 1px solid #ddd;
    border-radius: 8px;
    padding: 2rem;
}

.cotizacion-header {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 2rem;
    margin-bottom: 2rem;
    padding-bottom: 2rem;
    border-bottom: 2px solid #3498db;
}

.cotizacion-productos table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 1rem;
}

.cotizacion-productos th,
.cotizacion-productos td {
    padding: 0.75rem;
    border: 1px solid #ddd;
    text-align: left;
}

.cotizacion-productos th {
    background-color: #f8f9fa;
    font-weight: bold;
}

.cotizacion-total {
    text-align: right;
    margin-top: 1rem;
    font-size: 1.2rem;
    font-weight: bold;
    color: #2c3e50;
}
</style>

<script>
// Datos de cotizaciones para JavaScript
const cotizaciones = <?php echo json_encode($cotizaciones); ?>;
let cotizacionActual = null;

function filtrarCotizaciones() {
    const estado = document.getElementById('filtroEstado').value;
    const cliente = document.getElementById('filtroCliente').value.toLowerCase();
    const fechaDesde = document.getElementById('filtroFechaDesde').value;
    
    const filas = document.querySelectorAll('#tablaCotizaciones tbody tr');
    
    filas.forEach(fila => {
        const estadoFila = fila.dataset.estado;
        const clienteFila = fila.dataset.cliente;
        const fechaFila = fila.dataset.fecha;
        
        let mostrar = true;
        
        if (estado && estadoFila !== estado) mostrar = false;
        if (cliente && !clienteFila.includes(cliente)) mostrar = false;
        if (fechaDesde && fechaFila < fechaDesde) mostrar = false;
        
        fila.style.display = mostrar ? '' : 'none';
    });
}

function toggleDropdown(id) {
    // Cerrar otros dropdowns
    document.querySelectorAll('.dropdown-menu').forEach(menu => {
        if (menu.id !== `dropdown-${id}`) {
            menu.style.display = 'none';
        }
    });
    
    const dropdown = document.getElementById(`dropdown-${id}`);
    dropdown.style.display = dropdown.style.display === 'none' ? 'block' : 'none';
}

function cambiarEstado(id, nuevoEstado) {
    if (confirm(`¿Cambiar estado a "${nuevoEstado}"?`)) {
        // Aquí iría la lógica para cambiar el estado
        alert(`Estado cambiado a "${nuevoEstado}" (simulado)`);
        // Ocultar dropdown
        document.getElementById(`dropdown-${id}`).style.display = 'none';
    }
}

function verCotizacion(id) {
    const cotizacion = cotizaciones.find(c => c.id == id);
    cotizacionActual = cotizacion;
    
    if (cotizacion) {
        const content = `
            <div class="cotizacion-detalle">
                <div class="cotizacion-header">
                    <div>
                        <h4>Información de Cotización</h4>
                        <p><strong>Número:</strong> ${cotizacion.numero}</p>
                        <p><strong>Fecha:</strong> ${new Date(cotizacion.fecha).toLocaleDateString()}</p>
                        <p><strong>Estado:</strong> <span class="badge badge-${cotizacion.estado.toLowerCase().replace(' ', '-')}">${cotizacion.estado}</span></p>
                        <p><strong>Vendedor:</strong> ${cotizacion.vendedor}</p>
                    </div>
                    <div>
                        <h4>Información del Cliente</h4>
                        <p><strong>Cliente:</strong> ${cotizacion.cliente}</p>
                        <p><strong>Productos:</strong> ${cotizacion.productos} items</p>
                        <p><strong>Total:</strong> $${cotizacion.total.toFixed(2)}</p>
                    </div>
                </div>
                
                <div class="cotizacion-productos">
                    <h4>Productos Cotizados</h4>
                    <table>
                        <thead>
                            <tr>
                                <th>Producto</th>
                                <th>Cantidad</th>
                                <th>Precio Unit.</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Casco de Seguridad Industrial</td>
                                <td>25</td>
                                <td>$25.00</td>
                                <td>$625.00</td>
                            </tr>
                            <tr>
                                <td>Guantes de Nitrilo</td>
                                <td>50</td>
                                <td>$8.50</td>
                                <td>$425.00</td>
                            </tr>
                            <tr>
                                <td>Botas de Seguridad</td>
                                <td>30</td>
                                <td>$45.00</td>
                                <td>$1,350.00</td>
                            </tr>
                        </tbody>
                    </table>
                    
                    <div class="cotizacion-total">
                        Subtotal: $2,400.00<br>
                        IVA (18%): $432.00<br>
                        <strong>Total: $${cotizacion.total.toFixed(2)}</strong>
                    </div>
                </div>
            </div>
        `;
        
        document.getElementById('cotizacionContent').innerHTML = content;
        showModal('modalVerCotizacion');
    }
}

function imprimirCotizacion(id) {
    // Abrir PDF en nueva ventana
    window.open(`generar_pdf.php?cotizacion_id=${id}`, '_blank');
}

function imprimirDesdeModal() {
    if (cotizacionActual) {
        window.open(`generar_pdf.php?cotizacion_id=${cotizacionActual.id}`, '_blank');
    }
}

function eliminarCotizacion(id) {
    if (confirm('¿Está seguro de eliminar esta cotización? Esta acción no se puede deshacer.')) {
        // Aquí iría la lógica de eliminación
        alert('Cotización eliminada (simulado)');
    }
}

function showModal(modalId) {
    document.getElementById(modalId).style.display = 'block';
}

function hideModal(modalId) {
    document.getElementById(modalId).style.display = 'none';
}

// Cerrar dropdowns al hacer clic fuera
document.addEventListener('click', function(event) {
    if (!event.target.closest('.dropdown')) {
        document.querySelectorAll('.dropdown-menu').forEach(menu => {
            menu.style.display = 'none';
        });
    }
});

// Cerrar modal al hacer clic fuera
window.onclick = function(event) {
    if (event.target.classList.contains('modal')) {
        event.target.style.display = 'none';
    }
}
</script>

<?php include 'includes/footer.php'; ?>
