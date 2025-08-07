# Sistema de Cotizaciones - Equipos de Seguridad Industrial

## Descripción
Sistema web desarrollado en PHP puro para la gestión de cotizaciones de equipos de seguridad industrial. Incluye manejo de roles de usuario, comparación de proveedores, y generación de cotizaciones formales en PDF.

## Características Principales

### Usuarios y Roles
- **Admin**: Acceso total a todas las funciones, dashboard, gestión de usuarios
- **Bodeguero**: Solo acceso a CRUD de productos
- **Ventas**: CRUD de clientes y creación/gestión de cotizaciones
- **Logística**: Solo acceso a CRUD de proveedores

### Funcionalidades CRUD
- **Productos**: Gestión completa de productos por categorías
- **Proveedores**: Información de proveedores y sus especialidades
- **Clientes**: Base de datos de clientes empresariales
- **Usuarios**: Gestión de usuarios del sistema (solo Admin)
- **Cotizaciones**: Historial y gestión de cotizaciones

### Sistema de Cotización Comparativa
- Navegación por categorías de productos
- Selección de productos y comparación entre proveedores
- Comparación de precios, garantías, descuentos y características
- Selección múltiple de proveedores para comparación
- Carrito de cotización con cálculos automáticos
- Generación de PDF formal para envío al cliente

### Dashboard Administrativo
- Estadísticas del sistema
- Actividad reciente
- Métricas de cotizaciones
- Productos más cotizados

## Instalación

1. **Requisitos**:
   - Servidor web con PHP 7.4+
   - No requiere base de datos (datos quemados en código)

2. **Instalación**:
   ```bash
   # Clonar o descargar el proyecto
   cd /ruta/servidor/web
   cp -r imphama/ ./
   ```

3. **Configuración**:
   - No requiere configuración adicional
   - Los datos están incluidos en el código (usuarios, productos, proveedores, etc.)

## Usuarios de Prueba

| Usuario | Contraseña | Rol | Acceso |
|---------|------------|-----|---------|
| admin | admin | Admin | Todas las funciones |
| bodeguero | 123 | Bodeguero | Solo productos |
| ventas | 123 | Ventas | Clientes y cotizaciones |
| logistica | 123 | Logística | Solo proveedores |

## Estructura del Sistema

### Archivos Principales
- `index.php` - Página principal con módulos por rol
- `login.php` - Sistema de autenticación
- `dashboard.php` - Panel administrativo (solo Admin)

### Módulos CRUD
- `productos.php` - Gestión de productos
- `proveedores.php` - Gestión de proveedores
- `clientes.php` - Gestión de clientes
- `usuarios.php` - Gestión de usuarios (solo Admin)

### Sistema de Cotización
- `cotizaciones.php` - Lista y gestión de cotizaciones
- `hacer_cotizacion.php` - Creador de cotizaciones comparativas
- `generar_pdf.php` - Generador de PDF formal

### Archivos de Soporte
- `includes/header.php` - Header común
- `includes/footer.php` - Footer común
- `css/style.css` - Estilos del sistema
- `logout.php` - Cerrar sesión

## Flujo de Trabajo: Crear Cotización

1. **Acceso**: Usuario Ventas o Admin
2. **Selección de Cliente**: Elegir cliente existente o crear nuevo
3. **Navegación por Categorías**: Explorar productos por categoría
4. **Comparación de Proveedores**: 
   - Seleccionar producto
   - Ver proveedores disponibles
   - Comparar precios, garantías, descuentos, colores
   - Seleccionar proveedores para comparación
5. **Agregar al Carrito**:
   - Definir cantidad
   - Elegir proveedor final
   - Agregar notas opcionales
6. **Finalización**:
   - Revisar carrito con totales
   - Generar cotización formal
   - Descargar PDF para envío

## Características del PDF

La cotización generada incluye:
- Información completa de la empresa
- Datos del cliente
- Detalle de productos con proveedores seleccionados
- Cálculos de subtotal, IVA y total
- Condiciones comerciales
- Espacios para firmas
- Diseño profesional y formal

## Datos de Prueba Incluidos

### Productos por Categoría
- **Protección Cabeza**: Cascos industriales, dieléctricos, con barbiquejo
- **Protección Manos**: Guantes de nitrilo, cuero, anticorte
- **Protección Pies**: Botas de seguridad, dieléctricas, antideslizantes
- **Protección Ojos**: Gafas de protección, para soldar, químicas
- **Protección Respiratoria**: Mascarillas N95, respiradores
- **Protección Altura**: Arneses, cuerdas de vida

### Proveedores Incluidos
- Equipos Industriales Pro
- Seguridad Total SA
- ProtecMax Corp
- SafeWork Solutions
- Visión Segura

### Clientes de Prueba
- Constructora ABC
- Industrias Del Norte
- Minera Esperanza
- Petroquímica Costa
- Transportes Rápidos
- Laboratorios Científicos

## Próximos Pasos (Funcionalidades Futuras)

1. **Conexión a Base de Datos**: Reemplazar datos quemados con MySQL/PostgreSQL
2. **Autenticación Mejorada**: Hash de contraseñas, recuperación de contraseña
3. **Reportes Avanzados**: Gráficos y estadísticas detalladas
4. **Notificaciones**: Email automático al generar cotizaciones
5. **API REST**: Para integración con otros sistemas
6. **Optimización Mobile**: Mejora en dispositivos móviles

## Tecnologías Utilizadas

- **Frontend**: HTML5, CSS3, JavaScript (Vanilla)
- **Backend**: PHP 7.4+
- **Diseño**: CSS Grid, Flexbox
- **PDF**: HTML to PDF (usando print media queries)
- **Datos**: Arrays PHP (sin base de datos)

## Licencia
Proyecto desarrollado para demostración de capacidades de desarrollo web con PHP puro.

---

**Nota**: Este sistema está diseñado como demostración con datos quemados. Para producción, se recomienda implementar una base de datos, autenticación segura y validaciones adicionales de seguridad.
