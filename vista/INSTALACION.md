# INSTRUCCIONES DE INSTALACIÓN - Sistema de Cotizaciones

## Requisitos Previos
- Servidor web con PHP 7.4 o superior
- MySQL 5.7 o superior (o MariaDB)
- PHPMyAdmin (recomendado para gestión de base de datos)

## Pasos de Instalación

### 1. Configurar Base de Datos

1. **Abrir PHPMyAdmin** en tu navegador (usualmente `http://localhost/phpmyadmin`)

2. **Crear usuario de base de datos:**
   - Ve a la pestaña "Cuentas de usuario"
   - Haz clic en "Agregar cuenta de usuario"
   - Usuario: `admin`
   - Contraseña: `admin`
   - Selecciona "Crear base de datos con el mismo nombre y otorgar todos los privilegios"
   - O ejecuta este SQL:
   ```sql
   CREATE USER 'admin'@'localhost' IDENTIFIED BY 'admin';
   GRANT ALL PRIVILEGES ON *.* TO 'admin'@'localhost';
   FLUSH PRIVILEGES;
   ```

3. **Importar la base de datos:**
   - Haz clic en "Importar" en PHPMyAdmin
   - Selecciona el archivo `database.sql`
   - Haz clic en "Continuar"
   
   **O ejecutar manualmente:**
   - Copia todo el contenido del archivo `database.sql`
   - Pégalo en la pestaña "SQL" de PHPMyAdmin
   - Haz clic en "Continuar"

### 2. Verificar Conexión

Una vez importada la base de datos, verifica que:
- Se creó la base de datos `cotizaciones`
- Existen las siguientes tablas:
  - usuarios
  - categorias
  - productos
  - proveedores
  - clientes
  - cotizaciones
  - cotizacion_detalles
  - producto_proveedor

### 3. Configurar Archivos PHP

Los archivos ya están configurados para usar:
- **Host:** localhost
- **Base de datos:** cotizaciones
- **Usuario:** admin
- **Contraseña:** admin

Si necesitas cambiar estos valores, edita el archivo `includes/database.php`:

```php
define('DB_HOST', 'tu_host');
define('DB_NAME', 'tu_base_de_datos');
define('DB_USER', 'tu_usuario');
define('DB_PASS', 'tu_contraseña');
```

### 4. Usuarios de Acceso

El sistema incluye estos usuarios precargados:

| Usuario     | Contraseña | Rol          | Permisos                           |
|-------------|------------|--------------|-----------------------------------|
| admin       | admin      | Admin        | Acceso total al sistema           |
| bodeguero   | 123        | Bodeguero    | Solo gestión de productos         |
| ventas      | 123        | Ventas       | Clientes y cotizaciones           |
| logistica   | 123        | Logística    | Solo gestión de proveedores       |

### 5. Estructura de Datos Incluida

La base de datos incluye datos de ejemplo:
- **4 usuarios** con diferentes roles
- **8 categorías** de productos
- **10 productos** de seguridad industrial
- **5 proveedores** con información completa
- **6 clientes** de diversos sectores
- **5 cotizaciones** de ejemplo con detalles
- **Precios por proveedor** para comparación

### 6. Funcionalidades Disponibles

#### Para Administradores:
- Dashboard con estadísticas en tiempo real
- Gestión completa de usuarios
- Acceso a todos los módulos
- Reportes y estadísticas

#### Para Bodegueros:
- Gestión de productos (CRUD completo)
- Manejo de categorías
- Control de inventario

#### Para Ventas:
- Gestión de clientes (CRUD completo)
- Crear y gestionar cotizaciones
- Sistema de comparación de proveedores
- Generación de PDFs

#### Para Logística:
- Gestión de proveedores (CRUD completo)
- Actualización de precios
- Control de especialidades

### 7. Características del Sistema

- **Base de datos relacional** con integridad referencial
- **Autenticación segura** con contraseñas hasheadas
- **Roles y permisos** granulares
- **CRUD completo** para todas las entidades
- **Sistema de cotizaciones** con comparación de proveedores
- **Estadísticas en tiempo real**
- **Interfaz responsive** y amigable
- **Generación de PDFs** para cotizaciones
- **Validación de datos** tanto en frontend como backend

### 8. Solución de Problemas

#### Error de conexión a la base de datos:
1. Verifica que MySQL esté funcionando
2. Confirma que el usuario y contraseña son correctos
3. Asegúrate de que la base de datos `cotizaciones` existe

#### No aparecen datos:
1. Verifica que el script SQL se ejecutó completamente
2. Revisa que todas las tablas tengan datos
3. Ejecuta: `SELECT COUNT(*) FROM usuarios;` debería devolver 4

#### Problemas de permisos:
1. Verifica que el usuario `admin` tenga todos los permisos
2. Ejecuta: `SHOW GRANTS FOR 'admin'@'localhost';`

### 9. Siguientes Pasos

Una vez instalado, puedes:
1. **Acceder al sistema** con cualquier usuario de prueba
2. **Explorar las funcionalidades** según tu rol
3. **Crear nuevos datos** reales para tu empresa
4. **Personalizar** el sistema según tus necesidades

### 10. Soporte

Este sistema está completamente funcional con:
- ✅ Base de datos MySQL completa
- ✅ Datos de ejemplo precargados
- ✅ Sin datos quemados en código
- ✅ CRUD completo para todas las entidades
- ✅ Sistema de roles y permisos
- ✅ Interfaz moderna y responsive

¡El sistema está listo para usar en producción!
