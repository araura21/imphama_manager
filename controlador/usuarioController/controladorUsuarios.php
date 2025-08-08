<?php
session_start();

// Verificar acceso - Solo Admin
if (!isset($_SESSION['usuario_id']) || $_SESSION['usuario_rol'] !== 'Admin') {
	header('Location: login.php');
	exit();
}

require_once __DIR__ . '/../../vista/includes/database.php';

$mensaje = '';
$db = getDB();

// Procesar acciones
if ($_POST) {
	try {
		$accion = $_POST['accion'] ?? '';
        
		switch ($accion) {
			case 'agregar':
				// Verificar que las contraseñas coincidan
				if ($_POST['password'] !== $_POST['password_confirm']) {
					throw new Exception('Las contraseñas no coinciden');
				}
                
				$data = [
					'usuario' => $_POST['usuario'],
					'nombre' => $_POST['nombre'],
					'email' => $_POST['email'],
					'password' => 'MD5(' . $_POST['password'] . ')', // Será procesado como función SQL
					'rol' => $_POST['rol'],
					'activo' => isset($_POST['activo']) ? 1 : 0
				];
                
				// Insertar usando consulta manual para MD5
				$sql = "INSERT INTO usuarios (usuario, nombre, email, password, rol, activo) 
						VALUES (:usuario, :nombre, :email, MD5(:password), :rol, :activo)";
                
				$db->query($sql, [
					'usuario' => $_POST['usuario'],
					'nombre' => $_POST['nombre'],
					'email' => $_POST['email'],
					'password' => $_POST['password'],
					'rol' => $_POST['rol'],
					'activo' => isset($_POST['activo']) ? 1 : 0
				]);
                
				$mensaje = '<div class="alert alert-success">Usuario agregado exitosamente</div>';
				break;
                
			case 'cambiar_estado':
				$id = $_POST['id'];
				$activo = $_POST['activo'];
				$db->update('usuarios', ['activo' => $activo], 'id = :id', ['id' => $id]);
				$mensaje = '<div class="alert alert-success">Estado del usuario cambiado exitosamente</div>';
				break;
                
			case 'eliminar':
				$id = $_POST['id'];
				// No eliminar físicamente, solo desactivar
				$db->update('usuarios', ['activo' => 0], 'id = :id', ['id' => $id]);
				$mensaje = '<div class="alert alert-success">Usuario eliminado exitosamente</div>';
				break;
		}
	} catch (Exception $e) {
		$mensaje = '<div class="alert alert-error">Error: ' . $e->getMessage() . '</div>';
	}
}

// Obtener usuarios
$usuarios = $db->fetchAll("SELECT * FROM usuarios ORDER BY fecha_creacion DESC");
?>
