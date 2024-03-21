<?php
require '../almacenista/validacion.php';

// Verificar el método de solicitud
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $ip = $_SERVER['REMOTE_ADDR']; // Obtener la dirección IP del usuario

    // Mensaje de bloqueo
    $response = array("success" => false, "message" => "Acceso denegado. Su IP ($ip) ha sido registrada.");

    // Puedes agregar lógica adicional para registrar la IP y tomar medidas
    // como bloquearla en una base de datos o realizar otras acciones necesarias.

    echo json_encode($response);
    exit();
}

include 'conexion.php';

$id_usuario = filter_var($conexion->real_escape_string($_POST['id']), FILTER_SANITIZE_STRING);
$nombre = filter_var($conexion->real_escape_string($_POST['fullName']), FILTER_SANITIZE_STRING);
$apellidos = filter_var($conexion->real_escape_string($_POST['lastName']), FILTER_SANITIZE_STRING);
$imagen = $_FILES['foto'];

// Actualizar nombre y apellidos
$stmt = $conexion->prepare("UPDATE usuario SET nombre=?, apellido_p=? WHERE id_usuario=?");
$stmt->bind_param("ssi", $nombre, $apellidos, $id_usuario);
$stmt->execute();

// Manejar la imagen de perfil si se proporciona
if ($imagen['size'] > 0) {
    // Verificar el tipo de archivo
    $permitidos = array('jpg', 'jpeg', 'png');
    $nombreArchivo = $imagen['name'];
    $extension = strtolower(pathinfo($nombreArchivo, PATHINFO_EXTENSION));
    if (!in_array($extension, $permitidos)) {
        $response = array("success" => false, "message" => "El formato de la imagen no es válido. Por favor, seleccione una imagen JPG, JPEG o PNG.");
        echo json_encode($response);
        exit();
    }

    // Mover el archivo al directorio de imágenes de perfil
    $directorio = "../assets/img/fotosperfil/";
    $rutaArchivo = $directorio . $nombreArchivo;
    move_uploaded_file($imagen['tmp_name'], $rutaArchivo);

    // Actualizar la ruta de la imagen en la base de datos
    $stmt = $conexion->prepare("UPDATE usuario SET imagen=? WHERE id_usuario=?");
    $stmt->bind_param("si", $nombreArchivo, $id_usuario);
    $stmt->execute();
}

// Comprobar si la actualización fue exitosa
if ($stmt->affected_rows > 0) {
    // Redirigir según el tipo de usuario
    $perfil = $_SESSION['datosuser']['rol'];
    if ($perfil == 1) {
        header("Location: /ALMACENUT/perfil-almacenista");
        exit();
    } else {
        header("Location: /ALMACEN/perfil-alumno");
        exit();
    }
} else {
    $response = array("success" => false, "message" => "No se realizaron cambios.");
}

$stmt->close();
$conexion->close();
echo json_encode($response);
?>
