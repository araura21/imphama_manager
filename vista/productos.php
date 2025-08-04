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
            image: 'pro1.png',
            name: 'Mascarilla Respiratoria N95',
            description: 'Protección contra partículas y aerosoles',
            specs: [
              { icon: 'fas fa-shield-alt', text: 'Certificada' },
              { icon: 'fas fa-star', text: 'Premium' }
            ]
          },
          {
            image: 'pro2.jpg',
            name: 'Respirador Media Cara',
            description: 'Con filtros intercambiables P100',
            specs: [
              { icon: 'fas fa-shield-alt', text: 'Reutilizable' },
              { icon: 'fas fa-cog', text: 'Ajustable' }
            ]
          },
          {
            image: 'pro3.jpg',
            name: 'Mascarilla Desechable',
            description: 'Protección básica contra polvo',
            specs: [
              { icon: 'fas fa-recycle', text: 'Desechable' },
              { icon: 'fas fa-dollar-sign', text: 'Económica' }
            ]
          },
          {
            image: 'pro4.jpg',
            name: 'Respirador Cara Completa',
            description: 'Máxima protección respiratoria y visual',
            specs: [
              { icon: 'fas fa-shield-alt', text: 'Máxima Protección' },
              { icon: 'fas fa-eye', text: 'Visual + Respiratoria' }
            ]
          },
          {
            image: 'pro5.jpg',
            name: 'Filtros P100',
            description: 'Filtros de alta eficiencia',
            specs: [
              { icon: 'fas fa-filter', text: '99.97% Eficiencia' },
              { icon: 'fas fa-sync-alt', text: 'Reemplazable' }
            ]
          },
          {
            image: 'pro6.png',
            name: 'Equipo Autónomo',
            description: 'Respiración autónoma para espacios confinados',
            specs: [
              { icon: 'fas fa-air-freshener', text: 'Aire Limpio' },
              { icon: 'fas fa-clock', text: '4 Horas' }
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
            image: 'pro7.png',
            name: 'Gafas de Seguridad',
            description: 'Protección contra impactos y salpicaduras',
            specs: [
              { icon: 'fas fa-shield-alt', text: 'Anti-impacto' },
              { icon: 'fas fa-tint', text: 'Anti-salpicaduras' }
            ]
          },
          {
            image: 'pro8.png',
            name: 'Careta Facial',
            description: 'Protección completa del rostro',
            specs: [
              { icon: 'fas fa-face-grin-wide', text: 'Cara Completa' },
              { icon: 'fas fa-adjust', text: 'Anti-reflejo' }
            ]
          },
          {
            image: 'pro1.png',
            name: 'Gafas Anti-químicos',
            description: 'Resistente a químicos corrosivos',
            specs: [
              { icon: 'fas fa-flask', text: 'Anti-químicos' },
              { icon: 'fas fa-lock', text: 'Sellado hermético' }
            ]
          },
          {
            image: 'pro2.jpg',
            name: 'Pantalla Soldadura',
            description: 'Protección UV para soldadores',
            specs: [
              { icon: 'fas fa-fire', text: 'Anti-UV' },
              { icon: 'fas fa-tools', text: 'Para soldadura' }
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
            image: 'pro3.jpg',
            name: 'Tapones Auditivos',
            description: 'Protección básica contra ruido',
            specs: [
              { icon: 'fas fa-volume-mute', text: '25dB Reducción' },
              { icon: 'fas fa-leaf', text: 'Cómodos' }
            ]
          },
          {
            image: 'pro4.jpg',
            name: 'Orejeras Industriales',
            description: 'Máxima reducción de ruido',
            specs: [
              { icon: 'fas fa-volume-off', text: '35dB Reducción' },
              { icon: 'fas fa-cog', text: 'Ajustables' }
            ]
          },
          {
            image: 'pro5.jpg',
            name: 'Protección Electrónica',
            description: 'Con amplificación selectiva',
            specs: [
              { icon: 'fas fa-microchip', text: 'Electrónica' },
              { icon: 'fas fa-volume-up', text: 'Amplificación' }
            ]
          }
        ]
      },
      'proteccion-corporal': {
        title: 'Protección Corporal',
        icon: 'fas fa-vest',
        description: 'Ropa y equipos de protección para el cuerpo',
        products: [
          {
            image: 'pro6.png',
            name: 'Chaleco Reflectivo',
            description: 'Alta visibilidad en ambientes industriales',
            specs: [
              { icon: 'fas fa-eye', text: 'Alta Visibilidad' },
              { icon: 'fas fa-moon', text: 'Día y Noche' }
            ]
          },
          {
            image: 'pro7.png',
            name: 'Overol Químico',
            description: 'Protección contra químicos peligrosos',
            specs: [
              { icon: 'fas fa-flask', text: 'Anti-químicos' },
              { icon: 'fas fa-shield-alt', text: 'Cuerpo Completo' }
            ]
          },
          {
            image: 'pro8.png',
            name: 'Arnés de Seguridad',
            description: 'Para trabajos en altura',
            specs: [
              { icon: 'fas fa-anchor', text: 'Anticaídas' },
              { icon: 'fas fa-mountain', text: 'Trabajos en Altura' }
            ]
          }
        ]
      },
      'proteccion-manos': {
        title: 'Protección de Manos',
        icon: 'fas fa-hand-paper',
        description: 'Guantes especializados para diferentes industrias',
        products: [
          {
            image: 'pro1.png',
            name: 'Guantes Nitrilo',
            description: 'Resistente a químicos y cortes',
            specs: [
              { icon: 'fas fa-cut', text: 'Anti-cortes' },
              { icon: 'fas fa-flask', text: 'Anti-químicos' }
            ]
          },
          {
            image: 'pro2.jpg',
            name: 'Guantes Soldadura',
            description: 'Protección térmica para soldadores',
            specs: [
              { icon: 'fas fa-fire', text: 'Anti-calor' },
              { icon: 'fas fa-tools', text: 'Soldadura' }
            ]
          },
          {
            image: 'pro3.jpg',
            name: 'Guantes Eléctricos',
            description: 'Aislamiento eléctrico garantizado',
            specs: [
              { icon: 'fas fa-bolt', text: 'Aislante' },
              { icon: 'fas fa-plug', text: 'Eléctrico' }
            ]
          }
        ]
      },
      'proteccion-pies': {
        title: 'Protección de Pies',
        icon: 'fas fa-shoe-prints',
        description: 'Calzado de seguridad para entornos industriales',
        products: [
          {
            image: 'pro4.jpg',
            name: 'Botas Puntera Acero',
            description: 'Protección contra impactos pesados',
            specs: [
              { icon: 'fas fa-weight-hanging', text: 'Puntera Acero' },
              { icon: 'fas fa-shield-alt', text: 'Anti-impacto' }
            ]
          },
          {
            image: 'pro5.jpg',
            name: 'Botas Dieléctricas',
            description: 'Aislamiento eléctrico completo',
            specs: [
              { icon: 'fas fa-bolt', text: 'Dieléctricas' },
              { icon: 'fas fa-shield-alt', text: 'Seguridad Eléctrica' }
            ]
          },
          {
            image: 'pro6.png',
            name: 'Botas Químicas',
            description: 'Resistente a químicos corrosivos',
            specs: [
              { icon: 'fas fa-flask', text: 'Anti-químicos' },
              { icon: 'fas fa-tint', text: 'Impermeables' }
            ]
          }
        ]
      },
      'equipos-rescate': {
        title: 'Equipos de Rescate',
        icon: 'fas fa-first-aid',
        description: 'Equipos especializados para emergencias y rescate',
        products: [
          {
            image: 'pro7.png',
            name: 'Kit Primeros Auxilios',
            description: 'Completo kit de emergencias médicas',
            specs: [
              { icon: 'fas fa-medkit', text: 'Primeros Auxilios' },
              { icon: 'fas fa-clock', text: 'Emergencias' }
            ]
          },
          {
            image: 'pro8.png',
            name: 'Camilla Rígida',
            description: 'Transporte seguro de lesionados',
            specs: [
              { icon: 'fas fa-procedures', text: 'Transporte' },
              { icon: 'fas fa-shield-alt', text: 'Rígida' }
            ]
          },
          {
            image: 'pro1.png',
            name: 'Equipo Respiración',
            description: 'Para rescate en espacios confinados',
            specs: [
              { icon: 'fas fa-air-freshener', text: 'Aire Limpio' },
              { icon: 'fas fa-life-ring', text: 'Rescate' }
            ]
          }
        ]
      },
      'senalizacion': {
        title: 'Señalización',
        icon: 'fas fa-exclamation-triangle',
        description: 'Sistemas de señalización y advertencia industrial',
        products: [
          {
            image: 'pro2.jpg',
            name: 'Señales Reflectivas',
            description: 'Señalización de alta visibilidad',
            specs: [
              { icon: 'fas fa-eye', text: 'Alta Visibilidad' },
              { icon: 'fas fa-sun', text: 'Reflectivas' }
            ]
          },
          {
            image: 'pro3.jpg',
            name: 'Conos de Seguridad',
            description: 'Delimitación de áreas peligrosas',
            specs: [
              { icon: 'fas fa-exclamation-triangle', text: 'Advertencia' },
              { icon: 'fas fa-road', text: 'Delimitación' }
            ]
          },
          {
            image: 'pro4.jpg',
            name: 'Cintas de Barrera',
            description: 'Restricción de acceso temporal',
            specs: [
              { icon: 'fas fa-ban', text: 'Restricción' },
              { icon: 'fas fa-tape', text: 'Temporal' }
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
