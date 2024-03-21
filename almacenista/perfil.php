<?php
require_once("validacion.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Almacen UT Perfil</title>
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
    $breadcrumb->addCrumb('Perfil');

    // Renderiza las migas de pan
    $breadcrumb->render();
    ?><!-- End Page Title -->

    <section class="section profile">
      <div class="row">
        <div class="col-xl-4">

          <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
              <?php
              // Verificar si la sesión tiene una imagen
              $imagen = isset($_SESSION['datosuser']['img']) ? $_SESSION['datosuser']['img'] : 'default.jpg';

              // Imprimir la etiqueta de la imagen usando el operador ternario
              echo '<img src="assets/img/fotosperfil' . $imagen . '" alt="Profile" class="rounded-circle">';
              ?>
              <h2><?php echo  $_SESSION['datosuser']['nombre']; ?></h2>
              <h3>
                <span>
                  <?php
                  $perfil = $_SESSION['datosuser']['rol'];
                  $mensaje = ($perfil == 1) ? "Almacenista" : "Alumno";
                  echo  $mensaje;
                  ?>
                </span>
              </h3>
            </div>
          </div>

        </div>

        <div class="col-xl-8">

          <div class="card">
            <div class="card-body pt-3">
              <!-- Bordered Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered">

                <li class="nav-item">
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Perfil</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Editar Perfil</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Cambio de Contraseña</button>
                </li>

              </ul>
              <div class="tab-content pt-2">

                <div class="tab-pane fade show active profile-overview" id="profile-overview">

                  <h5 class="card-title">Detalles del Pefil</h5>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label ">Nombre</div>
                    <div class="col-lg-9 col-md-8"><?php echo  $_SESSION['datosuser']['nombre'] ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label ">Apellidos</div>
                    <div class="col-lg-9 col-md-8"><?php echo  $_SESSION['datosuser']['apellidos'] ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Email</div>
                    <div class="col-lg-9 col-md-8"><?php echo  $_SESSION['datosuser']['correo']; ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Puesto</div>
                    <div class="col-lg-9 col-md-8">
                      <span>
                        <?php
                        $perfil = $_SESSION['datosuser']['rol'];
                        $mensaje = ($perfil == 1) ? "Almacenista" : "Alumno";
                        echo  $mensaje;
                        ?>
                      </span>
                    </div>
                  </div>

                </div>

                <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                  <!-- Profile Edit Form -->
                  <form action="editar-perfil" method="POST" enctype="multipart/form-data">
                    <div class="row mb-3">
                      <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Foto del Usuario</label>
                      <div class="col-md-8 col-lg-9">
                        <?php
                        // Verificar si la sesión tiene una imagen
                        $imagen = isset($_SESSION['datosuser']['img']) ? $_SESSION['datosuser']['img'] : 'default.jpg';

                        // Imprimir la etiqueta de la imagen usando el operador ternario
                        echo '<img src="assets/img/fotosperfil' . $imagen . '" alt="Profile" width="120px" height="120px">';
                        ?>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Nombre</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="fullName" type="text" class="form-control" id="fullName" value="<?php echo  $_SESSION['datosuser']['nombre'] ?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="lastName" class="col-md-4 col-lg-3 col-form-label">Apellidos</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="lastName" type="text" class="form-control" id="lastName" value="<?php echo $_SESSION['datosuser']['apellidos'] ?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="fullEmail" class="col-md-4 col-lg-3 col-form-label">Email</label>
                      <div class="col-md-8 col-lg-9">
                        <input type="text" name="fullEmail" class="form-control" id="fullEmail" value="<?php echo  $_SESSION['datosuser']['correo']; ?>" aria-label="readonly input example" readonly>
                        </input>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Job" class="col-md-4 col-lg-3 col-form-label">Puesto</label>
                      <div class="col-md-8 col-lg-9">
                        <input type="text" name="puesto" class="form-control" id="puesto" value="<?php
                                                                                                  $perfil = $_SESSION['datosuser']['rol'];
                                                                                                  $mensaje = ($perfil == 1) ? "Almacenista" : "Alumno";
                                                                                                  echo $mensaje;
                                                                                                  ?>" aria-label="readonly input example" readonly></input>
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label for="foto" class="col-md-4 col-lg-3 col-form-label">Cambiar foto </label>
                      <div class="col-md-8 col-log-9">
                        <input class="form-control" id="foto" type="file" name="foto">
                      </div>
                    </div>
                    <input type="hidden" name="accion" value="editar">
                    <input type="hidden" name="id" value="<?php echo $_SESSION['datosuser']['id_usuario']?>">


                    <div class="text-center">
                      <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                    </div>
                  </form><!-- End Profile Edit Form -->

                </div>

                <div class="tab-pane fade pt-3" id="profile-change-password">
                  <!-- Change Password Form -->
                  <form>

                    <div class="row mb-3">
                      <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Contraseña Actual</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="password" type="password" class="form-control" id="currentPassword">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">Contraseña Nueva</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="newpassword" type="password" class="form-control" id="newPassword">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Confirmar contraseña nueva</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="renewpassword" type="password" class="form-control" id="renewPassword">
                      </div>
                    </div>

                    <div class="text-center">
                      <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                    </div>
                  </form><!-- End Change Password Form -->

                </div>

              </div><!-- End Bordered Tabs -->

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