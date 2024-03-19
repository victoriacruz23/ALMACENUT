<?php
require_once("validacion.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Almacen UT Categorias</title>
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
    $breadcrumb->addCrumb('Requisiciones');

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
    <?php
     require '../forms/footer.php';
    ?>

</body>

</html>