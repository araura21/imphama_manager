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
        <h2 class="compare-title">Selecciona los proveedores a comparar</h2>
        <p class="compare-subtitle">Haz clic en las tarjetas para seleccionar hasta 3 proveedores</p>
        
        <div class="providers-grid" id="providersGrid">
          <!-- Las tarjetas de proveedores se generarán dinámicamente aquí -->
        </div>
        
        <div class="selected-count">
          <span id="selectedCount">0</span> de 3 proveedores seleccionados
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
          },
          'Gafas de Seguridad': {
            price: 320,
            discount: '12% desc. por 10+ unidades',
            shipping: 'Envío gratis',
            features: [
              { icon: 'fas fa-check', text: 'Lentes policarbonato', available: true },
              { icon: 'fas fa-check', text: 'Anti-rayadura', available: true },
              { icon: 'fas fa-check', text: 'Anti-empañamiento', available: true },
              { icon: 'fas fa-check', text: 'Protección UV', available: true },
              { icon: 'fas fa-check', text: 'Marcos ajustables', available: true }
            ],
            specs: {
              'Durabilidad': '2-3 años uso regular',
              'Garantía': '2 años',
              'Colores': 'Transparente, Gris',
              'Material': 'Policarbonato',
              'Tallas': 'Ajustable',
              'Entrega': '1-2 días'
            }
          },
          'Tapones Auditivos': {
            price: 180,
            discount: '25% desc. por 100+ unidades',
            shipping: 'Envío gratis',
            features: [
              { icon: 'fas fa-check', text: '32dB reducción', available: true },
              { icon: 'fas fa-check', text: 'Espuma suave', available: true },
              { icon: 'fas fa-check', text: 'Hipoalergénicos', available: true },
              { icon: 'fas fa-check', text: 'Desechables', available: true },
              { icon: 'fas fa-check', text: 'Empaque individual', available: true }
            ],
            specs: {
              'Durabilidad': 'Uso único',
              'Garantía': '1 año',
              'Colores': 'Naranja, Amarillo',
              'Material': 'Espuma PU',
              'Tallas': 'Única',
              'Entrega': '1-3 días'
            }
          },
          'Botas Punta Acero': {
            price: 1850,
            discount: '8% desc. por par',
            shipping: 'Envío gratis',
            features: [
              { icon: 'fas fa-check', text: 'Puntera de acero', available: true },
              { icon: 'fas fa-check', text: 'Suela antideslizante', available: true },
              { icon: 'fas fa-check', text: 'Resistente al agua', available: true },
              { icon: 'fas fa-check', text: 'Plantilla acolchada', available: true },
              { icon: 'fas fa-check', text: 'Certificación ASTM', available: true }
            ],
            specs: {
              'Durabilidad': '3-4 años uso industrial',
              'Garantía': '2 años',
              'Colores': 'Negro, Café',
              'Material': 'Cuero + Acero',
              'Tallas': '38-46',
              'Entrega': '2-4 días'
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
          'Botas Punta Acero': {
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
          },
          'Gafas de Seguridad': {
            price: 280,
            discount: '15% desc. por 15+ unidades',
            shipping: 'Envío $40',
            features: [
              { icon: 'fas fa-check', text: 'Lentes básicos', available: true },
              { icon: 'fas fa-times', text: 'Anti-rayadura', available: false },
              { icon: 'fas fa-check', text: 'Protección básica', available: true },
              { icon: 'fas fa-check', text: 'Marcos resistentes', available: true },
              { icon: 'fas fa-times', text: 'Anti-empañamiento', available: false }
            ],
            specs: {
              'Durabilidad': '1-2 años uso regular',
              'Garantía': '1 año',
              'Colores': 'Transparente',
              'Material': 'Plástico',
              'Tallas': 'Única',
              'Entrega': '3-5 días'
            }
          },
          'Tapones Auditivos': {
            price: 150,
            discount: '20% desc. por 50+ unidades',
            shipping: 'Envío $30',
            features: [
              { icon: 'fas fa-check', text: '28dB reducción', available: true },
              { icon: 'fas fa-check', text: 'Espuma básica', available: true },
              { icon: 'fas fa-check', text: 'Económicos', available: true },
              { icon: 'fas fa-times', text: 'Empaque individual', available: false },
              { icon: 'fas fa-check', text: 'A granel', available: true }
            ],
            specs: {
              'Durabilidad': 'Uso único',
              'Garantía': '6 meses',
              'Colores': 'Naranja',
              'Material': 'Espuma estándar',
              'Tallas': 'Única',
              'Entrega': '3-7 días'
            }
          },
          'Traje Tyvek': {
            price: 850,
            discount: '18% desc. por 10+ unidades',
            shipping: 'Envío $60',
            features: [
              { icon: 'fas fa-check', text: 'Material Tyvek', available: true },
              { icon: 'fas fa-check', text: 'Protección química', available: true },
              { icon: 'fas fa-check', text: 'Transpirable', available: true },
              { icon: 'fas fa-check', text: 'Cremallera frontal', available: true },
              { icon: 'fas fa-times', text: 'Capucha integrada', available: false }
            ],
            specs: {
              'Durabilidad': 'Uso único',
              'Garantía': '1 año',
              'Colores': 'Blanco',
              'Material': 'Tyvek DuPont',
              'Tallas': 'M, L, XL',
              'Entrega': '2-5 días'
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
          },
          'Mascarilla Desechable': {
            price: 120,
            discount: '40% desc. por 100+ unidades',
            shipping: 'Envío $15',
            features: [
              { icon: 'fas fa-check', text: 'Protección básica', available: true },
              { icon: 'fas fa-times', text: 'Certificación avanzada', available: false },
              { icon: 'fas fa-check', text: 'Precio económico', available: true },
              { icon: 'fas fa-check', text: 'Uso único', available: true },
              { icon: 'fas fa-times', text: 'Filtración premium', available: false }
            ],
            specs: {
              'Durabilidad': '2-4 horas uso básico',
              'Garantía': '3 meses',
              'Colores': 'Blanco',
              'Material': 'Polipropileno estándar',
              'Tallas': 'Única',
              'Entrega': '7-10 días'
            }
          },
          'Orejeras Industriales': {
            price: 450,
            discount: '20% desc. por 6+ unidades',
            shipping: 'Envío $25',
            features: [
              { icon: 'fas fa-check', text: '30dB reducción', available: true },
              { icon: 'fas fa-check', text: 'Almohadillas suaves', available: true },
              { icon: 'fas fa-times', text: 'Ajuste premium', available: false },
              { icon: 'fas fa-check', text: 'Banda ajustable', available: true },
              { icon: 'fas fa-times', text: 'Electrónica', available: false }
            ],
            specs: {
              'Durabilidad': '2-3 años uso regular',
              'Garantía': '1 año',
              'Colores': 'Amarillo, Rojo',
              'Material': 'Plástico ABS',
              'Tallas': 'Ajustable',
              'Entrega': '4-6 días'
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
          'Botas Punta Acero': {
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
          },
          'Careta Facial': {
            price: 680,
            discount: '10% desc. por 5+ unidades',
            shipping: 'Envío gratis',
            features: [
              { icon: 'fas fa-check', text: 'Visor anti-impacto', available: true },
              { icon: 'fas fa-check', text: 'Anti-empañamiento', available: true },
              { icon: 'fas fa-check', text: 'Banda ajustable', available: true },
              { icon: 'fas fa-check', text: 'Protección total', available: true },
              { icon: 'fas fa-check', text: 'Reemplazos disponibles', available: true }
            ],
            specs: {
              'Durabilidad': '2-3 años uso profesional',
              'Garantía': '2 años',
              'Colores': 'Transparente',
              'Material': 'Policarbonato',
              'Tallas': 'Ajustable',
              'Entrega': '1-3 días'
            }
          },
          'Arnés Completo': {
            price: 1850,
            discount: '15% desc. por 2+ unidades',
            shipping: 'Envío gratis',
            features: [
              { icon: 'fas fa-check', text: 'Certificación ANSI', available: true },
              { icon: 'fas fa-check', text: '5 puntos anclaje', available: true },
              { icon: 'fas fa-check', text: 'Amortiguador incluido', available: true },
              { icon: 'fas fa-check', text: 'Ajuste universal', available: true },
              { icon: 'fas fa-check', text: 'Inspección fácil', available: true }
            ],
            specs: {
              'Durabilidad': '5-7 años uso profesional',
              'Garantía': '3 años',
              'Colores': 'Negro, Amarillo',
              'Material': 'Nylon + Acero',
              'Tallas': 'M, L, XL',
              'Entrega': '1-2 días'
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

    // Función para cargar tarjetas de proveedores
    function loadProviderCards(productName) {
      const providersGrid = document.getElementById('providersGrid');
      providersGrid.innerHTML = '';
      
      Object.keys(providerDatabase).forEach(providerId => {
        const provider = providerDatabase[providerId];
        const hasProduct = provider.products[productName] !== undefined;
        
        if (hasProduct) {
          const product = provider.products[productName];
          
          const providerCard = document.createElement('div');
          providerCard.className = 'provider-selection-card';
          providerCard.setAttribute('data-provider', providerId);
          providerCard.onclick = () => toggleProvider(providerId);
          
          providerCard.innerHTML = `
            <div class="selection-indicator">
              <i class="fas fa-check"></i>
            </div>
            <div class="provider-card-header">
              <h3 class="provider-name">${provider.name}</h3>
            </div>
            <div class="provider-preview">
              <div class="price-preview">
                <span class="currency">$</span>
                <span class="amount">${product.price}</span>
              </div>
              <div class="features-preview">
                ${product.features.slice(0, 2).map(feature => `
                  <div class="feature-preview">
                    <i class="${feature.icon}"></i>
                    <span>${feature.text}</span>
                  </div>
                `).join('')}
              </div>
              <div class="delivery-info">
                <i class="fas fa-truck"></i>
                <span>${product.specs['Entrega']}</span>
              </div>
            </div>
          `;
          
          providersGrid.appendChild(providerCard);
        }
      });
      
      updateSelectedCount();
    }

    // Función para alternar selección de proveedor
    function toggleProvider(providerId) {
      const card = document.querySelector(`[data-provider="${providerId}"]`);
      
      if (selectedProviders.includes(providerId)) {
        // Deseleccionar
        selectedProviders = selectedProviders.filter(id => id !== providerId);
        card.classList.remove('selected');
      } else {
        // Seleccionar (máximo 3)
        if (selectedProviders.length < 3) {
          selectedProviders.push(providerId);
          card.classList.add('selected');
        } else {
          // Mostrar mensaje si ya hay 3 seleccionados
          showMessage('Máximo 3 proveedores permitidos. Deselecciona uno para agregar otro.');
          return;
        }
      }
      
      updateSelectedCount();
      updateComparison();
    }

    // Función para mostrar mensajes temporales
    function showMessage(message) {
      // Crear elemento de mensaje
      const messageDiv = document.createElement('div');
      messageDiv.className = 'temp-message';
      messageDiv.textContent = message;
      messageDiv.style.cssText = `
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background: #ff6b6b;
        color: white;
        padding: 15px 25px;
        border-radius: 8px;
        z-index: 1000;
        font-weight: 500;
        box-shadow: 0 4px 15px rgba(0,0,0,0.2);
      `;
      
      document.body.appendChild(messageDiv);
      
      // Remover después de 3 segundos
      setTimeout(() => {
        if (messageDiv.parentNode) {
          messageDiv.parentNode.removeChild(messageDiv);
        }
      }, 3000);
    }

    // Función para actualizar contador de seleccionados
    function updateSelectedCount() {
      const selectedCountElement = document.getElementById('selectedCount');
      if (selectedCountElement) {
        selectedCountElement.textContent = selectedProviders.length;
        
        // Actualizar estilo según cantidad seleccionada
        const parentElement = selectedCountElement.parentElement;
        parentElement.className = 'selected-count';
        if (selectedProviders.length === 3) {
          parentElement.classList.add('max-reached');
        }
      }
    }

    // Función para actualizar la comparación
    function updateComparison() {
      const comparisonGrid = document.querySelector('.comparison-grid');
      comparisonGrid.innerHTML = '';

      if (selectedProviders.length === 0) {
        comparisonGrid.innerHTML = `
          <div class="no-providers-message">
            <i class="fas fa-info-circle"></i>
            <h3>Selecciona proveedores para comparar</h3>
            <p>Haz clic en las tarjetas de arriba para seleccionar proveedores</p>
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
              <button class="remove-provider" onclick="removeProvider('${providerId}')" title="Quitar de comparación">
                <i class="fas fa-times"></i>
              </button>
            </div>
          </div>

          <div class="price-section">
            <div class="price-main">
              <span class="currency">$</span>
              <span class="amount">${product.price}</span>
            </div>
            <div class="discount-info">
              <i class="fas fa-percentage"></i>
              <span>${product.discount}</span>
            </div>
            <div class="shipping-info">
              <i class="fas fa-truck"></i>
              <span>${product.shipping}</span>
            </div>
          </div>

          <div class="features-section">
            <h4 class="features-title">Características</h4>
            <ul class="features-list">
              ${product.features.map(feature => `
                <li class="feature-item ${feature.available ? 'available' : 'unavailable'}">
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

    // Función para remover proveedor de la comparación
    function removeProvider(providerId) {
      selectedProviders = selectedProviders.filter(id => id !== providerId);
      
      // Actualizar tarjeta de selección
      const card = document.querySelector(`[data-provider="${providerId}"]`);
      if (card) {
        card.classList.remove('selected');
      }
      
      updateSelectedCount();
      updateComparison();
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
      
      // Usar la ruta de imagen correcta (ya viene con la estructura de carpetas)
      document.getElementById('productImage').src = `assets/img/productos/${productImage}`;
      
      document.getElementById('productCategory').textContent = productCategory.replace('-', ' ').replace(/\b\w/g, l => l.toUpperCase());

      // Cargar tarjetas de proveedores
      loadProviderCards(currentProduct);

      // Inicializar comparación vacía
      updateComparison();

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
