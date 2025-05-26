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

// Validar entrada
if (
    isset($_POST['nombre_articuo'], $_POST['descripcion'], $_POST['precio']) &&
    isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK
) {
    $nombre = $_POST['nombre_articuo'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $imagen = file_get_contents($_FILES['imagen']['tmp_name']);

    // Usar prepared statements para evitar inyecciones SQL
    $stmt = $conexion->prepare("INSERT INTO articulo (nombre_articuo, descripcion, precio, imagen) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssds", $nombre, $descripcion, $precio, $imagen);

    if ($stmt->execute()) {
        header("Location: index_admind.html");
        exit();
    } else {
        echo "Error al insertar: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Datos incompletos o error al subir la imagen.";
}

$conexion->close();
?>
