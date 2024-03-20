<!-- ======= Header ======= -->
<?php
if (!isset($_SESSION['datosuser'])) {
  header("Location: 403");
  exit;
}
?>
<header id="header" class="header fixed-top d-flex align-items-center">

  <div class="d-flex align-items-center justify-content-between">
    <a href="inicio-almacenista" class="logo d-flex align-items-center">
      <img src="assets/img/img/logo.png" alt="">
      <span class="d-none d-lg-block">Almacen UT</span>
    </a>
    <i class="bi bi-list toggle-sidebar-btn"></i>
  </div>
  <!-- End Logo -->
  <!-- End Search Bar -->
  <div class="search-bar">
    <form class="search-form d-flex align-items-center" method="POST" action="#">
      <!-- <input type="text" name="query" placeholder="Search" title="Enter search keyword"> -->
      <input type="text" id="termino" name="query" placeholder="Search" title="Enter search keyword">
      <button type="submit" title="Search"><i class="bi bi-search"></i></button>
    </form>
  </div>
  <!-- End Search Bar -->

  <nav class="header-nav ms-auto">
    <ul class="d-flex align-items-center">

      <li class="nav-item d-block d-lg-none">
        <a class="nav-link nav-icon search-bar-toggle " href="#">
          <i class="bi bi-search"></i>
        </a>
      </li><!-- End Search Icon-->

      <?php
      /*
     
      <li class="nav-item dropdown">

        <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
          <i class="bi bi-bell"></i>
          <span class="badge bg-primary badge-number">4</span>
        </a><!-- End Notification Icon -->

        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
          <li class="dropdown-header">
            You have 4 new notifications
            <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
          </li>
          <li>
            <hr class="dropdown-divider">
          </li>

          <li class="notification-item">
            <i class="bi bi-exclamation-circle text-warning"></i>
            <div>
              <h4>Lorem Ipsum</h4>
              <p>Quae dolorem earum veritatis oditseno</p>
              <p>30 min. ago</p>
            </div>
          </li>

          <li>
            <hr class="dropdown-divider">
          </li>

          <li class="notification-item">
            <i class="bi bi-x-circle text-danger"></i>
            <div>
              <h4>Atque rerum nesciunt</h4>
              <p>Quae dolorem earum veritatis oditseno</p>
              <p>1 hr. ago</p>
            </div>
          </li>

          <li>
            <hr class="dropdown-divider">
          </li>

          <li class="notification-item">
            <i class="bi bi-check-circle text-success"></i>
            <div>
              <h4>Sit rerum fuga</h4>
              <p>Quae dolorem earum veritatis oditseno</p>
              <p>2 hrs. ago</p>
            </div>
          </li>

          <li>
            <hr class="dropdown-divider">
          </li>

          <li class="notification-item">
            <i class="bi bi-info-circle text-primary"></i>
            <div>
              <h4>Dicta reprehenderit</h4>
              <p>Quae dolorem earum veritatis oditseno</p>
              <p>4 hrs. ago</p>
            </div>
          </li>

          <li>
            <hr class="dropdown-divider">
          </li>
          <li class="dropdown-footer">
            <a href="#">Show all notifications</a>
          </li>

        </ul>
        <!-- End Notification Dropdown Items -->

      </li>

       <!-- End Notification Nav -->

      <li class="nav-item dropdown">

        <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
          <i class="bi bi-chat-left-text"></i>
          <span class="badge bg-success badge-number">3</span>
        </a><!-- End Messages Icon -->

        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow messages">
          <li class="dropdown-header">
            You have 3 new messages
            <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
          </li>
          <li>
            <hr class="dropdown-divider">
          </li>

          <li class="message-item">
            <a href="#">
              <img src="assets/img/messages-1.jpg" alt="" class="rounded-circle">
              <div>
                <h4>Maria Hudson</h4>
                <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                <p>4 hrs. ago</p>
              </div>
            </a>
          </li>
          <li>
            <hr class="dropdown-divider">
          </li>

          <li class="message-item">
            <a href="#">
              <img src="assets/img/messages-2.jpg" alt="" class="rounded-circle">
              <div>
                <h4>Anna Nelson</h4>
                <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                <p>6 hrs. ago</p>
              </div>
            </a>
          </li>
          <li>
            <hr class="dropdown-divider">
          </li>

          <li class="message-item">
            <a href="#">
              <img src="assets/img/messages-3.jpg" alt="" class="rounded-circle">
              <div>
                <h4>David Muldon</h4>
                <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                <p>8 hrs. ago</p>
              </div>
            </a>
          </li>
          <li>
            <hr class="dropdown-divider">
          </li>

          <li class="dropdown-footer">
            <a href="#">Show all messages</a>
          </li>

        </ul><!-- End Messages Dropdown Items -->

      </li>
      <!-- End Messages Nav -->
     */
      ?>


      <li class="nav-item dropdown pe-3">

        <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
          <!-- <img src="assets/img/profile-img.jpg" alt="Profile" class="rounded-circle"> -->
          <?php
          // Verificar si la sesión tiene una imagen
          $imagen = isset($_SESSION['datosuser']['img']) ? $_SESSION['datosuser']['img'] : 'default.jpg';

          // Imprimir la etiqueta de la imagen usando el operador ternario
          echo '<img src="assets/img/fotosperfil' . $imagen . '" alt="Profile" class="rounded-circle">';
          ?>
          <span class="d-none d-md-block dropdown-toggle ps-2"><?php echo  $_SESSION['datosuser']['nombre']; ?></span>
        </a><!-- End Profile Iamge Icon -->

        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
          <li class="dropdown-header">
            <h6><?php echo  $_SESSION['datosuser']['nombre'] . " " . $_SESSION['datosuser']['apellidos'] ?></h6>
            <span><?php
                  $perfil = $_SESSION['datosuser']['rol'];
                  $mensaje = ($perfil == 1) ? "Almacenista" : "Alumno";
                  echo  $mensaje;
                  ?></span>
          </li>
          <li>
            <hr class="dropdown-divider">
          </li>
          <?php
          if (isset($_SESSION['datosuser'])) {
            switch ($_SESSION['datosuser']['rol']) {
              case 1:
          ?>

                <li>
                  <a class="dropdown-item d-flex align-items-center" href="perfil-almacenista">
                    <i class="bi bi-person"></i>
                    <span>Mi Perfil</span>
                  </a>
                </li>
                <li>
                  <hr class="dropdown-divider">
                </li>

                <li>
                  <a class="dropdown-item d-flex align-items-center" href="perfil-almacenista">
                    <i class="bi bi-gear"></i>
                    <span>Configuracion</span>
                  </a>
                </li>
                <li>
                  <hr class="dropdown-divider">
                </li>

                <!-- <li>
            <a class="dropdown-item d-flex align-items-center" href="pages/pages-faq.php">
              <i class="bi bi-question-circle"></i>
              <span>¿Necesitas Ayuda?</span>
            </a>
          </li> -->
                <li>
                  <hr class="dropdown-divider">
                </li>
                <li>
                  <a class="dropdown-item d-flex align-items-center" onclick="cerrarsesion(event);">
                    <i class="bi bi-box-arrow-right"></i>
                    <span>Cerrar sesion</span>
                  </a>
                </li>
        </ul><!-- End Profile Dropdown Items -->
      </li><!-- End Profile Nav -->
    <?php
                break;
                //Alumno
              case 2:
    ?>
      <li>
        <a class="dropdown-item d-flex align-items-center" href="pages/users-profile.php">
          <i class="bi bi-person"></i>
          <span>Mi Perfil</span>
        </a>
      </li>
      <li>
        <hr class="dropdown-divider">
      </li>

      <li>
        <a class="dropdown-item d-flex align-items-center" href="pages/users-profile.php">
          <i class="bi bi-gear"></i>
          <span>Configuracion</span>
        </a>
      </li>
      <li>
        <hr class="dropdown-divider">
      </li>

      <li>
        <a class="dropdown-item d-flex align-items-center" href="pages/pages-faq.php">
          <i class="bi bi-question-circle"></i>
          <span>¿Necesitas Ayuda?</span>
        </a>
      </li>
      <li>
        <hr class="dropdown-divider">
      </li>
      <li>
        <a class="dropdown-item d-flex align-items-center" onclick="cerrarsesion(event);">
          <i class="bi bi-box-arrow-right"></i>
          <span>Cerrar sesion</span>
        </a>
      </li>
    </ul><!-- End Profile Dropdown Items -->
    </li><!-- End Profile Nav -->
<?php
                break;
              default:
                $response = array("success" => false, "message" => "Existio un error");
                echo json_encode($response);
                exit;
                break;
            }
?>

<?php
          } else {
?>
  <li class="nav-item">
    <a class="nav-link collapsed " href="registro-database">
      <i class="bi bi-card-list "></i>
      <span>Registro</span>
    </a>
  </li><!-- End Register Page Nav -->

  <li class="nav-item">
    <a class="nav-link collapsed" href="inicio">
      <i class="bi bi-box-arrow-in-right"></i>
      <span>Inicio sesion</span>
    </a>
  </li><!-- End Login Page Nav -->
<?php
          }
?>
</ul>
  </nav><!-- End Icons Navigation -->
  <script src="assets/js/cerrarsesion.js"></script>
  <script src="assets/js/busqueda.js"></script>
</header><!-- End Header -->