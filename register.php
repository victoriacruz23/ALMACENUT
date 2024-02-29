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
  body{
    background-image: url(imgpro/gastro.png);
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center;
    background-attachment: fixed;
}
  </style>
</head>

<body>

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

                  <form action="database/registro.php" method="POST" class="row g-3 needs-validation" novalidate enctype="multipart/form-data">
                    <div class="col-12">
                      <label for="Name" class="form-label">Nombre</label>
                      <input type="text" name="nombre" class="form-control" id="nombre" required>
                      <div class="invalid-feedback">¡Por favor, escriba su nombre!</div>
                    </div>
                    <div class="col-12">
                      <label for="apellidop" class="form-label">Apellido Paterno</label>
                      <input type="text" name="apellidop" class="form-control" id="apllidop" required>
                      <div class="invalid-feedback">¡Por favor, escriba su nombre!</div>
                    </div>
                    <div class="col-12">
                      <label for="apellidom" class="form-label">Apellido Materno</label>
                      <input type="text" name="apellidom" class="form-control" id="apellidom" required>
                      <div class="invalid-feedback">¡Por favor, escriba su nombre!</div>
                    </div>

                    <div class="col-12">
                      <label for="Email" class="form-label">Correo Electronico</label>
                      <input type="email" name="email" class="form-control" id="email" required>
                      <div class="invalid-feedback">¡Por favor, introduce una dirección de correo electrónico válida!</div>
                    </div>

                    <div class="col-12">
                      <label for="Password" class="form-label">Contraseña</label>
                      <input type="password" name="pass" class="form-control" id="pass" required>
                      <div class="invalid-feedback">¡Por favor, introduzca su contraseña!</div>
                    </div>
                    <div class="col-12">
                      <label for="rol" class="form-label">Seleciona un perfil</label>
                      <select class="form-select" aria-label="Default select example" name="rol">
                        <option value="1">Almacenista</option>
                        <option value="2">Alumno</option>
                      </select>
                    </div>
                    <div class="col-12">
                      <label for="img" class="form-label">Selecione una foto para su perfil</label>
                      <input type="file" name="img" class="form-control" id="img" required>
                    </div>

                    <div class="col-12">
                      <div class="form-check">
                        <input class="form-check-input" name="terms" type="checkbox" value="" id="acceptTerms" required>
                        <label class="form-check-label" for="acceptTerms">Estoy de acuerdo y acepto los<a href="#"> terminos  y condiciones</a></label>
                        <div class="invalid-feedback">Debes aceptar antes de enviar.</div>
                      </div>
                    </div>
                    <div class="col-12">
                      <button class="btn btn-primary w-100" type="submit">Crear cuenta</button>
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

</body>

</html>