<?php
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    require_once('../database/conexion.php');
    include('../config.php');
    if (isset($_GET["code"])) {
      $google_client= $google_client2;
      $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);
      if (!isset($token['error'])) {
        $google_client->setAccessToken($token['access_token']);
        $_SESSION['access_token'] = $token['access_token'];
        $google_service = new Google_Service_Oauth2($google_client);
        $data = $google_service->userinfo->get();

        if (!empty($data['email'])) {
          $correo = $data['email'];
          $consulta = $conexion->query("SELECT * FROM usuario WHERE correo = '$correo'");
          if ($consulta->num_rows > 0) {
                  // var_dump($consulta->fetch_assoc());
                 $datos = $consulta->fetch_assoc();
                 $idrol = $datos['rol_id'];
                 $nombre = $datos['nombre'];
                 $apellidos = $datos['apellido_p'];

                if($idrol == 1){
                  header("Location: inicio-almacenista?nombre=" . urlencode("$nombre $apellidos"));
                } else if($idrol == 2){
                  header("Location: inicio-alumnos?nombre=" . urlencode("$nombre $apellidos"));
               }

                 exit(); // Asegura que no se ejecuten más instrucciones después de la redirección
          }
        }
       
      
      } else {
        // Redireccionar a otro documento para evitar errores
        header("Location: registro");
        exit();
      }
    } else {
      header("Location: registro");
      exit();
    }
  } else {
    header("Location: registro");
    exit();
  }