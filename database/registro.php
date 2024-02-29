<?php
include 'conexion.php';

$nombre = $_POST['nombre'];
$ape1 = $_POST['apellidop'];
$ape2 = $_POST['apellidom'];
$correo = $_POST['email'];
$pass = $_POST['pass'];
$rol = $_POST['rol'];
$img = $_FILES['img'];

$queryname = "SELECT * FROM usuario  WHERE correo= '$correo'";
$result = $conexion->query($queryname);

if ($result->num_rows > 0) {
    echo "
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <script language='JavaScript'>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                title: 'Error',
                text: 'El usuario ya esta en uso, por favor ingresa otro',
                icon: 'error',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'OK',
              }).then(() => {
                location.assign('../register.php');
            });
        });
    </script>";
    exit;
}

$tmp = $img['tmp_name'];
$directorio = "../assets/img/img";

$file = $img['name'];
$type = $img['type'];

if (((strpos($type, "jpeg") || strpos($type, "jpg") || strpos($type, "png")))) {

    $destino = $directorio . '/' . $file;
    $query = "INSERT INTO usuario(nombre, apellido_p, apellido_m, correo, contrasena, rol_id, imagen) 
            VALUES ('$nombre','$ape1','$ape2','$correo','$pass','$rol','$destino')";
    if ($conexion->query($query) === TRUE) {
        if ($rol == 1) {
            echo "
                <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
                <script language='JavaScript'>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        title: 'Registro exitoso',
                        text: 'Bienvenido al sistema: " . $nombre . "',
                        icon: 'success',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'OK',
                      }).then(() => {
                        location.assign('../index.php');
                    });
                });
                </script>";
        } elseif ($rol == 1) {
            echo "
                <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
                <script language='JavaScript'>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        title: 'Registro exitoso',
                        text: 'Bienvenido al sistema: " . $nombre . "',
                        icon: 'success',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'OK',
                      }).then(() => {
                        location.assign('../index.php');
                    });
                });
              </script>";
        } else {

            echo "No se encontro el perfil";       
        }
    }else{
        echo "Error al registrar: " . $conexion->error;
    }

    if(move_uploaded_file($tmp, $destino)){
        return true;
    }
        return false;
}else{
    echo "
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <script language='JavaScript'>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                title: 'Error',
                text: 'No se acepta este tipo de formato',
                icon: 'error',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'OK',
              }).then(() => {
                location.assign('../index.php');
            });
        });
    </script>";
}

$conexion->close();
?>