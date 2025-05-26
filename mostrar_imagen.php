<?php
// Conexión a la base de datos
$conn = new mysqli("localhost", "root", "", "usuarios");

// Verifica conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Verifica si se pasó el parámetro
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT imagen FROM articulo WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);  // asume que el id es entero
    $stmt->execute();
    $stmt->bind_result($imagen);
    $stmt->fetch();

    // Envía la cabecera de tipo de imagen (puedes ajustar según el formato real: jpeg, png, etc.)
    header("Content-type: image/png");
    echo $imagen;

    $stmt->close();
}
$conn->close();
?>
