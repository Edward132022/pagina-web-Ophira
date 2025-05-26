<?php
$conn = new mysqli("localhost", "root", "", "usuarios");

// Reemplaza 'rowid' por 'id'
$id = $_GET['id'];
$resultado = $conn->query("SELECT * FROM articulo WHERE id = $id");

$fila = $resultado->fetch_assoc();
?>

<form action="actualizar.php" method="POST" enctype="multipart/form-data">
  <input type="hidden" name="id" value="<?php echo $id; ?>">
  <input type="text" name="nombre_articuo" value="<?php echo $fila['nombre_articuo']; ?>" required>
  <input type="text" name="descripcion" value="<?php echo $fila['descripcion']; ?>" required>
  <input type="number" name="precio" value="<?php echo $fila['precio']; ?>" required>
  <input type="file" name="imagen">
  <button type="submit">Actualizar</button>
</form>
