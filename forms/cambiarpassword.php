<?php
session_start();
require_once("../database/conexion.php");
// Validar el método de solicitud
if ($_SERVER['REQUEST_METHOD'] !== 'GET' ) {
    header("Location: 403");
    exit;
}


if(isset($_GET['token']) && isset($_GET['correo'])) {
    // Paso 2: Sanitizar las variables
    $token = mysqli_real_escape_string($conexion, filter_var($_GET['token'],FILTER_SANITIZE_STRING));
    $correo = mysqli_real_escape_string($conexion, filter_var($_GET['correo'],FILTER_SANITIZE_EMAIL));

    // Paso 3: Realizar búsqueda en la tabla usuario
    $consulta = $conexion->query("SELECT * FROM usuario WHERE correo = '$correo' AND token = '$token'");
    if($consulta->num_rows == 1) {
        // Paso 4: Actualizar el campo token
        $update_token = $conexion->query("UPDATE usuario SET token = NULL WHERE correo = '$correo'");

    } else {
        header("Location: 404");
        exit;
    }
} else {
    // header("Location: inicio");
    echo "ND";
    exit;
}
require "../database/csrf_toke.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Loguin Almacen UT</title>
    <?php require_once("../forms/linkscss.php"); ?>
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
                                        <h5 class="card-title text-center pb-0 fs-4">Cambio de contraseña</h5>
                                        <p class="text-center small">Ingresa tus contraseñas</p>
                                    </div>
                                    <form id="formsesion" method="POST" class="row g-3 needs-validation" novalidate>
                                        <input type="text" name="csrf_token" id="csrf_token" value="<?php echo $csrf_token = set_csrf_token(); ?>">
                                        <input type="text" name="correo" id="correo" value="<?php echo $correo; ?>">
                                        <div class="col-12">
                                            <label for="contra" class="form-label">Contraseña</label>
                                            <div class="input-group">
                                                <input type="password" name="contra" class="form-control" id="contra" required>
                                                <button class="btn btn-outline-secondary" type="button" onclick="togglePasswordVisibility('contra')">
                                                    <i class="bi bi-eye"></i>
                                                </button>
                                            </div>
                                            <p class="text-danger d-none" id="mesaje_contra">¡Por favor, introduzca su contraseña!, Debe contener como mínimo una mayúscula, un numero y mas de 6 caracteres.<span><i class="bi bi-backspace"></i></span></p>
                                        </div>
                                        <div class="col-12">
                                            <label for="contra2" class="form-label">Confirmacion contraseña</label>
                                            <div class="input-group">
                                                <input type="password" name="contra2" class="form-control" id="contra2" required>
                                                <button class="btn btn-outline-secondary" type="button" onclick="togglePasswordVisibility('contra2')">
                                                    <i class="bi bi-eye"></i>
                                                </button>
                                            </div>
                                            <p class="text-danger d-none" id="mesaje_contra2">¡Por favor, introduzca la confirmacion su contraseña!, Debe contener como mínimo una mayúscula, un numero y mas de 6 caracteres.<span><i class="bi bi-backspace"></i></span></p>
                                        </div>
                                    
                                        <div class="col-12" id="">
                                            <button class="btn btn-primary w-100 disabled" id="btnsesion" onclick="inicioSesion(event);">Cambiar contraseña</button>
                                        </div>

                                    </form>
                                    <div class="col-12">
                                        <p class="small mb-0">¿Ya estas registrado?<a href="inicio">Iniciar sesion</a></p>
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
    <script src="assets/js/cambiocontracorreo.js"></script>

</body>

</html>