<?php
session_start();

// Redirigir a login si no está logueado
if (!isset($_SESSION['usuario_id'])) {
    header('Location: login.php');
    exit();
}

include 'includes/header.php';
?>

<div class="container">
    <div class="welcome-section">
        <h1>Bienvenido al Sistema de Cotizaciones</h1>
        <p>Usuario: <strong><?php echo $_SESSION['usuario_nombre']; ?></strong></p>
        <p>Rol: <strong><?php echo $_SESSION['usuario_rol']; ?></strong></p>
    </div>

    <div class="modules-grid">
        <?php if ($_SESSION['usuario_rol'] == 'Admin'): ?>
            <div class="module-card">
                <h3>Dashboard</h3>
                <p>Panel de control administrativo</p>
                <a href="dashboard.php" class="btn">Acceder</a>
            </div>
            <div class="module-card">
                <h3>Usuarios</h3>
                <p>Gestión de usuarios del sistema</p>
                <a href="usuarios.php" class="btn">Gestionar</a>
            </div>
        <?php endif; ?>

        <?php if ($_SESSION['usuario_rol'] == 'Admin' || $_SESSION['usuario_rol'] == 'Bodeguero'): ?>
            <div class="module-card">
                <h3>Productos</h3>
                <p>Gestión de productos</p>
                <a href="productos.php" class="btn">Gestionar</a>
            </div>
        <?php endif; ?>

        <?php if ($_SESSION['usuario_rol'] == 'Admin' || $_SESSION['usuario_rol'] == 'Logística'): ?>
            <div class="module-card">
                <h3>Proveedores</h3>
                <p>Gestión de proveedores</p>
                <a href="proveedores.php" class="btn">Gestionar</a>
            </div>
        <?php endif; ?>

        <?php if ($_SESSION['usuario_rol'] == 'Admin' || $_SESSION['usuario_rol'] == 'Ventas'): ?>
            <div class="module-card">
                <h3>Clientes</h3>
                <p>Gestión de clientes</p>
                <a href="clientes.php" class="btn">Gestionar</a>
            </div>
            <div class="module-card">
                <h3>Cotizaciones</h3>
                <p>Crear y gestionar cotizaciones</p>
                <a href="cotizaciones.php" class="btn">Gestionar</a>
            </div>
            <div class="module-card featured">
                <h3>Hacer Cotización</h3>
                <p>Crear nueva cotización comparativa</p>
                <a href="hacer_cotizacion.php" class="btn btn-primary">Crear Nueva</a>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
