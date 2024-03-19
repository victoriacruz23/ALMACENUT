<?php
require_once("validacion.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Almacen UT Productos</title>
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
    $breadcrumb->addCrumb('Productos');

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
                  <h5 class="card-title">Productos en existencia</h5>
                  <!-- Agregar un botón para abrir el modal -->
                  <button type="button" class="btn btn-primary float-end" style="margin-top: -50px;" data-bs-toggle="modal" data-bs-target="#NuevoProducto">
                    Agregar Productos
                  </button>
                  <!-- <form action="../database/procesar_excel.php" method="post" enctype="multipart/form-data">
                    Selecciona un archivo Excel:
                    <input type="file" name="excel_file" accept=".xls,.xlsx">
                    <input type="submit" value="Subir archivo">
                  </form> -->
                  <?php
                  require '../database/conexion.php';
                  require '../database/funciones.php';

                  $product =  "SELECT p.id_producto, p.imagen, p.clave, a.nombre AS nombre_area, p.nombrepro, p.caracteristicas, p.marca, p.modelo, p.numserie, p.estado, p.existenciaIni, p.observaciones, p.stock, p.entrada, p.salida
                  FROM producto p
                  INNER JOIN areas a ON p.area_id = a.id_area;
                  ";
                  $execute = mysqli_query($conexion, $product);

                  // Verificar si hay resultados
                  if (mysqli_num_rows($execute) > 0) {
                    // Mostrar la tabla HTML
                    echo '<table class="table table-borderless datatable">
                              <thead>
                                <tr>
                                  <th scope="col">Imagen</th>
                                  <th scope="col">Clave</th>
                                  <th scope="col">Producto</th>
                                  <th scope="col">Caracteristicas</th>
                                  <th scope="col">Marca</th>
                                  <th scope="col">Modelo</th>
                                  <th scope="col">Num. serie</th>
                                  <th scope="col">Estado</th>
                                  <th scope="col">Área</th>
                                  <th scope="col">Cantidad</th>
                                  <th scope="col">Observaciones</th>

                                </tr>
                              </thead>
                              <tbody>';

                    // Iterar sobre los resultados y mostrar cada fila en la tabla
                    while ($fila = mysqli_fetch_assoc($execute)) {
                      echo '<tr>
                                  <th><img src="' . $fila["imagen"] . '" alt=""></th>
                                  <td>' . $fila["clave"] . '</td>
                                  <td>' . $fila["nombrepro"] . '</td>
                                  <td><a href="#" class="text-primary">' . $fila["caracteristicas"] . '</a></td>
                                  <th>' . $fila["marca"] . '</th>
                                  <th>' . $fila["modelo"] . '</th>
                                  <th>' . $fila["numserie"] . '</th>
                                  <th>' . $fila["estado"] . '</th>
                                  <th>' . $fila["nombre_area"] . '</th>
                                  <th>' . $fila["existenciaIni"] . '</th>

                            </tr>';
                    }

                    echo '</tbody>
                          </table>';
                  } else {
                    echo "No se encontraron resultados.";
                  }
                  // Liberar el resultado y cerrar la conexión
                  mysqli_free_result($execute);
                  ?>
                </div>
              </div>
            </div><!-- End Recent Sales -->

            <!-- Recent Sales 2-->
            <div class="col-12">
              <div class="card recent-sales overflow-auto">
                <div class="card-body">
                  <h5 class="card-title">Movimientos de Productos</h5>
                  <?php
                  $product =  "SELECT p.id_producto, p.imagen, p.clave, a.nombre AS nombre_area, p.nombrepro, p.caracteristicas, p.marca, p.modelo, p.numserie, p.estado, p.existenciaIni, p.observaciones, p.stock, p.entrada, p.salida
                  FROM producto p
                  INNER JOIN areas a ON p.area_id = a.id_area;
                  ";
                  $execute = mysqli_query($conexion, $product);

                  // Verificar si hay resultados
                  if (mysqli_num_rows($execute) > 0) {
                    // Mostrar la tabla HTML
                    echo '<table class="table table-borderless datatable">
                              <thead>
                                <tr>
                                  <th scope="col">Imagen</th>
                                  <th scope="col">Producto</th>
                                  <th scope="col">Stock</th>
                                  <th scope="col">Entrada</th>
                                  <th scope="col">Salida</th>
                                  <th scope="col">Agregar</th>
                                  <th scope="col">Designar</th>
                                </tr>
                              </thead>
                              <tbody>';

                    // Iterar sobre los resultados y mostrar cada fila en la tabla
                    while ($fila = mysqli_fetch_assoc($execute)) {
                      echo '<tr>
                              <td><img src="' . $fila["imagen"] . '" alt=""></td>
                              <td>' . $fila["nombrepro"] . '</td>
                              <td>' . ($fila["existenciaIni"] + $fila["entrada"] - $fila["salida"]) . '</td>
                              <td>' . $fila["entrada"] . '</td>
                              <td>' . $fila["salida"] . '</td>
                              <td><button type="button" class="btn btn-success mb-3" data-toggle="modal" data-target="#Entrada"><i class="bi bi-clipboard-plus"></i></button></td>
                              <td><button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#modalSalida"><i class="bi bi-clipboard-minus"></i></button></td>                                 
                        </tr>';
              
                    }

                    echo '</tbody>
                            </table>';
                            // Incluye el archivo modalentradasalida.php
                            include 'modalentradasalida.php';
                  } else {
                    echo "No se encontraron resultados.";
                  }

                  // Liberar el resultado y cerrar la conexión
                  mysqli_free_result($execute);
                  ?>
                  <?php
                  include 'modalentradasalida.php';
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
        <div class="modal fade" id="NuevoProducto" tabindex="-1" aria-labelledby="NuevoProductoLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="NuevoProductoLabel">Agregar</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <!-- Formulario para agregar nueva producto -->
                <form action="../database/insertproduct.php" method="POST" enctype="multipart/form-data">
                  <div class="mb-3">
                    <label for="img" class="form-label">Selecione una imagen para su producto</label>
                    <input type="file" name="img" class="form-control" id="img" required>
                  </div>

                  <div class="mb-3">
                    <label for="clave" class="form-label">Clave:</label>
                    <input type="text" class="form-control" id="clave" name="clave" required>
                  </div>

                  <div class="mb-3">
                    <label for="procucto" class="form-label">Nombre del Producto:</label>
                    <input type="text" class="form-control" id="producto" name="producto" required>
                  </div>

                  <div class="mb-3">
                    <label for="caracter" class="form-label">Caracteristicas:</label>
                    <input type="text" class="form-control" id="caracter" name="caracter" required>
                  </div>
                  <div class="mb-3">
                    <label for="marca" class="form-label">Marca:</label>
                    <input type="text" class="form-control" id="marca" name="marca" required>
                  </div>
                  <div class="mb-3">
                    <label for="modelo" class="form-label">Modelo:</label>
                    <input type="text" class="form-control" id="modelo" name="modelo" required>
                  </div>
                  <div class="mb-3">
                    <label for="numserie" class="form-label">Número de serie:</label>
                    <input type="text" class="form-control" id="numserie" name="numserie" required>
                  </div>

                  <div class="mb-3">
                    <label for="categoria" class="form-label">Selecciona una Área:</label>
                    <select class="form-select" aria-label="Default select example" name="catego">

                      <?php
                      $select = mysqli_query($conexion, "SELECT id_area, nombre FROM areas");
                      while ($catego = mysqli_fetch_assoc($select)) {
                      ?>
                        <option value="<?php echo $catego['id_area']; ?>"><?php echo $catego['nombre']; ?></option>
                      <?php
                      }
                      ?>
                    </select>
                  </div>

                  <div class="mb-3">
                    <label for="cantidad" class="form-label">Cantidad:</label>
                    <input type="text" class="form-control" id="cantidad" name="cantidad" required>
                  </div>
                  <div class="mb-3">
                    <label for="observa" class="form-label">Observaciones:</label>
                    <input type="text" class="form-control" id="observa" name="observa">
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