<?php
session_start();
// Verificar si el usuario ha iniciado sesión
if (isset($_SESSION['datosuser'])) {
    switch ($_SESSION['datosuser']['rol']) {
        case 1:

            break;
        default:
             header("Location: 403");
            exit;
            break;
    }
}else{
    header("Location: 403");
    exit;
}