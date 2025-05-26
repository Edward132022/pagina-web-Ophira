<?php
// Depuración: mostrar todos los errores
ini_set('display_errors', 1);
error_reporting(E_ALL);

// 1) Conexión a la base de datos
$host   = 'sql202.infinityfree.com';
$user   = 'if0_39047307';
$pass   = 'cy5DglojXTK';
$dbname = 'if0_39047307_usuarios';

$conn = new mysqli($host, $user, $pass, $dbname);
$conn->set_charset('utf8');

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// 2) Verificar que llegue un 'id'
if (!isset($_GET['id']) || !ctype_digit($_GET['id'])) {
    die("Parámetro 'id' inválido");
}
$id = (int)$_GET['id'];

// 3) Ejecutar la consulta preparada
$sql  = "SELECT imagen FROM articulo WHERE id = ?";
$stmt = $conn->prepare($sql);
if (!$stmt) {
    die("Error al preparar la consulta: " . $conn->error);
}
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows === 0) {
    die("No existe ningún artículo con ID = $id");
}
$stmt->bind_result($imagen);
$stmt->fetch();
$stmt->close();

// 4) Enviar la imagen
// Detectamos si 'imagen' contiene datos binarios largos o solo un nombre de archivo
if (strlen($imagen) > 100 && !preg_match('/\.(png|jpe?g|gif)$/i', $imagen)) {
    // Probablemente sea un BLOB: enviamos raw
    // Ajusta el tipo según tu contenido real: aquí asumimos PNG
    header('Content-Type: image/png');
    // Evitamos problemas de buffer
    if (ob_get_level()) ob_end_clean();
    echo $imagen;
    exit;
} else {
    // Probablemente sea un nombre de archivo: lo servimos desde disco
    $ruta = __DIR__ . '/imagenes/' . $imagen;
    if (!file_exists($ruta)) {
        header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found');
        die('Archivo de imagen no encontrado');
    }
    // Determinar el MIME según la extensión
    $ext = strtolower(pathinfo($ruta, PATHINFO_EXTENSION));
    switch ($ext) {
        case 'jpg':
        case 'jpeg': header('Content-Type: image/jpeg'); break;
        case 'gif':  header('Content-Type: image/gif');  break;
        default:     header('Content-Type: image/png');  break;
    }
    header('Content-Length: ' . filesize($ruta));
    // Limpiar buffers y enviar
    if (ob_get_level()) ob_end_clean();
    readfile($ruta);
    exit;
}

$conn->close();
