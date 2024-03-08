<?php
session_start();
// Verificar si el usuario ha iniciado sesión
if(!isset($_SESSION['datosuser'])){
    header("Location: inicio");
    exit();
} 

// if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
//     $response = array("success" => false, "message" => "Acceso denegado");
//     echo json_encode($response);
//     exit();
// }