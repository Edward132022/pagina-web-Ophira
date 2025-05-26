<?php
$conn = new mysqli("localhost", "root", "", "usuarios");
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
