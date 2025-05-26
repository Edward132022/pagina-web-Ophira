
<?php
// Activar reporte de errores para depuración (remover en producción)
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Conexión a la base de datos
define('DB_HOST', 'sql202.infinityfree.com');
define('DB_USER', 'if0_39047307');
define('DB_PASS', 'cy5DglojXTK');
define('DB_NAME', 'if0_39047307_usuarios');

$conexion = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
$conexion->set_charset('utf8');

if ($conexion->connect_error) {
    die('Conexión fallida: ' . $conexion->connect_error);
}

// Consulta: usar el nombre de columna correcto 'nombre_articuo'
$sql = "SELECT * FROM articulo WHERE nombre_articuo LIKE '%tejida%'";
$resultado = $conexion->query($sql);

// Verificar errores en la consulta
if ($resultado === false) {
    die('Error en la consulta: ' . $conexion->error);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ofira - Tejidos</title>
  <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="styles.css">
  <style>
    .producto a {
      display: block;
      text-decoration: none;
      color: inherit;
    }
  </style>
</head>
<body>

  <!-- Menú -->
  <nav class="menu">
    <a href="index.php" class="logo"><img src="imagenes/logo.png" alt="Logo"></a>
    <div class="hamburger" onclick="toggleMenu()">☰</div>
    <ul class="nav-links">
      <li><a href="nosotros.html">Nosotros</a></li>
      <li><a href="cuero.php">Cuero</a></li>
      <li><a href="tejido.php">Tejidos</a></li>
      <li><a href="personaliza.html">Personaliza</a></li>
      <li><a href="promociones.php">Promociones</a></li>
    </ul>
    <div class="search-box">
      <input type="text" placeholder="Buscar...">
      <button><img src="imagenes/buscar.png" alt="Buscar"></button>
    </div>
    <div class="icons">
      <a href="mi_cuenta.html"><img src="imagenes/user.png" alt="Usuario"></a>
      <a href="carrito.html"><img src="imagenes/cart.png" alt="Carrito"></a>
    </div>
  </nav>

  <!-- Banner -->
  <div class="banner" onclick="location.href='tejido.php'">
    <div class="slide" style="background-image: url('imagenes/tejidos.png');">
      <div class="overlay"><h2>Tejidos</h2></div>
    </div>
  </div>

  <!-- Productos -->
  <main>
    <h2 class="titulo-disponibles">Artículos disponibles</h2>
    <section class="productos-grid">
      <?php if ($resultado->num_rows > 0): ?>
        <?php while ($fila = $resultado->fetch_assoc()): ?>
          <div class="producto">
            <a href="previsualizacion.php?id=<?= urlencode($fila['id']) ?>">
              <img src="mostrar_imagen.php?id=<?= urlencode($fila['id']) ?>" alt="<?= htmlspecialchars($fila['nombre_articuo']) ?>">
              <h3><?= htmlspecialchars($fila['nombre_articuo']) ?></h3>
              <p class="precio">COP <?= number_format($fila['precio'], 0, ',', '.') ?></p>
            </a>
          </div>
        <?php endwhile; ?>
      <?php else: ?>
        <p style="text-align:center;">No hay productos tejidos disponibles en este momento.</p>
      <?php endif; ?>
    </section>
  </main>

  <!-- Footer -->
  <footer>
    <div class="footer-container">
      <div class="footer-section">
        <h3>ACERCA</h3>
        <a href="nosotros.html">Nosotros</a>
      </div>
      <div class="footer-section">
        <h3>COMPRAR</h3>
        <a href="cuero.php">Cuero</a>
        <a href="tejido.php">Tejidos</a>
        <a href="personaliza.php">Personaliza</a>
      </div>
      <div class="footer-section">
        <h3>USUARIO</h3>
        <a href="mi_cuenta.php">Mi cuenta</a>
        <a href="login.php">Login</a>
      </div>
    </div>
    <div class="footer-bottom"><p>© Ophira Creations. Todos los derechos reservados</p></div>
  </footer>

  <script src="script.js"></script>
</body>
</html>

<?php $conexion->close(); ?>
```
