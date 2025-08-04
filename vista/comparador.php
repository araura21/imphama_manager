<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Comparador de Proveedores - IMPHAMA Manager</title>
  <link rel="stylesheet" href="assets/css/estilos.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<body class="comparator-body">
  <div class="comparator-wrapper">
    
    <!-- Header -->
    <header class="comparator-header">
      <div class="header-content">
        <div class="header-left">
          <button class="back-btn" onclick="history.back()">
            <i class="fas fa-arrow-left"></i>
            Volver a Productos
          </button>
        </div>
        
        <div class="logo-section">
          <img src="assets/img/logo.png" alt="IMPHAMA" class="company-logo">
          <div class="logo-text">
            <h1 class="company-name">IMPHAMA</h1>
            <p class="company-tagline">Comparador de Proveedores</p>
          </div>
        </div>
        
        <div class="header-right">
          <a href="login.php" class="nav-link">
            <i class="fas fa-sign-in-alt"></i>
            Iniciar Sesión
          </a>
        </div>
      </div>
    </header>

    <!-- Product Info Section -->
    <!-- Sección de información del producto -->
    <section class="product-info-section">
      <div class="product-info-content">
        <div class="product-image-container">
          <img id="productImage" src="" alt="Producto">
        </div>
        <div class="product-details">
          <h1 class="product-title" id="productTitle">Cargando producto...</h1>
          <p class="product-category" id="productCategory">Categoría</p>
          <div class="comparison-info">
            <i class="fas fa-info-circle"></i>
            <span>Comparando precios y especificaciones de diferentes proveedores</span>
          </div>
        </div>
      </div>
    </section>

    <!-- Selector de Comparación -->
    <section class="comparison-selector-section">
      <div class="comparison-selector-content">
        <h2 class="compare-title">Comparar proveedores</h2>
        <p class="compare-subtitle">Selecciona hasta 3 proveedores para comparar</p>
        
        <div class="provider-dropdowns">
          <div class="provider-dropdown">
            <select class="provider-select" id="provider1" onchange="updateComparison()">
              <option value="">Seleccionar proveedor 1</option>
            </select>
            <i class="fas fa-chevron-down dropdown-arrow"></i>
          </div>
          
          <div class="provider-dropdown">
            <select class="provider-select" id="provider2" onchange="updateComparison()">
              <option value="">Seleccionar proveedor 2</option>
            </select>
            <i class="fas fa-chevron-down dropdown-arrow"></i>
          </div>
          
          <div class="provider-dropdown">
            <select class="provider-select" id="provider3" onchange="updateComparison()">
              <option value="">Seleccionar proveedor 3</option>
            </select>
            <i class="fas fa-chevron-down dropdown-arrow"></i>
          </div>
        </div>
      </div>
    </section>    <!-- Comparison Section -->
    <main class="comparison-section">
      <div class="comparison-header">
        <h2 class="section-title">
          <i class="fas fa-chart-line"></i>
          Comparación de Proveedores
        </h2>
        <p class="section-description">
          Seleccione las mejores opciones basadas en precio, calidad y características
        </p>
      </div>

      <!-- Comparison Table -->
      <div class="comparison-container">
        <div class="comparison-grid">
          <!-- Los proveedores seleccionados se mostrarán aquí dinámicamente -->
        </div>
      </div>

    </main>

    <!-- Footer -->
    <footer class="comparator-footer">
      <div class="footer-content">
        <div class="footer-info">
          <p>&copy; 2025 IMPHAMA - Seguridad Industrial. Todos los derechos reservados.</p>
        </div>
        <div class="footer-links">
          <a href="productos.php">Productos</a>
          <a href="login.php">Iniciar Sesión</a>
          <a href="registro.php">Registrarse</a>
        </div>
      </div>
    </footer>
  </div>

  <script>
    // Base de datos de proveedores con sus productos disponibles
    const providerDatabase = {
      'techsafe-industrial': {
        name: 'TechSafe Industrial',
        products: {
          'Mascarilla Respiratoria N95': {
            price: 850,
            discount: '15% desc. por volumen',
            shipping: 'Envío gratis',
            features: [
              { icon: 'fas fa-check', text: 'Certificación NIOSH', available: true },
              { icon: 'fas fa-check', text: 'Válvula de exhalación', available: true },
              { icon: 'fas fa-check', text: 'Diseño ergonómico', available: true },
              { icon: 'fas fa-check', text: 'Empaque individual', available: true },
              { icon: 'fas fa-check', text: 'Garantía extendida', available: true }
            ],
            specs: {
              'Durabilidad': '8-12 horas uso continuo',
              'Garantía': '3 años',
              'Colores': 'Blanco, Azul',
              'Material': 'Polipropileno',
              'Tallas': 'S, M, L',
              'Entrega': '24-48 horas'
            }
          },
          'Respirador Media Cara': {
            price: 2450,
            discount: '10% desc. por 5+ unidades',
            shipping: 'Envío gratis',
            features: [
              { icon: 'fas fa-check', text: 'Filtros P100 incluidos', available: true },
              { icon: 'fas fa-check', text: 'Silicona hipoalergénica', available: true },
              { icon: 'fas fa-check', text: 'Sistema de doble filtro', available: true },
              { icon: 'fas fa-check', text: 'Arnés ajustable 4 puntos', available: true },
              { icon: 'fas fa-check', text: 'Mantenimiento fácil', available: true }
            ],
            specs: {
              'Durabilidad': '5+ años con mantenimiento',
              'Garantía': '3 años',
              'Colores': 'Gris, Negro',
              'Material': 'Silicona + TPR',
              'Tallas': 'S, M, L, XL',
              'Entrega': '2-3 días'
            }
          },
          'Guantes Nitrilo': {
            price: 450,
            discount: '20% desc. por caja',
            shipping: 'Envío gratis +$500',
            features: [
              { icon: 'fas fa-check', text: 'Sin polvo', available: true },
              { icon: 'fas fa-check', text: 'Resistente a químicos', available: true },
              { icon: 'fas fa-check', text: 'Textura antideslizante', available: true },
              { icon: 'fas fa-check', text: 'Ambidiestro', available: true },
              { icon: 'fas fa-times', text: 'Biodegradable', available: false }
            ],
            specs: {
              'Durabilidad': 'Uso único',
              'Garantía': '1 año',
              'Colores': 'Azul, Negro, Púrpura',
              'Material': 'Nitrilo sintético',
              'Tallas': 'XS, S, M, L, XL',
              'Entrega': '24-48 horas'
            }
          }
        }
      },
      'safeguard-solutions': {
        name: 'SafeGuard Solutions',
        products: {
          'Mascarilla Respiratoria N95': {
            price: 780,
            discount: '10% desc. por 10+ unidades',
            shipping: 'Envío $50',
            features: [
              { icon: 'fas fa-check', text: 'Certificación NIOSH', available: true },
              { icon: 'fas fa-times', text: 'Válvula de exhalación', available: false },
              { icon: 'fas fa-check', text: 'Diseño ergonómico', available: true },
              { icon: 'fas fa-check', text: 'Empaque individual', available: true },
              { icon: 'fas fa-times', text: 'Garantía extendida', available: false }
            ],
            specs: {
              'Durabilidad': '6-8 horas uso continuo',
              'Garantía': '2 años',
              'Colores': 'Blanco',
              'Material': 'Polipropileno',
              'Tallas': 'M, L',
              'Entrega': '3-5 días'
            }
          },
          'Respirador Media Cara': {
            price: 2200,
            discount: '8% desc. por 3+ unidades',
            shipping: 'Envío $75',
            features: [
              { icon: 'fas fa-check', text: 'Filtros P95 incluidos', available: true },
              { icon: 'fas fa-check', text: 'Silicona hipoalergénica', available: true },
              { icon: 'fas fa-times', text: 'Sistema de doble filtro', available: false },
              { icon: 'fas fa-check', text: 'Arnés ajustable 4 puntos', available: true },
              { icon: 'fas fa-check', text: 'Mantenimiento fácil', available: true }
            ],
            specs: {
              'Durabilidad': '3-4 años con mantenimiento',
              'Garantía': '2 años',
              'Colores': 'Gris',
              'Material': 'Silicona',
              'Tallas': 'S, M, L',
              'Entrega': '3-5 días'
            }
          },
          'Botas Puntera Acero': {
            price: 1850,
            discount: '12% desc. por par',
            shipping: 'Envío gratis',
            features: [
              { icon: 'fas fa-check', text: 'Puntera de acero', available: true },
              { icon: 'fas fa-check', text: 'Suela antideslizante', available: true },
              { icon: 'fas fa-check', text: 'Resistente al agua', available: true },
              { icon: 'fas fa-check', text: 'Plantilla acolchada', available: true },
              { icon: 'fas fa-times', text: 'Tecnología anti-fatiga', available: false }
            ],
            specs: {
              'Durabilidad': '2-3 años uso industrial',
              'Garantía': '1 año',
              'Colores': 'Negro, Café',
              'Material': 'Cuero + Acero',
              'Tallas': '38-46',
              'Entrega': '2-4 días'
            }
          }
        }
      },
      'valueshield-corp': {
        name: 'ValueShield Corp',
        products: {
          'Mascarilla Respiratoria N95': {
            price: 650,
            discount: '25% desc. por 20+ unidades',
            shipping: 'Envío $30',
            features: [
              { icon: 'fas fa-check', text: 'Certificación NIOSH', available: true },
              { icon: 'fas fa-times', text: 'Válvula de exhalación', available: false },
              { icon: 'fas fa-times', text: 'Diseño ergonómico', available: false },
              { icon: 'fas fa-check', text: 'Empaque individual', available: true },
              { icon: 'fas fa-times', text: 'Garantía extendida', available: false }
            ],
            specs: {
              'Durabilidad': '4-6 horas uso continuo',
              'Garantía': '1 año',
              'Colores': 'Blanco',
              'Material': 'Polipropileno básico',
              'Tallas': 'Talla única',
              'Entrega': '5-7 días'
            }
          },
          'Guantes Nitrilo': {
            price: 320,
            discount: '30% desc. por 5+ cajas',
            shipping: 'Envío $25',
            features: [
              { icon: 'fas fa-check', text: 'Sin polvo', available: true },
              { icon: 'fas fa-check', text: 'Resistente a químicos básicos', available: true },
              { icon: 'fas fa-times', text: 'Textura antideslizante', available: false },
              { icon: 'fas fa-check', text: 'Ambidiestro', available: true },
              { icon: 'fas fa-times', text: 'Biodegradable', available: false }
            ],
            specs: {
              'Durabilidad': 'Uso único',
              'Garantía': '6 meses',
              'Colores': 'Azul',
              'Material': 'Nitrilo básico',
              'Tallas': 'S, M, L',
              'Entrega': '5-8 días'
            }
          },
          'Chaleco Reflectivo': {
            price: 280,
            discount: '15% desc. por 10+ unidades',
            shipping: 'Envío $20',
            features: [
              { icon: 'fas fa-check', text: 'Franjas reflectivas', available: true },
              { icon: 'fas fa-check', text: 'Cierre con velcro', available: true },
              { icon: 'fas fa-times', text: 'Bolsillos múltiples', available: false },
              { icon: 'fas fa-check', text: 'Lavable en máquina', available: true },
              { icon: 'fas fa-times', text: 'Tela transpirable', available: false }
            ],
            specs: {
              'Durabilidad': '1-2 años uso regular',
              'Garantía': '6 meses',
              'Colores': 'Amarillo, Naranja',
              'Material': 'Poliéster',
              'Tallas': 'M, L, XL',
              'Entrega': '3-5 días'
            }
          }
        }
      },
      'industrial-pro': {
        name: 'Industrial Pro',
        products: {
          'Respirador Media Cara': {
            price: 2350,
            discount: '12% desc. por 3+ unidades',
            shipping: 'Envío gratis',
            features: [
              { icon: 'fas fa-check', text: 'Filtros P100 premium', available: true },
              { icon: 'fas fa-check', text: 'Silicona médica', available: true },
              { icon: 'fas fa-check', text: 'Sistema triple filtro', available: true },
              { icon: 'fas fa-check', text: 'Arnés ergonómico', available: true },
              { icon: 'fas fa-check', text: 'Kit de limpieza incluido', available: true }
            ],
            specs: {
              'Durabilidad': '4-5 años con mantenimiento',
              'Garantía': '2.5 años',
              'Colores': 'Gris, Azul',
              'Material': 'Silicona médica',
              'Tallas': 'S, M, L, XL',
              'Entrega': '1-2 días'
            }
          },
          'Botas Puntera Acero': {
            price: 2150,
            discount: '8% desc. por par',
            shipping: 'Envío gratis',
            features: [
              { icon: 'fas fa-check', text: 'Puntera reforzada', available: true },
              { icon: 'fas fa-check', text: 'Suela anti-perforación', available: true },
              { icon: 'fas fa-check', text: 'Membrana impermeable', available: true },
              { icon: 'fas fa-check', text: 'Sistema anti-fatiga', available: true },
              { icon: 'fas fa-check', text: 'Certificación ASTM', available: true }
            ],
            specs: {
              'Durabilidad': '3-4 años uso intensivo',
              'Garantía': '2 años',
              'Colores': 'Negro, Café, Gris',
              'Material': 'Cuero premium + Acero',
              'Tallas': '36-48',
              'Entrega': '24-48 horas'
            }
          }
        }
      },
      'safety-express': {
        name: 'Safety Express',
        products: {
          'Guantes Nitrilo': {
            price: 385,
            discount: '18% desc. por 3+ cajas',
            shipping: 'Envío $40',
            features: [
              { icon: 'fas fa-check', text: 'Sin polvo y sin látex', available: true },
              { icon: 'fas fa-check', text: 'Resistente a químicos', available: true },
              { icon: 'fas fa-check', text: 'Superficie texturizada', available: true },
              { icon: 'fas fa-check', text: 'Puños extendidos', available: true },
              { icon: 'fas fa-times', text: 'Biodegradable', available: false }
            ],
            specs: {
              'Durabilidad': 'Uso único',
              'Garantía': '8 meses',
              'Colores': 'Azul, Negro',
              'Material': 'Nitrilo de grado médico',
              'Tallas': 'XS, S, M, L, XL',
              'Entrega': '2-4 días'
            }
          },
          'Chaleco Reflectivo': {
            price: 350,
            discount: '12% desc. por 8+ unidades',
            shipping: 'Envío $35',
            features: [
              { icon: 'fas fa-check', text: 'Franjas 3M Scotchlite', available: true },
              { icon: 'fas fa-check', text: 'Cierre frontal reforzado', available: true },
              { icon: 'fas fa-check', text: 'Bolsillos laterales', available: true },
              { icon: 'fas fa-check', text: 'Tela respirable', available: true },
              { icon: 'fas fa-check', text: 'Certificación ANSI', available: true }
            ],
            specs: {
              'Durabilidad': '2-3 años uso industrial',
              'Garantía': '1 año',
              'Colores': 'Amarillo, Naranja, Verde',
              'Material': 'Poliéster mesh',
              'Tallas': 'S, M, L, XL, XXL',
              'Entrega': '1-3 días'
            }
          }
        }
      },
      'pro-safety-gear': {
        name: 'Pro Safety Gear',
        products: {
          'Botas Puntera Acero': {
            price: 1950,
            discount: '10% desc. por 2+ pares',
            shipping: 'Envío gratis +$1500',
            features: [
              { icon: 'fas fa-check', text: 'Puntera composite', available: true },
              { icon: 'fas fa-check', text: 'Suela Vibram', available: true },
              { icon: 'fas fa-check', text: 'Aislamiento térmico', available: true },
              { icon: 'fas fa-check', text: 'Plantilla EVA', available: true },
              { icon: 'fas fa-check', text: 'Resistente a hidrocarburos', available: true }
            ],
            specs: {
              'Durabilidad': '2.5-3.5 años uso pesado',
              'Garantía': '18 meses',
              'Colores': 'Negro, Café oscuro',
              'Material': 'Cuero nobuck + Composite',
              'Tallas': '37-47',
              'Entrega': '2-5 días'
            }
          },
          'Chaleco Reflectivo': {
            price: 420,
            discount: '15% desc. por 6+ unidades',
            shipping: 'Envío $45',
            features: [
              { icon: 'fas fa-check', text: 'Cinta reflectiva de lujo', available: true },
              { icon: 'fas fa-check', text: 'Cremallera YKK', available: true },
              { icon: 'fas fa-check', text: 'Múltiples bolsillos', available: true },
              { icon: 'fas fa-check', text: 'Mesh transpirable', available: true },
              { icon: 'fas fa-check', text: 'Refuerzos en costuras', available: true }
            ],
            specs: {
              'Durabilidad': '3-4 años uso profesional',
              'Garantía': '2 años',
              'Colores': 'Amarillo, Naranja, Lime',
              'Material': 'Poliéster premium + Mesh',
              'Tallas': 'XS, S, M, L, XL, XXL',
              'Entrega': '1-4 días'
            }
          }
        }
      },
      'maxguard-systems': {
        name: 'MaxGuard Systems',
        products: {
          'Mascarilla Respiratoria N95': {
            price: 720,
            discount: '20% desc. por 15+ unidades',
            shipping: 'Envío $40',
            features: [
              { icon: 'fas fa-check', text: 'Certificación FDA', available: true },
              { icon: 'fas fa-check', text: 'Filtración superior', available: true },
              { icon: 'fas fa-times', text: 'Válvula de exhalación', available: false },
              { icon: 'fas fa-check', text: 'Banda elástica reforzada', available: true },
              { icon: 'fas fa-check', text: 'Empaque estéril', available: true }
            ],
            specs: {
              'Durabilidad': '8-10 horas uso continuo',
              'Garantía': '1.5 años',
              'Colores': 'Blanco, Azul claro',
              'Material': 'Polipropileno premium',
              'Tallas': 'S, M, L',
              'Entrega': '2-4 días'
            }
          },
          'Guantes Nitrilo': {
            price: 350,
            discount: '22% desc. por 4+ cajas',
            shipping: 'Envío $30',
            features: [
              { icon: 'fas fa-check', text: 'Sin polvo y sin látex', available: true },
              { icon: 'fas fa-check', text: 'Extra resistente', available: true },
              { icon: 'fas fa-check', text: 'Superficie rugosa', available: true },
              { icon: 'fas fa-check', text: 'Puños largos', available: true },
              { icon: 'fas fa-check', text: 'Aprobación médica', available: true }
            ],
            specs: {
              'Durabilidad': 'Uso único premium',
              'Garantía': '10 meses',
              'Colores': 'Azul, Negro, Púrpura',
              'Material': 'Nitrilo sintético',
              'Tallas': 'XS, S, M, L, XL',
              'Entrega': '1-3 días'
            }
          }
        }
      },
      'elite-protection': {
        name: 'Elite Protection',
        products: {
          'Respirador Media Cara': {
            price: 2450,
            discount: '15% desc. por 2+ unidades',
            shipping: 'Envío gratis',
            features: [
              { icon: 'fas fa-check', text: 'Filtros HEPA incluidos', available: true },
              { icon: 'fas fa-check', text: 'Silicona ultra suave', available: true },
              { icon: 'fas fa-check', text: 'Sistema dual filtro', available: true },
              { icon: 'fas fa-check', text: 'Arnés premium 6 puntos', available: true },
              { icon: 'fas fa-check', text: 'Estuche de almacenamiento', available: true }
            ],
            specs: {
              'Durabilidad': '5-6 años profesional',
              'Garantía': '3 años',
              'Colores': 'Negro, Gris metalizado',
              'Material': 'Silicona médica premium',
              'Tallas': 'XS, S, M, L, XL',
              'Entrega': '24-48 horas'
            }
          },
          'Botas Puntera Acero': {
            price: 2300,
            discount: '10% desc. por par',
            shipping: 'Envío gratis',
            features: [
              { icon: 'fas fa-check', text: 'Puntera titanio-acero', available: true },
              { icon: 'fas fa-check', text: 'Suela Kevlar', available: true },
              { icon: 'fas fa-check', text: 'Membrana Gore-Tex', available: true },
              { icon: 'fas fa-check', text: 'Sistema amortiguación', available: true },
              { icon: 'fas fa-check', text: 'Certificación militar', available: true }
            ],
            specs: {
              'Durabilidad': '4-5 años uso extremo',
              'Garantía': '3 años',
              'Colores': 'Negro, Café militar',
              'Material': 'Cuero militar + Titanio',
              'Tallas': '35-49',
              'Entrega': '12-24 horas'
            }
          }
        }
      },
      'securetech-mx': {
        name: 'SecureTech MX',
        products: {
          'Chaleco Reflectivo': {
            price: 390,
            discount: '18% desc. por 6+ unidades',
            shipping: 'Envío $25',
            features: [
              { icon: 'fas fa-check', text: 'Cinta reflectiva 360°', available: true },
              { icon: 'fas fa-check', text: 'Cierre magnético', available: true },
              { icon: 'fas fa-check', text: 'Bolsillos con zipper', available: true },
              { icon: 'fas fa-check', text: 'Tela antibacterial', available: true },
              { icon: 'fas fa-check', text: 'Certificación internacional', available: true }
            ],
            specs: {
              'Durabilidad': '3-4 años uso intensivo',
              'Garantía': '1.5 años',
              'Colores': 'Amarillo, Naranja, Verde lima',
              'Material': 'Poliéster técnico + Mesh',
              'Tallas': 'XS, S, M, L, XL, XXL, XXXL',
              'Entrega': '1-2 días'
            }
          },
          'Guantes Nitrilo': {
            price: 295,
            discount: '25% desc. por 6+ cajas',
            shipping: 'Envío $20',
            features: [
              { icon: 'fas fa-check', text: 'Libre de alergenos', available: true },
              { icon: 'fas fa-check', text: 'Resistencia química básica', available: true },
              { icon: 'fas fa-times', text: 'Superficie texturizada', available: false },
              { icon: 'fas fa-check', text: 'Biodegradable', available: true },
              { icon: 'fas fa-check', text: 'Certificación ecológica', available: true }
            ],
            specs: {
              'Durabilidad': 'Uso único ecológico',
              'Garantía': '6 meses',
              'Colores': 'Verde, Azul',
              'Material': 'Nitrilo biodegradable',
              'Tallas': 'S, M, L, XL',
              'Entrega': '4-6 días'
            }
          }
        }
      },
      'omega-safety': {
        name: 'Omega Safety',
        products: {
          'Mascarilla Desechable': {
            price: 180,
            discount: '30% desc. por 50+ unidades',
            shipping: 'Envío $15',
            features: [
              { icon: 'fas fa-check', text: 'Certificación básica', available: true },
              { icon: 'fas fa-times', text: 'Filtración avanzada', available: false },
              { icon: 'fas fa-times', text: 'Válvula respiratoria', available: false },
              { icon: 'fas fa-check', text: 'Banda cómoda', available: true },
              { icon: 'fas fa-check', text: 'Precio económico', available: true }
            ],
            specs: {
              'Durabilidad': '2-4 horas uso básico',
              'Garantía': '6 meses',
              'Colores': 'Blanco',
              'Material': 'Polipropileno estándar',
              'Tallas': 'Única',
              'Entrega': '7-10 días'
            }
          },
          'Botas Puntera Acero': {
            price: 1650,
            discount: '15% desc. por 2+ pares',
            shipping: 'Envío $60',
            features: [
              { icon: 'fas fa-check', text: 'Puntera acero estándar', available: true },
              { icon: 'fas fa-check', text: 'Suela antideslizante básica', available: true },
              { icon: 'fas fa-times', text: 'Resistente al agua', available: false },
              { icon: 'fas fa-check', text: 'Plantilla básica', available: true },
              { icon: 'fas fa-times', text: 'Tecnología avanzada', available: false }
            ],
            specs: {
              'Durabilidad': '1.5-2 años uso regular',
              'Garantía': '8 meses',
              'Colores': 'Negro',
              'Material': 'Cuero sintético + Acero',
              'Tallas': '39-45',
              'Entrega': '5-8 días'
            }
          }
        }
      }
    };

    let selectedProviders = [];
    let currentProduct = '';

    // Función para cargar proveedores en los dropdowns
    function loadProviderDropdowns(productName) {
      const dropdowns = ['provider1', 'provider2', 'provider3'];
      
      dropdowns.forEach(dropdownId => {
        const dropdown = document.getElementById(dropdownId);
        dropdown.innerHTML = '<option value="">Seleccionar proveedor</option>';
        
        Object.keys(providerDatabase).forEach(providerId => {
          const provider = providerDatabase[providerId];
          const hasProduct = provider.products[productName] !== undefined;
          
          if (hasProduct) {
            const option = document.createElement('option');
            option.value = providerId;
            option.textContent = provider.name;
            dropdown.appendChild(option);
          }
        });
      });
    }

    // Función para actualizar la comparación
    function updateComparison() {
      selectedProviders = [];
      
      // Obtener proveedores seleccionados de los dropdowns
      ['provider1', 'provider2', 'provider3'].forEach(dropdownId => {
        const dropdown = document.getElementById(dropdownId);
        if (dropdown && dropdown.value) {
          selectedProviders.push(dropdown.value);
        }
      });

      const comparisonGrid = document.querySelector('.comparison-grid');
      comparisonGrid.innerHTML = '';

      if (selectedProviders.length === 0) {
        comparisonGrid.innerHTML = `
          <div class="no-providers-message">
            <i class="fas fa-info-circle"></i>
            <h3>Selecciona proveedores para comparar</h3>
            <p>Utiliza los menús desplegables de arriba para seleccionar proveedores</p>
          </div>
        `;
        return;
      }

      selectedProviders.forEach(providerId => {
        const provider = providerDatabase[providerId];
        const product = provider.products[currentProduct];
        
        const providerCard = document.createElement('div');
        providerCard.className = 'provider-card';
        providerCard.innerHTML = `
          <div class="provider-header">
            <div class="provider-info">
              <h3 class="provider-name">${provider.name}</h3>
            </div>
          </div>

          <div class="price-section">
            <div class="price-main">
              <span class="currency">$</span>
              <span class="amount">${product.price}</span>
            </div>
          </div>

          <div class="features-section">
            <h4 class="features-title">Características</h4>
            <ul class="features-list">
              ${product.features.map(feature => `
                <li class="feature-item">
                  <i class="${feature.icon}"></i>
                  <span>${feature.text}</span>
                </li>
              `).join('')}
            </ul>
          </div>

          <div class="specs-section">
            <h4 class="specs-title">Especificaciones</h4>
            <div class="specs-grid">
              ${Object.entries(product.specs).map(([key, value]) => `
                <div class="spec-item">
                  <span class="spec-label">${key}:</span>
                  <span class="spec-value">${value}</span>
                </div>
              `).join('')}
            </div>
          </div>

          <div class="action-section">
            <button class="select-btn" onclick="selectProvider('${providerId}')">
              <i class="fas fa-check"></i>
              Seleccionar Proveedor
            </button>
            <button class="contact-btn" onclick="contactProvider('${providerId}')">
              <i class="fas fa-phone"></i>
              Contactar
            </button>
          </div>
        `;
        
        comparisonGrid.appendChild(providerCard);
      });
    }

    // Función para manejar selección de proveedor
    function selectProvider(providerId) {
      const provider = providerDatabase[providerId];
      alert(`Has seleccionado ${provider.name}. Se agregará a tu cotización.`);
    }

    // Función para contactar proveedor
    function contactProvider(providerId) {
      const provider = providerDatabase[providerId];
      alert(`Contactando a ${provider.name}...`);
    }

    // Función principal de inicialización
    document.addEventListener('DOMContentLoaded', function() {
      // Obtener parámetros de la URL
      const urlParams = new URLSearchParams(window.location.search);
      currentProduct = urlParams.get('product') || 'Producto no especificado';
      const productImage = urlParams.get('image') || 'default.jpg';
      const productCategory = urlParams.get('category') || 'general';

      // Actualizar información del producto
      document.getElementById('productTitle').textContent = currentProduct;
      document.getElementById('productImage').src = `assets/img/productos/${productImage}`;
      document.getElementById('productCategory').textContent = productCategory.replace('-', ' ').replace(/\b\w/g, l => l.toUpperCase());

      // Cargar proveedores en los dropdowns
      loadProviderDropdowns(currentProduct);

      // Agregar event listeners a los dropdowns
      ['provider1', 'provider2', 'provider3'].forEach(dropdownId => {
        const dropdown = document.getElementById(dropdownId);
        if (dropdown) {
          dropdown.addEventListener('change', updateComparison);
        }
      });

      // Animación de entrada
      setTimeout(() => {
        document.querySelector('.comparator-wrapper').classList.add('loaded');
      }, 100);
    });

    // Función para volver a productos
    function goBack() {
      window.location.href = 'productos.php';
    }
  </script>
</body>
</html>
