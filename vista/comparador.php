<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Comparador de Cotizaciones - IMPHAMA</title>
  <link rel="stylesheet" href="assets/css/estilos.css">
</head>
<body>
  <div class="comparador-container">
    <h2>Comparar Cotizaciones</h2>
    <form method="POST" action="../controlador/compararCotizaciones.php">
      <label for="producto">Selecciona un producto:</label>
      <select name="producto" id="producto">
        <option value="guantes">Guantes de seguridad</option>
        <option value="casco">Casco industrial</option>
        <option value="chaleco">Chaleco reflectivo</option>
        <!-- Puedes cargar esto desde la BD después -->
      </select>
      <button type="submit">Comparar</button>
    </form>

    <div class="resultado-comparacion">
      <!-- Aquí irán los resultados que devuelve PHP -->
    </div>
  </div>
</body>
</html>
