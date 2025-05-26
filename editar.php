
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
// Reemplaza 'rowid' por 'id'
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$resultado = $conexion->query("SELECT * FROM articulo WHERE id = $id");

$fila = $resultado ? $resultado->fetch_assoc() : null;
?>

<form action="actualizar.php" method="POST" enctype="multipart/form-data">
  <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">
  <input type="text" name="nombre_articulo" value="<?php echo htmlspecialchars($fila['nombre_articulo'] ?? ''); ?>" required>
  <input type="text" name="descripcion" value="<?php echo htmlspecialchars($fila['descripcion'] ?? ''); ?>" required>
  <input type="number" name="precio" value="<?php echo htmlspecialchars($fila['precio'] ?? ''); ?>" required>
  <input type="file" name="imagen">
  <button type="submit">Actualizar</button>
</form>
