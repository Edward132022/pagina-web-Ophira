
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
    header("Location: index.php"); // Usuario normal
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
