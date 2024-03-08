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
    $breadcrumb->addCrumb('Categoria');

    // Renderiza las migas de pan
    $breadcrumb->render();
    ?><!-- End Page Title -->

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

</body>

</html>