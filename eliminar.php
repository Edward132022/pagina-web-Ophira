<?php
$conexion = new mysqli("localhost", "root", "", "usuarios");

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
