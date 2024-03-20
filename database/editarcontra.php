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
$id = $_SESSION['datosuser']['id'];
$currentPassword = $conexion->real_escape_string(filter_var($_POST["currentPassword"], FILTER_SANITIZE_STRING));
$newpassword = $conexion->real_escape_string(filter_var($_POST["newpassword"], FILTER_SANITIZE_STRING));
$renewpassword = $conexion->real_escape_string(filter_var($_POST["renewpassword"], FILTER_SANITIZE_STRING));

if ($newpassword === $renewpassword) {
    // Insertar la nueva categoría en la base de datos
    $consulta = $conexion->query("SELECT * FROM usuario WHERE id_usuario = '$id'");
    if ($consulta->num_rows == 1) {
        $datos = $consulta->fetch_assoc();
        $contr = $datos['contrasena'];
        $nombre = $datos['nombre'];
        $apellidos = $datos['apellido_p'];
        if (password_verify($currentPassword, $contr)) {
            $incriptaPass = password_hash($newpassword, PASSWORD_BCRYPT);
            $stmt = $conexion->prepare("UPDATE usuario SET contrasena = ? WHERE id_usuario = ?");
            $stmt->bind_param("si", $incriptaPass, $id);
            $stmt->execute();
            if ($stmt->affected_rows == 1) {
                $response = array("respuesta" => true, "icon" => "success", "message" => "$nombre $apellidos Tu contraseña se actualizo correctamente");
            } else {
                $response = array("respuesta" => false, "icon" => "error", "message" => "Error al actualizar la scontraseña");
            }
            $stmt->close();
        } else {
            $response = array("respuesta" => false, "icon" => "error", "message" => "$nombre $apellidos Revisa tu contraseña");
        }
    } else {
        $response = array("respuesta" => false, "icon" => "error", "message" => "Error al registrar");
    }
} else {
    $response = array("respuesta" => false, "icon" => "error", "message" => "Tu contraseñas no coiciden");
}
$conexion->close();
echo json_encode($response);
