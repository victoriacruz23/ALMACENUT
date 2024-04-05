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
// csrf Token 
if (!isset($_POST['csrf_token']) && !isset($_SESSION['csrf_token'])) {
    $ip = $_SERVER['REMOTE_ADDR']; // Obtener la dirección IP del usuario
    // Mensaje de bloqueo
    $response = array("respuesta" => false, "icon" => "error", "message" => "Acceso denegado. Su IP ($ip) ha sido registrada.");
    echo json_encode($response);
    exit();
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
$correo = $conexion->real_escape_string(filter_var($_POST["correo"], FILTER_SANITIZE_EMAIL));
$contra = $conexion->real_escape_string(filter_var($_POST["contra"], FILTER_SANITIZE_STRING));
$contra2 = $conexion->real_escape_string(filter_var($_POST["contra2"], FILTER_SANITIZE_STRING));

if ($contra === $contra2) {
    // Insertar la nueva categoría en la base de datos
    $consulta = $conexion->query("SELECT * FROM usuario WHERE correo = '$correo'");
    if ($consulta->num_rows == 1) {
        $datos = $consulta->fetch_assoc();
        $contr = $datos['contrasena'];
        $nombre = $datos['nombre'];
        $apellidos = $datos['apellido_p'];
        $incriptaPass = password_hash($contra2, PASSWORD_BCRYPT);
        $stmt = $conexion->prepare("UPDATE usuario SET contrasena = ? WHERE correo = ?");
        $stmt->bind_param("si", $incriptaPass, $correo);
        $stmt->execute();
        if ($stmt->affected_rows == 1) {
            $response = array("respuesta" => true, "icon" => "success", "message" => "$nombre $apellidos Tu contraseña se actualizo correctamente");
        } else {
            $response = array("respuesta" => false, "icon" => "error", "message" => "Error al actualizar la scontraseña");
        }
        $stmt->close();
    } else {
        $response = array("respuesta" => false, "icon" => "error", "message" => "Error al registrar");
    }
} else {
    $response = array("respuesta" => false, "icon" => "error", "message" => "Tu contraseñas no coiciden");
}
$conexion->close();
echo json_encode($response);
