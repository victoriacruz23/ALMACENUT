<?php
// Validar el método de solicitud
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $ip = $_SERVER['REMOTE_ADDR']; // Obtener la dirección IP del usuario

    // Mensaje de bloqueo
    $response = array("success" => false, "message" => "Acceso denegado. Su IP ($ip) ha sido registrada.");

    // Puedes agregar lógica adicional para registrar la IP y tomar medidas
    // como bloquearla en una base de datos o realizar otras acciones necesarias.

    echo json_encode($response);
    exit();
}
// var_dump($_POST);
// exit;
include 'conexion.php';

$nombre = filter_var($conexion->real_escape_string($_POST['nombre']),FILTER_SANITIZE_STRING);
$ape1 = filter_var($conexion->real_escape_string($_POST['apellidop']),FILTER_SANITIZE_STRING);
$correo = filter_var($conexion->real_escape_string($_POST['email']),FILTER_SANITIZE_EMAIL);
$pass = filter_var($conexion->real_escape_string($_POST['pass']),FILTER_SANITIZE_STRING);
$rol = filter_var($conexion->real_escape_string($_POST['rol']),FILTER_SANITIZE_NUMBER_INT);
$img = $_FILES['img'];
$result = $conexion->query( "SELECT * FROM usuario  WHERE correo= '$correo'");
if ($result->num_rows > 0) {
    $response = array("respuesta" => "existe","icon" => 'error', "message" => "El usuario ya existe");
    echo json_encode($response);
    exit();
    exit;
}

$tmp = $img['tmp_name'];
$file = $img['name'];
$type = $img['type'];
if (!(strpos($type, "jpeg") || strpos($type, "jpg") || strpos($type, "png"))) {
    $response = array("respuesta" => false, "icon" => "warning", "message" => "Debes seleccionar un formato de imagen adecuado. (PNG, JPG, JPEG)");
    echo json_encode($response);
    exit();
}
if($rol != 1 && $rol != 2){
    $response = array("respuesta" => false, "icon" => "error", "message" => "Valida el tipo de rol deseado");
    echo json_encode($response);
    exit();
}
$directorio = "../assets/img/fotosperfil";
if (!is_dir($directorio)) {
    mkdir($directorio);
}
$nombreImg = md5(uniqid(rand(), true)) . ".jpg";
move_uploaded_file($img["tmp_name"], $directorio . $nombreImg);
$incriptaPass = password_hash($pass, PASSWORD_BCRYPT);
$stmt = $conexion->prepare("INSERT INTO usuario(nombre, apellido_p, correo, contrasena, rol_id, imagen) 
VALUES (?,?,?,?,?,?)");
$stmt->bind_param("ssssis",$nombre,$ape1,$correo,$incriptaPass,$rol,$nombreImg);
$stmt->execute();
if($stmt->affected_rows == 1) {
    $response = array("respuesta" => 'registrado',"icon" => "success", "message" => "El usuario se registro correctamente $correo");
}else{
    $response = array("respuesta" => false,"icon" => "error", "message" => "Error al registrar el correo $correo");
}
$stmt->close();
$conexion->close();
echo json_encode($response);
