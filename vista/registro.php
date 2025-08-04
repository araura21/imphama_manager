<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registro - IMPHAMA Manager</title>
  <link rel="stylesheet" href="assets/css/estilos.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<body class="register-body">
  <div class="register-wrapper">
    <!-- Header con logo -->
    <div class="register-header">
      <div class="header-logo">
        <div class="logo-icon">
          <i class="fas fa-shield-alt"></i>
        </div>
        <h1 class="header-title">IMPHAMA</h1>
        <p class="header-subtitle">Seguridad Industrial</p>
      </div>
    </div>

    <!-- Contenedor principal del formulario -->
    <div class="register-container">
      <div class="register-content">
        <!-- Título del formulario -->
        <div class="form-header">
          <h2 class="form-title">Crear Cuenta</h2>
          <p class="form-description">Complete todos los campos para registrarse</p>
        </div>

        <!-- Formulario de registro -->
        <form class="register-form" onsubmit="handleRegistration(event)">
          
          <!-- Información Personal -->
          <div class="form-section">
            <h3 class="section-title">
              <i class="fas fa-user section-icon"></i>
              Información Personal
            </h3>
            
            <div class="form-row">
              <div class="form-group">
                <label for="nombre" class="form-label">Nombre Completo *</label>
                <div class="input-wrapper">
                  <i class="fas fa-user input-icon"></i>
                  <input 
                    type="text" 
                    id="nombre"
                    name="nombre" 
                    placeholder="Ingrese su nombre completo" 
                    class="form-input"
                    required
                  >
                </div>
              </div>
              
              <div class="form-group">
                <label for="cedula" class="form-label">Cédula de Identidad *</label>
                <div class="input-wrapper">
                  <i class="fas fa-id-card input-icon"></i>
                  <input 
                    type="text" 
                    id="cedula"
                    name="cedula" 
                    placeholder="V-12345678" 
                    class="form-input"
                    required
                  >
                </div>
              </div>
            </div>

            <div class="form-row">
              <div class="form-group">
                <label for="telefono" class="form-label">Teléfono *</label>
                <div class="input-wrapper">
                  <i class="fas fa-phone input-icon"></i>
                  <input 
                    type="tel" 
                    id="telefono"
                    name="telefono" 
                    placeholder="0412-1234567" 
                    class="form-input"
                    required
                  >
                </div>
              </div>
              
              <div class="form-group">
                <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento *</label>
                <div class="input-wrapper">
                  <i class="fas fa-calendar input-icon"></i>
                  <input 
                    type="date" 
                    id="fecha_nacimiento"
                    name="fecha_nacimiento" 
                    class="form-input"
                    required
                  >
                </div>
              </div>
            </div>
          </div>

          <!-- Información de Contacto -->
          <div class="form-section">
            <h3 class="section-title">
              <i class="fas fa-envelope section-icon"></i>
              Información de Contacto
            </h3>
            
            <div class="form-row">
              <div class="form-group full-width">
                <label for="correo" class="form-label">Correo Electrónico *</label>
                <div class="input-wrapper">
                  <i class="fas fa-envelope input-icon"></i>
                  <input 
                    type="email" 
                    id="correo"
                    name="correo" 
                    placeholder="usuario@ejemplo.com" 
                    class="form-input"
                    required
                  >
                </div>
              </div>
            </div>

            <div class="form-row">
              <div class="form-group full-width">
                <label for="direccion" class="form-label">Dirección Completa *</label>
                <div class="input-wrapper">
                  <i class="fas fa-map-marker-alt input-icon"></i>
                  <textarea 
                    id="direccion"
                    name="direccion" 
                    placeholder="Ingrese su dirección completa" 
                    class="form-textarea"
                    rows="3"
                    required
                  ></textarea>
                </div>
              </div>
            </div>

            <div class="form-row">
              <div class="form-group">
                <label for="ciudad" class="form-label">Ciudad *</label>
                <div class="input-wrapper">
                  <i class="fas fa-city input-icon"></i>
                  <input 
                    type="text" 
                    id="ciudad"
                    name="ciudad" 
                    placeholder="Caracas" 
                    class="form-input"
                    required
                  >
                </div>
              </div>
              
              <div class="form-group">
                <label for="estado" class="form-label">Estado *</label>
                <div class="input-wrapper">
                  <i class="fas fa-map input-icon"></i>
                  <select id="estado" name="estado" class="form-select" required>
                    <option value="">Seleccione un estado</option>
                    <option value="Distrito Capital">Distrito Capital</option>
                    <option value="Miranda">Miranda</option>
                    <option value="Carabobo">Carabobo</option>
                    <option value="Zulia">Zulia</option>
                    <option value="Lara">Lara</option>
                    <option value="Aragua">Aragua</option>
                    <option value="Anzoátegui">Anzoátegui</option>
                    <option value="Bolívar">Bolívar</option>
                    <option value="Táchira">Táchira</option>
                    <option value="Mérida">Mérida</option>
                    <option value="Otro">Otro</option>
                  </select>
                </div>
              </div>
            </div>
          </div>

          <!-- Información de Acceso -->
          <div class="form-section">
            <h3 class="section-title">
              <i class="fas fa-key section-icon"></i>
              Información de Acceso
            </h3>
            
            <div class="form-row">
              <div class="form-group full-width">
                <label for="usuario" class="form-label">Nombre de Usuario *</label>
                <div class="input-wrapper">
                  <i class="fas fa-user-circle input-icon"></i>
                  <input 
                    type="text" 
                    id="usuario"
                    name="usuario" 
                    placeholder="Elija un nombre de usuario único" 
                    class="form-input"
                    required
                  >
                </div>
              </div>
            </div>

            <div class="form-row">
              <div class="form-group">
                <label for="contrasena" class="form-label">Contraseña *</label>
                <div class="input-wrapper">
                  <i class="fas fa-lock input-icon"></i>
                  <input 
                    type="password" 
                    id="contrasena"
                    name="contrasena" 
                    placeholder="Mínimo 8 caracteres" 
                    class="form-input"
                    required
                  >
                  <button type="button" class="toggle-password" onclick="togglePassword('contrasena', 'toggleIcon1')">
                    <i class="fas fa-eye" id="toggleIcon1"></i>
                  </button>
                </div>
              </div>
              
              <div class="form-group">
                <label for="confirmar_contrasena" class="form-label">Confirmar Contraseña *</label>
                <div class="input-wrapper">
                  <i class="fas fa-lock input-icon"></i>
                  <input 
                    type="password" 
                    id="confirmar_contrasena"
                    name="confirmar_contrasena" 
                    placeholder="Repita su contraseña" 
                    class="form-input"
                    required
                  >
                  <button type="button" class="toggle-password" onclick="togglePassword('confirmar_contrasena', 'toggleIcon2')">
                    <i class="fas fa-eye" id="toggleIcon2"></i>
                  </button>
                </div>
              </div>
            </div>
          </div>

          <!-- Términos y condiciones -->
          <div class="form-section">
            <div class="terms-section">
              <label class="checkbox-wrapper">
                <input type="checkbox" name="terms" required>
                <span class="checkmark"></span>
                <span class="checkbox-text">
                  Acepto los <a href="#" class="terms-link">términos y condiciones</a> 
                  y la <a href="#" class="terms-link">política de privacidad</a> *
                </span>
              </label>
              
              <label class="checkbox-wrapper">
                <input type="checkbox" name="newsletter">
                <span class="checkmark"></span>
                <span class="checkbox-text">
                  Deseo recibir información sobre productos y servicios de IMPHAMA
                </span>
              </label>
            </div>
          </div>

          <!-- Botones de acción -->
          <div class="form-actions">
            <button type="button" class="btn-secondary" onclick="window.location.href='login.php'">
              <i class="fas fa-arrow-left"></i>
              Volver al Login
            </button>
            
            <button type="submit" class="btn-primary">
              <i class="fas fa-user-plus"></i>
              Crear Cuenta
            </button>
          </div>
        </form>
      </div>
    </div>

    <!-- Footer -->
    <div class="register-footer">
      <p>&copy; 2025 IMPHAMA. Todos los derechos reservados.</p>
    </div>
  </div>

  <script>
    function togglePassword(inputId, iconId) {
      const passwordInput = document.getElementById(inputId);
      const toggleIcon = document.getElementById(iconId);
      
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

    function handleRegistration(event) {
      event.preventDefault();
      
      // Validar que las contraseñas coincidan
      const password = document.getElementById('contrasena').value;
      const confirmPassword = document.getElementById('confirmar_contrasena').value;
      
      if (password !== confirmPassword) {
        alert('Las contraseñas no coinciden. Por favor verifique.');
        return;
      }
      
      // Validar que todos los campos requeridos estén completos
      const requiredFields = document.querySelectorAll('[required]');
      let allValid = true;
      
      requiredFields.forEach(field => {
        if (!field.value.trim()) {
          allValid = false;
          field.classList.add('error');
        } else {
          field.classList.remove('error');
        }
      });
      
      if (!allValid) {
        alert('Por favor complete todos los campos requeridos (*)');
        return;
      }
      
      // Solo para demostración visual - sin backend
      alert('¡Cuenta creada exitosamente! (Solo demostración visual)\n\nEn un sistema real, aquí se procesarían los datos.');
    }

    // Animación de entrada
    document.addEventListener('DOMContentLoaded', function() {
      const container = document.querySelector('.register-container');
      const header = document.querySelector('.register-header');
      
      container.style.opacity = '0';
      container.style.transform = 'translateY(20px)';
      header.style.opacity = '0';
      header.style.transform = 'translateY(-20px)';
      
      setTimeout(() => {
        container.style.transition = 'all 0.8s ease';
        header.style.transition = 'all 0.8s ease';
        container.style.opacity = '1';
        container.style.transform = 'translateY(0)';
        header.style.opacity = '1';
        header.style.transform = 'translateY(0)';
      }, 200);
    });
  </script>
</body>
</html>
