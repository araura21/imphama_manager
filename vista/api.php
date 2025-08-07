<?php
session_start();
require_once 'includes/database.php';

// Verificar acceso
if (!isset($_SESSION['usuario_id'])) {
    http_response_code(401);
    echo json_encode(['error' => 'No autorizado']);
    exit();
}

$db = getDB();
$action = $_GET['action'] ?? $_POST['action'] ?? '';

try {
    switch ($action) {
        case 'guardar_cotizacion':
            // Recibir datos de la cotización
            $data = json_decode(file_get_contents('php://input'), true);
            
            if (!$data || !isset($data['cliente_id']) || !isset($data['items']) || empty($data['items'])) {
                throw new Exception('Datos inválidos para la cotización');
            }
            
            $db->beginTransaction();
            
            // Generar número de cotización
            $numero = generarNumeroCotizacion();
            
            // Calcular totales
            $subtotal = 0;
            foreach ($data['items'] as $item) {
                $subtotal += $item['subtotal'];
            }
            $impuesto = calcularImpuesto($subtotal);
            $total = $subtotal + $impuesto;
            
            // Insertar cotización
            $cotizacionId = $db->insert('cotizaciones', [
                'numero' => $numero,
                'cliente_id' => $data['cliente_id'],
                'usuario_id' => $_SESSION['usuario_id'],
                'fecha' => date('Y-m-d'),
                'subtotal' => $subtotal,
                'impuesto' => $impuesto,
                'total' => $total,
                'observaciones' => $data['observaciones'] ?? ''
            ]);
            
            // Insertar detalles
            foreach ($data['items'] as $item) {
                $db->insert('cotizacion_detalles', [
                    'cotizacion_id' => $cotizacionId,
                    'producto_id' => $item['producto_id'],
                    'proveedor_id' => $item['proveedor_id'],
                    'cantidad' => $item['cantidad'],
                    'precio_unitario' => $item['precio_unitario'],
                    'descuento' => $item['descuento'],
                    'subtotal' => $item['subtotal']
                ]);
            }
            
            $db->commit();
            
            echo json_encode([
                'success' => true,
                'mensaje' => 'Cotización guardada exitosamente',
                'cotizacion_id' => $cotizacionId,
                'numero' => $numero
            ]);
            break;
            
        case 'get_productos_categoria':
            $categoriaId = $_GET['categoria_id'] ?? 0;
            
            $productos = $db->fetchAll("
                SELECT p.*, 
                       (SELECT COUNT(*) FROM producto_proveedor pp WHERE pp.producto_id = p.id AND pp.activo = 1) as proveedores_count
                FROM productos p 
                WHERE p.categoria_id = :categoria_id AND p.activo = 1 
                ORDER BY p.nombre
            ", ['categoria_id' => $categoriaId]);
            
            echo json_encode($productos);
            break;
            
        case 'get_proveedores_producto':
            $productoId = $_GET['producto_id'] ?? 0;
            
            $proveedores = $db->fetchAll("
                SELECT pr.id, pr.nombre, pp.precio, pp.descuento, pp.garantia, pp.colores
                FROM proveedores pr
                JOIN producto_proveedor pp ON pr.id = pp.proveedor_id
                WHERE pp.producto_id = :producto_id AND pr.activo = 1 AND pp.activo = 1
                ORDER BY pp.precio
            ", ['producto_id' => $productoId]);
            
            echo json_encode($proveedores);
            break;
            
        case 'cambiar_estado_cotizacion':
            if ($_SESSION['usuario_rol'] !== 'Admin' && $_SESSION['usuario_rol'] !== 'Ventas') {
                throw new Exception('No tiene permisos para esta acción');
            }
            
            $cotizacionId = $_POST['cotizacion_id'] ?? 0;
            $estado = $_POST['estado'] ?? '';
            
            if (!in_array($estado, ['Pendiente', 'Aprobada', 'En Revisión', 'Rechazada'])) {
                throw new Exception('Estado inválido');
            }
            
            $db->update('cotizaciones', ['estado' => $estado], 'id = :id', ['id' => $cotizacionId]);
            
            echo json_encode(['success' => true, 'mensaje' => 'Estado actualizado exitosamente']);
            break;
            
        case 'get_cotizacion_detalles':
            $cotizacionId = $_GET['cotizacion_id'] ?? 0;
            
            $cotizacion = $db->fetch("
                SELECT c.*, cl.nombre as cliente_nombre, cl.contacto, cl.telefono, cl.email, cl.direccion,
                       u.nombre as vendedor_nombre
                FROM cotizaciones c
                JOIN clientes cl ON c.cliente_id = cl.id
                JOIN usuarios u ON c.usuario_id = u.id
                WHERE c.id = :id
            ", ['id' => $cotizacionId]);
            
            if (!$cotizacion) {
                throw new Exception('Cotización no encontrada');
            }
            
            $detalles = $db->fetchAll("
                SELECT cd.*, p.nombre as producto_nombre, pr.nombre as proveedor_nombre
                FROM cotizacion_detalles cd
                JOIN productos p ON cd.producto_id = p.id
                JOIN proveedores pr ON cd.proveedor_id = pr.id
                WHERE cd.cotizacion_id = :cotizacion_id
                ORDER BY p.nombre
            ", ['cotizacion_id' => $cotizacionId]);
            
            $cotizacion['detalles'] = $detalles;
            
            echo json_encode($cotizacion);
            break;
            
        default:
            throw new Exception('Acción no válida');
    }
    
} catch (Exception $e) {
    if ($db && $db->getConnection()->inTransaction()) {
        $db->rollback();
    }
    
    http_response_code(400);
    echo json_encode(['error' => $e->getMessage()]);
}
?>
