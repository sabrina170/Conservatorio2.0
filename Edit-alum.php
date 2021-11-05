<?php include('header-link.php'); ?>
<?php
if (!isset($_SESSION['user_tipo'])) {
    header('Location:index.php?nt=0');
} else {
    if ($_SESSION['user_tipo'] == 2) {
        header('Location:index.php?nt=0');
    }
} ?>
<?php include('header.php');
include('controlador/conexion.php');

$nt = $_REQUEST['nt'];
$id = $_REQUEST['id'];

$consulta = "SELECT * FROM adminuser where id = '$id'";
$resultado = mysqli_query($cn, $consulta);
?>
<div class="content-wrapper" style="padding: 0px 30px 30px 30px; background-color: #e0e0e0;">

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <a href="estudiantes.php?nt=0" style="color: #06599e;"><strong> <i class="fas fa-arrow-alt-circle-left"></i> VOLVER</strong> </a>
                    <h1 class="text-center m-0" style="color: #06599e;"><strong>Editar Alumno</strong> </h1>
                </div>

            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <?php
            if ($nt == 3) {
            ?><script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
                <script>
                    Swal.fire(
                        'Actualizado!',
                        'Alumno actualizado correctamente!',
                        'success'
                    ).then(function() {
                        window.location.href = "Edit-alum.php?id=<?php echo $id; ?>&nt=0";

                    });
                    // window.location.href = "tutoriales.php ";
                </script>
            <?php

            } else if ($nt == 4) {
            ?><script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
                <script>
                    Swal.fire(
                        'Error al Actualizar Alumno!',
                        'Problemas!',
                        'warning'
                    ).then(function() {
                        window.location.href = "Edit-alum.php?id=<?php echo $id; ?>&nt=0";
                    });
                    // window.location.href = "tutoriales.php ";
                </script>
            <?php
            } else if ($nt == 6) {
            ?><script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
                <script>
                    Swal.fire(
                        'Insertar una imagen!',
                        'No otros archivos como(videos,musica,pdf,etc)',
                        'warning'
                    ).then(function() {
                        window.location.href = "Edit-alum.php?id=<?php echo $id; ?>&nt=0";
                    });
                    // window.location.href = "tutoriales.php ";
                </script>
            <?php
            }
            ?>
            <div class="card">
                <div class="card-header">
                    Insertar un usuario
                </div>
                <div class="card-body">
                    <?php
                    while ($dat = mysqli_fetch_assoc($resultado)) {
                    ?>

                        <div class="row">
                            <div class="col-md-10">
                                <form action="controlador/acciones.php?accion=ActualizarAlumno" method="POST" enctype="multipart/form-data">
                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label for="inputEmail4">Nombres</label>
                                            <input type="text" class="form-control" value="<?php echo $dat['nombres'] ?>" name="nombres">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="inputPassword4">Apellidos</label>
                                            <input type="text" class="form-control" value="<?php echo $dat['apellidos'] ?>" name="apellidos">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="inputPassword4">DNI</label>
                                            <input type="number" class="form-control" value="<?php echo $dat['dni'] ?>" name="dni">
                                        </div>
                                    </div>
                                    <div class="form-row">

                                        <div class="form-group col-md-6">
                                            <label for="inputState">Cargo</label>
                                            <select id="inputState" class="form-control" name="tipo">
                                                <option value="4" <?php if ($dat['tipo'] == 4) {
                                                                        echo 'selected';
                                                                    } ?>>Alumno</option>

                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label for="inputEmail4">Usuario</label>
                                            <input type="text" class="form-control" value="<?php echo $dat['usuario'] ?>" name="usuario">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="inputEmail4">Contraseña</label>
                                            <input type="text" class="form-control" value="<?php echo $dat['clave'] ?>" name="clave">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="inputState">Estado</label>
                                            <select id="inputState" class="form-control" name="estado">
                                                <option value="1" <?php if ($dat['estado'] == 1) {
                                                                        echo 'selected';
                                                                    } ?>>Activo</option>
                                                <option value="2" <?php if ($dat['estado'] == 2) {
                                                                        echo 'selected';
                                                                    } ?>>Desactivado</option>
                                            </select>
                                        </div>
                                    </div>
                            </div>
                            <div class="col-md-2">
                                <label for="inputState">Imagen</label>
                                <?php
                                if ($dat['foto'] !== '') {
                                ?>
                                    <img src="controlador/<?php echo $dat['foto'] ?>" class="img-thumbnail" id="img1" height="200" width="200">
                                <?php
                                } else {
                                ?>
                                    <img src="controlador/imagenes/defecto.png" class="img-thumbnail" id="img1" height="200" width="200">

                                <?php } ?><div class="form-group">
                                    <input type="file" class="form-control" name="foto" id="foto">
                                </div>
                            </div>
                            <input type="hidden" class="form-control" value="<?php echo $dat['id'] ?>" name="id">
                            <input type="hidden" class="form-control" value="<?php echo $muser ?>" name="muser">

                        </div>
                    <?php
                    }
                    ?>

                    <button type="submit" class="btn btn-primary">Actualizar</button>
                    </form>
                </div>
            </div>


        </div>
    </section>
</div>
<?php include('footer.php'); ?>

<script>
    function init() {
        var inputFile = document.getElementById('foto');
        inputFile.addEventListener('change', mostrarImagen, false);
    }

    function mostrarImagen(event) {
        var file = event.target.files[0];
        var reader = new FileReader();
        reader.onload = function(event) {
            var img = document.getElementById('img1');
            img.src = event.target.result;
        }
        reader.readAsDataURL(file);
    }

    window.addEventListener('load', init, false);
</script>