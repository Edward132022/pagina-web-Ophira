```php
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
$resultado = $conn->query("SELECT rowid, * FROM articulo");

while ($fila = $resultado->fetch_assoc()) {
  echo "<tr>";
 echo "<td><img src='mostrarimagen.php?id=" . $fila['rowid'] . "' width='100'></td>";
  echo "<td>" . $fila['nombre_articuo'] . "</td>";
  echo "<td>" . $fila['descripcion'] . "</td>";
  echo "<td>$" . $fila['precio'] . "</td>";
  echo "<td>
          <a href='editar.php?id=" . $fila['rowid'] . "'>Editar</a> | 
          <a href='eliminar.php?id=" . $fila['rowid'] . "' onclick=\"return confirm('¿Eliminar este producto?')\">Eliminar</a>
        </td>";
  echo "</tr>";
}
$conn->close();
?>
