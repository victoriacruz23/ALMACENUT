<!-- ======= Sidebar ======= -->

<aside id="sidebar" class="sidebar">
  <?php
  if (isset($_SESSION['datosuser'])) {
    switch ($_SESSION['datosuser']['rol']) {
      case 1:
  ?>
        <ul class="sidebar-nav" id="sidebar-nav">
          <li class="nav-item">
            <a class="nav-link " href="inicio-almacenista">
              <i class="bi bi-house-check-fill"></i>
              <span>Inicio</span>
            </a>
          </li><!-- End Dashboard Nav -->
          <li class="nav-item">
            <a class="nav-link collapsed " href="cetegoria-almacenista">
              <i class="bi bi-tags-fill"></i>
              <span>Categoria</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link collapsed " href="bajas-almacenista">
              <i class="bi bi-trash3-fill"></i>
              <span>Bajas</span>
            </a>
          </li>

          <li class="nav-heading">Pages</li>

        <?php
        break;
        // Alumno
      case 2:
        ?>

          <li class="nav-item">
            <a class="nav-link collapsed" href="pages/users-profile.php">
              <i class="bi bi-person"></i>
              <span>Profile</span>
            </a>
          </li><!-- End Profile Page Nav -->

          <li class="nav-item">
            <a class="nav-link collapsed" href="pages/pages-contact.php">
              <i class="bi bi-envelope"></i>
              <span>Contact</span>
            </a>
          </li><!-- End Contact Page Nav -->
          <!-- End Contact Page Nav -->
      <?php
        break;
        // nada nada 
      default:
        $response = array("success" => false, "message" => "Existio un error");
        echo json_encode($response);
        exit;
        break;
    }
      ?>
      <li class="nav-item">
        <a class="nav-link collapsed" onclick="cerrarsesion(event);">
          <i class="bi bi-box-arrow-right"></i>
          <span>Cerrar Sesión</span>
        </a>
      </li>
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
    <script>
      // Función para agregar la clase para mostrar activo la pestaña donde te encuentres
      // Obtener todos los elementos con la clase "nav-link"
      var navLinks = document.querySelectorAll('.nav-link');
      // Iterar sobre los elementos y agregar o quitar la clase "collapsed" según corresponda
      navLinks.forEach(function(navLink) {
        // Verificar si el href del enlace coincide con la página actual
        if (navLink.href === window.location.href) {
          navLink.classList.remove('collapsed');
        } else {
          navLink.classList.add('collapsed');
        }
      });
    </script>
        </ul>

</aside><!-- End Sidebar-->