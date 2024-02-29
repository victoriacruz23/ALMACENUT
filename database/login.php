<?php
session_start();
include 'conexion.php';

if($_SERVER[ "REQUEST_METHOD"] == "POST"){
    $correo = $_POST['correo'];
    $pass = $_POST['contra'];

    $ingreso = "SELECT * FROM usuario WHERE correo = '$correo' AND contrasena ='$pass'";
    $respuesta = $conexion->query($ingreso);

    if($respuesta->num_rows == 1){
        $_SESSION["correo"] = $correo;

        echo "
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <script language='JavaScript'>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                title: 'Usuario y contraseña correctos',
                text: 'Bienvenido al sistema: " . $correo . "',
                icon: 'success',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'OK',
              }).then(() => {
                location.assign('../almacenista/home.php');
            });
        });
        </script>";
        exit();
    } elseif($respuesta->num_rows == 2) {
        $_SESSION["correo"] = $correo;

        echo "
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <script language='JavaScript'>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                title: 'Usuario y contraseña correctos',
                text: 'Bienvenido al sistema: " . $correo . "',
                icon: 'success',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'OK',
              }).then(() => {
                location.assign('../alumnos/home.php');
            });
        });
        </script>";
        exit();
    }else{

        $mensajeError = "Usuario o contraseña incorrectos";
    }
   
} 
mysqli_close($conexion);

?>

