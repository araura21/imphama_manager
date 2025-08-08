<?php
session_start();

// Verificar acceso
if (!isset($_SESSION['usuario_id']) || $_SESSION['usuario_rol'] !== 'Admin') {
	header('Location: login.php');
	exit();
}

require_once __DIR__ . '/../../vista/includes/database.php';
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
?>
