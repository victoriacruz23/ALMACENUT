<?php
session_start();
// Verificar si el usuario ha iniciado sesión
if (isset($_SESSION['datosuser'])) {
    switch ($_SESSION['datosuser']['rol']) {
        case 1:
            header("Location: inicio-almacenista");
            exit;
            break;
        case 2:
            header("Location: inicio-alumnos");
            exit;
            break;
        default:
            break;
    }
} 

