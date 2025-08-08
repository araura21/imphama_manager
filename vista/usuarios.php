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

<link rel="stylesheet" href="css/usuarios.css">

<script src="../validaciones/usuario.js"></script>

<?php include 'includes/footer.php'; ?>
