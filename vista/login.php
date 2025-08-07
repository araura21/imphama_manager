<?php
session_start();
require_once 'includes/database.php';

// Si ya está logueado, redirigir al index
if (isset($_SESSION['usuario_id'])) {
    header('Location: index.php');
    exit();
}

$error = '';

if ($_POST) {
    $usuario = $_POST['usuario'] ?? '';
    $password = $_POST['password'] ?? '';
    
    if (!empty($usuario) && !empty($password)) {
        try {
            $db = getDB();
            
            // Buscar usuario en la base de datos
            $sql = "SELECT id, usuario, nombre, email, rol, activo FROM usuarios 
                    WHERE usuario = :usuario AND password = MD5(:password) AND activo = 1";
            
            $result = $db->fetch($sql, [
                'usuario' => $usuario,
                'password' => $password
            ]);
            
            if ($result) {
                $_SESSION['usuario_id'] = $result['id'];
                $_SESSION['usuario_nombre'] = $result['nombre'];
                $_SESSION['usuario_rol'] = $result['rol'];
                $_SESSION['usuario_email'] = $result['email'];
                
                header('Location: index.php');
                exit();
            } else {
                $error = 'Usuario o contraseña incorrectos';
            }
        } catch (Exception $e) {
            $error = 'Error de conexión. Intente nuevamente.';
        }
    } else {
        $error = 'Complete todos los campos';
    }
}
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
