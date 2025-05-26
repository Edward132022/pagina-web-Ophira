<?php
$conn = new mysqli("localhost", "root", "", "usuarios");

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Sanitizar entradas
$id = intval($_POST['id']); // conversión segura
$nombre = $conn->real_escape_string($_POST['nombre_articuo']);
$descripcion = $conn->real_escape_string($_POST['descripcion']);
$precio = floatval($_POST['precio']); // conversión segura

// Procesar imagen si se sube una nueva
if (!empty($_FILES['imagen']['name'])) {
    $imagen = basename($_FILES['imagen']['name']);
    $ruta_temporal = $_FILES['imagen']['tmp_name'];
    $destino = "img/" . $imagen;

    if (move_uploaded_file($ruta_temporal, $destino)) {
        $sql = "UPDATE articulo SET 
                    nombre_articuo = '$nombre', 
                    descripcion = '$descripcion', 
                    precio = $precio, 
                    imagen = '$imagen' 
                WHERE id = $id";
    } else {
        echo "Error al subir la imagen.";
        exit;
    }
} else {
    // Sin cambiar imagen
    $sql = "UPDATE articulo SET 
                nombre_articuo = '$nombre', 
                descripcion = '$descripcion', 
                precio = $precio 
            WHERE id = $id";
}

// Ejecutar actualización
if ($conn->query($sql)) {
    header("Location: admin.php");
    exit;
} else {
    echo "Error al actualizar: " . $conn->error;
}
?>
