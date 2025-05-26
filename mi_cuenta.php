<?php
session_start();
header("Content-Type: application/json; charset=UTF-8");

if (isset($_SESSION['usuarios'])) {
    echo json_encode([
        "loggedIn" => true,
        "nombre"   => $_SESSION['usuarios']
    ]);
} else {
    echo json_encode([
        "loggedIn" => false
    ]);
}
