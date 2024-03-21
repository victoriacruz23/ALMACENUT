<?php
session_start();
// Paso 1: Validar el método de envío
require_once('conexion.php');
if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    $response = array("success" => false, "message" => "Acceso denegado");
    echo json_encode($response);
    exit;
}
// Verificar si el usuario ha iniciado sesión
if (isset($_SESSION['datosuser'])) {
    switch ($_SESSION['datosuser']['rol']) {
        case 1:
            $sql = $conexion->query("SELECT * FROM areas");
            break;
        default:
            $response = array("success" => false, "message" => "Existio un error");
            echo json_encode($response);
            exit;
            break;
    }
}

$datos = array();
while ($fila = $sql->fetch_assoc()) {
    $datos[] = $fila;
}
// Codificar los datos en formato JSON
$json = json_encode($datos);
// Imprimir el resultado
echo $json;