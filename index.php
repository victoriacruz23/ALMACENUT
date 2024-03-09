<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Loguin Almacen UT</title>
  <?php require_once("forms/linkscss.php"); ?>
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

  <main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

              <div class="d-flex justify-content-center py-4">
                <a href="index.php" class="logo d-flex align-items-center w-auto">
                  <img src="assets/img/img/logo.png" alt="" width="50">
                  <span class="d-none d-lg-block">Almacen UTA</span>
                </a>
              </div><!-- End Logo -->

              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Ingrese su cuenta</h5>
                    <p class="text-center small">Ingrese su nombre de usuario y contraseña para iniciar sesión</p>
                  </div>

                  <form id="formsesion" method="POST" class="row g-3 needs-validation" novalidate>
                    <div class="col-12">
                      <label for="correo" class="form-label">Correo</label>
                      <div class="input-group has-validation">
                        <div class="input-group mb-3">
                          <input type="text" class="form-control" id="correo" name="correo" placeholder="correo" aria-label="correo">
                          <span class="input-group-text">@utacapulco.edu.mx</span>
                        </div>
                        <p class="text-danger d-none" id="mesaje_correo">!Valide su correo!</p>
                      </div>
                    </div>
                    <div class="col-12">
                      <label for="Contraseña" class="form-label">Contraseña</label>
                      <input type="password" name="contra" class="form-control" id="contra" required>
                      <p class="text-danger d-none" id="mesaje_contra">!Valide su contraseña!</p>
                    </div>
                    <div class="col-12" id="">
                      <button class="btn btn-primary w-100 disabled" id="btnsesion" onclick="inicioSesion(event);">Iniciar</button>
                    </div>
                  </form>
                  <div class="col-12" style="margin-top: 10px;">
                    <?php
                    include('config.php');
                    $google_client = $google_client2;
                    if (isset($_GET["code"])) {
                      $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);
                      if (!isset($token['error'])) {
                        $google_client->setAccessToken($token['access_token']);
                        $google_service = new Google_Service_Oauth2($google_client);
                        $data = $google_service->userinfo->get();
                      }
                    }
                    ?>
                    <a href="<?php echo $google_client->createAuthUrl(); ?>" class="btn btn-outline-success w-100"> <img src="assets/img/icon-google.svg" alt="Descripción del SVG"> Inicia sesion con google</a>
                  </div>
                  <div class="col-12">
                    <p class="small mb-0">¿No tienes cuenta?<a href="registro">Crea una cuenta</a></p>
                  </div>
                </div>
              </div>

              <div class="credits">
                <!-- All the links in the footer should remain intact. -->
                <!-- You can delete the links only if you purchased the pro version. -->
                <!-- Licensing information: https://bootstrapmade.com/license/ -->
                <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
                Diseñada por<a href="#"> Victoria Cruz</a>
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
  <script src="assets/js/expresesion.js"></script>

</body>

</html>