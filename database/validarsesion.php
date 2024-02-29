<?php
include_once 'conexion.php';
session_start();
$varsesion = $_SESSION['correo'];

$consulta = mysqli_query($conexion, "SELECT * FROM usuario WHERE correo = '$varsesion'");
if (!$consulta) {
    die('Error en la consulta: ' . mysqli_error($conexion));
}
if (mysqli_num_rows($consulta) == 0) {
    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    <script language='JavaScript'>
    document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
            icon: 'error',
            title: 'NO TIENES ACCESO INICIE SESION ANTES',
            showCancelButton: false,
            confirmButtonColor: '#4c5dac',
            confirmButtonText: 'OK',
            timer: 1500
        }).then(() => {
            location.assign('../index.php');
        });
    });
</script>";
    die();
}

$valores = mysqli_fetch_assoc($consulta);
$img = $valores['imagen'];

mysqli_close($conexion);

if ($varsesion == null || $varsesion = '') {
    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    <script language='JavaScript'>
    document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
            icon: 'error',
            title: 'NO TIENES ACCESO INICIE SESION ANTES',
            showCancelButton: false,
            confirmButtonColor: '#4c5dac',
            confirmButtonText: 'OK',
            timer: 1500
        }).then(() => {
            location.assign('../index.php');
        });
    });
</script>";
    die();
}

 ?>