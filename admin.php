
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
$consulta = $conexion->query("SELECT * FROM articulo");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
 
    <!-- Importar la fuente DM Serif Display -->
    <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display&display=swap" rel="stylesheet">

    <!-- Enlace al archivo CSS -->
    <link rel="stylesheet" href="styles.css">
    <title>Administrador - Productos</title>

    
</head>
<body>
      <nav class="menu">
        <a href="index_admind.html" class="logo">
            <img src="imagenes/logo.png" alt="Logo">
        </a>

        <!-- Menú hamburguesa -->
        <div class="hamburger" onclick="toggleMenu()">
            ☰
        </div>

        <!-- Enlaces de navegación -->
        <ul class="nav-links">
            <li><a href="admin.php">Productos</a></li>
            <li><a href="ingresar.html">Nuevo Ingreso</a></li>
            <li><a href="pedidos.php">pedidos</a></li>
        </ul>

       

        <!-- Íconos de usuario y carrito -->
        <div class="icons">
            <a href="mi_cuenta_admin.html"><img src="imagenes/user.png" alt="Usuario"></a>
        </div>
    </nav>

 
    <h2>Lista de Productos</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Nombre del Artículo</th>
            <th>Descripción</th>
            <th>Precio</th>
            <th>Acciones</th>
        </tr>

        <?php while($fila = $consulta->fetch_assoc()): ?>
        <tr>
            <td><?php echo $fila['id']; ?></td>
            <td><?php echo $fila['nombre_articuo']; ?></td>
            <td><?php echo $fila['descripcion']; ?></td>
            <td>$<?php echo $fila['precio']; ?></td>
           
           
            <td>
                <a href="editar.php?id=<?php echo $fila['id']; ?>" class="editar">Editar</a>
                <a href="eliminar.php?id=<?php echo $fila['id']; ?>" onclick="return confirm('¿Seguro que quieres eliminar este producto?')">Eliminar</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>

    
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
                <a href="cuero.html">Cuero</a>
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
    <!--jvs-->>
    <script src="script.js"></script> <!-- Enlace al archivo JavaScript -->
    <div id="cookie-banner" role="dialog" aria-live="polite" aria-label="Aviso de cookies">
        <div class="cookie-content">
          <p id="cookie-text">
            Esta web usa cookies para mejorar tu experiencia. Al continuar navegando, aceptas nuestra 
            <a href="/politica-cookies.html" target="_blank" rel="noopener">política de cookies</a>.
          </p>
          <button id="accept-cookies" aria-describedby="cookie-text">Aceptar</button>
        </div>
      </div>
    
      <script src="cookies.js"></script>
</body>
</html>
