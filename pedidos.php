<?php
$conexion = new mysqli("localhost", "root", "", "usuarios");

if ($conexion->connect_errno) {
    die("Error al conectar con la base de datos: " . $conexion->connect_error);
}

// Obtener todos los pedidos sin 'id'
$resultado = $conexion->query("SELECT nombre, correo, numero, direccion, pais, ciudad, codigo_postal, articulo, precio, ntarjeta, nmtitular FROM pedidos");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
      <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    

    <!-- Importar la fuente DM Serif Display -->
    <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display&display=swap" rel="stylesheet">

    <!-- Enlace al archivo CSS -->
    <link rel="stylesheet" href="styles.css">
    <title>Sección Pedidos</title>
    <style>
        table { border-collapse: collapse; width: 100%; max-width: 1000px; margin: 20px auto; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: center; }
        th { background-color: #f2f2f2; }
        .checkboxes { display: flex; justify-content: center; gap: 20px; margin-top: 8px; }
        .checkboxes label { cursor: pointer; }
    </style>
</head>
<body>

    <!-- Contenedor del menú -->
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

 
<h2 style="text-align:center;">Pedidos</h2>

<table>
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Correo</th>
            <th>Teléfono</th>
            <th>Dirección</th>
            <th>País</th>
            <th>Ciudad</th>
            <th>Código Postal</th>
            <th>Productos</th>
            <th>Total (COP)</th>
            <th>Tarjeta</th>
            <th>Titular</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($pedido = $resultado->fetch_assoc()) : ?>
            <tr>
                <td><?php echo htmlspecialchars($pedido['nombre']); ?></td>
                <td><?php echo htmlspecialchars($pedido['correo']); ?></td>
                <td><?php echo htmlspecialchars($pedido['numero']); ?></td>
                <td><?php echo htmlspecialchars($pedido['direccion']); ?></td>
                <td><?php echo htmlspecialchars($pedido['pais']); ?></td>
                <td><?php echo htmlspecialchars($pedido['ciudad']); ?></td>
                <td><?php echo htmlspecialchars($pedido['codigo_postal']); ?></td>
                <td><?php echo htmlspecialchars($pedido['articulo']); ?></td>
                <td><?php echo number_format($pedido['precio'], 0, ',', '.'); ?></td>
                <td><?php echo htmlspecialchars($pedido['ntarjeta']); ?></td>
                <td><?php echo htmlspecialchars($pedido['nmtitular']); ?></td>
            </tr>
            <tr>
                <td colspan="11" style="text-align:center;">
                    <div class="checkboxes">
                        <label><input type="checkbox" disabled> Enviado</label>
                        <label><input type="checkbox" disabled> Entregado</label>
                    </div>
                </td>
            </tr>
        <?php endwhile; ?>
    </tbody>
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
