<?php require_once __DIR__ . '/database.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Cotizaciones - Equipos de Seguridad Industrial</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <nav class="navbar">
            <div class="nav-brand">
                <h1>Sistema de Cotizaciones</h1>
            </div>
            <div class="nav-links">
                <span>Bienvenido, <?php echo escape($_SESSION['usuario_nombre']); ?> (<?php echo escape($_SESSION['usuario_rol']); ?>)</span>
                <a href="index.php">Inicio</a>
                <a href="logout.php" class="btn btn-sm">Cerrar Sesión</a>
            </div>
        </nav>
    </header>
    <main>
