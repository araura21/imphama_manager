<?php

// Incluir el controlador de usuarios
require_once '../controlador/usuarioController/controladorUsuarios.php';

include 'includes/header.php';
?>

<div class="container">
    <div class="card">
        <div class="card-header">
            <h2>Gestión de Usuarios</h2>
            <button class="btn btn-primary" onclick="showModal('modalAgregar')">Agregar Usuario</button>
        </div>
        
        <?php echo $mensaje; ?>
        
        <div class="table">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Usuario</th>
                        <th>Nombre Completo</th>
                        <th>Email</th>
                        <th>Rol</th>
                        <th>Estado</th>
                        <th>Fecha Creación</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($usuarios as $usuario): ?>
                    <tr>
                        <td><?php echo escape($usuario['id']); ?></td>
                        <td><?php echo escape($usuario['usuario']); ?></td>
                        <td><?php echo escape($usuario['nombre']); ?></td>
                        <td><?php echo escape($usuario['email']); ?></td>
                        <td>
                            <span class="badge badge-<?php echo strtolower($usuario['rol']); ?>">
                                <?php echo escape($usuario['rol']); ?>
                            </span>
                        </td>
                        <td>
                            <span class="badge badge-<?php echo $usuario['activo'] ? 'success' : 'danger'; ?>">
                                <?php echo $usuario['activo'] ? 'Activo' : 'Inactivo'; ?>
                            </span>
                        </td>
                        <td><?php echo date('d/m/Y', strtotime($usuario['fecha_creacion'])); ?></td>
                        <td>
                            <button class="btn btn-sm" onclick="editarUsuario(<?php echo $usuario['id']; ?>)">Editar</button>
                            <button class="btn btn-sm btn-warning" onclick="cambiarEstado(<?php echo $usuario['id']; ?>, <?php echo $usuario['activo'] ? 'false' : 'true'; ?>)">
                                <?php echo $usuario['activo'] ? 'Desactivar' : 'Activar'; ?>
                            </button>
                            <?php if ($usuario['usuario'] !== 'admin'): ?>
                            <button class="btn btn-sm btn-danger" onclick="eliminarUsuario(<?php echo $usuario['id']; ?>)">Eliminar</button>
                            <?php endif; ?>
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
        <h3>Agregar Usuario</h3>
        <form method="POST">
            <input type="hidden" name="accion" value="agregar">
            
            <div class="form-group">
                <label>Nombre de Usuario:</label>
                <input type="text" name="usuario" required pattern="[a-zA-Z0-9_]+" 
                       title="Solo letras, números y guiones bajos">
            </div>
            
            <div class="form-group">
                <label>Nombre Completo:</label>
                <input type="text" name="nombre" required>
            </div>
            
            <div class="form-group">
                <label>Email:</label>
                <input type="email" name="email" required>
            </div>
            
            <div class="form-group">
                <label>Contraseña:</label>
                <input type="password" name="password" required minlength="3">
                <small>Mínimo 3 caracteres</small>
            </div>
            
            <div class="form-group">
                <label>Confirmar Contraseña:</label>
                <input type="password" name="password_confirm" required minlength="3">
            </div>
            
            <div class="form-group">
                <label>Rol:</label>
                <select name="rol" required>
                    <option value="">Seleccionar rol</option>
                    <option value="Admin">Administrador</option>
                    <option value="Bodeguero">Bodeguero</option>
                    <option value="Ventas">Ventas</option>
                    <option value="Logística">Logística</option>
                </select>
            </div>
            
            <div class="form-group">
                <label>
                    <input type="checkbox" name="activo" value="1" checked>
                    Usuario activo
                </label>
            </div>
            
            <button type="submit" class="btn btn-primary">Guardar</button>
            <button type="button" class="btn" onclick="hideModal('modalAgregar')">Cancelar</button>
        </form>
    </div>
</div>

<!-- Información de Roles -->
<div class="card" style="margin-top: 2rem;">
    <div class="card-header">
        <h3>Información de Roles y Permisos</h3>
    </div>
    
    <div class="roles-info">
        <div class="role-card">
            <h4>Administrador</h4>
            <ul>
                <li>Acceso total a todas las funciones</li>
                <li>Gestión de usuarios</li>
                <li>Dashboard administrativo</li>
                <li>Todas las operaciones CRUD</li>
            </ul>
        </div>
        
        <div class="role-card">
            <h4>Bodeguero</h4>
            <ul>
                <li>CRUD de productos únicamente</li>
                <li>Gestión de inventario</li>
                <li>Sin acceso a clientes o proveedores</li>
            </ul>
        </div>
        
        <div class="role-card">
            <h4>Ventas</h4>
            <ul>
                <li>CRUD de clientes</li>
                <li>Crear y gestionar cotizaciones</li>
                <li>Proceso completo de cotización</li>
                <li>Sin acceso a productos o proveedores</li>
            </ul>
        </div>
        
        <div class="role-card">
            <h4>Logística</h4>
            <ul>
                <li>CRUD de proveedores únicamente</li>
                <li>Gestión de información de proveedores</li>
                <li>Sin acceso a clientes o productos</li>
            </ul>
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

.badge {
    padding: 0.25rem 0.5rem;
    border-radius: 4px;
    font-size: 0.875rem;
    font-weight: bold;
}

.badge-admin { background-color: #e74c3c; color: white; }
.badge-bodeguero { background-color: #3498db; color: white; }
.badge-ventas { background-color: #27ae60; color: white; }
.badge-logística { background-color: #f39c12; color: white; }
.badge-success { background-color: #27ae60; color: white; }
.badge-danger { background-color: #e74c3c; color: white; }

.roles-info {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 1.5rem;
}

.role-card {
    background: #f8f9fa;
    padding: 1.5rem;
    border-radius: 8px;
    border-left: 4px solid #3498db;
}

.role-card h4 {
    color: #2c3e50;
    margin-bottom: 1rem;
}

.role-card ul {
    list-style: none;
    padding: 0;
}

.role-card li {
    padding: 0.25rem 0;
    position: relative;
    padding-left: 1.5rem;
}

.role-card li:before {
    content: "✓";
    position: absolute;
    left: 0;
    color: #27ae60;
    font-weight: bold;
}

form small {
    color: #7f8c8d;
    font-size: 0.8rem;
    display: block;
    margin-top: 0.25rem;
}
</style>

<script>
function showModal(modalId) {
    document.getElementById(modalId).style.display = 'block';
}

function hideModal(modalId) {
    document.getElementById(modalId).style.display = 'none';
}

function editarUsuario(id) {
    alert('Función de editar usuario ' + id + ' (se implementaría con AJAX o redirección)');
}

function cambiarEstado(id, nuevoEstado) {
    const accion = nuevoEstado === 'true' ? 'activar' : 'desactivar';
    if (confirm(`¿Está seguro de ${accion} este usuario?`)) {
        // Aquí iría la lógica para cambiar el estado
        alert(`Usuario ${accion}do (simulado)`);
    }
}

function eliminarUsuario(id) {
    if (confirm('¿Está seguro de eliminar este usuario? Esta acción no se puede deshacer.')) {
        // Aquí iría la lógica de eliminación
        alert('Usuario eliminado (simulado)');
    }
}

// Validación de contraseñas
document.querySelector('form').addEventListener('submit', function(e) {
    const password = document.querySelector('input[name="password"]').value;
    const confirmPassword = document.querySelector('input[name="password_confirm"]').value;
    
    if (password !== confirmPassword) {
        e.preventDefault();
        alert('Las contraseñas no coinciden');
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
