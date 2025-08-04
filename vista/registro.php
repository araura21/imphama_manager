<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Registro - IMPHAMA Manager</title>
  <link rel="stylesheet" href="assets/css/estilos.css">
</head>
<body>
  <div class="login-container">
    <h2>Registrarse</h2>
    <form method="POST" action="../controlador/proveedorController/clienteController/registrarCliente.php">
      <input type="text" name="nombre" placeholder="Nombre completo" required>
      <input type="email" name="correo" placeholder="Correo electrónico" required>
      <input type="text" name="usuario" placeholder="Nombre de usuario" required>
      <input type="password" name="contrasena" placeholder="Contraseña" required>
      <button type="submit">Registrar</button>
      <p>¿Ya tienes cuenta? <a href="login.php">Inicia sesión</a></p>
    </form>
  </div>
</body>
</html>
