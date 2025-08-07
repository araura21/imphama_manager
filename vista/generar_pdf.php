<?php
session_start();

// Verificar acceso
if (!isset($_SESSION['usuario_id'])) {
    header('Location: login.php');
    exit();
}

// Simular datos de cotización (en un sistema real vendría de la base de datos)
$cotizacion = [
    'numero' => 'COT-2025-001',
    'fecha' => '2025-08-07',
    'cliente' => [
        'nombre' => 'Constructora ABC',
        'ruc' => '12345678901',
        'contacto' => 'Luis Hernández',
        'direccion' => 'Av. Construcción 100',
        'telefono' => '+1-555-0201',
        'email' => 'lhernandez@constructoraabc.com'
    ],
    'vendedor' => 'María González',
    'items' => [
        [
            'producto' => 'Casco de Seguridad Industrial',
            'proveedor' => 'Equipos Industriales Pro',
            'cantidad' => 25,
            'precio' => 25.00,
            'descuento' => '5%',
            'subtotal' => 625.00
        ],
        [
            'producto' => 'Guantes de Nitrilo',
            'proveedor' => 'ProtecMax Corp',
            'cantidad' => 50,
            'precio' => 8.50,
            'descuento' => '10%',
            'subtotal' => 425.00
        ],
        [
            'producto' => 'Botas de Seguridad',
            'proveedor' => 'SafeWork Solutions',
            'cantidad' => 30,
            'precio' => 45.00,
            'descuento' => '4%',
            'subtotal' => 1350.00
        ]
    ],
    'subtotal' => 2400.00,
    'iva' => 432.00,
    'total' => 2832.00,
    'validez' => '30 días',
    'condiciones' => 'Precios válidos por 30 días. Forma de pago: 50% anticipo, 50% contraentrega.'
];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cotización <?php echo $cotizacion['numero']; ?></title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Arial', sans-serif;
            font-size: 12px;
            line-height: 1.4;
            color: #333;
            background: white;
        }
        
        .container {
            max-width: 210mm;
            margin: 0 auto;
            padding: 20mm;
            background: white;
        }
        
        .header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 30px;
            border-bottom: 2px solid #2c3e50;
            padding-bottom: 20px;
        }
        
        .company-info {
            flex: 1;
        }
        
        .company-info h1 {
            color: #2c3e50;
            font-size: 24px;
            margin-bottom: 5px;
        }
        
        .company-info p {
            color: #7f8c8d;
            margin: 2px 0;
        }
        
        .cotizacion-info {
            text-align: right;
            flex: 1;
        }
        
        .cotizacion-info h2 {
            background: #3498db;
            color: white;
            padding: 10px 15px;
            margin-bottom: 10px;
            font-size: 18px;
        }
        
        .cotizacion-info p {
            margin: 5px 0;
        }
        
        .client-section {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
            background: #f8f9fa;
            padding: 20px;
            border-radius: 5px;
        }
        
        .client-info h3 {
            color: #2c3e50;
            margin-bottom: 10px;
            font-size: 14px;
        }
        
        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }
        
        .items-table th {
            background: #2c3e50;
            color: white;
            padding: 12px 8px;
            text-align: left;
            font-size: 11px;
        }
        
        .items-table td {
            padding: 10px 8px;
            border-bottom: 1px solid #ddd;
            font-size: 11px;
        }
        
        .items-table tr:nth-child(even) {
            background: #f8f9fa;
        }
        
        .totals-section {
            display: flex;
            justify-content: flex-end;
            margin-bottom: 30px;
        }
        
        .totals-table {
            width: 300px;
            border-collapse: collapse;
        }
        
        .totals-table td {
            padding: 8px 12px;
            border: 1px solid #ddd;
        }
        
        .totals-table .label {
            background: #f8f9fa;
            font-weight: bold;
            text-align: right;
        }
        
        .totals-table .amount {
            text-align: right;
        }
        
        .totals-table .final-total {
            background: #2c3e50;
            color: white;
            font-weight: bold;
            font-size: 14px;
        }
        
        .conditions {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 5px;
            border-left: 4px solid #3498db;
        }
        
        .conditions h3 {
            color: #2c3e50;
            margin-bottom: 10px;
        }
        
        .footer {
            margin-top: 40px;
            text-align: center;
            color: #7f8c8d;
            font-size: 10px;
            border-top: 1px solid #ddd;
            padding-top: 20px;
        }
        
        .signature-section {
            display: flex;
            justify-content: space-between;
            margin-top: 40px;
        }
        
        .signature-box {
            width: 200px;
            text-align: center;
        }
        
        .signature-line {
            border-bottom: 1px solid #333;
            margin-bottom: 5px;
            height: 40px;
        }
        
        @media print {
            body { margin: 0; }
            .container { padding: 10mm; }
            .no-print { display: none; }
        }
        
        .print-controls {
            position: fixed;
            top: 20px;
            right: 20px;
            background: white;
            padding: 15px;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            z-index: 1000;
        }
        
        .btn {
            display: inline-block;
            padding: 8px 16px;
            margin: 0 5px;
            background-color: #3498db;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            border: none;
            cursor: pointer;
            font-size: 12px;
        }
        
        .btn:hover {
            background-color: #2980b9;
        }
        
        .btn-secondary {
            background-color: #95a5a6;
        }
        
        .btn-secondary:hover {
            background-color: #7f8c8d;
        }
    </style>
</head>
<body>
    <div class="print-controls no-print">
        <button class="btn" onclick="window.print()">Imprimir / PDF</button>
        <a href="cotizaciones.php" class="btn btn-secondary">Volver</a>
    </div>

    <div class="container">
        <!-- Header -->
        <div class="header">
            <div class="company-info">
                <h1>Sistema de Cotizaciones</h1>
                <p>Equipos de Seguridad Industrial</p>
                <p>Av. Principal 123, Ciudad</p>
                <p>Tel: +1-555-0100 | Email: info@empresa.com</p>
                <p>RUC: 98765432100</p>
            </div>
            
            <div class="cotizacion-info">
                <h2>COTIZACIÓN</h2>
                <p><strong>Número:</strong> <?php echo $cotizacion['numero']; ?></p>
                <p><strong>Fecha:</strong> <?php echo date('d/m/Y', strtotime($cotizacion['fecha'])); ?></p>
                <p><strong>Validez:</strong> <?php echo $cotizacion['validez']; ?></p>
                <p><strong>Vendedor:</strong> <?php echo $cotizacion['vendedor']; ?></p>
            </div>
        </div>
        
        <!-- Client Information -->
        <div class="client-section">
            <div class="client-info">
                <h3>DATOS DEL CLIENTE</h3>
                <p><strong><?php echo $cotizacion['cliente']['nombre']; ?></strong></p>
                <p>RUC: <?php echo $cotizacion['cliente']['ruc']; ?></p>
                <p>Contacto: <?php echo $cotizacion['cliente']['contacto']; ?></p>
                <p>Dirección: <?php echo $cotizacion['cliente']['direccion']; ?></p>
            </div>
            
            <div class="client-info">
                <h3>INFORMACIÓN DE CONTACTO</h3>
                <p>Teléfono: <?php echo $cotizacion['cliente']['telefono']; ?></p>
                <p>Email: <?php echo $cotizacion['cliente']['email']; ?></p>
                <p>Fecha de cotización: <?php echo date('d/m/Y'); ?></p>
            </div>
        </div>
        
        <!-- Items Table -->
        <table class="items-table">
            <thead>
                <tr>
                    <th style="width: 5%;">#</th>
                    <th style="width: 30%;">Producto</th>
                    <th style="width: 25%;">Proveedor</th>
                    <th style="width: 8%;">Cant.</th>
                    <th style="width: 10%;">Precio Unit.</th>
                    <th style="width: 10%;">Descuento</th>
                    <th style="width: 12%;">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($cotizacion['items'] as $index => $item): ?>
                <tr>
                    <td><?php echo $index + 1; ?></td>
                    <td>
                        <strong><?php echo $item['producto']; ?></strong>
                    </td>
                    <td><?php echo $item['proveedor']; ?></td>
                    <td style="text-align: center;"><?php echo $item['cantidad']; ?></td>
                    <td style="text-align: right;">$<?php echo number_format($item['precio'], 2); ?></td>
                    <td style="text-align: center;"><?php echo $item['descuento']; ?></td>
                    <td style="text-align: right;"><strong>$<?php echo number_format($item['subtotal'], 2); ?></strong></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        
        <!-- Totals -->
        <div class="totals-section">
            <table class="totals-table">
                <tr>
                    <td class="label">Subtotal:</td>
                    <td class="amount">$<?php echo number_format($cotizacion['subtotal'], 2); ?></td>
                </tr>
                <tr>
                    <td class="label">IVA (18%):</td>
                    <td class="amount">$<?php echo number_format($cotizacion['iva'], 2); ?></td>
                </tr>
                <tr class="final-total">
                    <td class="label">TOTAL:</td>
                    <td class="amount">$<?php echo number_format($cotizacion['total'], 2); ?></td>
                </tr>
            </table>
        </div>
        
        <!-- Conditions -->
        <div class="conditions">
            <h3>CONDICIONES COMERCIALES</h3>
            <p><?php echo $cotizacion['condiciones']; ?></p>
            <p><strong>Validez de la cotización:</strong> <?php echo $cotizacion['validez']; ?> desde la fecha de emisión.</p>
            <p><strong>Entrega:</strong> Los productos están sujetos a disponibilidad de stock.</p>
            <p><strong>Garantía:</strong> Según especificaciones de cada proveedor.</p>
        </div>
        
        <!-- Signatures -->
        <div class="signature-section">
            <div class="signature-box">
                <div class="signature-line"></div>
                <p><strong>Cliente</strong></p>
                <p><?php echo $cotizacion['cliente']['contacto']; ?></p>
                <p><?php echo $cotizacion['cliente']['nombre']; ?></p>
            </div>
            
            <div class="signature-box">
                <div class="signature-line"></div>
                <p><strong>Vendedor</strong></p>
                <p><?php echo $cotizacion['vendedor']; ?></p>
                <p>Sistema de Cotizaciones</p>
            </div>
        </div>
        
        <!-- Footer -->
        <div class="footer">
            <p>Esta cotización fue generada automáticamente por el Sistema de Cotizaciones de Equipos de Seguridad Industrial</p>
            <p>Para dudas o consultas, contacte al vendedor asignado o a nuestro departamento de ventas</p>
            <p>Generado el: <?php echo date('d/m/Y H:i:s'); ?></p>
        </div>
    </div>

    <script>
        // Auto-focus para impresión si viene del parámetro
        <?php if (isset($_GET['print']) && $_GET['print'] == '1'): ?>
            window.onload = function() {
                setTimeout(function() {
                    window.print();
                }, 500);
            };
        <?php endif; ?>
    </script>
</body>
</html>
