<?php
$conexion = new mysqli("localhost", "root", "", "usuarios");
$conexion->set_charset("utf8");

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

$id = $_GET['id'] ?? null;
if (!$id) {
    echo "Producto no especificado.";
    exit;
}

$sql = "SELECT * FROM articulo WHERE id = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$resultado = $stmt->get_result();
$producto = $resultado->fetch_assoc();

if (!$producto) {
    echo "Producto no encontrado.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ofira</title>

    <!-- Importar la fuente DM Serif Display -->
    <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display&display=swap" rel="stylesheet">

    <!-- Enlace al archivo CSS -->
    <link rel="stylesheet" href="styles.css">
</head>
<body>

    <!-- Contenedor del menú -->
    <nav class="menu">
        <a href="index.html" class="logo">
            <img src="imagenes/logo.png" alt="Logo">
        </a>

        <!-- Menú hamburguesa -->
        <div class="hamburger" onclick="toggleMenu()">
            ☰
        </div>

        <!-- Enlaces de navegación -->
        <ul class="nav-links">
            <li><a href="nosotros.html">Nosotros</a></li>
            <li><a href="cuero.php">Cuero</a></li>
            <li><a href="tejido.php">Tejido</a></li>
            <li><a href="personaliza.html">Personaliza</a></li>
            <li><a href="promociones.php">Promociones</a></li>
        </ul>

        <!-- Barra de búsqueda -->
        <div class="search-box">
            <input type="text" placeholder="Buscar...">
            <button>
            
                <img src="imagenes/buscar.png" alt="Buscar">
               
            </button>
        </div>

        <!-- Íconos de usuario y carrito -->
        <div class="icons">
            <a href="mi_cuenta.html"><img src="imagenes/user.png" alt="Usuario"></a>
            <a href="carrito.html"><img src="imagenes/cart.png" alt="Carrito"></a>
        </div>
    </nav>

<div class="producto-container">
   <div class="producto-imagen">
  <img src="mostrar_imagen.php?id=<?= $producto['id'] ?>" alt="<?= htmlspecialchars($producto['nombre_articuo']) ?>" width="300">
  </div>
   <div class="producto-detalles">
  <h2><?= htmlspecialchars($producto['nombre_articuo']) ?></h2>
  <p><?= htmlspecialchars($producto['descripcion']) ?></p>
  <p>Precio: $<?= number_format($producto['precio'], 0, ',', '.') ?></p>
 <div class="acciones">
        <button class="boton-cantidad" onclick="decrementarCantidad()">-</button>
  <div class="botones">
        <a href="index.html" class="boton-atras">Atrás</a>
      </div>
      </div>
  <button onclick="agregarAlCarrito({
    name: '<?= addslashes($producto['nombre_articuo']) ?>',
    description: '<?= addslashes($producto['descripcion']) ?>',
    price: '<?= number_format($producto['precio'], 0, ',', '.') ?>',
    image: 'mostrar_imagen.php?id=<?= $producto['id'] ?>'
  })">
    Enviar al carrito
  </button>
  </div>
  </div>
  <script>
    function agregarAlCarrito(producto) {
      let cart = JSON.parse(localStorage.getItem('cart')) || [];
      cart.push(producto);
      localStorage.setItem('cart', JSON.stringify(cart));
      window.location.href = 'carrito.html';
    }
  </script>
   <footer>
        <!-- Contenedor principal del footer -->
        <div class="footer-container">
            
            <!-- Sección "Acerca" con un título y un enlace -->
            <div class="footer-section">
                <h3>ACERCA</h3>
                <a href="nosotros.html">Nosotros</a>
            </div>
    
            <!-- Sección "Comprar" con un título y varios enlaces -->
            <div class="footer-section">
                <h3>COMPRAR</h3>
                <a href="cuero.php">Cuero</a>
                <a href="tejidas.html">Tejidas</a>
                <a href="personalizar.html">Personalizar</a>
            </div>
    
            <!-- Sección "Usuario" con un título y enlaces de cuenta -->
            <div class="footer-section">
                <h3>USUARIO</h3>
                <a href="mi-cuenta.html">Mi cuenta</a>
                <a href="login.html">Login</a>
            </div>
        </div>
    
        <!-- Texto de derechos reservados en la parte inferior -->
        <div class="footer-bottom">
            <p>© Ophira Creations. Todos los derechos reservados</p>
        </div>
    </footer>
</body>
</html>

<?php $conexion->close(); ?>
