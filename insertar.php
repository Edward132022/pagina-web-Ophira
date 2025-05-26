<?php
$conn = new mysqli("localhost", "root", "", "usuarios");

$nombre = $_POST['nombre_articuo'];
$descripcion = $_POST['descripcion'];
$precio = $_POST['precio'];
$imagen = addslashes(file_get_contents($_FILES['imagen']['tmp_name']));

$sql = "INSERT INTO articulo (nombre_articuo , descripcion, precio, imagen) 
        VALUES ('$nombre', '$descripcion', $precio, '$imagen')";

$conn->query($sql);
$conn->close();

header("Location: index_admind.html");
?>
