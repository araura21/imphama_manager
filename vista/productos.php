<?php
session_start();

// Verificar acceso
if (!isset($_SESSION['usuario_id']) || 
    ($_SESSION['usuario_rol'] !== 'Admin' && $_SESSION['usuario_rol'] !== 'Bodeguero')) {
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
                    'categoria_id' => $_POST['categoria_id'],
                    'descripcion' => $_POST['descripcion'],
                    'precio_referencia' => $_POST['precio_referencia'],
                    'codigo' => $_POST['codigo']
                ];
                
                $db->insert('productos', $data);
                $mensaje = '<div class="alert alert-success">Producto agregado exitosamente</div>';
                break;
                
            case 'editar':
                $id = $_POST['id'];
                $data = [
                    'nombre' => $_POST['nombre'],
                    'categoria_id' => $_POST['categoria_id'],
                    'descripcion' => $_POST['descripcion'],
                    'precio_referencia' => $_POST['precio_referencia'],
                    'codigo' => $_POST['codigo']
                ];
                
                $db->update('productos', $data, 'id = :id', ['id' => $id]);
                $mensaje = '<div class="alert alert-success">Producto actualizado exitosamente</div>';
                break;
                
            case 'eliminar':
                $id = $_POST['id'];
                $db->update('productos', ['activo' => 0], 'id = :id', ['id' => $id]);
                $mensaje = '<div class="alert alert-success">Producto eliminado exitosamente</div>';
                break;
        }
    } catch (Exception $e) {
        $mensaje = '<div class="alert alert-error">Error: ' . $e->getMessage() . '</div>';
    }
}

// Obtener productos activos con categorías
$sql = "SELECT p.*, c.nombre as categoria_nombre 
        FROM productos p 
        JOIN categorias c ON p.categoria_id = c.id 
        WHERE p.activo = 1 
        ORDER BY p.nombre";
$productos = $db->fetchAll($sql);

// Obtener categorías para el formulario
$categorias = $db->fetchAll("SELECT * FROM categorias WHERE activo = 1 ORDER BY nombre");

include 'includes/header.php';
?>
?>

<div class="container">
    <div class="card">
        <div class="card-header">
            <h2>Gestión de Productos</h2>
            <button class="btn btn-primary" onclick="showModal('modalAgregar')">Agregar Producto</button>
        </div>
        
        <?php echo $mensaje; ?>
        
        <div class="table">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Categoría</th>
                        <th>Descripción</th>
                        <th>Precio Ref.</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($productos as $producto): ?>
                    <tr>
                        <td><?php echo escape($producto['id']); ?></td>
                        <td><?php echo escape($producto['nombre']); ?></td>
                        <td><?php echo escape($producto['categoria_nombre']); ?></td>
                        <td><?php echo escape($producto['descripcion']); ?></td>
                        <td><?php echo formatearMoneda($producto['precio_referencia']); ?></td>
                        <td>
                            <button class="btn btn-sm" onclick="editarProducto(<?php echo $producto['id']; ?>)">Editar</button>
                            <button class="btn btn-sm btn-danger" onclick="eliminarProducto(<?php echo $producto['id']; ?>)">Eliminar</button>
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
        <h3>Agregar Producto</h3>
        <form method="POST">
            <input type="hidden" name="accion" value="agregar">
            
            <div class="form-group">
                <label>Nombre del Producto:</label>
                <input type="text" name="nombre" required>
            </div>
            
            <div class="form-group">
                <label>Categoría:</label>
                <select name="categoria_id" required>
                    <option value="">Seleccionar categoría</option>
                    <?php foreach ($categorias as $categoria): ?>
                        <option value="<?php echo $categoria['id']; ?>">
                            <?php echo escape($categoria['nombre']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            
            <div class="form-group">
                <label>Descripción:</label>
                <textarea name="descripcion" rows="3" required></textarea>
            </div>
            
            <div class="form-group">
                <label>Precio de Referencia:</label>
                <input type="number" name="precio_referencia" step="0.01" min="0" required>
            </div>
            
            <div class="form-group">
                <label>Código:</label>
                <input type="text" name="codigo" placeholder="Ej: CSI-001">
            </div>
                <input type="number" name="precio_ref" step="0.01" min="0">
            </div>
            
            <button type="submit" class="btn btn-primary">Guardar</button>
            <button type="button" class="btn" onclick="hideModal('modalAgregar')">Cancelar</button>
        </form>
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
</style>

<script>
function showModal(modalId) {
    document.getElementById(modalId).style.display = 'block';
}

function hideModal(modalId) {
    document.getElementById(modalId).style.display = 'none';
}

function editarProducto(id) {
    alert('Función de editar producto ' + id + ' (se implementaría con AJAX o redirección)');
}

function eliminarProducto(id) {
    if (confirm('¿Está seguro de eliminar este producto?')) {
        // Aquí iría la lógica de eliminación
        alert('Producto eliminado (simulado)');
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
