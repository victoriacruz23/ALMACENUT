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
            <h1>Requicisiones</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="home.php">Inicio</a></li>
                    <li class="breadcrumb-item active">Requicisiones</li>
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
                                    <h5 class="card-title">Requisición <span>| Today</span></h5>

                                    <div class="container mt-3">
                                        <!-- <form>
                                            <div class="mb-3">
                                                <label for="nombre" class="form-label">Nombre:</label>
                                                <input type="text" class="form-control" id="nombre" name="nombre" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="departamento" class="form-label">Departamento:</label>
                                                <input type="text" class="form-control" id="departamento" name="departamento" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="fecha" class="form-label">Fecha de Requisición:</label>
                                                <input type="date" class="form-control" id="fecha" name="fecha" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="descripcion" class="form-label">Descripción de la Requisición:</label>
                                                <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required></textarea>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Enviar Requisición</button>
                                        </form> -->
                                        <form action="guardar_producto.php" method="post">
                                            <div class="form-group">
                                                <label for="sku">SKU</label>
                                                <input type="text" class="form-control" id="sku" name="sku">
                                            </div>
                                            <div class="form-group">
                                                <label for="descripcion">Descripción del artículo</label>
                                                <input type="text" class="form-control" id="descripcion" name="descripcion">
                                            </div>
                                            <div class="form-group">
                                                <label for="talla">Talla</label>
                                                <input type="text" class="form-control" id="talla" name="talla">
                                            </div>
                                            <div class="form-group">
                                                <label for="color">Color</label>
                                                <input type="text" class="form-control" id="color" name="color">
                                            </div>
                                            <div class="form-group">
                                                <label for="material">Material</label>
                                                <input type="text" class="form-control" id="material" name="material">
                                            </div>
                                            <div class="form-group">
                                                <label for="precio">Precio</label>
                                                <input type="number" step="0.01" class="form-control" id="precio" name="precio">
                                            </div>
                                            <button type="submit" class="btn btn-primary">Guardar</button>
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


    <!-- Bootstrap Bundle with Popper -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
</body>

</html>