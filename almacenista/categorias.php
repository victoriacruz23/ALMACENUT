<?php
require '../database/validarsesion.php';
require '../forms/menu.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Dashboard - NiceAdmin Bootstrap Template</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

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

  <!-- =======================================================
  * Template Name: NiceAdmin
  * Updated: Mar 09 2023 with Bootstrap v5.2.3
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Categorias</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="home.php">Inicio</a></li>
          <li class="breadcrumb-item active">Categorias</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-12">
          <div class="row">
            <!-- Recent Sales -->
            <div class="col-12">
              <div class="card recent-sales overflow-auto">
                <div class="card-body">
                  <h5 class="card-title">Categorias Existentes <span>| Today</span></h5>
                  <!-- Agregar un botón para abrir el modal -->
                  <button type="button" class="btn btn-primary float-end" style="margin-top: -50px;" data-bs-toggle="modal" data-bs-target="#NuevaCategoria">
                    Agregar Categoría
                  </button>
                  <?php
                  require '../database/conexion.php';

                  $query = "SELECT * FROM areas";
                  $resultado = mysqli_query($conexion, $query);
                  
                  // Verificar si hay resultados
                  if (mysqli_num_rows($resultado) > 0) {
                      // Mostrar la tabla HTML
                      echo '<table class="table table-borderless datatable">
                              <thead>
                                <tr>
                                  <th scope="col">Número de categoria</th>
                                  <th scope="col">Categoria</th>
                                </tr>
                              </thead>
                              <tbody>';
                  
                      // Iterar sobre los resultados y mostrar cada fila en la tabla
                      while ($fila = mysqli_fetch_assoc($resultado)) {
                          echo '<tr>
                                  <th scope="row">' . $fila["id_area"] . '</th>
                                  <td>' . $fila["nombre"] . '</td>
                                </tr>';
                      }
                  
                      echo '</tbody>
                            </table>';
                  } else {
                      echo "No se encontraron resultados.";
                  }
                  
                  // Liberar el resultado y cerrar la conexión
                  mysqli_free_result($resultado);
                  ?>

                </div>

              </div>
            </div><!-- End Recent Sales -->
          </div>
        </div><!-- End Left side columns -->

        <!-- Right side columns -->
        <div class="col-lg-4">

        </div><!-- End Right side columns -->
        <!-- Modal para agregar nueva categoría -->
        <div class="modal fade" id="NuevaCategoria" tabindex="-1" aria-labelledby="NuevaCategoriaLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="NuevaCategoriaLabel">Agregar Categoría</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <!-- Formulario para agregar nueva categoría -->
                <form action="../database/insertarcatego.php" method="POST">
                  <div class="mb-3">
                    <label for="nombreCategoria" class="form-label">Nombre del Área:</label>
                    <input type="text" class="form-control" id="catego" name="catego" required>
                  </div>
                  <button type="submit" class="btn btn-primary">Agregar</button>
                </form>
              </div>
            </div>
          </div>
        </div>


      </div>
    </section>

  </main><!-- End #main -->

  <?php
  require '../forms/footer.php';
  ?>

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

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