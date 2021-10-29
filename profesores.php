<?php include('header-link.php');
if (!isset($_SESSION['user_tipo'])) {

    header('Location:index.php?nt=0');
} else {
    if ($_SESSION['user_tipo'] == 2) {
        header('Location:index.php?nt=0');
    }
}
$nt = $_REQUEST['nt'];
?>

<?php include('header.php');
include('controlador/conexion.php');
$consulta = "SELECT * FROM adminuser where tipo = 2";
$resultado = mysqli_query($cn, $consulta);
?>
<style>
    .dt-button {
        padding: 0;
        border: none;
        margin-bottom: 10px;
    }
</style>
<div class="content-wrapper" style="padding: 0px 30px 30px 30px; background-color: #e0e0e0;">
    <?php
    if ($nt == 1) {
    ?><script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
        <script>
            Swal.fire(
                'Insertado!',
                'Profesor creado correctamente!',
                'success'
            ).then(function() {
                window.location.href = "profesores.php?nt=0";
            });
            // window.location.href = "tutoriales.php ";
        </script>
    <?php
    } else if ($nt == 2) {
    ?><script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
        <script>
            Swal.fire(
                'Eliminado!',
                'Profesor eliminado correctamente!',
                'error'
            ).then(function() {
                window.location.href = "profesores.php?nt=0";
            });
            // window.location.href = "tutoriales.php ";
        </script>
    <?php
    } else if ($nt == 4) {
    ?><script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
        <script>
            Swal.fire(
                'Error al insertar usuario!',
                'Problemas!',
                'warning'
            ).then(function() {
                window.location.href = "profesores.php?nt=0";
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
                window.location.href = "profesores.php?nt=0";
            });
            // window.location.href = "tutoriales.php ";
        </script>
    <?php
    }
    ?>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0" style="color: #06599e;"><strong>Profesores</strong> </h1>
                </div>

            </div>
        </div>
    </div>
    <?php
    if ($_SESSION['user_tipo'] == 3) {
    ?>
        <div class="card">
            <div class="card-header">
                Insertar un Profesor
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-10">
                        <form action="controlador/acciones.php?accion=InsertaUsuario2" method="POST" enctype="multipart/form-data">
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="inputEmail4">Nombres</label>
                                    <input type="text" class="form-control" name="nombres" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="inputPassword4">Apellidos</label>
                                    <input type="text" class="form-control" name="apellidos" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="inputPassword4">DNI</label>
                                    <input type="number" class="form-control" name="dni" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="inputEmail4">Especialidad</label>
                                    <input type="text" class="form-control" name="especialidad" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="inputState">Cargo</label>
                                    <select id="inputState" class="form-control btn-secondary" name="tipo" required>
                                        <option value="2">Profesor(a)</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="inputEmail4">Telefono</label>
                                    <input type="number" class="form-control" name="telefono" required>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="inputEmail4">Usuario</label>
                                    <input type="text" class="form-control" name="usuario" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="inputEmail4">Contraseña</label>
                                    <input type="text" class="form-control" name="clave" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="inputState">Estado</label>
                                    <select id="inputState" class="form-control btn-secondary" name="estado" required>
                                        <option value="1" selected>Activo</option>
                                    </select>
                                </div>
                            </div>
                    </div>
                    <div class="col-md-2">
                        <label for="inputState">Imagen</label>
                        <img src="assets/img/perfil.png" class="img-thumbnail" id="img1" height="200" width="200">
                        <div class="form-group">
                            <input type="file" class="form-control" name="foto" id="foto" required>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Insertar</button>
                </form>
            </div>
        </div>
    <?php
    }
    ?>
    <section class="content">
        <div class="container-fluid">

            <div class="card" style="padding: 10px;">

                <!-- Light table -->
                <div class="table-responsive">
                    <table class="table" id="usuarios">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">Nr0</th>
                                <th scope="col">Foto</th>
                                <th scope="col">Nombres</th>
                                <th scope="col">Apellidos</th>
                                <th scope="col">Especialidad</th>
                                <th scope="col">Estado</th>
                                <?php
                                if ($_SESSION['user_tipo'] == 1) {
                                ?>
                                    <th scope="col">Modificado</th>
                                <?php

                                } ?>

                                <th scope="col">Meses</th>
                                <?php
                                if ($_SESSION['user_tipo'] == 3) {
                                ?>
                                    <th scope="col">Acciones</th>
                                <?php

                                } ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $posicion = 1;
                            foreach ($resultado as $show) {
                            ?>
                                <tr>
                                    <th>
                                        <?php echo $posicion;
                                        $posicion++ ?>
                                    </th>
                                    <td>
                                        <?php if ($show['foto'] != '') {
                                        ?>
                                            <img src="controlador/<?php echo $show['foto'] ?>" width="60" height="60" class="d-inline-block align-top">

                                        <?php } else { ?>
                                            <img src="controlador/imagenes/defecto.png" width="60" height="60" class="d-inline-block align-top">
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <?php echo $show['nombres'] ?>
                                    </td>
                                    <td>
                                        <?php echo $show['apellidos'] ?>
                                    </td>
                                    <td>
                                        <?php echo $show['especialidad'] ?>
                                    </td>

                                    <td>
                                        <?php
                                        if ($show['estado'] == 1) {
                                            echo '<span class="badge rounded-pill bg-success">Activo</span>';
                                        } else {
                                            echo '<span class="badge rounded-pill bg-danger">Desactivado</span>';
                                        }

                                        ?>
                                    </td>
                                    <?php
                                    if ($_SESSION['user_tipo'] == 1) {
                                    ?>
                                        <td>
                                            Por <strong style="color: #06599e;"><?php echo $show['modificado'] ?></strong>
                                        </td>
                                    <?php

                                    } ?>
                                    <td>
                                        <a href="meses.php?id_pro=<?php echo $show['id']; ?>&nt=0">Meses <i class="fas fa-calendar-alt"></i></a>
                                    </td>
                                    <?php
                                    if ($_SESSION['user_tipo'] == 3) {
                                    ?>
                                        <td>
                                            <a href="Edit-profesor.php?id=<?php echo $show['id']; ?>&nt=0"> <i class="fas fa-edit text-info"></i></a>
                                            <a href="" type="button" data-toggle="modal" data-target="#Eliminar<?php echo $show['id'] ?>"><i class="fas fa-trash-alt  text-danger"></i></a>
                                        </td>
                                    <?php

                                    } ?>



                                </tr>

                            <?php
                                include('modals/modal-fotoUser.php');
                                include('modals/modal-EliminarProfesor.php');
                            } ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </section>
</div>
<?php include('footer.php'); ?>
<script>
    $(document).ready(function() {

        $('#usuarios').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
            },
            "dom": 'Blfrtip',
            buttons: [{
                    //Botón para Excel
                    extend: 'excel',
                    footer: true,
                    title: 'Archivo',
                    filename: 'Excel de Profesores',

                    //Aquí es donde generas el botón personalizado
                    text: '<button class="btn btn-success">Exportar a Excel <i class="fas fa-file-excel"></i></button>'
                },
                //Botón para PDF
                {
                    extend: 'pdf',
                    footer: true,
                    title: 'Archivo PDF',
                    filename: 'Pdf de Profesores',
                    text: '<button class="btn btn-danger">Exportar a PDF <i class="far fa-file-pdf"></i></button>'
                },
                {
                    extend: 'print',
                    footer: true,
                    title: 'Imprimir',
                    filename: 'Archivo Profesores',
                    text: '<button class="btn btn-info">Imprimir <i class="fas fa-print"></i></button>'
                }

            ]

        });
    });
</script>