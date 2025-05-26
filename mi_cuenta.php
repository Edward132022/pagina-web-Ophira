
<?php
session_start();
header("Content-Type: application/json; charset=UTF-8");

if (isset($_SESSION['nombre_apellido'])) {
    echo json_encode([
        "loggedIn" => true,
        "nombre"   => $_SESSION['nombre_apellido']
    ]);
} else {
    echo json_encode([
        "loggedIn" => false
    ]);
}
