<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $ip = $_SERVER['REMOTE_ADDR']; // Obtener la dirección IP del usuario
    // Mensaje de bloqueo
    $response = array("success" => false, "message" => "Acceso denegado. Su IP ($ip) ha sido registrada.");
    echo json_encode($response);
    exit();
}

include 'conexion.php';
include 'csrf_toke.php';
include 'enviarcorreo.php';
// csrf Token 
if (!isset($_POST['csrf_token']) && !isset($_SESSION['csrf_token'])) {
    $ip = $_SERVER['REMOTE_ADDR']; // Obtener la dirección IP del usuario
    // Mensaje de bloqueo
    $response = array("respuesta" => false, "icon" => "error", "message" => "Acceso denegado. Su IP ($ip) ha sido registrada.");
    // echo json_encode($response);
    // exit();
}
$post_token  = $conexion->real_escape_string(filter_var($_POST["csrf_token"], FILTER_SANITIZE_STRING));
$sesion_token = $_SESSION['csrf_token'];
$validaToken = validateToken($post_token, $sesion_token);
if ($validaToken == false) {
    $response = array("respuesta" => false, "icon" => "error", "message" => "CRSF TOKEN INVALIDO");
    echo json_encode($response);
    exit;
}
// csrf Token 
$correo = $conexion->real_escape_string(filter_var($_POST["correo"], FILTER_SANITIZE_STRING));
$correovalido = filter_var($correo . "@utacapulco.edu.mx", FILTER_SANITIZE_EMAIL);
if (filter_var($correovalido, FILTER_VALIDATE_EMAIL)) {
    // Puedes usar $correoCompleto en tu lógica de aplicación o en consultas SQL
    $consulta = $conexion->query("SELECT * FROM usuario WHERE correo = '$correovalido' AND token IS NULL");
    if ($consulta->num_rows == 1) {
        // var_dump($consulta->fetch_assoc());
        $datos = $consulta->fetch_assoc();
        $id_usuario = $datos['id_usuario'];
        $correo = $datos['correo'];
        $nombre = $datos['nombre'];
        $apellidos = $datos['apellido_p'];
        $nombreCompleto = $nombre . " " . $apellidos;
        $gntoken = md5(uniqid(rand(), true));
        $actualizarToken = $conexion->query("UPDATE usuario SET token='$gntoken' WHERE id_usuario = '$id_usuario'");
        $correoenviado = cambiocontra($correo, $nombreCompleto, $gntoken);
        if ($correoenviado == true) {
            $response = array("respuesta" => true, "icon" => "success", "message" => "$nombreCompleto El correo de recuperación fue enviado");
        } else {
            $response = array("respuesta" => false, "icon" => "error", "message" => "$nombreCompleto Existio un error al enviar el correo");
        }
    } else {
        // La dirección de correo electrónico no es válida
        $response = array("respuesta" => false, "icon" => "error", "message" => "$correovalido Probablemente ya cuentas con una solicitud de cambio, revisa tu correo");
    }
} else {
    // La dirección de correo electrónico no es válida
    $response = array("respuesta" => false, "icon" => "error", "message" => "Error con el correo $correovalido");
}
$conexion->close();
echo json_encode($response);
