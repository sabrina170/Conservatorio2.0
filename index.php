<?php
$nt = $_REQUEST['nt'];

session_start();

if (isset($_REQUEST['cr'])) {
  session_unset();
  session_destroy();
}
?>
<!doctype html>
<html class="no-js" lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta http-equiv="x-ua-compatible" content="ie=edge" />
  <title>Conservatorio de Musica de Lima</title>
  <link rel="icon" href="img/logo2.jpg" type="image/x-icon" />
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.2/css/all.css" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" />
  <link rel="stylesheet" href="mdb/mdb.min.css" />
  <link href="https://cdn.jsdelivr.net/npm/sweetalert2@8/dist/sweetalert2.min.css" rel="stylesheet" />
</head>

<body>
  <!-- Background image -->
  <div class="position-relative">
    <div class="svg-wrapper bg-image shadow-1-strong rounded-lg" style="
      background-image: url('assets/img/fonfo.jpg');
      height: 100vh;
    ">
      <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none" class="svg" style="
        height: 669px;
        width: 100%;
        fill: rgb(20, 77, 133);
        opacity: 0.8;
        transform: rotateY(0deg);
      ">
        <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z"></path>
      </svg>
    </div>
  </div>
  <!-- Background image -->




  <section class="view">
    <div class="mask rgba-gradient">

      <div class="container h-100 d-flex justify-content-center align-items-center">
        <?php
        if ($nt == 11) {
        ?><script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
          <script>
            Swal.fire(
              'Usuario Desabilitado!',
              'El usuario esta <strong> "no activo" </strong> para este sistema!',
              'error'
            ).then(function() {
              window.location.href = "index.php?nt=0";
            });
            // window.location.href = "tutoriales.php ";
          </script>
        <?php
        }
        if ($nt == 12) {
        ?><script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
          <script>
            Swal.fire(
              'Contraseña Incorrecta',
              'Escriba correctamente la contraseña!',
              'error'
            ).then(function() {
              window.location.href = "index.php?nt=0";
            });
            // window.location.href = "tutoriales.php ";
          </script>
        <?php
        }
        if ($nt == 13) {
        ?><script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
          <script>
            Swal.fire(
              'Usuario Incorrecto!',
              'Escriba correctamente el nombre de usuario',
              'warning'
            ).then(function() {
              window.location.href = "index.php?nt=0";
            });
            // window.location.href = "tutoriales.php ";
          </script>
        <?php
        }
        ?>

        <div class="card" style="padding: 50px;">
          <img src="assets/img/logo4.png" class="img-fluid" />
          <div class="card-body" style="text-align: center;">
            <P class="caed-text"><strong>Conservatorio de música de Lima</strong></P>
            <form action="verifica-login.php" method="post">
              <div class="form-group">
                <label for="exampleFormControlInput1">Usuario</label>
                <input type="text" class="form-control" name="user" required>
              </div>
              <div class="form-group">
                <label for="exampleFormControlInput1">Constraseña</label>
                <input type="password" class="form-control" name="password" required>
              </div>
              <br>
              <button type="submit" class="btn btn-rounded btn-block" style="padding: 10px; background-color: #224a73; color: white;">Ingresar</button>
            </form>
          </div>
        </div>

      </div>
    </div>

  </section>
  <script type="text/javascript">
  </script>
</body>

</html>