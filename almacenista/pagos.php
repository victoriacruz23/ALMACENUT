<?php
require_once("validacion.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Almacen UT Pagos</title>
  <meta content="" name="description">
  <meta content="" name="keywords">
  <!-- Favicons -->
  <?php require_once("../forms/linkscss.php"); ?>
</head>

<body>

  <?php
  // require '../database/validarsesion.php';
  require '../forms/menusuperior.php';
  require '../forms/sidebar.php';
  ?>

  <main id="main" class="main">

    <?php
    include("../forms/migas.php");

    $breadcrumb = new Breadcrumb();
    // Agrega las migas de pan
    $breadcrumb->addCrumb('Alamacenista', '');
    $breadcrumb->addCrumb('Pagos');

    // Renderiza las migas de pan
    $breadcrumb->render();
    ?><!-- End Page Title -->

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
</body>


</html>