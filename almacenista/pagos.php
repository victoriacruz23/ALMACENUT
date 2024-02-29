<?php
require '../database/validarsesion.php';
require '../forms/menu.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Almacen UT</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="../assets/img/img/logo.png" rel="icon">
    <link href="../assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="../assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="../assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="../assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="../assets/vendor/simple-datatables/style.css" rel="stylesheet">
    <!-- Template Main CSS File -->
    <link href="../assets/css/style.css" rel="stylesheet">
</head>

<body>
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Pagos</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="home.php">Inicio</a></li>
                    <li class="breadcrumb-item active">Pagos</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section dashboard">
            <div class="row">

                <!-- Left side columns -->
                <div class="col-lg-12">
                    <div class="row">

                        <!-- Top Selling -->
                        <div class="col-12">
                            <div class="card top-selling overflow-auto">

                                <div class="card-body pb-0">
                                    <h5 class="card-title">Pagos <span>| Today</span></h5>
                                    <div class="card-body pb-0">
                                        <form>
                                            <div class="form-group mb-3">
                                                <label for="nombre">Nombre en la Tarjeta</label>
                                                <input type="text" class="form-control" id="nombre" placeholder="Ingrese el nombre en la tarjeta">
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="numero">Número de Tarjeta</label>
                                                <input type="text" class="form-control" id="numero" placeholder="Ingrese el número de tarjeta">
                                            </div>
                                            <div class="form-row mb-3">
                                                <div class="form-group col-md-6 mb-3">
                                                    <label for="fecha">Fecha de Vencimiento</label>
                                                    <input type="text" class="form-control" id="fecha" placeholder="MM/AA">
                                                </div>
                                                <div class="form-group col-md-6 mb-3">
                                                    <label for="cvv">CVV</label>
                                                    <input type="text" class="form-control" id="cvv" placeholder="Ingrese el CVV">
                                                </div>
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="direccion">Dirección de Facturación</label>
                                                <input type="text" class="form-control" id="direccion" placeholder="Ingrese la dirección de facturación">
                                            </div>
                                            <button type="submit" class="btn btn-primary">Pagar</button>
                                        </form>

                                    </div>


                                </div>

                            </div>
                        </div><!-- End Top Selling -->

                    </div>
                </div><!-- End Left side columns -->

                <!-- Right side columns -->
                <div class="col-lg-4">

                </div><!-- End Right side columns -->

            </div>
        </section>

    </main><!-- End #main -->

    <?php
    require '../forms/footer.php';
    ?>

    <!-- Vendor JS Files -->
    <script src="../assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/vendor/chart.js/chart.umd.js"></script>
    <script src="../assets/vendor/echarts/echarts.min.js"></script>
    <script src="../assets/vendor/quill/quill.min.js"></script>
    <script src="../assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="../assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="../assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="../assets/js/main.js"></script>
</body>


</html>