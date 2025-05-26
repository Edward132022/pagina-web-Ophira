<?php
session_start(); // ①

// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "usuarios");

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Obtener los datos del formulario
$correo = $_POST['correo'];
$contrasena = $_POST['contrasena'];

// Verificación para el administrador (caso especial)
if ($correo === 'admin@ophira.com' && $contrasena === 'ophira123') {
    $_SESSION['correo'] = $correo;
    header("Location: index_admind.html");
    exit();
}

// Verificar usuario en la base de datos
$sql = "SELECT * FROM registro WHERE correo = '$correo' AND password = '$contrasena'";
$resultado = $conexion->query($sql);

if ($resultado->num_rows > 0) {
    $_SESSION['correo'] = $correo;
    header("Location: index.html"); // Usuario normal
} else {
    echo "<script>alert('Correo o contraseña incorrectos'); window.location.href='login.html';</script>";
}

$conexion->close();
?>

// Conexión
$enlace = mysqli_connect("localhost","root","","usuarios");
if (!$enlace) die("Error de conexión: ".mysqli_connect_error());

// Procesamiento del formulario
if ($_SERVER["REQUEST_METHOD"]==="POST" && isset($_POST['Ingresar'])) {
    $correo    = mysqli_real_escape_string($enlace, trim($_POST['correo']));
    $contrasena= mysqli_real_escape_string($enlace, $_POST['contrasena']);

    $sql  = "SELECT nombre_apellido, password FROM registro WHERE correo='$correo' LIMIT 1";
    $res  = mysqli_query($enlace, $sql);

    if ($res && mysqli_num_rows($res)==1) {
        $row = mysqli_fetch_assoc($res);

        // Comparación texto plano
        if ($contrasena === $row['password']) {
            // ② Guardamos el nombre en la sesión
            $_SESSION['usuarios'] = $row['nombre_apellido'];
            header("Location: mi_cuenta.html");
            exit;
        } else {
            echo "<script>alert('Contraseña incorrecta.'); history.back();</script>";
            exit;
        }
    } else {
        echo "<script>alert('No existe una cuenta con ese correo.'); history.back();</script>";
        exit;
    }
}

mysqli_close($enlace);
?>
