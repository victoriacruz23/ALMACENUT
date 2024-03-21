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

// Obtener el nombre de la categoría del formulario
$catego = $conexion->escape_string(filter_var($_POST["catego"], FILTER_SANITIZE_STRING));

// Consulta para verificar si ya existe la categoría
$consulta = $conexion->query("SELECT * FROM areas WHERE nombre = '$catego'");

// Verificar si la categoría ya existe
if ($consulta->num_rows == 0) {
    // Insertar la nueva categoría en la base de datos
    $stmt = $conexion->prepare("INSERT INTO areas(nombre) VALUES (?)");
    $stmt->bind_param("s", $catego);
    $stmt->execute();
    if ($stmt->affected_rows == 1) {
        $response = array("respuesta" => true, "icon" => "success", "message" => "El área se agregó correctamente $catego");
    } else {
        $response = array("respuesta" => false, "icon" => "error", "message" => "Error al registrar, por favor ingresa otra. $catego");
    }
    $stmt->close();
} else {
    $response = array("respuesta" => false, "icon" => "error", "message" => "El área ya existe, por favor ingresa otra. $catego");
}
$conexion->close();
echo json_encode($response);
