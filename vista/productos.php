<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Productos - IMPHAMA Manager</title>
  <link rel="stylesheet" href="assets/css/estilos.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<body class="products-body">
  <div class="products-wrapper">
    
    <!-- Header -->
    <header class="products-header">
      <div class="header-content">
        <div class="logo-section">
          <img src="assets/img/logo.png" alt="IMPHAMA" class="company-logo">
          <div class="logo-text">
            <h1 class="company-name">IMPHAMA</h1>
            <p class="company-tagline">Seguridad Industrial</p>
          </div>
        </div>
        
        <nav class="header-nav">
          <a href="login.php" class="nav-link">
            <i class="fas fa-sign-in-alt"></i>
            Iniciar Sesión
          </a>
          <a href="registro.php" class="nav-link">
            <i class="fas fa-user-plus"></i>
            Registrarse
          </a>
        </nav>
      </div>
    </header>

    <!-- Main Content -->
    <div class="main-content">
      
      <!-- Sidebar Menu -->
      <aside class="sidebar">
        <div class="sidebar-header">
          <h2 class="sidebar-title">
            <i class="fas fa-boxes"></i>
            Categorías
          </h2>
        </div>
        
        <nav class="categories-menu">
          <button class="category-item active" data-category="proteccion-respiratoria">
            <i class="fas fa-head-side-mask"></i>
            <span>Protección Respiratoria</span>
            <i class="fas fa-chevron-right"></i>
          </button>
          
          <button class="category-item" data-category="proteccion-visual">
            <i class="fas fa-glasses"></i>
            <span>Protección Visual</span>
            <i class="fas fa-chevron-right"></i>
          </button>
          
          <button class="category-item" data-category="proteccion-auditiva">
            <i class="fas fa-assistive-listening-systems"></i>
            <span>Protección Auditiva</span>
            <i class="fas fa-chevron-right"></i>
          </button>
          
          <button class="category-item" data-category="proteccion-corporal">
            <i class="fas fa-vest"></i>
            <span>Protección Corporal</span>
            <i class="fas fa-chevron-right"></i>
          </button>
          
          <button class="category-item" data-category="proteccion-manos">
            <i class="fas fa-hand-paper"></i>
            <span>Protección de Manos</span>
            <i class="fas fa-chevron-right"></i>
          </button>
          
          <button class="category-item" data-category="proteccion-pies">
            <i class="fas fa-shoe-prints"></i>
            <span>Protección de Pies</span>
            <i class="fas fa-chevron-right"></i>
          </button>
          
          <button class="category-item" data-category="equipos-rescate">
            <i class="fas fa-first-aid"></i>
            <span>Equipos de Rescate</span>
            <i class="fas fa-chevron-right"></i>
          </button>
          
          <button class="category-item" data-category="senalizacion">
            <i class="fas fa-exclamation-triangle"></i>
            <span>Señalización</span>
            <i class="fas fa-chevron-right"></i>
          </button>
        </nav>
        
        <div class="sidebar-footer">
          <div class="contact-info">
            <h3>¿Necesitas ayuda?</h3>
            <p>Contacta a nuestros especialistas</p>
            <button class="contact-btn">
              <i class="fas fa-phone"></i>
              Contactar
            </button>
          </div>
        </div>
      </aside>

      <!-- Products Area -->
      <main class="products-area">
        <div class="products-content">
          
          <!-- Category Header -->
          <div class="category-header">
            <h2 class="category-title">
              <i class="fas fa-head-side-mask category-icon"></i>
              Protección Respiratoria
            </h2>
            <p class="category-description">
              Equipos de protección para las vías respiratorias en entornos industriales
            </p>
          </div>

          <!-- Products Grid -->
          <div class="products-grid">
            
            <!-- Product Card 1 -->
            <div class="product-card">
              <div class="product-image">
                <img src="assets/img/productos/pro1.png" alt="Mascarilla Respiratoria N95">
                <div class="product-overlay">
                  <button class="product-btn" onclick="goToComparator('Mascarilla Respiratoria N95', 'pro1.png', 'proteccion-respiratoria')">
                    <i class="fas fa-balance-scale"></i>
                    Comparar Proveedores
                  </button>
                </div>
              </div>
              <div class="product-info">
                <h3 class="product-name">Mascarilla Respiratoria N95</h3>
                <p class="product-description">Protección contra partículas y aerosoles</p>
                <div class="product-specs">
                  <span class="spec-item">
                    <i class="fas fa-shield-alt"></i>
                    Certificada
                  </span>
                  <span class="spec-item">
                    <i class="fas fa-star"></i>
                    Premium
                  </span>
                </div>
              </div>
            </div>

            <!-- Product Card 2 -->
            <div class="product-card">
              <div class="product-image">
                <img src="assets/img/productos/pro2.jpg" alt="Respirador Media Cara">
                <div class="product-overlay">
                  <button class="product-btn" onclick="goToComparator('Respirador Media Cara', 'pro2.jpg', 'proteccion-respiratoria')">
                    <i class="fas fa-balance-scale"></i>
                    Comparar Proveedores
                  </button>
                </div>
              </div>
              <div class="product-info">
                <h3 class="product-name">Respirador Media Cara</h3>
                <p class="product-description">Con filtros intercambiables P100</p>
                <div class="product-specs">
                  <span class="spec-item">
                    <i class="fas fa-shield-alt"></i>
                    Reutilizable
                  </span>
                  <span class="spec-item">
                    <i class="fas fa-cog"></i>
                    Ajustable
                  </span>
                </div>
              </div>
            </div>

            <!-- Product Card 3 -->
            <div class="product-card">
              <div class="product-image">
                <img src="assets/img/productos/pro3.jpg" alt="Mascarilla Desechable">
                <div class="product-overlay">
                  <button class="product-btn" onclick="goToComparator('Mascarilla Desechable', 'pro3.jpg', 'proteccion-respiratoria')">
                    <i class="fas fa-balance-scale"></i>
                    Comparar Proveedores
                  </button>
                </div>
              </div>
              <div class="product-info">
                <h3 class="product-name">Mascarilla Desechable</h3>
                <p class="product-description">Protección básica contra polvo</p>
                <div class="product-specs">
                  <span class="spec-item">
                    <i class="fas fa-recycle"></i>
                    Desechable
                  </span>
                  <span class="spec-item">
                    <i class="fas fa-dollar-sign"></i>
                    Económica
                  </span>
                </div>
              </div>
            </div>

            <!-- Product Card 4 -->
            <div class="product-card">
              <div class="product-image">
                <img src="assets/img/productos/pro4.jpg" alt="Respirador Cara Completa">
                <div class="product-overlay">
                  <button class="product-btn" onclick="goToComparator('Respirador Cara Completa', 'pro4.jpg', 'proteccion-respiratoria')">
                    <i class="fas fa-balance-scale"></i>
                    Comparar Proveedores
                  </button>
                </div>
              </div>
              <div class="product-info">
                <h3 class="product-name">Respirador Cara Completa</h3>
                <p class="product-description">Máxima protección respiratoria y visual</p>
                <div class="product-specs">
                  <span class="spec-item">
                    <i class="fas fa-shield-alt"></i>
                    Máxima Protección
                  </span>
                  <span class="spec-item">
                    <i class="fas fa-eye"></i>
                    Visual + Respiratoria
                  </span>
                </div>
              </div>
            </div>

            <!-- Product Card 5 -->
            <div class="product-card">
              <div class="product-image">
                <img src="assets/img/productos/pro5.jpg" alt="Filtros P100">
                <div class="product-overlay">
                  <button class="product-btn" onclick="goToComparator('Filtros P100', 'pro5.jpg', 'proteccion-respiratoria')">
                    <i class="fas fa-balance-scale"></i>
                    Comparar Proveedores
                  </button>
                </div>
              </div>
              <div class="product-info">
                <h3 class="product-name">Filtros P100</h3>
                <p class="product-description">Filtros de alta eficiencia</p>
                <div class="product-specs">
                  <span class="spec-item">
                    <i class="fas fa-filter"></i>
                    99.97% Eficiencia
                  </span>
                  <span class="spec-item">
                    <i class="fas fa-sync-alt"></i>
                    Reemplazable
                  </span>
                </div>
              </div>
            </div>

            <!-- Product Card 6 -->
            <div class="product-card">
              <div class="product-image">
                <img src="assets/img/productos/pro6.png" alt="Equipo Autónomo">
                <div class="product-overlay">
                  <button class="product-btn" onclick="goToComparator('Equipo Autónomo', 'pro6.png', 'proteccion-respiratoria')">
                    <i class="fas fa-balance-scale"></i>
                    Comparar Proveedores
                  </button>
                </div>
              </div>
              <div class="product-info">
                <h3 class="product-name">Equipo Autónomo</h3>
                <p class="product-description">Respiración autónoma para espacios confinados</p>
                <div class="product-specs">
                  <span class="spec-item">
                    <i class="fas fa-air-freshener"></i>
                    Aire Limpio
                  </span>
                  <span class="spec-item">
                    <i class="fas fa-clock"></i>
                    4 Horas
                  </span>
                </div>
              </div>
            </div>

          </div>
        </div>
      </main>
    </div>
  </div>

  <script>
    // Datos de productos por categoría
    const productData = {
      'proteccion-respiratoria': {
        title: 'Protección Respiratoria',
        icon: 'fas fa-head-side-mask',
        description: 'Equipos de protección para las vías respiratorias en entornos industriales',
        products: [
          {
            image: 'respiratoria/1.jpg',
            name: 'Mascarilla Respiratoria N95',
            description: 'Protección contra partículas y aerosoles',
            specs: [
              { icon: 'fas fa-shield-alt', text: 'Certificada' },
              { icon: 'fas fa-star', text: 'Premium' }
            ]
          },
          {
            image: 'respiratoria/2.jpg',
            name: 'Respirador Media Cara',
            description: 'Con filtros intercambiables P100',
            specs: [
              { icon: 'fas fa-shield-alt', text: 'Reutilizable' },
              { icon: 'fas fa-cog', text: 'Ajustable' }
            ]
          },
          {
            image: 'respiratoria/3.jpg',
            name: 'Mascarilla Desechable',
            description: 'Protección básica contra polvo',
            specs: [
              { icon: 'fas fa-recycle', text: 'Desechable' },
              { icon: 'fas fa-dollar-sign', text: 'Económica' }
            ]
          },
          {
            image: 'respiratoria/4.jpg',
            name: 'Respirador Cara Completa',
            description: 'Máxima protección respiratoria y visual',
            specs: [
              { icon: 'fas fa-shield-alt', text: 'Máxima Protección' },
              { icon: 'fas fa-eye', text: 'Visual + Respiratoria' }
            ]
          },
          {
            image: 'respiratoria/5.jpg',
            name: 'Filtros P100',
            description: 'Filtros de alta eficiencia',
            specs: [
              { icon: 'fas fa-filter', text: '99.97% Eficiencia' },
              { icon: 'fas fa-sync-alt', text: 'Reemplazable' }
            ]
          },
          {
            image: 'respiratoria/6.jpg',
            name: 'Equipo Autónomo',
            description: 'Respiración autónoma para espacios confinados',
            specs: [
              { icon: 'fas fa-air-freshener', text: 'Aire Limpio' },
              { icon: 'fas fa-clock', text: '4 Horas' }
            ]
          },
          {
            image: 'respiratoria/7.jpg',
            name: 'Mascarilla FFP2',
            description: 'Protección europea estándar',
            specs: [
              { icon: 'fas fa-certificate', text: 'FFP2' },
              { icon: 'fas fa-leaf', text: 'Cómoda' }
            ]
          },
          {
            image: 'respiratoria/8.jpg',
            name: 'Respirador Elastomérico',
            description: 'Reutilizable con filtros intercambiables',
            specs: [
              { icon: 'fas fa-recycle', text: 'Reutilizable' },
              { icon: 'fas fa-wrench', text: 'Mantenimiento' }
            ]
          },
          {
            image: 'respiratoria/9.jpg',
            name: 'Purificador de Aire',
            description: 'Sistema motorizado de purificación',
            specs: [
              { icon: 'fas fa-fan', text: 'Motorizado' },
              { icon: 'fas fa-battery-full', text: 'Batería' }
            ]
          },
          {
            image: 'respiratoria/10.jpg',
            name: 'Mascarilla Quirúrgica',
            description: 'Protección médica desechable',
            specs: [
              { icon: 'fas fa-hospital', text: 'Médica' },
              { icon: 'fas fa-trash', text: 'Desechable' }
            ]
          }
        ]
      },
      'proteccion-visual': {
        title: 'Protección Visual',
        icon: 'fas fa-glasses',
        description: 'Gafas y caretas de protección para los ojos',
        products: [
          {
            image: 'visual/1.jpg',
            name: 'Gafas de Seguridad',
            description: 'Protección contra impactos y salpicaduras',
            specs: [
              { icon: 'fas fa-shield-alt', text: 'Anti-impacto' },
              { icon: 'fas fa-tint', text: 'Anti-salpicaduras' }
            ]
          },
          {
            image: 'visual/2.jpg',
            name: 'Careta Facial',
            description: 'Protección completa del rostro',
            specs: [
              { icon: 'fas fa-face-grin-wide', text: 'Cara Completa' },
              { icon: 'fas fa-adjust', text: 'Anti-reflejo' }
            ]
          },
          {
            image: 'visual/3.jpg',
            name: 'Gafas Anti-químicos',
            description: 'Resistente a químicos corrosivos',
            specs: [
              { icon: 'fas fa-flask', text: 'Anti-químicos' },
              { icon: 'fas fa-lock', text: 'Sellado hermético' }
            ]
          },
          {
            image: 'visual/4.jpg',
            name: 'Pantalla Soldadura',
            description: 'Protección UV para soldadores',
            specs: [
              { icon: 'fas fa-fire', text: 'Anti-UV' },
              { icon: 'fas fa-tools', text: 'Para soldadura' }
            ]
          },
          {
            image: 'visual/5.jpg',
            name: 'Gafas Láser',
            description: 'Protección contra radiación láser',
            specs: [
              { icon: 'fas fa-laser', text: 'Anti-láser' },
              { icon: 'fas fa-wave-square', text: 'Filtro específico' }
            ]
          },
          {
            image: 'visual/6.jpg',
            name: 'Gogles Deportivos',
            description: 'Para actividades deportivas',
            specs: [
              { icon: 'fas fa-running', text: 'Deportivo' },
              { icon: 'fas fa-wind', text: 'Anti-viento' }
            ]
          },
          {
            image: 'visual/7.jpg',
            name: 'Visor Protector',
            description: 'Visor transparente abatible',
            specs: [
              { icon: 'fas fa-arrows-alt-v', text: 'Abatible' },
              { icon: 'fas fa-eye', text: 'Transparente' }
            ]
          },
          {
            image: 'visual/8.jpg',
            name: 'Gafas Graduadas',
            description: 'Protección con graduación',
            specs: [
              { icon: 'fas fa-glasses', text: 'Graduadas' },
              { icon: 'fas fa-user-md', text: 'Personalizable' }
            ]
          },
          {
            image: 'visual/9.jpg',
            name: 'Protector Facial',
            description: 'Escudo facial completo',
            specs: [
              { icon: 'fas fa-shield', text: 'Escudo' },
              { icon: 'fas fa-head-side-mask', text: 'Facial' }
            ]
          },
          {
            image: 'visual/10.jpg',
            name: 'Gafas Polarizadas',
            description: 'Con filtro polarizado',
            specs: [
              { icon: 'fas fa-sun', text: 'Polarizadas' },
              { icon: 'fas fa-adjust', text: 'Anti-reflejo' }
            ]
          }
        ]
      },
      'proteccion-auditiva': {
        title: 'Protección Auditiva',
        icon: 'fas fa-assistive-listening-systems',
        description: 'Equipos para proteger el sistema auditivo',
        products: [
          {
            image: 'auditiva/1.jpg',
            name: 'Tapones Auditivos',
            description: 'Protección básica contra ruido',
            specs: [
              { icon: 'fas fa-volume-mute', text: '25dB Reducción' },
              { icon: 'fas fa-leaf', text: 'Cómodos' }
            ]
          },
          {
            image: 'auditiva/2.jpg',
            name: 'Orejeras Industriales',
            description: 'Máxima reducción de ruido',
            specs: [
              { icon: 'fas fa-volume-off', text: '35dB Reducción' },
              { icon: 'fas fa-cog', text: 'Ajustables' }
            ]
          },
          {
            image: 'auditiva/3.jpg',
            name: 'Protección Electrónica',
            description: 'Con amplificación selectiva',
            specs: [
              { icon: 'fas fa-microchip', text: 'Electrónica' },
              { icon: 'fas fa-volume-up', text: 'Amplificación' }
            ]
          },
          {
            image: 'auditiva/4.jpg',
            name: 'Tapones Moldeables',
            description: 'Se adaptan al oído',
            specs: [
              { icon: 'fas fa-hand-holding', text: 'Moldeables' },
              { icon: 'fas fa-user', text: 'Personalizados' }
            ]
          },
          {
            image: 'auditiva/5.jpg',
            name: 'Orejeras con Radio',
            description: 'Protección con comunicación',
            specs: [
              { icon: 'fas fa-radio', text: 'Radio FM' },
              { icon: 'fas fa-bluetooth', text: 'Bluetooth' }
            ]
          },
          {
            image: 'auditiva/6.jpg',
            name: 'Bandas Auditivas',
            description: 'Protección ligera',
            specs: [
              { icon: 'fas fa-feather', text: 'Ligeras' },
              { icon: 'fas fa-sync', text: 'Reutilizables' }
            ]
          },
          {
            image: 'auditiva/7.jpg',
            name: 'Tapones con Cordón',
            description: 'Con cuerda de seguridad',
            specs: [
              { icon: 'fas fa-link', text: 'Con cordón' },
              { icon: 'fas fa-shield', text: 'No se pierden' }
            ]
          },
          {
            image: 'auditiva/8.jpg',
            name: 'Orejeras Plegables',
            description: 'Compactas y portátiles',
            specs: [
              { icon: 'fas fa-compress', text: 'Plegables' },
              { icon: 'fas fa-suitcase', text: 'Portátiles' }
            ]
          },
          {
            image: 'auditiva/9.jpg',
            name: 'Protección Premium',
            description: 'Máxima comodidad y protección',
            specs: [
              { icon: 'fas fa-star', text: 'Premium' },
              { icon: 'fas fa-gem', text: 'Máxima calidad' }
            ]
          },
          {
            image: 'auditiva/10.jpg',
            name: 'Kit Completo',
            description: 'Varios tipos de protección',
            specs: [
              { icon: 'fas fa-box', text: 'Kit completo' },
              { icon: 'fas fa-list', text: 'Variedad' }
            ]
          }
        ]
      },
            'proteccion-corporal': {
        title: 'Protección Corporal',
        icon: 'fas fa-shield-alt',
        description: 'Ropa y equipos para protección del cuerpo',
        products: [
          {
            image: 'corporal/1.jpg',
            name: 'Traje Tyvek',
            description: 'Protección química completa',
            specs: [
              { icon: 'fas fa-flask', text: 'Anti-químico' },
              { icon: 'fas fa-shield', text: 'Completo' }
            ]
          },
          {
            image: 'corporal/2.jpg',
            name: 'Chaleco Reflectivo',
            description: 'Alta visibilidad',
            specs: [
              { icon: 'fas fa-eye', text: 'Alta visibilidad' },
              { icon: 'fas fa-sun', text: 'Reflectivo' }
            ]
          },
          {
            image: 'corporal/3.jpg',
            name: 'Overol Industrial',
            description: 'Protección general',
            specs: [
              { icon: 'fas fa-cog', text: 'Industrial' },
              { icon: 'fas fa-user-shield', text: 'Resistente' }
            ]
          },
          {
            image: 'corporal/4.jpg',
            name: 'Mandil Químico',
            description: 'Protección frontal',
            specs: [
              { icon: 'fas fa-vial', text: 'Químico' },
              { icon: 'fas fa-hand-paper', text: 'Impermeable' }
            ]
          },
          {
            image: 'corporal/5.jpg',
            name: 'Traje Anti-llama',
            description: 'Resistente al fuego',
            specs: [
              { icon: 'fas fa-fire', text: 'Anti-llama' },
              { icon: 'fas fa-thermometer', text: 'Resistente' }
            ]
          },
          {
            image: 'corporal/6.jpg',
            name: 'Bata de Laboratorio',
            description: 'Protección básica',
            specs: [
              { icon: 'fas fa-microscope', text: 'Laboratorio' },
              { icon: 'fas fa-clean', text: 'Higiénica' }
            ]
          },
          {
            image: 'corporal/7.jpg',
            name: 'Traje Impermeable',
            description: 'Protección contra líquidos',
            specs: [
              { icon: 'fas fa-tint', text: 'Impermeable' },
              { icon: 'fas fa-water', text: 'Anti-líquidos' }
            ]
          },
          {
            image: 'corporal/8.jpg',
            name: 'Chaleco Térmico',
            description: 'Protección contra calor',
            specs: [
              { icon: 'fas fa-temperature-high', text: 'Térmico' },
              { icon: 'fas fa-snowflake', text: 'Aislante' }
            ]
          },
          {
            image: 'corporal/9.jpg',
            name: 'Traje Desechable',
            description: 'Un solo uso',
            specs: [
              { icon: 'fas fa-recycle', text: 'Desechable' },
              { icon: 'fas fa-clock', text: 'Un uso' }
            ]
          },
          {
            image: 'corporal/10.jpg',
            name: 'Kit Protección',
            description: 'Conjunto completo',
            specs: [
              { icon: 'fas fa-box-open', text: 'Kit completo' },
              { icon: 'fas fa-check-double', text: 'Todo incluido' }
            ]
          }
        ]
      },
            'proteccion-manos': {
        title: 'Protección de Manos',
        icon: 'fas fa-hand-paper',
        description: 'Guantes especializados para diferentes trabajos',
        products: [
          {
            image: 'manos/1.jpg',
            name: 'Guantes Nitrilo',
            description: 'Resistentes a químicos',
            specs: [
              { icon: 'fas fa-flask', text: 'Anti-químico' },
              { icon: 'fas fa-hand-holding', text: 'Flexible' }
            ]
          },
          {
            image: 'manos/2.jpg',
            name: 'Guantes Látex',
            description: 'Uso médico y general',
            specs: [
              { icon: 'fas fa-heartbeat', text: 'Médico' },
              { icon: 'fas fa-hand', text: 'Sensibilidad' }
            ]
          },
          {
            image: 'manos/3.jpg',
            name: 'Guantes Mecánicos',
            description: 'Resistencia y agarre',
            specs: [
              { icon: 'fas fa-cog', text: 'Mecánico' },
              { icon: 'fas fa-grip-horizontal', text: 'Agarre' }
            ]
          },
          {
            image: 'manos/4.jpg',
            name: 'Guantes Corte',
            description: 'Resistentes a cortes',
            specs: [
              { icon: 'fas fa-cut', text: 'Anti-corte' },
              { icon: 'fas fa-shield', text: 'Nivel 5' }
            ]
          },
          {
            image: 'manos/5.jpg',
            name: 'Guantes Térmicos',
            description: 'Protección contra calor',
            specs: [
              { icon: 'fas fa-fire', text: 'Anti-calor' },
              { icon: 'fas fa-thermometer', text: 'Térmicos' }
            ]
          },
          {
            image: 'manos/6.jpg',
            name: 'Guantes Soldadura',
            description: 'Para trabajos de soldadura',
            specs: [
              { icon: 'fas fa-tools', text: 'Soldadura' },
              { icon: 'fas fa-fire-alt', text: 'Resistentes' }
            ]
          },
          {
            image: 'manos/7.jpg',
            name: 'Guantes Vinilo',
            description: 'Alternativa económica',
            specs: [
              { icon: 'fas fa-dollar-sign', text: 'Económicos' },
              { icon: 'fas fa-hand-pointer', text: 'Desechables' }
            ]
          },
          {
            image: 'manos/8.jpg',
            name: 'Guantes Criogénicos',
            description: 'Para bajas temperaturas',
            specs: [
              { icon: 'fas fa-snowflake', text: 'Criogénicos' },
              { icon: 'fas fa-temperature-low', text: 'Frío extremo' }
            ]
          },
          {
            image: 'manos/9.jpg',
            name: 'Guantes Eléctricos',
            description: 'Aislantes eléctricos',
            specs: [
              { icon: 'fas fa-bolt', text: 'Eléctrico' },
              { icon: 'fas fa-plug', text: 'Aislante' }
            ]
          },
          {
            image: 'manos/10.jpg',
            name: 'Kit Guantes',
            description: 'Variedad de protección',
            specs: [
              { icon: 'fas fa-box', text: 'Variedad' },
              { icon: 'fas fa-hands', text: 'Múltiples usos' }
            ]
          }
        ]
      },
            'proteccion-pies': {
        title: 'Protección de Pies',
        icon: 'fas fa-shoe-prints',
        description: 'Calzado de seguridad industrial',
        products: [
          {
            image: 'pies/1.jpg',
            name: 'Botas Punta Acero',
            description: 'Máxima protección',
            specs: [
              { icon: 'fas fa-hard-hat', text: 'Punta acero' },
              { icon: 'fas fa-shield', text: 'Resistente' }
            ]
          },
          {
            image: 'pies/2.jpg',
            name: 'Zapatos Antideslizantes',
            description: 'Suela anti-slip',
            specs: [
              { icon: 'fas fa-grip-lines', text: 'Anti-slip' },
              { icon: 'fas fa-walking', text: 'Estabilidad' }
            ]
          },
          {
            image: 'pies/3.jpg',
            name: 'Botas Dieléctricas',
            description: 'Aislantes eléctricas',
            specs: [
              { icon: 'fas fa-bolt', text: 'Dieléctrico' },
              { icon: 'fas fa-zap', text: 'Anti-eléctrico' }
            ]
          },
          {
            image: 'pies/4.jpg',
            name: 'Botas Químicas',
            description: 'Resistentes a químicos',
            specs: [
              { icon: 'fas fa-flask', text: 'Anti-químico' },
              { icon: 'fas fa-droplet', text: 'Impermeable' }
            ]
          },
          {
            image: 'pies/5.jpg',
            name: 'Calzado Ligero',
            description: 'Cómodo y seguro',
            specs: [
              { icon: 'fas fa-feather', text: 'Ligero' },
              { icon: 'fas fa-heart', text: 'Cómodo' }
            ]
          },
          {
            image: 'pies/6.jpg',
            name: 'Botas Soldador',
            description: 'Para trabajos de soldadura',
            specs: [
              { icon: 'fas fa-fire', text: 'Anti-chispa' },
              { icon: 'fas fa-tools', text: 'Soldadura' }
            ]
          },
          {
            image: 'pies/7.jpg',
            name: 'Zapatos Deportivos',
            description: 'Estilo casual seguro',
            specs: [
              { icon: 'fas fa-running', text: 'Deportivo' },
              { icon: 'fas fa-shield-alt', text: 'Seguridad' }
            ]
          },
          {
            image: 'pies/8.jpg',
            name: 'Botas Altas',
            description: 'Protección extendida',
            specs: [
              { icon: 'fas fa-arrow-up', text: 'Alta protección' },
              { icon: 'fas fa-mountain', text: 'Resistente' }
            ]
          },
          {
            image: 'pies/9.jpg',
            name: 'Calzado Térmico',
            description: 'Para ambientes extremos',
            specs: [
              { icon: 'fas fa-thermometer', text: 'Térmico' },
              { icon: 'fas fa-snowflake', text: 'Aislante' }
            ]
          },
          {
            image: 'pies/10.jpg',
            name: 'Kit Calzado',
            description: 'Opciones variadas',
            specs: [
              { icon: 'fas fa-box', text: 'Variedad' },
              { icon: 'fas fa-check-circle', text: 'Completo' }
            ]
          }
        ]
      },
            'equipos-rescate': {
        title: 'Equipos de Rescate',
        icon: 'fas fa-life-ring',
        description: 'Equipos para emergencias y rescate',
        products: [
          {
            image: 'rescate/1.jpg',
            name: 'Arnés Completo',
            description: 'Para trabajo en altura',
            specs: [
              { icon: 'fas fa-mountain', text: 'Altura' },
              { icon: 'fas fa-shield', text: 'Seguro' }
            ]
          },
          {
            image: 'rescate/2.jpg',
            name: 'Cuerda de Rescate',
            description: 'Alta resistencia',
            specs: [
              { icon: 'fas fa-rope', text: 'Resistente' },
              { icon: 'fas fa-weight', text: '300kg' }
            ]
          },
          {
            image: 'rescate/3.jpg',
            name: 'Equipo Respiración',
            description: 'Aire autónomo',
            specs: [
              { icon: 'fas fa-lungs', text: 'Respiración' },
              { icon: 'fas fa-clock', text: '60 min' }
            ]
          },
          {
            image: 'rescate/4.jpg',
            name: 'Camilla Rescate',
            description: 'Transporte de emergencia',
            specs: [
              { icon: 'fas fa-procedures', text: 'Camilla' },
              { icon: 'fas fa-ambulance', text: 'Rescate' }
            ]
          },
          {
            image: 'rescate/5.jpg',
            name: 'Kit Primeros Auxilios',
            description: 'Emergencias médicas',
            specs: [
              { icon: 'fas fa-first-aid', text: 'Primeros auxilios' },
              { icon: 'fas fa-heartbeat', text: 'Médico' }
            ]
          },
          {
            image: 'rescate/6.jpg',
            name: 'Linterna Rescate',
            description: 'Iluminación potente',
            specs: [
              { icon: 'fas fa-flashlight', text: 'LED potente' },
              { icon: 'fas fa-battery-full', text: 'Larga duración' }
            ]
          },
          {
            image: 'rescate/7.jpg',
            name: 'Radio Emergencia',
            description: 'Comunicación crítica',
            specs: [
              { icon: 'fas fa-radio', text: 'Radio' },
              { icon: 'fas fa-broadcast-tower', text: 'Emergencia' }
            ]
          },
          {
            image: 'rescate/8.jpg',
            name: 'Manta Térmica',
            description: 'Conservación calor',
            specs: [
              { icon: 'fas fa-thermometer', text: 'Térmica' },
              { icon: 'fas fa-compress', text: 'Compacta' }
            ]
          },
          {
            image: 'rescate/9.jpg',
            name: 'Detector Gases',
            description: 'Monitoreo ambiental',
            specs: [
              { icon: 'fas fa-gas-pump', text: 'Gases' },
              { icon: 'fas fa-exclamation-triangle', text: 'Alerta' }
            ]
          },
          {
            image: 'rescate/10.jpg',
            name: 'Kit Rescate Completo',
            description: 'Todo en uno',
            specs: [
              { icon: 'fas fa-toolbox', text: 'Kit completo' },
              { icon: 'fas fa-life-ring', text: 'Rescate total' }
            ]
          }
        ]
      },
            'senalizacion': {
        title: 'Señalización',
        icon: 'fas fa-sign',
        description: 'Señales y equipos de seguridad visual',
        products: [
          {
            image: 'señalizacion/1.jpg',
            name: 'Señales Prohibición',
            description: 'Indicaciones restrictivas',
            specs: [
              { icon: 'fas fa-ban', text: 'Prohibición' },
              { icon: 'fas fa-eye', text: 'Visible' }
            ]
          },
          {
            image: 'señalizacion/2.jpg',
            name: 'Señales Obligación',
            description: 'Uso obligatorio EPP',
            specs: [
              { icon: 'fas fa-exclamation', text: 'Obligatorio' },
              { icon: 'fas fa-helmet-safety', text: 'EPP' }
            ]
          },
          {
            image: 'señalizacion/3.jpg',
            name: 'Señales Advertencia',
            description: 'Peligros y riesgos',
            specs: [
              { icon: 'fas fa-triangle-exclamation', text: 'Advertencia' },
              { icon: 'fas fa-exclamation-triangle', text: 'Peligro' }
            ]
          },
          {
            image: 'señalizacion/4.jpg',
            name: 'Señales Emergencia',
            description: 'Rutas de evacuación',
            specs: [
              { icon: 'fas fa-running', text: 'Evacuación' },
              { icon: 'fas fa-door-open', text: 'Salida' }
            ]
          },
          {
            image: 'señalizacion/5.jpg',
            name: 'Conos Tráfico',
            description: 'Delimitación vial',
            specs: [
              { icon: 'fas fa-traffic-light', text: 'Tráfico' },
              { icon: 'fas fa-road', text: 'Vial' }
            ]
          },
          {
            image: 'señalizacion/6.jpg',
            name: 'Cintas Delimitación',
            description: 'Áreas restringidas',
            specs: [
              { icon: 'fas fa-tape', text: 'Delimitación' },
              { icon: 'fas fa-border-style', text: 'Perímetro' }
            ]
          },
          {
            image: 'señalizacion/7.jpg',
            name: 'Señales Luminosas',
            description: 'Iluminación de seguridad',
            specs: [
              { icon: 'fas fa-lightbulb', text: 'Luminosa' },
              { icon: 'fas fa-power-off', text: 'LED' }
            ]
          },
          {
            image: 'señalizacion/8.jpg',
            name: 'Espejos Seguridad',
            description: 'Visibilidad en esquinas',
            specs: [
              { icon: 'fas fa-mirror', text: 'Espejo' },
              { icon: 'fas fa-eye', text: 'Visibilidad' }
            ]
          },
          {
            image: 'señalizacion/9.jpg',
            name: 'Carteles Personalizados',
            description: 'Mensajes específicos',
            specs: [
              { icon: 'fas fa-edit', text: 'Personalizado' },
              { icon: 'fas fa-comment', text: 'Mensaje' }
            ]
          },
          {
            image: 'señalizacion/10.jpg',
            name: 'Kit Señalización',
            description: 'Conjunto completo',
            specs: [
              { icon: 'fas fa-box', text: 'Kit completo' },
              { icon: 'fas fa-signs-post', text: 'Variado' }
            ]
          }
        ]
      }
    };

    // Función para cambiar categoría
    function changeCategory(category) {
      const data = productData[category];
      if (!data) return;

      // Actualizar categorías activas
      document.querySelectorAll('.category-item').forEach(item => {
        item.classList.remove('active');
      });
      document.querySelector(`[data-category="${category}"]`).classList.add('active');

      // Actualizar header de categoría
      const categoryHeader = document.querySelector('.category-header');
      categoryHeader.innerHTML = `
        <h2 class="category-title">
          <i class="${data.icon} category-icon"></i>
          ${data.title}
        </h2>
        <p class="category-description">
          ${data.description}
        </p>
      `;

      // Actualizar productos
      const productsGrid = document.querySelector('.products-grid');
      productsGrid.innerHTML = data.products.map(product => `
        <div class="product-card">
          <div class="product-image">
            <img src="assets/img/productos/${product.image}" alt="${product.name}">
            <div class="product-overlay">
              <button class="product-btn" onclick="goToComparator('${product.name}', '${product.image}', '${category}')">
                <i class="fas fa-balance-scale"></i>
                Comparar Proveedores
              </button>
            </div>
          </div>
          <div class="product-info">
            <h3 class="product-name">${product.name}</h3>
            <p class="product-description">${product.description}</p>
            <div class="product-specs">
              ${product.specs.map(spec => `
                <span class="spec-item">
                  <i class="${spec.icon}"></i>
                  ${spec.text}
                </span>
              `).join('')}
            </div>
          </div>
        </div>
      `).join('');
    }

    // Función para ir al comparador
    function goToComparator(productName, productImage, category) {
      const params = new URLSearchParams({
        product: productName,
        image: productImage,
        category: category
      });
      window.location.href = `comparador.php?${params.toString()}`;
    }

    // Event listeners
    document.addEventListener('DOMContentLoaded', function() {
      // Agregar event listeners a las categorías
      document.querySelectorAll('.category-item').forEach(item => {
        item.addEventListener('click', function() {
          const category = this.getAttribute('data-category');
          changeCategory(category);
        });
      });

      // Agregar animación de entrada
      setTimeout(() => {
        document.querySelector('.products-wrapper').classList.add('loaded');
      }, 100);
    });
  </script>
</body>
</html>
