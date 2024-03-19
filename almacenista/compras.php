<?php
require_once("validacion.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Almacen UT Compras</title>
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
                  <h5 class="card-title">Movimientos de compras</h5>
                  <form action="procesarcompra.php" method="POST">

                    <div class="row mb-3">
                      <div class="col-md-6">
                        <div class="form-floating mb-3 mb-md-0">
                          <input class="form-control" id="nombre" type="number" placeholder="Escriba un Folio" required name="nombre" />
                          <label for="nombre">Folio</label>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-floating">
                          <input class="form-control" id="apellido" type="text" placeholder="Introduzca sus apellidos" required name="apellido" />
                          <label for="apellido">Nombre:</label>
                        </div>
                      </div>
                    </div>
                    <select class="form-select form-floating mb-3" name="puesto" id="puesto" aria-label="Default select example" required>
                      <option selected>Puesto</option>
                      <option value="1">Medico escolar</option>
                    </select>
                    <div class="mb-3">
                      <label for="foto" class="form-label">Seleccione una foto para su perfil</label>
                      <input class="form-control form-control-sm" id="foto" type="file" name="foto" required>
                    </div>
                    <div class="row mb-3">
                      <div class="col-md-6">
                        <div class="form-floating mb-3 mb-md-0">
                          <input class="form-control" id="username" type="text" placeholder="Ejemplo: AndraG" required name="username" />
                          <label for="username">Nombre de usuario</label>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-floating mb-3 mb-md-0">
                          <input class="form-control" id="contrasena" type="password" placeholder="contraseña" required name="contrasena" />
                          <label for="contrasena">Contrase&ntilde;a</label>
                        </div>
                      </div>
                    </div>
                    <div class="mt-4 mb-0">
                      <div class="d-grid"><button class="btn btn-primary btn-block" type="submit">Crear cuenta</button></div>
                    </div>
                  </form>

                </div>

              </div>
            </div><!-- End Recent Sales -->

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