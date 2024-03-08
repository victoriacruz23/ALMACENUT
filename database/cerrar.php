<?php
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
session_start(); // Iniciar la sesión

// Verificar si el usuario está autenticado
if (isset($_SESSION['datosuser'])) {
    // Eliminar todas las variables de sesión
    $_SESSION = array();

    // Destruir la sesión
    session_destroy();

    // Responder con un mensaje de éxito
    $response = array('success' => true, 'message' => 'Cierre de sesión exitoso');
    echo json_encode($response);
} else {
    // Responder con un mensaje de error
    $response = array('success' => false, 'message' => 'No se pudo cerrar la sesión');
    echo json_encode($response);
}
}else{
        // Acceso denegado si no se utiliza el método POST
        $response = array("success" => false, "message" => "Acceso denegado");
        echo json_encode($response);
        exit();
}