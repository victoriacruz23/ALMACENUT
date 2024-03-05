<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Registro Almacen UT</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">
  <!-- =======================================================
  * Template Name: NiceAdmin
  * Updated: Mar 09 2023 with Bootstrap v5.2.3
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
  <style>
    body {
      background-image: url(imgpro/gastro.png);
      background-size: cover;
      background-repeat: no-repeat;
      background-position: center;
      background-attachment: fixed;
    }
  </style>
</head>

<body>
  <?php
  if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    require_once('database/conexion.php');
    include('config.php');
    if (isset($_GET["code"])) {
      $google_client= $google_client1;
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
            header("Location: registro?correo=" . urlencode($correo));
            exit(); // Asegura que no se ejecuten más instrucciones después de la redirección
          }
        }
        if (!empty($data['given_name'])) {
          $nombre = $data['given_name'];
        }
        if (!empty($data['family_name'])) {
          $apellidos = $data['family_name'];
        }
        if (!empty($data['gender'])) {
          $genero = $data['gender'];
        }

        if (!empty($data['picture'])) {
          $imagen = $data['picture'];
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

  ?>
  <main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

              <div class="d-flex justify-content-center py-4">
                <a href="index.php" class="logo d-flex align-items-center w-auto">
                  <img src="assets/img/img/logo.png" alt="" width="50">
                  <span class="d-none d-lg-block">Almacen UT</span>
                </a>
              </div><!-- End Logo -->

              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4"> Crea una cuenta </h5>
                    <p class="text-center small">Ingrese sus datos personales para crear una cuenta</p>
                  </div>

                  <form method="POST" id="formregistro" class="row g-3 needs-validation" enctype="multipart/form-data">
                    <div class="col-12" style="justify-content: centers;">
                      <img src="<?php echo $imagen ?>" class="img-responsive img-circle img-thumbnail" />
                      <p class="text-center small">¡Esta imagen es temportal, debes asignar una imagen al inciar sesion!</p>
                    </div>
                    <div class="col-12">
                      <label for="Name" class="form-label">Nombre</label>
                      <p class="form-control"><?php echo $nombre ?> </p>
                      <input type="hidden" value="<?php echo $nombre ?>" name="nombre" id="nombre" required>
                    </div>
                    <div class="col-12">
                      <label for="apellidop" class="form-label">Apellidos</label>
                      <p class="form-control"><?php echo $apellidos ?></p>
                      <input type="hidden" name="apellidop" value="<?php echo $apellidos ?>" id="apllidop" required>
                    </div>
                    <div class="col-12">
                      <label for="Email" class="form-label">Correo Electronico</label>
                      <input type="hidden" name="email" value="<?php echo $correo; ?>" id="email" required>
                      <p class="form-control"><?php echo $correo; ?></p>
                    </div>
                    <div class="col-12">
                      <label for="Password" class="form-label">Contraseña</label>
                      <input type="password" name="pass" class="form-control" id="pass" required>
                      <p class="text-danger d-none" id="mesaje_pass">¡Por favor, introduzca su contraseña!, Debe contener como mínimo una mayúscula, un numero y mas de 6 caracteres.<span><i class="bi bi-backspace"></i></span></p>
                    </div>
                    <div class="col-12">
                      <label for="Password" class="form-label">Confirmar Contraseña</label>
                      <input type="password" name="pass2" class="form-control" id="pass2" required>
                      <p class="text-danger d-none" id="mesaje_pass2">¡Por favor, introduzca la confirmacion su contraseña!, Debe contener como mínimo una mayúscula, un numero y mas de 6 caracteres.<span><i class="bi bi-backspace"></i></span></p>
                    </div>
                    <div class="col-12">
                      <label for="rol" class="form-label">Seleccione un perfil</label>
                      <select class="form-select" aria-label="Default select example" id="rol" name="rol" required>
                        <option value="0" disabled selected>Seleciona un perfil</option>
                        <option value="1">Almacenista</option>
                        <option value="2">Alumno</option>
                      </select>
                    </div>
                    <div class="col-12">
                      <label for="img" class="form-label">Seleccione una foto para su perfil</label>
                      <input type="file" name="img" class="form-control" id="img" accept=".jpg, .jpeg, .png" required>
                      <p class="text-danger d-none" id="mesaje_img">El campo teléfono debe contener 10 caracteres.<span><i class="bi bi-backspace"></i></span></p>
                    </div>
                    <div class="col-12">
                      <div class="form-check">
                        <input class="form-check-input" name="terms" type="checkbox" value="" id="terminos" required>
                        <label class="form-check-label" for="terminos">Estoy de acuerdo y acepto los <a href="#">términos y condiciones</a>, es obligatorio.</label>
                      </div>
                    </div>
                    <div class="col-12" id="">
                      <button class="btn btn-primary w-100 disabled" id="btnregistro" onclick="registroDatos(event);">Crear cuenta</button>
                    </div>
                    <div class="col-12">
                      <p class="small mb-0">¿Ya tienes una cuenta? <a href="index.php">Iniciar Sesión</a></p>
                    </div>
                  </form>
                </div>
              </div>

              <div class="credits">
                <!-- All the links in the footer should remain intact. -->
                <!-- You can delete the links only if you purchased the pro version. -->
                <!-- Licensing information: https://bootstrapmade.com/license/ -->
                <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
                Diseñado por <a href="#">Victoria Cruz</a>
              </div>

            </div>
          </div>
        </div>

      </section>

    </div>
  </main><!-- End #main -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.min.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="assets/js/expresionesregistro.js"></script>

</body>

</html>