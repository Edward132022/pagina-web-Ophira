<?php
// 1. CONEXIÓN A LA BASE DE DATOS
$servidor = "sql202.infinityfree.com";
$user = "if0_39047307";
$pass = "cy5DglojXTK";
$baseDatos = "if0_39047307_usuarios";
$enlace = mysqli_connect($servidor, $user, $pass, $baseDatos);
if (!$enlace) {
    die("Error de conexión: " . mysqli_connect_error());
}

// 2. PROCESAMIENTO DEL FORMULARIO
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['Registrarse'])) {
    $nombre     = mysqli_real_escape_string($enlace, trim($_POST['nombre']));
    $correo     = mysqli_real_escape_string($enlace, trim($_POST['correo']));
    $contrasena = mysqli_real_escape_string($enlace, $_POST['contrasena']);

    // 2.1 Validar formato de correo
    if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('El formato de correo no es válido.');</script>";
    }
    else {
        // 2.2 Comprobar duplicado
        $sqlCheck = "SELECT 1 FROM registro WHERE correo = '$correo' LIMIT 1";
        $resCheck = mysqli_query($enlace, $sqlCheck);
        if ($resCheck && mysqli_num_rows($resCheck) > 0) {
            echo "<script>alert('Ya existe una cuenta con ese correo. Por favor usa otro.');</script>";
        }
        else {
            // 2.3 Insertar nuevo registro
            $sqlInsert = "INSERT INTO registro (nombre_apellido, correo, password)
                          VALUES ('$nombre', '$correo', '$contrasena')";
            if (mysqli_query($enlace, $sqlInsert)) {
                echo "<script>
                        alert('Usuario registrado exitosamente.');
                        window.location.href = 'login.html';
                      </script>";
                exit;
            } else {
                echo "<script>alert('Error al registrar el usuario.');</script>";
            }
        }
    }
}

mysqli_close($enlace);
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Registrarse - Ophira</title>
  <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <!-- Barra de navegación -->
  <nav class="menu">
    <a href="index.php" class="logo"><img src="imagenes/logo.png" alt="Logo"></a>
    <div class="hamburger" onclick="toggleMenu()">☰</div>
    <ul class="nav-links">
      <li><a href="nosotros.html">Nosotros</a></li>
      <li><a href="cuero.php">Cuero</a></li>
      <li><a href="tejido.php">Tejido</a></li>
      <li><a href="personaliza.html">Personaliza</a></li>
      <li><a href="promociones.php">Promociones</a></li>
    </ul>
    <div class="search-box">
      <input type="text" placeholder="Buscar..."><button><img src="imagenes/buscar.png" alt="Buscar"></button>
    </div>
    <div class="icons">
      <a href="mi_cuenta.html"><img src="imagenes/user.png" alt="Usuario"></a>
      <a href="carrito.html"><img src="imagenes/cart.png" alt="Carrito"></a>
    </div>
  </nav>

  <!-- Contenido principal -->
  <main>
    <div class="form-container">
      <h2>Registrarse</h2>
      <form action="registro.php" method="post" name="registro">
        <label for="nombre">Nombre y Apellido</label>
        <input type="text" id="nombre" name="nombre" placeholder="Ej: Juan Pérez" required>

        <label for="correo">Correo Electrónico</label>
        <input type="email" id="correo" name="correo" placeholder="Ej: correo@ejemplo.com" required>

        <label for="contrasena">Contraseña</label>
        <input type="password" id="contrasena" name="contrasena" placeholder="Contraseña" required>

        <button type="submit" name="Registrarse" value="Registrarse">Registrarse</button>
        <button type="reset">Limpiar</button>
      </form>
      <p>¿Ya tiene cuenta? <a href="login.html">Inicie Sesión</a></p>
    </div>
  </main>

  <!-- Footer -->
  <footer>
    <div class="footer-container">
      <div class="footer-section">
        <h3>ACERCA</h3><a href="nosotros.html">Nosotros</a>
      </div>
      <div class="footer-section">
        <h3>COMPRAR</h3>
        <a href="cuero.php">Cuero</a>
        <a href="tejido.php">Tejidas</a>
        <a href="personaliza.html">Personalizar</a>
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

  <script src="user.js"></script>
</body>
</html>
