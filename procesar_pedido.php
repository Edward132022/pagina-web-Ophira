<?php
// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "usuarios");
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

// Capturar datos del formulario
$nombre = $_POST['nombre'];
$numero = $_POST['numero'];
$direccion = $_POST['direccion'] . " " . $_POST['apto'];
$pais = $_POST['pais'];
$ciudad = $_POST['ciudad'];
$codigo_postal = $_POST['codigo_postal'];
$articulo = $_POST['articulo']; // productos separados por coma o salto de línea
$precio = $_POST['precio'];
$ntarjeta = $_POST['ntarjeta'];
$ntitular = $_POST['ntitular'];

// Insertar en la tabla pedidos
$sql = "INSERT INTO pedidos (nombre, numero, direccion, pais, ciudad, codigo_postal, articulo, precio, ntarjeta, ntitular)
        VALUES ('$nombre', '$numero', '$direccion', '$pais', '$ciudad', '$codigo_postal', '$articulo', '$precio', '$ntarjeta', '$ntitular')";

if ($conexion->query($sql) === TRUE) {
    echo "<h3>¡Pedido realizado con éxito!</h3>";
} else {
    echo "Error: " . $conexion->error;
}

$conexion->close();
?>
