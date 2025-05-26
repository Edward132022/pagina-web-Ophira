
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
$productos = [];
$total = 0;

$resultado = $conexion->query("SELECT nombre_articuo, precio FROM articulo");
while ($fila = $resultado->fetch_assoc()) {
    $productos[] = $fila['nombre_articuo'];
    $total += $fila['precio'];
}

$productos_texto = implode(", ", $productos);

// Guardar en la tabla 'pedidos' si se envía el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $numero = $_POST['numero'];
    $correo = $_POST['correo'];
    $direccion = $_POST['direccion'];
    $pais = $_POST['pais'];
    $ciudad = $_POST['ciudad'];
    $codigo_postal = $_POST['codigo_postal'];
    $ntarjeta = $_POST['ntarjeta'];
    $nmtitular = $_POST['nmtitular'];
    //$correo = "cliente@ejemplo.com"; // Si quieres asignar uno fijo, descomenta

    $insertar = $conexion->prepare("INSERT INTO pedidos (nombre, correo, numero, direccion, pais, ciudad, codigo_postal, articulo, precio, ntarjeta, nmtitular) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $insertar->bind_param("ssisssssdii", $nombre, $correo, $numero, $direccion, $pais, $ciudad, $codigo_postal, $productos_texto, $total, $ntarjeta, $nmtitular);
    $insertar->execute();

    echo "<script>alert('¡Compra confirmada!'); window.location.href = 'index.php';</script>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Confirmar Compra</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        .resumen, form { max-width: 600px; margin: auto; padding: 20px; }
        .resumen { background: #f0f0f0; border: 1px solid #ccc; border-radius: 10px; margin-bottom: 20px; }
        .resumen h2, form h2 { text-align: center; }
        input { width: 100%; padding: 10px; margin-bottom: 15px; border-radius: 8px; border: 1px solid #aaa; }
        button { padding: 10px 20px; background: black; color: white; border: none; border-radius: 10px; cursor: pointer; }
    </style>
</head>
<body>


<form method="POST">
    <h2>Datos para el envío y pago</h2>
    <!-- Datos personales -->
    <label for="nombre">Nombre:</label>
    <input type="text" name="nombre" required>

    <label for="correo">Correo:</label>
    <input type="email" name="correo" required>

    <label for="numero">Número de Teléfono:</label>
    <input type="number" name="numero" required>

    <label for="direccion">Dirección:</label>
    <input type="text" name="direccion" required>

    <label for="pais">País:</label>
    <input type="text" name="pais" required>

    <label for="ciudad">Ciudad:</label>
    <input type="text" name="ciudad" required>

    <label for="codigo_postal">Código Postal:</label>
    <input type="text" name="codigo_postal" required>

    <label for="ntarjeta">Número de Tarjeta:</label>
    <input type="number" name="ntarjeta" required>

    <label for="nmtitular">Número del Titular:</label>
    <input type="number" name="nmtitular" required>

    <!-- Ocultos: productos y precio -->
    <input type="hidden" name="productos" id="productos">
    <input type="hidden" name="precio_total" id="precio_total">

    <button type="submit">Confirmar compra</button>
</form>

</body>
</html>
