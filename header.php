<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

    <nav class="main-header navbar navbar-expand navbar-white navbar-light" style="background-color: #024a84 ;">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars text-white"></i></a>
        </li>
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <!-- Navbar Search -->
        <li class="nav-item">
          <a class="nav-link" data-widget="fullscreen" href="#" role="button">
            <i class="fas fa-expand-arrows-alt text-white"></i>
          </a>
        </li>



        <li class="nav-item">
          <a class="nav-link" href="cerrar_sesion.php" role="button">
            <strong class="text-white">Salir</strong> <i class="fas fa-arrow-circle-right text-white"></i>
          </a>
        </li>

      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4" style="background-color: #024a84 ;">
      <!-- Brand Logo -->
      <a href="" class="brand-link">
        <img src="assets/img/logo2-min.jpg" alt="AdminLTE Logo" class="img-fluid img-circle elevation-3">
        <br>

      </a>
      <!-- <h2 class="text-center" style="color: white;">Conservatorio de Música de Lima</h2> -->
      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <?php if ($_SESSION['user_foto'] == '(null)') {
            ?>
              <img src="controlador/imagenes/defecto.png" class="img-circle elevation-2" alt="User Image">
            <?php
            } else { ?>
              <img src="controlador/<?php echo $_SESSION['user_foto'] ?>" class="img-circle elevation-2" alt="User Image">
            <?php
            }
            ?>
          </div>
          <div class="info">
            <a class="d-block"><?php echo $_SESSION['user_nombre']; ?></a>
            <a class="d-block"><?php echo $_SESSION['user_apellido']; ?></a>
            <a class="d-block"><strong> <?php if ($tipo == '1') {
                                          echo 'Administrador';
                                        } else if ($tipo == '2') {
                                          echo 'Profesor';
                                        } else if ($tipo == '3') {
                                          echo 'Trabajador';
                                        } else if ($tipo == '4') {
                                          echo 'Alumno';
                                        } else {
                                          echo 'Le Falta un cargo';
                                        } ?></strong></a>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">


            <li class="nav-header">MODULOS</li>
            <?php if ($tipo == '1') {
            ?>
              <li class="nav-item">
                <a href="admin.php?nt=0" class="nav-link">
                  <i class="nav-icon far fa-calendar-alt"></i>
                  <p>
                    Usuarios
                    <span class="badge badge-info right"><?php echo $usuarios['total'];  ?></span>
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="profesores.php?nt=0" class="nav-link">
                  <i class="nav-icon far fa-image"></i>
                  <p>
                    Profesores
                    <span class="badge badge-info right"><?php echo $profesores['total']; ?></span>
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="estudiantes.php?nt=0" class="nav-link">
                  <i class="nav-icon far fa-image"></i>
                  <p>
                    Alumnos
                    <span class="badge badge-info right"><?php echo $alumnos['total']; ?></span>
                  </p>
                </a>
              </li>
            <?php } else  if ($tipo == '2') {
            ?>
              <li class="nav-item">
                <a href="cursos.php" class="nav-link">
                  <i class="nav-icon fas fa-columns"></i>
                  <p>
                    Mis Cursos
                  </p>
                </a>
              </li>
            <?php } else  if ($tipo == '4') {
            ?>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-columns"></i>
                  <p>
                    Perfil
                  </p>
                </a>
              </li>

            <?php } else  if ($tipo == '3') {
            ?>
              <li class="nav-item">
                <a href="profesores.php" class="nav-link">
                  <i class="nav-icon far fa-image"></i>
                  <p>
                    Profesores
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="estudiantes.php?nt=0" class="nav-link">
                  <i class="nav-icon far fa-image"></i>
                  <p>
                    Alumnos
                    <span class="badge badge-info right"><?php echo $alumnos['total']; ?></span>
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon far fa-image"></i>
                  <p>
                    Calendario
                    <span class="badge badge-info right"><?php echo $alumnos['total']; ?></span>
                  </p>
                </a>
              </li>
            <?php } ?>
            <br><br><br><br><br><br><br>
            <br><br><br>

          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>