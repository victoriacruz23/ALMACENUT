<?php
session_start();

// Incluir el archivo de configuración para obtener la conexión PDO
require 'conexion.php';

// Verificar si existe una sesión de usuario
if(isset($_SESSION['correo'])) {
    // Destruir la sesión
    session_destroy();
    echo "
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <script language='JavaScript'>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                title: 'Cierre Existoso',
                text: 'La sesión fue cerrada',
                icon: 'success',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'OK',
              }).then(() => {
                location.assign('../index.php');
            });
        });
    </script>";
} else {
   echo "
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <script language='JavaScript'>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                title: 'Error',
                text: 'No hay ninguna sesión activa',
                icon: 'error',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'OK',
              }).then(() => {
                location.assign('../index.php');
            });
        });
    </script>";
}
?>
