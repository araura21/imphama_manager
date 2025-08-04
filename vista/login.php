<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Iniciar Sesión - IMPHAMA Manager</title>
  <link rel="stylesheet" href="assets/css/estilos.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<body>
  <div class="login-wrapper">
    <!-- Sección izquierda - Imagen y branding -->
    <div class="left-section">
      <div class="brand-overlay">
        <div class="brand-content">
          <div class="company-logo">
            <div class="logo-circle">
              <i class="fas fa-shield-alt"></i>
            </div>
            <h1 class="company-name">IMPHAMA</h1>
            <p class="company-tagline">Seguridad Industrial</p>
          </div>
        </div>
      </div>
    </div>

    <!-- Sección derecha - Formulario -->
    <div class="right-section">
      <div class="login-container">
        <div class="login-header">
          <h2 class="form-title">Iniciar Sesión</h2>
          <p class="form-subtitle">Accede a tu cuenta para continuar</p>
        </div>

        <form class="login-form">
          <div class="form-group">
            <label for="usuario" class="form-label">Usuario</label>
            <div class="input-wrapper">
              <i class="fas fa-user input-icon"></i>
              <input 
                type="text" 
                id="usuario"
                name="usuario" 
                placeholder="Ingresa tu usuario" 
                class="form-input"
              >
            </div>
          </div>
          
          <div class="form-group">
            <label for="contrasena" class="form-label">Contraseña</label>
            <div class="input-wrapper">
              <i class="fas fa-lock input-icon"></i>
              <input 
                type="password" 
                id="contrasena"
                name="contrasena" 
                placeholder="Ingresa tu contraseña" 
                class="form-input"
              >
              <button type="button" class="toggle-password" onclick="togglePassword()">
                <i class="fas fa-eye" id="toggleIcon"></i>
              </button>
            </div>
          </div>

          <div class="form-options">
            <label class="checkbox-wrapper">
              <input type="checkbox" name="remember">
              <span class="checkmark"></span>
              <span class="checkbox-text">Recordarme</span>
            </label>
            <a href="#" class="forgot-link">¿Olvidaste tu contraseña?</a>
          </div>
          
          <button type="button" class="login-btn" onclick="handleLogin()">
            <span>Iniciar Sesión</span>
            <i class="fas fa-arrow-right btn-icon"></i>
          </button>
        </form>

        <div class="divider">
          <span>o</span>
        </div>

        <div class="register-section">
          <p class="register-text">¿No tienes una cuenta?</p>
          <a href="registro.php" class="register-link">Regístrate aquí</a>
        </div>
      </div>
    </div>
  </div>

  <script>
    function togglePassword() {
      const passwordInput = document.getElementById('contrasena');
      const toggleIcon = document.getElementById('toggleIcon');
      
      if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        toggleIcon.classList.remove('fa-eye');
        toggleIcon.classList.add('fa-eye-slash');
      } else {
        passwordInput.type = 'password';
        toggleIcon.classList.remove('fa-eye-slash');
        toggleIcon.classList.add('fa-eye');
      }
    }

    function handleLogin() {
      const usuario = document.getElementById('usuario').value;
      const contrasena = document.getElementById('contrasena').value;
      
      // Solo para demostración visual - sin backend
      if (usuario && contrasena) {
        alert('¡Formulario enviado! (Solo demostración visual)');
      } else {
        alert('Por favor completa todos los campos');
      }
    }

    // Animación de entrada
    document.addEventListener('DOMContentLoaded', function() {
      const rightSection = document.querySelector('.right-section');
      const leftSection = document.querySelector('.left-section');
      
      rightSection.style.opacity = '0';
      rightSection.style.transform = 'translateX(30px)';
      leftSection.style.opacity = '0';
      leftSection.style.transform = 'translateX(-30px)';
      
      setTimeout(() => {
        rightSection.style.transition = 'all 0.8s ease';
        leftSection.style.transition = 'all 0.8s ease';
        rightSection.style.opacity = '1';
        rightSection.style.transform = 'translateX(0)';
        leftSection.style.opacity = '1';
        leftSection.style.transform = 'translateX(0)';
      }, 200);
    });
  </script>
</body>
</html>
