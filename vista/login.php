<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Login - IMPHAMA Manager</title>
  <link rel="stylesheet" href="assets/css/estilos.css">
</head>
<body>
  <div class="login-container">
    <h2>Iniciar Sesión</h2>
    <form method="POST" action="../controlador/validarInicioSesion.php">
      <input type="text" name="usuario" placeholder="Usuario" required>
      <input type="password" name="contrasena" placeholder="Contraseña" required>
      <button type="submit">Entrar</button>
      <p>¿No tienes cuenta? <a href="registro.php">Regístrate</a></p>
    </form>
  </div>
</body>
</html>
