<?php

require_once '../controlador/loginController.php';

$error = isset($_SESSION['login_error']) ? $_SESSION['login_error'] : '';
unset($_SESSION['login_error']);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistema de Cotizaciones</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="login-page">
    <div class="login-container">
        <div class="login-form">
            <h2>Sistema de Cotizaciones</h2>
            <h3>Equipos de Seguridad Industrial</h3>
            
            <?php if ($error): ?>
                <div class="error"><?php echo $error; ?></div>
            <?php endif; ?>
            
            <form method="POST">
                <div class="form-group">
                    <label for="usuario">Usuario:</label>
                    <input type="text" id="usuario" name="usuario" required>
                </div>
                
                <div class="form-group">
                    <label for="password">Contraseña:</label>
                    <input type="password" id="password" name="password" required>
                </div>
                
                <button type="submit" class="btn btn-primary">Iniciar Sesión</button>
            </form>
            
            <div class="demo-users">
                <h4>Usuarios de prueba:</h4>
                <ul>
                    <li><strong>admin</strong> / admin (Administrador)</li>
                    <li><strong>bodeguero</strong> / 123 (Bodeguero)</li>
                    <li><strong>ventas</strong> / 123 (Ventas)</li>
                    <li><strong>logistica</strong> / 123 (Logística)</li>
                </ul>
            </div>
        </div>
    </div>
</body>
</html>
