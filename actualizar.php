
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

// Sanitizar entradas
$id = intval($_POST['id']); // conversión segura
$nombre = $_POST['nombre_articuo']; // corregido el nombre del campo
$descripcion = $_POST['descripcion'];
$precio = floatval($_POST['precio']); // conversión segura

// Procesar imagen si se sube una nueva
if (!empty($_FILES['imagen']['name'])) {
    $imagen = basename($_FILES['imagen']['name']);
    $ruta_temporal = $_FILES['imagen']['tmp_name'];
    $destino = "img/" . $imagen;

    if (move_uploaded_file($ruta_temporal, $destino)) {
        $stmt = $conexion->prepare("UPDATE articulo SET nombre_articuo = ?, descripcion = ?, precio = ?, imagen = ? WHERE id = ?");
        $stmt->bind_param("ssdsi", $nombre, $descripcion, $precio, $imagen, $id);
    } else {
        echo "Error al subir la imagen.";
        exit;
    }
} else {
    // Sin cambiar imagen
    $stmt = $conexion->prepare("UPDATE articulo SET nombre_articulo = ?, descripcion = ?, precio = ? WHERE id = ?");
    $stmt->bind_param("ssdi", $nombre, $descripcion, $precio, $id);
}

// Ejecutar actualización
if (isset($stmt) && $stmt->execute()) {
    header("Location: admin.php");
    exit;
} else {
    echo "Error al actualizar: " . $conexion->error;
}
?>
