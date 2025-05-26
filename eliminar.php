
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

// Verifica si se pasó un id por la URL
if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // sanitiza el valor por seguridad

    // Ejecuta la eliminación
    $conexion->query("DELETE FROM articulo WHERE id = $id");

    // Redirige de nuevo al admin
    header("Location: admin.php");
    exit;
} else {
    echo "ID no recibido";
}
?>
