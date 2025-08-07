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
            case 'agregar':
                $data = [
                    'nombre' => $_POST['nombre'],
                    'ruc' => $_POST['ruc'],
                    'contacto' => $_POST['contacto'],
                    'telefono' => $_POST['telefono'],
                    'email' => $_POST['email'],
                    'direccion' => $_POST['direccion'],
                    'sector' => $_POST['sector']
                ];
                
                $db->insert('clientes', $data);
                $mensaje = '<div class="alert alert-success">Cliente agregado exitosamente</div>';
                break;
                
            case 'editar':
                $id = $_POST['id'];
                $data = [
                    'nombre' => $_POST['nombre'],
                    'ruc' => $_POST['ruc'],
                    'contacto' => $_POST['contacto'],
                    'telefono' => $_POST['telefono'],
                    'email' => $_POST['email'],
                    'direccion' => $_POST['direccion'],
                    'sector' => $_POST['sector']
                ];
                
                $db->update('clientes', $data, 'id = :id', ['id' => $id]);
                $mensaje = '<div class="alert alert-success">Cliente actualizado exitosamente</div>';
                break;
                
            case 'eliminar':
                $id = $_POST['id'];
                $db->update('clientes', ['activo' => 0], 'id = :id', ['id' => $id]);
                $mensaje = '<div class="alert alert-success">Cliente eliminado exitosamente</div>';
                break;
        }
    } catch (Exception $e) {
        $mensaje = '<div class="alert alert-error">Error: ' . $e->getMessage() . '</div>';
    }
}

// Obtener clientes activos
$clientes = $db->fetchAll("SELECT * FROM clientes WHERE activo = 1 ORDER BY nombre");

include 'includes/header.php';
?>

<div class="container">
    <div class="card">
        <div class="card-header">
            <h2>Gestión de Clientes</h2>
            <button class="btn btn-primary" onclick="showModal('modalAgregar')">Agregar Cliente</button>
        </div>
        
        <?php echo $mensaje; ?>
        
        <div class="table">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Empresa</th>
                        <th>RUC</th>
                        <th>Contacto</th>
                        <th>Teléfono</th>
                        <th>Sector</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($clientes as $cliente): ?>
                    <tr>
                        <td><?php echo escape($cliente['id']); ?></td>
                        <td><?php echo escape($cliente['nombre']); ?></td>
                        <td><?php echo escape($cliente['ruc']); ?></td>
                        <td><?php echo escape($cliente['contacto']); ?></td>
                        <td><?php echo escape($cliente['telefono']); ?></td>
                        <td><?php echo escape($cliente['sector']); ?></td>
                        <td>
                            <button class="btn btn-sm" onclick="verDetalle(<?php echo $cliente['id']; ?>)">Ver</button>
                            <button class="btn btn-sm" onclick="editarCliente(<?php echo $cliente['id']; ?>)">Editar</button>
                            <button class="btn btn-sm btn-success" onclick="crearCotizacion(<?php echo $cliente['id']; ?>)">Cotizar</button>
                            <button class="btn btn-sm btn-danger" onclick="eliminarCliente(<?php echo $cliente['id']; ?>)">Eliminar</button>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Agregar/Editar -->
<div id="modalAgregar" class="modal" style="display: none;">
    <div class="modal-content">
        <span class="close" onclick="hideModal('modalAgregar')">&times;</span>
        <h3>Agregar Cliente</h3>
        <form method="POST">
            <input type="hidden" name="accion" value="agregar">
            
            <div class="form-group">
                <label>Nombre de la Empresa:</label>
                <input type="text" name="nombre" required>
            </div>
            
            <div class="form-group">
                <label>RUC:</label>
                <input type="text" name="ruc" required maxlength="11">
            </div>
            
            <div class="form-group">
                <label>Persona de Contacto:</label>
                <input type="text" name="contacto" required>
            </div>
            
            <div class="form-group">
                <label>Teléfono:</label>
                <input type="tel" name="telefono" required>
            </div>
            
            <div class="form-group">
                <label>Email:</label>
                <input type="email" name="email" required>
            </div>
            
            <div class="form-group">
                <label>Dirección:</label>
                <textarea name="direccion" rows="2"></textarea>
            </div>
            
            <div class="form-group">
                <label>Sector:</label>
                <select name="sector" required>
                    <option value="">Seleccionar sector</option>
                    <option value="Construcción">Construcción</option>
                    <option value="Manufactura">Manufactura</option>
                    <option value="Minería">Minería</option>
                    <option value="Petroquímica">Petroquímica</option>
                    <option value="Transporte">Transporte</option>
                    <option value="Investigación">Investigación</option>
                    <option value="Alimentaria">Alimentaria</option>
                    <option value="Textil">Textil</option>
                    <option value="Otro">Otro</option>
                </select>
            </div>
            
            <button type="submit" class="btn btn-primary">Guardar</button>
            <button type="button" class="btn" onclick="hideModal('modalAgregar')">Cancelar</button>
        </form>
    </div>
</div>

<!-- Modal Ver Detalle -->
<div id="modalDetalle" class="modal" style="display: none;">
    <div class="modal-content">
        <span class="close" onclick="hideModal('modalDetalle')">&times;</span>
        <h3>Detalle del Cliente</h3>
        <div id="detalleContent">
            <!-- Contenido dinámico -->
        </div>
        <div style="margin-top: 2rem;">
            <button type="button" class="btn btn-success" onclick="crearCotizacionDesdeDetalle()">Crear Cotización</button>
            <button type="button" class="btn" onclick="hideModal('modalDetalle')">Cerrar</button>
        </div>
    </div>
</div>

<style>
.modal {
    position: fixed;
    z-index: 1000;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0,0,0,0.5);
}

.modal-content {
    background-color: white;
    margin: 5% auto;
    padding: 2rem;
    border-radius: 10px;
    width: 90%;
    max-width: 500px;
    position: relative;
}

.close {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
    cursor: pointer;
    position: absolute;
    top: 1rem;
    right: 1.5rem;
}

.close:hover {
    color: black;
}

.card-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.detalle-item {
    margin-bottom: 1rem;
    padding: 0.5rem 0;
    border-bottom: 1px solid #eee;
}

.detalle-label {
    font-weight: bold;
    color: #2c3e50;
    margin-bottom: 0.25rem;
}

.detalle-value {
    color: #555;
}
</style>

<script>
// Datos de clientes para JavaScript
const clientes = <?php echo json_encode($clientes); ?>;
let clienteSeleccionado = null;

function showModal(modalId) {
    document.getElementById(modalId).style.display = 'block';
}

function hideModal(modalId) {
    document.getElementById(modalId).style.display = 'none';
}

function verDetalle(id) {
    const cliente = clientes.find(c => c.id == id);
    clienteSeleccionado = cliente;
    
    if (cliente) {
        const content = `
            <div class="detalle-item">
                <div class="detalle-label">Empresa:</div>
                <div class="detalle-value">${cliente.nombre}</div>
            </div>
            <div class="detalle-item">
                <div class="detalle-label">RUC:</div>
                <div class="detalle-value">${cliente.ruc}</div>
            </div>
            <div class="detalle-item">
                <div class="detalle-label">Contacto:</div>
                <div class="detalle-value">${cliente.contacto}</div>
            </div>
            <div class="detalle-item">
                <div class="detalle-label">Teléfono:</div>
                <div class="detalle-value">${cliente.telefono}</div>
            </div>
            <div class="detalle-item">
                <div class="detalle-label">Email:</div>
                <div class="detalle-value">${cliente.email}</div>
            </div>
            <div class="detalle-item">
                <div class="detalle-label">Dirección:</div>
                <div class="detalle-value">${cliente.direccion}</div>
            </div>
            <div class="detalle-item">
                <div class="detalle-label">Sector:</div>
                <div class="detalle-value">${cliente.sector}</div>
            </div>
        `;
        document.getElementById('detalleContent').innerHTML = content;
        showModal('modalDetalle');
    }
}

function editarCliente(id) {
    alert('Función de editar cliente ' + id + ' (se implementaría con AJAX o redirección)');
}

function eliminarCliente(id) {
    if (confirm('¿Está seguro de eliminar este cliente?')) {
        // Aquí iría la lógica de eliminación
        alert('Cliente eliminado (simulado)');
    }
}

function crearCotizacion(id) {
    // Redirigir a crear cotización con el cliente seleccionado
    window.location.href = 'hacer_cotizacion.php?cliente_id=' + id;
}

function crearCotizacionDesdeDetalle() {
    if (clienteSeleccionado) {
        crearCotizacion(clienteSeleccionado.id);
    }
}

// Cerrar modal al hacer clic fuera
window.onclick = function(event) {
    if (event.target.classList.contains('modal')) {
        event.target.style.display = 'none';
    }
}
</script>

<?php include 'includes/footer.php'; ?>
