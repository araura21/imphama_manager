<?php
session_start();

// Verificar acceso
if (!isset($_SESSION['usuario_id']) || 
    ($_SESSION['usuario_rol'] !== 'Admin' && $_SESSION['usuario_rol'] !== 'Ventas')) {
    header('Location: login.php');
    exit();
}

require_once 'includes/database.php';
$db = getDB();

// Obtener categorías con productos
$sql = "SELECT c.id, c.nombre as categoria_nombre,
               p.id as producto_id, p.nombre as producto_nombre, p.descripcion
        FROM categorias c
        LEFT JOIN productos p ON c.id = p.categoria_id AND p.activo = 1
        WHERE c.activo = 1
        ORDER BY c.nombre, p.nombre";

$result = $db->fetchAll($sql);

// Organizar por categorías
$categorias = [];
foreach ($result as $row) {
    if ($row['producto_id']) {
        $categorias[$row['categoria_nombre']][] = [
            'id' => $row['producto_id'],
            'nombre' => $row['producto_nombre'],
            'descripcion' => $row['descripcion']
        ];
    }
}

// Obtener precios por proveedor para JavaScript
$sql = "SELECT pp.producto_id, pr.id as proveedor_id, pr.nombre as proveedor_nombre,
               pp.precio, pp.descuento, pp.garantia, pp.colores
        FROM producto_proveedor pp
        JOIN proveedores pr ON pp.proveedor_id = pr.id
        WHERE pp.activo = 1 AND pr.activo = 1
        ORDER BY pp.producto_id, pp.precio";

$preciosProveedores = $db->fetchAll($sql);

// Organizar precios por producto
$precios = [];
foreach ($preciosProveedores as $precio) {
    $precios[$precio['producto_id']][] = [
        'proveedor_id' => $precio['proveedor_id'],
        'proveedor' => $precio['proveedor_nombre'],
        'precio' => (float)$precio['precio'],
        'descuento' => $precio['descuento'] . '%',
        'garantia' => $precio['garantia'],
        'colores' => $precio['colores']
    ];
}

// Obtener clientes activos
$clientes = $db->fetchAll("SELECT id, nombre, contacto FROM clientes WHERE activo = 1 ORDER BY nombre");

// Obtener cliente seleccionado si viene de parámetro
$cliente_seleccionado = null;
if (isset($_GET['cliente_id'])) {
    $cliente_id = (int)$_GET['cliente_id'];
    $cliente_seleccionado = $db->fetch("SELECT * FROM clientes WHERE id = :id AND activo = 1", ['id' => $cliente_id]);
}

include 'includes/header.php';
?>
?>

<div class="container">
    <div class="card">
        <div class="card-header">
            <h2>Crear Nueva Cotización</h2>
            <div>
                <button class="btn btn-success" onclick="finalizarCotizacion()">Finalizar Cotización</button>
                <a href="cotizaciones.php" class="btn">Volver</a>
            </div>
        </div>
        
        <!-- Información del Cliente -->
        <div class="cliente-section">
            <h3>1. Seleccionar Cliente</h3>
            <div class="cliente-selector">
                <select id="selectCliente" onchange="seleccionarCliente()" <?php echo $cliente_seleccionado ? 'disabled' : ''; ?>>
                    <option value="">Seleccionar cliente...</option>
                    <?php foreach ($clientes as $cliente): ?>
                        <option value="<?php echo $cliente['id']; ?>" 
                                <?php echo ($cliente_seleccionado && $cliente_seleccionado['id'] == $cliente['id']) ? 'selected' : ''; ?>>
                            <?php echo $cliente['nombre']; ?> - <?php echo $cliente['contacto']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <?php if (!$cliente_seleccionado): ?>
                    <a href="clientes.php" class="btn btn-sm">Nuevo Cliente</a>
                <?php endif; ?>
            </div>
            
            <div id="clienteInfo" class="cliente-info" <?php echo !$cliente_seleccionado ? 'style="display: none;"' : ''; ?>>
                <div class="info-card">
                    <h4>Cliente Seleccionado:</h4>
                    <p id="clienteNombre"><?php echo $cliente_seleccionado ? $cliente_seleccionado['nombre'] : ''; ?></p>
                    <p id="clienteContacto"><?php echo $cliente_seleccionado ? $cliente_seleccionado['contacto'] : ''; ?></p>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Sistema de Cotización -->
    <div class="cotizacion-content" id="cotizacionSystem" <?php echo !$cliente_seleccionado ? 'style="display: none;"' : ''; ?>>
        <!-- Sidebar de Categorías -->
        <div class="categories-sidebar">
            <h3>2. Categorías</h3>
            <?php foreach ($categorias as $categoria => $productos): ?>
                <a href="#" class="category-item" data-categoria="<?php echo $categoria; ?>" onclick="seleccionarCategoria('<?php echo $categoria; ?>')">
                    <?php echo $categoria; ?>
                </a>
            <?php endforeach; ?>
        </div>
        
        <!-- Contenido Principal -->
        <div class="main-content">
            <!-- Productos de la categoría -->
            <div class="productos-section">
                <h3>3. Productos</h3>
                <div id="productosContainer">
                    <p class="placeholder">Selecciona una categoría para ver los productos disponibles</p>
                </div>
            </div>
            
            <!-- Comparación de Proveedores -->
            <div id="comparacionSection" class="comparacion-section" style="display: none;">
                <h3>4. Comparación de Proveedores</h3>
                <div id="comparacionContainer">
                    <!-- Contenido dinámico -->
                </div>
            </div>
            
            <!-- Carrito de Cotización -->
            <div class="carrito-section">
                <h3>5. Items de Cotización</h3>
                <div class="carrito-container">
                    <div id="carritoItems" class="carrito-items">
                        <p class="placeholder">No hay productos agregados a la cotización</p>
                    </div>
                    
                    <div class="carrito-total">
                        <div class="total-line">
                            <span>Subtotal:</span>
                            <span id="subtotalAmount">$0.00</span>
                        </div>
                        <div class="total-line">
                            <span>IVA (18%):</span>
                            <span id="ivaAmount">$0.00</span>
                        </div>
                        <div class="total-line total-final">
                            <span>Total:</span>
                            <span id="totalAmount">$0.00</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Agregar Cantidad -->
<div id="modalCantidad" class="modal" style="display: none;">
    <div class="modal-content">
        <span class="close" onclick="hideModal('modalCantidad')">&times;</span>
        <h3>Agregar a Cotización</h3>
        <div id="modalCantidadContent">
            <!-- Contenido dinámico -->
        </div>
    </div>
</div>

<style>
.cliente-section {
    background: #f8f9fa;
    padding: 2rem;
    border-radius: 8px;
    margin-bottom: 2rem;
}

.cliente-selector {
    display: flex;
    gap: 1rem;
    align-items: center;
    margin-bottom: 1rem;
}

.cliente-selector select {
    flex: 1;
    padding: 0.75rem;
    border: 1px solid #ddd;
    border-radius: 5px;
    font-size: 1rem;
}

.cliente-info {
    margin-top: 1rem;
}

.info-card {
    background: white;
    padding: 1.5rem;
    border-radius: 8px;
    border-left: 4px solid #3498db;
}

.cotizacion-content {
    display: grid;
    grid-template-columns: 250px 1fr;
    gap: 2rem;
    margin-top: 2rem;
}

.categories-sidebar {
    background: white;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    padding: 1.5rem;
    height: fit-content;
    position: sticky;
    top: 2rem;
}

.category-item {
    display: block;
    padding: 0.75rem;
    margin-bottom: 0.5rem;
    background: #f8f9fa;
    color: #2c3e50;
    text-decoration: none;
    border-radius: 5px;
    transition: background-color 0.3s;
    border-left: 3px solid transparent;
}

.category-item:hover,
.category-item.active {
    background-color: #3498db;
    color: white;
    border-left-color: #2980b9;
}

.main-content {
    display: flex;
    flex-direction: column;
    gap: 2rem;
}

.productos-section,
.comparacion-section,
.carrito-section {
    background: white;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    padding: 2rem;
}

.productos-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    gap: 1.5rem;
    margin-top: 1rem;
}

.product-card {
    border: 1px solid #ddd;
    border-radius: 8px;
    padding: 1.5rem;
    text-align: center;
    transition: transform 0.3s, box-shadow 0.3s;
    background: #fafafa;
}

.product-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

.product-card h4 {
    color: #2c3e50;
    margin-bottom: 0.5rem;
}

.product-card p {
    color: #7f8c8d;
    font-size: 0.9rem;
    margin-bottom: 1rem;
}

.comparison-table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 1rem;
}

.comparison-table th {
    background-color: #3498db;
    color: white;
    padding: 1rem;
    text-align: left;
}

.comparison-table td {
    padding: 1rem;
    border: 1px solid #ddd;
    vertical-align: top;
}

.comparison-table tr:nth-child(even) {
    background-color: #f8f9fa;
}

.provider-row {
    transition: background-color 0.3s;
}

.provider-row:hover {
    background-color: #e8f4fd !important;
}

.provider-checkbox {
    margin-right: 0.5rem;
    transform: scale(1.2);
}

.carrito-items {
    min-height: 200px;
    border: 1px solid #ddd;
    border-radius: 8px;
    padding: 1rem;
    margin-bottom: 1rem;
    max-height: 400px;
    overflow-y: auto;
}

.carrito-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1rem;
    border-bottom: 1px solid #eee;
    background: #f8f9fa;
    margin-bottom: 0.5rem;
    border-radius: 5px;
}

.carrito-item:last-child {
    border-bottom: none;
    margin-bottom: 0;
}

.carrito-total {
    background: #f8f9fa;
    padding: 1.5rem;
    border-radius: 8px;
    border-top: 2px solid #3498db;
}

.total-line {
    display: flex;
    justify-content: space-between;
    margin-bottom: 0.5rem;
}

.total-final {
    font-size: 1.2rem;
    font-weight: bold;
    color: #2c3e50;
    border-top: 1px solid #ddd;
    padding-top: 0.5rem;
    margin-top: 0.5rem;
}

.placeholder {
    text-align: center;
    color: #7f8c8d;
    font-style: italic;
    padding: 3rem;
}

.cantidad-form {
    margin-top: 1rem;
}

.cantidad-form .form-group {
    margin-bottom: 1rem;
}

.selected-providers {
    background: #e8f4fd;
    padding: 1rem;
    border-radius: 5px;
    margin: 1rem 0;
}

@media (max-width: 768px) {
    .cotizacion-content {
        grid-template-columns: 1fr;
    }
    
    .categories-sidebar {
        position: static;
    }
    
    .cliente-selector {
        flex-direction: column;
        align-items: stretch;
    }
}
</style>

<script>
// Datos de categorías y precios para JavaScript
const categorias = <?php echo json_encode($categorias); ?>;
const precios = <?php echo json_encode($precios); ?>;
const clientes = <?php echo json_encode($clientes); ?>;

let carritoItems = [];
let productoSeleccionado = null;
let proveedoresSeleccionados = [];

function seleccionarCliente() {
    const select = document.getElementById('selectCliente');
    const clienteId = parseInt(select.value);
    
    if (clienteId) {
        const cliente = clientes.find(c => c.id === clienteId);
        
        document.getElementById('clienteNombre').textContent = cliente.nombre;
        document.getElementById('clienteContacto').textContent = cliente.contacto;
        document.getElementById('clienteInfo').style.display = 'block';
        document.getElementById('cotizacionSystem').style.display = 'grid';
    } else {
        document.getElementById('clienteInfo').style.display = 'none';
        document.getElementById('cotizacionSystem').style.display = 'none';
    }
}

function seleccionarCategoria(categoria) {
    // Actualizar estado visual de categorías
    document.querySelectorAll('.category-item').forEach(item => {
        item.classList.remove('active');
    });
    event.target.classList.add('active');
    
    // Mostrar productos de la categoría
    const productos = categorias[categoria];
    let html = '<div class="productos-grid">';
    
    productos.forEach(producto => {
        html += `
            <div class="product-card">
                <h4>${producto.nombre}</h4>
                <p>${producto.descripcion}</p>
                <button class="btn btn-primary" onclick="verComparacion(${producto.id}, '${producto.nombre}')">
                    Ver Proveedores
                </button>
            </div>
        `;
    });
    
    html += '</div>';
    document.getElementById('productosContainer').innerHTML = html;
    
    // Ocultar sección de comparación
    document.getElementById('comparacionSection').style.display = 'none';
}

function verComparacion(productoId, productoNombre) {
    productoSeleccionado = { id: productoId, nombre: productoNombre };
    const proveedores = proveedoresProductos[productoId] || [];
    
    if (proveedores.length === 0) {
        alert('No hay proveedores disponibles para este producto.');
        return;
    }
    
    let html = `
        <h4>Comparación para: ${productoNombre}</h4>
        <p>Selecciona los proveedores que deseas comparar:</p>
        
        <table class="comparison-table">
            <thead>
                <tr>
                    <th>Seleccionar</th>
                    <th>Proveedor</th>
                    <th>Precio</th>
                    <th>Garantía</th>
                    <th>Descuento</th>
                    <th>Colores</th>
                </tr>
            </thead>
            <tbody>
    `;
    
    proveedores.forEach((proveedor, index) => {
        html += `
            <tr class="provider-row">
                <td>
                    <input type="checkbox" class="provider-checkbox" 
                           value="${index}" 
                           onchange="toggleProveedor(${index}, this.checked)">
                </td>
                <td><strong>${proveedor.proveedor}</strong></td>
                <td>$${proveedor.precio.toFixed(2)}</td>
                <td>${proveedor.garantia}</td>
                <td>${proveedor.descuento}</td>
                <td>${proveedor.colores}</td>
            </tr>
        `;
    });
    
    html += `
            </tbody>
        </table>
        
        <div class="selected-providers" id="selectedProviders" style="display: none;">
            <h5>Proveedores Seleccionados:</h5>
            <div id="selectedList"></div>
            <button class="btn btn-success" onclick="showModal('modalCantidad')">Agregar a Cotización</button>
        </div>
    `;
    
    document.getElementById('comparacionContainer').innerHTML = html;
    document.getElementById('comparacionSection').style.display = 'block';
    
    // Limpiar selecciones previas
    proveedoresSeleccionados = [];
}

function toggleProveedor(index, selected) {
    if (selected) {
        proveedoresSeleccionados.push(index);
    } else {
        proveedoresSeleccionados = proveedoresSeleccionados.filter(p => p !== index);
    }
    
    updateSelectedProviders();
}

function updateSelectedProviders() {
    const container = document.getElementById('selectedProviders');
    const list = document.getElementById('selectedList');
    
    if (proveedoresSeleccionados.length > 0) {
        const proveedores = proveedoresProductos[productoSeleccionado.id];
        let html = '';
        
        proveedoresSeleccionados.forEach(index => {
            const proveedor = proveedores[index];
            html += `
                <div style="margin-bottom: 0.5rem;">
                    <strong>${proveedor.proveedor}</strong> - $${proveedor.precio.toFixed(2)} 
                    (${proveedor.descuento} descuento)
                </div>
            `;
        });
        
        list.innerHTML = html;
        container.style.display = 'block';
    } else {
        container.style.display = 'none';
    }
}

function showModal(modalId) {
    if (modalId === 'modalCantidad' && proveedoresSeleccionados.length === 0) {
        alert('Selecciona al menos un proveedor');
        return;
    }
    
    if (modalId === 'modalCantidad') {
        const proveedores = proveedoresProductos[productoSeleccionado.id];
        const mejorPrecio = Math.min(...proveedoresSeleccionados.map(i => proveedores[i].precio));
        
        const content = `
            <div class="cantidad-form">
                <h4>Producto: ${productoSeleccionado.nombre}</h4>
                <p>Mejor precio encontrado: $${mejorPrecio.toFixed(2)}</p>
                
                <div class="form-group">
                    <label>Cantidad:</label>
                    <input type="number" id="cantidadInput" min="1" value="1" style="width: 100%; padding: 0.5rem;">
                </div>
                
                <div class="form-group">
                    <label>Proveedor Seleccionado:</label>
                    <select id="proveedorFinal" style="width: 100%; padding: 0.5rem;">
                        ${proveedoresSeleccionados.map(index => {
                            const p = proveedores[index];
                            return `<option value="${index}">${p.proveedor} - $${p.precio.toFixed(2)}</option>`;
                        }).join('')}
                    </select>
                </div>
                
                <div class="form-group">
                    <label>Notas (opcional):</label>
                    <textarea id="notasInput" rows="2" style="width: 100%; padding: 0.5rem;" placeholder="Especificaciones adicionales..."></textarea>
                </div>
                
                <button class="btn btn-primary" onclick="agregarAlCarrito()">Agregar</button>
                <button class="btn" onclick="hideModal('modalCantidad')">Cancelar</button>
            </div>
        `;
        
        document.getElementById('modalCantidadContent').innerHTML = content;
    }
    
    document.getElementById(modalId).style.display = 'block';
}

function hideModal(modalId) {
    document.getElementById(modalId).style.display = 'none';
}

function agregarAlCarrito() {
    const cantidad = parseInt(document.getElementById('cantidadInput').value);
    const proveedorIndex = parseInt(document.getElementById('proveedorFinal').value);
    const notas = document.getElementById('notasInput').value;
    
    if (!cantidad || cantidad < 1) {
        alert('Ingresa una cantidad válida');
        return;
    }
    
    const proveedores = proveedoresProductos[productoSeleccionado.id];
    const proveedor = proveedores[proveedorIndex];
    
    const item = {
        id: Date.now(), // ID único temporal
        productoId: productoSeleccionado.id,
        nombre: productoSeleccionado.nombre,
        proveedor: proveedor.proveedor,
        precio: proveedor.precio,
        cantidad: cantidad,
        descuento: proveedor.descuento,
        subtotal: proveedor.precio * cantidad,
        notas: notas
    };
    
    carritoItems.push(item);
    updateCarrito();
    hideModal('modalCantidad');
    
    // Mostrar mensaje de éxito
    alert('Producto agregado a la cotización');
}

function updateCarrito() {
    const container = document.getElementById('carritoItems');
    
    if (carritoItems.length === 0) {
        container.innerHTML = '<p class="placeholder">No hay productos agregados a la cotización</p>';
    } else {
        let html = '';
        carritoItems.forEach((item, index) => {
            html += `
                <div class="carrito-item">
                    <div>
                        <strong>${item.nombre}</strong><br>
                        <small>Proveedor: ${item.proveedor}</small><br>
                        <small>Cantidad: ${item.cantidad} × $${item.precio.toFixed(2)}</small>
                        ${item.notas ? `<br><small>Notas: ${item.notas}</small>` : ''}
                    </div>
                    <div style="text-align: right;">
                        <div><strong>$${item.subtotal.toFixed(2)}</strong></div>
                        <button class="btn btn-sm btn-danger" onclick="eliminarDelCarrito(${index})" style="margin-top: 0.5rem;">
                            Eliminar
                        </button>
                    </div>
                </div>
            `;
        });
        container.innerHTML = html;
    }
    
    // Actualizar totales
    updateTotales();
}

function eliminarDelCarrito(index) {
    if (confirm('¿Eliminar este producto de la cotización?')) {
        carritoItems.splice(index, 1);
        updateCarrito();
    }
}

function updateTotales() {
    const subtotal = carritoItems.reduce((sum, item) => sum + item.subtotal, 0);
    const iva = subtotal * 0.18; // 18% IVA
    const total = subtotal + iva;
    
    document.getElementById('subtotalAmount').textContent = `$${subtotal.toFixed(2)}`;
    document.getElementById('ivaAmount').textContent = `$${iva.toFixed(2)}`;
    document.getElementById('totalAmount').textContent = `$${total.toFixed(2)}`;
}

function finalizarCotizacion() {
    if (carritoItems.length === 0) {
        alert('Agrega al menos un producto a la cotización');
        return;
    }
    
    const clienteId = document.getElementById('selectCliente').value;
    if (!clienteId) {
        alert('Selecciona un cliente');
        return;
    }
    
    if (confirm('¿Finalizar y guardar esta cotización?')) {
        // Preparar datos para enviar a la API
        const cotizacionData = {
            cliente_id: parseInt(clienteId),
            items: carritoItems.map(item => ({
                producto_id: item.producto_id,
                proveedor_id: item.proveedor_id,
                cantidad: item.cantidad,
                precio_unitario: item.precio_unitario,
                descuento: parseFloat(item.descuento.replace('%', '')),
                subtotal: item.subtotal
            })),
            observaciones: prompt('Observaciones adicionales (opcional):') || ''
        };
        
        // Enviar a la API
        fetch('api.php?action=guardar_cotizacion', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(cotizacionData)
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Cotización ' + data.numero + ' guardada exitosamente');
                window.location.href = 'cotizaciones.php';
            } else {
                alert('Error: ' + data.error);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error al guardar la cotización. Intente nuevamente.');
        });
    }
}

// Inicializar si hay cliente seleccionado
<?php if ($cliente_seleccionado): ?>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('cotizacionSystem').style.display = 'grid';
    });
<?php endif; ?>

// Cerrar modal al hacer clic fuera
window.onclick = function(event) {
    if (event.target.classList.contains('modal')) {
        event.target.style.display = 'none';
    }
}
</script>

<?php include 'includes/footer.php'; ?>
