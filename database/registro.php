<?php
// Validar el método de solicitud
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $ip = $_SERVER['REMOTE_ADDR']; // Obtener la dirección IP del usuario

    // Mensaje de bloqueo
    $response = array("success" => false, "message" => "Acceso denegado. Su IP ($ip) ha sido registrada.");

    // Puedes agregar lógica adicional para registrar la IP y tomar medidas
    // como bloquearla en una base de datos o realizar otras acciones necesarias.

    echo json_encode($response);
    exit();
}
// var_dump($_POST);
exit;
include 'conexion.php';

$nombre = filter_var($conexion->real_escape_string($_POST['nombre']),FILTER_SANITIZE_STRING);
$ape1 = filter_var($conexion->real_escape_string($_POST['apellidop']),FILTER_SANITIZE_STRING);
$ape2 = filter_var($conexion->real_escape_string($_POST['apellidom']),FILTER_SANITIZE_STRING);
$correo = filter_var($conexion->real_escape_string($_POST['email']),FILTER_SANITIZE_EMAIL);
$pass = filter_var($conexion->real_escape_string($_POST['pass']),FILTER_SANITIZE_STRING);
$rol = filter_var($conexion->real_escape_string($_POST['rol']),FILTER_SANITIZE_NUMBER_INT);
$img = $_FILES['img'];

$queryname = "SELECT * FROM usuario  WHERE correo= '$correo'";
$result = $conexion->query($queryname);

if ($result->num_rows > 0) {
  
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