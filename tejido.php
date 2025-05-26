<?php
$conexion = new mysqli("localhost", "root", "", "usuarios");
$conexion->set_charset("utf8");

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

$sql = "SELECT * FROM articulo WHERE nombre_articuo LIKE '%tejida%'";
$resultado = $conexion->query($sql);
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

  <nav class="menu">
    <a href="index.html" class="logo">
      <img src="imagenes/logo.png" alt="Logo">
    </a>
    <div class="hamburger" onclick="toggleMenu()">☰</div>
    <ul class="nav-links">
      <li><a href="nosotros.html">Nosotros</a></li>
      <li><a href="cuero.php">Cuero</a></li>
      <li><a href="tejido.php">Tejido</a></li>
      <li><a href="personaliza.html">Personaliza</a></li>
      <li><a href="promociones.php">Promociones</a></li>
    </ul>
    <div class="search-box">
      <input type="text" placeholder="Buscar...">
      <button>
        <img src="imagenes/buscar.png" alt="Buscar">
      </button>
    </div>
    <div class="icons">
      <a href="mi_cuenta.html"><img src="imagenes/user.png" alt="Usuario"></a>
      <a href="carrito.html"><img src="imagenes/cart.png" alt="Carrito"></a>
    </div>
  </nav>

  <div class="banner" onclick="irAtej()">
    <div class="slide" style="background-image: url('imagenes/tejidos.png');">
      <div class="overlay">
        <h2>Tejidos</h2>
      </div>
    </div>
  </div>

  <main>
    <h2 class="titulo-disponibles">Articulos disponibles</h2>
    <section class="productos-grid">
      <?php if ($resultado->num_rows > 0): ?>
        <?php while ($fila = $resultado->fetch_assoc()): ?>
          <div class="producto">
            <a href="previsualizacion.php?id=<?= urlencode($fila['id']) ?>">
              <img src="mostrar_imagen.php?id=<?= $fila['id'] ?>" alt="<?= htmlspecialchars($fila['nombre_articuo']) ?>">
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
        <a href="personaliza.html">Personaliza</a>
      </div>
      <div class="footer-section">
        <h3>USUARIO</h3>
        <a href="mi_cuenta.html">Mi cuenta</a>
        <a href="login.html">Login</a>
      </div>
    </div>
    <div class="footer-bottom">
      <p>© Ophira Creations. Todos los derechos reservados</p>
    </div>
  </footer>

  <script src="script.js"></script>
</body>
</html>

<?php $conexion->close(); ?>
