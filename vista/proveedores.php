<?php
session_start();

// Verificar acceso
if (!isset($_SESSION['usuario_id']) || 
    ($_SESSION['usuario_rol'] !== 'Admin' && $_SESSION['usuario_rol'] !== 'Logística')) {
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
                    'contacto' => $_POST['contacto'],
                    'telefono' => $_POST['telefono'],
                    'email' => $_POST['email'],
                    'direccion' => $_POST['direccion'],
                    'especialidad' => $_POST['especialidad']
                ];
                
                $db->insert('proveedores', $data);
                $mensaje = '<div class="alert alert-success">Proveedor agregado exitosamente</div>';
                break;
                
            case 'editar':
                $id = $_POST['id'];
                $data = [
                    'nombre' => $_POST['nombre'],
                    'contacto' => $_POST['contacto'],
                    'telefono' => $_POST['telefono'],
                    'email' => $_POST['email'],
                    'direccion' => $_POST['direccion'],
                    'especialidad' => $_POST['especialidad']
                ];
                
                $db->update('proveedores', $data, 'id = :id', ['id' => $id]);
                $mensaje = '<div class="alert alert-success">Proveedor actualizado exitosamente</div>';
                break;
                
            case 'eliminar':
                $id = $_POST['id'];
                $db->update('proveedores', ['activo' => 0], 'id = :id', ['id' => $id]);
                $mensaje = '<div class="alert alert-success">Proveedor eliminado exitosamente</div>';
                break;
        }
    } catch (Exception $e) {
        $mensaje = '<div class="alert alert-error">Error: ' . $e->getMessage() . '</div>';
    }
}

// Obtener proveedores activos
$proveedores = $db->fetchAll("SELECT * FROM proveedores WHERE activo = 1 ORDER BY nombre");

include 'includes/header.php';
?>

<div class="container">
    <div class="card">
        <div class="card-header">
            <h2>Gestión de Proveedores</h2>
            <button class="btn btn-primary" onclick="showModal('modalAgregar')">Agregar Proveedor</button>
        </div>
        
        <?php echo $mensaje; ?>
        
        <div class="table">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Contacto</th>
                        <th>Teléfono</th>
                        <th>Email</th>
                        <th>Especialidad</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($proveedores as $proveedor): ?>
                    <tr>
                        <td><?php echo escape($proveedor['id']); ?></td>
                        <td><?php echo escape($proveedor['nombre']); ?></td>
                        <td><?php echo escape($proveedor['contacto']); ?></td>
                        <td><?php echo escape($proveedor['telefono']); ?></td>
                        <td><?php echo escape($proveedor['email']); ?></td>
                        <td><?php echo escape($proveedor['especialidad']); ?></td>
                        <td>
                            <button class="btn btn-sm" onclick="verDetalle(<?php echo $proveedor['id']; ?>)">Ver</button>
                            <button class="btn btn-sm" onclick="editarProveedor(<?php echo $proveedor['id']; ?>)">Editar</button>
                            <button class="btn btn-sm btn-danger" onclick="eliminarProveedor(<?php echo $proveedor['id']; ?>)">Eliminar</button>
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
        <h3>Agregar Proveedor</h3>
        <form method="POST">
            <input type="hidden" name="accion" value="agregar">
            
            <div class="form-group">
                <label>Nombre de la Empresa:</label>
                <input type="text" name="nombre" required>
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
                <label>Especialidad:</label>
                <input type="text" name="especialidad" placeholder="Ej: Equipos de protección personal">
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
        <h3>Detalle del Proveedor</h3>
        <div id="detalleContent">
            <!-- Contenido dinámico -->
        </div>
        <button type="button" class="btn" onclick="hideModal('modalDetalle')">Cerrar</button>
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
}

.detalle-label {
    font-weight: bold;
    color: #2c3e50;
}
</style>

<script>
// Datos de proveedores para JavaScript
const proveedores = <?php echo json_encode($proveedores); ?>;

function showModal(modalId) {
    document.getElementById(modalId).style.display = 'block';
}

function hideModal(modalId) {
    document.getElementById(modalId).style.display = 'none';
}

function verDetalle(id) {
    const proveedor = proveedores.find(p => p.id == id);
    if (proveedor) {
        const content = `
            <div class="detalle-item">
                <div class="detalle-label">Nombre:</div>
                <div>${proveedor.nombre}</div>
            </div>
            <div class="detalle-item">
                <div class="detalle-label">Contacto:</div>
                <div>${proveedor.contacto}</div>
            </div>
            <div class="detalle-item">
                <div class="detalle-label">Teléfono:</div>
                <div>${proveedor.telefono}</div>
            </div>
            <div class="detalle-item">
                <div class="detalle-label">Email:</div>
                <div>${proveedor.email}</div>
            </div>
            <div class="detalle-item">
                <div class="detalle-label">Dirección:</div>
                <div>${proveedor.direccion}</div>
            </div>
            <div class="detalle-item">
                <div class="detalle-label">Especialidad:</div>
                <div>${proveedor.especialidad}</div>
            </div>
        `;
        document.getElementById('detalleContent').innerHTML = content;
        showModal('modalDetalle');
    }
}

function editarProveedor(id) {
    alert('Función de editar proveedor ' + id + ' (se implementaría con AJAX o redirección)');
}

function eliminarProveedor(id) {
    if (confirm('¿Está seguro de eliminar este proveedor?')) {
        // Aquí iría la lógica de eliminación
        alert('Proveedor eliminado (simulado)');
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
