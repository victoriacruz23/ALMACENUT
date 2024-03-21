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
$password = $conexion->real_escape_string(filter_var($_POST["contra"], FILTER_SANITIZE_STRING));
$correo = $conexion->real_escape_string(filter_var($_POST["correo"], FILTER_SANITIZE_STRING));
$correovalido = filter_var($correo . "@utacapulco.edu.mx", FILTER_SANITIZE_EMAIL);
if (filter_var($correovalido, FILTER_VALIDATE_EMAIL)) {
    // Puedes usar $correoCompleto en tu lógica de aplicación o en consultas SQL
    $consulta = $conexion->query("SELECT * FROM usuario WHERE correo = '$correovalido'");
    if ($consulta->num_rows > 0) {
        // var_dump($consulta->fetch_assoc());
        $datos = $consulta->fetch_assoc();
        $idrol = $datos['rol_id'];
        $nombre = $datos['nombre'];
        $apellidos = $datos['apellido_p'];
        $apellidos = $datos['apellido_p'];
        $contr = $datos['contrasena'];
        if (password_verify($password, $contr)) {
            $datos_validados = array(
                'id' => htmlspecialchars($datos['id_usuario']),
                'nombre' => htmlspecialchars($datos['nombre']),
                'apellidos' => htmlspecialchars($datos['apellido_p']),
                'correo' => htmlspecialchars($datos['correo']),
                'rol' => htmlspecialchars($datos['rol_id']),
                'img' => htmlspecialchars($datos['imagen']),
                // Otros campos que quieras incluir en la variable de sesión
            );
            $_SESSION['datosuser'] = $datos_validados;
            if ($idrol == 1) {
                $response = array("respuesta" => "almacen", "icon" => "success", "message" => "Bienvenido al sistema $nombre $apellidos");
            } else if ($idrol == 2) {
                $response = array("respuesta" => "alumno", "icon" => "success", "message" => "Bienvenido al sistema $nombre $apellidos");
            }
        } else {
            $response = array("respuesta" => false, "icon" => "error", "message" => "Revisa tu contraseña $correovalido");
        }
    } else {
        // La dirección de correo electrónico no es válida
        $response = array("respuesta" => false, "icon" => "error", "message" => "Error con el correo $correovalido");
    }
} else {
    // La dirección de correo electrónico no es válida
    $response = array("respuesta" => false, "icon" => "error", "message" => "Error con el correo $correovalido");
}
echo json_encode($response);
